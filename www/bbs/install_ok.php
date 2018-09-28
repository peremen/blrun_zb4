<?
// 한글 인코딩 및 W3C P3P 규약설정
@header("Content-Type: text/html; charset=utf-8");
@header("P3P : CP=\"ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC\"");

/*******************************************************************************
 * 에러 리포팅 설정과 register_globals_on일때 변수 재 정의
 ******************************************************************************/
@error_reporting(E_ALL ^ E_NOTICE);
foreach($_GET as $key=>$val) $$key = del_html($val);
@extract($_POST);
@extract($_SERVER);
@extract($_ENV);

// mb_substr()과 mb_strlen(), mb_strpos()과 mb_strrpos() 함수 인코딩 지정
mb_internal_encoding("UTF-8");

// 에러 메세지 출력
function error($message, $url="") {
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
	if($url=="window.close") {
		$message=str_replace("<br>","\\n",$message);
		$message=str_replace("\"","\\\"",$message);
?>
<script>
	alert("<?=$message?>");
	window.close();
</script>
<?
	} else {
		include "error.php";
	}
	exit;
}

// 게시판의 생성유무 검사
function istable($str, $dbname='') {
	if(!$dbname) {
		$f=@file("myZrCnf2019.php") or error("myZrCnf2019.php파일이 없습니다.<br>DB설정을 먼저 하십시요","install.php");
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

// 빈문자열 경우 1을 리턴
function isblank($str) {
	$temp=str_replace("　","",$str);
	$temp=str_replace("\n","",$temp);
	$temp=strip_tags($temp);
	$temp=str_replace("&nbsp;","",$temp);
	$temp=str_replace(" ","",$temp);
	if(preg_match("/[^[:space:]]/i",$temp)) return 0;
	return 1;
}

// HTML Tag를 제거하는 함수
function del_html( $str ) {
	$str = str_replace( ">", "&gt;",$str );
	$str = str_replace( "<", "&lt;",$str );
	return $str;
}

// 페이지 이동 스크립트
function movepage($url) {
	global $connect;
	echo "<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
	exit;
}

// 관리자 테이블과 회원관리 테이블의 이름을 미리 변수로 정의
$member_table = "zetyx_member_table";  // 회원들의 데이타가 들어 있는 직접적인 테이블
$group_table = "zetyx_group_table";   // 그룹테이블
$admin_table="zetyx_admin_table";     // 게시판의 관리자 테이블
$board_imsi_table="zetyx_board_imsi"; // 게시판 임시저장 테이블
$comment_imsi_table="zetyx_board_comment_imsi"; // 코멘트 임시저장 테이블
$send_memo_table ="zetyx_send_memo";
$get_memo_table ="zetyx_get_memo";

include "schema.sql";

if(file_exists("myZrCnf2019.php")) error("이미 myZrCnf2019.php가 생성되어 있습니다.<br><br>재설치하려면 해당 파일을 지우세요");

// 호스트네임, 아이디, DB네임, 비밀번호의 공백여부 검사
if(isblank($hostname)) Error("HostName을 입력하세요","");
if(isblank($user_id)) Error("User ID 를 입력하세요","");
if(isblank($dbname)) Error("DB NAME을 입력하세요","");

// DB에 커넥트 하고 DB NAME으로 select DB
$connect = @mysql_connect($hostname,$user_id,$password) or Error("MySQL-DB Connect<br>Error!!!","");
if(mysql_error()) Error(mysql_error(),"");
mysql_select_db($dbname, $connect ) or Error("MySQL-DB Select<br>Error!!!","");

// 관리자 테이블 생성
if(!isTable($admin_table,$dbname)) @mysql_query($admin_table_schema, $connect) or Error("관리자 테이블 생성 실패","");
else $admin_table_exist=1;

// 그룹테이블 생성
if(!isTable($group_table,$dbname)) @mysql_query($group_table_schema, $connect) or Error("그룹 테이블 생성 실패","");
else $group_table_exist=1;

// 회원관리 테이블 생성
if(!istable($member_table,$dbname)) @mysql_query($member_table_schema, $connect) or Error("회원관리 테이블 생성 실패","");
else $member_table_exist=1;

// 게시판 임시저장 테이블 생성
if(!istable($board_imsi_table,$dbname)) @mysql_query($board_table_imsi_schema, $connect) or Error("게시판 임시저장 테이블 생성 실패","");
else $board_imsi_table_exist=1;

// 코멘트 임시저장 테이블 생성
if(!istable($comment_imsi_table,$dbname)) @mysql_query($board_comment_imsi_schema, $connect) or Error("코멘트 임시저장 테이블 생성 실패","");
else $comment_imsi_table_exist=1;

// 쪽지테이블
if(!istable($get_memo_table,$dbname)) @mysql_query($get_memo_table_schema, $connect) or Error("받은 쪽지 테이블 생성 실패");
else $get_memo_table_exists=1;
if(!istable($send_memo_table,$dbname)) @mysql_query($send_memo_table_schema, $connect) or Error("보낸 쪽지 테이블 생성 실패");
else $send_memo_table_exist=1;

// 파일로 DB 정보 저장
$file=@fopen("myZrCnf2019.php","w") or Error("myZrCnf2019.php 파일 생성 실패<br><br>디렉토리의 퍼미션을 707로 주십시요","");
@fwrite($file,"<?php /*\n$hostname\n$user_id\n$password\n$dbname\n*/ ?>\n") or Error("myZrCnf2019.php 파일 생성 실패<br><br>디렉토리의 퍼미션을 707로 주십시요","");
@fclose($file);
@mkdir("data",0707);
@mkdir("icon",0707);
@mkdir("icon/member_image_box",0707);
@mkdir("icon/private_icon",0707);
@mkdir("icon/private_name",0707);
@chmod("icon/member_image_box",0707);
@chmod("icon/private_icon",0707);
@chmod("icon/private_name",0707);
@chmod("data",0707);
@chmod("icon",0707);
@chmod("myZrCnf2019.php",0707);

// 보안 서버 정보 저장
if(preg_match("#https\:\/\/#i",$sslurl) && substr_count($sslurl,':')==2)
	$zburl="http://".mb_substr($sslurl,8,mb_strrpos($sslurl,':')-8).mb_substr($sslurl,mb_strpos($sslurl,'/',mb_strrpos($sslurl,':')));
elseif(preg_match("#https\:\/\/#i",$sslurl) && substr_count($sslurl,':')==1)
	$zburl="http://".substr($sslurl,8);
else
	$zburl=$sslurl;

$file=@fopen("include/get_url.php","w") or Error("get_url.php 파일 생성 실패<br><br>bbs/include디렉토리의 퍼미션을 707로 주십시요","");
$str1='<?
function sslUrl() {
	return "'.$sslurl.'";
}
function zbUrl() {
	return "'.$zburl.'";
}
'.'?>';
@fwrite($file,$str1) or Error("get_url.php 파일 생성 실패<br><br>bbs/include 디렉토리의 퍼미션을 707로 주십시요","");
@fclose($file);
@chmod("include/get_url.php",0707);

$file=@fopen("script/get_url.php","w") or Error("get_url.php 파일 생성 실패<br><br>bbs/script디렉토리의 퍼미션을 707로 주십시요","");
$str1='function sslUrl() {
	return "'.$sslurl.'";
}
function zbUrl() {
	return "'.$zburl.'";
}';
@fwrite($file,$str1) or Error("get_url.php 파일 생성 실패<br><br>bbs/script 디렉토리의 퍼미션을 707로 주십시요","");
@fclose($file);
@chmod("script/get_url.php",0707);

$temp=mysql_fetch_array(mysql_query("select count(*) from $member_table where is_admin = '1'",$connect));

if($temp[0]) {movepage("admin.php");}
else {movepage("install2.php");} // 관리자 정보가 없을때 관리자 정보 입력
?>
