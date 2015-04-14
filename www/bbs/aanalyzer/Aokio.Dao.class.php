<?php
ini_set("include_path",dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'lib');
require_once "DB.php";
class AokioDao {
	var $dsn ;
	var $options;
	var $db_fetch_mode;

	var $php_type_for_db_variation;
	
	function AokioDao(){
		$this -> getDBInfo();
	}

	function getDBInfo(){
		include dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'config.php';
		$this ->dsn = array(
						'phptype'	=> $phptype,
						'username'	=> $username,
						'password'	=> $password,
						'hostspec'	=> $hostspec,
						'database'	=> $database);
		$this ->options = array(	'debug' => 2,
									);
		$this ->db_fetch_mode = DB_FETCHMODE_ASSOC;
//		$this ->db_fetch_mode = DB_FETCHMODE_ORDERED;
//		$this ->db_fetch_mode = DB_FETCHMODE_OBJECT;

		$this->php_type_for_db_variation = $phptype;
	}


	function getConnection(){
		$db =& DB::connect($this ->dsn,$this->options);
		if (PEAR::isError($db)) {
			die($db->getMessage());
		}
		$db->setFetchMode($this -> db_fetch_mode);
		return $db;
	}
	
	function closeConnection($db,$commit_flag = false){
		if($commit_flag){
			$db->commit();
		}
		$db->disconnect();
	}

	function insertAokioInfo($sql,$arr,$db){
		$stmt = $db->prepare($sql);
		if (PEAR::isError($stmt)) {
			die($stmt->getMessage().$sql);
		}
		$res =& $db->execute($stmt,$arr);
		if (PEAR::isError($res)) {
			die($res->getMessage().$sql);
		}
	}

	function modifyAokioInfo($sql,$arr,$db){
		$this->insertAokioInfo($sql,$arr,$db);
	}


	function deleteAokioInfo($sql,$arr,$db){
		$this->insertAokioInfo($sql,$arr,$db);
	}


	function dropAokioInfo($sql,$arr,$db){
		$this->insertAokioInfo($sql,$arr,$db);
	}


	function truncateAokioInfo($sql,$arr,$db){
		$this->insertAokioInfo($sql,$arr,$db);
	}


	function createAokioInfo($sql,$db){
		$stmt = $db->prepare($sql);
		if (PEAR::isError($stmt)) {
			die($stmt->getMessage().$sql);
		}
		$res =& $db->execute($stmt);
		if (PEAR::isError($res)) {
			die($res->getMessage().$sql);
		}
	}

	function getAokioList($sql,$array=false,$db){
		if($array){
			$result =  $db->getAll( $sql ,$array);
		}else{
			$result =  $db->getAll( $sql );
		}
		if (PEAR::isError($result)) {
			die($result->getMessage().$sql);
		}
		return $result ;
	}

	
	function getAokioLimitList($sql,$start,$limit,$db){
		$result =& $db->limitQuery($sql, $start,$limit);

		if (PEAR::isError($result)) {
			die($result->getMessage().$sql);
		}
		return $result ;
	}

	function getAokioInfo($sql,$arr=false,$db){	
		$result =  & $db->getRow( $sql,$arr,DB_FETCHMODE_ASSOC);
		if (PEAR::isError($result)) {
			die($result->getMessage().$sql);
		}
		return $result ;
	}

	function getAokioCounts($sql,$array=false,$db){
		if($array){
			$result = & $db->query($sql,$array);
		}else{
			$result = & $db->query($sql);
		}
		if (PEAR::isError($result)) {
			die($result->getMessage().$sql);
		}
		$count = $result->numRows();
		return $count ;
	}
}
?>