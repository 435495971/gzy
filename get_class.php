<?php
session_start();
require('curl.php');
if(!isset($_POST['year']))
	$_POST['year']="20161";
$cookie=$_SESSION['cookie'];
{
	$url='http://210.38.108.23/xsgrkbcx!getKbRq.action?xnxqdm='.$_POST['year'].'&zc='.$_POST['week'];
	$result=get_Web_Page($url,$cookie);
	$result=json_decode($result['content']);
	$date=$result[1];
	$class=$result[0]; 
	$result=array();
	foreach ($date as $value) {
		$result[$value->xqmc]['date']=$value;
	}
	foreach ($class as $value) {
		$v=new stdClass();
		$v->jcdm=$value->jcdm;
		$v->classname=$value->kcmc;
		$v->teachername=$value->teaxms;
		$v->dayinweek=$value->xq;
		$v->address=$value->jxcdmc;
		$v->content=$value->sknrjj;
		$v->lengthoftime=strlen($value->jcdm)/2;
		$v->style=$value->jxhjmc;
		$result[$value->xq]['class'][]=$v;
	}
	$newresult=array();
	$k=0;
	foreach ($result as  $xq){
		$k++;
		if($k==1 && $xq['date']->xqmc==1){
		$time=$xq['date']->rq;
		$re=strtotime($time)-60*60*24;
		$date=new stdClass();
		$date->xqmc='7';
		$date->rq=date('y-m-d',$re);
		$newresult['key'.$k]['date']=$date;
		$k++;
		}
		for($i=0;$i<count(@$xq['class']);$i++){
			$key=$i;
			for($j=$i;$j<count($xq['class']);$j++){
				if($xq['class'][$key]->jcdm > $xq['class'][$j]->jcdm)
					$key=$j;
			}
			if($key!=$i){
				$tmp=$xq['class'][$i];
				$xq['class'][$i]=$xq['class'][$key];
				$xq['class'][$key]=$tmp;
			}
		}
		$newresult['key'.$k]=$xq;
	}

	$newresult['length']=count($newresult);
	echo json_encode($newresult,JSON_UNESCAPED_UNICODE);
}
?>