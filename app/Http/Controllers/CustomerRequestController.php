<?php

namespace App\Http\Controllers;

use App\Models\CustomerRequest;
use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\BatchUpdateSpreadsheetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerRequestController extends Controller
{
    public function index(){
        $customers = DB::table('customers')->where('is_deleted', 0)->get();

        $requests = DB::table('customer_requests')->where('is_decline', 0)->get();

        $search = '';
        return view('user.coordinator.customer-request.index', compact('requests', 'search', 'customers'));
    }

    public function search(Request $request){
        $search = $request->search;
        $customers = DB::table('customers')
            ->where('is_deleted', 0)
            ->get();

        $requests = DB::table('customer_requests')
            ->where('is_decline', 0)
            ->whereRaw("CONCAT_WS(' ', name, address, category, brand, model, unit_type, knowledge_of_participants) LIKE '%{$search}%'")
            ->get();

        return view('user.coordinator.customer-request.index', compact('requests', 'search', 'customers'));
    }

    public function sync(){
        $client = new Client();
        $client->setAuthConfig(config('google.credentials_json'));
        $client->addScope(Sheets::SPREADSHEETS);
        $sheetsService = new Sheets($client);
    
        $spreadsheetId = config('google.spreadsheet_id');
        $range = 'Form Responses 1!A2:V'; // Replace with the desired range
        $response = $sheetsService->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        if ($values != null) {
            foreach($values as $rowIndex => $value){
                $cusReq = new CustomerRequest;
                $cusReq->name = $value[4];
                $cusReq->address = $value[5];
    
                $cusReq->cp1_name = $value[6];
                $cusReq->cp1_number = $value[7];
                $cusReq->cp1_email = $value[8];
    
                $cusReq->cp2_name = $value[9];
                $cusReq->cp2_number = $value[10];
                $cusReq->cp2_email = $value[11];
    
                $cusReq->cp3_name = $value[12];
                $cusReq->cp3_number = $value[13];
                $cusReq->cp3_email = $value[14];
    
                $cusReq->category = $value[15];
                $cusReq->brand = $value[16];
                $cusReq->model = $value[17];
                $cusReq->unit_type = $value[18];
                $cusReq->no_of_unit = $value[19];
                $cusReq->no_of_attendees = $value[20];
                $cusReq->knowledge_of_participants = $value[21];
                $cusReq->created_at = $value[1];
    
                $cusReq->save();
            }

            $sheetProperties = $sheetsService->spreadsheets->get($spreadsheetId)->getSheets();
            $sheetId = null;
        
            // Find the sheet ID based on the sheet title
            foreach ($sheetProperties as $sheetProperty) {
                if ($sheetProperty->getProperties()->getTitle() === 'Form Responses 1') {
                    $sheetId = $sheetProperty->getProperties()->getSheetId();
                    break;
                }
            }
        
            if ($sheetId) {
                // $deleteRange = 'Form Responses 1!A' . $targetRow . ':Z' . $targetRow;
                $batchUpdateRequest = new BatchUpdateSpreadsheetRequest([
                    'requests' => [
                        [
                            'deleteDimension' => [
                                'range' => [
                                    'sheetId' => $sheetId,
                                    'dimension' => 'ROWS',
                                    'startIndex' => 1, // Subtract 1 to account for 0-based indexing
                                    'endIndex' => count($values) + 1,
                                ],
                            ],
                        ],
                    ],
                ]);
        
                // Execute the batch update request to delete the row
                $sheetsService->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
            }
        }

        return redirect()->back();
    }

    public function view(Request $request){
        $cr = CustomerRequest::where('id', $request->id)->first();

        $result = array(
            'name' => $cr->name,
            'address' => $cr->address,
            'cp1_name' => $cr->cp1_name,
            'cp1_number' => $cr->cp1_number,
            'cp1_email' => $cr->cp1_email,

            'cp2_name' => $cr->cp2_name,
            'cp2_number' => $cr->cp2_number,
            'cp2_email' => $cr->cp2_email,

            'cp3_name' => $cr->cp3_name,
            'cp3_number' => $cr->cp3_number,
            'cp3_email' => $cr->cp3_email,

            'category' => $cr->category,
            'brand' => $cr->brand,
            'model' => $cr->model,
            'unit_type' => $cr->unit_type,
            'no_of_unit' => $cr->no_of_unit,
            'no_of_attendees' => $cr->no_of_attendees,
            'knowledge_of_participants' => $cr->knowledge_of_participants,
        );

        echo json_encode($result);
    }

    public function approve(Request $request){
        $id = DB::table('requests')->orderBy('id', 'desc')->value('id') + 1;
        $user_id = Auth::user()->id;

        if($id == null || $id == ''){
            $id = 1;
        }

        $nid = str_pad($id, 7, '0', STR_PAD_LEFT);

        $number = date('ym').'-'.$user_id.'-'.$nid;

        $name = strtoupper($request->name);
        $adress = strtoupper($request->adress);
        $area = $request->area;

        $cp1_name = strtoupper($request->cp1_name);
        $cp1_number = $request->cp1_number;
        $cp1_email = $request->cp1_email;

        $cp2_name = strtoupper($request->cp2_name);
        $cp2_number = $request->cp2_number;
        $cp2_email = $request->cp2_email;

        $cp3_name = strtoupper($request->cp3_name);
        $cp3_number = $request->cp3_number;
        $cp3_email = $request->cp3_email;

        $com = DB::table('customers')
            ->where('name', $name)
            ->first();

        if($com != ''){
            DB::table('customers')
                ->where('name', $name)
                ->update([
                    'name' => $name,
                    'address' => $adress,
                    'area' => $area,
                    'cp1_name' => $cp1_name,
                    'cp1_number' => $cp1_number,
                    'cp1_email' => $cp1_email,
                    'cp2_name' => $cp2_name,
                    'cp2_number' => $cp2_number,
                    'cp2_email' => $cp2_email,
                    'cp3_name' => $cp3_name,
                    'cp3_number' => $cp3_number,
                    'cp3_email' => $cp3_email,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            $cusID = $com->id;
        }else{
            $unique = false;
            $key = null;
    
            while (!$unique) {
                $key = Str::uuid()->toString();
                $existingModel = DB::table('customers')->where('key', $key)->first();
                if (!$existingModel) {
                    $unique = true;
                }
            }

            $customer = DB::table('customers')
                ->insertGetId([
                    'name' => $name,
                    'address' => $adress,
                    'area' => $area,
                    'cp1_name' => $cp1_name,
                    'cp1_number' => $cp1_number,
                    'cp1_email' => $cp1_email,
                    'cp2_name' => $cp2_name,
                    'cp2_number' => $cp2_number,
                    'cp2_email' => $cp2_email,
                    'cp3_name' => $cp3_name,
                    'cp3_number' => $cp3_number,
                    'cp3_email' => $cp3_email,
                    'key' => $key,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            $cusID = $customer;
        }

        $category = $request->category;
        $brand = $request->brand;
        $model = $request->model;
        $unit_type = $request->unit_type;
        $no_of_unit = $request->no_of_unit;
        $no_of_attendees = $request->no_of_attendees;
        $knowledge_of_participants = $request->knowledge_of_participants;

        $unique = false;
        $key = null;

        while (!$unique) {
            $key = Str::uuid()->toString();
            $existingModel = DB::table('requests')->where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }

        DB::table('requests')
            ->insert([
                'number' => $number,
                'customer_id' => $cusID,
                'category' => $category,
                'is_PM' => 0,
                'unit_type' => $unit_type,
                'brand' => $brand,
                'model' => $model,
                'no_of_unit' => $no_of_unit,
                'no_of_attendees' => $no_of_attendees,
                'knowledge_of_participants' => $knowledge_of_participants,
                'key' => $key,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        CustomerRequest::where('id', $request->id)->delete();

        return redirect()->route('customer.request.index')->with('success', 'Request Successfully Approved');
    }

    public function decline($id){
        DB::table('customer_requests')->where('id', $id)->update([
            'is_decline' => 1
        ]);

        return redirect()->route('customer.request.index')->with('success', 'Request Successfully Declined');
    }

    public function declined(){
        $requests = DB::table('customer_requests')->where('is_decline', 1)->get();

        $search = '';

        return view('user.coordinator.customer-request.declined.index', compact('requests', 'search'));
    }

    public function declinedRestore($id){
        DB::table('customer_requests')->where('id', $id)->update([
            'is_decline' => 0
        ]);

        return redirect()->route('customer.request.declined')->with('success', 'Request Successfully Restored');
    }

    public function declinedDelete($id){
        DB::table('customer_requests')->where('id', $id)->delete();

        return redirect()->route('customer.request.declined')->with('success', 'Request Successfully Restored');
    }
}
