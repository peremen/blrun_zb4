<?
function del_member($no) {
	global $group_no, $member_table, $get_memo_table,  $send_memo_table,$admin_table, $t_board, $t_comment, $connect, $group_table, $member;

	$member_data = mysql_fetch_array(mysql_query("select * from $member_table where no = '$no'"));
	if($member[is_admin]>1&&$member[no]!=$member_data[no]&&$member_data[level]<=$member[level]&&$member_data[is_admin]<=$member[is_admin]) error("�����Ͻ� ȸ���� ������ ������ ������ �����ϴ�");

	// ��� ���� ����
	@mysql_query("delete from $member_table where no='$no'") or error(mysql_error());

	// ���� ���̺��� ��� ���� ����
	@mysql_query("delete from $get_memo_table where member_no='$no'") or error(mysql_error());
	@mysql_query("delete from $send_memo_table where member_no='$no'") or error(mysql_error());

	// �׷����̺��� ȸ���� -1
	@mysql_query("update $group_table set member_num=member_num-1 where no = '$group_no'") or error(mysql_error());

	// �̸� �׸�, ������, �̹��� �ڽ� ���뷮 ���� ����
	@z_unlink("icon/private_name/".$no.".gif");
	@z_unlink("icon/private_icon/".$no.".gif");
	@z_unlink("icon/member_image_box/".$no."_maxsize.php");
}


// �׷��߰�
if($exec=="add_group_ok") {
	if($member[is_admin]>1) Error("�׷���� ������ �����ϴ�");
	if(isblank($name)) Error("�׷��̸��� �ʼ��� �����ϼž� �մϴ�");
	// �ߺ� �̸� �˻�
	$check=mysql_fetch_array(mysql_query("select count(*) from $group_table where name='$name'"));
	if($check[0]) Error("$name �̶�� �̸��� �׷��� �̹� �ֽ��ϴ�");

	if($_FILES[icon]) {
		$icon = $_FILES[icon][tmp_name];
		$icon_name = $_FILES[icon][name];
		$icon_type = $_FILES[icon][type];
		$icon_size = $_FILES[icon][size];
	}

	// ������ ���� ���ε��
	if($icon_name) {
		// Ư�����ڰ� ������ ����
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$icon_name,$result);
		if($result[0]!=$icon_name) Error("���ϸ��� �ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!");

		if(!preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$icon_name)) Error("�������� jpg(jepg)/png/gif/bmp ������ �÷��ּ���");
		$size=GetImageSize($icon);
		if($size[0]>24||$size[1]>24) Error("�������� ũ��� 24*24���Ͽ��� �մϴ�");
		$kind=array("","jpg","jepg","png","gif","bmp");
		$n=$size[2];
		@copy($icon,"icon/group_".$group_no.".".$kind[$n]);
		$icon_name="group_$group_no.".$kind[$n];
	}

	// ȸ������, �α��ν� �̵��� URL
	if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\'\"]/i",$join_return_url)) Error("ȸ������, �α��ν� �̵��� URL�� ����, �ѱ�, ����, -, ., / ������ �Է��Ͽ� �ֽʽÿ�");
	$join_return_url=addslashes($join_return_url);

	// ���Ǫ��
	if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\'\"]/i",$header_url)) Error("��� ���ϸ��� ����, �ѱ�, ����, -, ., / ������ �Է��Ͽ� �ֽʽÿ�");
	$header_url=addslashes($header_url);

	if(preg_match("/[@\\\#\$&\(\)\+\|\{\}\;\'\"]/i",$header)) Error("��ܿ� ����� ������ ����, �ѱ�, ����, !, %, =, ^, -, _, ?, [], <>, ., / ������ �Է��Ͽ� �ֽʽÿ�. ��ȣ�� �׹��� Ư������, ����ǥ ���� ������ �ʽ��ϴ�!");
	$header=addslashes($header);

	if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\'\"]/i",$footer_url)) Error("�ϴ� ���ϸ��� ����, �ѱ�, ����, -, ., / ������ �Է��Ͽ� �ֽʽÿ�");
	$footer_url=addslashes($footer_url);

	if(preg_match("/[@\\\#\$&\(\)\+\|\{\}\;\'\"]/i",$footer)) Error("�ϴܿ� ����� ������ ����, �ѱ�, ����, !, %, =, ^, -, _, ?, [], <>, ., / ������ �Է��Ͽ� �ֽʽÿ�. ��ȣ�� �׹��� Ư������, Ȭ����ǥ ���� ������ �ʽ��ϴ�!");
	$footer=addslashes($footer);

	// DB�� �Է�
	@mysql_query("insert into $group_table (name,is_open,icon,use_join,join_return_url, use_icon, header,footer,header_url,footer_url)
					values ('$name','$is_open','$icon_name','$use_join','$join_return_url','$use_icon','$header','$footer','$header_url','$footer_url')") or Error("�׷���� ������ �����ϴ�");
	$group_no=mysql_insert_id();
	movepage("$PHP_SELF?exec=view_group&group_no=$group_no&sid=$sid");
}
// �׷���� �Ϸ�
elseif($exec=="modify_group_ok") {
	if($member[is_admin]>2) Error("�׷���� ������ �����ϴ�");
	if($member[is_admin]==2&&$member[group_no]!=$group_no) Error("�׷���� ������ �����ϴ�");
	if(isblank($name)) Error("�׷��̸��� �ʼ��� �����ϼž� �մϴ�");
	if($del_icon) $icon_sql=",icon=''";
	// ������ ���� ���ε��
	if($_FILES[icon]) {
		$icon = $_FILES[icon][tmp_name];
		$icon_name = $_FILES[icon][name];
		$icon_type = $_FILES[icon][type];
		$icon_size = $_FILES[icon][size];
	}

	if($icon_name) {
		// Ư�����ڰ� ������ ����
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$icon_name,$result);
		if($result[0]!=$icon_name) Error("���ϸ��� �ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!");

		if(!preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$icon_name)) Error("�������� jpg(jepg)/png/gif/bmp ������ �÷��ּ���");
		$size=GetImageSize($icon);
		if($size[0]>24||$size[1]>24) Error("�������� ũ��� 24*24���Ͽ��� �մϴ�");
		$kind=array("","jpg","jepg","png","gif","bmp");
		$n=$size[2];
		@copy($icon,"icon/group_".$group_no.".".$kind[$n]);
		$icon_name="group_$group_no.".$kind[$n];
		$icon_sql=",icon='$icon_name'";
	}
	// ȸ������, �α��ν� �̵��� URL
	if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\'\"]/i",$join_return_url)) Error("ȸ������, �α��ν� �̵��� URL�� ����, �ѱ�, ����, -, ., / ������ �Է��Ͽ� �ֽʽÿ�");
	$join_return_url=addslashes($join_return_url);

	// ���Ǫ��
	if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\'\"]/i",$header_url)) Error("��� ���ϸ��� ����, �ѱ�, ����, -, ., / ������ �Է��Ͽ� �ֽʽÿ�");
	$header_url=addslashes($header_url);

	if(preg_match("/[@\\\#\$&\(\)\+\|\{\}\;\'\"]/i",$header)) Error("��ܿ� ����� ������ ����, �ѱ�, ����, !, %, =, ^, -, _, ?, [], <>, ., / ������ �Է��Ͽ� �ֽʽÿ�. ��ȣ�� �׹��� Ư������, ����ǥ ���� ������ �ʽ��ϴ�!");
	$header=addslashes($header);

	if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\'\"]/i",$footer_url)) Error("�ϴ� ���ϸ��� ����, �ѱ�, ����, -, ., / ������ �Է��Ͽ� �ֽʽÿ�");
	$footer_url=addslashes($footer_url);

	if(preg_match("/[@\\\#\$&\(\)\+\|\{\}\;\'\"]/i",$footer)) Error("�ϴܿ� ����� ������ ����, �ѱ�, ����, !, %, =, ^, -, _, ?, [], <>, ., / ������ �Է��Ͽ� �ֽʽÿ�. ��ȣ�� �׹��� Ư������, Ȭ����ǥ ���� ������ �ʽ��ϴ�!");
	$footer=addslashes($footer);

	// DB�� �Է�
	@mysql_query("update $group_table set
					use_hobby='$use_hobby',name='$name',is_open='$is_open' $icon_sql ,use_join='$use_join',join_return_url='$join_return_url',use_icon='$use_icon',
					header='$header',footer='$footer',footer_url='$footer_url',header_url='$header_url'
					where no='$group_no'") or Error("�׷���� ������ �����ϴ�");
	movepage("$PHP_SELF?exec=view_group&group_no=$group_no&exec=modify_group&sid=$sid");
}
// �׷���� �Ϸ�
elseif($exec=="del_group_ok") {
	if($member[is_admin]>1) Error("�׷���� ������ �����ϴ�");
	// ������ �׷��� ȸ������ �Խ��� ���� ����
	$num=mysql_fetch_array(mysql_query("select member_num, board_num from $group_table where no='$group_no'"));

	// ��� �̵�
	if($member_move) {
		@mysql_query("update $member_table set group_no='$member_move' where group_no='$group_no'") or Error("ȸ�� �̵��ÿ� ������ �߻��Ͽ����ϴ�");
		mysql_query("update $group_table set member_num=member_num+".$num[member_num]." where no='$member_move'");
	} else {
		$result = mysql_query("select no from $member_table where group_no='$group_no'") or Error("ȸ�� �̵��ÿ� ������ �߻��Ͽ����ϴ�");
		while($data=mysql_fetch_array($result)) {
			$no = $data['no'];
			del_member($no);
		}
	}

	// �Խ����̵�
	if($board_move) {
		@mysql_query("update $admin_table set group_no='$board_move' where group_no='$group_no'") or Error("�Խ��� �̵��ÿ� ������ �߻��Ͽ����ϴ�");
		mysql_query("update $group_table set board_num=board_num+".$num[board_num]." where no='$board_move'");
	} else {
		$temp=mysql_query("select name from $admin_table where group_no='$group_no'");
		while($data=mysql_fetch_array($temp)) {
			$table_name=$data[name];
			$tmpData = mysql_query("select file_name1, file_name2 from $t_board"."_$table_name") or die("÷������ ���� ó���� ������ �߻��߽��ϴ�");
			while($data=mysql_fetch_array($tmpData)) {
				if($data[file_name1]) @z_unlink("./".$data[file_name1]);
				if($data[file_name2]) @z_unlink("./".$data[file_name2]);
			}
			if(is_dir("./data/".$table_name)) zRmDir("./data/".$table_name);
			mysql_query("delete from $admin_table where no='$no'") or Error("�Խ��� ������ ������ ���̺��� ������ �߻��Ͽ����ϴ�");
			mysql_query("drop table $t_board"."_$table_name") or Error("�Խ����� ���� ���̺� ���� ������ �߻��Ͽ����ϴ�");
			mysql_query("drop table $t_division"."_$table_name") or Error("�Խ����� Division ���̺� ���� ������ �߻��߽��ϴ�");
			mysql_query("drop table $t_comment"."_$table_name") or Error("�Խ����� �ڸ�Ʈ ���̺� ���� ������ �߻��Ͽ����ϴ�");
			mysql_query("drop table $t_category"."_$table_name") or Error("�Խ����� ī�װ� ���̺� ���� ������ �߻��Ͽ����ϴ�");
			mysql_query("update $group_table set board_num=board_num-1 where no='$group_no'");
		}
		@mysql_query("delete from $admin_table where group_no='$group_no'");
	}

	// �׷����
	@mysql_query("delete from $group_table where no='$group_no'") or Error("�׷������ ������ �߻��Ͽ����ϴ�");

	movepage("$PHP_SELF?sid=$sid");
}
// ���Ծ�� ����
elseif($exec=="modify_member_join_ok")                                                                      {
	mysql_query("update $group_table set join_level='$join_level',use_icq='$use_icq',use_aol='$use_aol',use_msn='$use_msn',
	use_jumin='$use_jumin',use_comment='$use_comment',use_job='$use_job',use_hobby='$use_hobby',
	use_home_address='$use_home_address',use_home_tel='$use_home_tel',use_office_address='$use_office_address',
	use_office_tel='$use_office_tel',use_handphone='$use_handphone',use_mailing='$use_mailing',
	use_birth='$use_birth',use_picture='$use_picture' where no='$group_no'") or error(mysql_error());
	movepage("$PHP_SELF?exec=modify_member_join&group_no=$group_no&sid=$sid");
}

?>