<?php
/***************************************************************************
		                        Aokio.Dao.class.php
		                             -------------------
		    begin                :  March 02 2006
		    copyright           : (C) 2004 Aokio
		    email                : st.elmo@gmail.com

 ***************************************************************************/

/***************************************************************************
 *
 *
 ***************************************************************************/

require_once 'Aokio.Dao.class.php';

class AokioConfigDao extends AokioDao{

	function AokioConfigDao(){	
		parent::AokioDao();
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getApplicationConfigurationInfos($db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_admin ";
			$sql .= " WHERE 1 ";
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
	function getTargetConfigList($db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT * ";
			$sql .= " from aokio_log_config ";
			$sql .= " ORDER BY no ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array(), $db);
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getTargetConfigInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_config ";
			$sql .= " WHERE target='$target'";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,array() , $db);
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */

	function getTargetTodayCounts($target,$day_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT today  ";
			$sql .= " from aokio_log_time ";
			$sql .= " WHERE year=? and month=? and day=? ";
			$sql .= " and target='$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,$day_info, $db);
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function updateTargetConfigInfos($conf_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_config ";
			$sql .= " SET lists_per_page = ?,access_check_pattern = ?, check_admin_access =?";
			$sql .= " ,access_permission = ?,access_check_pattern_input_time=?,target_name = ?";
			$sql .= " ,portal_page = ?";
			$sql .= " WHERE target=? ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		
		$this->insertAokioInfo($sql,$conf_info,$db);
	}
}
?>