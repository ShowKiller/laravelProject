<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
class ApiController extends Controller
{
    //普通图片上传请求
    public function uploadPic(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$file = $request->file('file');
    		if($file->isValid())
    		{
	    		$originalName = $file->getClientOriginalName(); // 文件原名
	            $ext = $file->getClientOriginalExtension();     // 扩展名
	            $realPath = $file->getRealPath();   //临时文件的绝对路径
	            $type = $file->getClientMimeType();     // image/jpeg
    			//上传文件
    			$filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
    			$bool = $request->file('file')->store('public/showKiller');
    			//2种上传的方法都可以
    			// $bool = Storage::disk('public')->put($filename,file_get_contents($realPath));
    			// 替换图片路径  yx这个可以根据需求来做改变
    			$bool = str_replace('public/showKiller', '/storage/showKiller', $bool);
				if($bool)
				{
					$data = [
						'code' => '1',
						'info' => '图片上传成功!',
						'url'  => $bool
					];
					return $data;
				}else
				{
					$result['code'] =0;
		            $result['info'] =  '图片上传失败!';
		            $result['url'] = '';
		            return $result;
				}              
    		}
    	}
    	print_r($_FILES);
    	print_r($_POST);exit;
    }
    
}
