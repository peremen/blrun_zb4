<?php
/***************************************************************************
		                        Aokio.Analysis.class.php
		                             -------------------
		    begin                :  March 02 2006
		    copyright           : (C) 2004 Aokio
		    email                : st.elmo@gmail.com

 ***************************************************************************/

/***************************************************************************
 *
 *
 ***************************************************************************/
require_once "Aokio.Analysis.Manager.php";
require_once "Aokio.Config.class.php";
require_once "Aokio.Nation.class.php";
require_once "Aokio.Language.class.php";
require_once "Aokio.Message.class.php";

class AokioAnalysis{

	var $page_req_parameters;			// parameter of request
	var $analysis_info_for_template;		//

	var $bottom_misc_counts;

	var $common_page_view_info;
	var $top_items_titles_of_pages;
	var $common_messages;

	var $license_messages;

	var $this_date_info;

	var $this_page;
	var $pager;
	var $pager_prev;
	var $pager_next;
	var $pager_last;

	var $order;
	var $ot_template;

	var $os_param;
	// 화면 표시용 . 현재 가지고 있는 값의 반대값
//	var $bm_flag;

	//^^
	var $words;

	function AokioAnalysis(){
//		$this->initialParameters();
	}

	function initialParameters($config){
		// 모드값이 없으면 기본 포탈 페이지.
		if(!isset($_REQUEST['mode']) || $_REQUEST['mode'] ==null){
			$mode = $config->portal_page;
		}else{
			$mode = $_REQUEST['mode'];
		}

		$this->page_req_parameters =
			array(	'mode'	=> $mode,
						'id'		=>(isset($_REQUEST['id']))?$_REQUEST['id']:"" ,		// target
						'p'			=> (isset($_REQUEST['p']))?$_REQUEST['p']:"" ,		// page
						'rp'		=> (isset($_REQUEST['rp']))?$_REQUEST['rp']:"" ,		// robot page
						'y'			=> (isset($_REQUEST['y']))?$_REQUEST['y']:"" ,		//year
						'm'		=> (isset($_REQUEST['m']))?$_REQUEST['m']:"" ,		//month
						'd'			=> (isset($_REQUEST['d']))?$_REQUEST['d']:"" ,		//day
//						'os'		=> (isset($_REQUEST['os']))?$_REQUEST['os']:"" ,		//
						'order'	=> (isset($_REQUEST['order']))?$_REQUEST['order']:"" ,	//order options
						'ot'		=> (isset($_REQUEST['ot']))?$_REQUEST['ot']:"",		//order type
						'bm'		=> (isset($_REQUEST['bm']))?$_REQUEST['bm']:"" ,		//bookmark flag
						'no'		=> (isset($_REQUEST['no']))?$_REQUEST['no']:"" ,		//no
						'option'	=> (isset($_REQUEST['option']))?$_REQUEST['option']:"",
						'vo'		=>(isset($_REQUEST['vo']))?$_REQUEST['vo']:"",		// os 하고 브라우저에서의 표시 옵션
																												// 카테고리별 표시 ,세부버젼별 표시...
																												//fn 이면 세부버젼별, ca 이면 카테고리별
																												//bo 이면 양쪽다 표시
				);
		unset($mode);
	}


	function getGraphicalPageInfo($info){
		$max_counts	= $info['max_counts'];
		$info_list		= $info['info_list'];

		$this->bottom_misc_counts = array(
													'total'					=> $info['total_counts'],
													'max'					=> $info['max_counts'],
													'min'					=>  @$info['min_counts'],
													'average'			=> @$info['avg_counts'],
													'items_counts'	=>  sizeof($info_list),
													);
		$max_key = null;
		foreach($info_list as $key => $value){
			if( $max_counts == $value['counts']){
				$max_key = $key;
			}
		}
		foreach($info_list as $key => $value){
			if($value['counts'] != 0){
				if($max_key ==$key){
					$info_list[$key]['graph_percentage'] = 80;
				}else{
					$info_list[$key]['graph_percentage'] = round(80*$info_list[$key]['counts']/$info_list[$max_key]['counts']);
				}
				$info_list[$key]['link_flag'] =true;
			}else{
				$info_list[$key]['graph_percentage'] =0;
				$info_list[$key]['link_flag'] =false;
			}
		}
		unset($max_counts);
		unset($max_key);

		return $info_list;
	}

	function getGraphicalPageHourInfo($info){
		$max_counts = $info['max_counts'];
		$info_list = $info['info_list'];

		$max_key = null;
		foreach($info_list as $key => $value){
			if( $max_counts == $value['counts']){
				$max_key = $key;
			}
			if($max_counts == $value['before_counts']){
				$max_key = $key;
			}
		}
		foreach($info_list as $key => $value){
			if($info['total_counts'] == 0 && $info['before_total_counts'] ==0){
				$info_list[$key]['graph_percentage'] =0;
				$info_list[$key]['before_graph_percentage'] =0;
				$info_list[$key]['link_flag'] =false;
			}else{
				if($value['counts'] != 0){
					if($max_counts == $value['counts']){
						$info_list[$key]['graph_percentage'] = 80;
					}else{
						$info_list[$key]['graph_percentage'] = round(80*$info_list[$key]['counts']/$max_counts);
					}
					$info_list[$key]['link_flag'] =true;
				}else{
					$info_list[$key]['graph_percentage'] =0;
					$info_list[$key]['link_flag'] =false;
				}

				if($value['before_counts'] != 0){
					if($max_counts == $value['before_counts']){
						$info_list[$key]['before_graph_percentage'] = 80;
					}else{
						$info_list[$key]['before_graph_percentage'] = round(80*$info_list[$key]['before_counts']/$max_counts);
					}
					$info_list[$key]['link_flag'] =true;
				}else{
					$info_list[$key]['before_graph_percentage'] =0;
					$info_list[$key]['link_flag'] =false;
				}

			}
		}
		unset($total_counts);
		unset($max_counts);
		unset($total_counts);
		unset($max_key);

		return $info_list;
	}

	function getPagesAnalysisInfos($page_req_param,$conf_info){

		$mode	= $page_req_param['mode'];
		$id		= $page_req_param['id'];

		$common_page_param = array();
		$common_page_param['total']	= $conf_info->total;
		$common_page_param['max']	= $conf_info->max_counts;
		$common_page_param['today']	= $conf_info->today;
		$common_page_param['mode']	= $mode;

		$color_array = array('red','yellow','green','blue','orange','sky');
		$common_page_param['graph_color'] = $color_array[array_rand($color_array)];

		$top_items_titles_of_pages = array();

		$config = new Aokio_Config();

		$message_ob = new Aokio_Message_Manager($config);
		$this->common_messages			= $message_ob->common_messages;
		$analysis_page_view_messages	= $message_ob->analysis_page_view_messages;
		$this->licenses_messages			= $message_ob->licenses_messages;
		$analysis_page_view_table_top_items_titles = $message_ob->analysis_page_view_table_top_items_titles;
//echo "<pre>".nl2br(print_r($message_ob,true))."</pre>";
		if($mode == 0){
			$this->setWords($message_ob->words);
			$this->common_page_view_info = $common_page_param;
			return null;
		}elseif($mode == 1){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='os';
			$common_page_param['page_name'] = $analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['os'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] = $analysis_page_view_messages['os_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;

			if(isset($page_req_param['vo']) && $page_req_param['vo'] != ""){
				$view_option = $page_req_param['vo'];
				if($view_option === 'ca'){
					$analysis_info = AokioAnalysisManager::getOSCategoryInfo($id);
				}elseif($view_option == 'bo'){
					$analysis_info = AokioAnalysisManager::getOSBothInfo($id);
				}else{
					$analysis_info = AokioAnalysisManager::getOSInfo($id);
				}
			}else{
				$analysis_info = AokioAnalysisManager::getOSInfo($id);
			}

			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);

		}elseif($mode ==2){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='browser';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['browser'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['browser_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;

			if(isset($page_req_param['vo']) && $page_req_param['vo'] != ""){
				$view_option = $page_req_param['vo'];
				if($view_option === 'ca'){
					$analysis_info = AokioAnalysisManager::getBrowserCategoryInfo($id);
				}elseif($view_option == 'bo'){
					$analysis_info = AokioAnalysisManager::getBrowserBothInfo($id);
				}else{
					$analysis_info = AokioAnalysisManager::getBrowserInfo($id);
				}
			}else{
				$analysis_info = AokioAnalysisManager::getBrowserInfo($id);
			}

//			$analysis_info = AokioAnalysisManager::getBrowserInfo($id);
			if(!$analysis_info)
				return false;
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);

			//icon
			foreach($final_analysis_info as $key => $value){
				$final_analysis_info[$key]['br_icon'] = "no_browser_icon";
				if(preg_match("#Opera#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "opera";
				}elseif(preg_match("#Firefox#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "firefox";
				}elseif(preg_match("#Flock#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "flock";
				}elseif(preg_match("#SeaMonkey#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "seamonkey";
				}elseif(preg_match("#Internet Explorer#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "ie";
				}elseif(preg_match("#Konqueror#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "konqueror";
				}elseif(preg_match("#Avant#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "avant";
				}elseif(preg_match("#Sleipnir#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "sleipnir";
				}elseif(preg_match("#Netscape#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "netscape";
				}elseif(preg_match("#Mozilla#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "mozilla";
				}elseif(preg_match("#Lunascape#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "lunascape";
				}elseif(preg_match("#Safari#",$value['browser_full_name'])){
					$final_analysis_info[$key]['br_icon'] = "safari";
				}
			}
		}elseif($mode ==3){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='year';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['year'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['year_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;

			$analysis_info = AokioAnalysisManager::getYearInfo($id);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}

			$temp_counts_value = 0;
			foreach($analysis_info['info_list'] as $key => $value){
				if($value['counts']>=$temp_counts_value){
					$temp_counts_value = $value['counts'];
				}
			}
			$analysis_info['max_counts'] = $temp_counts_value;

			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);
			unset($temp_counts_value);

		}elseif($mode ==4){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='month';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['month'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['month_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;

			$analysis_info = AokioAnalysisManager::getMonthInfo($id,$page_req_param['y']);

			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$temp_counts_value = 0;
			foreach($analysis_info['info_list'] as $key => $value){
				if($value['counts']>=$temp_counts_value){
					$temp_counts_value = $value['counts'];
				}
			}

			$analysis_info['max_counts'] = $temp_counts_value;
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);
			unset($temp_counts_value);

		}elseif($mode ==5){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='week';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['week'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['week_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;

			$analysis_info = AokioAnalysisManager::getWeekInfo($id);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$week_name = $message_ob->week_name;
			$temp = $analysis_info['info_list'];
			for($i=0;$i<7;$i++){
				$temp[$i]['week'] = $week_name[$i];
			}
			$analysis_info['info_list'] = $temp;
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);
		}elseif($mode ==6){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='day';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];

//			$common_page_param['before_next_link'] =AokioCommonManager::getBeforeAfterMonthForLink ( $page_req_param['y'],$page_req_param['m'] );
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['day'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['day_comment'];
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;
//			$this->common_page_view_info = $common_page_param;
			$analysis_info = AokioAnalysisManager::getDayInfo($id,$page_req_param['y'],$page_req_param['m']);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);
			$common_page_param['before_next_link'] =
						AokioCommonManager::getBeforeAfterMonthForLink ( $final_analysis_info[0]['year'],$final_analysis_info[0]['month'] );

			$this->common_page_view_info = $common_page_param;

		}elseif($mode ==7){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='hour';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['hour'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['hour_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;
			$analysis_info = AokioAnalysisManager::getHourInfo($id,
													$page_req_param['y'],
													$page_req_param['m'],
													$page_req_param['d']);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageHourInfo($analysis_info);
//			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);

		}elseif($mode ==8){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='language';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['language'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['language_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;

			$analysis_info = AokioAnalysisManager::getLanguageInfo($id);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);
			$final_analysis_info = $this->setLanguageNameWithLanguageConfiguration($config,&$final_analysis_info);
		}elseif($mode ==9){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='nation';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];

			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['nation'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['nation_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;

			$analysis_info = AokioAnalysisManager::getNationInfo($id);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);


			$final_analysis_info = $this->setNationNameWithLanguageConfiguration($config,&$final_analysis_info);
		}elseif($mode ==10){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='city';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$this->common_page_view_info = $common_page_param;
			$analysis_info = AokioAnalysisManager::getCityInfo($id);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);

		}elseif($mode ==11){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='referer';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['referer'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['referer_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;
			$analysis_info = AokioAnalysisManager::getRefererInfo($id);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);

			foreach($final_analysis_info as $key => $value){
				$final_analysis_info[$key]['short_referer'] = $value['referer'];
				if($value['referer'] != 'NO_REFERER_INFO'){
					$final_analysis_info[$key]['link_flag'] = true;
					if(mb_strlen($value['referer']) >40){
						$final_analysis_info[$key]['short_referer'] = mb_substr($value['referer'],0,40)."...";
					}
				}else{
					$final_analysis_info[$key]['link_flag'] = false;
					$final_analysis_info[$key]['short_referer'] =$message_ob->common_messages['no_referer'];
				}

			}

		}elseif($mode ==12){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='refererserver';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['refererserver'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['refererserver_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;
			$analysis_info = AokioAnalysisManager::getRefererServerInfo($id);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);
		}elseif($mode ==13){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='screensize';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['screensize'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['screensize_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;
			$analysis_info = AokioAnalysisManager::getScreensizeInfo($id);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);

		}elseif($mode ==14){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='resolution';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['resolution'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['resolution_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;
			$analysis_info = AokioAnalysisManager::getResolutionInfo($id);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);
		}elseif($mode ==15){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='searchkeyword';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['searchkeyword'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['resolution_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;
			$analysis_info = AokioAnalysisManager::getSearchKeywordInfo($id);

			foreach($analysis_info['info_list'] as $key => $value){
//				ini_set("mbstring.http_output","UTF-8");
//				ini_set("mbstring.internal_encoding","UTF-8");

//				$value['keyword'] = mb_convert_encoding($value['keyword'],  "UTF-8");
					$analysis_info['info_list'][$key]['keyword'] = urldecode($value['keyword']);
			}
//			echo "<pre>".nl2br(print_r($analysis_info,true))."</pre>";
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);
		}elseif($mode ==16){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='searchsite';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['searchsite'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['resolution_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;
			$analysis_info = AokioAnalysisManager::getSearchsiteInfo($id);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);
		}elseif($mode ==17){
			$common_page_param['info_mode'] ='units_counts_info';
			$common_page_param['mode_flag'] ='search_robot';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$top_items_titles_of_pages = $analysis_page_view_table_top_items_titles['robot'];

			// 설명부분 .....
//			$common_page_param['page_name_comment'] =$analysis_page_view_messages['robot_comment'];
			$this->common_page_view_info = $common_page_param;
			$this->top_items_titles_of_pages = $top_items_titles_of_pages;
			$analysis_info = AokioAnalysisManager::getRobotAccessInfo($id);
			if(!$analysis_info){
				unset($analysis_info);
				return false;
			}
			$final_analysis_info = $this->getGraphicalPageInfo($analysis_info);

			include_once 'robot_list.php';
			//TODO 짧게 하지말고...봇 정보를 담고 있는 파일에서 봇정보가져와서 표시하도록 하기
			foreach($final_analysis_info as $key => $value){
//				$final_analysis_info[$key]['short_useragent'] = $value['useragent'];
//				if(strlen($value['useragent']) >40){
//					$final_analysis_info[$key]['short_useragent'] = substr($value['useragent'],0,40)."...";
//				}
				if(array_key_exists($value['useragent'],$bot_detailed_info)){
					$final_analysis_info[$key]['bot'] = $bot_detailed_info[$value['useragent']];
				}else{
					$final_analysis_info[$key]['bot']['name'] = $value['useragent'];
				}
			}

		}elseif($mode ==18){
			$common_page_param['mode_flag'] ='search_robot_detail';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$this->common_page_view_info = $common_page_param;
			$start = 0;
			$list_per_page = $conf_info->lists_per_page;
			$page =1;
			if(isset($page_req_param['rp']) && $page_req_param['rp'] != NULL && $page_req_param['rp'] >0){
//				if(is_int($page_req_param['rp'])){

					$start =($page_req_param['rp']-1)*$list_per_page;
					$page = $page_req_param['rp'];
//				}
			}
			$analysis_info = AokioAnalysisManager::getRobotDetailInfo($id,$start,$list_per_page);
			$final_analysis_info = $analysis_info;
			if(!$final_analysis_info){
				unset($analysis_info);
				unset($final_analysis_info);
				return false;
			}
			unset($start);

			$final_analysis_info = $this->setNationNameWithLanguageConfiguration($config,&$final_analysis_info);

			$list_total_counts = AokioAnalysisManager::getRobotDetailInfoTotalCounts($id);

			$page_counts = ( ($list_total_counts['total_counts']%$list_per_page)>0)?((int)( $list_total_counts['total_counts']/ $list_per_page)) +1 :(int)( $list_total_counts['total_counts'] / $list_per_page ) ;

			// 상수화해서 어딘가에서 지정...? -,.-
			$pager_counts_per_page = 9;
			$last_page = 0;
			if($list_total_counts['total_counts']%$list_per_page == 0 ){
				$last_page = $list_total_counts['total_counts']/$list_per_page;
			}else{
				$last_page = 1+ (int)($list_total_counts['total_counts']/$list_per_page);
			}
			if( ($page * 2) <= ( $pager_counts_per_page + 1 )  ||(int)($list_total_counts['total_counts']/$list_per_page) <=$pager_counts_per_page){
				$start_point = 1;
				$end_point = ($page_counts <= $pager_counts_per_page)?$page_counts: $pager_counts_per_page;
			}else{

				if($page_counts - $page >= (int)($pager_counts_per_page / 2) &&
					$page <= ($page_counts - (int)($pager_counts_per_page / 2 ) )){
					$start_point = $page - (int)($pager_counts_per_page / 2);
					$end_point   = $start_point + $pager_counts_per_page -1 ;
				}else{
					$start_point = $page_counts - $pager_counts_per_page + 1;
					$end_point = $page_counts;
				}
			}

			$page_list = array();
			for($i = $start_point; $i <= $end_point  ; $i++){
				$link_flag = false;
				if($i == $page ){
					$link_flag =true;
				}
				array_push($page_list,array('page'		=>$i,
											'link_flag'	=>$link_flag));
			}
			$this->this_page = $page;
			$this->pager = $page_list;
			$this->pager_next = $page+1;
			$this->pager_prev = $page-1;
			$this->pager_last = $last_page;


			unset($list_total_counts);
			unset($list_per_page);
			unset($pager_counts_per_page);
			unset($page);
			unset($start_point);
			unset($end_point);
			unset($page_counts);
			unset($page_list);

		}elseif($mode ==19){
			$common_page_param['mode_flag'] ='all_info';
			$common_page_param['page_name'] =$analysis_page_view_messages[$mode];
			$this->common_page_view_info = $common_page_param;

			if($page_req_param['bm']!=null && $page_req_param['no']){
			// 북마크
				$bookmark_info = $page_req_param['bm'];
				$no = $page_req_param['no'];
				if($bookmark_info == 'on'){
					AokioAnalysisManager::setBookmarkAnalyzeInfo($no,$id);
				}elseif($bookmark_info == 'off'){
					AokioAnalysisManager::clearBookmarkAnalyzeInfo($no,$id);
				}else{
					//TODO 파라미터가 틀리다는 메시지?
				}
					// 북마크 완료 메시지 어사인
			}else{
				// 북마크 실패 메시지?

			}

			$start = 0;
			$list_per_page = $conf_info->lists_per_page;
			$page =1;
			if(isset($page_req_param['p']) && $page_req_param['p'] != NULL && $page_req_param['p'] >0){

				$start =($page_req_param['p']-1)*$list_per_page;
				$page = $page_req_param['p'];

			}

//			if( $page_req_param['order'] == NULL){
			$order_option = 'no';
/*			}else{
				if($page_req_param['order'] == 'os'){
					$order_option = 'os';
				}elseif($page_req_param['order'] =='br'){
					$order_option = 'browser';
				}elseif($page_req_param['order'] =='ip'){
					$order_option = 'ip';
				}elseif($page_req_param['order'] =='ua'){
					$order_option = 'useragent';
				}elseif($page_req_param['order'] =='tm'){
					$order_option = 'regtime';
				}elseif($page_req_param['order'] =='ln'){
					$order_option = 'language';
				}elseif($page_req_param['order'] =='na'){
					$order_option = 'nation';
				}elseif($page_req_param['order'] =='rf'){
					$order_option = 'referer';
				}else{
					$order_option = 'no';
				}
			}
*/
			//정렬 순서
/*
			if($page_req_param['ot']!=null){
				if($page_req_param['ot'] == 'a'){
					$order_type = 'ASC';
					$ot_template = 'a';
				}else{
					$order_type = 'DESC';
					$ot_template = 'd';
				}
			}else{
				*/
				$order_type = 'DESC';
				$ot_template = 'd';
//			}
			$analy_input_param = array(
										'target'			=> $id,
										'start'				=> $start,
										'list_per_page'	=> $list_per_page,
										'order_option'		=> $order_option,
										'order_type'		=> $order_type,
										);

			$analysis_info = AokioAnalysisManager::getAnalyzeInfoList($analy_input_param);


			foreach($analysis_info as $key => $value){
				if($analysis_info[$key]['referer']==='NO_REFERER_INFO'){
					$analysis_info[$key]['referer_output_format'] =$message_ob->common_messages['no_referer'];
				}else{
					$analysis_info[$key]['referer_output_format'] = $value['referer'];
				}
			}
			$final_analysis_info = $analysis_info;
			if(!$final_analysis_info){
				unset($analysis_info);
				unset($final_analysis_info);
				return false;
			}
			unset($start);
/////			$config = new Aokio_Config();

			$final_analysis_info = $this->setNationNameWithLanguageConfiguration($config,&$final_analysis_info);
			$final_analysis_info = $this->setLanguageNameWithLanguageConfiguration($config,&$final_analysis_info);

			//TODO 따로???
//			if(isset($page_req_param['option']) && $page_req_param['option'] != NULL ){

//				$analysis_info = AokioAnalysisManager::getAnalyzeInfoBookmarkList($analy_input_param);
				// TODO 토탈 값등 북마크일때 따로 구해야함....

//				$list_total_counts = AokioAnalysisManager::getAnalyzeInfoBookmarkTotalCounts($id);
//			}else{
				// TODO 각각의 파라미터 별로 토탈값 다시구해올것
				$list_total_counts = AokioAnalysisManager::getAnalyzeInfoTotalCounts($id);

//			}


			$page_counts = ( ($list_total_counts['total_counts']%$list_per_page)>0)?
						((int)( $list_total_counts['total_counts']/ $list_per_page)) +1 :
						(int)( $list_total_counts['total_counts'] / $list_per_page ) ;
			//TODO 어딘가에서 상수화...
			$pager_counts_per_page = 9;
			$last_page = 0;
			if($list_total_counts['total_counts']%$list_per_page == 0 ){
				$last_page = $list_total_counts['total_counts']/$list_per_page;
			}else{
				$last_page = 1+ (int)($list_total_counts['total_counts']/$list_per_page);
			}
			if( ($page * 2) <= ( $pager_counts_per_page + 1 )  ||(int)($list_total_counts['total_counts']/$list_per_page) <=$pager_counts_per_page){
				$start_point = 1;
				$end_point = ($page_counts <= $pager_counts_per_page)?$page_counts: $pager_counts_per_page;
			}else{

				if($page_counts - $page >= (int)($pager_counts_per_page / 2) &&
					$page <= ($page_counts - (int)($pager_counts_per_page / 2 ) )){
					$start_point = $page - (int)($pager_counts_per_page / 2);
					$end_point   = $start_point + $pager_counts_per_page -1 ;
				}else{
					$start_point = $page_counts - $pager_counts_per_page + 1;
					$end_point = $page_counts;
				}
			}
			$page_list = array();
			for($i = $start_point; $i <= $end_point  ; $i++){
				$link_flag = false;
				if($i == $page ){
					$link_flag =true;
				}
				array_push($page_list,array(	'page'		=>$i,
															'link_flag'	=>$link_flag));
			}
			$this->this_page = $page;
			$this->pager = $page_list;
			$this->pager_next = $page+1;
			$this->pager_prev = $page-1;
			$this->pager_last = $last_page;
			$this->order = $order_option;
			$this->order_type = $ot_template;
/*			if($final_analysis_info['bookmark'] == null || $final_analysis_info['bookmark'] == 0){
				$this->bm_flag  = 'on';
			}else{
				$this->bm_flag  = 'off';
			}
			*/
			unset($list_total_counts);
			unset($list_per_page);
			unset($pager_counts_per_page);
			unset($page);
			unset($start_point);
			unset($end_point);
			unset($page_counts);
			unset($page_list);
			unset($last_page);
		}else{
			$this->common_page_view_info = $common_page_param;
		}
		unset($mode);
		unset($id);
		unset($analysis_info);
		unset($common_page_param);
		return $final_analysis_info;
	}


	function getSevenDaysCounts($page_req_param){
		$id = $page_req_param['id'];
		$analysis_info = AokioAnalysisManager::getSevenDaysCounts($id);
		return $analysis_info;
	}


	function setWords($words){
		$this->words = $words[array_rand($words)];
	}


	function setNationNameWithLanguageConfiguration($config,$analysis_info){
		$nation_name_ob = new Aokio_Nation_Manager($config);

		$nation_name = $nation_name_ob->nation_name_table;

		foreach($analysis_info as $key => $value){
			if(isset($nation_name[$value['nation_code']])){
				$analysis_info[$key]['nation_trans'] = $nation_name[$value['nation_code']];
			}

		}

		return $analysis_info;
	}

	function setLanguageNameWithLanguageConfiguration($config,$analysis_info){
		$language_name_ob = new Aokio_Language_Manager($config);
		$language_name = $language_name_ob->language_name_table;
		foreach($analysis_info as $key => $value){
			if(isset($language_name[$value['language']])){
				$analysis_info[$key]['language_trans'] = $language_name[$value['language']];
			}
		}
		return $analysis_info;
	}

}
?>