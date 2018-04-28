<?php
require_once 'Aokio.Config.Dao.php';
require_once "Aokio.Common.Manager.php";
require_once "Aokio.Analyze.Manager.php";

class AokioConfigManager{
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	public static function getApplicationConfigurationInfos(){
		$config_dao = new AokioConfigDao();
		$db = $config_dao -> getConnection();

		$conf_infos = $config_dao ->getApplicationConfigurationInfos($db);
		$config_dao->closeConnection($db);
		return $conf_infos;
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getTargetConfigList(){
		$config_dao = new AokioConfigDao();
		$db = $config_dao -> getConnection();

		$info_array = $config_dao ->getTargetConfigList($db);

		$day_info = AokioCommonManager::thisDayInfo();
		if(sizeof($info_array)>0){
			foreach($info_array as $key => $value){
				$info_array[$key]['v_no'] = $key+1;
				$today_counts = $config_dao ->getTargetTodayCounts($value['target'],$day_info,$db);
				if(!$today_counts['today']){
					$info_array[$key]['today'] = 0;
				}else{
					$info_array[$key]['today'] = $today_counts['today'];
				}
			}
		}
		$config_dao->closeConnection($db);
		return $info_array;
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getTargetConfigInfos($target){
		$config_dao = new AokioConfigDao();
		$db = $config_dao -> getConnection();

		$day_info = AokioCommonManager::thisDayInfo();
		$info_array = $config_dao ->getTargetConfigInfos($target,$db);

		if($info_array != null){
			$today_counts = $config_dao ->getTargetTodayCounts($target,$day_info,$db);
			if(!$today_counts['today']){
				$info_array['today'] = 0;
			}else{
				$info_array['today'] = $today_counts['today'];
			}
		}
		$config_dao->closeConnection($db);
		return $info_array;
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */


	function updateTargetConfigInfos($input_config_infos){
		$config_dao = new AokioConfigDao();
		$db = $config_dao -> getConnection();

		$config_dao ->updateTargetConfigInfos($input_config_infos,$db);
		$config_dao->closeConnection($db,true);
	}
}
?>