<?php
//get请求方式

function geturl($url){
    $headerArray =["Content-type:application/json;","Accept:application/json"];
    $ch = curl_init();//初始化
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); //路径是https请求方式 跳过证书认证
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//数据以字符串形式返回，不是直接输出到浏览器
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headerArray);//添加header头信息
    $output = curl_exec($ch);//执行
    curl_close($ch);//关闭
    $output = json_decode($output,true);//将json串转换为数组
    return $output;
}


//post请求方式
function posturl($url,$data){
    $data  = json_encode($data);    
    $headerArray =["Content-type:application/json;charset='utf-8'","Accept:application/json"];
    $curl = curl_init();//初始化
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
    curl_setopt($curl, CURLOPT_POST, 1);//设置post提交
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);//post提交表单数据
    curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    // print_r($output);die;
    //print_r(curl_errno($curl));die;
    curl_close($curl);
    return is_not_json($output)?$output:json_decode($output,true);
}

function is_not_json($str){
    return is_null(json_decode($str));
}

?>