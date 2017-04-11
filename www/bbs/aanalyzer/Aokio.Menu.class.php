<?php
//require_once 'Aokio.Manager.Dao.php';

class Aokio_Menu_Manager{

	var $menu_param_infos;
	var $lang_type = null;

	function Aokio_Menu_Manager(){
		require_once "./resources/common_resource.php";

		$this->menu_param_infos= $menu_template_param;

	}
}
?>