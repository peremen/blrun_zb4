<?
	include "lib.php";

	$connect=dbConn();

// �����ڰ� 1���̻� ������� �ٷ� �α��� ��������...
	$temp=mysql_fetch_array(mysql_query("select count(*) from $member_table where is_admin='1'",$connect));
	if($temp[0]) {
		header("location:admin.php"); 
		mysql_close($connect);
		exit;
	}

// ���ڿ������� �˻�
	if(isBlank($user_id)) Error("���̵� �Է��ϼž� �մϴ�","");
	if(isBlank($password1)) Error("��й�ȣ�� �Է��ϼž� �մϴ�","");
	if(isBlank($password2)) Error("��й�ȣ Ȯ���� �Է��ϼž� �մϴ�","");
	if($password1!=$password2) Error("��й�ȣ�� ��й�ȣ Ȯ���� ��ġ���� �ʽ��ϴ�","");
	if(isBlank($name)) Error("�̸��� �Է��ϼž� �մϴ�","");

// ������ ���� �Է�
	@mysql_query("insert into $member_table (user_id,password,name,is_admin,reg_date,level) values ('$user_id',password('$password1'),'$name','1','".time()."','1')",$connect) or Error(mysql_error(),"");

	mysql_close($connect);

	header("location:admin.php");
?>
