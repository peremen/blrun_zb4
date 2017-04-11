<?php
//require_once 'Aokio.Manager.Dao.php';

class Aokio_Language_Manager{

	var $language_name_table;
//	var $lang_type = null;

	function Aokio_Language_Manager($config){
		require_once "./resources/".$config->language."_language_name_resource.php";

		$this->language_name_table= $language_name_table;

	}

}
?>