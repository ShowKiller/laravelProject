<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\Config;
use DB;
class CommonController extends Controller
{
    //公共文件
    protected $config;
    protected $menu;

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
    /**
     * 查询栏目
     * @return [type] [description]
     */
    public function getMenus()
    {
        return $this->menu = DB::table('auth_rule1')->get();

    }
    /**
     * 无限极分类栏目
     * @param  [type] $menu [description]
     * @param  [type] $pid  [description]
     * @param  string $flag [description]
     * @return [type]       [description]
     */
    protected function comMenu($menu, $pid = 0, $num = 0, $flag = '|---')
    {
        static $tmp = [];
        foreach ($menu as $key => $value) 
        {
            if($value->pid == $pid)
            {   
                $newflag = str_repeat($flag,$num);
                $value->title = $newflag.$value->title;

                $tmp[] = $value;
                $this->comMenu($menu, $value->id, $num+1, $flag);
            }
        }
        return $tmp;
    }

    
}
