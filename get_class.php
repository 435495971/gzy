<?php
session_start();
require('curl.php');
$cookie=$_SESSION['cookie'];
{
	$url='http://210.38.108.23/xsbjkbcx!getKbRq.action?xnxqdm=20152&zc=1';
	$result=get_Web_Page($url,$cookie);
	$result=json_decode($result['content']);
}
$tmp=array();
$key=0;
foreach ($result[0] as $value) {
	$num=intval($value->xq)*100000000+intval($value->jcdm);
	$tmp[$num]=$value;
}
ksort($tmp);
$result[0]=$tmp
echo '</br></br>';
echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>