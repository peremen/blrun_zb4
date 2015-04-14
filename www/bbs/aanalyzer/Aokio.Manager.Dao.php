<?php
require_once 'Aokio.Dao.class.php';

class AokioManagerDao extends AokioDao{

	function AokioManagerDao(){	
		parent::AokioDao();
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function updateAokioAnalyzerConfig($update_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_admin ";
			$sql .= " SET language = ?, menu_type =? ";
//			$sql .= " WHERE target=? ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->modifyAokioInfo($sql,$update_info,$db);
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function dropTargetAnalyzeTable($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DROP TABLE aokio_analyze_$target ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->dropAokioInfo($sql,array(),$db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */

	function dropTargetRobotTable($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DROP TABLE aokio_robot_$target ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->dropAokioInfo($sql,array(),$db);
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function truncateTargetRobotTable($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " TRUNCATE aokio_robot_$target";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->truncateAokioInfo($sql,array(),$db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function truncateTargetAnalyzeTable($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " TRUNCATE aokio_analyze_$target";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->truncateAokioInfo($sql,array(),$db);
	}


	function deleteTargetCofigInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_config ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function initiateTargetCofigInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_config ";
			$sql .= " SET total = 0,max=0,lists_per_page=10,access_check_pattern =0 ";
			$sql .= " ,access_check_pattern_input_time =0,check_admin_access =0 ";
			$sql .= " ,access_permission = NULL,target_name ='$target' ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}


	function deleteTargetOSLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_os ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function deleteTargetBrowserLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_browser ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function deleteTargetCityLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_city ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function deleteTargetLanguageLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_language ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function deleteTargetNationLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_nation ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function deleteTargetRobotLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_robot ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function deleteTargetTimeLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_time ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}


	function deleteTargetWeekLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_week ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function insertInitialWeekRecord($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql = " INSERT into aokio_log_week ";
			$sql .= " (target ) ";
			$sql .= " values('$target')";
	//		$sql .= " (target,w0,w1,w2,w3,w4,w5,w6 ) ";
	//		$sql .= " values(?,0,0,0,0,0,0,0)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->insertAokioInfo($sql,array(),$db);
	}


	function deleteTargetRefererServerLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_refererserver ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function deleteTargetRefererLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_referer ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function deleteTargetScreensizeLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_screensize ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function deleteTargetResolutionLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_resolution ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}


	function deleteTargetSearchKeywordsLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_search_keywords ";
			$sql .= " WHERE target = '$target' "; 
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}

	function deleteTargetSearchSiteLogInfos($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " DELETE FROM aokio_log_search_sites ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->deleteAokioInfo($sql,array(),$db);
	}
}
?>