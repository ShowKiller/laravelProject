<?php
/**
 * author ShowKiller
 * createTime  2019年3月24日 18:22:15
 * description 公共函数
 */

/**
 * 格式化时间函数
 * @param  int $time 时间戳
 * @return date       时间
 */	
function dateTime($time)
{
	return date('Y-m-d H:i:s',$time);
}

function authNav($arr, $pid = 0, $rules)
{
	$tmp = [];
	foreach ($arr as $key => $value)
	{
		if($value->pid == $pid)
		{
			if(in_array($value->id, $rules))
			{
				$value->checked = true; 
			}
			$value->open = true;
			$tmp[] = $value;

			$tmp = array_merge($tmp, authNav($arr,$value->id,$rules));
		}
	}
	return $tmp;
}