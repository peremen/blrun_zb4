<?php

require_once 'Aokio.Dao.class.php';

class AokioInstallDao extends AokioDao{

	//Constructor
	function AokioInstallDao($info =false){
		if(!$info){
			parent::AokioDao();
		}else{
			$this->getDBInfoCheck($info);
		}
	}
	function getDBInfoCheck($info){
		$type	= $info[0];
		$id		= $info[1];
		$pw		= $info[2];
		$host		= $info[3];
		$db		= $info[4];
		$this -> dsn = "$type://$id:$pw@$host/$db";

		$this->php_type_for_db_variation = $type;

	}

	function connectionCheck(){	
		//Connect using an array for the DSN information
		$db =& DB::connect($this -> dsn);
	
		if (PEAR::isError($db)) {
//			die($db->getMessage());
			return false;
		}
		$db->disconnect();
		return true;
	}

	function isInitiatedApplication($db){
		$sql  = " show tables like 'aokio_admin%'";
		return $this->getAokioList($sql,array(),$db);
	}

	function createAnalyzeTargetTable($target,$db){
		$sql  = " CREATE TABLE aokio_analyze_$target ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " ip varchar(20) default NULL, ";
		$sql .= " referer varchar(250) default NULL, ";

		$sql .= " browser_name varchar(50) default NULL,";				//2006-04-12 수정
		$sql .= " browser_version varchar(50) default NULL,";			//2006-04-12 수정
		$sql .= " browser_build_date varchar(50) default NULL,";		//2006-04-12 수정
		$sql .= " browser_security varchar(50) default NULL,";			//2006-04-12 수정
		$sql .= " browser_type int(5) default 0,";								//2006-04-12 수정
		$sql .= " browser_dom_info varchar(10) default 0,";				//2006-04-12 수정
		$sql .= " browser_xhtml_info varchar(10) default 0,";			//2006-04-12 수정

		$sql .= " browser_cookie_info varchar(10) default 0,";			//2006-04-12 수정
		$sql .= " browser_javascript_info varchar(10) default 0,";		//2006-04-12 수정
		$sql .= " mozilla_flag varchar(50) default NULL,";					//2006-04-12 수정
		$sql .= " mozilla_version varchar(50) default NULL,";				//2006-04-12 수정

		$sql .= " os_category varchar(50) default NULL, ";

		$sql .= " os_full_name varchar(100) default NULL, ";
		$sql .= " os_name varchar(100) default NULL, ";
		$sql .= " os_version varchar(50) default NULL, ";
		$sql .= " os_sp_info varchar(50) default NULL, ";
		$sql .= " os_net_frame varchar(250) default NULL, ";

		$sql .= " processor_info varchar(100) default NULL, ";
		$sql .= " tablet_info varchar(100) default NULL, ";

		$sql .= " useragent varchar(250) default NULL, ";

		$sql .= " screensize varchar(15) default NULL, ";
		$sql .= " resolution varchar(20) default NULL, ";
		
		$sql .= " mobile_flag int(1) default 0, ";
		
		$sql .= " language varchar(5) default NULL, ";
		$sql .= " nation varchar(30) default NULL, ";

		$sql .= " regtime datetime default NULL, ";
		$sql .= " year int(4) default NULL, ";
		$sql .= " month int(2) default NULL, ";
		$sql .= " day int(2) default NULL, ";
		$sql .= " hour int(2) default NULL, ";
		$sql .= " week int(1) default NULL,  ";

		$sql .= " nation_code varchar(2) default NULL, ";
		$sql .= " nation_code_3 varchar(3) default NULL, ";
		$sql .= " city varchar(50) default NULL, ";
		$sql .= " bookmark int(1) default 0, ";								//2006.3.3 추가
		$sql .= " language_info varchar(250) default NULL, ";
		$sql .= " via_proxy_flag int(1) default 0, ";
		$sql .= " http_via_info varchar(250) default NULL, ";
//		$sql .= " remote_host_info varchar(250) default NULL, ";

		$sql .= " visit_count int(10) default NULL, ";						//방문자 방문횟수
		$sql .= " latitude varchar(10) default NULL, ";
		$sql .= " longitude varchar(10) default NULL, ";
		$sql .= " isp varchar(50) default NULL, ";

		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

	function insertInitialConfigRecord($target,$db){
		$sql  = " INSERT into aokio_log_config ";
		$sql .= " (target,total,max,lists_per_page,access_check_pattern, ";
		$sql .= " access_check_pattern_input_time,check_admin_access,access_permission,target_name) ";
		$sql .= " values('$target',0,0,10,0,0,0,NULL,'$target')";
		$this->insertAokioInfo($sql,$target_arr,$db);
	}

	function createAdminTable($db){
		$sql  = " CREATE TABLE aokio_admin (";
		$sql .= " no int(3) NOT NULL auto_increment, ";
		$sql .= " id varchar(20) default NULL, ";
		$sql .= " password varchar(20) default NULL, ";
		$sql .= " language varchar(20) default NULL, ";
		$sql .= " menu_type int(1) default 0, ";
		$sql .= " PRIMARY KEY (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}


	function createBrowserTable($db){
		$sql  = " CREATE TABLE aokio_log_browser ( ";
		$sql .= " no int(10) NOT NULL auto_increment,";
		$sql .= " browser_category varchar(50) default NULL,";
		$sql .= " browser_full_name varchar(50) default NULL,";			//2006-04-12 수정

		$sql .= " counts int(10) default NULL,";
		$sql .= " target varchar(30) default NULL,";
		$sql .= " PRIMARY KEY (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

	function createConfigTable($db){
		$sql  = " CREATE TABLE aokio_log_config ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " target varchar(250) default NULL, ";
		$sql .= " total int(10) default 0, ";
		$sql .= " max int(10) default 0, ";
		$sql .= " pv_total int(10) default 0, ";
		$sql .= " pv_max int(10) default 0, ";

		$sql .= " lists_per_page int(10) default 10, ";
		$sql .= " access_check_pattern int(1) default 1, ";
		$sql .= " access_check_pattern_input_time int(5) default 0, ";
		$sql .= " check_admin_access int(1) default 0, ";
		$sql .= " access_permission varchar(30) default null, ";
		$sql .= " target_name varchar(50) default null, ";
		$sql .= " portal_page int(3) default 0, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);


	}

	function createLanguageTable($db){
		$sql  = " CREATE TABLE aokio_log_language ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " language varchar(20) default NULL, ";
		$sql .= " counts int(10) default NULL, ";
		$sql .= " target varchar(30) default NULL, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);

	}

	function createNationTable($db){
		$sql  = " CREATE TABLE aokio_log_nation ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " nation varchar(20) default NULL, ";
		$sql .= " nation_code varchar(2) default NULL, ";
		$sql .= " nation_code_3 varchar(3) default NULL, ";
		$sql .= " counts int(10) default NULL, ";
		$sql .= " target varchar(30) default NULL, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

	function createOsTable($db){
		$sql  = " CREATE TABLE aokio_log_os ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";

		$sql .= " os_category varchar(50) default NULL, ";
		$sql .= " os_full_name varchar(50) default NULL, ";
		$sql .= " counts int(10) default NULL, ";
		$sql .= " target varchar(30) default NULL, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

	function createTimeTable($db){
		$sql = " CREATE TABLE aokio_log_time ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " year int(4) default null, ";
		$sql .= " month int(2) default null, ";
		$sql .= " day int(2) default null, ";
		$sql .= " h00 int(10) default 0, ";
		$sql .= " h01 int(10) default 0, ";
		$sql .= " h02 int(10) default 0, ";
		$sql .= " h03 int(10) default 0, ";
		$sql .= " h04 int(10) default 0, ";
		$sql .= " h05 int(10) default 0, ";
		$sql .= " h06 int(10) default 0, ";
		$sql .= " h07 int(10) default 0, ";
		$sql .= " h08 int(10) default 0, ";
		$sql .= " h09 int(10) default 0, ";
		$sql .= " h10 int(10) default 0, ";
		$sql .= " h11 int(10) default 0, ";
		$sql .= " h12 int(10) default 0, ";
		$sql .= " h13 int(10) default 0, ";
		$sql .= " h14 int(10) default 0, ";
		$sql .= " h15 int(10) default 0, ";
		$sql .= " h16 int(10) default 0, ";
		$sql .= " h17 int(10) default 0, ";
		$sql .= " h18 int(10) default 0, ";
		$sql .= " h19 int(10) default 0, ";
		$sql .= " h20 int(10) default 0, ";
		$sql .= " h21 int(10) default 0, ";
		$sql .= " h22 int(10) default 0, ";
		$sql .= " h23 int(10) default 0, ";
		$sql .= " today int(10) default 0, ";

		$sql .= " pv_h00 int(10) default 0, ";
		$sql .= " pv_h01 int(10) default 0, ";
		$sql .= " pv_h02 int(10) default 0, ";
		$sql .= " pv_h03 int(10) default 0, ";
		$sql .= " pv_h04 int(10) default 0, ";
		$sql .= " pv_h05 int(10) default 0, ";
		$sql .= " pv_h06 int(10) default 0, ";
		$sql .= " pv_h07 int(10) default 0, ";
		$sql .= " pv_h08 int(10) default 0, ";
		$sql .= " pv_h09 int(10) default 0, ";
		$sql .= " pv_h10 int(10) default 0, ";
		$sql .= " pv_h11 int(10) default 0, ";
		$sql .= " pv_h12 int(10) default 0, ";
		$sql .= " pv_h13 int(10) default 0, ";
		$sql .= " pv_h14 int(10) default 0, ";
		$sql .= " pv_h15 int(10) default 0, ";
		$sql .= " pv_h16 int(10) default 0, ";
		$sql .= " pv_h17 int(10) default 0, ";
		$sql .= " pv_h18 int(10) default 0, ";
		$sql .= " pv_h19 int(10) default 0, ";
		$sql .= " pv_h20 int(10) default 0, ";
		$sql .= " pv_h21 int(10) default 0, ";
		$sql .= " pv_h22 int(10) default 0, ";
		$sql .= " pv_h23 int(10) default 0, ";
		$sql .= " pv_today int(10) default 0, ";

		$sql .= " target varchar(30) default NULL, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

	function createWeekTable($db){		
		$sql = " CREATE TABLE aokio_log_week ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " target varchar(30) default NULL, ";
		$sql .= " w0 int(10) default 0, ";
		$sql .= " w1 int(10) default 0, ";
		$sql .= " w2 int(10) default 0, ";
		$sql .= " w3 int(10) default 0, ";
		$sql .= " w4 int(10) default 0, ";
		$sql .= " w5 int(10) default 0, ";
		$sql .= " w6 int(10) default 0, ";
		$sql .= " w_this_0 int(10) default 0, ";
		$sql .= " w_this_1 int(10) default 0, ";
		$sql .= " w_this_2 int(10) default 0, ";
		$sql .= " w_this_3 int(10) default 0, ";
		$sql .= " w_this_4 int(10) default 0, ";
		$sql .= " w_this_5 int(10) default 0, ";
		$sql .= " w_this_6 int(10) default 0, ";
		$sql .= " w_counts_0 int(10) default 0, ";
		$sql .= " w_counts_1 int(10) default 0, ";
		$sql .= " w_counts_2 int(10) default 0, ";
		$sql .= " w_counts_3 int(10) default 0, ";
		$sql .= " w_counts_4 int(10) default 0, ";
		$sql .= " w_counts_5 int(10) default 0, ";
		$sql .= " w_counts_6 int(10) default 0, ";
		$sql .= " w_start_flag_0 int(10) default 0, ";
		$sql .= " w_start_flag_1 int(10) default 0, ";
		$sql .= " w_start_flag_2 int(10) default 0, ";
		$sql .= " w_start_flag_3 int(10) default 0, ";
		$sql .= " w_start_flag_4 int(10) default 0, ";
		$sql .= " w_start_flag_5 int(10) default 0, ";
		$sql .= " w_start_flag_6 int(10) default 0, ";
//		$sql .= " start_flag int(1) default 0, ";
//		$sql .= " week_counts int(10) default 0, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

	function insertInitialWeekRecord($target_arr,$db){
		$sql = " INSERT into aokio_log_week ";
		$sql .= " (target ) ";
		$sql .= " values(?)";
//		$sql .= " (target,w0,w1,w2,w3,w4,w5,w6 ) ";
//		$sql .= " values(?,0,0,0,0,0,0,0)";
		$this->insertAokioInfo($sql,$target_arr,$db);
	}

	function createRobotTable($db){
		$sql  = " CREATE TABLE aokio_log_robot ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " useragent varchar(250) default NULL, ";
		$sql .= " counts int(10) default 0,  ";
		$sql .= " target varchar(30) default NULL,  ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

	function createRobotTargetTable($target,$db){
		$sql  = " CREATE TABLE aokio_robot_$target ( ";
		$sql  .= " no int(10) NOT NULL auto_increment, ";
		$sql  .= " ip varchar(20) default NULL, ";
		$sql  .= " useragent varchar(250) default NULL, ";
		$sql  .= " referer varchar(250) default NULL, ";
		$sql  .= " nation varchar(30) default NULL, ";
		$sql  .= " nation_code varchar(2) default NULL, ";
		$sql  .= " nation_code_3 varchar(3) default NULL, ";
		$sql  .= " regtime datetime default NULL,  ";
		$sql  .= " PRIMARY KEY  (no) ";
		$sql  .= " ) ";
		$this->createAokioInfo($sql,$db);
	}


	function createCityTable($db){
		$sql   = " CREATE TABLE aokio_log_city ( ";
		$sql  .= " no int(10) NOT NULL auto_increment, ";
		$sql  .= " city varchar(50) default NULL, ";
		$sql  .= " counts int(10) default NULL, ";
		$sql  .= " target varchar(30) default NULL, ";
		$sql  .= " PRIMARY KEY  (no) ";
		$sql  .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

	function createRefererServerTable($db){		
		$sql = " CREATE TABLE aokio_log_refererserver ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " refererserver varchar(250) default NULL, ";
		$sql .= " counts int(10) default NULL, ";
		$sql .= " target varchar(30) default NULL, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

	function createRefererTable($db){		
		$sql = " CREATE TABLE aokio_log_referer ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " referer varchar(250) default NULL, ";
		$sql .= " counts int(10) default NULL, ";
		$sql .= " target varchar(30) default NULL, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

	function createScreensizeTable($db){		
		$sql = " CREATE TABLE aokio_log_screensize ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " screensize varchar(50) default NULL, ";
		$sql .= " counts int(10) default NULL, ";
		$sql .= " target varchar(30) default NULL, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}


	function createResolutionTable($db){		
		$sql = " CREATE TABLE aokio_log_resolution ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " resolution varchar(20) default NULL, ";
		$sql .= " bit int(4) default NULL, ";
		$sql .= " counts int(10) default NULL, ";
		$sql .= " target varchar(30) default NULL, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}


	function createSearchKeywordsTable($db){		
		$sql  = " CREATE TABLE aokio_log_search_keywords ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " keyword varchar(250) default NULL, ";
		$sql .= " search_year int(4) default NULL, ";
		$sql .= " search_month int(2) default NULL, ";
//		$sql .= " search_day int(2) default NULL, ";
		$sql .= " counts int(10) default NULL, ";
		$sql .= " target varchar(30) default NULL, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

	function createSearchSitesTable($db){		
		$sql = " CREATE TABLE aokio_log_search_sites ( ";
		$sql .= " no int(10) NOT NULL auto_increment, ";
		$sql .= " searchsite varchar(250) default NULL, ";
//		$sql .= " keyword int(250) default NULL, ";
		$sql .= " counts int(10) default NULL, ";
		$sql .= " target varchar(30) default NULL, ";
		$sql .= " PRIMARY KEY  (no) ";
		$sql .= " ) ";
		$this->createAokioInfo($sql,$db);
	}

}
?>