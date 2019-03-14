<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
use DB;

class SystemController extends CommonController
{
    //系统设置页面
    public function index()
    {	
    	$res = DB::table('system')->where('id', 1)->first();
    	$system = json_encode($res,true);
    	$data = [
    		'lang' => $this->config,
    		'system' => $system
    	];

    	return view('admin.system.index')->with($data);
    }
    //post更新数据
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            //这里应该加vaildate过滤字符串
            $info = $request->all();
            unset($info['_token']);
            unset($info['file']);
            $info['update_time'] = time();
            $res = DB::table('system')->where('id','=', 1)->update($info);
            if($res > 0)
            {
                $data = [
                    'code' => 1,
                    'msg' => '更新成功',
                    'url' => '/admin/system'
                ];
            }else
            {
                $data = [
                    'code' => 0,
                    'msg' => '更新失败',
                    'url' => '/admin/system'
                ];
            }
            echo json_encode($data,true);exit;
        }
    }
    public function show()
    {

    }
}
