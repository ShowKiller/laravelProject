<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CommonController;
use DB;
class AuthController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取管理员列表 (后期还需完善)
        
        $res = $this->getGroup();
        $data = [
            'lang' => $this->config
        ];
        return view('admin.auth.index')->with($data);
    }

  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加管理员
        $auth_group = DB::table('auth_group')->get();
        $data = [
            'info'      => 'null',
            'title'     => $this->config['add'].$this->config['admin'],
            'authGroup' => $auth_group,
            'lang'      => $this->config,
            'selected'  => 'null'
        ];
        return view('admin.auth.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->except(['_token','file','admin_id']);
        $res = DB::table('admin')->insert($data);
        if($res)
        {
            return ['code'=>1,'msg'=>'添加成功','url'=>'/admin/auth'];
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取用户组
        $auth_group = DB::table('auth_group')->get();
        $info = DB::table('admin')->where('admin_id','=',$id)->first();
        $data = [
            'info'      => json_encode($info,true),
            'title'     => $this->config['edit'].$this->config['admin'],
            'authGroup' => $auth_group,
            'lang'      => $this->config,
            'data'      => $info
        ];
        return view('admin.auth.edit')->with($data);
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

        if($request->isMethod('PUT'))
        {
            $data = $request->except(['_token','_method','file']);
            $map[] = ['admin_id','<>',$data['admin_id']];
            $where[] = ['admin_id','=',$data['admin_id']];

            if($data['username']){
                $map[] = ['username','=',$data['username']];
                $check_user = DB::table('admin')->where($map)->first();
                if ($check_user) {
                    return $result = ['code'=>0,'msg'=>'用户已存在，请重新输入用户名!'];
                }
            }
            if ($data['pwd']){
                $data['pwd']=md5($request->input('pwd'));
            }else{
                unset($data['pwd']);
            }
            // $msg = $this->validate($data,'app\admin\validate\Admin');
            // if($msg!='true'){
            //     return $result = ['code'=>0,'msg'=>$msg];
            // }
            $res = DB::table('admin')->where($where)->update($data);
            //后续补上
            // if( $data['admin_id'] == session('aid')){
            //     session('username',$data['username']);
            //     $avatar = $data['avatar']==''?'/static/admin/images/0.jpg':$data['avatar'];
            //     session('avatar',$avatar);
            // }
        }
        return $result = ['code'=>1,'msg'=>'管理员修改成功!','url'=>'/admin/auth'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = DB::table('admin')->where('admin_id','=',$id)->delete();
        if($res)
        {
            return ['code'=>1,'msg'=>'删除成功'];
        }
    }

    //修改用户状态
    public function status(Request $request)
    {

        $id = $request->input('id');
        $is_open=$request->input('is_open');

        if (empty($id)){
            $result['status'] = 0;
            $result['info'] = '用户ID不存在!';
            $result['url'] = '/admin/auth/index';
            return $result;
        }
        $res = DB::table('admin')->where('admin_id','=',$id)->update(['is_open'=>$is_open,'update_time'=>time()]);
        if($res)
        {
            $result['status'] = 1;
            $result['info'] = '用户状态修改成功!';
            $result['url'] = '/admin/auth/index';
            return $result;
        }
         $result['status'] = 0;
        $result['info'] = '未知错误!';
        $result['url'] = '/admin/auth/index';
        return $result;
    }
    public function Del()
    {

    }
    /**
     * 展示所有用户信息
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function apishow(Request $request)
    {
        //
        if($request->ajax())
        {
            $res = $this->getGroup();
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$res,'rel'=>1];
        }
    }

    private function getGroup()
    {
        return DB::table('admin')->leftjoin('auth_group','admin.group_id','=','auth_group.group_id')->get();
    }

    //获取管理员分组信息
    public function group()
    {
        if($request->ajax())
        {
            $res = $this->getGroup();
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$res,'rel'=>1];
        }
    }
}
