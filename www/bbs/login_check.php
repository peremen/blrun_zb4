<?
include "lib.php";

if(!$connect) $connect=dbConn();

$user_id = trim($user_id);
$password = trim($password);

if(!get_magic_quotes_gpc()) {
  $user_id = addslashes($user_id);
  $password = addslashes($password);
}

if(!$user_id) Error("���̵� �Է��Ͽ� �ֽʽÿ�");
if(!$password) Error("��й�ȣ�� �Է��Ͽ� �ֽʽÿ�");

if($id) {
	$setup=get_table_attrib($id);
	$group=group_info($setup[group_no]);
}

if($setup[group_no]) $group_no=$setup[group_no];

// �н����带 ��ȣȭ
if($password){
	if($password) {
		$temp=mysql_fetch_array(mysql_query("select password('$password')"));
		$password=$temp[0];   
	}
}

// ȸ�� �α��� üũ
$result = mysql_query("select * from $member_table where user_id='$user_id' and password='$password'") or error(mysql_error());
$member_data = mysql_fetch_array($result);

// ȸ���α����� �����Ͽ��� ��� ������ �����ϰ� �������� �̵���
if($member_data[no]) {

	// �����ڸ�� ��ū �ʱ�ȭ
	$_SESSION['_token2']='';
	setCookie("token2","",0,"/","");

	if($auto_login) {
		makeZBSessionID($member_data[no]);
	}

	// ������ �� ���ڸ� �߻�(��1000-9999����) �� ��ū������ ����
	$num1 = mt_rand(1000,9999);
	$num2 = mt_rand(1000,9999);
	$num3 = mt_rand(1000,9999);
	$num123 = $num1.$num2.$num3;

	// �α��ν� ��ū ����
	setCookie("token","$num123",0,"/","");
	// email IP ǥ�� �ҷ��� ó��
	unset($c_match);
	if(preg_match("#\|\|\|([0-9.]{1,})$#",$member_data[email],$c_match)) {
		//$tokenID = $c_match[1];
		$member_data[email] = str_replace($c_match[0],"",$member_data[email]);
	}
	$member_data[email].="|||".$REMOTE_ADDR;
	mysql_query("update $member_table set email='$member_data[email]' where user_id='$user_id'");
	$_SESSION['_token'] = "$num123";

	// 5.3 �̻�� ���� ó��
	$_SESSION['zb_logged_no'] = $member_data[no];
	$_SESSION['zb_logged_time'] = time();
	$_SESSION['zb_logged_ip'] = $REMOTE_ADDR;
	$_SESSION['zb_last_connect_check'] = '0';

	// �α��� �� ������ �̵�
	if($mypos=strrpos($_zb_url,"/bbs/")) // ������ ������ ��ġ ã�� ����
		$s_url=substr($_zb_url,0,$mypos).urldecode($s_url);
	if(!$s_url&&$id) $s_url=$_zb_url."zboard.php?id=$id";
	if($s_url) movepage($s_url);
	elseif($id) movepage($_zb_url."zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no");
	elseif($group[join_return_url]) movepage($group[join_return_url]);
	elseif($referer) movepage($referer);
	else echo "<script>location.href=document.referrer;</script>";

// ȸ���α����� �����Ͽ��� ��� ���� ǥ��
} else {
	head();
	Error("�α����� �����Ͽ����ϴ�");
	foot();
}
?>