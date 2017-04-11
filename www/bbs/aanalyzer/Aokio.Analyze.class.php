<?php
define ('NTT',				'DOCOMO');
define ('KDDI',			'AU');
define ('SOFTBANK',	'VODAFONE');

ini_set("include_path",dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'lib');
require_once 'Mobile.php';
require_once 'Aokio.OS.class.php';
require_once 'Aokio.Browser.class.php';
require_once 'Aokio.Time.class.php';
require_once 'Aokio.Geo.class.php';
require_once 'Aokio.Referer.class.php';

class Aokio_Analyzer{
	var $userAgent;				//constructor 에서 값 구해짐
	var $lowercaseAgent;		//constructor 에서 값 구해짐
	var $ip;							//constructor 에서 값 구해짐
	var $referer;					//constructor 에서 값 구해짐
	var $is_mobile = false;	//constructor 에서 값 구해짐
	var $mobile_useragent;	//constructor 에서 값 구해짐

	var $language_info;
	var $time_info;
	var $os_info;
	var $browser_info;

	var $screensize ;
	var $resolution ;
	var $bit ;

	var $geo_info;
	var $referer_info;

	var $via_proxy_flag ;
	var $visit_count;

	//constructor
	function Aokio_Analyzer(){
//		$this->analyze();
		//TODO 표준시 설정에 따라 바뀌도록 하면 좋겠는데...
		$this->time_info = new Aokio_Analyzer_Time();

		// detemine the useragent
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			$this->userAgent = $_SERVER['HTTP_USER_AGENT'];
		}elseif (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_USER_AGENT'])) {
			$this->userAgent = $GLOBALS['HTTP_SERVER_VARS']['HTTP_USER_AGENT'];
		}

		// get the lowercase version for case-insensitive searching
		$this -> lowercaseAgent = strtolower($this->userAgent);

		if(isset($_SERVER['REMOTE_ADDR'])){
			$this -> ip = $_SERVER['REMOTE_ADDR'];
		}elseif(isset($GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'])){
			$this -> ip = $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
		}
	}

	function analyze($target){
		$this->referer_info = new Aokio_Analyzer_Referer();

		$this->referer = $this->referer_info->referer;

		$this->detectMobile();
		$this->geo_info = new Aokio_Analyzer_Geo($this->ip);

		$this->setScreenInfo();
		$this->setOS();
		$this->setBrowser();
		$this->setVisitCounts($target);
	}


	function analyzeBot(){

		$this->geo_info = new Aokio_Analyzer_Geo($this->ip);
		$this->referer_info = new Aokio_Analyzer_Referer();

		$this->referer = $this->referer_info->referer;
	}


	function isRobot(){

		if(!isset($this->userAgent) || $this->userAgent ==""){
			return true;
		}
		include 'robot_list.php';
		$agent = $this->lowercaseAgent;
		foreach($robot_list as $key => $value){
			if(preg_match("#".$value."#i",$agent)){
				return true;
			}
		}
		return false;
	}


	function detectMobile(){
		//TODO minimo  브라우저이면 모바일로
		//TODO windows CE 이면 모바일.
		$detect_agent = &Net_UserAgent_Mobile::factory($this->userAgent);
		$this->mobile_useragent = $detect_agent;
		if(!$detect_agent->isNonMobile()){
			$this-> is_mobile = true;
		}
	}

	//======================================
	function setScreenInfo(){
		$this->_setScreenSize();
		$this->_setBit();
		$this->_setResolution();
	}

	function _setScreenSize(){

		if (isset($_COOKIE['screen_size'])){
			$this->screensize =  $_COOKIE['screen_size'];
		}else{
			$this->screensize = null;
		}
	}

	// TODO 색설정에 뭔가 내가 잘못생각하고 있어...-,.-
	function _setResolution(){
		// 4bit 16색
		// 8bit 256색
		// 15bit 32,768
		// 16bit 65,536
		// 24bit 16,777,216
		// 32bit   16,777,216
		if (isset($this->bit) && $this->bit != null){
			switch($this->bit){
				case 4:
					$this->resolution = '16';
					break;
				case 8:
					$this->resolution ='256' ;
					break;
				case 15:
					$this->resolution = '32,768';
					break;
				case 16:
					$this->resolution = '65,536';
					break;
				case 24:
					$this->resolution = '16,777,216';
					break;
				case 32:
					$this->resolution = '16,777,216';
					break;
				default:
					$this->resolution = null;
			}
		}else{
			$this->resolution = null;
		}
	}

	function _setBit(){
		// 4bit 16색
		// 8bit 256색
		// 16bit 16bits (TrueColor)
		// 24bit24bits (HighColor
		// 32bit32bits (HighColor)
		if (isset($_COOKIE['screen_resolution'])){
			$this->bit = $_COOKIE['screen_resolution'];
//			return $_COOKIE['screen_resolution'];
		}else{
			$this->bit = null;
		}
	}
	//======================================



	function getAcceptLanguage(){
		$language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$this->language_info = $language;
		$temp_array=preg_split("# #",preg_replace("#(,|;|-|_)#i"," ",$language));
		if (empty($temp_array[0]) || $temp_array[0] == "*") {	//2006-04-14 * 가 들어간넘이 접속..-,.-
			$language = null;
		}else{
			$language = $temp_array[0];
		}

		return $language;
	}


	function setOS(){
		if($this->is_mobile){
			//TODO 모바일도 재정리/재정의가 필요
			if($this->mobile_useragent->isDoCoMo()){
				$this->os				= NTT;
				$this->os_name		= NTT;
				$this->os_version	= "";
			}elseif($this->mobile_useragent->isJPhone()){
				$this->os				= SOFTBANK;
				$this->os_name		= SOFTBANK;
				$this->os_version	= "";

			}elseif($this->mobile_useragent->isEZweb()){
				$this->os				= KDDI;
				$this->os_name		= KDDI;
				$this->os_version	= "";
			}
		}else{

			$os_info_obj = new Aokio_Analyzer_OS();
			//echo "<pre>".nl2br(print_r($os_info_obj,true))."</pre>";

			$this->os_info = $os_info_obj;

			unset($this->mobile_useragent);
		}
	}

	function setBrowser(){
		if($this->is_mobile){
			$this->browser_name = $this->mobile_useragent->getModel();
		}else{
			$browser_info_obj = new Aokio_Analyzer_Browser();
			$this->browser_info = $browser_info_obj;
		}
	}

	function setVisitCounts($target){

		if (isset($_COOKIE['AOKIO_VISIT_COUNTS_'.$target])){
			$this->visit_count =  $_COOKIE['AOKIO_VISIT_COUNTS_'.$target]+1;
			setcookie("AOKIO_VISIT_COUNTS_".$target, $this->visit_count,time()+60*60*24*30*365);
		}else{

			$this->visit_count = 1;
//			setcookie('aokio_visit_counts',$this->visit_count);
			setcookie("AOKIO_VISIT_COUNTS_".$target, $this->visit_count,time()+60*60*24*30*365);
		}
//echo "<pre>".nl2br(print_r($target,true))."</pre>";
	}

	function isProxyServer(){
		$proxy_info = "";
		if(isset($_SERVER['HTTP_VIA']) &&$_SERVER['HTTP_VIA'] != null){
			$proxy_info = $_SERVER['HTTP_VIA'];
			$this->http_via_info = $_SERVER['HTTP_VIA'];
		}
		$temp_proxy_connection = "";
		if(isset($_SERVER['HTTP_PROXY_CONNECTION']) &&$_SERVER['HTTP_PROXY_CONNECTION'] != null){
			$temp_proxy_connection = $_SERVER['HTTP_PROXY_CONNECTION'];
		}
		$temp_forwarded = "";
		if(isset($_SERVER['HTTP_FORWARDED']) &&$_SERVER['HTTP_FORWARDED'] != null){
			$temp_forwarded = $_SERVER['HTTP_FORWARDED'];
		}
		$temp_x_forwarded = "";
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) &&$_SERVER['HTTP_X_FORWARDED_FOR'] != null){
			$temp_x_forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
//		$this->http_via_info = $_SERVER['HTTP_VIA'];

		if(	$proxy_info != ""  ||
			$temp_proxy_connection != "" ||
			$temp_forwarded != ""||
			$temp_x_forwarded != ""){

			return true;
		}

		return false;
	}
	function getHTTPViaInfo(){

		$proxy_info = "";
		if(isset($_SERVER['HTTP_VIA']) &&$_SERVER['HTTP_VIA'] != null){
			$proxy_info = $_SERVER['HTTP_VIA'];
		}

		$temp_forwarded = "";
		if(isset($_SERVER['HTTP_FORWARDED']) &&$_SERVER['HTTP_FORWARDED'] != null){
			$temp_forwarded = $_SERVER['HTTP_FORWARDED'];
		}
		if($proxy_info != null){
			return $proxy_info;
		}elseif($temp_forwarded != null){
			return $temp_forwarded;

		}
//		return $this->http_via_info;
	}


	function getAnalyzeInfo(){
		$ip			= $this->ip;
		$referer		= $this->referer;

		$os_category							= $this->os_info->os_category;
		$os_full_name						= $this->os_info->os_full_name;
		$os_name								= $this->os_info->os_name;

		//이거 여기서 이러는거 싫은데.,..-,.-
		if($os_name == "Unknown OS" && $this->browser_info->browser_category	 =="Sleipnir"){
			$os_full_name = "Microsoft Windows Ver.?";
			$os_category = "Microsoft Windows";
			$os_name = "Microsoft Windows";
		}
		$os_version							= $this->os_info->os_version;
		$os_sp_info							= $this->os_info->os_sp_info;
		$os_net_frame_info				= $this->os_info->os_net_frame_info;
		//TODO 어레이값 재 설정..
		$os_net_frame_version_info	= $this->os_info->os_net_frame_version_info;
		$processor_info						= $this->os_info->processor_info;
		$tablet_info							= $this->os_info->tablet_info;
		$tablet_version_info				= $this->os_info->tablet_version_info;

		$browser_full_name			= $this->browser_info->browser_full_name;
		$browser_category				= $this->browser_info->browser_category;
//		$browser_version				= $this->browser_info->browser_version;
		$browser_build_date			= $this->browser_info->browser_build_date;
		$browser_type					= $this->browser_info->browser_type;
		$browser_dom_info			= $this->browser_info->dom_browser;
		$browser_revision				= $this->browser_info->browser_revision;
		$browser_security				= $this->browser_info->browser_security;
		$mozilla_flag						= $this->browser_info->mozilla_flag;
		$mozilla_version				= $this->browser_info->mozilla_version;
		$browser_cookie_info			= $this->browser_info->browser_cookie_info;
		$browser_javascript_info	= $this->browser_info->browser_javascript_info;

		$useragent			=  $this->userAgent;
		$screensize			= $this->screensize;
		$resolution				= $this->resolution;
		$bit						= $this->bit;
		$mobile_flag			= $this->is_mobile;
		$accept_language	= $this->getAcceptLanguage();

		$regtime				= $this->time_info->time_info;
		$year					= $this->time_info->time_year;
		$month					= $this->time_info->time_month;
		$day						= $this->time_info->time_day;
		$hour					= $this->time_info->time_hour;
		$week					= $this->time_info->time_week;

		$nation_name		= $this->geo_info->nation_name;
		$nation_code			= $this->geo_info->nation_code;
		$nation_code3		= $this->geo_info->nation_code3;

		$city						= $this->geo_info->city;
		$language_info		= $this->language_info;

		$via_proxy_flag		= $this->isProxyServer();
		$http_via_info		= $this->getHTTPViaInfo();

		$visit_count	= $this->visit_count;

		$latitude		= $this->geo_info->latitude;
		$longitude		= $this->geo_info->longitude;
		$isp				= $this->geo_info->isp;

		$referer_server		=$this->referer_info->referer_server;

		$search_keyword = $this->referer_info->search_keyword;
		$search_site = $this->referer_info->referer_searchsite;


		$search_key_info = array(	'search_keyword'	=>$search_keyword,
												'search_site'			=>$search_site,
												'search_year'			=>$year,
												'search_month'		=>$month,
												'search_day'			=>$day,

		);


		$screen_info = array(	'screensize'=>$screensize,
										'resolution'=>$resolution,
										'bit'=>$bit,
		);


		// 주 테이블구조가 바뀌면 여기에 녛고 아니면
		// 별도의 어레이 작성.
		$total_info = array(
							'ip'						=>$ip,
							'referer'					=>$referer,

							'browser_category'				=>$browser_category,
//							'browser_version'				=>$browser_version,
							'browser_full_name'			=>$browser_full_name,
							'browser_build_date'			=>$browser_build_date,
							'browser_security'				=>$browser_security,
							'browser_type'					=>$browser_type,
							'browser_dom_info'			=>$browser_dom_info,
							'browser_cookie_info'			=>$browser_cookie_info,
							'browser_javascript_info'		=>$browser_javascript_info,
							'mozilla_flag'						=>$mozilla_flag,
							'mozilla_version'					=>$mozilla_version,
							'os_category'						=>$os_category,
							'os_full_name'					=>$os_full_name,
							'os_name'							=>$os_name,
							'os_version'						=>$os_version,
							'os_sp_info'						=>$os_sp_info,
							'os_net_frame_info'			=>$os_net_frame_info,
							'processor_info'					=>$processor_info,
							'tablet_info'						=>$tablet_info,

							'useragent'				=>$useragent,
							'screensize'			=>$screensize,
							'resolution'	 			=>$resolution,
							'mobile_flag'			=>$mobile_flag,
							'language'				=>$accept_language,
							'nation'					=>$nation_name,
							'regtime'				=>$regtime,
							'year'					=>$year,
							'month'					=>$month,
							'day'						=>$day,
							'hour'					=>$hour,
							'week'					=>$week,

							'nation_code'			=>$nation_code,
							'nation_code3'		=>$nation_code3,

							'city'						=>$city,
							'language_info'		=>$language_info,
							'via_proxy_flag'		=>$via_proxy_flag,
							'http_via_info'		=>$http_via_info,
//							'remote_host_info'		=>$remote_host_info,
							'visit_count'		=>$visit_count,

							'latitude'		=>$latitude,
							'longitude'		=>$longitude,
							'isp'		=>$isp,

							);
		$os_total_info = array(
					'os_category'				=> $os_category,
					'os_full_name'			=> $os_full_name,
			);

		$browser_total_info = array(
											'browser_category'=>$browser_category,
											'browser_full_name'=>$browser_full_name,
		);

		$nation_info	= array(	'nation_name'	=>$this->geo_info->nation_name,
											'nation_code'		=>$this->geo_info->nation_code,
											'nation_code_3'	=>$this->geo_info->nation_code3);


		$analyze_info = array(
								'total_info'					=>$total_info,		//주테이블용 정보
								'os_total_info'				=>$os_total_info,
								'browser_total_info'	=>$browser_total_info,
								'nation_info'				=>$nation_info,
								'referer_server'			=>$referer_server,
								'screen_info'				=>$screen_info,
								'search_key_info'		=>$search_key_info,
								);
//echo "<pre>".nl2br(print_r($analyze_info,true))."</pre>";
		return $analyze_info;
	}


	function getRobotInfo(){
		$ip					= $this->ip;
		$useragent		= $this->userAgent;
		$referer				= $this->referer;
		$regtime			= $this->time_info->time_info;
		$nation_name	= $this->geo_info->nation_name;
		$nation_code		= $this->geo_info->nation_code;
		$nation_code3	= $this->geo_info->nation_code3;

		// TODO 테이블 변경
		$robot_log_info = array('useragent'	=>$useragent,
							);
		$robot_target_table_info = array(
							'ip'					=>$ip,
							'useragent'			=>$useragent,
							'referer'				=>$referer,
							'nation'				=> $nation_name,
							'nation_code'		=> $nation_code,
							'nation_code_3'	=> $nation_code3,
							'regtime'			=>$regtime,
							);
		$robot_info =array(	'robot_log_info'				=>$robot_log_info,
										'robot_target_table_info'	=>$robot_target_table_info);
		return $robot_info;
	}
}
?>