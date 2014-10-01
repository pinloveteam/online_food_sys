<?php
/* 135top订餐之单店版
 * 版本号：3.1版
 * 官网：http://www.135top.com
 * 2013-03-24
 */
class fun_base {
	// request 是否有值
	static function url_jump($url) {
		Header("Location:".$url); 
		exit;
	}

	/** 在已有链接基础上增加新：参数
	 *  url : 已有链接 , query : 新增参数，可为数组或字符串或带键名的数组
	 */
	static function url_add_query($url , $query) {
		$arr = parse_url($url);
		$new_url = '';
		if(isset($arr['scheme'])) $new_url .= $arr['scheme']."://";
		if(isset($arr['host'])) $new_url .= $arr['host'];
		if(isset($arr['path'])) $new_url .= $arr['path'];
		$arr_query = array( fun_format::url_query($query) );
		if(isset($arr['query'])) {
			$arr_query[] = $arr['query'];
		}
		$new_url .= "?" . implode("&" , $arr_query);
		return $new_url;
	}
	/* 提交post数据
	 * url : 提交的地址 , arr_data : 提交的数据数组 , arr_file : 上传的文件
	 */
	static function post($url, $arr_data = array() , $arr_file = array() ) {
		$ch = curl_init(); //初始化curl
		curl_setopt($ch, CURLOPT_URL, $url);//设置链接
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);//连接响应时间		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置是否返回信息
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//设置HTTP头
		curl_setopt($ch, CURLOPT_POST, true);//设置为POST方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $arr_data);//POST数据
		$response = curl_exec($ch);//接收返回信息
		if(curl_errno($ch)){//出错则显示错误信息
			return array("code" => 500 , "msg" => $ch);
		}
		curl_close($ch); //关闭curl链接
	    return array("code" => 0 , "cont" => $response);
	}
	static function array_remove($arr , $val) {
		if(!in_array($val , $arr)) return $arr;
		foreach($arr as $item => $key) {
			if($key == $val) unset($arr[$item]);
		}
		return $arr;
	}
}