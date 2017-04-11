<?php
header("Content-Type: text/html; charset=UTF-8");
ob_start();
//ini_set("error_reporting",E_ALL);

//ini_set("mbstring.internal_encoding","UTF-8");
//ini_set("mbstring.http_output","UTF-8");
//ini_set("mbstring.http_input","UTF-8");
require_once "Aokio.Config.class.php";
require_once "Aokio.Config.Manager.php";
require_once "Aokio.Smarty.class.php";
require_once "Aokio.Analysis.class.php";
require_once "Aokio.Cookie.class.php";
require_once "Aokio.Menu.class.php";
require_once "Aokio.Common.Manager.php";

// id 가 입력되지 않으면 매니저페이지로
if(!isset( $_REQUEST['id']) || $_REQUEST['id']==null){
	// manager 화면으로?
	AokioCommonManager::redirectPage(MANAGER_FILENAME);
}

// 기본 스마티 설정
// 화면 제목 , 어플명,인코딩,코드네임,홈페이지,이메일,닉네임 설정,어플버젼
// 분석 화일명 설정( 메뉴부분에서 사용) 등등을 위해 기본 컨스트럭터.
//TODO config.php 가 있는지 없는지 확인
// 없으면 없다는 메시지 출력, 인스톨 메시지 출력.
$smarty = new AokioSmarty();
//스마티에서 설정하기위한 기본 값 구해오기.
$config = new Aokio_Config();
$smarty->setInitialEnvironments($config);

$id = $_REQUEST['id'];
$config->setTargetConfigurationInfos($id);

// 주소창에 직접 입력으로 들어왔을때
// 해당 id가 없을때임
if($config->target_exist_flag==null){
	AokioCommonManager::redirectPage(MANAGER_FILENAME);
}

$analysis_view_object = new AokioAnalysis();

$analysis_view_object->initialParameters($config);
$page_param = $analysis_view_object->page_req_parameters;
$access_permission = AokioAuthManager::getAccessPermission($page_param['mode'],$id);

$no_analysis_flag = false;

if(!AokioAuthManager::checkAccessPermission($access_permission,$page_param['mode'])){
	// 세션으로 인증했으면 하는데...-,.-
	$aokio_cookie = new Aokio_Cookie();
	if($aokio_cookie->isExistAdminCookieInfo() && $aokio_cookie->checkAdminCookieInfo()){
		$final_analysis_info = $analysis_view_object->getPagesAnalysisInfos($page_param,$config);
		if(!$final_analysis_info){
			$no_analysis_flag = true;
		}

		$smarty->assign("no_analysis_flag", $no_analysis_flag);
		$common_page_view_info = $analysis_view_object->common_page_view_info;

		//TODO최근 7일간의 카운트
		//아직 사용안함
		//$seven_days_info = $analysis_view_object->getSevenDaysCounts($page_param);

	}else{
		// 로그인 화면으로 보낼까?
		// 접근권한이 없다는 메시지 보낼까?
		// 전체 메뉴에 대한 접근 권한이 없다는 판단을 먼저해서 전체가 권한이 제한되어있으면
		// 로그인으로 보내고 , 일부만 제한되어 있으면 뷰 화면은 보여주고 ...내용은 제한시킬까?
		// 임시로그인 화면으로
		AokioCommonManager::redirectPage(LOGIN_FILENAME);
	}
}else{
	// 화면 표시
	$final_analysis_info = $analysis_view_object->getPagesAnalysisInfos($page_param,$config);
	$common_page_view_info = $analysis_view_object->common_page_view_info;
	$smarty->assign("no_analysis_flag", $no_analysis_flag);

	// 최근 7일간의 카운트
//	$seven_days_info = $analysis_view_object->getSevenDaysCounts($page_req_param);
}
// 오늘 날짜 표시
$today_info = AokioCommonManager::thisDayInfo();

//echo "<pre>".nl2br(print_r($seven_days_info,true))."</pre>";
//echo "<pre>".nl2br(print_r($final_analysis_info,true))."</pre>";
//echo "<pre>".nl2br(print_r($common_page_view_info,true))."</pre>";
//echo "<pre>".nl2br(print_r($conf_info,true))."</pre>";

//이미지파일 패스용
$smarty->assign("language", $config->language);
//데이타
$smarty->assign("analysis_info", $final_analysis_info);
//공통 출력 데이터
$smarty->assign("common_page_view_info", $common_page_view_info);
$smarty->assign("items_titles", $analysis_view_object->top_items_titles_of_pages);
$smarty->assign("bottom_misc_counts", $analysis_view_object->bottom_misc_counts);

//이거 필요없을꺼 같은데..? 아닌감..? config_info 를 어사인해야하남?...-,.-
$smarty->assign("aa_page", $id);
$smarty->assign("today_info", $today_info);

if(($page_param['mode'] == 18 || $page_param['mode'] == 19) && $final_analysis_info){
	$smarty->assign("this_page", $analysis_view_object->this_page);
	$smarty->assign("pager", $analysis_view_object->pager);
	$smarty->assign("pager_prev", $analysis_view_object->pager_prev);
	$smarty->assign("pager_next", $analysis_view_object->pager_next);
	$smarty->assign("pager_last", $analysis_view_object->pager_last);
	$smarty->assign("order_option", $analysis_view_object->order);
	$smarty->assign("order_type", $analysis_view_object->order_type);

//	$smarty->assign("os_param", $analysis_view_object->os_param);
}

$smarty->assign("analysis_page", $id);
if($page_param['mode'] !=0){
	$smarty->assign("common_messages", $analysis_view_object->common_messages);
}else{
	$smarty->assign("words", $analysis_view_object->words);
}

//라이센스
$smarty->assign("licenses_messages", $analysis_view_object->licenses_messages);
//echo "<pre>".nl2br(print_r($analysis_view_object,true))."</pre>";
// 왼쪽메뉴 표시 부분
$menu_param_ob = new Aokio_Menu_Manager();
$smarty->assign("menu_info", $menu_param_ob->menu_param_infos);


$smarty->display('index.tpl');

?>