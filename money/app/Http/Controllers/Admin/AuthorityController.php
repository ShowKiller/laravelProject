<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
use DB;
class AuthorityController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            // $arr = cache('authRuleList');
            //添加缓存
            $list = DB::table('auth_rule1')->orderBy('pid','asc')->orderBy('sort','asc')->get();
            foreach ($list as $key => $value) 
            {
                $list[$key]->lay_is_open = false;
            }
            // if(!$arr){
            //     $arr = Db::name('authRule')->order('pid asc,sort asc')->select();
            //     foreach($arr as $k=>$v){
            //         $arr[$k]['lay_is_open']=false;
            //     }
            //     cache('authRuleList', $arr, 3600);
            // }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list,'is'=>true,'tip'=>'操作成功'];
        }

        $data = [
            'lang' => $this->config
        ];
        return view('admin.authority.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = DB::table('auth_rule1')->where('id','=',$id)->first();
        $data = [
            'lang' => $this->config,
            'info' => $info

        ];
        return view('admin.authority.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token','_method']);
        $res = DB::table('auth_rule1')->where('id','=',$id)->update($data);
        if($res !== false)
        {
            return ['code'=>1,'msg'=>'修改成功','url'=>'/admin/authority'];
        }else
        {
            return ['code'=>0,'msg'=>'修改失败','url'=>'/admin/authority'];

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //设置权限是否验证
    public function isVaildate(Request $request){
        $id = $request->input('id');

        $authopen=$request->input('authopen');
        if(DB::table('auth_rule1')->where('id','=',$id)->update(['authopen'=>$authopen]) !== false)
        {
            return ['status'=>1,'msg'=>'设置成功!'];
        }else{
            return ['status'=>0,'msg'=>'设置失败!'];
        }
        // if(db('auth_rule')->where('id='.$id)->update(['authopen'=>$authopen])!==false){
        //     // cache('authRule', NULL);
        //     // cache('authRuleList', NULL);
        //     // cache('addAuthRuleList', NULL);
        //     return ['status'=>1,'msg'=>'设置成功!'];
        // }else{
        //     return ['status'=>0,'msg'=>'设置失败!'];
        // }
    }
    /**
     * 修改开启关闭状态
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function state(Request $request)
    {
        $id = $request->input('id');
        $menustatus = $request->input('menustatus');
        $res = DB::table('auth_rule1')->where('id','=',$id)->update(['menustatus' => $menustatus]);
        if($res !== false)
        {
            return ['status'=>1,'msg'=>'设置成功'];
        }else
        {
            return ['status'=>0,'msg'=>'设置失败'];

        }
    }
    /**
     * 修改排序
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function order(Request $request)
    {
        $id = $request->input('id');
        $sort = $request->input('sort');
        $res = DB::table('auth_rule1')->where('id','=',$id)->update(['sort' => $sort]);
        if($res !== false)
        {
            return ['code'=>1,'msg'=>'设置成功','url'=>'/admin/authority'];
        }else
        {
            return ['code'=>0,'msg'=>'设置失败'];

        }
    }
}
