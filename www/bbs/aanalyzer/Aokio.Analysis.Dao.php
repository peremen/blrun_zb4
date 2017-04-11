<?php
require_once 'Aokio.Analyze.Parent.Dao.php';

class AokioAnalysisDao extends AokioAnalyzeParentDao{

	//Constructor
	function AokioAnalysisDao(){
		parent::AokioDao();
	}

	function getAnalyzeLimitListInfo($target,$start,$list_per_page,$order_option,$order_type,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT * ";
			$sql .= " FROM aokio_analyze_$target ";
			$sql .= " ORDER BY $order_option $order_type  ";
			$sql .= " LIMIT $start,$list_per_page";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,false, $db);
	}

	function getAnalyzeInfoTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT count(*) total_counts ";
			$sql .= " FROM aokio_analyze_$target ";
			$sql .= " WHERE 1";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,array(), $db);
	}



	function getSevenDaysCounts($time_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT day , today ";
			$sql .= " FROM aokio_log_time ";
			$sql .= " WHERE year=? and month=? and day <=? and day >=? ";
			$sql .= " and target = ?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,$time_info, $db);
	}

	//======================================
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getOSInfo($target,$total_os_counts , $db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *,os_category as items,round(100*counts/$total_os_counts,2) percentage  ";
			$sql .= " FROM aokio_log_os  ";
			$sql .= " WHERE target = '$target' ";
			$sql .= " ORDER BY counts DESC , os_full_name";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}


	function getOSCountsMiscInfo($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_os_counts ,min(counts) min_os_counts, ";
			$sql .= " avg(counts) avg_os_counts , sum(counts) total_os_counts ";
			$sql .= " FROM aokio_log_os  ";
			$sql .= " WHERE target = '$target' ";
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
	function getOSCategoryInfo($target,$total_os_counts , $db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT os_category as os_full_name, sum(counts) as counts , ";
			$sql .= " round(100*sum(counts)/$total_os_counts,2) percentage  ";
			$sql .= " FROM aokio_log_os  ";
			$sql .= " WHERE target = '$target' ";
			$sql .= " GROUP by os_category ";
			$sql .= " ORDER BY counts DESC , os_category";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}


	function getOSCategoryCountsMiscInfo($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(counts) as os_category_counts ";
			$sql .= " FROM aokio_log_os  ";
			$sql .= " WHERE target = '$target' ";
			$sql .= " GROUP by os_category ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}
	//======================================

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getBrowserInfo($target,$total_browser_counts ,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *,browser_full_name as items , round(100*counts/$total_browser_counts,2) percentage  ";
			$sql .= " FROM aokio_log_browser ";
			$sql .= " WHERE target = '$target' ";
			$sql .= " ORDER BY counts DESC ,browser_full_name";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}

	function getBrowserCountsMiscInfo($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_browser_counts ,min(counts) min_browser_counts, ";
			$sql .= " avg(counts) avg_browser_counts , sum(counts) total_browser_counts ";
			$sql .= " FROM aokio_log_browser  ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,array() , $db);
	}
	function getBrowserCategoryCountsMiscInfo($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(counts) as browser_category_counts ";
			$sql .= " FROM aokio_log_browser  ";
			$sql .= " WHERE target = '$target' ";
			$sql .= " Group by browser_category ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getBrowserCategoryInfo($target,$total_browser_counts , $db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT browser_category as browser_full_name, sum(counts) as counts,";
			$sql .= " round(100*sum(counts)/$total_browser_counts,2) percentage  ";
			$sql .= " FROM aokio_log_browser  ";
			$sql .= " WHERE target = '$target' ";
			$sql .= " GROUP by browser_category ";
			$sql .= " ORDER BY counts DESC , browser_category";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getYearTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(today) total_year_counts  ";
			$sql .= " FROM aokio_log_time  ";
			$sql .= " WHERE target = '$target' ";
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
	function getMonthTotalCounts($month_arr,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(today) total_month_counts  ";
			$sql .= " FROM aokio_log_time  ";
			$sql .= " WHERE target = ? and year=?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,$month_arr , $db);
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getDayTotalCounts($day_arr,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(today) total_day_counts  ";
			$sql .= " FROM aokio_log_time  ";
			$sql .= " WHERE target = ? and year=? and month=?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,$day_arr , $db);
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getMaxDay($day_arr,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(today) max_day_counts  ";
			$sql .= " FROM aokio_log_time  ";
			$sql .= " WHERE target = ? and year=? and month=?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,$day_arr , $db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getTodaysCounts($info_arr,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT today  ";
			$sql .= " FROM aokio_log_time ";
			$sql .= " WHERE target=? and year=? and month=? and day=? ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,$info_arr , $db);
	}


	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getLanguageInfo($target,$total,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT * ,language as items,round(100*counts/$total,2) percentage ";
			$sql .= " from aokio_log_language ";
			$sql .= " WHERE target ='$target'";
			$sql .= " ORDER BY counts DESC";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getLanguageTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(counts) total";
			$sql .= " from aokio_log_language ";
			$sql .= " WHERE target ='$target'";
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
	function getMaxLanguage($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_counts";
			$sql .= " from aokio_log_language ";
			$sql .= " WHERE target ='$target'";
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
	function getNationInfo($target,$total ,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *,nation as items,round(100*counts/$total,2) percentage ";
			$sql .= " from aokio_log_nation";
			$sql .= " WHERE target ='$target'";
			$sql .= " ORDER BY counts DESC";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getNationTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(counts) total";
			$sql .= " from aokio_log_nation ";
			$sql .= " WHERE target ='$target'";
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
	function getMaxNation($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_counts";
			$sql .= " from aokio_log_nation ";
			$sql .= " WHERE target ='$target'";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,array() , $db);
	}

	//======================================

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getCityInfo($target,$total ,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *,city as items,round(100*counts/$total,2) percentage ";
			$sql .= " from aokio_log_city";
			$sql .= " WHERE target ='$target'";
			$sql .= " ORDER BY counts DESC";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getCityTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(counts) total";
			$sql .= " from aokio_log_city ";
			$sql .= " WHERE target ='$target'";
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
	function getMaxCity($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_counts";
			$sql .= " from aokio_log_city ";
			$sql .= " WHERE target ='$target'";
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
	function getRefererServerInfo($target,$total ,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *,refererserver as items,round(100*counts/$total,2) percentage ";
			$sql .= " from aokio_log_refererserver";
			$sql .= " WHERE target ='$target'";
			$sql .= " ORDER BY counts DESC";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getRefererServerTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(counts) total";
			$sql .= " from aokio_log_refererserver ";
			$sql .= " WHERE target ='$target'";
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
	function getMaxRefererServer($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_counts";
			$sql .= " from aokio_log_refererserver ";
			$sql .= " WHERE target ='$target'";
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
	function getRefererInfo($target,$total ,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *,referer as items,round(100*counts/$total,2) percentage ";
			$sql .= " from aokio_log_referer";
			$sql .= " WHERE target ='$target'";
			$sql .= " ORDER BY counts DESC";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getRefererTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(counts) total";
			$sql .= " from aokio_log_referer ";
			$sql .= " WHERE target ='$target'";
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
	function getMaxReferer($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_counts";
			$sql .= " from aokio_log_referer ";
			$sql .= " WHERE target ='$target'";
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
	function getScreensizeInfo($target,$total ,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *,screensize as items,round(100*counts/$total,2) percentage ";
			$sql .= " from aokio_log_screensize";
			$sql .= " WHERE target ='$target'";
			$sql .= " ORDER BY counts DESC";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getScreensizeTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(counts) total";
			$sql .= " from aokio_log_screensize ";
			$sql .= " WHERE target ='$target'";
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
	function getMaxScreensize($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_counts";
			$sql .= " from aokio_log_screensize ";
			$sql .= " WHERE target ='$target'";
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
	function getResolutionInfo($target,$total ,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *,resolution as items,round(100*counts/$total,2) percentage ";
			$sql .= " from aokio_log_resolution";
			$sql .= " WHERE target ='$target'";
			$sql .= " ORDER BY counts DESC";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getResolutionTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(counts) total";
			$sql .= " from aokio_log_resolution ";
			$sql .= " WHERE target ='$target'";
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
	function getMaxResolution($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_counts";
			$sql .= " from aokio_log_resolution ";
			$sql .= " WHERE target ='$target'";
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
	function getSearchKeywordInfo($target,$total_keyword_counts ,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *,keyword as items , round(100*counts/$total_keyword_counts,2) percentage  ";
			$sql .= " from aokio_log_search_keywords ";
			$sql .= " WHERE target = '$target' ";
			$sql .= " ORDER BY counts DESC ,keyword";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}

	function getSearchKeywordCountsMiscInfo($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_keyword_counts ,min(counts) min_keyword_counts, ";
			$sql .= " avg(counts) avg_keyword_counts , sum(counts) total_keyword_counts ";
			$sql .= " from aokio_log_search_keywords  ";
			$sql .= " WHERE target = '$target' ";
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
	function getSearchSiteInfo($target,$total_keyword_counts ,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *,searchsite as items , round(100*counts/$total_keyword_counts,2) percentage  ";
			$sql .= " from aokio_log_search_sites ";
			$sql .= " WHERE target = '$target' ";
			$sql .= " ORDER BY counts DESC ,searchsite";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}

	function getSearchSiteCountsMiscInfo($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_search_sites_counts ,min(counts) min_search_sites_counts, ";
			$sql .= " avg(counts) avg_search_sites_counts , sum(counts) total_search_sites_counts ";
			$sql .= " from aokio_log_search_sites  ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,array() , $db);
	}

	//======================================


	function getRobotAccessInfo($target ,$total,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT * ,useragent as items , round(100*counts/$total,2) percentage ";
			$sql .= " from aokio_log_robot ";
			$sql .= " WHERE target ='$target' ";
			$sql .= " ORDER BY counts DESC ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array() , $db);
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getRobotTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT sum(counts) total_robot_counts ";
			$sql .= " from aokio_log_robot  ";
			$sql .= " WHERE target = '$target' ";
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
	function getMaxRobot($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT max(counts) max_robot_counts  ";
			$sql .= " from aokio_log_robot  ";
			$sql .= " WHERE target = '$target' ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,array() , $db);
	}

	function getRobotDetailInfo($target,$start,$list_per_page,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_robot_$target ";
			$sql .= " ORDER BY no DESC  ";
			$sql .= " LIMIT $start,$list_per_page";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioList($sql,array(), $db);
	}


	function getRobotDetailInfoTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT count(*) total_counts  ";
			$sql .= " from aokio_robot_$target ";
			$sql .= " WHERE 1";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this -> getAokioInfo($sql,array(), $db);
	}



	function setBookmarkAnalyzeInfo($no,$target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_analyze_$target ";
			$sql .= " SET bookmark = 1 ";
			$sql .= " WHERE no=$no ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->modifyAokioInfo($sql,array(),$db);
	}


	function clearBookmarkAnalyzeInfo($no,$target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_analyze_$target ";
			$sql .= " SET bookmark = 0 ";
			$sql .= " WHERE no=$no ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,array(),$db);
	}

	function getAnalyzeInfoBookmarkTotalCounts($target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT count(*) total_counts  ";
			$sql .= " from aokio_analyze_$target ";
			$sql .= " WHERE bookmark = 1";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		return $this -> getAokioInfo($sql,array(), $db);
	}

}
?>