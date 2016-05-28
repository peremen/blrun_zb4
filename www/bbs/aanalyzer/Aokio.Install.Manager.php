<?php
/**
 * Project:     
 *

 *
 * @link http://www.aokio.com/
 * @copyright 2006- 
 * @author aokio   <st.elmo@gmail.com>
 * @package AokioAnalyzer
 */


 /**
 * @package 
 */
 require_once 'Aokio.Install.Dao.php';
require_once 'Aokio.Auth.Dao.php';

class AokioInstallManager{	
	
	function initiateApplication(){
		$install_dao = new AokioInstallDao();
		$db = $install_dao -> getConnection();
		
		$install_dao ->createAdminTable($db);
		$install_dao ->createBrowserTable($db);
		$install_dao ->createConfigTable($db);
		$install_dao ->createLanguageTable($db);
		$install_dao ->createNationTable($db);
		$install_dao ->createOsTable($db);
		$install_dao ->createTimeTable($db);
		$install_dao ->createWeekTable($db);
		$install_dao ->createRobotTable($db);
		$install_dao ->createRefererServerTable($db);
		$install_dao ->createRefererTable($db);
		$install_dao ->createScreensizeTable($db);
		$install_dao ->createResolutionTable($db);
		$install_dao ->createCityTable($db);
		$install_dao ->createSearchKeywordsTable($db);
		$install_dao ->createSearchSitesTable($db);

//		$install_dao ->createPageviewTable($db);
		$install_dao->closeConnection($db);

	}


	function initiateTarget($target){
		$install_dao = new AokioInstallDao();
		$db = $install_dao -> getConnection();
//		echo "<pre>".nl2br(print_r($target,true))."</pre>";
		
		$install_dao ->createAnalyzeTargetTable($target,$db);
		$install_dao ->createRobotTargetTable($target,$db);

		$target_arr = array($target);
		$install_dao ->insertInitialConfigRecord($target,$db);
		// week
		$install_dao ->insertInitialWeekRecord($target_arr,$db);

		$install_dao->closeConnection($db);
		unset($target_arr);

	}


	function isInitiatedApplication(){
		$install_dao = new AokioInstallDao();
		$db = $install_dao -> getConnection();
		$temp = $install_dao ->isInitiatedApplication($db);
//		echo "<pre>".nl2br(print_r($temp,true))."</pre>";
		if($install_dao ->isInitiatedApplication($db) != null){
			$install_dao->closeConnection($db);
			return true;
		}
		$install_dao->closeConnection($db);
		return false;
	}


	function checkConnectTest($req_array){
		$check_arr = array(	
							$req_array['db_select'],
							$req_array['userid'],
							$req_array['password'],
							$req_array['host'],
							$req_array['db']
									);
		$install_dao = new AokioInstallDao($check_arr);
		return $install_dao -> connectionCheck();
	}

}
?>