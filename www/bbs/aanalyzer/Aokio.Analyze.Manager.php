<?php
require_once 'Aokio.Analyze.Dao.php';
require_once 'Aokio.Config.Manager.php';
/**
 * Project:     AokioAnalyzer
 *
 *
 * @link http://www.aokio.com/
 * @copyright 2006-
 * @author aokio   <st.elmo@gmail.com>
 * @package AokioAnalyzer
 */


 /**
 * @package AokioAnalyzer
 */
class AokioAnalyzeManager{

	// 접속 정보 분석후 각종 정보 입력
	function insertAnalyzeInfo($anal_info,$target){

		$analyze_info = $anal_info['total_info'];
		$analyze_dao = new AokioAnalyzeDao();
		$db = $analyze_dao -> getConnection();
		// 주테이블에 저장.
		$analyze_dao -> insertAnalyzeInfo($analyze_info,$target,$db);

		//======================================
		//오에스 관련 테이블에 전부저장
		$os_total_info = $anal_info['os_total_info'];
		array_push($os_total_info,$target);
		if(!$analyze_dao ->isExistOS($os_total_info,$db)){
			$analyze_dao -> insertOS($os_total_info,$db);
		}else{
			$analyze_dao -> updateOS($os_total_info,$db);
		}

		//======================================
		//브라우저 관련 테이블에 전부저장
		$browser_total_info = $anal_info['browser_total_info'];

		array_push($browser_total_info,$target);
		if(!$analyze_dao -> isExistBrowser($browser_total_info,$db)){
			$analyze_dao -> insertBrowser($browser_total_info,$db);
		}else{
			$analyze_dao -> updateBrowser($browser_total_info,$db);
		}

		//======================================
		//시간관련 관련 테이블에 전부저장
		$day_info = array(	$analyze_info['year'],
							$analyze_info['month'],
							$analyze_info['day'],
							$target);
		$hour = $analyze_info['hour'];
		if(!$analyze_dao ->isExistTimeInfo($day_info,$db)){
			$analyze_dao -> insertTimeInfo($day_info,$hour,$db);
		}else{
			$analyze_dao -> updateTimeInfo($day_info,$hour,$db);
		}

		$week_info = $analyze_info['week'];
		$target_arr = array($target);

		// TODO  스타트 플래그가 0 이면 1로 바꾸고 전날 스타트 플래그 0으로
		// 요일 누적카운트 추가 , 오늘 카운트 1로 요일 횟수 1 추가
		// 스타트 플래그가 1이면 누적 카운트 추가 오늘 카운트 추가 , 요일 횟수 변함 없음
		$week_temp = $analyze_dao ->getWeekInfo($target,$db);

		if($week_temp['w_start_flag_'.$week_info] == 0){
			$start_flag = true;
			$analyze_dao -> updateWeekInfo($week_info,$target_arr,$start_flag,$db);
		}else{
			$start_flag = false;
			$analyze_dao -> updateWeekInfo($week_info,$target_arr,$start_flag,$db);
		}


		if($analyze_info['language'] && $analyze_info['language'] != null){
			$language_info = array($analyze_info['language'],$target);
			if(!$analyze_dao -> isExistLanguage($language_info,$db)){
				$analyze_dao -> insertLanguage($language_info,$db);
			}else{
				$analyze_dao -> updateLanguage($language_info,$db);
			}
		}

		$nation_info = $anal_info['nation_info'];
		if($nation_info['nation_name'] && $nation_info['nation_name'] != null){
			array_push($nation_info,$target);
			$tem_na = array($nation_info['nation_name'],$target);
			if(!$analyze_dao -> isExistNation($tem_na,$db)){
				$analyze_dao -> insertNation($nation_info,$db);
			}else{
				$analyze_dao -> updateNation($tem_na,$db);
			}
		}
/*
		$city_info = $analyze_info['city'];
		echo "<pre>".nl2br(print_r($city_info,true))."</pre>";
		if($city_info['city_name'] && $city_info['city_name'] != null){
			array_push($city_info,$target);
			$tem_ci = array($city_info['city_name'],$target);
			if(!$analyze_dao -> isExistCity($tem_ci,$db)){
				$analyze_dao -> insertCity($city_info,$db);
			}else{
				$analyze_dao -> updateCity($tem_ci,$db);
			}
		}
*/

		$refererserver_info = $anal_info['referer_server'];
		if(isset($refererserver_info) && $refererserver_info != null){
			$temp = array($refererserver_info,$target);
//echo "<pre>".nl2br(print_r($temp,true))."</pre>";
			if(!$analyze_dao -> isExistRefererServer($temp,$db)){
				$analyze_dao -> insertRefererServer($temp,$db);
			}else{
				$analyze_dao -> updateRefererServer($temp,$db);
			}
		}

		$referer_info = $analyze_info['referer'];
		if(isset($referer_info) && $referer_info != null){
			$temp = array($referer_info,$target);
//echo "<pre>".nl2br(print_r($temp,true))."</pre>";
			if(!$analyze_dao -> isExistReferer($temp,$db)){
				$analyze_dao -> insertReferer($temp,$db);
			}else{
				$analyze_dao -> updateReferer($temp,$db);
			}
		}


		//======================================
		//검색어관련 테이블에 전부저장
		$search_key_info = $anal_info['search_key_info'];
		$search_keyword_info = $search_key_info['search_keyword'];
		$search_year = $search_key_info['search_year'];
		$search_month = $search_key_info['search_month'];
		$search_day = $search_key_info['search_day'];

		if(isset($search_keyword_info) && $search_keyword_info != null){
			$temp = array($search_keyword_info,$search_year,$search_month,$target);
//echo "<pre>".nl2br(print_r($temp,true))."</pre>";
			if(!$analyze_dao -> isExistSearchKeyword($temp,$db)){
				$analyze_dao -> insertSearchKeyword($temp,$db);
			}else{
				$analyze_dao -> updateSearchKeyword($temp,$db);
			}
		}

		$search_site_info = $search_key_info['search_site'];
		if(isset($search_site_info) && $search_site_info != null){
			$temp = array($search_site_info,$target);
//echo "<pre>".nl2br(print_r($temp,true))."</pre>";
			if(!$analyze_dao -> isExistSearchSite($temp,$db)){
				$analyze_dao -> insertSearchSite($temp,$db);
			}else{
				$analyze_dao -> updateSearchSite($temp,$db);
			}
		}

		$screen_info = $anal_info['screen_info'];
		$screensize_info = $screen_info['screensize'];
		if(isset($screensize_info) && $screensize_info != null){
			$temp = array($screensize_info,$target);
//echo "<pre>".nl2br(print_r($temp,true))."</pre>";
			if(!$analyze_dao -> isExistScreensize($temp,$db)){
				$analyze_dao -> insertScreensize($temp,$db);
			}else{
				$analyze_dao -> updateScreensize($temp,$db);
			}
		}

		$resolution_info = $screen_info['resolution'];
		$bit_info = $screen_info['bit'];

		if(isset($resolution_info) && $resolution_info != null){
			$temp = array($resolution_info,$bit_info,$target);
//echo "<pre>".nl2br(print_r($temp,true))."</pre>";
			if(!$analyze_dao -> isExistResolution($temp,$db)){
				$analyze_dao -> insertResolution($temp,$db);
			}else{
				$analyze_dao -> updateResolution($temp,$db);
			}
		}


		$analyze_dao -> updateTotal($target_arr,$db);

		$info_array = $analyze_dao ->getTimeInfo($target,false,$analyze_info,"HOUR",$db);
		$todays_count = $info_array[28];

		$target_config = $analyze_dao ->getMaxCounts($target,$db);
		$max_count = $target_config['max'];

		if($max_count<$todays_count){
			$analyze_dao -> updateMax($target_arr,$db);
		}

		$analyze_dao->closeConnection($db,true);
	}


	function setBookmarkAnalyzeInfo($no,$target){
		$analyze_dao = new AokioAnalyzeDao();

		$db	= $analyze_dao -> getConnection();
//echo "<pre>".nl2br(print_r($target,true))."</pre>";
//		$bookmark_info = array($no,$target);
		$info_array = $analyze_dao ->setBookmarkAnalyzeInfo($no,$target,$db);
		$analyze_dao->closeConnection($db);

		return $info_array;
	}


	function clearBookmarkAnalyzeInfo($no,$target){
		$analyze_dao = new AokioAnalyzeDao();

		$db	= $analyze_dao -> getConnection();

//		$bookmark_info = array($no,$target);
		$info_array = $analyze_dao ->clearBookmarkAnalyzeInfo($no,$target,$db);
		$analyze_dao->closeConnection($db);

		return $info_array;
	}




	function insertSearchRobotInfo($robot_info,$target){
		$analyze_dao = new AokioAnalyzeDao();
		$db = $analyze_dao -> getConnection();

//		$robot_agent_arr = array($robot_info['useragent']);
		$robot_log_info	= $robot_info['robot_log_info'];
		$robot_target_table_info = $robot_info['robot_target_table_info'];

		if(!$analyze_dao ->isExistSearchRobotInTargetTable($target,$robot_log_info,$db)){
			$analyze_dao -> insertSearchRobotInfoInTargetTable($target,$robot_log_info,$db);
		}else{
			// TODO update
			$analyze_dao -> updateSearchRobotInfoInTargetTable($target,$robot_log_info,$db);
		}

		// TODO aokio_log_robot 에 추가
		$analyze_dao -> insertSearchRobotInfoInRobotLogTable($target,$robot_target_table_info,$db);

		$analyze_dao->closeConnection($db,true);
	}

}
?>