<?php
include "lib_ajax.php";

// DB 연결
if(!$connect) $connect=dbConn();

// 회원 데이타 읽어 오기
$member = member_info();

// 각종 변수 검사;;
if($member[no]) {
	$password = $member[password];
	$name=$member[name];
	$ismember=$member[no];
} else {
	if(!get_magic_quotes_gpc()) {
		$password = addslashes($password);
	}
	$name=iconv("utf-8","euc-kr",$name);
	if(!get_magic_quotes_gpc()) {
		$name= addslashes($name);
	}
	$ismember='0';
}

// 패스워드를 암호화
if(strlen($password)) {
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];
}

function comment_imsi_info($id,$c_no,$parent,$ismember,$name,$password) {
	global $comment_imsi_table;
	$temp=mysql_fetch_array(mysql_query("select * from $comment_imsi_table where bname='$id' and cno='$c_no' and parent='$parent' and ismember='$ismember' and name='$name' and password='$password'"));
	return $temp;
}

if($mode=="write"||($mode=="reply"&&$c_no)) {
	if($name&&$password) {
		$re=mysql_fetch_array(mysql_query("select count(*) from $comment_imsi_table where bname='$id' and cno='0' and parent='$no' and ismember='$ismember' and name='$name' and password='$password'"));

		if($re[0]>0)
			$jsontable=comment_imsi_info($id,0,$no,$ismember,$name,$password);
	}

/***************************************************************************
* 수정글일때
**************************************************************************/
} elseif($mode=="modify"&&$c_no) {
	$re=mysql_fetch_array(mysql_query("select count(*) from $comment_imsi_table where bname='$id' and cno='$c_no' and parent='$no' and ismember='$ismember' and name='$name' and password='$password'"));

	if($re[0]>0)
		$jsontable=comment_imsi_info($id,$c_no,$no,$ismember,$name,$password);
}

if(empty($jsontable)) $jsontable=array(); // 변수 Null일 경우

foreach($jsontable as $key=>$value)
	$jsontable[$key]=iconv("euc-kr","utf-8",$value);

print json_encode($jsontable);
?>