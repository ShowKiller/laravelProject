<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
use DB;
class UserController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //ajax请求
        if($request->ajax())
        {
            $info = DB::table('auth_group')->get();
            foreach ($info as $key => $value) 
            {
                $info[$key]->addtime = dateTime($value->addtime);   
            }

            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$info,'rel'=>1];
        }else
        {
            //查询用户组
            
            $data = [

                'lang' => $this->config

            ];
            return view('admin.user.index')->with($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加用户组
        $data = [

                'lang' => $this->config

            ];
        return view('admin.user.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $data['addtime'] = time();
        $data['status'] = 1;
        $res = DB::table('auth_group')->insert($data);
        if($res)
        {
            return ['code' => 1, 'msg' => '用户组添加成功', 'url' => '/admin/user'];
        }

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
        //查询用户名
        $where[] = ['group_id','=',$id];
        $info = DB::table('auth_group')->where($where)->first();
        $data = [
            'title' => '编辑用户组',
            'info'  => json_encode($info,true),
            'data'  => $info,
            'lang'  => $this->config
        ];

        return view('admin.user.edit')->with($data);
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
        $data = $request->except(['_token','_method','']);
        $res= DB::table('auth_group')->where('group_id','=',$id)->update($data);
        if($res)
        {
            return $data = ['code' => 1,'msg' => '修改成功','url' => '/admin/user'];
            // $data,true);exit;
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
        $where[] = ['group_id','=',$id];
        $res = DB::table('auth_group')->where($where)->delete();
        if($res)
        {
            return $result = ['code'=>1,'msg'=>'删除成功!'];
        }
    }
    public function ruleshow(Request $request, $id)
    {
        if($request->ajax())
        {

        }else
        {
            $where[] = ['group_id','=',$id];
            $user = DB::table('auth_group')->where($where)->first();
            $rule = DB::table('auth_rule1')->get();
            $parent_id = explode(',', $user->rules);
            $res = authNav($rule, 0, $parent_id);
            $res[] = [
                "id"=>0,
                "pid"=>0,
                "title"=>"全部",
                "open"=>true
            ];
            $data = [
                'lang' => $this->config,
                'data' => json_encode($res,true),
                'id'   => $id
            ];
            return view('admin.user.rule')->with($data);
        }
    }
    public function editrule(Request $requset, $id)
    {
        $data = $requset->except(['_token']);
        $where[] = ['group_id','=',$id];
        $res= DB::table('auth_group')->where($where)->update($data);
        if($res)
        {
            return ['code' => 1, 'msg' => '修改成功', 'url' => '/admin/user'];
        }
    }
}
