<?
	include "lib.php";

	// �������� E-mail
	$_from = $_zbDefaultSetup[email];

	// ����Ʈ �ּ�
	$_homepage = $_zbDefaultSetup[url];

	// ����Ʈ �̸�
	$_sitename = $_zbDefaultSetup[sitename];

	$connect = dbconn();

 	if(isblank($email)) Error("E-Mail�� �Է��Ͽ� �ּ���");
 	if(isblank($jumin1)||!isnum($jumin1)) Error("�ֹε�Ϲ�ȣ�� ����� �Է��Ͽ� �ּ���");
	if(isblank($jumin2)||!isnum($jumin2)) Error("�ֹε�Ϲ�ȣ�� ����� �Է��Ͽ� �ּ���");

	$result=mysql_query("select * from zetyx_member_table where email='$email' and jumin=password('$jumin1"."$jumin2')",$connect) or Error(mysql_error());

	if(!mysql_num_rows($result)) Error("�Է��Ͻ� ������ �ش��ϴ� ȸ���� �����ϴ�.<br><br>�ٽ� �ѹ�Ȯ���Ͽ� �ֽñ� �ٶ��ϴ�");
 	else {
		$temp=substr(base64_encode(time()),1,10);

		$data=mysql_fetch_array($result);

		mysql_query("update $member_table set password=password('$temp') where no='$data[no]'",$connect) or Error(mysql_error());

		$name=stripslashes($data[name]);
		$to=$data[email];


		$subject="�ȳ��ϼ���, $_sitename �Դϴ�";

		$comment="�ȳ��ϼ���.\n"."$_sitename �Դϴ�.\n"."$name ���� ȸ�� ���̵�� ���Ӱ� ����� ��й�ȣ�Դϴ�. \nȮ���� �� �ٷ� $_sitename ($_homepage) �� �α��� �ϼż� ��й�ȣ�� �����Ͽ� �ֽñ� �ٶ��ϴ�.\n\nID : $data[user_id]\nPassword : $temp \n\n * ���� ��й�ȣ�� Ÿ�����ϱ� ���鶧 ���콺�� ����Ŭ������ Ctrl-C �� ������ ��������,\n ��й�ȣ �Է�ĭ���� Ctrl-V�� ������ �����ϼ���.";

		if(!zb_sendmail(0, $to, $name, $_from, "", $subject, $comment)) Error("���� �߼� ����");
	}

	@mysql_close($connect);
?>
<script>
	alert('����� ��й�ȣ�� <?=$email?>�� �߼۵Ǿ����ϴ�.\n\n������ Ȯ���Ͻ��� �� �ٷ� �α����Ͽ�\n\n��й�ȣ�� �����Ͽ� �ֽñ� �ٶ�ڽ��ϴ�');
	window.close();
</script>
