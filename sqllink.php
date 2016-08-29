<?php
$dbhost='119.29.238.68:3306';
$dbuser='root';
$dbpswd='root';
$dbname='gzy';
//$link=new mysqli($dbhost,$dbuser,$dbpswd,$dbname);
//$link->query("SET NAMES UTF8");
class sqllink{
	var  $links;
	function sqllink($dbhost,$dbuser,$dbpswd,$dbname){
		$this->links=new mysqli($dbhost,$dbuser,$dbpswd,$dbname);
		$this->links->query("SET NAMES UTF8");
	}
	function __destruct(){
		$this->links->close();
	}
	function select($from_tablename,$from_cols_name,$toget_cols='*',$orderby='',$top=0,$each=30){
			$where='';
			if(isset($from_cols_name) and $from_cols_name != 1)
			$where=$this->build_where($from_cols_name);
			else $where=' 1 = 1 ';
			$sql='SELECT  ' . $toget_cols .  ' FROM ' . $from_tablename . '  WHERE ' .$where;
			if($orderby != '')
			$sql.=' ORDER BY '.$orderby;
				$sql.=(' LIMIT '.$top.','.$each);
			$result=$this->links->query($sql);
			return $result;
	}
	function update($from_tablename,$name_value,$Toupdate_cols_name){
		$where='';
		$where=$this->build_where($Toupdate_cols_name);
		$set='';
		foreach ($name_value as $key => $value) {
				if($set==''){
					$set.=( $key.(is_numeric($value)?' = '.$value:' = \''.$value.'\'' ) );
				}
				else
					$set.=(','.$key. (is_numeric($value)?' = '.$value:' = \''.$value.'\'' ) );	
		}	
		$sql='UPDATE '.$from_tablename.' SET '.$set. ' WHERE '.$where.' ';
		$result=$this->links->query($sql);
		return $result;

	}
	function insert($from_tablename,$name_value){
			$col_name='';
			$col_value='';
			foreach ($name_value as $key => $value) {
				if ($col_name != '' and $col_value != ''){
					$col_name.=( ','.$key);
					$col_value.=( is_numeric($value)? ','.$value : ',\''.$value.'\'' );
				}
				else{
						$col_name=  '('.$key;
						$col_value=' VALUES(' .( is_numeric($value) ? $value :'  \''.$value.'\'' );
				}
		}
			/*
			while(current($name_value)){
				if ($col_name != '' and $col_value != ''){
						$col_name.=( ','.key($name_value) );
						$col_value.=(is_numeric(current($name_value))? ','.current($name_value):' ,\''.current($name_value).'\'' );
				}else{
						$col_name='('.key($name_value);
						$col_value=' VALUES(' .(is_numeric(current($name_value))? current($name_value):'  \''.current($name_value).'\'' );
				}
					next($name_value);
			}
			*/
			$sql='INSERT INTO '.$from_tablename.$col_name. ') '.$col_value.') ';
			//echo $sql;
			$result=$this->links->query($sql);
			return $result;
	}
	function delete($from_tablename,$from_cols_name){
			$wheres='';
			$wheres=$this->build_where($from_cols_name);
			$sql='DELETE FROM '.$from_tablename.' WHERE '.$wheres;
			$result=$this->links->query($sql);
			return $result;
	}
	function add($from_tablename,$name_value){
			$result=$this->insert($from_tablename,$name_value);
			$id=$this->select($from_tablename,$name_value);
			$id=$id->fetch_row();
			$id=$id[0];
			$result=$this->update($from_tablename,array('uid'=>$id),array('id'=>$id));
			return $result;
	}

	function get_insert_id(){
		return mysqli_insert_id($this->links);
	}
	protected function build_where($name_value=array('name'=>array(1,'='))){
		$where='';
		if(count($name_value!=0)){
			foreach ($name_value as $key => $value) {
					$type='=';
					if(is_array($value)){
										if(count($value)!=1){
											 $value[1]=strtoupper($value[1]);
											switch($value[1]){
												case '=':$type='=';break;
												case '>=':$type='>=';break;
												case '<=':$type='<=';break;
												case '!=':$type='!=';break;
												case 'LIKE':$type='LIKE';break;
												default:$type='=';break;
											}
										}
										if ($where != ''){
											$where.= (' AND '.$key. (is_numeric($value[0]) ? ' '.$type.' '.$value[0]  : ' '.$type. ' \''.$value[0].'\'' ) );
										}
										else {
											$where.= ( $key . (is_numeric($value[0])? ' '.$type.' '.$value[0] : ' '.$type.' \''.$value[0] .'\' ')) ;
										}
									}
					else{
							if ($where != ''){
								$where.= (' AND '.$key. (is_numeric($value) ? ' '.$type.' '.$value  : ' '.$type. ' \''.$value.'\'' ) );
							}
							else {
								$where.= ( $key . (is_numeric($value)? ' '.$type.' '.$value : ' '.$type.' \''.$value .'\' ')) ;
							}
					}
				
			}
		}
		return $where;
	}
}
global $link;
$link=new sqllink($dbhost,$dbuser,$dbpswd,$dbname);
?>
