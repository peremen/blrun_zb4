<?
/***************************************************************************
* ���� ���� include
**************************************************************************/
include "_head.php";

if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)||!$_SESSION['DEL_COMM_SEC']||$_SESSION['DEL_COMM_SEC']!=$delsec) Error("���������� ���� �����Ͽ� �ֽñ� �ٶ��ϴ�.");

/***************************************************************************
* �ڸ�Ʈ ���� ����
**************************************************************************/

// �н����� addslashes
if(!get_magic_quotes_gpc()) {
	$password = addslashes($password);
}

// �н����带 ��ȣȭ
if($password) {
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];   
}

// �������� ������
$s_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where no='$c_no'"));

// ȸ���϶��� Ȯ��;;
if(!$is_admin&&$member[level]>$setup[grant_delete]) {
	if(!$s_data[ismember]) {
		if($s_data[password]!=$password) Error("��й�ȣ�� �ùٸ��� �ʽ��ϴ�");
	} else {
		if($s_data[ismember]!=$member[no]) Error("��й�ȣ�� �Է��Ͽ� �ֽʽÿ�");
	}
}

// �ڸ�Ʈ ����
mysql_query("delete from $t_comment"."_$id where no='$c_no'") or error(mysql_error());

// ���ϻ���
@z_unlink("./".$s_data[file_name1]);
@z_unlink("./".$s_data[file_name2]);
// �� ���� ���� ����
if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name1],$out))
	if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name2],$out))
	if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);

// �ڸ�Ʈ ���� ����
$total=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where parent='$no'"));
mysql_query("update $t_board"."_$id set total_comment='$total[0]' where no='$no'")  or error(mysql_error()); 

// ȸ���� ��� �ش� �ؿ��� ���� �ֱ�
if($member[no]==$s_data[ismember]) @mysql_query("update $member_table set point2=point2-1 where no='$member[no]'",$connect) or error(mysql_error());

// ������ ���� ���Ǻ��� ����
unset($_SESSION['DEL_COMM_SEC']);

// ������ �̵�
if($setup[use_alllist]) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category");
else movepage("view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category");
?>