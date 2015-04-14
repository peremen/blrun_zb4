<?php
// 메뉴 관계..
define ('ANALYSIS_VIEW_FILE_NAME','view.php');
$menu_template_param = array(

	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>1,
			'image_name'	=>'os',
			'menu_comment'	=> 'OS'
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>2,
			'image_name'	=>'browser',
			'menu_comment'	=> 'Browser'
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>3,
			'image_name'	=>'annually',
			'menu_comment'	=> 'Annually'
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>4,
			'image_name'	=>'monthly',
			'menu_comment'	=> 'Monthly'
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>5,
			'image_name'	=>'weekly',
			'menu_comment'	=> 'Weekly'
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>6,
			'image_name'	=>'daily',
			'menu_comment'	=> 'Daily'
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>7,
			'image_name'	=>'hourly',
			'menu_comment'	=> 'Hourly'
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>8,
			'image_name'	=>'language',
			'menu_comment'	=> 'Language Information'
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>9,
			'image_name'	=>'national',
			'menu_comment'	=> 'Nation Information'
			),
//	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
//			'mode'			=>10,
//			'image_name'	=>'os',
//			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>11,
			'image_name'	=>'referer',
			'menu_comment'	=> 'Referer'
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>12,
			'image_name'	=>'refererserver',
			'menu_comment'	=> 'Referer Server'
			),

	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>13,
			'image_name'	=>'screensize',
			'menu_comment'	=> 'Screen Size '
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>14,
			'image_name'	=>'resolution',
			'menu_comment'	=> 'Resolution '
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>15,
			'image_name'	=>'searchkeyword',
			'menu_comment'	=> 'searchkeyword '
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>16,
			'image_name'	=>'searchsite',
			'menu_comment'	=> 'searchsite '
			),

	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>17,
			'image_name'	=>'searchrobot',
			'menu_comment'	=> 'Search Robot'
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>18,
			'image_name'	=>'searchrobotdetail',
			'menu_comment'	=> 'Search Robot Detailed Information'
			),
	array(	'file_name'		=>ANALYSIS_VIEW_FILE_NAME,
			'mode'			=>19,
			'image_name'	=>'detail',
			'menu_comment'	=> 'Access Detailed Information'
			)
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
?>
