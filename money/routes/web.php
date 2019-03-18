<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// //自定义路由
// Route::get('/user','IndexController@index');

// //获取环境配置
// Route::get('env',function(){
//     var_dump(env('APP_DEBUG'));
//     var_dump(env('DB_HOST'));
// });

// //获取网站配置
Route::get('conf',function(){
    //读取系统配置
    // dd(Config('app'));
    //读取系统的时间配置
    //读取邮件配置
    // dd(Config('mail'));
    // Config(['app.debug' => true]);
    // dd(Config('app.debug'));
    // echo date('Y-m-d H:i:s');exit;
    // print_r(date('Y-m-d H:i:s'));
});


//基本路由
// Route::get('jbly',function(){
//     echo '这是一个基本路由';
// });

//静态文件路由
// Route::get('jbly1',function(){
//     return view('xxx');
// });

// //控制器路由
// Route::get('jb2','JbController@index');

// //登录页面
// Route::get('/login','LoginController@index');
// //登录请求页面
// Route::post('check','LoginController@check');
// //put 请求
// Route::get('putWeb','LoginController@putWeb');

// //put 处理页面
// Route::put('put','LoginController@put');
//资源路由
// Route::resource('Admin','IndexController');
//带参数路由
// Route::get('index/{id}',function($id)
// {
//     echo $id;
// });
// //带多个参数路由
// Route::get('index/{id}/{iid}',function($id,$iid)
// {
//     echo $id;
//     echo $iid;
// });
// //带可选参数路由 有默认值
// Route::get('index/{id?}',function($id = '默认值')
// {
//     echo $id;
// });
// //带参数访问控制器   只要方法参数一一对应就可拿到数据
// Route::get('index/{id}/{sd}','IndexController@cxz');

// //路由器起别名
// Route::get('abc','IndexController@asd')->name('noe');
// //使用方法 在控制器中的方法打印  route('noe);  会出现 abc的路由
// //通过命名路由  实现重定向
// // return redirect()->route('noe');  会跳转到 abc的路由

//路由组

//命名空间使用
//后台
// Route::namespace('Admin')->prefix('admin')->group(function()
// {
//     Route::get('/',function(){
//     	echo 123;exit;
//     });

// });
// ,'middleware' => 'login'
Route::get('/admin/login','Admin\LoginController@index');
Route::group(['namespace' => 'Admin','prefix' => 'admin','middleware' => 'login'],function(){
    //首页路由
    Route::get('/','IndexController@index');
    //主体路由
    Route::get('/main','IndexController@main');
    //用户资源路由
    Route::resource('user','UserController');
    //用户商品管理模块
    Route::resource('goods','GoodsController');
    //后台首页内容
    Route::get('/welcome','IndexController@welcome');
    //配置文件
    Route::get('config','ConfigController@index');
    //系统设置
    Route::resource('/system','SystemController');
    //管理员页面
    Route::resource('/auth','AuthController');
    //管理员渲染页面
    Route::post('/auth/apishow','AuthController@apiShow');
    // Route::resource('admin/user','UserController');
});
//登录路由
//操作路由
Route::post('/admin/check','Admin\LoginController@check');
//请求
Route::get('request','RequestController@index');
//前台
// Route::group(['namespace' => 'Home','prefix' => 'home'],function(){
//     Route::get('/','IndexController@index');
// });
// Route::get('/admin/index','Admin\IndexController@index');
// Route::get('/','IndexController@index');
// Route::get('/','IndexController@index');

//前台路由
// Route::group()
Route::get('/','IndexController@index');
