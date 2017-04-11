<?php

$install_messages = array(
	'terms_of_service' =>
		array(
			'terms_of_service_title'	=> '라이센스규약 ',
			'terms_of_service_content'	=> ' ',
			'terms_of_service_content_1' => 'Aokio Analyzer의 저작권은 제작자에게 있습니다.',
			'terms_of_service_content_2' => 'Aokio Analyzer의 허락 맡지 않은 재배포는 허용하지 않습니다.',
			'terms_of_service_content_3' => 'Aokio Analyzer는 저작권 명시시 누구나 사용할수 있습니다.',
			'terms_of_service_content_4' => 'Aokio Analyzer는 무료프로그램(프리웨어)이 아님을 알려드립니다.',
			'terms_of_service_content_5' => 'Aokio Analyzer 사용시 저작권 명시부분을 훼손하면 안됩니다.',
			'terms_of_service_content_6' => 'Aokio Analyzer 사용으로 인한 데이타 손실 및 기타 손해에 대해서 제작자는 책임을 지지 않습니다.',
			'terms_of_service_content_7' => 'Aokio Analyzer에 대해 제작자는 유지/보수의 의무가 없습니다.',
			'terms_of_service_content_8' => 'Aokio Analyzer의 상업적 목적으로 판매할수 없습니다.',
			'terms_of_service_content_9' => 'Aokio Analyzer의 소스는 개인적으로 사용시 수정하여 사용할수 있습니다. (단 수정배포는 안됩니다.)',

			'terms_of_service_content_last' => '위의 사항에 동의 하시면 OK를 누르시고 , 아니면 브라우저창을 닫아주세요.-,.-',
			),
	'database_select' =>
		array(
			'database_select_title'		=> '데이터베이스 선택',
			'database_select_comment'	=> '현재 지원되는 DB는 MySQL 입니다.<br/> '
			//'database_select_comment'	=> '사용하는 데이터베이스를 선택하세요. '
			),
	'database_config' =>
		array(
			'database_config_title'		=> '데이터베이스 설정',
			'database_config_comment'	=> '데이터베이스 설정값을 입력해주세요.'
			),

	'administrator_config' =>
		array(
			'administrator_config_title'		=> '관리자 설정',
			'administrator_config_comment'	=> '관리자설정값을 입력해주세요.'
			),
	'install_completed' =>
		array(
			'install_completed_title'		=> '설치가 완료되었습니다.',
			'install_completed_comment'		=> '안전을 위하여 install.php 파일을 삭제하시기 바랍니다.',
			),
	'error_messages' =>
		array(
			'config_file_exist'				=> 'config.php파일이 존재합니다. 파일을 삭제후 다시 인스톨하세요.',
			'database_config_is_wrong'	=> '데이터베이스 설정이 틀렸습니다. 다시확인해주세요.',
			'file_handling_error'			=> 'config.php 생성에 실패하였습니다. 설치디렉토리의 권한이 777인지 확인하세요.',
			'admin_input_is_no'			=> 'ID 또는 비밀번호의 입력이 빠졌어요.',
			'admin_input_is_wrong'		=> 'ID,비밀번호의 입력은 알파벳,숫자,_로만 해주세요',
			'install_completed_already'	=> '설치가 이미 끝났습니다.',
			)
					);

$login_page_messages = array(
		'english_title'						=> 'Administrator Login',
		'selected_language_title'		=> '관리자 로그인',
		'id'									=> 'I D',
		'password'							=> 'PASSWORD',
		'submit'								=> 'LOGIN',
		'input_error_wrong_input'	=> 'ID 또는 비밀번호가 틀렸습니다.',
		'input_error_no_input'			=> 'ID 와 비밀번호의 입력을 빠트리지 마세요.-,.-',
							);

$form_messages = array(	'ok'			=> '확인',
										'login_submit'	=> 'LOGIN');

$config_messages =array(
		'target_name'							=> '분석 페이지명',
		'target_name_commnet'			=> '닉네임으로 사용하실 이름을 입력하세요. 한글도 사용할 수 있습니다.',
		'lists_per_page'						=> '상세정보 페이지당 표시건수',
		'access_check_pattern'			=> '접속기록 설정',
		'access_check_pattern_items'	=>
					array(
						'항상 접속체크',
						'브라우저를 다시 시작할때만 체크',
						'하루에 한번 체크',
						'지정시간에 한번 체크',
						),
		'check_admin_access'				=> '관리자 접속체크 설정',
		'check_admin_access_items'	=>
					array(
						'관리자 접속을 기록',
						'관리자 접속을 기록하지않음',
						),
		'access_permission'			=> '외부접근권한설정',
		'access_permission_items'	=>
					array(
						'1'	 =>'OS별 통계 접근 가능',
						'2'	 =>'브라우저별 통계 접근 가능',
						'3'	 =>'연도별 통계 접근 가능',
						'4'	 =>'월별 통계 접근 가능',
						'5'	 =>'요일별 통계 접근 가능',
						'6'	 =>'일별 통계 접근 가능',
						'7'	 =>'시간별 통계 접근 가능',
						'8'	 =>'접속언어별 통계 접근 가능',
						'9'	 =>'접속국가별 통계 접근 가능',
//						'10'=>'도시별 통계 접근 가능',
						'11'=>'링크페이지(레퍼러)통계 접근 가능',
						'12'=>'링크(레퍼러)서버 통계 접근 가능',

						'13'=>'화면크기 통계 접근 가능',
						'14'=>'해상도(색상수) 통계 접근 가능',
						'15'=> '검색어 통계접근 가능',
						'16'=> '검색사이트 통계접근 가능',
						'17'=>'검색로봇통계 접근 가능',
						'18'=>'로봇 상세정보 접근 가능',
						'19'=>'접속상세정보 접근 가능',
						),
		'portal_page'				=> '포탈 페이지',
		'portal_page_items'	=>
					array(
						'0'=>'사용안함',
						'1'=>'OS별 통계 ',
						'2'=>'브라우저별 통계',
						'3'=>'연도별 통계',
						'4'=>'월별 통계',
						'5'=>'요일별 통계',
						'6'=>'일별 통계',
						'7'=>'시간별 통계',
						'8'=>'접속 언어별 통계',
						'9'=>'접속 국가별 통계',
//						'10'=>'도시별 통계',
						'11'=> '링크페이지(레퍼러)통계',
						'12'=>'링크(레퍼러)서버통계',
						'13'=>'화면크기 통계',
						'14'=>'해상도(색상수)통계',
						'15'=> '검색어 통계',
						'16'=> '검색사이트 통계',
						'17'=>'검색로봇통계',
						'18'=>'로봇 상세통계',
						'19'=>'접속상세정보',

						),
						);
$config_update_completed_message = "환경설정을 수정하였습니다.";


$manager_messages =array(
		'target_list_item_titles'	=> array(
									'no'			=>'번호',
									'target'		=>'분석페이지',
									'today'		=>'오늘',
									'total'			=>'전체',
									'max'			=>'최대',
									'drop'		=>'삭제',
									'truncate'	=>'비우기',
									'config'		=>'설정',
									),
		'create_new_target'			=> '새 분석페이지 만들기',
		'howto_create_new_target'	=> '영문,숫자,_ 만 가능합니다.30자 이내로 입력하세요',
		'original_password'				=> '이전 비밀번호',
		'password'							=> '비밀번호',
		're_password'						=> '비밀번호재입력',
		'change_language'				=> '언어바꾸기',
		'select_menu_type'				=> '메뉴표시타입선택',
		'select_menu_type_items'	=> array(
									'text'		=>'텍스트',
									'image'	=>'이미지',
									),
		'update_check'					=> '최신버젼 체크',
		'original_password_wrong'	=> '이전 비밀번호가 틀립니다.',
		're_password_wrong'			=> '비밀번호 재입력이 틀립니다.',
		'no_id_message'					=> '페이지가 선택되지 않았습니다.',
		'drop_confirm_message'		=> '정말로 삭제하시겠습니까?',
		'truncate_confirm_message'=> '정말로 비우시겠습니까?',
						);


$link_comments = array( 'logout' => '',
						'manager' => '',
						'config' => '',
						'os_menu' => '',
						'browser_menu' => '',
						'annually_menu' => '',
						'monthly_menu' => '',
						'daily_menu' => '',
						'weekly_menu' => '',
						'hourly_menu' => '',
						'nationaly_menu' => '',
						'language_menu' => '',
						);

$analysis_page_view_messages =
				array(	1			=> '운영체제통계',
//						'os_comment'	=> '',
						2		=> '브라우저통계',
						3		=> '연도별통계',
						4		=> '월별통계',
						5		=> '요일별통계',
						6		=> '일별',
						7		=> '시간별통계',
						8		=> '언어별통계',
						9		=> '국가별통계',

						11		=> '레퍼러통계',
						12		=> '레퍼러서버통계',
						13		=> '화면크기통계',
						14		=> '해상도통계',
						15		=> '검색어 통계',
						16		=> '검색사이트 통계',
						17		=> '로봇통계',
						18		=> '로봇접속상세정보',
						19		=> '일반유저접속상세정보',
						);


$analysis_page_view_table_top_items_titles =
				array(
						'os'=> array(	'subject'					=>	'OS',
										'counts'						=>	'방문자',
										'percentage'				=>	'%',
										'full_name_analysis'	=> 'OS버젼까지 통계표시',
										'category_analysis'		=> 'OS종류 통계표시',
										'total_1'						=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
										'os_1'						=>'접속 OS 수',//
//										'os_2'=>' 종류의 OS로 접속하였습니다.',
								),

						'browser'=> array(
										'subject'						=>	'Browser',
										'counts'						=>	'방문자',
										'percentage'				=>	'%',
										'full_name_analysis'	=> '브라우저버젼까지 통계표시',
										'category_analysis'		=> '브라우저종류 통계표시',
										'total_1'						=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
										'browser_1'				=>'접속 Browser 수',//
//										'browser_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'year'=> array(	'subject'	=>	'연 도',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'month'=> array('subject'	=>	'월',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'week'=> array('subject'	=>	'요일 별',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'day'=> array('subject'	=>	'일',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'hour'=> array('subject'	=>	'시간',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'nation'=> array('subject'	=>	'국가명',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'language'=> array('subject'	=>	'언 어 ',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'referer'=> array('subject'	=>	'레퍼러',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'refererserver'=> array('subject'	=>	'레퍼러서버',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'screensize'=> array('subject'	=>	'화 면 크 기',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'resolution'=> array('subject'	=>	'해상도(색상수)',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'searchkeyword'=> array('subject'	=>	'검색어',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'searchsite'=> array('subject'	=>	'검색사이트',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
						'robot'=> array('subject'	=>	'검색로봇',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
//										'year_1'=>'접속 Browser 수',//
//										'year_2'=>' 종류의 OS로 접속하였습니다.',
								),
					);
$common_messages = array(
						'no_record'	=>	'방문기록이 없습니다.',
						'no_referer' => '주소직접입력 또는 즐겨찾기 접속',
									);

$week_name = array(
			0 => '일요일',
			1 => '월요일',
			2 => '화요일',
			3 => '수요일',
			4 => '목요일',
			5 => '금요일',
			6 => '토요일',
			);

$create_page_messages = array(
		'title'		=> '사 용 법',
		'howto_1'	=> '접속 정보를 얻으려는 페이지에 다음의 코드를 복사,붙여넣기 하여 저장하세요.',
		'error_messages' => array(
							'input_error_no_input' => '생성할 페이지를 입력하세요.',
							'input_error_character_error' => '알파벳,숫자,_만 입력할 수 있습니다.',
							'input_error_is_exist' => '페이지가 벌써 만들어져 있습니다.',
							'input_error_too_long' => '너무 길어요..-,.-',
							),
		'comment_title'	=> '사용예',
		'comment'	=> '
		사용하시는 AokioAnalyzer가 http://www.yourdomain.com/aanalyzer/ 에 설치되어있고,
		접속정보를 얻으려는 페이지가 http://www.yourdomain.com/index.html
		인 경우 위의 코드를 복사하여
		index.html 파일의 맨위부분에 붙여넣기를 하시기 바랍니다.

		주위하실 사항이 위 코드에서 여러분이 AokioAnalyzer 를 설치한 디렉토리에 맞추어 /aanalyzer/ 부분을 수정할것과
		접속정보를 얻으려는 페이지에 맞추어 상대패스를 수정해주는것입니다.',
		);

$words = array(
'',
);


$licenses_messages = array(
'license' =>'<!------------------------------------------------------------------------------
Aokio Analyzer 에 대한 라이센스 명시입니다.
아래 라이센스에 동의하시는 분만 Aokio Analyzer를 사용할수 있습니다.

프로그램명     : Aokio Analyzer
Programmer  : aokio
Design          : aokio
Homepage     : http://www.aokio.com
E-Mail           : st.elmo@gmail.com

1.  Aokio Analyzer의 저작권은 제작자에게 있습니다.
2.  Aokio Analyzer의 배포권은 제작자가 허용한 곳에만 있습니다.
    (허락 맡지 않은 재배포는 허용하지 않습니다.)
3.  Aokio Analyzer는 저작권 명시시 누구나 사용할수 있습니다.
    (개인,비영리단체,상업사이트 기업이나 영리,비영리 단체포함)
4.  Aokio Analyzer는 무료프로그램(프리웨어)이 아님을 알려드립니다.
    (Aokio Analyzer 카피라이터 사용하는 조건으로 사용할수 있는 있습니다.)
5.  Aokio Analyzer사용시 저작권 명시부분을 훼손하면 안됩니다.
    (저작권 표시는 원본 그대로를 유지 하여야 합니다.임의 수정 및 아이콘화 금지)
6.  Aokio Analyzer 사용으로 인한 데이타 손실 및 기타 손해에 대해서 책임을 지지 않습니다.
7.  Aokio Analyzer에 대해 유지/보수의 의무가 없습니다.
8.  Aokio Analyzer의 상업적 목적으로 판매할수 없습니다.
9.  Aokio Analyzer의 소스는 개인적으로 사용시 수정하여 사용할수 있습니다. (단 수정배포는 안됩니다.)
10.  위 사항에 동의하시는 분만 Aokio Analyzer를 사용할수 있습니다.
------------------------------------------------------------------------------->
'

);
?>
