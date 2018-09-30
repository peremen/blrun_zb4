<?php
require_once 'Aokio.Auth.Manager.php';
class Aokio_Cookie{

	//constructor
	function __construct(){
//ini_set("error_reporting",2039);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function isExistAdminCookieInfo(){
//		echo "<pre>".nl2br(print_r($_COOKIE,true))."</pre>";
		if(	isset($_COOKIE['AOKIOANALYZER_ADMIN'])){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function setAdminCookieInfo($admin_info){

		$cookie_md5_value = md5($admin_info['adminid'].$admin_info['adminpassword']);

		setcookie("AOKIOANALYZER_ADMIN", $cookie_md5_value,0,"/");
	}


	function clearAdminCookieInfo(){
		setcookie("AOKIOANALYZER_ADMIN",0,0,"/");
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function checkAdminCookieInfo(){
		$admin_info = AokioAuthManager::getAdminInfo();
//		echo "<pre>".nl2br(print_r($admin_info,true))."</pre>";

		$value = md5($admin_info['id'].$admin_info['password']);
		if(isset($_COOKIE['AOKIOANALYZER_ADMIN']) &&
			$_COOKIE['AOKIOANALYZER_ADMIN'] == $value){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function setAccessUserCookieInfo($conf_info,$target){

		//0;매번 접속 체크
		//1;브라우저를 다시 시작할때만 체크
		//2;하루에 한번
		//3;지정시간에 한번
		$cookie_conf = $conf_info['access_check_pattern'];

		if($cookie_conf == 0){
			setcookie("AOKIOANALYZER_".$target,0,0,'/');
			return true;

		}elseif($cookie_conf == 1){
			if(!$_COOKIE["AOKIOANALYZER_".$target]){
				setcookie("AOKIOANALYZER_".$target,time(),0,'/');
				return true;
			}
			return false;

		}elseif($cookie_conf == 2){
			$before_time=date('Y-m-d',$_COOKIE["AOKIOANALYZER_".$target]);
			$this_time=date('Y-m-d');
			if($before_time!=$this_time){
				setcookie("AOKIOANALYZER_".$target,time(),time()+60*60*24*30,'/');
				return true;
			}
			return false;
		}elseif($cookie_conf == 3){
			$temp_time=time()-$_COOKIE["AOKIOANALYZER_".$target];
			$access_input_time = $conf_info['access_check_pattern_input_time'];
			if($temp_time>$access_input_time){
				setcookie("AOKIOANALYZER_".$target,time(),time()+$access_input_time,'/');
				return true;
			}
			return false;
		}
	}
}
?>