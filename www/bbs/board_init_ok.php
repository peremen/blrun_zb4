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
	if(!get_magic_quotes_gpc()) {
		$name= addslashes($name);
	}
	$ismember='0';
}

// 패스워드를 암호화
if(mb_strlen($password)) {
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];
}

function board_imsi_info($id,$no,$ismember,$name,$password) {
	global $board_imsi_table;
	$temp=mysql_fetch_array(mysql_query("select * from $board_imsi_table where bname='$id' and bno='$no' and ismember='$ismember' and name='$name' and password='$password'"));
	return $temp;
}

if($mode!="modify") {
	if($name&&$password) {
		$re=mysql_fetch_array(mysql_query("select count(*) from $board_imsi_table where bname='$id' and bno='0' and ismember='$ismember' and name='$name' and password='$password'"));

		if($re[0]>0)
			$jsontable=board_imsi_info($id,0,$ismember,$name,$password);
	}

/***************************************************************************
* 수정글일때
**************************************************************************/
} elseif($mode=="modify"&&$no) {
	$re=mysql_fetch_array(mysql_query("select count(*) from $board_imsi_table where bname='$id' and bno='$no' and ismember='$ismember' and name='$name' and password='$password'"));

	if($re[0]>0)
		$jsontable=board_imsi_info($id,$no,$ismember,$name,$password);
}

print json_encode($jsontable);
?>
