<?
// ���� �޼��� ���
function error($message, $url="") {
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
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

// �Խ����� �������� �˻�
function istable($str, $dbname='') {
	if(!$dbname) {
		$f=@file("myZrCnf2019.php") or error("myZrCnf2019.php������ �����ϴ�.<br>DB������ ���� �Ͻʽÿ�","install.php");
		for($i=1;$i<=4;$i++) $f[$i]=str_replace("\n","",$f[$i]);
		$dbname=$f[4];
	}

	$result = mysql_list_tables($dbname) or error(mysql_error(),"");

	$i=0;

	while ($i < mysql_num_rows($result)) {
		if($str==mysql_tablename ($result, $i)) return 1;
		$i++;
	}
	return 0;
}

// ���ڿ� ��� 1�� ����
function isblank($str) {
	$temp=str_replace("��","",$str);
	$temp=str_replace("\n","",$temp);
	$temp=strip_tags($temp);
	$temp=str_replace("&nbsp;","",$temp);
	$temp=str_replace(" ","",$temp);
	if(preg_match("/[^[:space:]]/i",$temp)) return 0;
	return 1;
}

// ������ �̵� ��ũ��Ʈ
function movepage($url) {
	global $connect;
	echo "<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
	exit;
}

// ������ ���̺�� ȸ������ ���̺��� �̸��� �̸� ������ ����
$member_table = "zetyx_member_table";  // ȸ������ ����Ÿ�� ��� �ִ� �������� ���̺�
$group_table = "zetyx_group_table";   // �׷����̺�
$admin_table="zetyx_admin_table";     // �Խ����� ������ ���̺�
$board_imsi_table="zetyx_board_imsi"; // �Խ��� �ӽ����� ���̺�
$comment_imsi_table="zetyx_board_comment_imsi"; // �ڸ�Ʈ �ӽ����� ���̺�
$send_memo_table ="zetyx_send_memo";
$get_memo_table ="zetyx_get_memo";

include "schema.sql";

if(file_exists("myZrCnf2019.php")) error("�̹� myZrCnf2019.php�� �����Ǿ� �ֽ��ϴ�.<br><br>�缳ġ�Ϸ��� �ش� ������ ���켼��");

// ȣ��Ʈ����, ���̵�, DB����, ��й�ȣ�� ���鿩�� �˻�
if(isBlank($hostname)) Error("HostName�� �Է��ϼ���","");
if(isBlank($user_id)) Error("User ID �� �Է��ϼ���","");
if(isBlank($dbname)) Error("DB NAME�� �Է��ϼ���","");

// DB�� Ŀ��Ʈ �ϰ� DB NAME���� select DB
$connect = @mysql_connect($hostname,$user_id,$password) or Error("MySQL-DB Connect<br>Error!!!","");
if(mysql_error()) Error(mysql_error(),"");
mysql_select_db($dbname, $connect ) or Error("MySQL-DB Select<br>Error!!!","");

// ������ ���̺� ����
if(!isTable($admin_table,$dbname)) @mysql_query($admin_table_schema, $connect) or Error("������ ���̺� ���� ����","");
else $admin_table_exist=1;

// �׷����̺� ����
if(!isTable($group_table,$dbname)) @mysql_query($group_table_schema, $connect) or Error("�׷� ���̺� ���� ����","");
else $group_table_exist=1;

// ȸ������ ���̺� ����
if(!istable($member_table,$dbname)) @mysql_query($member_table_schema, $connect) or Error("ȸ������ ���̺� ���� ����","");
else $member_table_exist=1;

// �Խ��� �ӽ����� ���̺� ����
if(!istable($board_imsi_table,$dbname)) @mysql_query($board_table_imsi_schema, $connect) or Error("�Խ��� �ӽ����� ���̺� ���� ����","");
else $board_imsi_table_exist=1;

// �ڸ�Ʈ �ӽ����� ���̺� ����
if(!istable($comment_imsi_table,$dbname)) @mysql_query($board_comment_imsi_schema, $connect) or Error("�ڸ�Ʈ �ӽ����� ���̺� ���� ����","");
else $comment_imsi_table_exist=1;

// �������̺�
if(!istable($get_memo_table,$dbname))  @mysql_query($get_memo_table_schema, $connect) or Error("���� ���� ���̺� ���� ����");
else $get_memo_table_exists=1;
if(!istable($send_memo_table,$dbname)) @mysql_query($send_memo_table_schema, $connect) or Error("���� ���� ���̺� ���� ����");
else $send_memo_table_exist=1;

// ���Ϸ� DB ���� ����
$file=@fopen("myZrCnf2019.php","w") or Error("myZrCnf2019.php ���� ���� ����<br><br>���丮�� �۹̼��� 707�� �ֽʽÿ�","");
@fwrite($file,"<?php /*\n$hostname\n$user_id\n$password\n$dbname\n*/ ?>\n") or Error("myZrCnf2019.php ���� ���� ����<br><br>���丮�� �۹̼��� 707�� �ֽʽÿ�","");
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

// ���� ���� ���� ����
if(preg_match("#https\:\/\/#i",$sslurl) && substr_count($sslurl,':')==2)
	$zburl="http://".substr($sslurl,8,strrpos($sslurl,':')-8).substr($sslurl,strpos($sslurl,'/',strrpos($sslurl,':')));
elseif(preg_match("#https\:\/\/#i",$sslurl) && substr_count($sslurl,':')==1)
	$zburl="http://".substr($sslurl,8);
else
	$zburl=$sslurl;

$file=@fopen("include/get_url.php","w") or Error("get_url.php ���� ���� ����<br><br>bbs/include���丮�� �۹̼��� 707�� �ֽʽÿ�","");
$str1='<?
function sslUrl() {
	return "'.$sslurl.'";
}
function zbUrl() {
	return "'.$zburl.'";
}
'.'?>';
@fwrite($file,$str1) or Error("get_url.php ���� ���� ����<br><br>bbs/include ���丮�� �۹̼��� 707�� �ֽʽÿ�","");
@fclose($file);
@chmod("include/get_url.php",0707);

$file=@fopen("script/get_url.php","w") or Error("get_url.php ���� ���� ����<br><br>bbs/script���丮�� �۹̼��� 707�� �ֽʽÿ�","");
$str1='function sslUrl() {
	return "'.$sslurl.'";
}
function zbUrl() {
	return "'.$zburl.'";
}';
@fwrite($file,$str1) or Error("get_url.php ���� ���� ����<br><br>bbs/script ���丮�� �۹̼��� 707�� �ֽʽÿ�","");
@fclose($file);
@chmod("script/get_url.php",0707);

$temp=mysql_fetch_array(mysql_query("select count(*) from $member_table where is_admin = '1'",$connect));

if($temp[0]) {movepage("admin.php");}
else {movepage("install2.php");} // ������ ������ ������ ������ ���� �Է�
?>