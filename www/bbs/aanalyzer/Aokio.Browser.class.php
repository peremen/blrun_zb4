<?php
/* 
// +----------------------------------------------------------------------+
// +----------------------------------------------------------------------+
// | Authors: Aokio <st.elmo@gmail.com>                                   |
// +----------------------------------------------------------------------+
//
//

/**
 * Utility class that analyze browser information from useragent strings.
 *
 * @package  Aokio_Analyzer_Browser
 * @category Networking
 * @author    Aokio <st.elmo@gmail.com>   
 * @access    public
 * @version   $Revision: 0.1 $
 */
define('TRIDENT',	1);
define('GECKO',		2);
define('KHTML',		3);
define('JAVA',			4);
define('OTHERS',	5);
define('MOBILE',		6);
define('TEXT',			7);
class Aokio_Analyzer_Browser{
	var $browser_category;			// 큰분류, 종류

	var $browser_full_name;		//br 이름
	var $browser_name;				//br 이름
	var $browser_version;			//버젼
	var $browser_build_date;
	var $browser_revision;
	var $browser_security;

	var $mozilla_flag;
	var $mozilla_version;
/*
	moz_types = new Array( 'Firebird', 'Phoenix', 'Firefox', 'Galeon', 'K-Meleon', 'Camino', 'Epiphany', 
		'Netscape6', 'Netscape', 'MultiZilla', 'Gecko Debian', 'rv' );

*/
	var $browser_cookie_info;
	var $browser_javascript_info;
	var $browser_xhtml_info;

	var $browser_type;
	//trident-based,gecko-based,khtml&webkit-based,java platform browsers,mobile browser,text browser

	var $dom_browser;

	var $useragent;

	//constructor
	function Aokio_Analyzer_Browser($useragent = null){
		if($useragent === null){
			if (isset($_SERVER['HTTP_USER_AGENT'])) {
				$this->useragent = $_SERVER['HTTP_USER_AGENT'];
			}elseif (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_USER_AGENT'])) {
				$this->useragent = $GLOBALS['HTTP_SERVER_VARS']['HTTP_USER_AGENT'];
			}
		}else{
			$this->useragent = $useragent;
		}
		$this->useragent =  strtolower($this->useragent);
		$this->_setBrowserInfo();

		$this->browser_full_name = $this->browser_name." ".$this->browser_version;
		$this->_setBrowserCookieInfo();
		$this->_setBrowserJavascriptInfo();

//		$this->_unsetObjectPropeties();
	}


	function _setBrowserCookieInfo(){

	}


	function _setBrowserJavascriptInfo(){

	}

	function _setBrowserInfo(){
			$this->_setBrowserCategory();
	}



// 브라우저 크게 분류

	
	function _setBrowserCategory(){
		$browser_category = "";
		$agent = $this->useragent;
		
		$browser_type =-99;

//TODO 스트링 안에 mathplayer 가 있으면 
//http://www.dessci.com/en/products/mathplayer/ 가 설치되어 있음.
//TODO 스트링 안에 istb 가 있으면 인포시크 툴바가 설치되어있음
//Mozilla/5.0 (compatible; MSIE 6.0;Windows; U; Windows NT 5.0; ja-JP; rv:1.7.5) Gecko/20041108 Firefox/1.0
// 이거 머야...? -,.- 머 이런넘이 다 있어....
		if( (ereg('msie',$agent)||ereg('rv:11',$agent)) && 
			!ereg('opr',$agent) && 
			!ereg('avant browser',$agent) && 
			!ereg('sleipnir',$agent) && 
			!ereg('lunascape',$agent)&& 
			!ereg('aol',$agent)&& 
			!ereg('america online browser ',$agent)){
			$browser = "Internet Explorer";

			$browser_type = TRIDENT;
		}elseif(ereg('opr',$agent)){
			$browser = "Opera";

			$browser_type = OTHERS;
		}elseif(ereg('avant browser',$agent) || ereg('advanced browser',$agent)){
			$browser = "Avant Browser";

			// 버젼 가져오기 힘드남?
			$browser_type = TRIDENT;
		}elseif(ereg('lunascape',$agent)){
			$browser = "Lunascape";
			$browser_type = OTHERS;

		}elseif(ereg('sleipnir',$agent)){
			//TODO if os가 unknown 이면 윈도우로 설정...
			$browser = "Sleipnir";
			$browser_type = OTHERS;

		}elseif(ereg('aol',$agent) || ereg('america online browser',$agent)){
			$browser = "America Online Browser";
			$browser_type = OTHERS;

		}elseif( ereg('gecko',$agent) && ereg('opr',$agent)){
			$browser = "Opera";
			$browser_type = GECKO;

		}elseif( ereg('gecko',$agent) && ereg('swing',$agent)){
			$browser = "Swing Browser";
			$browser_type = GECKO;

		}elseif( ereg('gecko',$agent) && ereg('chrome',$agent)){
			$browser = "Chrome";
			$browser_type = GECKO;

		}elseif( ereg('gecko',$agent) && ereg('firefox',$agent)){
			$browser = "Firefox";
			$browser_type = GECKO;

		}elseif( ereg('gecko',$agent) && ereg('seamonkey',$agent)){
			$browser = "SeaMonkey";
			$browser_type = GECKO;

		}elseif( ereg('gecko',$agent) && ereg('flock',$agent)){
			$browser = "Flock";
			$browser_type = GECKO;

		}elseif( ereg('gecko',$agent) && ereg('firebird',$agent)){
			$browser = "Firebird";
			$browser_type = GECKO;

		}elseif(ereg('safari',$agent) ){
			$browser = "Safari";
			$browser_type = KHTML;

		}elseif( 
			ereg('mozilla',$agent )   &&
			!ereg('spoofer',$agent)    &&
			!ereg('compatible',$agent) &&
			!ereg('hotjava',$agent)    &&
			!ereg('opr',$agent)      &&
			!ereg('webtv',$agent)      &&
			!ereg('swing',$agent)      &&
			!ereg('chrome',$agent)      &&
			!ereg('firefox',$agent)    &&
			!ereg('firebird',$agent)    &&
			!ereg('safari',$agent)    &&
			!ereg('seamonkey',$agent)  &&
			!ereg('flock',$agent)){

				if(ereg('netscape',$agent) ){
					//6. 대 이후?
					$browser = "Netscape6up";

				}elseif(ereg('gecko',$agent) ){
					$browser = "Mozilla";

				}else{
					// 5.0 이전?
					$browser = "Netscape";
				}
			$browser_type = TRIDENT;
		}elseif(ereg('konqueror',$agent)){
			$browser = "Konqueror";
		}elseif(ereg('shiira',$agent) ){
			$browser = "Shiira";
		}elseif(ereg('camino',$agent)){
			$browser = "Camino";
		}elseif(ereg('lynx',$agent)){
			$browser = "Lynx";
		}elseif(ereg('links',$agent)){
			$browser = "Links";
		}elseif(ereg('w3m',$agent)){
			$browser = "W3M";
		}elseif( ereg('amaya',$agent)){
			$browser = "Amaya";
		}elseif(ereg('kagetaka',$agent)){
			$browser = "Kagetaka";

		}elseif(ereg('omniweb',$agent)){
			$browser = "OmniWeb";
		}else{
			$browser = "Unknown Browser";
		}
		
		$browser_version = $this->_setBrowserVersion($browser,$agent);
		if($browser == "Netscape6up"){
			$this->browser_name = "Netscape";
		}else{
			$this->browser_name = $browser;
		}
		$this->browser_category = $this->browser_name;
		$this->browser_type = $browser_type;
		unset($browser);
		unset($agent);
	}


	function _setBrowserGeckoExtendedInfo($browser_name,$temp_array){

		$key = array_search($browser_name,$temp_array);
		$this->browser_version =  $temp_array[$key+1];
		$key = array_search('gecko',$temp_array);
		$this->browser_build_date =  $temp_array[$key+1];
		$key = array_search('rv',$temp_array);
		$this->browser_revision =  $temp_array[$key+1];
		$this->browser_security =  $temp_array[5];
	}


	function _setBrowserSafariVersion($browser_name,$temp_array){
			$key = array_search("version",$temp_array);
			$this->browser_version =  $temp_array[$key+1];
	}


	function _setBrowserSleipnirVersion($browser_name,$temp_array){
			$key = array_search('sleipnir',$temp_array);

			if($temp_array[$key+1] =="version"){
				$this->browser_version = $temp_array[$key+2];
			}else{
				$this->browser_version = $temp_array[$key+1];
			}
	}

	function _setBrowserCommonExtendedInfo($browser_name,$temp_array){
		$key = array_search($browser_name,$temp_array);
		$this->browser_version =  $temp_array[$key+1];
		if($browser_name== "msie"&& $this->browser_version =="6.0.2800"){
			$this->browser_version =="6.0";
		}
		//Netscape 1
		//Netscape 2,3 :navigator
		//Netscape 4.* communicator
		//Netscape 5---
		//
	}


	function _setBrowserVersion($browser,$agent){
		$temp_array=split(" ",eregi_replace("\(|/|;|:|)|-"," ",$agent));
//		echo "<pre>".nl2br(print_r($temp_array,true))."</pre>";
		if($browser =="Firefox"){
			$this->_setBrowserGeckoExtendedInfo("firefox",$temp_array);
		}elseif($browser =="Swing Browser"){
			$this->_setBrowserGeckoExtendedInfo('swing',$temp_array);
		}elseif($browser =="Chrome"){
			$this->_setBrowserGeckoExtendedInfo('chrome',$temp_array);
		}elseif($browser =="SeaMonkey"){
			$this->_setBrowserGeckoExtendedInfo('seamonkey',$temp_array);
		}elseif($browser =="Flock"){
			$this->_setBrowserGeckoExtendedInfo('flock',$temp_array);
		}elseif($browser =="Firebird"){
			$this->_setBrowserGeckoExtendedInfo('firebird',$temp_array);
		}elseif($browser =="Netscape6up"){
			if(ereg('netscape6',$agent)){
				$this->_setBrowserGeckoExtendedInfo('netscape6',$temp_array);
			}else{
				$this->_setBrowserGeckoExtendedInfo('netscape',$temp_array);
			}
		}elseif($browser =="Netscape"){
			$this->_setBrowserCommonExtendedInfo('mozilla',$temp_array);
		}elseif($browser =="Safari"){
			$this->_setBrowserSafariVersion('safari',$temp_array);
		}elseif($browser =="Internet Explorer"){
			if(ereg('rv:11',$agent))
				$this->_setBrowserCommonExtendedInfo('rv',$temp_array);
			else
				$this->_setBrowserCommonExtendedInfo('msie',$temp_array);
		}elseif($browser =="Opera"){
			$this->_setBrowserCommonExtendedInfo('opr',$temp_array);
		}elseif($browser =="Sleipnir"){
			$this->_setBrowserSleipnirVersion('sleipnir',$temp_array);

		}elseif($browser =="Mozilla"){
			//TODO build date 등등 설정?
			//어케해? rv 하고 build date 가져 올 수 있는데....
			$this->_setBrowserCommonExtendedInfo('rv',$temp_array);

		}elseif($browser =="Konqueror"){
			$this->_setBrowserCommonExtendedInfo('konqueror',$temp_array);

		}elseif($browser =="Lunascape"){
			$this->_setBrowserCommonExtendedInfo('lunascape',$temp_array);

		}elseif($browser =="Amaya"){
			$this->_setBrowserCommonExtendedInfo('amaya',$temp_array);

		}elseif($browser =="OmniWeb"){
			$this->_setBrowserCommonExtendedInfo('omniweb',$temp_array);
		}elseif($browser =="Kagetaka"){
			$this->_setBrowserCommonExtendedInfo('kagetaka',$temp_array);
		}elseif($browser =="Lynx"){
			$this->_setBrowserCommonExtendedInfo('lynx',$temp_array);
		}
	}


	function _unsetObjectPropeties(){

		if(!isset($this->browser_category))
			unset($this->browser_category);
		if(!isset($this->browser_name))
			unset($this->browser_name);
		if(!isset($this->browser_version))
			unset($this->browser_version);
		if(!isset($this->browser_build_date))
			unset($this->browser_build_date);
		if(!isset($this->browser_revision))
			unset($this->browser_revision);
		if(!isset($this->browser_security))
			unset($this->browser_security);
		if(!isset($this->useragent))
			unset($this->useragent);
	}
}
?>