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
 * @package  Aokio_Analyzer_
 * @category 
 * @author   Aokio <st.elmo@gmail.com>   
 * @access   public
 * @version  $Revision: 0.1 $
 */
define ('NO_REFERER_INFO','NO_REFERER_INFO');
class Aokio_Analyzer_Referer{

	var $referer;
	var $referer_server;

	var $referer_searchsite;
	var $searchsite_array_key;
	var $search_keyword;
	var $search_keyphrase;

	var $referer_parse_url_info;
	var $referer_scheme;
	var $referer_host;
	var $referer_path;
	var $referer_query;

	//constructor
	function Aokio_Analyzer_Referer(){
		if(isset($_SERVER['HTTP_REFERER'])) {
			$this->referer = $_SERVER['HTTP_REFERER'];
		}elseif (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_REFERER'])) {
			$this->referer = $GLOBALS['HTTP_SERVER_VARS']['HTTP_REFERER'];
		}else{
			$this->referer = NO_REFERER_INFO;
		}

		$this->referer = mb_convert_encoding($this->referer,  "UTF-8","EUC-KR");

		$this->setRefererInfos();
	}

	function setRefererInfos(){
		
		$this->setRefererParseUrlInfo();
		$this->setRefererServer();

		$this->setSearchKeywords();

	}

	function setRefererParseUrlInfo(){
		$referer	= $this->referer;
		if($referer != NO_REFERER_INFO){
			$this->referer_parse_url_info = parse_url($referer);
			$this->referer_scheme			= $this->referer_parse_url_info['scheme'];
			$this->referer_host				= $this->referer_parse_url_info['host'];
			$this->referer_path				= $this->referer_parse_url_info['path'];
			$this->referer_query				= $this->referer_parse_url_info['query'];
		}
	}


	function setRefererServer(){
		if($this->referer != NO_REFERER_INFO){
			$this->referer_server =  $this->referer_scheme."://".$this->referer_parse_url_info['host'];
		}
	}

	function isRefererServerSearchSite(){
		include 'search_site_list.php';
		foreach($search_site_list as $key => $value){
			if(preg_match("#".$value['site_regex']."#i",$this->referer_host)){
				$this->searchsite_array_key = $key;
				return true;
			}
		}
		$this->searchsite_array_key = null;
		return false;
	}



	function setSearchKeywords(){
		include 'search_site_list.php';
		if($this->isRefererServerSearchSite()){
			$this->referer_searchsite = $this->referer_scheme."://".$this->referer_parse_url_info['host'];
			$query_key = $search_site_list[$this->searchsite_array_key]['query_param'];

			$temp_array=explode ("&",$this->referer_query);

			foreach($temp_array as $key => $value){
				if(preg_match("#".$query_key."#",$value)){
					$str = substr($value,strlen($query_key));
					$str = urldecode($str);
					$str = mb_convert_encoding($str,  "UTF-8",$search_site_list[$this->searchsite_array_key]['first_convert_encoding_code']);
					$this->search_keyword =  $str;
					break;
				}
			}
		}
		
	}
}
?>