<?
	include "lib.php";

	$connect=dbconn();

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


// ȸ�� �α��� üũ
	$result = mysql_query("select * from $member_table where user_id='$user_id' and password=password('$password')") or error(mysql_error());
	$member_data = mysql_fetch_array($result);

// ȸ���α����� �����Ͽ��� ��� ������ �����ϰ� �������� �̵���
	if($member_data[no]) {

		if($auto_login) {
			makeZBSessionID($member_data[no]);
		}

		// 4.0x �� ���� ó��
		$zb_logged_no = $member_data[no];
		$zb_logged_time = time();
		$zb_logged_ip = $REMOTE_ADDR;
		$zb_last_connect_check = '0';

		session_register("zb_logged_no");
		session_register("zb_logged_time");
		session_register("zb_logged_ip");
		session_register("zb_last_connect_check");

		// �α��� �� ������ �̵�
		$s_url=urldecode($s_url);
		if(!$s_url&&$id) $s_url="zboard.php?id=$id";
		if($s_url) movepage($s_url);
		elseif($id) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no");
		elseif($group[join_return_url]) movepage($group[join_return_url]);
		elseif($referer) movepage($referer);
		else echo"<script>history.go(-2);</script>";

// ȸ���α����� �����Ͽ��� ��� ���� ǥ��
	} else {
		head();
		Error("�α����� �����Ͽ����ϴ�");
		foot();
	}

	@mysql_close($connect);
?>
