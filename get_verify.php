<?php
require('curl.php');
session_start();
$result=get_Web_Page('http://jw.gzucm.edu.cn/');
preg_match('/Set-Cookie:(.*);/iU',$result['header'],$str);
$cookie = $str[1];
if(preg_match('/id="verifyDiv" style="display:none;"/iU',$result['content'],$str))
	$img=get_img('http://jw.gzucm.edu.cn/',$cookie);
else
	$img=get_img('http://119.29.238.68/wechat/no_verify.png')
echo $img['content'];
?>