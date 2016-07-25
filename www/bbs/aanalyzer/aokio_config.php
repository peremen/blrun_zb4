<?php
header("Content-Type: text/html; charset=UTF-8");
ob_start();
//ini_set("error_reporting",E_ALL);
require_once "Aokio.Config.Manager.php";
require_once "Aokio.Config.class.php";
require_once "Aokio.Smarty.class.php";
require_once "Aokio.Cookie.class.php";
require_once "Aokio.Common.Manager.php";
require_once "Aokio.Menu.class.php";

//initial environment cofig
$smarty = new AokioSmarty();
$config = new Aokio_Config();

if($_REQUEST['id']==null){
	AokioCommonManager::redirectPage(MANAGER_FILENAME);
}
$id = $_REQUEST['id'];
//$config->setAccessListPerPage($id);
$config->setTargetConfigurationInfos($id);
$smarty->setInitialEnvironments($config);

require_once "./resources/".$config->language."_lang_resource.php";

$aokio_cookie = new Aokio_Cookie();

if(!($aokio_cookie->isExistAdminCookieInfo() && $aokio_cookie->checkAdminCookieInfo()))
	// 로그인 화면으로 
	AokioCommonManager::redirectPage("login.php");

// 설정 변경
if(isset($_REQUEST['config_page'])){
	// 변경 처리
	$target_name	= htmlentities($_REQUEST['target_name']);
	$lists_per_page	= $_REQUEST['lists_per_page'];
	if($lists_per_page <=0){
		$lists_per_page	=$config->access_list_per_page;
		//TODO 0보다 작으면 안된다는 메시지 내보낼것..
		//javascript 사용하지 않을때 
	}
	$access_check_pattern					= $_REQUEST['access_check_pattern'];	
	$access_check_pattern_input_time	= $_REQUEST['access_check_pattern_input_time'];
	$check_admin_access						= $_REQUEST['check_admin_access'];

	$access_permission = null;
	if(isset($_REQUEST['access_permission'])){
		$access_permission = $_REQUEST['access_permission'];
	}
	$temp_str = "";
	if($access_permission!=null){
		for($i=0;$i<sizeof($access_permission);$i++){
			$temp_str.=$access_permission[$i];
			if($i<sizeof($access_permission)-1){
				$temp_str.=",";
			}
		}
	}
	$access_permission =$temp_str;

	$portal_page = $_REQUEST['portal_page'];
	$input_config_infos = array($lists_per_page,
								$access_check_pattern,
								$check_admin_access,
								$access_permission,
								$access_check_pattern_input_time,
								$target_name,
								$portal_page,
								$id);

	AokioConfigManager::updateTargetConfigInfos($input_config_infos);

	$smarty->assign("config_update_completed", $config_update_completed_message);
}
// 설정값 디비에서 가져와서 화면에 표시
$conf_info = AokioConfigManager::getTargetConfigInfos($id);
$tem_access_perm = preg_split("#,#",$conf_info['access_permission']);

$temp_api = $config_messages['access_permission_items'];
$temp_arr = array();
foreach($temp_api as $key => $value){
	if($key != 10){
		$temp_arr[$key] = $value;
	}
}
$config_messages['access_permission_items'] = $temp_arr;

$smarty->assign("access_perm_checked_items", $tem_access_perm);
$smarty->assign("config_messages", $config_messages);
$smarty->assign("aa_page", $id);
$smarty->assign("language", $config->language);
$smarty->assign("conf_info", $conf_info);
unset($id);
$menu_param_ob = new Aokio_Menu_Manager();
$smarty->assign("menu_info", $menu_param_ob->menu_param_infos);
$smarty->display('aokio_config.tpl');

?>