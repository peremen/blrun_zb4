<?
// 라이브러리 함수 파일 인크루드
include "lib.php";

// DB 연결
if(!$connect) $connect=dbConn();

// 글쓴이의 정보를 갖고옴;;
$data=mysql_fetch_array(mysql_query("select * from $member_table where no='$member_no'"));

// 멤버정보 구하기
$member=member_info();

if(!$member[no]) Error("회원만이 쪽지보내가기 가능합니다","window.close");

// 그룹데이타 읽어오기;;
$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no='$data[group_no]'"));


// 쪽지 보내기일때;;
if($kind==1&&$member[no]&&$data[no]) {
	if(preg_match("/[@\\\#\$%&\(\)\+\|=\{\}\[\]\;<>,\'\"]/i",$subject)) Error("제목을 영문, 한글, 숫자, ., -, /, ?, !, ^ 등으로 입력하여 주십시요");
	if(isblank($subject)) Error("제목이 없습니다. 제목을 입력해 주십시오.");

	if(preg_match("/[@\\\#\$&\(\)\+\|=\{\}\'\"]/i",$memo)) Error("내용을 영문, 한글, 숫자, !, %, ^, -, _, ; ?, <>, . 등으로 입력하여 주십시요. 괄호나 그밖의 특수문자, 따옴표 등은 허용되지 않습니다!");
	if(isblank($memo)) Error("내용이 없습니다. 내용을 입력해 주십시오.");

	$subject=addslashes($subject);
	$memo=addslashes($memo);
	$reg_date=time();
	mysql_query("insert into $get_memo_table (member_no,member_from,subject,memo,readed,reg_date) values ('$data[no]','$member[no]','$subject','$memo',1,'$reg_date')") or error(mysql_error());
	mysql_query("insert into $send_memo_table (member_to,member_no,subject,memo,readed,reg_date) values ('$data[no]','$member[no]','$subject','$memo',1,'$reg_date')") or error(mysql_error());
	mysql_query("update $member_table set new_memo=1 where no='$data[no]'") or error(mysql_error());
	echo "<script language='javascript'>alert('$data[name] 님께 쪽지를 보냈습니다');window.close();</script>";
}
?>
