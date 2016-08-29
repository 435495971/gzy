<?php
session_start();
require('curl.php');
$cookie=$_SESSION['cookie'];
$post['account']=$_POST['username'];
$post['pwd']=$_POST['password'];
if($_SESSION['verify'])
	$post['verifycode']=$_POST['verifycode'];
else
	$post['verifycode']="";
$result=request_post('http://210.38.108.23/login!doLogin.action',$post,$cookie);
$result=json_decode($result['content']);
if($result->status == 'y')
	echo "成功登录";
?>