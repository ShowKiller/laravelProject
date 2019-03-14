<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\Config;

class CommonController extends Controller
{
    //公共文件
    protected $config;

    public function __construct()
    {
    	$config = new ConfigController();
        $this->config = $config->index();
    }

    //公共普通上传图片
    public function uploadPic(Request $request)
    {
    	if($request->isMethod('post'))
        {
        	print_r($_POST);exit;
        }
    }
    
}
