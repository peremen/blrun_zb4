<?php

class Aokio_Message_Manager{

	var $log_page_messages;
	var $analysis_page_view_messages;
	var $analysis_page_view_table_top_items_titles;
	var $lang_type = null;
	var $common_messages ;
	var $words ;

	var $licenses_messages;

	function __construct($config){
		require_once "./resources/".$config->language."_lang_resource.php";

		$this->log_page_messages		= $login_page_messages;

		$this->analysis_page_view_messages						= $analysis_page_view_messages;
		$this->analysis_page_view_table_top_items_titles		= $analysis_page_view_table_top_items_titles;
		$this->common_messages		= $common_messages;
		$this->week_name					= $week_name;
		$this->words							= $words;

		$this->licenses_messages		= $licenses_messages;

	}
}
?>