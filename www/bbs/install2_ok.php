<?
include "lib.php";

if(!$connect) $connect=dbConn();

// 관리자가 1명이상 있을경우 바로 로그인 페이지로...
$temp=mysql_fetch_array(mysql_query("select count(*) from $member_table where is_admin='1'",$connect));
if($temp[0]) {
	header("location:admin.php");
	exit;
}

// 빈문자열인지를 검사
if(isBlank($user_id)) Error("아이디를 입력하셔야 합니다","");
if(isBlank($password1)) Error("비밀번호를 입력하셔야 합니다","");
if(isBlank($password2)) Error("비밀번호 확인을 입력하셔야 합니다","");
if($password1!=$password2) Error("비밀번호와 비밀번호 확인이 일치하지 않습니다","");
if(isBlank($name)) Error("이름을 입력하셔야 합니다","");

// 관리자 정보 입력
@mysql_query("insert into $member_table (user_id,password,name,is_admin,reg_date,level) values ('$user_id',password('$password1'),'$name','1','".time()."','1')",$connect) or Error(mysql_error(),"");

header("location:admin.php");
?>
