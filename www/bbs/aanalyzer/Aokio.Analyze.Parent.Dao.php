<?php
require_once 'Aokio.Dao.class.php';

class AokioAnalyzeParentDao extends AokioDao{

	//Constructor
	function __construct(){
		parent::__construct();
	}


	function getWeekInfo($target,$db){
		if($this->php_type_for_db_variation ==="mysql" || $this->php_type_for_db_variation ==="mysqli"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_week ";
			$sql .= " WHERE target='$target'";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,array(), $db);
	}


	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getTimeInfo($target,$total_counts,$time_info,$option,$db){

		if($this->php_type_for_db_variation ==="mysql" || $this->php_type_for_db_variation ==="mysqli"){
			if($option ==="YEAR"){
				$sql  = " SELECT year ,year as items,sum(today) counts,round(100*sum(today)/$total_counts,2) percentage  ";
				$sql .= " from aokio_log_time ";
				$sql .= " WHERE target = '$target' ";
				$sql .= " GROUP BY year ";
				return $this -> getAokioList($sql,array() , $db);
			}elseif($option ==="MONTH"){
				$year = $time_info['year'];
				$sql  = " SELECT year,month ,month as items, sum(today) counts ";
				$sql .= " ,round(100*sum(today)/$total_counts,2) percentage ";
				$sql .= " from aokio_log_time ";
				$sql .= " WHERE target = '$target' and year = $year";
				$sql .= " GROUP BY month ";
				return $this -> getAokioList($sql,array() , $db);
			}elseif($option ==="DAY"){
				$year	= $time_info['year'];
				$month	= $time_info['month'];
				$sql  = " SELECT year , month ,day ,day as items, today counts ";
				$sql .= " ,round(100*today/$total_counts,2) percentage ";
				$sql .= " from aokio_log_time ";
				$sql .= " WHERE target = '$target' and year = $year and month = $month";
				return $this -> getAokioList($sql,array() , $db);
			}elseif($option ==="HOUR"){
				$year	= $time_info['year'];
				$month	= $time_info['month'];
				$day	= $time_info['day'];

				$sql  = " SELECT *  ";
				$sql .= " from aokio_log_time ";
				$sql .= " WHERE target = '$target' and year = $year ";
				$sql .= " and month =$month and day = $day ";
				return $this -> getAokioInfo($sql,false , $db);
			}
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

	}


	//======================================
	function getMaxCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql" || $this->php_type_for_db_variation ==="mysqli"){
			$sql  = " SELECT max  ";
			$sql .= " from aokio_log_config ";
			$sql .= " WHERE target='$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,array() , $db);
	}

	function getAokioLastInsertID($db){
		$last_post_id_sql = "select LAST_INSERT_ID()";
		$result = $this ->getAokioInfo($last_post_id_sql ,false,$db);
		return $result[0] ;
	}

}
?>