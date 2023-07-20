<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Sheets;

class CustomerRequestController extends Controller
{
    public function index(){
        $client = new Client();
        $client->setAuthConfig(config('google.credentials_json'));
        $client->addScope(Sheets::SPREADSHEETS_READONLY);
        $sheetsService = new Sheets($client);
    
        $spreadsheetId = config('google.spreadsheet_id');
        $range = 'Form Responses 1!A1:Z'; // Replace with the desired range
        $response = $sheetsService->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        $requests = [];
    
        // Use the first row as the column names (header row)
        $columns = array_shift($values);
    
        // Iterate through the remaining rows and create objects using column names as properties
        foreach ($values as $row) {
            $rowObject = new \stdClass();
            foreach ($columns as $index => $columnName) {
                $rowObject->{$columnName} = $row[$index] ?? null;
            }
            $requests[] = $rowObject;
        }

        $search = '';
        return view('user.coordinator.customer-request.index', compact('requests', 'search'));
    }
}
