<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Support\Facades\Event;
use PDO;
use DB;

class IndexController extends CommonController
{
    protected $adminRules;
    //后台框架
    public function index()
    {
        //加载配置文件
        //声明数组
        $menus = [];
        $authRule = DB::table('auth_rule1')->where('menustatus','=',1)->orderBy('sort','asc')->get();

        
        foreach ($authRule as $key=>$val){
            // $authRule[$key]['href'] = url($val['href']);
            if($val->pid == 0){
                $menus[] = $val;
            }
        }
        foreach ($menus as $k=>$v){
            foreach ($authRule as $kk=>$vv){
                if($v->id == $vv->pid){
                    $menus[$k]->children[] = $vv;
                }
            }
        }
        $menus = json_encode($menus,true);
        $data = [
            'menus' => $menus,
            'lang'  => $this->config
        ];
        return view('admin.index')->with($data);
    }

    //后台内容页面
    public function welcome()
    {
    	return view('admin.welcome');
    }

    //主体路由
    public function main()
    {
        return view('admin.common.main');
    }

    private function object_array($array) {  
        if(is_object($array)) {  
            $array = (array)$array;  
         } if(is_array($array)) {  
             foreach($array as $key=>$value) {  
                 $array[$key] = $this->object_array($value);  
                 }  
         }  
         return $array;  
    }
}
