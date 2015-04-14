<?php

class Aokio_Nation_Manager{	
	
	var $nation_name_table;

	function Aokio_Nation_Manager($config){
		require_once "./resources/".$config->language."_nation_name_resource.php";

		$this->nation_name_table= $nation_name_table;
		
	}
}
?>