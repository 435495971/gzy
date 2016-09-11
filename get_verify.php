<?php
require('curl.php');
session_start();
$result=get_Web_Page('http://210.38.108.23/');
preg_match('/Set-Cookie:(.*);/iU',$result['header'],$str);
$cookie = $str[1];
$_SESSION['cookie']=$cookie;
if(!preg_match('/id="verifyDiv" style="display:none;"/iU',$result['content'],$str)){
	$_SESSION['verify']=true;
	$img=get_img('http://210.38.108.23/yzm?d='.time(),$cookie);	
}
else{
	$img=get_img('http://119.29.238.68/gzy/no_verify.png');
	$_SESSION['verify']=false;
}
echo $img['content'];
?>
