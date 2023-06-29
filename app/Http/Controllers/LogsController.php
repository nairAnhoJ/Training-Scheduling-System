<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function customerIndex(){
        $page = 1;
        $search = '';
        $logs = Logs::join('users', 'logs.user_id', '=', 'users.id')
            ->select('logs.*', 'users.first_name', 'users.last_name')
            ->where('table', 'CUSTOMERS')
            ->orderByDesc('id')
            ->paginate(50, ['*'], 'page', $page);
        $logsCount = Logs::where('table', 'CUSTOMERS')->count();

        return view('user.coordinator.logs.customers.index', compact('page', 'search', 'logs', 'logsCount'));
    }

    public function customerPaginate($page, $search = null){
        $logs = Logs::join('users', 'logs.user_id', '=', 'users.id')
            ->select('logs.*', 'users.first_name', 'users.last_name')
            ->where('table', 'CUSTOMERS')
            ->whereRaw("CONCAT_WS(' ', logs.action, logs.description, logs.field, logs.before, logs.after, users.first_name, users.last_name) LIKE '%{$search}%'")
            ->orderByDesc('id')
            ->paginate(50, ['*'], 'page', $page);
        $logsCount = Logs::join('users', 'logs.user_id', '=', 'users.id')
            ->select('logs.*', 'users.first_name', 'users.last_name')
            ->where('table', 'CUSTOMERS')
            ->whereRaw("CONCAT_WS(' ', logs.action, logs.description, logs.field, logs.before, logs.after, users.first_name, users.last_name) LIKE '%{$search}%'")
            ->count();

        return view('user.coordinator.logs.customers.index', compact('page', 'search', 'logs', 'logsCount'));
    }
}
