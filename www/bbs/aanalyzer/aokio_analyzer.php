<?php
ob_start();
//ini_set("error_reporting",E_ALL);
//ini_set("error_reporting",E_COMPILE_ERROR|E_CORE_ERROR|E_PARSE |E_ERROR   );
require_once "Aokio.Analyze.class.php";
require_once "Aokio.Analyze.Manager.php";
require_once "Aokio.Config.class.php";
require_once "Aokio.Auth.Manager.php";
require_once "Aokio.Cookie.class.php";
require_once "Aokio.Config.Manager.php";

$config = new Aokio_Config();
$useragent_analyze = new Aokio_Analyzer();

// 설정값 디비에서 가져오기
// 카운터값을 표시하기 위해.
$conf_info = AokioConfigManager::getTargetConfigInfos($target);

if( !$useragent_analyze->isRobot()){
	// 어드민의 접속도 로그에 기록할지 여부 판단
	$admin_access_available = ($conf_info['check_admin_access'] ==1)?true:false;

	$aokio_cookie = new Aokio_Cookie();
	// 어드민은 추가하지 않음.
	if($admin_access_available){
		// 어드민인지 판단
		$is_admin = false;
		if($aokio_cookie->isExistAdminCookieInfo() && $aokio_cookie->checkAdminCookieInfo())
			$is_admin = true;

		//어드민이 아님
		if(!$is_admin){
			//TODO 쿠키 설정과 관계없이
			//페이지뷰 추가하도록
			//AokioAnalyzeManager::insert페이지뷰AnalyzeInfo($analyze_info,$target);

			// 쿠키설정에 따라 판단해서 추가
			$analyze_insert_flag = $aokio_cookie->setAccessUserCookieInfo($conf_info,$target);
			$useragent_analyze -> analyze($target);
			$analyze_info = $useragent_analyze -> getAnalyzeInfo();
//			echo "<pre>".nl2br(print_r($useragent_analyze,true))."</pre>";
			if($analyze_insert_flag){
				AokioAnalyzeManager::insertAnalyzeInfo($analyze_info,$target);
			}
		}
	}else{
		//TODO 쿠키 설정과 관계없이
		//페이지뷰 추가하도록
		//AokioAnalyzeManager::insert페이지뷰AnalyzeInfo($analyze_info,$target);


		//어드민과 상관없이 추가
		//얼마주기로 추가할지 판단
		// 쿠키설정에 따라 판단해서 추가
		$analyze_insert_flag = $aokio_cookie->setAccessUserCookieInfo($conf_info,$target);
		$useragent_analyze -> analyze($target);
		$analyze_info = $useragent_analyze -> getAnalyzeInfo();
//		echo "<pre>".nl2br(print_r($useragent_analyze,true))."</pre>";
		if($analyze_insert_flag){
			AokioAnalyzeManager::insertAnalyzeInfo($analyze_info,$target);
		}
	}
}else{
	$useragent_analyze -> analyzeBot();
	$robot_info = $useragent_analyze -> getRobotInfo();
//	echo "<pre>".nl2br(print_r($robot_info,true))."</pre>";
	AokioAnalyzeManager::insertSearchRobotInfo($robot_info,$target);
}
?>