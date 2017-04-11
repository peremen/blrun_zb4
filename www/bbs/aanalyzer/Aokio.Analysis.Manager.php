<?php
require_once 'Aokio.Analysis.Dao.php';
require_once 'Aokio.Config.Manager.php';
/**
 * Project:     AokioAnalyzer
 *
 *
 * @link http://www.aokio.com/
 * @copyright 2006-
 * @author aokio   <st.elmo@gmail.com>
 * @package AokioAnalyzer
 */


 /**
 * @package AokioAnalyzer
 */
class AokioAnalysisManager{

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getAnalyzeInfoList($analy_input_param){
		$analysis_dao = new AokioAnalysisDao();

		$db	= $analysis_dao -> getConnection();
		$target				= $analy_input_param['target'];
		$start				= $analy_input_param['start'];
		$list_per_page	= $analy_input_param['list_per_page'];
		$order_option	= $analy_input_param['order_option'];
		$order_type		= $analy_input_param['order_type'];
//		$target = $analy_input_param[''];

		$info_array =
			$analysis_dao ->getAnalyzeLimitListInfo($target,$start,$list_per_page,$order_option,$order_type,$db);
		$analysis_dao->closeConnection($db);

		return $info_array;
	}

	function setBookmarkAnalyzeInfo($no,$target){
		$analysis_dao = new AokioAnalysisDao();

		$db	= $analysis_dao -> getConnection();
//echo "<pre>".nl2br(print_r($target,true))."</pre>";
//		$bookmark_info = array($no,$target);
		$info_array = $analysis_dao ->setBookmarkAnalyzeInfo($no,$target,$db);
		$analysis_dao->closeConnection($db);

		return $info_array;
	}


	function clearBookmarkAnalyzeInfo($no,$target){
		$analysis_dao = new AokioAnalysisDao();

		$db	= $analysis_dao -> getConnection();

//		$bookmark_info = array($no,$target);
		$info_array = $analysis_dao ->clearBookmarkAnalyzeInfo($no,$target,$db);
		$analysis_dao->closeConnection($db);

		return $info_array;
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getAnalyzeInfoBookmarkList($analy_input_param){
		$analysis_dao = new AokioAnalysisDao();

		$db	= $analysis_dao -> getConnection();
		$target			= $analy_input_param['target'];
		$start			= $analy_input_param['start'];
		$list_per_page	= $analy_input_param['list_per_page'];
		$order_option	= $analy_input_param['order_option'];
		$order_type		= $analy_input_param['order_type'];
//		$target = $analy_input_param[''];

		$info_array =
			$analysis_dao ->getAnalyzeLimitListBookmarkInfo($target,$start,$list_per_page,$order_option,$order_type,$db);
		$analysis_dao->closeConnection($db);

		return $info_array;
	}



	function getAnalyzeInfoListWithOS($id,$start,$list_per_page,$os_param){
		$analysis_dao = new AokioAnalysisDao();

		$db = $analysis_dao -> getConnection();

		$info_array = $analysis_dao ->getAnalyzeLimitListInfoWithOS($id,$start,$list_per_page,$os_param,$db);
		$analysis_dao->closeConnection($db);

		return $info_array;
	}

	function getAnalyzeInfoTotalCounts($id){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$info_array = $analysis_dao ->getAnalyzeInfoTotalCounts($id,$db);
		$analysis_dao->closeConnection($db);

		return $info_array;
	}


	function getAnalyzeInfoBookmarkTotalCounts($id){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$info_array = $analysis_dao ->getAnalyzeInfoBookmarkTotalCounts($id,$db);
		$analysis_dao->closeConnection($db);

		return $info_array;
	}




	function getSevenDaysCounts($id){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();
		$today_time = AokioCommonManager::thisDayInfo();
		$time_info = array(	$today_time['year'],
							$today_time['month'],
							$today_time['day'],
							$today_time['day']-6,
							$id);
		$info_array = $analysis_dao ->getSevenDaysCounts($time_info,$db);

//		$info_array = $analysis_dao ->getSevenDaysCounts(
//					$today_time['year'],$today_time['month'],
//			$today_time['day'],$today_time['day']-6,$id,$db);

//echo "<pre>".nl2br(print_r($info_array,true))."</pre>";
		$analysis_dao->closeConnection($db);

		return $info_array;
	}


	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getOSInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

//		$os_total_counts = $analysis_dao ->getOSTotalCounts($target,$db);
		$os_misc_counts = $analysis_dao ->getOSCountsMiscInfo($target,$db);

		if(!$os_misc_counts['total_os_counts']){
			$analysis_dao->closeConnection($db);
			return false;
		}
		$info_temp_array = $analysis_dao ->getOSInfo($target,$os_misc_counts['total_os_counts'],$db);
		$analysis_dao->closeConnection($db);
		return array(	'total_counts'	=> $os_misc_counts['total_os_counts'],
							'max_counts'	=> $os_misc_counts['max_os_counts'],
							'min_counts'	=> $os_misc_counts['min_os_counts'],
							'avg_counts'	=> $os_misc_counts['avg_os_counts'],
							'info_list'		=> $info_temp_array);
	}

	function getOSCategoryInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$os_category_info = $analysis_dao ->getOSCategoryCountsMiscInfo($target,$db);
//echo "<pre>".nl2br(print_r($os_category_info,true))."</pre>";

		if(!$os_category_info){
			$analysis_dao->closeConnection($db);
			return false;
		}

		$total_os_category_counts = 0;
		$max_os_category_counts = 0;
		$min_os_category_counts = 0;


		foreach($os_category_info as $key=> $value){
			$total_os_category_counts += $value['os_category_counts'];

			if($max_os_category_counts<$value['os_category_counts']){
				$max_os_category_counts = $value['os_category_counts'];
			}

			if($key == 0 ){
				$min_os_category_counts = $value['os_category_counts'];
			}

			if($min_os_category_counts>$value['os_category_counts']){
				$min_os_category_counts = $value['os_category_counts'];
			}
		}


		$avg_os_category_counts = $total_os_category_counts/sizeof($os_category_info);

		$info_temp_array = $analysis_dao ->getOSCategoryInfo($target,$total_os_category_counts,$db);
		$analysis_dao->closeConnection($db);
		return array(	'total_counts'	=> $total_os_category_counts,
							'max_counts'	=> $max_os_category_counts,
							'min_counts'	=> $min_os_category_counts,
							'avg_counts'	=> $avg_os_category_counts,
							'info_list'		=> $info_temp_array);
	}
	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getBrowserInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$browser_misc_counts = $analysis_dao ->getBrowserCountsMiscInfo($target,$db);

		if(!$browser_misc_counts['total_browser_counts']){
			$analysis_dao->closeConnection($db);
			return false;

		}

		$info_temp_array = $analysis_dao ->getBrowserInfo($target,$browser_misc_counts['total_browser_counts'],$db);
		$analysis_dao->closeConnection($db);
		return array(	'total_counts'	=> $browser_misc_counts['total_browser_counts'],
							'max_counts'	=> $browser_misc_counts['max_browser_counts'],
							'min_counts'	=> $browser_misc_counts['min_browser_counts'],
							'avg_counts'	=> $browser_misc_counts['avg_browser_counts'],
							'info_list'		=> $info_temp_array);

	}

	function getBrowserCategoryInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$browser_category_info = $analysis_dao ->getBrowserCategoryCountsMiscInfo($target,$db);
//echo "<pre>".nl2br(print_r($os_category_info,true))."</pre>";

		if(!$browser_category_info){
			$analysis_dao->closeConnection($db);
			return false;
		}

		$total_browser_category_counts = 0;
		$max_browser_category_counts = 0;
		$min_browser_category_counts = 0;


		foreach($browser_category_info as $key=> $value){
			$total_browser_category_counts += $value['browser_category_counts'];

			if($max_browser_category_counts<$value['browser_category_counts']){
				$max_browser_category_counts = $value['browser_category_counts'];
			}

			if($key == 0 ){
				$min_browser_category_counts = $value['browser_category_counts'];
			}

			if($min_browser_category_counts>$value['browser_category_counts']){
				$min_browser_category_counts = $value['browser_category_counts'];
			}
		}


		$avg_browser_category_counts = $total_browser_category_counts/sizeof($browser_category_info);

		$info_temp_array = $analysis_dao ->getBrowserCategoryInfo($target,$total_browser_category_counts,$db);
		$analysis_dao->closeConnection($db);
		return array(	'total_counts'	=> $total_browser_category_counts,
							'max_counts'	=> $max_browser_category_counts,
							'min_counts'	=> $min_browser_category_counts,
							'avg_counts'	=> $avg_browser_category_counts,
							'info_list'		=> $info_temp_array);
	}


	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */
	function getYearInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$time_info = AokioCommonManager::thisDayInfo(false,false,false);
		$year_total_counts = $analysis_dao ->getYearTotalCounts($target,$db);
		if(!$year_total_counts['total_year_counts']){
			$analysis_dao->closeConnection($db);
			return false;

		}
		$info_temp_array = AokioAnalysisManager::getTimeInfo($analysis_dao,$target,$year_total_counts['total_year_counts'],$time_info,'YEAR',$db);

		$analysis_dao->closeConnection($db);
		return array(	'total_counts'	=> $year_total_counts['total_year_counts'],
//						'max_counts'	=> $max_year_counts['max_year_counts'],
						'info_list'		=> $info_temp_array);
	}

	function getMonthInfo($target,$year=false){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$time_info =  AokioCommonManager::thisDayInfo($year,false,false);
		$month_arr = array($target,$time_info['year']);
		$month_total_counts = $analysis_dao ->getMonthTotalCounts($month_arr,$db);
		if(!$month_total_counts['total_month_counts']){
			$analysis_dao->closeConnection($db);
			return false;

		}
		$info_temp_array =  AokioAnalysisManager::getTimeInfo($analysis_dao,$target,$month_total_counts['total_month_counts'],$time_info,'MONTH',$db);
		$analysis_dao->closeConnection($db);
		if(sizeof($info_temp_array)<12){
			$year = $info_temp_array[0]['year'];
			$temp_arr = array();
			for($i=0;$i<12;$i++){
				array_push($temp_arr,array(	'year'=>$year,
											'month'=>$i+1,
											'items'=>$i+1,
											'counts'=>0,
											'percentage' => 0
					));
			}
			foreach($info_temp_array as $key => $value){
				$temp_arr[$value['month']-1] = $value;

			}
			$info_temp_array = $temp_arr;
		}

		return array(	'total_counts'	=> $month_total_counts['total_month_counts'],
//						'max_counts'	=> $max_year_counts['max_year_counts'],
						'info_list'		=> $info_temp_array);
	}

	function getWeekInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$info_temp_array = $analysis_dao ->getWeekInfo($target,$db);
//echo "<pre>".nl2br(print_r($info_temp_array,true))."</pre>";
		$week_temp_info['total_counts'] = 0;
		$max_counts = 0;
		$week_temp1_info = array();
		$total = 0;
		for($i=0;$i<7;$i++){
			$total += $info_temp_array['w'.$i];
			if($info_temp_array['w'.$i]>=$max_counts){
				$max_counts = $info_temp_array['w'.$i];
			}
			$week_temp1_info[$i]['counts'] = $info_temp_array['w'.$i];
			$week_temp1_info[$i]['percentage'] =0;
		}
		if(!$total){
			$analysis_dao->closeConnection($db);
			return false;
		}
		$week_temp_info['total_counts'] = $total;


		$week_temp1_info[0]['week'] = 'SUN';
		$week_temp1_info[1]['week'] = 'MON';
		$week_temp1_info[2]['week'] = 'TUE';
		$week_temp1_info[3]['week'] = 'WED';
		$week_temp1_info[4]['week'] = 'THU';
		$week_temp1_info[5]['week'] = 'FRI';
		$week_temp1_info[6]['week'] = 'SAT';

		$week_temp1_info[0]['items'] = 'SUN';
		$week_temp1_info[1]['items'] = 'MON';
		$week_temp1_info[2]['items'] = 'TUE';
		$week_temp1_info[3]['items'] = 'WED';
		$week_temp1_info[4]['items'] = 'THU';
		$week_temp1_info[5]['items'] = 'FRI';
		$week_temp1_info[6]['items'] = 'SAT';

		foreach($week_temp1_info as $key => $value){
//			echo "<pre>".nl2br(print_r($,true))."</pre>";
			$week_temp1_info[$key]['percentage'] = round(100*$value['counts']/$week_temp_info['total_counts'],2);

		}
		$week_temp_info['max_counts'] =$max_counts;
		$week_temp_info['info_list'] =$week_temp1_info;

		$analysis_dao->closeConnection($db);

		return $week_temp_info;
	}

	function getDayInfo($target,$year=false,$month=false){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$time_info =  AokioCommonManager::thisDayInfo($year,$month,false);

		$day_arr = array($target,$time_info['year'],$time_info['month']);
		$day_total_counts = $analysis_dao ->getDayTotalCounts($day_arr,$db);
		if(!$day_total_counts['total_day_counts']){
			$analysis_dao->closeConnection($db);
			return false;
		}
		$max_day_counts = $analysis_dao ->getMaxDay($day_arr,$db);

		$info_temp_array =  AokioAnalysisManager::getTimeInfo($analysis_dao,$target,$day_total_counts['total_day_counts'],$time_info,'DAY',$db);

		$analysis_dao->closeConnection($db);

		$year = $info_temp_array[0]['year'];
		$month = $info_temp_array[0]['month'];

		$last_day = AokioCommonManager::_DaysInMonth( $year, $month );

		if(sizeof($info_temp_array)<$last_day){

			$temp_arr = array();
			for($i=0;$i<$last_day;$i++){
				array_push($temp_arr,array(	'year'=>$year,
											'month'=>$month,
											'day'=>$i+1,
											'items'=>$i+1,
											'counts'=>0,
											'percentage'=>0
					));
			}
			foreach($info_temp_array as $key => $value){
				$temp_arr[$value['day']-1] = $value;
			}
			$info_temp_array = $temp_arr;

		}
//		echo "<pre>".nl2br(print_r($info_temp_array,true))."</pre>";
		return array(	'total_counts'	=> $day_total_counts['total_day_counts'],
						'max_counts'	=> $max_day_counts['max_day_counts'],
						'info_list'		=> $info_temp_array);
	}

	/**
	 * Access information of the timeof days in selected Month of selected Year
	 * @return int
	 */
/*
	function getHourInfo($target,$year=false,$month=false,$day=false){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$time_info =  AokioCommonManager::thisTimeInfo($year,$month,$day);
//		$temp_time_arr = array($target,$time_info['year'],$time_info['month'],$time_info['day']);

		$info_temp_array =  AokioAnalyzeManager::getTimeInfo($analysis_dao,$target,false,$time_info,'HOUR',$db);
		$total_counts = $info_temp_array[28];
//		if(!$total_counts)
//			return false;
		$max_counts = 0;
		$hour_temp_info = array();
		for($i=0;$i<24;$i++){
			if($info_temp_array[$i+4]>=$max_counts){
				$max_counts = $info_temp_array[$i+4];
			}
			$hour_temp_info[$i]['hour'] = $i;
			$hour_temp_info[$i]['items'] = $i;
			$hour_temp_info[$i]['counts'] = $info_temp_array[$i+4];
			$hour_temp_info[$i]['percentage'] =0;
		}
		foreach($hour_temp_info as $key => $value){
			if($total_counts ==0){
				$hour_temp_info[$key]['percentage'] = 0;
			}else{
				$hour_temp_info[$key]['percentage'] = round(100*$value['counts']/$total_counts,2);
			}

			$hour_temp_info[$key]['percentage'] = round(100*$value['counts']/$total_counts,2);
		}

		$temp_time_beforeday_arr = array(	'year'=>$time_info['year'],
											'month'=>$time_info['month'],
											'day'=>$time_info['day']-1);
		$info_temp_beforeday_array =  AokioAnalyzeManager::getTimeInfo($analysis_dao,$target,false,$temp_time_beforeday_arr,'HOUR',$db);
		$total_beforeday_counts = $info_temp_beforeday_array[28];
//		if(!$total_counts)
//			return false;
		$max_beforeday_counts = 0;
		$hour_beforeday_temp_info = array();
		for($i=0;$i<24;$i++){
			if($info_beforeday_temp_array[$i+4]>=$max_beforeday_counts){
				$max_beforeday_counts = $info_beforeday_temp_array[$i+4];
			}
			$hour_beforeday_temp_info[$i]['hour'] = $i;
			$hour_beforeday_temp_info[$i]['items'] = $i;
			$hour_beforeday_temp_info[$i]['counts'] = $info_beforeday_temp_array[$i+4];
			$hour_beforeday_temp_info[$i]['percentage'] =0;
		}
		foreach($hour_beforeday_temp_info as $key => $value){
			if($total_beforeday_counts ==0){
				$hour_beforeday_temp_info[$key]['percentage'] = 0;
			}else{
				$hour_beforeday_temp_info[$key]['percentage'] = round(100*$value['counts']/$total_beforeday_counts,2);
			}
		}

		return array(	'total_counts'			=> $total_counts,
						'max_counts'			=> $max_counts,
						'info_list'				=> $hour_temp_info,
						'info_list_beforeday'	=> $hour_beforeday_temp_info,
//						'info_list_beforeweek'	=> $hour_temp_info,
		);
	}
	*/

	function getHourInfo($target,$year=false,$month=false,$day=false){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$time_info =  AokioCommonManager::thisTimeInfo($year,$month,$day);
//		$temp_time_arr = array($target,$time_info['year'],$time_info['month'],$time_info['day']);

		$info_temp_array =  AokioAnalysisManager::getTimeInfo($analysis_dao,$target,false,$time_info,'HOUR',$db);
		$total_counts = $info_temp_array[28];
//		if(!$total_counts)
//			return false;

		$tmp_y = $time_info['year'];
		$tmp_m = $time_info['month'];
		$tmp_d = $time_info['day']-1;
		if($time_info['day']-1 == 0){
			if($time_info['month']-1 == 0 ){
				$tmp_y = $time_info['year']-1;
				$tmp_m = 12;
			}
			$tmp_m = $time_info['month'] -1;
			$tmp_d = AokioCommonManager::_DaysInMonth ( $tmp_y, $tmp_m );
		}
		$temp_time_beforeday_arr = array(	'year'=>$tmp_y,
											'month'=>$tmp_m,
											'day'=>$tmp_d);
		//echo "<pre>".nl2br(print_r($temp_time_beforeday_arr,true))."</pre>";
		$info_temp_beforeday_array =  AokioAnalysisManager::getTimeInfo($analysis_dao,$target,false,$temp_time_beforeday_arr,'HOUR',$db);
		$total_beforeday_counts = $info_temp_beforeday_array[28];

		if(!$total_counts && !$total_beforeday_counts){
			$analysis_dao->closeConnection($db);
			return false;
		}

		$max_counts = 0;
		$hour_temp_info = array();
		for($i=0;$i<24;$i++){
			if($info_temp_array[$i+4]>=$max_counts){
				$max_counts = $info_temp_array[$i+4];
			}
			if($info_temp_beforeday_array[$i+4]>=$max_counts){
				$max_counts = $info_temp_beforeday_array[$i+4];
			}
			$hour_temp_info[$i]['hour'] = $i;
			$hour_temp_info[$i]['items'] = $i;
			$hour_temp_info[$i]['counts'] = $info_temp_array[$i+4];
			$hour_temp_info[$i]['before_counts'] = $info_temp_beforeday_array[$i+4];
			$hour_temp_info[$i]['percentage'] =0;
			$hour_temp_info[$i]['before_percentage'] =0;
		}
		foreach($hour_temp_info as $key => $value){
			if($total_counts !=0){
				$hour_temp_info[$key]['percentage'] = round(100*$value['counts']/$total_counts,2);
			}

			if($total_beforeday_counts !=0){
				$hour_temp_info[$key]['before_percentage'] = round(100*$value['before_counts']/$total_beforeday_counts,2);
			}
//			$hour_temp_info[$key]['percentage'] = round(100*$value['counts']/$total_counts,2);
		}




		return array(	'total_counts'			=> $total_counts,
						'before_total_counts'	=> $total_beforeday_counts,
						'max_counts'			=> $max_counts,
						'info_list'				=> $hour_temp_info,
		);
	}

	/**
	 * Using Status: true ;
	 *
	 * @return array
	 */

	function getTimeInfo($analysis_dao,$target,$total_counts,$time_info,$option,$db){
		$info_array = $analysis_dao ->getTimeInfo($target,$total_counts,$time_info,$option,$db);
		return $info_array;
	}

	function getLanguageInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();
		$total_counts = $analysis_dao ->getLanguageTotalCounts($target,$db);
		if(!$total_counts['total']){
			$analysis_dao->closeConnection($db);
			return false;
		}
		$max_counts = $analysis_dao ->getMaxLanguage($target,$db);

		$info_temp_array = $analysis_dao ->getLanguageInfo($target,$total_counts['total'],$db);
		$analysis_dao->closeConnection($db);

//echo "<pre>".nl2br(print_r($max_counts,true))."</pre>";

		return array(	'total_counts'	=> $total_counts['total'],
						'max_counts'	=> $max_counts['max_counts'],
						'info_list'		=> $info_temp_array);
	}


	function getNationInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();
		$total_counts = $analysis_dao ->getNationTotalCounts($target,$db);
		if(!$total_counts['total']){
			$analysis_dao->closeConnection($db);
			return false;
		}
		$max_counts = $analysis_dao ->getMaxNation($target,$db);

		$info_temp_array = $analysis_dao ->getNationInfo($target,$total_counts['total'],$db);

		$analysis_dao->closeConnection($db);
//echo "<pre>".nl2br(print_r($info_temp_array,true))."</pre>";
		return array(	'total_counts'	=> $total_counts['total'],
						'max_counts'	=> $max_counts['max_counts'],
						'info_list'		=> $info_temp_array);
	}


	function getCityInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();
		$total_counts = $analysis_dao ->getCityTotalCounts($target,$db);
		if(!$total_counts['total']){
			$analysis_dao->closeConnection($db);
			return false;

		}
		$max_counts = $analysis_dao ->getMaxCity($target,$db);

		$info_temp_array = $analysis_dao ->getCityInfo($target,$total_counts['total'],$db);

		$analysis_dao->closeConnection($db);
//echo "<pre>".nl2br(print_r($info_temp_array,true))."</pre>";
		return array(	'total_counts'	=> $total_counts['total'],
						'max_counts'	=> $max_counts['max_counts'],
						'info_list'		=> $info_temp_array);
	}


	function getRefererInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();
		$total_counts = $analysis_dao ->getRefererTotalCounts($target,$db);
		if(!$total_counts['total']){
			$analysis_dao->closeConnection($db);
			return false;

		}
		$max_counts = $analysis_dao ->getMaxReferer($target,$db);

		$info_temp_array = $analysis_dao ->getRefererInfo($target,$total_counts['total'],$db);

		$analysis_dao->closeConnection($db);
//echo "<pre>".nl2br(print_r($info_temp_array,true))."</pre>";
		return array(	'total_counts'	=> $total_counts['total'],
						'max_counts'	=> $max_counts['max_counts'],
						'info_list'		=> $info_temp_array);
	}

	function getRefererServerInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();
		$total_counts = $analysis_dao ->getRefererServerTotalCounts($target,$db);
		if(!$total_counts['total']){
			$analysis_dao->closeConnection($db);
			return false;
		}
		$max_counts = $analysis_dao ->getMaxRefererServer($target,$db);

		$info_temp_array = $analysis_dao ->getRefererServerInfo($target,$total_counts['total'],$db);

		$analysis_dao->closeConnection($db);
//echo "<pre>".nl2br(print_r($info_temp_array,true))."</pre>";
		return array(	'total_counts'	=> $total_counts['total'],
						'max_counts'	=> $max_counts['max_counts'],
						'info_list'		=> $info_temp_array);
	}

	function getScreensizeInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();
		$total_counts = $analysis_dao ->getScreensizeTotalCounts($target,$db);
		if(!$total_counts['total']){
			$analysis_dao->closeConnection($db);
			return false;
		}
		$max_counts = $analysis_dao ->getMaxScreensize($target,$db);

		$info_temp_array = $analysis_dao ->getScreensizeInfo($target,$total_counts['total'],$db);

		$analysis_dao->closeConnection($db);
//echo "<pre>".nl2br(print_r($info_temp_array,true))."</pre>";
		return array(	'total_counts'	=> $total_counts['total'],
						'max_counts'	=> $max_counts['max_counts'],
						'info_list'		=> $info_temp_array);
	}
	function getResolutionInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();
		$total_counts = $analysis_dao ->getResolutionTotalCounts($target,$db);
		if(!$total_counts['total']){
			$analysis_dao->closeConnection($db);
			return false;
		}
		$max_counts = $analysis_dao ->getMaxResolution($target,$db);

		$info_temp_array = $analysis_dao ->getResolutionInfo($target,$total_counts['total'],$db);

		$analysis_dao->closeConnection($db);
//echo "<pre>".nl2br(print_r($info_temp_array,true))."</pre>";
		return array(	'total_counts'	=> $total_counts['total'],
						'max_counts'	=> $max_counts['max_counts'],
						'info_list'		=> $info_temp_array);
	}


	function getSearchKeywordInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$searchkeyword_misc_counts = $analysis_dao ->getSearchKeywordCountsMiscInfo($target,$db);

		if(!$searchkeyword_misc_counts['total_keyword_counts']){
			$analysis_dao->closeConnection($db);
			return false;

		}

		$info_temp_array = $analysis_dao ->getSearchKeywordInfo($target,$searchkeyword_misc_counts['total_keyword_counts'],$db);
		$analysis_dao->closeConnection($db);
		return array(	'total_counts'	=> $searchkeyword_misc_counts['total_keyword_counts'],
							'max_counts'	=> $searchkeyword_misc_counts['max_keyword_counts'],
							'min_counts'	=> $searchkeyword_misc_counts['min_keyword_counts'],
							'avg_counts'	=> $searchkeyword_misc_counts['avg_keyword_counts'],
							'info_list'		=> $info_temp_array);
	}


	function getSearchsiteInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$searchsite_misc_counts = $analysis_dao ->getSearchsiteCountsMiscInfo($target,$db);

		if(!$searchsite_misc_counts['total_search_sites_counts']){
			$analysis_dao->closeConnection($db);
			return false;

		}

		$info_temp_array = $analysis_dao ->getSearchsiteInfo($target,$searchsite_misc_counts['total_search_sites_counts'],$db);
		$analysis_dao->closeConnection($db);
		return array(	'total_counts'	=> $searchsite_misc_counts['total_search_sites_counts'],
							'max_counts'	=> $searchsite_misc_counts['max_search_sites_counts'],
							'min_counts'	=> $searchsite_misc_counts['min_search_sites_counts'],
							'avg_counts'	=> $searchsite_misc_counts['avg_search_sites_counts'],
							'info_list'		=> $info_temp_array);
	}



	function getRobotAccessInfo($target){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();
		$robot_total_counts = $analysis_dao ->getRobotTotalCounts($target,$db);
		if(!$robot_total_counts['total_robot_counts'])
			return false;
		$max_robot_counts = $analysis_dao ->getMaxRobot($target,$db);

		$info_temp_array = $analysis_dao ->getRobotAccessInfo($target,$robot_total_counts['total_robot_counts'],$db);

		$analysis_dao->closeConnection($db);

		return array(	'total_counts'	=> $robot_total_counts['total_robot_counts'],
						'max_counts'	=> $max_robot_counts['max_robot_counts'],
						'info_list'		=> $info_temp_array);
	}

	function getRobotDetailInfo($target,$start,$list_per_page){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$info_temp_array = $analysis_dao ->getRobotDetailInfo($target,$start,$list_per_page,$db);
//echo "<pre>".nl2br(print_r($info_temp_array,true))."</pre>";
		$analysis_dao->closeConnection($db);

		return $info_temp_array;
	}


	function getRobotDetailInfoTotalCounts($id){
		$analysis_dao = new AokioAnalysisDao();
		$db = $analysis_dao -> getConnection();

		$info_array = $analysis_dao ->getRobotDetailInfoTotalCounts($id,$db);
		$analysis_dao->closeConnection($db);

//		echo "<pre>".nl2br(print_r($info_array,true))."</pre>";
		return $info_array;
	}
}
?>