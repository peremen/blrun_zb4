<?php

/*
$language_array = array(
	"ko" => "한국어",
	"jp" => "일본어",
	"en" => "영어",
	);
*/
$install_messages = array(
	'terms_of_service' => 
		array( 
			'terms_of_service_title'	=> '어플리케이션 사용상의 규약',
			'terms_of_service_content'	=> '어플리케이션 사용상의 규약이라니까 열라 대단해보이죠? ^^<br/>그냥 흔히 프로그램 배포시 하는 문제생길시 난 책임없고 , 난 유지보수의 책임이 없고...등등의 내용입니다. 나중엔 머라하지 마세요...-,.-',
			'terms_of_service_content_1' => '1.............',
			'terms_of_service_content_2' => '2...............',
			'terms_of_service_content_3' => '3...........',
			'terms_of_service_content_4' => '4.........',

			'terms_of_service_content_last' => '위의 사항에 동의 하시면 OK를 누르시고 , 아니면 브라우저창을 닫아주세요.-,.-',
			),
	'database_select' => 
		array( 
			'database_select_title'		=> '데이터베이스 선택',
			'database_select_comment'	=> '현재 지원되는 DB는 MySQL 입니다.<br/> 조만간 PostgreSQL도 사용할 수 있을꺼라 생각되는데...조만간이요...^^'
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
			'config_file_exist'			=> 'config.php파일이 존재합니다. 파일을 삭제후 다시 인스톨하세요.',
			'database_config_is_wrong'	=> '데이터베이스 설정이 틀렸습니다. 다시확인해주세요.',
			'file_handling_error'		=> 'config.php 생성에 실패하였습니다.',
			'admin_input_is_no'			=> 'ID 또는 비밀번호의 입력이 빠졌어요.',
			'admin_input_is_wrong'		=> 'ID,비밀번호의 입력은 알파벳,숫자,_로만 해주세요',
			'install_completed_already'	=> '설치가 이미 끝났습니다.',
			)
					);

$login_page_messages = array(	
		'english_title'				=> 'Administrator Login',
		'selected_language_title'	=> '관리자 로그인',
		'id'						=> 'I D',
		'password'					=> 'PASSWORD',
		'submit'					=> 'LOGIN',
		'input_error_wrong_input'	=> 'ID 또는 비밀번호가 틀렸습니다.',
		'input_error_no_input'		=> 'ID 와 비밀번호의 입력을 빠트리지 마세요.-,.-',
							);

$form_messages = array(	'ok'			=> '확인',
						'login_submit'	=> 'LOGIN');

$config_messages =array(
		'target_name'			=> '분석 페이지명',
		'target_name_commnet'	=> '닉네임으로 사용하실 이름을 입력하세요. 한글도 사용할 수 있습니다.',
		'lists_per_page'		=> '상세정보 페이지당 표시건수',
		'access_check_pattern'	=> '접속기록 설정',
		'access_check_pattern_items'	=> 
					array(
						'항상 접속체크',
						'브라우저를 다시 시작할때만 체크',
						'하루에 한번 체크',
						'지정시간에 한번 체크',
						),
		'check_admin_access'		=> '관리자 접속체크 설정',
		'check_admin_access_items'	=> 
					array(
						'관리자 접속을 기록',
						'관리자 접속을 기록하지않음',
						),
		'access_permission'			=> '외부접근권한설정',
		'access_permission_items'	=> 
					array(
						'1'=>'OS별 통계 접근 가능',
						'2'=>'브라우저별 통계 접근 가능',
						'3'=>'연도별 통계 접근 가능',
						'4'=>'월별 통계 접근 가능',
						'5'=>'요일별 통계 접근 가능',
						'6'=>'일별 통계 접근 가능',
						'7'=>'시간별 통계 접근 가능',
						'8'=>'접속언어별 통계 접근 가능',
						'9'=>'접속국가별 통계 접근 가능',
//						'10'=>'도시별 통계 접근 가능',
						'11'=>'링크페이지(레퍼러)통계 접근 가능',
						'12'=>'링크(레퍼러)서버 통계 접근 가능',
						'13'=>'화면크기 통계 접근 가능',
						'14'=>'해상도(색상수) 통계 접근 가능',
						'15'=>'검색로봇통계 접근 가능',
						'16'=>'로봇 상세정보 접근 가능',
						'17'=>'접속상세정보 접근 가능',
						),
		'portal_page'	=> '포탈 페이지',
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
						'12'=>'링크9레퍼러)서버통계',
						'13'=>'화면크기 통계',
						'14'=>'해상도(색상수)통계',
						'15'=>'검색로봇통계',
						'16'=>'로봇 상세통계',
						'17'=>'접속상세정보',

						),
						);
$config_update_completed_message = "환경설정을 수정하였습니다.";


$manager_messages =array(
		'target_list_item_titles'	=> array(
									'no'		=>'번호',
									'target'	=>'분석페이지',
									'today'		=>'오늘',
									'total'		=>'전체',
									'max'		=>'최대',
									'drop'		=>'삭제',
									'truncate'	=>'비우기',
									'config'	=>'설정',
									),
		'create_new_target'			=> '새 분석페이지 만들기',
		'howto_create_new_target'	=> '영문,숫자,_ 만 가능합니다.30자 이내로 입력하세요',
		'original_password'			=> '이전 비밀번호',
		'password'					=> '비밀번호',
		're_password'				=> '비밀번호재입력',
		'change_language'			=> '언어바꾸기',
		'select_menu_type'			=> '메뉴표시타입선택',
		'select_menu_type_items'	=> array(
									'text'	=>'텍스트',
									'image'	=>'이미지',
									),
		'original_password_wrong'	=> '이전 비밀번호가 틀립니다.',
		're_password_wrong'			=> '비밀번호 재입력이 틀립니다.',
		'no_id_message'				=> '페이지가 선택되지 않았습니다.',
		'drop_confirm_message'		=> '정말로 삭제하시겠습니까?',
		'truncate_confirm_message'	=> '정말로 비우시겠습니까?',
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
/*
$analysis_page_view_messages = 
				array(	'os'			=> '운영체제통계',
//						'os_comment'	=> '',
						'browser'		=> '브라우저통계',
						'year'			=> '연도별통계',
						'month'			=> '월별통계',
						'day'			=> '일별',
						'week'			=> '요일별통계',
						'hour'			=> '시간별통계',
						'language'		=> '언어별통계',
						'nation'		=> '국가별통계',
						'referer'		=> '레퍼러통계',
						'refererserver' => '레퍼러서버통계',
						'screensize'	=> '화면크기통계',
						'resolution'	=> '해상도통계',
						'robot'			=> '로봇통계',
						'robotdetail'	=> '로봇접속상세정보',
						'accessdetail'	=> '일반유저접속상세정보',
						);
*/

$analysis_page_view_messages = 
				array(	1			=> '운영체제통계',
//						'os_comment'	=> '',
						2		=> '브라우저통계',
						3			=> '연도별통계',
						4			=> '월별통계',
						
						5			=> '요일별통계',
						6			=> '일별',
						7			=> '시간별통계',
						8		=> '언어별통계',
						9		=> '국가별통계',

						11		=> '레퍼러통계',
						12		=> '레퍼러서버통계',
						13		=> '화면크기통계',
						14		=> '해상도통계',
						15		=> '로봇통계',
						16		=> '로봇접속상세정보',
						17		=> '일반유저접속상세정보',
						);


$analysis_page_view_table_top_items_titles = 
				array(	
						'os'=> array(	'subject'	=>	'OS',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
										'os_1'=>'접속 OS 수',//
//										'os_2'=>' 종류의 OS로 접속하였습니다.',
								),
						
						'browser'=> array(	
										'subject'	=>	'Browser',
										'counts'	=>	'방문자',
										'percentage'=>	'%',
										'total_1'=> 'Total',	//전체
//										'total_2'=> '명의 방문자',
										'browser_1'=>'접속 Browser 수',//
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
									);

$create_page_messages = array(
		'title'		=> '利用方法',
		'howto_1'	=> '접속 정보를 얻으려는 페이지에 다음의 코드를 복사,붙여넣기 하여 저장하세요.',
		'error_messages' => array(
							'input_error_no_input' => '생성할 페이지를 입력하세요.',
							'input_error_character_error' => '알파벳,숫자,_만 입력할 수 있습니다.',
							'input_error_is_exist' => '페이지가 벌써 만들어져 있습니다.',
							'input_error_too_long' => '너무 길어요..-,.-',
							),
		'comment_title'	=> '사용예',
		'comment'	=> 
		'사용하시는 AokioAnalyzer가 http://www.yourdomain.com/aanalyzer/ 에 설치되어있고,
		접속정보를 얻으려는 페이지가 http://www.yourdomain.com/index.html  인 경우 위의 코드를 복사하여 
		index.html 파일의 맨위부분에 붙여넣기를 하시기 바랍니다.<br/><br/>
		주위하실 사항이 위 코드에서 여러분이 AokioAnalyzer 를 설치한 디렉토리에 맞추어 /aanalyzer/ 부분을 수정할것과 
		접속정보를 얻으려는 페이지에 맞추어 상대패스를 수정해주는것입니다.',
		);

$words = array(
'',
);
?>
