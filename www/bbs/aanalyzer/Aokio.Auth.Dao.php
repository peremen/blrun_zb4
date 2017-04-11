<?php
require_once 'Aokio.Dao.class.php';

class AokioAuthDao extends AokioDao{

	function AokioAuthDao(){
		parent::AokioDao();
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function isExistAdminInfo($user_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_admin ";
			$sql .= " WHERE id=? and password = ?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		return $this->getAokioCounts($sql,$user_info,$db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getAdminInfo($db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_admin ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this->getAokioInfo($sql,array(),$db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function insertAdmin($user_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_admin ";
			$sql .= " (id,password,language ) ";
			$sql .= " values(?,?,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		return $this->insertAokioInfo($sql,$user_info,$db);
	}
}
?>