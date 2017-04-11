<?php
require_once 'Aokio.Analyze.Parent.Dao.php';

class AokioAnalyzeDao extends AokioAnalyzeParentDao{

	//Constructor
	function AokioAnalyzeDao(){
		parent::AokioDao();
	}

	//======================================
	// 초기 접속시
	// 접속 정보 분석후 주 테이블에 기록
	function insertAnalyzeInfo($analyze_info,$target,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_analyze_$target ";
			$sql .= " (ip,referer,browser_name,browser_version,browser_build_date, ";
			$sql .= " browser_security,browser_type,browser_dom_info,browser_cookie_info,browser_javascript_info,";
			$sql .= " mozilla_flag,mozilla_version,";
			$sql .= " os_category,os_full_name,os_name,os_version,os_sp_info,os_net_frame,";
			$sql .= " processor_info,tablet_info,";
			$sql .= " useragent,screensize, resolution,mobile_flag,language,nation,regtime,year,month,day,hour,week,";
			$sql .= " nation_code,nation_code_3,city,language_info,via_proxy_flag,http_via_info,visit_count, ";
			$sql .= " latitude,longitude,isp) ";
			$sql .= " values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}
		$this->insertAokioInfo($sql,$analyze_info,$db);
	}

	//======================================
	function isExistOS($os_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_os ";
			$sql .= " WHERE os_category=? and os_full_name=? and target = ?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		return $this->getAokioCounts($sql,$os_info,$db);
	}

	function insertOS($os_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_os ";
			$sql .= " (os_category,os_full_name,counts,target ) ";
			$sql .= " values(?,?,1,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$os_info,$db);
	}

	function updateOS($os_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_os ";
			$sql .= " SET counts =counts +1 ";
			$sql .= " WHERE os_category = ? and os_full_name=? and target = ?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$os_info,$db);
	}


	//======================================

	function isExistBrowser($browser_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_browser ";
			$sql .= " WHERE browser_category=? and browser_full_name=? and target = ?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		return $this->getAokioCounts($sql,$browser_info,$db);
	}

	function insertBrowser($browser_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_browser ";
			$sql .= " (browser_category,browser_full_name,target,counts ) ";
			$sql .= " values(?,?,?,1)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$browser_info,$db);
	}

	function updateBrowser($browser_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_browser ";
			$sql .= " SET counts =counts +1 ";
			$sql .= " WHERE browser_category=? and browser_full_name=? and target = ?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$browser_info,$db);
	}

	//======================================
	function isExistTimeInfo($day_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_time ";
			$sql .= " WHERE year=? and month=? and day=? and target = ?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		return $this->getAokioCounts($sql,$day_info,$db);
	}

	function insertTimeInfo($time_info,$hour,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_time ";
			$sql .= " (year,month,day,h$hour ,target,today) ";
			$sql .= " values(?,?,?,1,?,1)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$time_info,$db);
	}

	function updateTimeInfo($time_info,$hour,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_time ";
			$sql .= " SET h$hour = h$hour +1 ,today = today +1";
			$sql .= " WHERE year=? and month = ? and day= ? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$time_info,$db);
	}



	function insertWeekInfo($target_arr,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_week ";
			$sql .= " (w0,w1,w2,w3 ,w4,w5,w6,target) ";
			$sql .= " values(0,0,0,0,0,0,0,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$target_arr,$db);
	}

	function updateWeekInfo($week,$target_arr,$start_flag,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_week ";

			if($start_flag){
				$wstart0 = 0;
				$wstart1 = 0;
				$wstart2 = 0;
				$wstart3 = 0;
				$wstart4 = 0;
				$wstart5 = 0;
				$wstart6 = 0;
				switch ($week) {
					case 0 :
						$wstart0 = 1;
						break;
					case 1 :
						$wstart1 = 1;
						break;
					case 2 :
						$wstart2 = 1;
						break;
					case 3 :
						$wstart3 = 1;
						break;
					case 4 :
						$wstart4 = 1;
						break;
					case 5 :
						$wstart5 = 1;
						break;
					case 6 :
						$wstart6 = 1;
						break;
				}
				$sql .= " SET ";
				$sql .= "   w_start_flag_0 = $wstart0 ";
				$sql .= "  ,w_start_flag_1 = $wstart1 ";
				$sql .= "  ,w_start_flag_2 = $wstart2 ";
				$sql .= "  ,w_start_flag_3 = $wstart3 ";
				$sql .= "  ,w_start_flag_4 = $wstart4 ";
				$sql .= "  ,w_start_flag_5 = $wstart5 ";
				$sql .= "  ,w_start_flag_6 = $wstart6 ";
				$sql .= "  ,w$week = w$week +1 ,w_this_$week = 1 , w_counts_$week = w_counts_$week+1";
	//		$sql .= " SET w$week = w$week +1,start_flag = 0 ";
			}else{
				$sql .= " SET w$week = w$week +1 ,w_this_$week = w_this_$week+1 ";

			}
			$sql .= " WHERE target=? ";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$target_arr,$db);
	}


	//======================================
	function isExistLanguage($language_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_language ";
			$sql .= " WHERE language=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this->getAokioCounts($sql,$language_info,$db);
	}


	function insertLanguage($language_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_language ";
			$sql .= " (language,counts,target ) ";
			$sql .= " values(?,1,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$language_info,$db);
	}

	function updateLanguage($language_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_language ";
			$sql .= " SET counts =counts +1 ";
			$sql .= " WHERE language=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$language_info,$db);
	}


	//======================================

	function isExistNation($nation_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_nation ";
			$sql .= " WHERE nation=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this->getAokioCounts($sql,$nation_info,$db);
	}

	function insertNation($nation_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_nation ";
			$sql .= " (nation,nation_code,nation_code_3,counts,target ) ";
			$sql .= " values(?,?,?,1,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$nation_info,$db);
	}

	function updateNation($nation_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_nation ";
			$sql .= " SET counts =counts +1 ";
			$sql .= " WHERE nation=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$nation_info,$db);
	}

	//======================================

	function isExistCity($city_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_city ";
			$sql .= " WHERE city=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this->getAokioCounts($sql,$city_info,$db);
	}

	function insertCity($city_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_city ";
			$sql .= " (city,counts,target ) ";
			$sql .= " values(?,1,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$city_info,$db);
	}

	function updateCity($city_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_city ";
			$sql .= " SET counts =counts +1 ";
			$sql .= " WHERE city=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$city_info,$db);
	}

	//======================================

	function isExistRefererServer($refererserver_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_refererserver ";
			$sql .= " WHERE refererserver=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this->getAokioCounts($sql,$refererserver_info,$db);
	}

	function insertRefererServer($refererserver_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_refererserver ";
			$sql .= " (refererserver,counts,target ) ";
			$sql .= " values(?,1,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$refererserver_info,$db);
	}

	function updateRefererServer($refererserver_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_refererserver ";
			$sql .= " SET counts =counts +1 ";
			$sql .= " WHERE refererserver=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$refererserver_info,$db);
	}


	function isExistReferer($refererserver_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_referer ";
			$sql .= " WHERE referer=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this->getAokioCounts($sql,$refererserver_info,$db);
	}

	function insertReferer($refererserver_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_referer ";
			$sql .= " (referer,counts,target ) ";
			$sql .= " values(?,1,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$refererserver_info,$db);
	}

	function updateReferer($refererserver_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_referer ";
			$sql .= " SET counts =counts +1 ";
			$sql .= " WHERE referer=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$refererserver_info,$db);
	}


	//======================================


	function isExistScreensize($screen_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_screensize ";
			$sql .= " WHERE screensize=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this->getAokioCounts($sql,$screen_info,$db);
	}

	function insertScreensize($screen_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_screensize ";
			$sql .= " (screensize,counts,target ) ";
			$sql .= " values(?,1,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$screen_info,$db);
	}

	function updateScreensize($screen_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_screensize ";
			$sql .= " SET counts =counts +1 ";
			$sql .= " WHERE screensize=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$screen_info,$db);
	}


	function isExistResolution($resolution_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_resolution ";
			$sql .= " WHERE resolution=? and bit=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this->getAokioCounts($sql,$resolution_info,$db);
	}

	function insertResolution($resolution_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_resolution ";
			$sql .= " (resolution,bit,counts,target ) ";
			$sql .= " values(?,?,1,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$resolution_info,$db);
	}

	function updateResolution($resolution_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_resolution ";
			$sql .= " SET counts =counts +1 ";
			$sql .= " WHERE resolution=? and bit=? and target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$resolution_info,$db);
	}

	//======================================

	function isExistSearchKeyword($search_keyword_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_search_keywords ";
			$sql .= " WHERE keyword=? and search_year=? and search_month=? and target = ?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		return $this->getAokioCounts($sql,$search_keyword_info,$db);
	}

	function insertSearchKeyword($search_keyword_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_search_keywords ";
			$sql .= " (keyword,search_year,search_month,target,counts ) ";
			$sql .= " values(?,?,?,?,1)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

//		echo "<pre>".nl2br(print_r($search_keyword_info,true))."</pre>";
		$this->insertAokioInfo($sql,$search_keyword_info,$db);
	}

	function updateSearchKeyword($search_keyword_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_search_keywords ";
			$sql .= " SET counts =counts +1 ";
			$sql .= " WHERE keyword=? and search_year=? and search_month=? and target = ?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

//		echo "<pre>".nl2br(print_r($search_keyword_info,true))."</pre>";
		$this->insertAokioInfo($sql,$search_keyword_info,$db);
	}

	function isExistSearchSite($search_keyword_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_search_sites ";
			$sql .= " WHERE searchsite=? and target = ?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		return $this->getAokioCounts($sql,$search_keyword_info,$db);
	}

	function insertSearchSite($search_keyword_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into aokio_log_search_sites ";
			$sql .= " (searchsite,target,counts ) ";
			$sql .= " values(?,?,1)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$search_keyword_info,$db);
	}

	function updateSearchSite($search_keyword_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_search_sites ";
			$sql .= " SET counts =counts +1 ";
			$sql .= " WHERE searchsite=? and target = ?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$search_keyword_info,$db);
	}

	//======================================


	function isExistSearchRobotInTargetTable($target,$robot_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " SELECT *  ";
			$sql .= " from aokio_log_robot ";
			$sql .= " WHERE useragent=? and target='$target'";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		return $this->_getCounts($sql,$robot_info,$db);
	}

	function insertSearchRobotInfoInTargetTable($target,$robot_info,$db){

		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into  aokio_log_robot ";
			$sql .= " (useragent,counts,target) ";
			$sql .= " values(?,1,'$target')";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$robot_info,$db);
	}

	function updateSearchRobotInfoInTargetTable($target,$robot_info,$db){
//		echo "<pre>".nl2br(print_r($robot_info,true))."</pre>";
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_robot ";
			$sql .= " SET counts = counts+1 ";
			$sql .= " WHERE target ='$target' and useragent=?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$robot_info,$db);
	}

	function insertSearchRobotInfoInRobotLogTable($target,$robot_info,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " INSERT into  aokio_robot_$target ";
			$sql .= " (ip,useragent,referer,nation,nation_code,nation_code_3,regtime) ";
			$sql .= " values(?,?,?,?,?,?,?)";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}

		$this->insertAokioInfo($sql,$robot_info,$db);
	}


	//======================================

	function updateTotal($target_arr,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_config ";
			$sql .= " SET total = total+1";
			$sql .= " WHERE target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$target_arr,$db);
	}

	function updateMax($target_arr,$db){
		if($this->php_type_for_db_variation ==="mysql"){
			$sql  = " UPDATE aokio_log_config ";
			$sql .= " SET max = max+1";
			$sql .= " WHERE target =?";
		}elseif($this->php_type_for_db_variation ==="pgsql"){
			$sql  = "";
		}


		$this->insertAokioInfo($sql,$target_arr,$db);
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