<?
/******************************************************************************
 * Zeroboard library
 *
 * 마지막 수정일자 : 2006. 3. 15
 * 이 파일내의 모든 함수는 원하시는대로 사용하셔도 됩니다.
 *
 * by zero (zero@nzeo.com)
 *
 ******************************************************************************/
// 한글 인코딩 및 W3C P3P 규약설정
@header("Content-Type: text/html; charset=euc-kr");
@header("P3P : CP=\"ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC\"");

// 현재 버젼
$zb_version = "4.1 pl8";

/*******************************************************************************
 * 에러 리포팅 설정과 register_globals_off일때 변수 재 정의
 ******************************************************************************/
@error_reporting(E_ALL ^ E_NOTICE);
foreach($_GET as $key=>$val) $$key = del_html($val);
@extract($_POST);
@extract($_SERVER);
@extract($_ENV);

$page = (int)$page;

$temp_filename=realpath(__FILE__);
if($temp_filename) $config_dir=preg_replace("#lib_ajax.php#i","",$temp_filename);
else $config_dir="";

/*******************************************************************************
 * 기본 변수 초기화. (php의 오류같지 않은 오류 때문에;; ㅡㅡ+)
 ******************************************************************************/
unset($member);
unset($group);
unset($setup);
unset($s_que);
$safe_sa=array('headnum','subject','name','hit','vote','reg_date','download1','download2');
if(!in_array($select_arrange,$safe_sa)) unset($select_arrange);
if(!in_array($desc,array('desc','asc'))) unset($desc);

/*******************************************************************************
 * include 되었는지를 검사
 ******************************************************************************/
if(defined("_zb_lib_included")) return;
define("_zb_lib_included",true);

$_startTime=getmicrotime();

/*******************************************************************************
 * 기본 설정 파일을 읽음
 ******************************************************************************/
include_once "include/get_url.php";
$_zbDefaultSetup = getDefaultSetup();
$_zb_url = zbUrl();
$_zb_path = $config_dir;
$ssl_url = sslUrl();

// 관리자 테이블과 회원관리 테이블의 이름을 미리 변수로 정의
$member_table = "zetyx_member_table";  // 회원들의 데이타가 들어 있는 직접적인 테이블
$group_table = "zetyx_group_table";   // 그룹테이블
$admin_table="zetyx_admin_table";     // 게시판의 관리자 테이블
$board_imsi_table="zetyx_board_imsi"; // 게시판 임시저장 테이블
$comment_imsi_table="zetyx_board_comment_imsi"; // 코멘트 임시저장 테이블

$send_memo_table ="zetyx_send_memo";
$get_memo_table ="zetyx_get_memo";

$t_division="zetyx_division"; // Division 테이블
$t_board = "zetyx_board"; // 메인 테이블
$t_comment ="zetyx_board_comment"; // 코멘트테이블
$t_category ="zetyx_board_category"; // 카테고리 테이블

/*******************************************************************************
 * install 페이지가 아닌 경우
 ******************************************************************************/
if(!preg_match("/install/i",$PHP_SELF)&&file_exists($_zb_path."myZrCnf2019.php")) {

	// 세션 디렉토리가 존재하지 않으면 생성 후 777권한 부여
	if(!is_dir($_zb_path.$_zbDefaultSetup[session_path])) {
		mkdir($_zb_path.$_zbDefaultSetup[session_path], 0777, true);
		chmod($_zb_path.$_zbDefaultSetup[session_path], 0777);
	}

	// Data, Icon, 세션디렉토리의 쓰기 권한이 없다면 에러 처리
	if(!is_writable($_zb_path."data")) error("Data 디렉토리의 쓰기 권한이 없습니다<br>제로보드를 사용하기 위해서는 Data 디렉토리의 쓰기 권한이 있어야 합니다");
	if(!is_writable($_zb_path."icon")) error("icon 디렉토리의 쓰기 권한이 없습니다<br>제로보드를 사용하기 위해서는 icon 디렉토리의 쓰기 권한이 있어야 합니다");
	if(!is_writable($_zb_path.$_zbDefaultSetup[session_path])) error("세션 디렉토리(".$_zb_path.$_zbDefaultSetup[session_path].")의 쓰기 권한이 없습니다<br>제로보드를 사용하기 위해서는 세션디렉토리의 쓰기 권한이 있어야 합니다");

	$_sessionStart = getmicrotime();
	//@session_save_path($_zb_path.$_zbDefaultSetup[session_path]);
	@session_cache_limiter('nocache, must_revalidate');

	session_set_cookie_params(0,"/");

	// 세션 변수의 등록
	@session_start();

	// 조회수 가 512byte를, 투표 세션변수가 256byte를 넘을시 리셋 (개인서버를 이용시에는 조금 더 늘려도 됨)
	if(strlen($_SESSION['zb_hit'])>$_zbDefaultSetup[session_view_size]) {
		$_SESSION['zb_hit']='';
	}
	if(strlen($_SESSION['zb_vote'])>$_zbDefaultSetup[session_vote_size]) {
		$_SESSION['zb_vote']='';
	}

	// 자동 로그인일때 제대로 된 자동 로그인인지 체크하는 부분
	unset($autoLoginData);
	$autoLoginData = getZBSessionID();
	if($autoLoginData[no]) {
		// DB 연결
		if(!$connect) $connect=dbConn();
		// 멤버 정보 구해오기
		$_dbTimeStart = getmicrotime();
		$m=mysql_fetch_array(mysql_query("select email from $member_table where no ='".$autoLoginData[no]."'"));
		$_dbTime += getmicrotime()-$_dbTimeStart;
		// email IP 표식 불러와 처리
		if(preg_match("#\|\|\|([0-9.]{1,})$#",$m[email],$c_match)) {
			$tokenID = $c_match[1]; // lib_ajax.php 에선 사용되지 않음.
		}
		// 자동로그인 세션 처리
		$_SESSION['zb_logged_no']=$autoLoginData[no];
		$_SESSION['zb_logged_ip']=$REMOTE_ADDR;
		$_SESSION['zb_logged_time']=time();
		$_SESSION['_token']=$_COOKIE['token'];
	// 세션 값을 체크하여 로그인을 처리
	} elseif($_SESSION['zb_logged_no']) {
		// DB 연결
		if(!$connect) $connect=dbConn();
		// 멤버 정보 구해오기
		$_dbTimeStart = getmicrotime();
		$m=mysql_fetch_array(mysql_query("select email from $member_table where no ='".$_SESSION['zb_logged_no']."'"));
		$_dbTime += getmicrotime()-$_dbTimeStart;
		// email IP 표식 불러와 처리
		if(preg_match("#\|\|\|([0-9.]{1,})$#",$m[email],$c_match)) {
			$tokenID = $c_match[1]; // lib_ajax.php 에선 사용되지 않음.
		}
		// 자동로그인이 아닐 때 세션 처리
		// 유효할 경우 로그인 시간을 다시 설정
		$_SESSION['zb_logged_time']=time();
	}
	$_sessionEnd = getmicrotime();

	// 현재 접속자의 데이타를 체크하여 파일로 저장 (회원, 비회원으로 구분해서 저장)
	$_nowConnectStart = getmicrotime();
	if($_zbDefaultSetup[nowconnect_enable]=="true") {
		$_zb_now_check_intervalTime = time()-$_SESSION['zb_last_connect_check'];

		if(!$_SESSION['zb_last_connect_check']||$_zb_now_check_intervalTime>$_zbDefaultSetup[nowconnect_refresh_time]) {

			// 5.3 이상용 세션 처리
			$_SESSION['zb_last_connect_check'] = time();

			if($_SESSION['zb_logged_no']) {
				$total_member_connect = $total_connect = getNowConnector($_zb_path."data/now_member_connect.php",$_SESSION['zb_logged_no']);
				$total_guest_connect = getNowConnector_num($_zb_path."data/now_connect.php", TRUE);
			} else {
				$total_member_connect = $total_connect = getNowConnector_num($_zb_path."data/now_member_connect.php", TRUE);
				$total_guest_connect = getNowConnector($_zb_path."data/now_connect.php",$_SERVER['REMOTE_ADDR']);
			}
		} else {
			$total_member_connect = $total_connect = getNowConnector_num($_zb_path."data/now_member_connect.php",FALSE);
			$total_guest_connect = getNowConnector_num($_zb_path."data/now_connect.php",FALSE);
		}

	}

}

$_nowConnectEnd = getmicrotime();

// myZrCnf2019.php 파일의 위치를 구함;;
$temp_filename=realpath(__FILE__);
if($temp_filename) $config_dir=preg_replace("#lib_ajax.php#i","",$temp_filename);
else $config_dir="";


// 모바일일 때와 PC일 때 처리
$browser=$HTTP_USER_AGENT; //echo $browser;
if(preg_match("/(iPhone|iPod|IEMobile|Mobile|lgtelecom|PPC)/i",$browser)) $browser="0"; else $browser="1";
//echo $browser;

// DB가 설정이 되었는지를 검사
if(!file_exists($config_dir."myZrCnf2019.php")&&!preg_match("/install/i",$PHP_SELF)) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=install.php\">";
	exit;
}

// 마이크로 타임 구함
function getmicrotime() {
	$microtimestmp = preg_split("/ /",microtime());
	return $microtimestmp[0]+$microtimestmp[1];
}

// 마이크로세컨드타임스탬프 구함
function getMicrosecond()
{
	$microtimestmp = preg_split("/ /",microtime());
	return $microtimestmp[1].substr($microtimestmp[0], 2, 6);
}

/******************************************************************************
* Division 관련 함수
*****************************************************************************/
// 전체 division 구함
function total_division() {
	global $connect, $t_division, $id;
	$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id"));
	return $temp[0];
}

// 답글일때 해당 division의 num 값 증가
function plus_division($division) {
	global $connect, $t_division, $id;
	mysql_query("update $t_division"."_$id set num=num+1 where division='$division'") or error(mysql_error());
}

// 삭제하거나 공지글을 일반글로 옮기는 등의 division num값 변화시 해당 division의 num값 감소시킴
function minus_division($division) {
	global $connect, $t_division, $id;
	mysql_query("update $t_division"."_$id set num=num-1 where division='$division'") or error(mysql_error());
}

// 신규글쓰기일때 최근 division의 num 값 증가
function add_division($board_name="") {
	global $connect, $t_division, $id, $t_board;
	if($board_name) $board_id=$board_name;
	else $board_id=$id;
	$temp=mysql_fetch_array(mysql_query("select num from $t_division"."_$board_id order by division desc limit 1"));

	// 현재 division의 num값이 기준값일때는 division +1 해줌;
	if($temp[0]>=5000) {
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_id"));
		$max_division=$temp[0]+1;
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_id where num>0 and division!='$max_division'"));
		if(!$temp[0]) $second_division=0; else $second_division=$temp[0];
		$temp=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$board_id where (division='$max_division' or division='$second_division') and headnum<=-2000000000"));
		if($temp[0]>0) {
			mysql_query("update $t_board"."_$board_id set division='$max_division' where (division='$max_division' or division='$second_division') and  headnum<='-2000000000'") or error(mysql_error());
			mysql_query("update $t_division"."_$board_id set num=num-$temp[0] where division=$max_division-1") or error(mysql_error());
		}
		$num=$temp[0]+1;
		mysql_query("insert into $t_division"."_$board_id (division,num) values ('$max_division','$num')");
		return $max_division;
	} else {
	// 현재 division이 기준값개보다 작을때~
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_id"));
		$division=$temp[0];
		mysql_query("update $t_division"."_$board_id set num=num+1 where division='$division'");
		return $division;
	}
}

/******************************************************************************
* 로그인이 되어 있는지를 검사하여 로그인되어있으면 해당 회원의 정보를 저장
*****************************************************************************/
function member_info() {

	global $member_table, $member, $connect;

	if(defined("_member_info_included")&&$member[no]) return $member;
	define("_member_info_included", true);

	if($member[no]) return $member;

	if($_SESSION['zb_logged_no']) {
		$member=mysql_fetch_array(mysql_query("select * from $member_table where no ='".$_SESSION['zb_logged_no']."'"));
		if(!$member[no]) {
			unset($member);
			$member[level] = 10;
		}
	} else $member[level] = 10;

	return $member;
}

function group_info($no) {
	global $group_table;
	$temp=mysql_fetch_array(mysql_query("select * from $group_table where no='$no'"));
	return $temp;
}

/******************************************************************************
* 제로보드 전용 함수
*****************************************************************************/
// MySQL 데이타 베이스에 접근
function dbconn() {

	global $connect, $config_dir, $autologin, $_COOKIE, $_dbconn_is_included;

	if($_dbconn_is_included) return;
	$_dbconn_is_included = true;

	$f=@file($config_dir."myZrCnf2019.php") or Error("myZrCnf2019.php파일이 없습니다.<br>DB설정을 먼저 하십시요","install.php");

	for($i=1;$i<=4;$i++) $f[$i]=trim(str_replace("\n","",$f[$i]));

	if(!$connect){
		$connect = @mysql_connect($f[1],$f[2],$f[3]);
		@mysql_query("set names euckr",$connect);
	}
	if(!$connect) Error("DB 접속시 에러가 발생했습니다!");

	@mysql_select_db($f[4], $connect) or Error("DB Select 에러가 발생했습니다","");

	return $connect;
}

// 글의 아이콘을 뽑아줌;;
function get_icon($data) {
	global $dir;

	// 글쓴 시간 구함
	$check_time=(time()-$data[reg_date])/60/60;

	// 앞에 붙는 아이콘 정의
	if($data[depth]) {
		if($check_time<=48) $icon="<img src=$dir/reply_new_head.gif border=0 align=absmiddle>&nbsp;"; // 최근 글일경우
		else $icon="<img src=$dir/reply_head.gif border=0 align=absmiddle>&nbsp;"; // 답글일때
	} else {
		if($check_time<=48) $icon="<img src=$dir/new_head.gif border=0 align=absmiddle>&nbsp;"; // 최근 글일경우
		else $icon="<img src=$dir/old_head.gif border=0 align=absmiddle>&nbsp;";          // 답글이 아닐때
	}
	if($data[headnum]<=-2000000000) $icon="<img src=$dir/notice_head.gif border=0 align=absmiddle>&nbsp;"; // 공지사항일때
	else if($data[is_secret]==1) $icon="<img src=$dir/secret_head.gif border=0 align=absmiddle alt='비밀글입니다'>&nbsp;";
	return $icon;
}

// 회원 개인에게 주어지는 아이콘을 찾는 함수
// $type : 1 -> 이름앞에 나타나는 아이콘
// $type : 2 -> 이름을 대신하는 아이콘
function get_private_icon($no, $type) {
	if($type==1) $dir = "icon/private_icon/";
	elseif($type==2) $dir = "icon/private_name/";

	if(@file_exists($dir.$no.".gif")) return $dir.$no.".gif";
}

// 이름 앞에 붙는 얼굴 아이콘
function get_face($data, $check=0) {
	global $group;

	// 이름앞에 붙는 아이콘 정의;;
	if($group[use_icon]==0) {
		if($data[ismember]) {
			if($data[islevel]==2) $face_image="<img src=images/admin2_face.gif border=0 align=absmiddle>";
			elseif($data[islevel]==1) $face_image="<img src=images/admin1_face.gif border=0 align=absmiddle>";
			else {
				if($group[icon]) $face_image="<img src=icon/$group[icon] border=0 align=absmiddle>";
				else $face_image="<img src=images/member_face.gif border=0 align=absmiddle>";
			}
		}
		else $face_image="<img src=images/blank_face.gif border=0 align=absmiddle> ";
	}

	$temp_name = get_private_icon($data[ismember], "1");
	if($temp_name) $face_image="<img src='$temp_name' border=0 align=absmiddle>";

	if($group[use_icon]<2&&$data[ismember]) $face_image .= "<b>";

	return $face_image;
}

// 게시판 관리자인지 체크하는 부분
function check_board_master($member, $board_num) {
	$temp = preg_split("/,/",$member[board_name]);
	for($i=0;$i<count($temp);$i++) {
		$t = trim($temp[$i]);
		if($t&&$t==$board_num) return 1;
	}
	return 0;
}

//  초기 헤더를 뿌려주는 부분;;;;
function head($body="",$scriptfile="") {

	global $group, $setup, $dir, $member, $PHP_SELF, $id, $_head_executived, $_COOKIE, $width, $_view_included, $_zbDefaultSetup, $is_admin;

	if($_head_executived) return;
	$_head_executived = true;

	$f = @fopen("license.txt","r");
	$license = @fread($f,filesize("license.txt"));
	@fclose($f);

	print "<!--\n".$license."\n-->\n";

	if(!preg_match("/member_/i",$PHP_SELF)) $stylefile="skin/$setup[skinname]/style.css"; else $stylefile="style.css";

	if($setup[use_formmail]) {
		$f = fopen("script/script_zbLayer.php","r");
		$zbLayerScript = fread($f, filesize("script/script_zbLayer.php"));
		fclose($f);
	}

	// html 시작부분 출력
	if($setup[skinname]) {
	?>
<html>
<head>
<title><?=$setup[title]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="image_src" href="../blrun2_fb.jpg">
<link rel="alternate" type="application/rss+xml" title="<?=$_zbDefaultSetup[sitename]?>" href="<?=str_replace("www.","",substr(zbUrl(),0,strpos(zbUrl(),"/bbs/")))."/rss/"?>">
<link rel=StyleSheet HREF=<?=$stylefile?> type=text/css title=style>

<!-- SyntaxHighlighter 관련 헤더 -->
<link rel="stylesheet" type="text/css" href="syntaxhighlighter/styles/shThemeDefault.css" />
<link rel="stylesheet" type="text/css" href="syntaxhighlighter/styles/shCore.css" />
<script type="text/javascript" src="syntaxhighlighter/scripts/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/shAutoloader.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/jQuery.js"></script>
<!-- SyntaxHighlighter 관련 헤더 끝 -->

<!-- 추가 스크립트 로딩 -->
<script language='JavaScript'>
// 카테고리 변경 리로딩 관련 펑션
function category_change(obj) {
	var myindex=obj.selectedIndex;
	document.search.category.value=obj.options[myindex].value;
	document.search.submit();
	return true;
}
// 전역 이미지 박스 핸들러 변수 선언
var imageBoxHandler;
</script>
<!-- 추가 스크립트 로딩 끝 -->
<? if($setup[use_formmail]) echo $zbLayerScript; ?>
<? if($scriptfile) include "script/".$scriptfile; ?>

</head>
<body topmargin='4' leftmargin='0' marginwidth='0' marginheight='0' <?=$body?><? if($setup[bg_color]) echo " bgcolor=".$setup[bg_color]." "; if($setup[bg_image]) echo " background=".$setup[bg_image]." "; ?>>
<?
		if($group[header_url]) { @include $group[header_url]; }
		if($setup[header_url]) { @include $setup[header_url]; }
		if($group[header]) echo stripslashes($group[header]);
		if($setup[header]) echo stripslashes($setup[header]);
?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> height=1 style="table-layout:fixed;"><col width=100%></col><tr><td><img src=images/t.gif border=0 width=98% height=1 name=zb_get_table_width><br><img src=images/t.gif border=0 name=zb_target_resize width=1 height=1></td></tr></table>
<form name=check_attack><input type=hidden id=check name=check value=0></form>
<div id='zb_waiting' style='position:absolute; top:50%; left:50%; width:292px; height:91px; overflow:hidden; margin-top:-45px; margin-left:-146px; z-index:1; visibility: hidden'>
<table border=0 width=98% cellspacing=1 cellpadding=0 bgcolor=black>
<form name=waiting_form>
<tr bgcolor=white>
	<td>
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
		<tr>
			<td><img src=images/waiting_left.gif border=0></td>
			<td><img src=images/waiting_top.gif border=0><br><img src=images/waiting_text.gif></td>
		</tr>
		</table>
	</td>
</tr>
</form>
</table>
</div>
<?
	} else {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="image_src" href="../blrun2_fb.jpg">
<link rel="alternate" type="application/rss+xml" title="<?=$_zbDefaultSetup[sitename]?>" href="<?=str_replace("www.","",substr(zbUrl(),0,strpos(zbUrl(),"/bbs/")))."/rss/"?>">
<link rel=StyleSheet HREF=style.css type=text/css title=style>
<? if($scriptfile) include "script/".$scriptfile; ?>

</head>
<body topmargin='0' leftmargin='0' marginwidth='0' marginheight='0' <?=$body?>>
<?
		if($group[header_url]) { @include $group[header_url]; }
		if($group[header]) echo stripslashes($group[header]);
	}

}

// 푸터 부분 출력
function foot($max_depth="",$all_depth="") {

	global $width, $group, $setup, $_startTime , $_queryTime , $_foot_executived, $_skinTime, $_sessionStart, $_sessionEnd, $_nowConnectStart, $_nowConnectEnd, $_dbTime, $_listCheckTime, $_zbResizeCheck, $max_depth, $all_depth;

	if(!$all_depth) $all_depth=$max_depth;

	if($_foot_executived) return;
	$_foot_executived = true;

	$maker_file=@file("skin/$setup[skinname]/maker.txt");
	if($maker_file[0]) $maker="/ skin by $maker_file[0]";
	else $maker = "";

	if($setup[skinname]) {
	?>

<table border=0 cellpadding=0 cellspacing=0 height=20 width=<?=$width?>>
<tr>
	<td align=right style=font-family:tahoma,굴림;font-size:8pt;line-height:150%;letter-spacing:0px>
		<font style=font-size:7pt>Copyright 1999-<?=date("Y")?></font> <font style=font-family:tahoma,굴림;font-size:8pt;><a href=http://www.xpressengine.com/zb4_main target=_blank onfocus=blur()>Zeroboard</a> <?=$maker?></font>
	</td>
</tr>
</table>

<?
		if($_zbResizeCheck) {
?>

<!-- 이미지 리사이즈를 위해서 처리하는 부분 -->
<script>
// onload 추가 실행 관련 펑션
function addLoadEvent(func){
	var oldonload = window.onload;
	if(typeof window.onload != 'function'){
		window.onload = func;
	}else{
		window.onload = function(){
			oldonload();
			func();
		};
	}
}
function zb_img_check(){
	var zb_main_table_width = document.zb_get_table_width.width*(100-5*<?=$all_depth?>-4)/100;
	var zb_target_resize_num = document.zb_target_resize.length;
	for(i=0;i<zb_target_resize_num;i++){
		if(document.zb_target_resize[i].width > zb_main_table_width) {
			document.zb_target_resize[i].height = document.zb_target_resize[i].height * zb_main_table_width / document.zb_target_resize[i].width;
			document.zb_target_resize[i].width = zb_main_table_width;
		}
	}
}
addLoadEvent(zb_img_check);
</script>
<!-- 이미지 리사이즈를 위해서 처리하는 부분 끝 -->

<?
		}

		if($setup[footer]) echo stripslashes($setup[footer]);
		if($group[footer]) echo stripslashes($group[footer]);
		if($setup[footer_url]) { @include $setup[footer_url]; }
		if($group[footer_url]) { @include $group[footer_url]; }
?>

<!-- 접속통계 관련 헤더 -->
<?
$_dbTimeStart = getmicrotime();
$re=mysql_fetch_array(mysql_query("SELECT target from `aokio_log_config` order by no desc limit 1"));
$_dbTime += getmicrotime()-$_dbTimeStart;
$target=$re[0];
@include "aanalyzer/aokio_analyzer.php";
?>
<script src="aanalyzer/screen.js" type="text/javascript"></script>

</body>
</html>
<?

	} else {

		if($group[footer]) echo stripslashes($group[footer]);
		if($group[footer_url]) { @include $group[footer_url]; }

?>

</body>
</html>
	<?
	}

	$_phpExcutedTime = (getmicrotime()-$_startTime)-($_sessionEnd-$_sessionStart)-($_nowConnectEnd-$_nowConnectStart)-$_dbTime-$_skinTime;
	// 실행시간 출력
	echo "\n\n<!--";
	if($_sessionStart&&$_sessionEnd)  		echo "\n Session Excuted  : ".sprintf("%0.4f",$_sessionEnd-$_sessionStart);
	if($_nowConnectStart&&$_nowConnectEnd) 	echo "\n Connect Checked  : ".sprintf("%0.4f",$_nowConnectEnd-$_nowConnectStart);
	if($_dbTime)  							echo "\n Query Excuted  : ".sprintf("%0.3f",$_dbTime);
	if($_phpExcutedTime)  					echo "\n PHP Excuted  : ".sprintf("%0.3f",$_phpExcutedTime);
	if($_listCheckTime) 					echo "\n Check Lists : ".sprintf("%0.3f",$_listCheckTime);
	if($_skinTime) 							echo "\n Skins Excuted  : ".sprintf("%0.3f",$_skinTime);
	if($_startTime) 						echo "\n Total Excuted Time : ".sprintf("%0.3f",getmicrotime()-$_startTime);
	echo "\n-->\n";
}

// zbLayer 출력
function check_zbLayer($data) {
	global $zbLayer, $setup, $member, $is_admin, $id, $_zbCheckNum;
	if($setup[use_formmail]) {
		if(!$_zbCheckNum) $_zbCheckNum=0;
		//$data[name]=stripslashes($data[name]);
		$data[name]=urlencode($data[name]);

		if($data[homepage]){
			$data[homepage]=str_replace("http://","",$data[homepage]);
			$data[homepage]="http://".str_replace("%2F", "/", urlencode($data[homepage]));
		}

		$data[email]=base64_encode($data[email]);

		$_zbCheckNum++;
		$_zbCount=1;

		if(($member[is_admin]==1||$member[is_admin]==2)&&$data[ismember]) {
			$traceID = $data[ismember];
			$traceType="t";
			$isAdmin=1;
		} elseif(($member[is_admin]==1||$member[is_admin]==2)&&!$data[ismember]) {
			$traceID = $data[name];
			$traceType="tn";
			$isAdmin=1;
		}

		if($member[no]) $isMember = 1;

		if($data[ismember]<1) $data[ismember]="";

		$zbLayer = $zbLayer."\nprint_ZBlayer('zbLayer$_zbCheckNum', '".$data[homepage]."', '$data[email]', '$data[ismember]', '$id', '$data[name]', '$traceID', '$traceType', '$isAdmin', '$isMember');";
	}
	return $_zbCount;
}

// 에러 메세지 출력
function error($message, $url="") {
	global $setup, $connect, $dir, $config_dir;

	$dir="skin/".$setup[skinname];

	if($url=="window.close") {
		$message=str_replace("<br>","\\n",$message);
		$message=str_replace("\"","\\\"",$message);
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script>
alert("<?=$message?>");
window.close();
</script>
<?
	} else {

		head();

		if($setup[skinname]) {
			include "skin/$setup[skinname]/error.php";
		} else {
			include $config_dir."error.php";
		}

		foot();

	}

	exit;
}

// 게시판 설정을 읽어옴
function get_table_attrib($id) {

	global $connect, $admin_table;
	if(!is_string($id)) return false;
	$id=mysql_real_escape_string($id);
	$data=mysql_fetch_assoc(mysql_query("select * from $admin_table where `name`='$id' limit 1;",$connect));

	if($data[table_width]<=100) $data[table_width]=$data[table_width]."%";

	// 원래는 IP를 보여주는 기능인데, DB 변경을 피하기 위해서 이미지 박스 사용 권한으로 변경하여 사용
	if(!$data[use_showip]) $data[use_showip] = 0;
	$data[grant_imagebox] = $data[use_showip];

	return $data;
}

// 게시판의 생성유무 검사
function istable($str, $dbname='') {
	global $config_dir;
	if(!$dbname) {
		$f=@file($config_dir."myZrCnf2019.php") or Error("myZrCnf2019.php파일이 없습니다.<br>DB설정을 먼저 하십시요","install.php");
		for($i=1;$i<=4;$i++) $f[$i]=str_replace("\n","",$f[$i]);
		$dbname=$f[4];
	}

	$result = mysql_query("show tables from $dbname") or error(mysql_error(),"");

	$i=0;

	while ($i < mysql_num_rows($result)) {
		if($str==mysql_tablename ($result, $i)) return 1;
		$i++;
	}
	return 0;
}

// 현재 아이피와 주어진 아이피 리스트를 비교하여 아이피 블럭 대상자인지 검사
function check_blockip() {
	global $setup;
	$avoid_ip=explode(",",$setup[avoid_ip]);
	$count = count($avoid_ip);
	for($i=0;$i<$count;$i++) {
		$avoid_ip[$i]=trim($avoid_ip[$i]);
		if(!isblank($avoid_ip[$i])&&preg_match("#".$avoid_ip[$i]."#i",$_SERVER['REMOTE_ADDR'])) Error("차단당한 IP 주소입니다.");
	}
}

// 접속자수 체크
function getNowConnector($filename,$div) {
	global $_zbDefaultSetup;
	$_str = trim(zReadFile($filename));
	$num = 0;
	if($_str) {
		$_str = str_replace("<?php die('Access Denied');/*","",$_str);
		$_str = str_replace("*/?>","",$_str);
		$_connector = explode(":",$_str);
		$_sizeConnector = count($_connector);
		$_nowtime = date("YmdHi");
		unset($_realNowConnector);
		if($_sizeConnector) {
			for($i=0;$i<$_sizeConnector;$i++) {
				$_time = substr($_connector[$i],0,12);
				$_div = substr($_connector[$i],12);
				if($_time+$_zbDefaultSetup[nowconnect_time]>=$_nowtime&&$_div!=$div) {
					$_realNowConnector.=$_time.$_div.":";
					$num++;
				}
			}
		}
	}
	$_realNowConnector.=$_nowtime.$div;
	zWriteFile($filename, "<?php die('Access Denied');/*".$_realNowConnector."*/?>");
	return $num;
}

// 접속자수 구하기
function getNowConnector_num($filename, $FLAG=FALSE) {
	global $_zbDefaultSetup;
	$_str = trim(zReadFile($filename));
	$num = 0;
	if($_str) {
		$_str = str_replace("<?php die('Access Denied');/*","",$_str);
		$_str = str_replace("*/?>","",$_str);
		$_connector = explode(":",$_str);
		$_sizeConnector = count($_connector);
		$_nowtime = date("YmdHi");
		unset($_realNowConnector);
		if($_sizeConnector) {
			for($i=0;$i<$_sizeConnector;$i++) {
				$_time = substr($_connector[$i],0,12);
				$_div = substr($_connector[$i],12);
				if($_time+$_zbDefaultSetup[nowconnect_time]>=$_nowtime) {
					$_realNowConnector.=$_time.$_div.":";
					$num++;
				}
			}
		}
	}
	if($FLAG) {
		zWriteFile($filename, "<?php die('Access Denied');/*".$_realNowConnector."*/?>");
	}
	return $num;
}

// 제로보드 자동 로그인 세션값이 있는지 판단해서 있으면 해당 값을 리턴
function getZBSessionID() {
	global $_zb_path, $_zbDefaultSetup;

	$zbSessionID = $_COOKIE['ZBSESSIONID'];

	if(!$_zb_path || !$_zbDefaultSetup || !$zbSessionID || !preg_match('/^[0-9a-f]+$/', $zbSessionID)) {
		return array();
	}
	$str = zReadFile($_zb_path.$_zbDefaultSetup['session_path'].'/zbSessionID_'.$zbSessionID.'.php');

	if(!$str) {
		@setcookie('ZBSESSIONID', '', time()+60*60*24*365, '/');
		@setcookie('ZB_AUTOLOGIN_TOKEN', '', time()+60*60*24*365, '/');
		return array();
	}

	$str = explode("\n",$str);

	$data = array();
	$data['no'] = trim($str[1]);
	$data['token'] = trim($str[2]);

	if(!$_COOKIE['ZB_AUTOLOGIN_TOKEN'] || $_COOKIE['ZB_AUTOLOGIN_TOKEN'] != $data['token']) {
		@setcookie('ZBSESSIONID', '', time()+60*60*24*365, '/');
		@setcookie('ZB_AUTOLOGIN_TOKEN', '', time()+60*60*24*365, '/');
		return array();
	}

	destroyZBSessionID($data['no'], $zbSessionID, false);
	makeZBSessionID($data['no']);

	return $data;
}

// 제로보드 자동 로그인 세션값을 만드는 함수
function makeZBSessionID($no) {
	global $_zb_path, $_zbDefaultSetup;

	$zbSessionID = hash('sha512', (string)microtime(true));
	$token = uniqid('', true);

	$newStr = "<?php /*\n$no\n$token\n*/ ?>";

	zWriteFile($_zb_path.$_zbDefaultSetup['session_path'].'/zbSessionID_'.$zbSessionID.'.php', $newStr);

	@setcookie('ZBSESSIONID', $zbSessionID, time()+60*60*24*365, '/');
	@setcookie('ZB_AUTOLOGIN_TOKEN', $token, time()+60*60*24*365, '/');
}

// 제로보드 자동 로그인 세션값 파기시키는 함수
function destroyZBSessionID($no, $zbSessionID='', $reset_cookie=true) {
	global $_zb_path, $_zbDefaultSetup;
	if(!$zbSessionID) {
		$zbSessionID = $_COOKIE['ZBSESSIONID'];
	}
	if(preg_match('/^[0-9a-f]+$/', $zbSessionID)) {
		z_unlink($_zb_path.$_zbDefaultSetup['session_path'].'/zbSessionID_'.$zbSessionID.'.php');
	}
	if($reset_cookie) {
		@setcookie('ZBSESSIONID', '', time()+60*60*24*365, '/');
		@setcookie('ZB_AUTOLOGIN_TOKEN', '', time()+60*60*24*365, '/');
	}
}

// 제로보드의 기본 설정 파일을 읽어오는 함수
function getDefaultSetup() {
	global $_zb_path;
	$data = zReadFile($_zb_path."setup.php");
	$data = str_replace("<?php /*","",$data);
	$data = str_replace("*/ ?>","",$data);
	$data = explode("\n",$data);
	$_c = count($data);
	unset($defaultSetup);
	for($i=0;$i<$_c;$i++) {
		if(!preg_match("/;/",$data[$i])&&strlen(trim($data[$i]))) {
			$tmpStr = explode("=",$data[$i]);
			$name = trim($tmpStr[0]);
			$value = trim($tmpStr[1]);
			$defaultSetup[$name]=$value;
		}
	}
	if(!$defaultSetup[url]) $defaultSetup[url] = $HTTP_HOST;
	if(!$defaultSetup[sitename]) $defaultSetup[sitename] = $HTTP_HOST;
	if(!$defaultSetup[session_path]) $defaultSetup[session_path] = "data/__zbSessionTMP";
	if(!$defaultSetup[session_view_size]) $defaultSetup[session_view_size] = 512;
	if(!$defaultSetup[session_vote_size]) $defaultSetup[session_vote_size] = 256;
	if(!$defaultSetup[login_time]) $defaultSetup[login_time] = 60*30;
	if(!$defaultSetup[nowconnect_enable]) $defaultSetup[nowconnect_enable] = "true";
	if(!$defaultSetup[nowconnect_refresh_time]) $defaultSetup[nowconnect_refresh_time] = 60*3;
	if(!$defaultSetup[nowconnect_time]) $defaultSetup[nowconnect_time] = 60*5;
	if(!$defaultSetup[enable_hangul_id]) $defaultSetup[enable_hangul_id] = "false";
	if(!$defaultSetup[check_email]) $defaultSetup[check_email] = "true";
	if(!$defaultSetup[memo_limit_time]) $defaultSetup[memo_limit_time] = 7;
	$defaultSetup[memo_limit_time] = 60 * 60 * 24 * $defaultSetup[memo_limit_time];

	return $defaultSetup;
}

/******************************************************************************
 * 일반 함수
 *****************************************************************************/
// 빈문자열 경우 1을 리턴
function isblank($str) {
	$temp=str_replace("　","",$str);
	$temp=str_replace("\n","",$temp);
	$temp=strip_tags($temp);
	$temp=str_replace("&nbsp;","",$temp);
	$temp=str_replace(" ","",$temp);
	if(preg_match("/[^[:space:]&#xA0;&#160;&#x180E;&#6158;&#x2000;&#8192;&#x2001;&#8193;&#x2002;&#8194;	&ensp;&#x2003;&#8195;&emsp;&#x2004;&#8196;&#x2005;&#8197;&#x2006;&#8198;&#x2007;&#8199;&#x2008;&#8200;&#x2009;&#8201;&thinsp;&#x200A;&#8202;&#x200B;&#8203;&#x202F;&#8239;&#x205F;&#8287;&#x3000;&#12288;&#xFEFF;&#65279;&#x20;&#32;&#x9;&#9;&#xD;&#13;&nbsp&#8207;&rlm;]/i",$temp)) return 0;
	return 1;
}

// 스페이스일 경우 1을 리턴
function isspace($str) {
	$temp=str_replace("　","",$str);
	$temp=str_replace("\n","",$temp);
	$temp=strip_tags($temp);
	$temp=str_replace("&nbsp;","",$temp);
	$temp=str_replace(" ","",$temp);
	if(preg_match("/[^[:space:]]/i",$temp)) return 0;
	return 1;
}

// 숫자일 경우 1을 리턴
function isnum($str) {
	if(preg_match("/[^0-9]/i",$str)) return 0;
	return 1;
}

// 숫자, 영문자 일경우 1을 리턴
function isalNum($str) {
	if(preg_match("/[^0-9a-zA-Z\_]/i",$str)) return 0;
	return 1;
}

// HTML Tag를 제거하는 함수
function del_html( $str ) {
	$str = str_replace( ">", "&gt;",$str );
	$str = str_replace( "<", "&lt;",$str );
	return $str;
}

// 주민등록번호 검사
function check_jumin($jumin) {
	$weight = '234567892345'; // 자리수 weight 지정
	$len = strlen($jumin);
	$sum = 0;

	if ($len <> 13) return false;

	for ($i = 0; $i < 12; $i++) {
		$sum = $sum + (substr($jumin,$i,1)*substr($weight,$i,1));
	}

	$rst = $sum%11;
	$result = 11 - $rst;

	if ($result == 10) $result = 0;
	else if ($result == 11) $result = 1;

	$ju13 = substr($jumin,12,1);

	if ($result <> $ju13) return false;
	return true;
}

// E-mail 주소가 올바른지 검사
function ismail( $str ) {
	if( preg_match("/([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)/i", $str) ) return $str;
	else return '';
}

// E-mail 의 MX를 검색하여 실제 존재하는 메일인지 검사
function mail_mx_check($email) {
	if(!ismail($email)) return false;
	list($user, $host) = explode("@", $email);
	if (checkdnsrr($host, "MX") or checkdnsrr($host, "A")) return true;
	else return false;
}

// 홈페이지 주소가 올바른지 검사
function isHomepage( $str ) {
	if(preg_match("/^http://([a-z0-9\_\-\./~@?=&amp;-\#{5,}]+)/i", $str)) return $str;
	else return '';
}

// URL, Mail을 자동으로 체크하여 링크만듬
function autolink($str) {
	// URL 치환
	$str=str_replace("&nbsp;"," &nbsp;",$str);
	$homepage_pattern = "/([^\"\'\=\>\|])(mms|http|HTTP|https|HTTPS|ftp|FTP|telnet|TELNET)\:\/\/(.[^ \n\<\"\'\|]+)/";
	$str = preg_replace($homepage_pattern,"\\1<a href=\\2://\\3 target=_blank>\\2://\\3</a>", " ".$str);
	$str=str_replace(" &nbsp;","&nbsp;",$str);

	// 메일 치환
	$email_pattern = "/([; \n]+)([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)/";
	$str = preg_replace($email_pattern,"\\1<a href=mailto:\\2@\\3>\\2@\\3</a>", " ".$str);

	return $str;
}

// 파일 사이즈를 kb, mb에 맞추어서 변환해서 리턴
function getfilesize($size) {
	if(!$size) return "0 Byte";
	if($size<1024) {
		return ($size." Byte");
	} elseif($size >1024 && $size< 1024 *1024)  {
		return sprintf("%0.1f KB",$size / 1024);
	}
	else return sprintf("%0.2f MB",$size / (1024*1024));
}

// 문자열 끊기 (이상의 길이일때는 ... 로 표시)
function cut_str($msg,$cut_size) {
	if($cut_size<=0) return $msg;
	if(preg_match("/\[re\]/",$msg)) $cut_size=$cut_size+4;
	for($i=0;$i<$cut_size;$i++) if(ord($msg[$i])>127) $han++; else $eng++;
	$cut_size=$cut_size+(int)$han*0.6;
	$point=1;
	for ($i=0;$i<strlen($msg);$i++) {
		if ($point>$cut_size) return $pointtmp."...";
		if (ord($msg[$i])<=127) {
			$pointtmp.= $msg[$i];
			if ($point%$cut_size==0) return $pointtmp."...";
		} else {
			if ($point%$cut_size==0) return $pointtmp."...";
			$pointtmp.=$msg[$i].$msg[++$i];
			$point++;
		}
		$point++;
	}
	return $pointtmp;
}

// 페이지 이동 스크립트
function movepage($url) {
	global $connect;
	echo "<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
	exit;
}

// input 또는 textarea의 사이즈를 넷쓰와 익스일때 구분하여 리턴
function size($size) {
	global $browser;
	if(!$browser) return " size=".($size*0.6)." ";
	else return " size=$size ";
}

function size2($size) {
	global $browser;
	if(!$browser) return " cols=".($size*0.6)." ";
	else return " cols=$size ";
}

// 메일 보내는 함수
function zb_sendmail($type, $to, $to_name, $from, $from_name, $subject, $comment, $cc="", $bcc="") {
	// email IP 표식 불러와 처리
	if(preg_match("#\|\|\|([0-9.]{1,})$#",$to,$c_match))
		$to = str_replace($c_match[0],"",$to);
	$recipient = "$to_name <$to>";

	if($type==1) $comment = nl2br($comment);

	// email IP 표식 불러와 처리
	unset($c_match);
	if(preg_match("#\|\|\|([0-9.]{1,})$#",$from,$c_match))
		$from = str_replace($c_match[0],"",$from);
	$headers = "From: $from_name <$from>\n";
	$headers .= "X-Sender: <$from>\n";
	$headers .= "X-Mailer: PHP ".phpversion()."\n";
	$headers .= "X-Priority: 1\n";
	$headers .= "Return-Path: <$from>\n";

	if(!$type) $headers .= "Content-Type: text/plain; ";
	else $headers .= "Content-Type: text/html; ";
	$headers .= "charset=euc-kr\n";

	if($cc) {
		// email IP 표식 불러와 처리
		unset($c_match);
		if(preg_match("#\|\|\|([0-9.]{1,})$#",$cc,$c_match))
			$cc = str_replace($c_match[0],"",$cc);
		$headers .= "cc: $cc\n";
	}
	if($bcc) {
		// email IP 표식 불러와 처리
		unset($c_match);
		if(preg_match("#\|\|\|([0-9.]{1,})$#",$bcc,$c_match))
			$bcc = str_replace($c_match[0],"",$bcc);
		$headers .= "bcc: $bcc";
	}

	$comment = stripslashes($comment);
	$comment = str_replace("\n\r","\n", $comment);

	return mail($recipient , $subject , $comment , $headers);

}

// 지정된 디렉토리의 파일 정보를 구함
function get_dirinfo($path) {

	$handle=@opendir($path);
	while($info = readdir($handle)) {
		if($info != "." && $info != "..") {
			$dir[] = $info;
		}
	}
	closedir($handle);
	return $dir;
}

// 파일을 삭제하는 함수
function z_unlink($filename) {
	@chmod($filename,0777);
	$handle = @unlink($filename);
	if(@file_exists($filename)) {
		@chmod($filename,0775);
		$handle=@unlink($filename);
	}
	return $handle;
}

// 지정된 파일의 내용을 읽어옴
function zReadFile($filename) {
	if(!file_exists($filename)) return '';

	$f = fopen($filename,"r");
	$str = fread($f, filesize($filename));
	fclose($f);

	return $str;
}

// 지정된 파일에 주어진 데이타를 씀
function zWriteFile($filename, $str) {
	$f = fopen($filename,"w");
	$lock=flock($f,2);
	if($lock) {
		fwrite($f,$str);
	}
	flock($f,3);
	fclose($f);
}

// 지정된 파일이 Locking중인지 검사
function check_fileislocked($filename) {
	$f=@fopen($filename,w);
	$count = 0;
	$break = true;
	while(!@flock($f,2)) {
		$count++;
		if($count>10) {
			$break = false;
			break;
		}
	}
	if($break!=false) @flock($f,3);
	@fclose($f);
}

// 순환적으로 디렉토리를 삭제
function zRmDir($path) {
	$directory = dir($path);
	while($entry = $directory->read()) {
		if ($entry != "." && $entry != "..") {
			if (Is_Dir($path."/".$entry)) {
				zRmDir($path."/".$entry);
			} else {
				@UnLink ($path."/".$entry);
			}
		}
	}
	$directory->close();
	@RmDir($path);
}

/*********************************************************************************************
 * 모든 스킨의 이미지 박스 이미지 썸네일 생성
 ********************************************************************************************/

function thumbnail3($size,$source_file,$save_file){

	$img_info=@getimagesize($source_file);

	if($img_info[2]==1) $srcimg=@ImageCreateFromGIF($source_file);
	elseif($img_info[2]==2) $srcimg=@ImageCreateFromJPEG($source_file);
	else                     $srcimg=@ImageCreateFromPNG($source_file);

	if($img_info[0]>=$size){
		$max_width=$size;
		$max_height=ceil($img_info[1]*$size/$img_info[0]);
	}else{
		$max_width=$img_info[0];
		$max_height=$img_info[1];
	}

	if($img_info[2]==1){
		$dstimg=@ImageCreate($max_width,$max_height);
		@ImageColorAllocate($dstimg,255,255,255);
		@ImageCopyResized($dstimg, $srcimg,0,0,0,0,$max_width,$max_height,ImageSX($srcimg),ImageSY($srcimg));
	}else{
		$dstimg=@ImageCreateTrueColor($max_width,$max_height);
		@ImageColorAllocate($dstimg,255,255,255);
		@ImageCopyResampled($dstimg, $srcimg,0,0,0,0,$max_width,$max_height,ImageSX($srcimg),ImageSY($srcimg));
	}

	@ImageJPEG($dstimg,$save_file,85);

	@ImageDestroy($dstimg);
	@ImageDestroy($srcimg);
}
?>