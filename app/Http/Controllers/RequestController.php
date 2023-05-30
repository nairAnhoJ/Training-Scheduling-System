<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function index(){
        $requests = DB::table('requests')
            ->select('requests.*', 'customers.*')
            ->join('customers', 'requests.customer_id', '=', 'requests.id')
            ->orderBy('requests.id', 'desc')
            ->get();
        $search = '';
        $page = 1;
        return view('admin.request.index', compact('search', 'requests', 'page'));
    }

    public function add(){
        return view('admin.request.add');
    }
}
