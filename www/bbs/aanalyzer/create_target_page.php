<?php
ob_start();
require_once"Aokio.Auth.Manager.php";
require_once"Aokio.Config.class.php";
require_once"Aokio.Install.Manager.php";
require_once 'Aokio.Smarty.class.php';
require_once "Aokio.Cookie.class.php";
require_once"Aokio.Config.Manager.php";

//initial environment cofig
$smarty = new AokioSmarty();
$config = new Aokio_Config();
$smarty->setInitialEnvironments($config);

$aokio_cookie = new Aokio_Cookie();
require_once "./resources/".$config->language."_lang_resource.php";
$target = null;
if($aokio_cookie->isExistAdminCookieInfo() && $aokio_cookie->checkAdminCookieInfo()){
	$conf_lang = $config->language;
	if($_POST['target_page']!=null){
		$target = $_POST['target_page'];
		//TODO 리퀘스트가 영어,숫자인지 아닌지 확인...
		// 아니면 에러메시지를 보내든가... 재입력 메시지 보내기...
		if(!AokioCommonManager::isAlphbetNumeric($target) ){
			// 메소드에서 처리하도록 하면 좋겄는디...구찮어...-,.-
			AokioCommonManager::redirectPage("manager.php?cp_err=2");

		}
		if(strlen($target)>30 ){
			// 메소드에서 처리하도록 하면 좋겄는디...구찮어...-,.-
			AokioCommonManager::redirectPage("manager.php?cp_err=4");

		}

		//테이블이 있으면 ...
		if(AokioConfigManager::getTargetConfigInfos($target) != null){
			AokioCommonManager::redirectPage("manager.php?cp_err=3");

		}
		AokioInstallManager::initiateTarget($target);
	}else{
		AokioCommonManager::redirectPage("manager.php?cp_err=1");

	}
	$smarty->assign("create_page_messages", $create_page_messages);

	$howto_starter = "<?php";
	$howto_target  = $target;
	$howto_include ="include \"./aanalyzer/".$config->analyzer_file_name."\";";
	$howto_ender = "?>";

	$howto_javascript ="<script src=\"./aanalyzer/screen.js\" type=\"text/javascript\"></script>";

	$smarty->assign("howto_starter", htmlspecialchars ($howto_starter));
	$smarty->assign("howto_target", htmlspecialchars ("\$target=\"".$howto_target."\";"));
	$smarty->assign("howto_include", htmlspecialchars ($howto_include));
	$smarty->assign("howto_ender", htmlspecialchars ($howto_ender));
	$smarty->assign("howto_javascript", htmlspecialchars ($howto_javascript));
	$smarty->assign("language", $conf_lang);
	$smarty->display('create_target.tpl');

}else{
	//로그인 화면으로
	AokioCommonManager::redirectPage("login.php");

}

?>