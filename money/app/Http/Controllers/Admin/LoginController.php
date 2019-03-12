<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //登录页面
    public function index()
    {
    	return view('admin.login.index');
    }

    //登陆操作
    public function check()
    {
    	print_r($_POST);exit;
    }
}
