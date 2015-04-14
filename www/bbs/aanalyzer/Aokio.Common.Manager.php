<?php
class AokioCommonManager{	

	/**
	 * Using Status:  ;
	 *
	 * @return array
	 */

	function thisTimeInfo($year=false,$month=false,$day=false){	
		$now = time();
		$time_array = array('year'	=> ($year)?$year:date('Y' , $now),
							'month' => ($month)?$month:date('m' , $now),
							'day'	=> ($day)?$day:date('d' , $now),
							'hour'	=> date('H' , $now));
		return $time_array;
	}

	/**
	 * Using Status: True -> ;
	 *
	 * @return array
	 */
	function thisDayInfo($year=false,$month=false,$day=false){	
		$now = time();
		$day_array = array('year'	=> ($year)?$year:date('Y' , $now),
							'month' => ($month)?$month:date('m' , $now),
							'day'	=> ($day)?$day:date('d' , $now));
		return $day_array;
	}


	/*
	
	*
	 * Number of days in selected Month of selected Year
	 * @return int
	 */
	function _DaysInMonth ( $year, $month )	{
		if ( in_array ( $month, array ( 1, 3, 5, 7, 8, 10, 12 ) ) )
			return 31; 

		if ( in_array ( $month, array ( 4, 6, 9, 11 ) ) )
			return 30; 

		if ( $month == 2 )
			return ( checkdate ( 2, 29, $year ) ) ? 29 : 28;
	
		return false;
	}


	function getBeforeAfterMonthForLink ( $year, $month )	{
		$now = time();
		if($month == 1){
			return array(	'before_year'	=> $year -1,
							'before_month'	=> 12,
							'next_year'		=> (date('Y' , $now) == $year &&date('m' , $now) == $month )?null:$year,
							'next_month'	=> (date('Y' , $now) == $year &&date('m' , $now) == $month )?null:($month+1));
		}elseif($month == 12){
			return array(	'before_year' => $year ,
							'before_month'=> $month-1,
							'next_year' => (date('Y' , $now) == $year &&date('m' , $now) == $month )?null:($year +1),
							'next_month'=> (date('Y' , $now) == $year &&date('m' , $now) == $month )?null:1);

		}else{
			return array(	'before_year' => $year ,
							'before_month'=> $month-1,
							'next_year' => (date('Y' , $now) == $year &&date('m' , $now) == $month )?null:($year),
							'next_month'=> (date('Y' , $now) == $year &&date('m' , $now) == $month )?null:$month+1);

		}
	}


	/*
	
	*
	 * Number of days in selected Month of selected Year
	 * @return int
	 */
	function redirectPage ( $url ){
		header("Location:".$url);
	}
	function isAlphbetNumeric ( $req ){
		$temp = false;
		for ($i=0;$i<strlen($req);$i++) {
			$ascii_code=ord($req[$i]);
			if ((intval($ascii_code) >=48 && intval($ascii_code) <=57) ||
				(intval($ascii_code) >=65 && intval($ascii_code) <=90) ||
				(intval($ascii_code) >=97 && intval($ascii_code) <=122) ||
				intval($ascii_code) ==95) {
				continue;
			}else{
				return false;
			}
		} 
		return true;
	}

}
?>