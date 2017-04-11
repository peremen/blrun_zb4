<?php
/*
// +----------------------------------------------------------------------+
// +----------------------------------------------------------------------+
// | Authors: Aokio <st.elmo@gmail.com>      여시,아오키오^^    |
// +----------------------------------------------------------------------+
//
//

/**
 * Utility class that analyze time information from useragent strings.
 *
 * @package  Aokio_Analyzer_Time
 * @category
 * @author   Aokio <st.elmo@gmail.com>
 * @access   public
 * @version  $Revision: 0.1 $
 */

class Aokio_Analyzer_Time{


	var $time_year;
	var $time_month;
	var $time_day;
	var $time_week;
	var $time_hour;

	var $time_info;

	var $time_now;

	//constructor
	function Aokio_Analyzer_Time(){
		$this->time_now = time();
		$this->time_info=date('Y-m-d H:i:s',$this->time_now);

		$this->_setTime();
	}

	function _setTime(){
		$this->setYear();
		$this->setMonth();
		$this->setDay();
		$this->setHour();
		$this->setWeek();


	}

	function setYear(){
		$this->time_year =  date('Y',$this->time_now);
	}
	function setMonth(){
		$this->time_month = date('m',$this->time_now);
	}
	function setDay(){
		$this->time_day = date('d',$this->time_now);
	}
	function setHour(){
		$this->time_hour = date('H',$this->time_now);
	}
	function setWeek(){
		$this->time_week = date('w',$this->time_now);
	}
}
?>