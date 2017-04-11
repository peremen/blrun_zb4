<?
include "lib.php";

if(!$connect) $connect=dbConn();

$user_id = trim($user_id);
$password = trim($password);

if(!get_magic_quotes_gpc()) {
  $user_id = addslashes($user_id);
  $password = addslashes($password);
}

if(!$user_id) Error("아이디를 입력하여 주십시요");
if(!$password) Error("비밀번호를 입력하여 주십시요");

if($id) {
	$setup=get_table_attrib($id);
	$group=group_info($setup[group_no]);
}

if($setup[group_no]) $group_no=$setup[group_no];

// 패스워드를 암호화
if($password){
	if($password) {
		$temp=mysql_fetch_array(mysql_query("select password('$password')"));
		$password=$temp[0];
	}
}

// 회원 로그인 체크
$result = mysql_query("select * from $member_table where user_id='$user_id' and password='$password'") or error(mysql_error());
$member_data = mysql_fetch_array($result);

// 회원로그인이 성공하였을 경우 세션을 생성하고 페이지를 이동함
if($member_data[no]) {

	// 관리자모드 토큰 초기화
	$_SESSION['_token2']='';
	setCookie("token2","",0,"/","");

	if($auto_login) {
		makeZBSessionID($member_data[no]);
	}

	// 랜덤한 세 숫자를 발생(각1000-9999까지) 후 토큰변수에 대입
	$num1 = mt_rand(1000,9999);
	$num2 = mt_rand(1000,9999);
	$num3 = mt_rand(1000,9999);
	$num123 = $num1.$num2.$num3;

	// 로그인시 토큰 생성
	setCookie("token","$num123",0,"/","");
	// email IP 표식 불러와 처리
	unset($c_match);
	if(preg_match("#\|\|\|([0-9.]{1,})$#",$member_data[email],$c_match)) {
		//$tokenID = $c_match[1];
		$member_data[email] = str_replace($c_match[0],"",$member_data[email]);
	}
	$member_data[email].="|||".$REMOTE_ADDR;
	mysql_query("update $member_table set email='$member_data[email]' where user_id='$user_id'");
	$_SESSION['_token'] = "$num123";

	// 5.3 이상용 세션 처리
	$_SESSION['zb_logged_no'] = $member_data[no];
	$_SESSION['zb_logged_time'] = time();
	$_SESSION['zb_logged_ip'] = $REMOTE_ADDR;
	$_SESSION['zb_last_connect_check'] = '0';

	// 로그인 후 페이지 이동
	if($mypos=mb_strrpos($_zb_url,"/bbs/")) // 마지막 슬래쉬 위치 찾아 제거
		$s_url=mb_substr($_zb_url,0,$mypos).urldecode($s_url);
	if(!$s_url&&$id) $s_url=$_zb_url."zboard.php?id=$id";
	if($s_url) movepage($s_url);
	elseif($id) movepage($_zb_url."zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no");
	elseif($group[join_return_url]) movepage($group[join_return_url]);
	elseif($referer) movepage($referer);
	else echo "<script>location.href=document.referrer;</script>";

// 회원로그인이 실패하였을 경우 에러 표시
} else {
	head();
	Error("로그인을 실패하였습니다");
	foot();
}
?>
