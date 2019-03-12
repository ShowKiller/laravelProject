<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //用户管理页面首页
    public function index()
    {
        return view('admin.user.index');
    }

    //创建用户页面
    public function create()
    {
    	return view('admin.user.create');
    }

    //修改用户页面
    public function edit()
    {
    	return view('admin.user.edit');
    }
    //添加用户操作
    public function store()
    {

    }
    //修改用户操作
    public function update()
    {

    }
    //删除用户操作
    public function destory()
    {

    }



}
