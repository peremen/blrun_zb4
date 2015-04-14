<?php
ob_start();
//ini_set("error_reporting",E_ALL);
require_once "Aokio.Auth.Manager.php";
require_once "Aokio.Config.class.php";
require_once "Aokio.Install.Manager.php";
require_once 'Aokio.Smarty.class.php';
require_once "Aokio.Cookie.class.php";
//ini_set("include_path",dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'lib');
//initial environment cofig
$smarty = new AokioSmarty();

//직접입력값으로 컨넥션 확인.
$initial = true;
$config = new Aokio_Config($initial);
//$config = new Aokio_Config();

$smarty->setInitialEnvironments($config);
//$filename = $config->config_file_name;

// 재미로...^^
$install_logo_image_arrary = array(	'install_top01.gif',
									'install_top02.gif',
									'install_top03.gif',
									'install_top04.gif',
									'install_top05.gif',);
$logo_image = $install_logo_image_arrary[array_rand($install_logo_image_arrary)];

// language select page;
// 1st step of the install
if(!isset( $_REQUEST['install_step']) || $_REQUEST['install_step']== null  ){
	$install_step = 1;
	$install_language_array = $config->lang_list;
	$smarty->assign("install_language", $install_language_array);
}else{
	//If there is GET request ,redirect error page;
	if(isset($_GET) && $_GET !=null){
		$install_step = 99;
		//TODO 공통 리다이렉트 함수 사용할꺼
	}else{
		$sel_lang = $_REQUEST['language'];
		include("./resources/".$sel_lang."_lang_resource.php");
		if(isset($_REQUEST['install_step']) && $_REQUEST['install_step'] ==1){
			$install_step = 2;
			// 이용 규약 화면
			//language 값 다음 단계로 넘길것
			//언어팩에서 선택 언어로 화면 표시 .
			$install_messages = $install_messages['terms_of_service'];

			$smarty->assign("install_messages", $install_messages);
			$smarty->assign("language", $sel_lang);
			$smarty->assign("install_step", $install_step);

		}elseif(isset($_REQUEST['install_step']) && $_REQUEST['install_step'] ==2){
			$install_step = 3;
			// 데이터베이스 선택 화면
			$db_list = $config->db_list;
			$install_messages = $install_messages['database_select'];

			$smarty->assign("install_messages", $install_messages);
			$smarty->assign("language", $sel_lang);
			$smarty->assign("db_list", $db_list);

		}elseif(isset($_REQUEST['install_step']) && $_REQUEST['install_step'] ==3){
			$install_step = 4;
			//데이터 베이스 설정화면
			$sel_lang = $_REQUEST['language'];
			$sel_db	  = $_REQUEST['db_select'];
			$install_messages	= $install_messages['database_config'];

			$smarty->assign("language", $sel_lang);
			$smarty->assign("install_messages", $install_messages);
			$smarty->assign("db_select", $sel_db);

		}elseif(isset($_REQUEST['install_step']) && $_REQUEST['install_step'] ==4){
			//데이터 베이스 설정화면
			//config.php 파일 작성
			//if config.php 가 존재 하면 인스톨 불가.
			//삭제후 재인스톨...
			$sel_db	  = $_REQUEST['db_select'];
			$smarty->assign("language", $sel_lang);
			$smarty->assign("db_select", $sel_db);

			$filename = $config->config_file_name;
			$req_array = $_REQUEST;
			$wrong_db_config_flag =false;
			$file_exist_flag = false;
			if (file_exists($filename)) {
				$install_step = 4;
				$error_message = $install_messages['error_messages'];
				$smarty->assign("error_message", $error_message);
				$file_exist_flag = true;
				$smarty->assign("file_exist_flag", $file_exist_flag);
				$install_messages = $install_messages['database_config'];
				$smarty->assign("install_messages", $install_messages);
				$smarty->assign("req", $req_array);
			} else {
				
				$path = dirname(realpath(__FILE__));
				//컨넥트해봐서 컨넥트가 가능한가 어떤가...
				//에러면...되돌리기...
				
				if(!AokioInstallManager::checkConnectTest($req_array)){

					$install_step = 4;
					$error_message = $install_messages['error_messages'];
					$smarty->assign("error_message", $error_message);
					$wrong_db_config_flag =true;
					$smarty->assign("wrong_db_config_flag", $wrong_db_config_flag);
					$install_messages = $install_messages['database_config'];
					$smarty->assign("install_messages", $install_messages);
					$smarty->assign("req", $req_array);
				}else{

					$filehandle = @fopen($filename, "w");
					if(!$filehandle){
						//파일초기화에 실패
						//TODO 관련 처리필요
						$install_step = 4;
						$error_message = $install_messages['error_messages'];
						$smarty->assign("error_message", $error_message);
						$smarty->assign("file_handling_error", true);
					}else{
						$db_select	= $req_array['db_select'];
						$userid		= $req_array['userid'];
						$password	= $req_array['password'];
						$host		= $req_array['host'];
						$db			= $req_array['db'];
						$install_messages = $install_messages['administrator_config'];
						$smarty->assign("install_messages", $install_messages);
						$install_step = 5;
						fwrite($filehandle,"<?php\n\$phptype = \"$db_select\";\n\$username=\"$userid\";\n\$password=\"$password\";\n\$hostspec=\"$host\";\n\$database=\"$db\";\n?>");
						fclose($filehandle);
					}
				}
			}
		}elseif(isset($_REQUEST['install_step']) && $_REQUEST['install_step'] ==5){
			$smarty->assign("language", $sel_lang);
			$admin_input_is_no_flag = false;
			$admin_input_is_wrong_flag = false;
			//인스톨 완료
			if($_REQUEST['adminid']== null || $_REQUEST['adminpassword'] == null){
				$install_step = 5;
				$error_message = $install_messages['error_messages'];
				$install_messages = $install_messages['administrator_config'];
				$smarty->assign("install_messages", $install_messages);
				
				$smarty->assign("error_message", $error_message);
				$admin_input_is_no_flag = true;
				$smarty->assign("admin_input_is_no_flag", $admin_input_is_no_flag);
//echo "<pre>".nl2br(print_r($install_messages,true))."</pre>";
			}elseif(!AokioCommonManager::isAlphbetNumeric ($_REQUEST['adminid']) ||
					!AokioCommonManager::isAlphbetNumeric ($_REQUEST['adminpassword'])){
				$install_step = 5;
				$error_message = $install_messages['error_messages'];
				$install_messages = $install_messages['administrator_config'];
				$smarty->assign("install_messages", $install_messages);
				
				$smarty->assign("error_message", $error_message);
				$admin_input_is_wrong_flag = true;
				$smarty->assign("admin_input_is_wrong_flag", $admin_input_is_wrong_flag);
				
			}else{
				$install_step = 6;
				$admin_info = array($_REQUEST['adminid'],$_REQUEST['adminpassword'],$sel_lang);
				$error_message = $install_messages['error_messages'];
				$install_messages = $install_messages['install_completed'];
				$smarty->assign("install_messages", $install_messages);
				$is_initiated_flag = false;
				// 초기 필요 테이블 생성
				if(AokioInstallManager::isInitiatedApplication()){
					
					$smarty->assign("error_message", $error_message);
					$is_initiated_flag = true;
					$smarty->assign("is_initiated_flag", $is_initiated_flag);
				}else{
					AokioInstallManager::initiateApplication();
					AokioAuthManager::insertAdmin($admin_info);
					// TODO 세션 설정후 관리화면으로 가는 링크 ?
					$admin_cookie = new Aokio_Cookie();
					$cookie_admin_info = array(	'adminid'			=>$_REQUEST['adminid'],
												'adminpassword'		=>$_REQUEST['adminpassword']);
					$admin_cookie->setAdminCookieInfo($cookie_admin_info);
					$smarty->assign("application_name", $config->application_name);
				}

			}
//			AokioCommonManager::redirectPage("manager.php");
		}
	}
}
$smarty->assign("logo_image", $logo_image);
$smarty->assign("install_step", $install_step);
$smarty->display('install.tpl');
?>