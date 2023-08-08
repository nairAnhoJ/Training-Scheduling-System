<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function customerIndex(){
        $page = 1;
        $search = '';

        $logs = Logs::with('user')
            ->where('table', 'CUSTOMERS')
            ->orderByDesc('id')
            ->paginate(50, ['*'], 'page', $page);

        // $logsCount = Logs::where('table', 'CUSTOMERS')->count();
        $logsCount = $logs->total();

        return view('user.coordinator.logs.customers.index', compact('page', 'search', 'logs', 'logsCount'));
    }

    public function customerPaginate($page, $search = null){
        if($search == null){
            $logs = Logs::with('user')
                ->where('table', 'CUSTOMERS')
                ->orderByDesc('id')
                ->paginate(50, ['*'], 'page', $page);
        }else{
            $searchTerm = '%' . $search . '%';
    
            $logs = Logs::with('user')
                ->where('table', 'CUSTOMERS')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereRaw("CONCAT_WS(' ', action, description, field, `before`, `after`, created_at) LIKE ?", [$searchTerm])
                        ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                            $userQuery->whereRaw("CONCAT_WS(' ', first_name, last_name) LIKE ?", [$searchTerm]);
                        });
                })
                ->orderByDesc('id')
                ->paginate(50, ['*'], 'page', $page);
        }

        $logsCount = $logs->total();

        return view('user.coordinator.logs.customers.index', compact('page', 'search', 'logs', 'logsCount'));
    }











    public function trainingsIndex(){
        $page = 1;
        $search = '';

        $logs = Logs::with('user')
            ->where('table', 'REQUEST')
            ->orderByDesc('id')
            ->paginate(50, ['*'], 'page', $page);

        $logsCount = $logs->total();

        return view('user.coordinator.logs.requests.index', compact('page', 'search', 'logs', 'logsCount'));
    }

    public function trainingsPaginate($page, $search = null){
        if($search == null){
            $logs = Logs::with('user')
                ->where('table', 'REQUEST')
                ->orderByDesc('id')
                ->paginate(50, ['*'], 'page', $page);
        }else{
            $searchTerm = '%' . $search . '%';
    
            $logs = Logs::with('user')
                ->where('table', 'REQUEST')
                ->where(function ($query) use ($searchTerm) {
                    $query->whereRaw("CONCAT_WS(' ', action, description, field, `before`, `after`, created_at) LIKE ?", [$searchTerm])
                        ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                            $userQuery->whereRaw("CONCAT_WS(' ', first_name, last_name) LIKE ?", [$searchTerm]);
                        });
                })
                ->orderByDesc('id')
                ->paginate(50, ['*'], 'page', $page);
        }

        $logsCount = $logs->total();

        return view('user.coordinator.logs.requests.index', compact('page', 'search', 'logs', 'logsCount'));
    }
}
