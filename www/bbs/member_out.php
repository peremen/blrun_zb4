<?
// ���̺귯�� �Լ� ���� ��ũ���
include "lib.php";

if(!preg_match("/member_modify.php/i",$HTTP_REFERER)) Error("����� �� ������ �Ͽ� �ֽñ� �ٶ��ϴ�");

// DB ����
if(!$connect) $connect=dbConn();

// ȸ�� ������ ����
$member=member_info();
$group_no = $member[group_no];

// ��� ���� ����
@mysql_query("delete from $member_table where no='$member[no]'") or error(mysql_error());

// ���� ���̺��� ��� ���� ����
@mysql_query("delete from $get_memo_table where member_no='$member[no]'") or error(mysql_error());
@mysql_query("delete from $send_memo_table where member_no='$member[no]'") or error(mysql_error());

// ���� �Խ��ǿ��� ���� Ż���� ����� ��� ������ ���� (���� ������ ���ؼ� �ּ� ó��)
/*
$result=mysql_query("select name from $admin_table");
while($data=mysql_fetch_array($result)) {
	// �Խ��� ���̺��� ����
	@mysql_query("update $t_board"."_$data[name] set ismember='0', password=password('".time()."') where ismember='$member[no]'") or error(mysql_error());
	// �ڸ�Ʈ ���̺��� ����
	@mysql_query("update $t_comment"."_$data[name] set ismember='0', password=password('".time()."')  where ismember='$member[no]'") or error(mysql_error());
}
*/

// �׷����̺��� ȸ���� -1
@mysql_query("update $group_table set member_num=member_num-1 where no = '$group_no'") or error(mysql_error());

// �α׾ƿ� ��Ŵ
destroyZBSessionID($member[no]);

// 5.3 �̻�� ���� ó��
$_SESSION['zb_logged_no']='';
$_SESSION['zb_logged_time']='';
$_SESSION['zb_logged_ip']='';
$_SESSION['zb_secret'];
$_SESSION['zb_last_connect_check']='0';
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script>
alert("���������� Ż�� �Ǿ����ϴ�.");
//opener.reload();
window.close();
</script>
