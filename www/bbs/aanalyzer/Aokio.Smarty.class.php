<?php
ini_set("include_path",dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'lib'.PATH_SEPARATOR.dirname(realpath(__FILE__)));

require_once dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'lib/Smarty/Smarty.class.php';
class  AokioSmarty extends Smarty {

	function AokioSmarty(){
		parent::Smarty();
		$smarty->template_dir	= './templates/';
		$smarty->compile_dir	= './templates_c/';
		$smarty->compile_check = true;
		$smarty->debugging = false;
//		$this->caching = false;
	}

	function setInitialEnvironments($config){
		$appli_name = $config->application_name." ".$config->version."  Since  ".$config->since;
		$my_nick = $config->my_nick[array_rand($config->my_nick)];
		
		$this->assign("html_title",					$config->code_name);
		$this->assign("application_name_version",	$appli_name);
		$this->assign("encoding",					$config->encoding);
		$this->assign("code_name",					$config->code_name);
		$this->assign("my_home",					$config->my_home);
		$this->assign("my_email",					$config->my_email);
		$this->assign("my_nick",					$my_nick);
		$this->assign("analysis_view_file_name",	$config->analysis_view_file_name);
		$this->assign("application_name",			$config->application_name);

		unset($appli_name);
		unset($my_nick);
	}
}
?>