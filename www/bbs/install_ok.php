<?
	include "lib.php";
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

// �������̺�
	if(!istable($get_memo_table,$dbname))  @mysql_query($get_memo_table_schema, $connect) or Error("���� ���� ���̺� ���� ����");
	else $get_memo_table_exists=1;
	if(!istable($send_memo_table,$dbname)) @mysql_query($send_memo_table_schema, $connect) or Error("���� ���� ���̺� ���� ����");
	else $send_memo_table_exist=1;

// ���Ϸ� DB ���� ����
	$file=@fopen("myZrCnf2019.php","w") or Error("myZrCnf2019.php ���� ���� ����<br><br>���丮�� �۹̼��� 707�� �ֽʽÿ�","");
	@fwrite($file,"<?\n$hostname\n$user_id\n$password\n$dbname\n?>\n") or Error("myZrCnf2019.php ���� ���� ����<br><br>���丮�� �۹̼��� 707�� �ֽʽÿ�","");
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

	$temp=mysql_fetch_array(mysql_query("select count(*) from $member_table where is_admin = '1'",$connect));

	mysql_close($connect);

	if($temp[0]) {movepage("admin.php");}
	else {movepage("install2.php");} // ������ ������ ������ ������ ���� �Է�
?>
