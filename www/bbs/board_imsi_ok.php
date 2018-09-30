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
	$email=$member[email];
	$homepage=$member[homepage];
	$ismember=$member[no];
} else {
	if(!get_magic_quotes_gpc()) {
		$password = addslashes($password);
	}
	if(!get_magic_quotes_gpc()) {
		// 각종 변수의 addslashes 시킴;;
		$name= addslashes($name);
		$email = addslashes($email);
		$homepage = addslashes($homepage);
	}
	$ismember='0';
}

// 패스워드를 암호화
if($password) {
	$temp=mysqli_fetch_array(mysqli_query($connect,"select password('$password')"));
	$password=$temp[0];
}

if(!get_magic_quotes_gpc()) {
	// 각종 변수의 addslashes 시킴;;
	$subject = addslashes($subject);
	$memo = addslashes($memo);
	$sitelink1 = addslashes($sitelink1);
	$sitelink2 = addslashes($sitelink2);
}

$reg_date=time();

function board_imsi_info($id,$no,$ismember,$name,$password) {
	global $board_imsi_table, $connect;
	$temp=mysqli_fetch_array(mysqli_query($connect,"select * from $board_imsi_table where bname='$id' and bno='$no' and ismember='$ismember' and name='$name' and password='$password'"));
	return $temp;
}

if($mode!="modify") {
	if($name&&$password&&(($subject&&!preg_match("#Guest#",$subject))||$memo)) {
		$re=mysqli_fetch_array(mysqli_query($connect,"select count(*) from $board_imsi_table where bname='$id' and bno='0' and ismember='$ismember' and name='$name' and password='$password'"));

		if($re[0]>0) {
			// 글쓰기 임시포스트 업데이트
			mysqli_query($connect,"update $board_imsi_table set name='$name',subject='$subject',email='$email',homepage='$homepage',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',notice='$notice',is_secret='$is_secret',category='$category',reg_date='$reg_date' where bname='$id' and bno='0' and ismember='$ismember' and name='$name' and password='$password'") or error(mysqli_error($connect));

			$jsontable=board_imsi_info($id,0,$ismember,$name,$password);
		} else {
			// 글쓰기 입력
			mysqli_query($connect,"insert into $board_imsi_table (bname,ismember,memo,password,name,homepage,email,subject,use_html,reply_mail,notice,category,is_secret,sitelink1,sitelink2,reg_date) values ('$id','$ismember','$memo','$password','$name','$homepage','$email','$subject','$use_html','$reply_mail','$notice','$category','$is_secret','$sitelink1','$sitelink2','$reg_date')") or error(mysqli_error($connect));

			$jsontable=board_imsi_info($id,0,$ismember,$name,$password);
		}
	}

/***************************************************************************
* 수정글일때
**************************************************************************/
} elseif($mode=="modify"&&$no) {
	$re=mysqli_fetch_array(mysqli_query($connect,"select count(*) from $board_imsi_table where bname='$id' and bno='$no' and ismember='$ismember' and name='$name' and password='$password'"));

	if($re[0]>0) {
		// 수정하기 업데이트
		mysqli_query($connect,"update $board_imsi_table set name='$name',subject='$subject',email='$email',homepage='$homepage',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',notice='$notice',is_secret='$is_secret',category='$category',reg_date='$reg_date' where bname='$id' and bno='$no' and ismember='$ismember' and name='$name' and password='$password'") or error(mysqli_error($connect));

		$jsontable=board_imsi_info($id,$no,$ismember,$name,$password);
	} else {
		// 수정하기 입력
		mysqli_query($connect,"insert into $board_imsi_table (bname,bno,ismember,memo,password,name,homepage,email,subject,use_html,reply_mail,notice,category,is_secret,sitelink1,sitelink2,reg_date) values ('$id','$no','$ismember','$memo','$password','$name','$homepage','$email','$subject','$use_html','$reply_mail','$notice','$category','$is_secret','$sitelink1','$sitelink2','$reg_date')") or error(mysqli_error($connect));

		$jsontable=board_imsi_info($id,$no,$ismember,$name,$password);
	}

}

if(empty($jsontable)) $jsontable=array(); // 변수 Null일 경우
print json_encode($jsontable);
?>