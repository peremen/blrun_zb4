<?
/*********************************************************************
* ȸ�� ���� ���濡 ���� ó��
*********************************************************************/

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


// ȸ����ü �����ϴ� �κ�

if($exec2=="deleteall"&&$member[is_admin]<3) {
	for($i=0;$i<sizeof($cart);$i++) {
		del_member($cart[$i]);
	}
	movepage("$PHP_SELF?exec=view_member&group_no=$group_no&page=$page&keyword=$keyword&keykind=$keykind&like=$like&level_search=$level_search&page_num=$page_num&sid=$sid");
}


// ȸ�� �Խ��� ���� ��ҽ�Ű�� �κ�

if($exec2=="modify_member_board_manager"&&$member[is_admin]<3) {

	$_temp=mysql_fetch_array(mysql_query("select * from $member_table where no = '$member_no'",$connect));

	$__temp = preg_split("/,/",$_temp[board_name]);

	$_st = "";

	for($u=0;$u<count($__temp);$u++) {
		$kk=trim($__temp[$u]);
		if($kk&&$kk!=$board_num&&isnum($kk)) $_st.=$kk.",";
	}

	mysql_query("update $member_table set board_name = '$_st' where no='$member_no'",$connect) or error(mysql_Error());

	movepage("$PHP_SELF?exec=view_member&exec2=modify&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&no=$member_no&keykind=$keykind&like=$like&sid=$sid");
}


// ȸ�� �Խ��� ���� �߰���Ű�� �κ�

if($exec2=="add_member_board_manager"&&$member[is_admin]<3) {

	$_temp=mysql_fetch_array(mysql_query("select * from $member_table where no = '$member_no'",$connect));
	$_board_name = $_temp[board_name].$board_num.",";

	mysql_query("update $member_table set board_name = '$_board_name' where no='$member_no'",$connect) or error(mysql_Error());

	movepage("$PHP_SELF?exec=view_member&exec2=modify&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&no=$member_no&keykind=$keykind&like=$like&sid=$sid");
}


// ȸ�� ���� �����ϴ� �κ�

if($exec2=="moveall"&&$member[is_admin]==1) {
	for($i=0;$i<sizeof($cart);$i++) {
		mysql_query("update $member_table set level='$movelevel' where no='$cart[$i]'",$connect);
	}
	movepage("$PHP_SELF?exec=view_member&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&keykind=$keykind&like=$like&sid=$sid");
}


// ȸ�� �׷� �����ϴ� �κ�

if($exec2=="move_group"&&$member[is_admin]==1) {
	for($i=0;$i<sizeof($cart);$i++) {
		mysql_query("update $member_table set group_no='$movegroup' where no='$cart[$i]'",$connect);
		mysql_query("update $group_table set member_num=member_num-1 where no='$group_no'");
		mysql_query("update $group_table set member_num=member_num+1 where no='$movegroup'");
	}
	movepage("$PHP_SELF?exec=view_member&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&keykind=$keykind&like=$like&sid=$sid");
}


// ȸ�������ϴ� �κ�

if($exec2=="del"&&$member[is_admin]<3) {
	del_member($no);
	movepage("$PHP_SELF?exec=view_member&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&keykind=$keykind&like=$like&sid=$sid");
}


// ȸ������ �����ϴ� �κ�
preg_match('/[0-9a-zA-Z.\@\_]+/',$email,$result); //Ư�����ڰ� ������ ����
if($result[0]!=$email) Error("E-mail ���ڸ� Ȯ���ϼ���(�����ڿ� ����, ., @, _���� ���!)","");
$email=addslashes($email);
$member_data = mysql_fetch_array(mysql_query("select email from $member_table where no = '$member_no'"));
// email IP ǥ�� �ҷ��� ó��
unset($c_match);
if(preg_match("#(\|\|\|)([0-9.]{1,})$#",$member_data[email],$c_match))
	$email.=$c_match[1].$c_match[2];
$homepage=addslashes($homepage);
$icq=addslashes($icq);
$aol=addslashes($aol);
$msn=addslashes($msn);
$hobby=addslashes($hobby);
$job=addslashes($job);
$home_address=addslashes($home_address);
$home_tel=addslashes($home_tel);
$office_address=addslashes($office_address);
$office_tel=addslashes($office_tel);
$handphone=addslashes($handphone);
$comment=addslashes($comment);

if($exec2=="modify_member_ok") {
	// POST ����� �ƴ� ��� ����
	if($_SERVER['REQUEST_METHOD']!='POST') die("���������� �����̶� ���ܵ˴ϴ�");

	if($member[is_admin]>1) Error("ȸ���������� ������ �����ϴ�");
	if(isblank($name)) Error("�̸��� �Է��ϼž� �մϴ�");

	if($password&&$password1&&$password!=$password1) Error("��й�ȣ�� ��ġ���� �ʽ��ϴ�");

	$birth=mktime(0,0,0,$birth_2,$birth_3,$birth_1);

	if($member[no]==$member_no) {
		$is_admin = $member[is_admin];
		$level = $member[level];
	}

	if(!get_magic_quotes_gpc()) {
		$password = addslashes($password);
		$password1 = addslashes($password1);
	}

	$que="update $member_table set name='$name'";

	if($level) $que.=",level='$level'";
	if($password&&$password1&&$password==$password1) $que.=" ,password=password('$password') ";
	if($member[is_admin]==1) $que.=",is_admin='$is_admin'";
	if($birth_1&&$birth_2&&$birth_3) $que.=",birth='$birth'";
	$que.=",email='$email'";
	$que.=",homepage='$homepage'";
	$que.=",icq='$icq'";
	$que.=",aol='$aol'";
	$que.=",msn='$msn'";
	$que.=",hobby='$hobby'";
	$que.=",job='$job'";
	$que.=",home_address='$home_address'";
	$que.=",home_tel='$home_tel'";
	$que.=",office_address='$office_address'";
	$que.=",office_tel='$office_tel'";
	$que.=",handphone='$handphone'";
	$que.=",mailing='$mailing'";
	$que.=",openinfo='$openinfo'";
	$que.=",comment='$comment'";
	$que.=" where no='$member_no'";

	@mysql_query($que) or Error("ȸ������ �����ÿ� ������ �߻��Ͽ����ϴ� ".mysql_error());

	// ȸ���� �Ұ� ����
	if($_FILES[picture]) {
		$picture = $_FILES[picture][tmp_name];
		$picture_name = $_FILES[picture][name];
		$picture_type = $_FILES[picture][type];
		$picture_size = $_FILES[picture][size];
	}
	if($picture_name) {
		// Ư�����ڰ� ������ ����
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$picture_name,$result);
		if($result[0]!=$picture_name) Error("���� ���ϸ��� �ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!");

		if(!is_uploaded_file($picture)) Error("�������� ������� ���ε��Ͽ� �ֽʽÿ�");
		if(!preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$picture_name)) Error("������ jpg(jpeg)/png/gif/bmp ������ �÷��ּ���!");
		$size=GetImageSize($picture);
		if($size[0]>480||$size[1]>480) Error("������ ũ��� 480*480���Ͽ��� �մϴ�!");
		$kind=array("","jpg","jpeg","png","gif","bmp");
		$n=$size[2];
		$path="icon/member_".time().".".$kind[$n];
		@move_uploaded_file($picture,$path);
		@chmod($path,0707);
		@mysql_query("update $member_table set picture='$path' where no='$member_no'") or Error("���� �ڷ� ���ε�� ������ �߻��Ͽ����ϴ�");
	}

	// �̹��� �ڽ� �뷮�� ����
	if($maxdirsize<>100) {
		$maxdirsize = $maxdirsize * 1024;
		// icon ���丮�� member_image_box ���丮�� ������� ���丮 ����
		$path = "icon/member_image_box";
		if(!is_dir($path)) {
			@mkdir($path,0707,true);
			@chmod($path,0707);
		}

		zWriteFile("icon/member_image_box/".$member_no."_maxsize.php","<?/*".$maxdirsize."*/?>");
	}

	// �̸��տ� �ٴ� ������ ������
	if($delete_private_icon) @z_unlink("icon/private_icon/".$member_no.".gif");

	if($_FILES[private_icon]) {
		$private_icon = $_FILES[private_icon][tmp_name];
		$private_icon_name = $_FILES[private_icon][name];
		$private_icon_type = $_FILES[private_icon][type];
		$private_icon_size = $_FILES[private_icon][size];
	}
	// �̸��տ� �ٴ� ������ ���ε�� ó��
	if(@filesize($private_icon)) {
		if(!is_dir("icon/private_icon")) {
			@mkdir("icon/private_icon",0707,true);
			@chmod("icon/private_icon",0707);
		}

		// �ѱ۹��ڰ� ������ ����
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$private_icon_name,$result);
		if($result[0]!=$private_icon_name) Error("������ ���ϸ��� �ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!");

		if(!is_uploaded_file($private_icon)) Error("�������� ������� ���ε��Ͽ� �ֽʽÿ�");
		if(!preg_match("/\.gif$/i",$private_icon_name)) Error("�̸����� �������� Gif ���ϸ� �ø��Ǽ� �ֽ��ϴ�");
		$size=GetImageSize($private_icon);
		if($size[0]>16||$size[1]>16) Error("�������� ũ��� 16*16���Ͽ��� �մϴ�");

		@move_uploaded_file($private_icon, "icon/private_icon/".$member_no.".gif");
		@chmod("icon/private_icon".$member_no.".gif",0707);
		@chmod("icon/private_icon",0707);
	}

	// �̸��� ����ϴ� ������ ������
	if($delete_private_name) @z_unlink("icon/private_name/".$member_no.".gif");

	// �̸��� ����ϴ� ������ ���ε�� ó��
	if($_FILES[private_name]) {
		$private_name = $_FILES[private_name][tmp_name];
		$private_name_name = $_FILES[private_name][name];
		$private_name_type = $_FILES[private_name][type];
		$private_name_size = $_FILES[private_name][size];
	}
	if(@filesize($private_name)) {
		if(!is_dir("icon/private_name")) {
			@mkdir("icon/private_name",0707,true);
			@chmod("icon/private_name",0707);
		}

		// �ѱ۹��ڰ� ������ ����
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$private_name_name,$result);
		if($result[0]!=$private_name_name) Error("�̸��� ����ϴ� ������ ���ϸ��� �ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!");

		if(!is_uploaded_file($private_name)) Error("�������� ������� ���ε��Ͽ� �ֽʽÿ�");
		if(!preg_match("/\.gif$/i",$private_name_name)) Error("�̸��� ����ϴ� �������� Gif ���ϸ� �ø��Ǽ� �ֽ��ϴ�");
		$size=GetImageSize($private_name);
		if($size[0]>60||$size[1]>16) Error("�̸��� ����ϴ� �������� ũ��� 60*16���Ͽ��� �մϴ�");

		@move_uploaded_file($private_name, "icon/private_name/".$member_no.".gif");
		@chmod("icon/private_name".$member_no.".gif",0707);
		@chmod("icon/private_name",0707);
	}
	// ������ �ڽ��� ��й�ȣ ����� ������ ��Ű�� �����Ͽ� ��
	//if($member_no==$member[no]&&$password&&$password1&&$password==$password1) {
		//$password=mysql_fetch_array(mysql_query("select password('$password')"));
		//setcookie("zetyxboard_userid",$member[user_id],'',"/");
		//setcookie("zetyxboard_password",$password[0],'',"/");
	//}

	movepage("$PHP_SELF?exec=view_member&exec2=modify&no=$member_no&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&keykind=$keykind&like=$like&sid=$sid");
}
?>