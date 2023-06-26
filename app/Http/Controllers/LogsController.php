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

        return view('user.coordinator.logs.customers.index', compact('search', 'logs'));
    }
}
