<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{
    //index 方法
    public function index()
    {
        // $data = DB::table('user')->get();
        return view('index');
    }
}
