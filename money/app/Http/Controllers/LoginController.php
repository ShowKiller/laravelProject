<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登录页面
    public function index()
    {
        return view('login');
    }
    //登录操作
    public function check()
    {
        echo 321;exit;
        dd($_POST);
    }
    //put 请求页面
    public function putWeb()
    {
        return view('login');
    }
    //处理put 请求
    public function put()
    {
        // dd($request->input());  为什么$request不存在
        dd($_POST);
    }
}
