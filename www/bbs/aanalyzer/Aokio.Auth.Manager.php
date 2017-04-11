<?php
require_once 'Aokio.Auth.Dao.php';
require_once "Aokio.Config.Manager.php";

class AokioAuthManager{

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function checkAdmin($user_info){
		$auth_dao = new AokioAuthDao();
		$db = $auth_dao -> getConnection();

		if($auth_dao ->isExistAdminInfo($user_info,$db)){
			$auth_flag =  true;
		}else{
			$auth_flag =  false;
		}
		$auth_dao->closeConnection($db);

		return $auth_flag;
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */

	function getAdminInfo(){
		$auth_dao = new AokioAuthDao();
		$db = $auth_dao -> getConnection();
		$admin_info = $auth_dao ->getAdminInfo($db);
		$auth_dao->closeConnection($db);

		return $admin_info;
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function insertAdmin($user_info){
		$auth_dao = new AokioAuthDao();
		$db = $auth_dao -> getConnection();

		$auth_dao ->insertAdmin($user_info,$db);
		$auth_dao->closeConnection($db,true);
	}



	function getAccessPermission($mode,$target){
		$temp_info = AokioConfigManager::getTargetConfigInfos($target);
		$temp_arr = preg_split("#,#",$temp_info['access_permission']);
		$access_permission = array();

		foreach($temp_arr as $key => $value){
			$access_permission[$value] =$value;
		}
		return $access_permission;
	}

	function checkAccessPermission($target_conf_info,$mode){
		// 먼저 접근권한 전체 확인후 전체에대해 불허 상태이면
		// 에러 보냄
		// 전체 불허가 아니면
		// 모드와 접근권한 을 확인 후 true나 false 를 보냄
			if(array_search($mode,$target_conf_info)){
				return true;
			}
			return false;
	}
}
?>