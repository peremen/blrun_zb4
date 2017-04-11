<?php
/*
// +----------------------------------------------------------------------+
// +----------------------------------------------------------------------+
// | Authors: Aokio <st.elmo@gmail.com>                                   |
// +----------------------------------------------------------------------+
//
//

/**
 * Utility class that analyze  information from useragent strings.
 *
 * @package  Aokio_Analyzer_Time
 * @category
 * @author   Aokio <st.elmo@gmail.com>
 * @access   public
 * @version  $Revision: 0.1 $
 */

define('GEO_DIR' ,dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'geoip'.DIRECTORY_SEPARATOR);
require_once(GEO_DIR.'geoip.php');
//require_once(GEO_DIR.'geoipcity.php');

class Aokio_Analyzer_Geo{

	var $nation_name;
	var $nation_code;
	var $nation_code3;

	var $city;
	var $latitude;
	var $longitude;
	var $isp;

	//constructor
	function Aokio_Analyzer_Geo($ip){
		$this->setGeoInfo($ip);
	}

	function setGeoInfo($ip){

		$gi = geoip_open(GEO_DIR."GeoIP.dat",GEOIP_STANDARD);
		$this->nation_name	= geoip_country_name_by_addr($gi, $ip);
		$this->nation_code		= strtolower(geoip_country_code_by_addr($gi, $ip));

//		$this->nation_code3	=null;
//		$this->city = null;
		geoip_close($gi);


		/*	require_once(dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'geoip'.DIRECTORY_SEPARATOR.'geoipcity.php');
		$gi = geoip_open(GEO_DIR."GeoLiteCity.dat",GEOIP_STANDARD);
		$record = geoip_record_by_addr($gi,$this->getIP());
		$this->city	=$record->city;
		$this->latitude		=$record->latitude;
		$this->longitude	=$record->longitude;

		geoip_close($gi);
		*/
	}
}
?>