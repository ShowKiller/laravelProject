<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;

class SystemController extends CommonController
{
    //系统设置页面
    public function index()
    {
    	$data = [
    		'lang' => $this->config
    	];
    	return view('admin.system.index')->with($data);
    }
}
