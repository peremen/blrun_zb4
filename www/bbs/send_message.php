<?
// ���̺귯�� �Լ� ���� ��ũ���
	include "lib.php";

// DB ����
	if(!$connect) $connect=dbConn();

// �۾����� ������ �����;;
	$data=mysql_fetch_array(mysql_query("select * from $member_table where no='$member_no'"));

// ������� ���ϱ�
	$member=member_info();

	if(!$member[no]) Error("ȸ������ ������������ �����մϴ�","window.close");

// �׷쵥��Ÿ �о����;;
	$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no='$data[group_no]'"));


// ���� �������϶�;;
	if($kind==1&&$member[no]&&$data[no]) {
		if(preg_match("/[@\\\#\$%&\(\)\+\|=\{\}\[\]\;<>,\'\"]/i",$subject)) Error("������ ����, �ѱ�, ����, ., -, /, ?, !, ^ ������ �Է��Ͽ� �ֽʽÿ�");
		if(isblank($subject)) Error("������ �����ϴ�. ������ �Է��� �ֽʽÿ�.");

		if(preg_match("/[@\\\#\$&\(\)\+\|=\{\}\'\"]/i",$memo)) Error("������ ����, �ѱ�, ����, !, %, ^, -, _, ; ?, <>, . ������ �Է��Ͽ� �ֽʽÿ�. ��ȣ�� �׹��� Ư������, ����ǥ ���� ������ �ʽ��ϴ�!");
		if(isblank($memo)) Error("������ �����ϴ�. ������ �Է��� �ֽʽÿ�.");

		$subject=addslashes($subject);
		$memo=addslashes($memo);
		$reg_date=time();
		mysql_query("insert into $get_memo_table (member_no,member_from,subject,memo,readed,reg_date) values ('$data[no]','$member[no]','$subject','$memo',1,'$reg_date')") or error(mysql_error());
		mysql_query("insert into $send_memo_table (member_to,member_no,subject,memo,readed,reg_date) values ('$data[no]','$member[no]','$subject','$memo',1,'$reg_date')") or error(mysql_error());
		mysql_query("update $member_table set new_memo=1 where no='$data[no]'") or error(mysql_error());
		echo "<script language='javascript'>alert('$data[name] �Բ� ������ ���½��ϴ�');window.close();</script>";
	}

	mysql_close($connect);
?>
