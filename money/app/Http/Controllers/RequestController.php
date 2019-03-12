<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    //
    public function index(Request $request)
    {
    	//获取当前地址
    	echo $request->fullUrl();
    	//获取路由部分
    	echo "<hr>";
    	echo $request->path();
    	echo "<hr>";
    	//获取所有参数
    	echo $request->url();
    	dd($request);
    	echo 321;exit;
    }
}
