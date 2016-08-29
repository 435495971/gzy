<?php
session_start();
require('curl.php');
$cookie=$_SESSION['cookie'];
{
	$url='http://210.38.108.23/xsbjkbcx!getKbRq.action?xnxqdm=20152&zc=1';
	$result=get_Web_Page($url,$cookie);
	echo $result['content'];
}

?>