<?php
header("Content-Type: text/html; charset=UTF-8");
ob_start();
//ini_set("error_reporting",E_ALL);
require_once "Aokio.Config.class.php";
require_once "Aokio.Smarty.class.php";
require_once "Aokio.Cookie.class.php";
require_once "Aokio.Config.Manager.php";
require_once "Aokio.Manager.Manager.php";
require_once "Aokio.Common.Manager.php";

//TODO 메뉴표시 텍스트/ 이미지 선택?
//TODO 리스트에 검색로봇 기록 추가
$smarty = new AokioSmarty();
$config = new Aokio_Config();
$smarty->setInitialEnvironments($config);

$aokio_cookie = new Aokio_Cookie();
//echo "<pre>".nl2br(print_r($config,true))."</pre>";
if($aokio_cookie->isExistAdminCookieInfo() && $aokio_cookie->checkAdminCookieInfo()){
	$conf_lang = $config->language;
	$conf_menu_type = $config->menu_type;
	// 카운터 리스트  가져 오기
	$drop_confirm_flag = false;
	$truncate_confirm_flag = false;
	$no_id_flag = false;


	if(isset($_REQUEST['mode']) && $_REQUEST['mode'] !=null){
		$mode = $_REQUEST['mode'];
		if( $_REQUEST['id'] == null){
			$no_id_flag = true;
		}else{
			$id = $_REQUEST['id'];
			if($mode =='drop'){
				if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 'OK'){
					//drop
					AokioManagerManager::dropTargetInfos($id);
				}else{
					$drop_confirm_flag = true;
					// 진짜 드랍할지 메시지 표시하는 페이지
					$cofirm_message = "Drop";

					$smarty->assign("drop_id", $id);
					$smarty->assign("drop_confirm_flag", $drop_confirm_flag);
				}
			}elseif($mode =='truncate'){

				if(isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 'OK'){
					//truncate
					AokioManagerManager::truncateTargetInfos($id);
				}else{
					$truncate_confirm_flag = true;
					// 진짜 비울지할지 메시지 표시하는 페이지
					$cofirm_message = "Truncate";
					$smarty->assign("truncate_id", $id);
					$smarty->assign("truncate_confirm_flag", $truncate_confirm_flag);
				}
			}

		}
	}
//	$manager_config_flag = $_REQUEST['language'];
	
	if(isset($_REQUEST['language']) && $_REQUEST['language'] != null){
		$manager_config_flag = $_REQUEST['language'];
		$language	= $_REQUEST['language'];
		$menu_type	= 0;
//		$menu_type	= $_REQUEST['menu_type'];
//		$original_password	= $_REQUEST['original_password'];

//		$password		= $_REQUEST['password'];
//		$re_password	= $_REQUEST['re_password'];

//		if(isset($original_password) && $original_password != null ){
			// 원래 패스워드가 맞는지 디비에서 판단
//			if(true){
				// 패스워드가 맞으면 패스워드 변겨ㅇ
//			}{
				// 패스워드가 틀리면 패스워드가 틀리다는 메시지 출력
				// 입력값을 그대로 돌려주도록?..
//			}


//		}else{
		
			$manager_config_infos = array(	'language' => $language,
											'menu_type' => $menu_type,
									);
			AokioManagerManager::updateAokioAnalyzerConfig($manager_config_infos);
		
//		}
		$up_config = new Aokio_Config();
		$smarty->setInitialEnvironments($up_config);

		$conf_lang = $up_config->language;
		$conf_menu_type = $up_config->menu_type;
	}


	if(isset($_REQUEST['cp_err']) && $_REQUEST['cp_err'] !=null){
		$smarty->assign("create_error", $_REQUEST['cp_err']);
		$smarty->assign("create_error_message", $create_page_messages['error_messages']);

	}
	$info_list = AokioConfigManager::getTargetConfigList();
	//TODO $info_list 가 널이면 메시지 출력..
//echo "<pre>".nl2br(print_r($config,true))."</pre>";
	$smarty->assign("version", $config->version);
	// 언어 선택
	$lang_list = $config->lang_list;
	require_once "./resources/".$conf_lang."_lang_resource.php";
	$smarty->assign("no_id_flag", $no_id_flag);
	$smarty->assign("target_list_item_titles", $manager_messages['target_list_item_titles']);
	$smarty->assign("manager_messages", $manager_messages);
	$smarty->assign("lang_list", $lang_list);
	$smarty->assign("manage_list", $info_list);
	$smarty->assign("language", $conf_lang);
	$smarty->assign("menu_type",$conf_menu_type);
	$smarty->display('manager.tpl');
	
}else{
	//로그인 화면으로
	AokioCommonManager::redirectPage("login.php");
}

?>