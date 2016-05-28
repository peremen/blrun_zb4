<?
include "lib.php";
include "schema.sql";

if(file_exists("myZrCnf2019.php")) error("이미 myZrCnf2019.php가 생성되어 있습니다.<br><br>재설치하려면 해당 파일을 지우세요");

// 호스트네임, 아이디, DB네임, 비밀번호의 공백여부 검사
if(isBlank($hostname)) Error("HostName을 입력하세요","");
if(isBlank($user_id)) Error("User ID 를 입력하세요","");
if(isBlank($dbname)) Error("DB NAME을 입력하세요","");

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
if(!istable($get_memo_table,$dbname))  @mysql_query($get_memo_table_schema, $connect) or Error("받은 쪽지 테이블 생성 실패");
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
$zburl="http://".substr($sslurl,8,strrpos($sslurl,':')-8).substr($sslurl,strpos($sslurl,'/',strrpos($sslurl,':')));

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

mysql_close($connect);

if($temp[0]) {movepage("admin.php");}
else {movepage("install2.php");} // 관리자 정보가 없을때 관리자 정보 입력
?>