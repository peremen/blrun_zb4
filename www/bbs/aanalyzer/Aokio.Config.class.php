<?php
/***************************************************************************
		                        Aokio.Config.class.php
		                             -------------------
		    begin                :  March 02 2006
		    copyright           : (C) 2004 Aokio
		    email                : st.elmo@gmail.com

 ***************************************************************************/

/***************************************************************************
 *
 *
 ***************************************************************************/
//2006.3.02 AbstractDao.php 작성 0.01
//2006.3.03 기본 구성 확정 0.05
//2006.3.04 aokio analyze class 작성 0.08
//2006.3.05 aokio analyze manager ,dao 작성 0.10
//2006.3.05 aokio_anlyze.php 작성 0.12
//2006.3.06 view.php protype 작성 0.13
//2006.3.06 screen.js 작성 사용할지 말지 고민중...-,.- 0.14
//2006.3.07 브라우저,오에스 ..모바일 판단 자료 조사 수정 0.16
//2006.3.07 디자인 작업 0.20
//2006.3.08 이미지 작업 0.25
//2006.3.09 세션 ,쿠키 ...-,.- 도-스루...0.251
//2006.3.04--->3.13 기본 골격 이런 저런 온갖 작업  0.40
//2006.3.14 국가 통계 0.45
//2006.3.15 인스톨 루틴 작성 로그인 화면 작성  0.46
//2006.3.15 로봇 리스트 항목 추가 0.47
//2006.3.16 월별,일별 리스트 뽑는 부분 버그 수정 0.48
//2006.3.16 시간별 리스트 뽑는 부분 버그 수정 0.49
//2006.3.16 국기 표시 0.50
//2006.3.16 국기 부분 버그 수정, nation 루틴 부분 ?... 0.52
//2006.3.16 접속정보 리스트 페이저 프로토타입 ?... 0.53
//2006.3.17 스마티관련 설정, 환경설정 부분 리팩터링 0.56
//2006.3.17 safari 버젼 판단 부분 버그 수정 0.57
//2006.3.17 referer 표시 부분 수정 0.58
//2006.3.17 타겟 설정 화면 구현 config.clss 수정 config manager 수정0.60
//2006.3.17 install 관련 루틴 수정및 작성0.63
//2006.3.18 max. total .today 수정0.64
//2006-03-20	view.php 완전 리팩터링,검색로봇 테이블 수정,	쿠키관련 작성...	0.68
//2006-03-20 데이터 가져올때 null의 경우시 에러 처리 추가0.70
//2006-03-21 Design 대폭 수정0.72
//2006-03-21 검색로봇 테이블 수정,검색로봇판단 데이터 추가0.73
//2006-03-22 레퍼러서버항목 추가0.74
//2006-03-22 환경설정 영역에서 포탈 페이지 추가 0.75
//2006-03-22 상세정보에서 정렬방법 순서 추가 0.76
//2006-03-23 상세정보에서 북마크 기능 추가 0.77
//2006-03-23 메뉴 스마티 어사인으로 변경 0.78
//2006-03-23 레퍼러 메뉴 추가 0.79
//2006-03-23 manager 설정항목 추가 0.80
//2006-03-23 매니저 패스워드 변경항목 추가  0.81
//2006-03-25 그래프 이미지 변경 0.85
//2006-03-26 스크린사이즈,해상도테이블 추가 0.86
//2006-03-27 템플리트 수정 0.87
//2006-03-27 accept language 추가 0.88
//2006-03-28 브라우저 아이콘 추가 0.89
//2006-03-28 브라우저 정보 추가 0.90
//2006-03-28 로그인 관련 수정 0.91
//2006-03-31 매니져 수정 화면 작성 0.92
//2006-03-31 설정 수정 화면 수정 0.93
//2006-03-31 페이지 작성 화면 0.94
//2006-03-31 config 쪽 리팩터 0.95
//2006-03-31 봇 추가, 브라우저 판별 추가 0.96
//2006-04-01 인스톨부분 수정 0.97
//2006-04-01 시간별 통계 월초 부분 버그 수정 0.98
//2006-04-03 pear 관계부분 수정 0.99
//2006-04-03 날샌 기념 -,.- 1.00
//2006-04-03 프록시 접속 여부 판단 추가 1.01
//					( 정확하지는않음 최대한 뽑아낼수 있는 정보 뽑아내서 프록시접속여부 판단)
//2006-04-05 컨넥션 클로징 부분 버그 수정 1.02 -,.- 이런 걸 틀리냐..문디...
//2006-04-11 각페이지 에러리포트 all 에 맞추어서 수정. 1.021
//2006-04-13 Os, browser 클래스로 따로 분리  더 분석값 정확하게 ... 1.028
//2006-04-13 os, browser 관련 테이블 수정 ( 메인테이블도 ...) 1.030
//2006-04-14 analyze 에서 다 클래스로 만들어서 정보 취득. 날밤 샜네...-,.- 1.035
//2006-04-15 브라우저, 오에스 카테고리별 표시도 추가 1.039
//2006-04-15 검색어 통계,검색사이트 통계 추가 1.05( 월별 검색어 통계 아직...)
//2006-04-15 검색어 추출시 버그 수정. 일본어로 검색시 문제없는지 확인하고 싶은디..-,.- 1.051
//					한국 검색사이트도 다 확인된게 아니라 좀 불안하기도 하고...
//2006-04-16 truncate 시 버그 수정 1.052
//2006-04-16 방문횟수  1.053
//2006-04-19 no referer 1.054
//2006-04-19 referer mb_convert_encoding 수정 1.055
//2006-04-20 Konqueror 버젼 정보 부분 수정 1.056
//2006-04-20 페이지뷰용 테이블 수정 1.057
//2006-04-20 10:39 칼라설정 수정 1.058

//2006-04-22 검색봇 상세정보에서 국가이름 설정언어로 표시하도록 수정(Aokio.Analysis.class.php , content_search_robot_detail.tpl) 1.059
//2006-04-23 검색봇,크롤러 통계페이지 , 유저에이전트를 그냥 표시하지 않고 , 이름을 표시하도록...1.060 (Digext 제외)
//2006-04-23 설정화면에서 타겟명 htmlentities 사용, 입력값에 클라이언트 단에서 입력치 검사 1.061
//2006-04-24 리펙터링 analyzer 와 analysis 구분해서 매니져,dao 분리
//					AokioDao.php --> Aokio.Dao.class.php 로 변경.
//					AokioSmarty.php --> Aokio.Smarty.class.php 로 변경.
//					자잘한 리팩터	1.062


require_once 'Aokio.Config.Manager.php';
define ('MYHOME' ,					'http://www.blrun.net');
define ('MYEMAIL' ,					'st.elmo@gmail.com');
define ('APPLICATIONNAME' ,	'AokioAnalyzer');
define ('SINCE' ,						'2006');
define ('VERSION' ,					'1.062');

define ('DB_CONFIG_FILENAME' ,		'config.php');
define ('VIEW_FILENAME' ,			'view.php');
define ('CONFIG_EXE_FILENAME' ,		'aokio_config.php');
define ('MANAGER_FILENAME' ,	'manager.php');
define ('ANALYZER_FILENAME' ,	'aokio_analyzer.php');
define ('LOGIN_FILENAME' ,			'login.php');

define ('VERSION_CHECKURL' ,	'http://www.aokio.com/apps/aaa/');

class Aokio_Config{

	var $my_home					= MYHOME;
	var $my_email					= MYEMAIL;
	var $application_name		= APPLICATIONNAME;
	var $version						= VERSION;
	var $since							= SINCE;
	var $path;

	var $version_check_url = VERSION_CHECKURL;

	var $config_file_name							= DB_CONFIG_FILENAME; //DB 설정 파일
	var $analysis_view_file_name				= VIEW_FILENAME;
	var $target_config_exe_file_name		= CONFIG_EXE_FILENAME;
	var $manager_exe_file_name				= MANAGER_FILENAME;
	var $analyzer_file_name						= ANALYZER_FILENAME;

	var $my_nick = array(	'AOKIO',
//							'St.elmo',
//							'Yosi',
//							'whitefox',
							);
	var $code_name								= "CODENAME:komorebi:木洩れ日";

	var $db_list = array(	'mysql' =>'MySQL',
							);
	var $lang_list = array(	'korean'	=>'Korean',
//							'english'	=>'English',
							'japanese'	=>'Japanese'
							);
	var $lists_per_page;
	var $language;
	var $menu_type;
	var $portal_page;

	var $total =0;
	var $max_counts =0;
	var $today =0;

	var $encoding = "utf-8";

	var $target_exist_flag = false;

	var $database_type;

	function Aokio_Config($initial=false){
		if(!$initial){
			$this->setDatabaseType();
			$this->setApplicationConfigurationInfos();
//			$this->setApplicationMenuType();
		}
	}

	function setDatabaseType(){
		include dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'config.php';
		$this ->database_type = $phptype;

	}
	function setApplicationConfigurationInfos(){

		$conf_infos = AokioConfigManager::getApplicationConfigurationInfos();
		$this->language		= $conf_infos['language'];
		$this->menu_type	= $conf_infos['menu_type'];
	}

	function setTargetConfigurationInfos($id){
		$temp_conf = AokioConfigManager::getTargetConfigInfos($id);
		if($temp_conf !=null){
			$this->lists_per_page		= $temp_conf['lists_per_page'];
			$this->portal_page			= $temp_conf['portal_page'];
			$this->target_exist_flag	= true;
			$this->total					= $temp_conf['total'];
			$this->max_counts			= $temp_conf['max'];
			$this->today					= $temp_conf['today'];
		}
	}

	function getSince(){
		// TODO 연도 계산 하도록..
		return "Since ".$this->since;
	}
}
?>
