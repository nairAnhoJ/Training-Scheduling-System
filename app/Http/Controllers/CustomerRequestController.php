<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerRequest;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\BatchUpdateSpreadsheetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomerRequestController extends Controller
{
    public function index(){
        $customers = Customer::where('is_deleted', 0)->get();

        $requests = CustomerRequest::where('is_decline', 0)->get();

        $search = '';
        return view('user.coordinator.customer-request.index', compact('requests', 'search', 'customers'));
    }

    public function search(Request $request){
        $search = $request->search;
        $customers = Customer::where('is_deleted', 0)
            ->get();

        $requests = CustomerRequest::where('is_decline', 0)
            ->whereRaw("CONCAT_WS(' ', name, address, category, brand, model, unit_type, knowledge_of_participants) LIKE '%{$search}%'")
            ->get();

        return view('user.coordinator.customer-request.index', compact('requests', 'search', 'customers'));
    }

    public function TrainingRequestFromCustomer(){
        return view('customer-request');
    }

    public function TrainingRequestFromCustomerSubmit(Request $request){

        $validator = Validator::make($request->all(), [
            'policy' => 'required',
            'name' => 'required',
            'address' => 'required',
            
            'cp1_name' => 'required',
            'cp1_number' => 'required',
            'cp1_email' => 'required',

            'category' => 'required',
            'sales_representative' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'unit_type' => 'required',
            'no_of_unit' => 'required',
            'no_of_attendees' => 'required',
            'knowledge_of_participants' => 'required',
        ]);

        $customMessages = [
            'policy.required' => 'Please review and accept our Privacy Policy before submitting your request.',

            'name.required' => 'Please provide the required information.',
            'address.required' => 'Please provide the required information.',

            'cp1_name.required' => 'Please provide the required information.',
            'cp1_number.required' => 'Please provide the required information.',
            'cp1_email.required' => 'Please provide the required information.',
            
            'category.required' => 'Please select an option from the list.',
            'sales_representative.required' => 'Please provide the required information.',
            'brand.required' => 'Please select an option from the list.',
            'model.required' => 'Please provide the required information.',
            'unit_type.required' => 'Please select an option from the list.',
            'no_of_unit.required' => 'Please provide the required information.',
            'no_of_attendees.required' => 'Please provide the required information.',
            'knowledge_of_participants.required' => 'Please select an option from the list.',
        ];

        $validator->setCustomMessages($customMessages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->name;
        $address = $request->address;
        
        $cp1_name = $request->cp1_name;
        $cp1_number = $request->cp1_number;
        $cp1_email = $request->cp1_email;
        
        $cp2_name = $request->cp2_name;
        $cp2_number = $request->cp2_number;
        $cp2_email = $request->cp2_email;
        
        $cp3_name = $request->cp3_name;
        $cp3_number = $request->cp3_number;
        $cp3_email = $request->cp3_email;
        
        $category = $request->category;
        $sales_representative = $request->sales_representative;
        $brand = $request->brand;
        $model = $request->model;
        $unit_type = $request->unit_type;
        $no_of_unit = $request->no_of_unit;
        $no_of_attendees = $request->no_of_attendees;
        $knowledge_of_participants = $request->knowledge_of_participants;

        $cusReq = new CustomerRequest;
        $cusReq->name = $name;
        $cusReq->address = $address;

        $cusReq->cp1_name = $cp1_name;
        $cusReq->cp1_number = $cp1_number;
        $cusReq->cp1_email = $cp1_email;

        $cusReq->cp2_name = $cp2_name;
        $cusReq->cp2_number = $cp2_number;
        $cusReq->cp2_email = $cp2_email;

        $cusReq->cp3_name = $cp3_name;
        $cusReq->cp3_number = $cp3_number;
        $cusReq->cp3_email = $cp3_email;

        $cusReq->category = $category;
        $cusReq->sales_representative = $sales_representative;
        $cusReq->brand = $brand;
        $cusReq->model = $model;
        $cusReq->unit_type = $unit_type;
        $cusReq->no_of_unit = $no_of_unit;
        $cusReq->no_of_attendees = $no_of_attendees;
        $cusReq->knowledge_of_participants = $knowledge_of_participants;

        $cusReq->save();

        return redirect()->route('TrainingRequestFromCustomer')->with('success', '1');;
    }

    // public function sync(){
    //     $client = new Client();
    //     $client->setAuthConfig(config('google.credentials_json'));
    //     $client->addScope(Sheets::SPREADSHEETS);
    //     $sheetsService = new Sheets($client);
    
    //     $spreadsheetId = config('google.spreadsheet_id');
    //     $range = 'Form Responses 1!A2:V'; // Replace with the desired range
    //     $response = $sheetsService->spreadsheets_values->get($spreadsheetId, $range);
    //     $values = $response->getValues();

    //     if ($values != null) {
    //         foreach($values as $rowIndex => $value){
    //             $cusReq = new CustomerRequest;
    //             $cusReq->name = $value[4];
    //             $cusReq->address = $value[5];
    
    //             $cusReq->cp1_name = $value[6];
    //             $cusReq->cp1_number = $value[7];
    //             $cusReq->cp1_email = $value[8];
    
    //             $cusReq->cp2_name = $value[9];
    //             $cusReq->cp2_number = $value[10];
    //             $cusReq->cp2_email = $value[11];
    
    //             $cusReq->cp3_name = $value[12];
    //             $cusReq->cp3_number = $value[13];
    //             $cusReq->cp3_email = $value[14];
    
    //             $cusReq->category = $value[15];
    //             $cusReq->brand = $value[16];
    //             $cusReq->model = $value[17];
    //             $cusReq->unit_type = $value[18];
    //             $cusReq->no_of_unit = $value[19];
    //             $cusReq->no_of_attendees = $value[20];
    //             $cusReq->knowledge_of_participants = $value[21];
    //             $cusReq->created_at = $value[1];
    
    //             $cusReq->save();
    //         }

    //         $sheetProperties = $sheetsService->spreadsheets->get($spreadsheetId)->getSheets();
    //         $sheetId = null;
        
    //         // Find the sheet ID based on the sheet title
    //         foreach ($sheetProperties as $sheetProperty) {
    //             if ($sheetProperty->getProperties()->getTitle() === 'Form Responses 1') {
    //                 $sheetId = $sheetProperty->getProperties()->getSheetId();
    //                 break;
    //             }
    //         }
        
    //         if ($sheetId) {
    //             // $deleteRange = 'Form Responses 1!A' . $targetRow . ':Z' . $targetRow;
    //             $batchUpdateRequest = new BatchUpdateSpreadsheetRequest([
    //                 'requests' => [
    //                     [
    //                         'deleteDimension' => [
    //                             'range' => [
    //                                 'sheetId' => $sheetId,
    //                                 'dimension' => 'ROWS',
    //                                 'startIndex' => 1, // Subtract 1 to account for 0-based indexing
    //                                 'endIndex' => count($values) + 1,
    //                             ],
    //                         ],
    //                     ],
    //                 ],
    //             ]);
        
    //             // Execute the batch update request to delete the row
    //             $sheetsService->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
    //         }
    //     }

    //     return redirect()->back();
    // }

    public function view(Request $request){
        $cr = CustomerRequest::where('id', $request->id)->first();

        $result = array(
            'name' => strtoupper($cr->name),
            'address' => strtoupper($cr->address),
            'cp1_name' => strtoupper($cr->cp1_name),
            'cp1_number' => $cr->cp1_number,
            'cp1_email' => $cr->cp1_email,

            'cp2_name' => strtoupper($cr->cp2_name),
            'cp2_number' => $cr->cp2_number,
            'cp2_email' => $cr->cp2_email,

            'cp3_name' => strtoupper($cr->cp3_name),
            'cp3_number' => $cr->cp3_number,
            'cp3_email' => $cr->cp3_email,

            'category' => strtoupper($cr->category),
            'sales_representative' => strtoupper($cr->sales_representative),
            'brand' => strtoupper($cr->brand),
            'model' => strtoupper($cr->model),
            'unit_type' => strtoupper($cr->unit_type),
            'no_of_unit' => $cr->no_of_unit,
            'no_of_attendees' => $cr->no_of_attendees,
            'knowledge_of_participants' => strtoupper($cr->knowledge_of_participants),
        );

        echo json_encode($result);
    }

    public function approve(Request $request){
        $id = ModelsRequest::orderBy('id', 'desc')->value('id') + 1;
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

        $com = Customer::where('name', $name)
            ->first();

        if($com != ''){
            Customer::where('name', $name)
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
                $existingModel = Customer::where('key', $key)->first();
                if (!$existingModel) {
                    $unique = true;
                }
            }

            $customer = Customer::insertGetId([
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
        $sales_representative = $request->sales_representative;
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
            $existingModel = ModelsRequest::where('key', $key)->first();
            if (!$existingModel) {
                $unique = true;
            }
        }

        ModelsRequest::insert([
                'number' => $number,
                'customer_id' => $cusID,
                'category' => $category,
                'sales_representative' => $sales_representative,
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
        CustomerRequest::where('id', $id)->update([
            'is_decline' => 1
        ]);

        return redirect()->route('customer.request.index')->with('success', 'Request Successfully Declined');
    }

    public function declined(){
        $requests = CustomerRequest::where('is_decline', 1)->get();

        $search = '';

        return view('user.coordinator.customer-request.declined.index', compact('requests', 'search'));
    }

    public function declinedRestore($id){
        CustomerRequest::where('id', $id)->update([
            'is_decline' => 0
        ]);

        return redirect()->route('customer.request.declined')->with('success', 'Request Successfully Restored');
    }

    public function declinedDelete($id){
        CustomerRequest::where('id', $id)->delete();

        return redirect()->route('customer.request.declined')->with('success', 'Request Successfully Restored');
    }
}
