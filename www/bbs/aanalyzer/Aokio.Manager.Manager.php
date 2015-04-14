<?php
require_once 'Aokio.Manager.Dao.php';

class AokioManagerManager{	

	function dropTargetInfos($target){
		$man_dao = new AokioManagerDao();
		$db = $man_dao -> getConnection();
		$man_dao ->dropTargetAnalyzeTable($target,$db);
		$man_dao ->dropTargetRobotTable($target,$db);
		$man_dao ->deleteTargetBrowserLogInfos($target,$db);
//		$man_dao ->deleteTargetCityLogInfos($target,$db);
		$man_dao ->deleteTargetCofigInfos($target,$db);
		$man_dao ->deleteTargetLanguageLogInfos($target,$db);
		$man_dao ->deleteTargetNationLogInfos($target,$db);
		$man_dao ->deleteTargetOSLogInfos($target,$db);
		$man_dao ->deleteTargetRefererLogInfos($target,$db);
		$man_dao ->deleteTargetRefererServerLogInfos($target,$db);
		$man_dao ->deleteTargetRobotLogInfos($target,$db);
		$man_dao ->deleteTargetTimeLogInfos($target,$db);
		$man_dao ->deleteTargetWeekLogInfos($target,$db);
		$man_dao ->deleteTargetScreensizeLogInfos($target,$db);
		$man_dao ->deleteTargetResolutionLogInfos($target,$db);
		$man_dao ->deleteTargetSearchKeywordsLogInfos($target,$db);
		$man_dao ->deleteTargetSearchSiteLogInfos($target,$db);
		$man_dao->closeConnection($db,true);
	}

	function truncateTargetInfos($target){
		$man_dao = new AokioManagerDao();
		$db = $man_dao -> getConnection();
		//각 테이블에서 삭제..
		$man_dao ->truncateTargetRobotTable($target,$db);
		$man_dao ->truncateTargetAnalyzeTable($target,$db);		
		$man_dao ->deleteTargetBrowserLogInfos($target,$db);
//		$man_dao ->deleteTargetCityLogInfos($target,$db);
		$man_dao ->initiateTargetCofigInfos($target,$db);
		$man_dao ->deleteTargetLanguageLogInfos($target,$db);
		$man_dao ->deleteTargetNationLogInfos($target,$db);
		$man_dao ->deleteTargetOSLogInfos($target,$db);
		$man_dao ->deleteTargetRefererLogInfos($target,$db);
		$man_dao ->deleteTargetRefererServerLogInfos($target,$db);
		$man_dao ->deleteTargetRobotLogInfos($target,$db);
		$man_dao ->deleteTargetTimeLogInfos($target,$db);
		$man_dao ->deleteTargetWeekLogInfos($target,$db);
		$man_dao ->insertInitialWeekRecord($target,$db);		
		$man_dao ->deleteTargetScreensizeLogInfos($target,$db);
		$man_dao ->deleteTargetResolutionLogInfos($target,$db);
		$man_dao ->deleteTargetSearchKeywordsLogInfos($target,$db);
		$man_dao ->deleteTargetSearchSiteLogInfos($target,$db);
		$man_dao->closeConnection($db,true);
	}

	function updateAokioAnalyzerConfig($manager_config_infos){
		$man_dao = new AokioManagerDao();
		$db = $man_dao -> getConnection();
		$man_dao ->updateAokioAnalyzerConfig($manager_config_infos,$db);
		$man_dao->closeConnection($db,true);
	}

}
?>