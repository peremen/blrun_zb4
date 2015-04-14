<?php
header("Content-Type: text/html; charset=UTF-8");
ob_start();
ini_set("error_reporting",E_ALL);
require_once "Aokio.Config.class.php";
require_once "Aokio.Smarty.class.php";
require_once "Aokio.Cookie.class.php";
require_once "Aokio.Message.class.php";

//TODO config.php 가 있는지 없는지 확인
// 없으면 없다는 메시지 출력, 인스톨 메시지 출력.
// AokioCommonManager::checkDBConfigFile();  
//이걸로 공통화 하자...^^


//initial environment cofig
$smarty = new AokioSmarty();
$config = new Aokio_Config();
$smarty->setInitialEnvironments($config);

// 메인타이틀 ,서브타이틀, 에러메시지등을 위한 오브젝트 생성.
$page_messages = new Aokio_Message_Manager($config);
$login_messages = $page_messages-> log_page_messages;

$aokio_cookie = new Aokio_Cookie();
// 어드민인지 판단
//현재 쿠키로 판단 -> 세션으로 하고 싶어...-,.-
if($aokio_cookie->isExistAdminCookieInfo() && $aokio_cookie->checkAdminCookieInfo()){
	AokioCommonManager::redirectPage(MANAGER_FILENAME);
}else{
	if(isset($_POST['login_submit']) && $_POST['login_submit'] !=null){
		if(	isset($_POST['adminid']) && $_POST['adminid'] !=null &&
			isset($_POST['adminpassword']) && $_POST['adminpassword'] !=null){
			$admin_info = array('adminid'		=>$_POST['adminid'],
								'adminpassword'	=>$_POST['adminpassword']);
			if(AokioAuthManager::checkAdmin($admin_info)){
				//인증 성공
				// 쿠기 설정  --> 세션 사용?...어케 할까...-,.-
				$aokio_cookie->setAdminCookieInfo($admin_info);

				AokioCommonManager::redirectPage(MANAGER_FILENAME);
			}else{
				//입력에러
				$login_messages['input_error_wrong_input_flag'] = true;
			}
		}else{
			//입력에러
			$login_messages['input_error_no_input_flag'] = true;
		}
	}
}
// 이미지 랜덤으로 돌리고 싶어..-,.- 
// TODO 언어별로 이미지 다르게 지정
// 사인인 , 로그인 등등 다름
$logo_image = "login_top.gif";
$smarty->assign("logo_image", $logo_image);
$smarty->assign("login_messages", $login_messages);
$smarty->assign("language", $config->language);

$smarty->display('login.tpl');
?>