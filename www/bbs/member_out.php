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

// ���� ���� ó�� (4.0x�� ���� ó���� ���Ͽ� �ּ� ó��)
//$HTTP_SESSION_VARS["zb_logged_no"]='';
//$HTTP_SESSION_VARS["zb_logged_id"]='';
//$HTTP_SESSION_VARS["zb_logged_time"]='';
//$HTTP_SESSION_VARS["zb_logged_ip"]='';
//$HTTP_SESSION_VARS["zb_secret"]='';
//$HTTP_SESSION_VARS["zb_last_connect_check"] = '0';

// 4.0x �� ���� ó��
$zb_logged_no='';
$zb_logged_time='';
$zb_logged_ip='';
$zb_secret='';
$zb_last_connect_check = '0';
session_register("zb_logged_no");
session_register("zb_logged_time");
session_register("zb_logged_ip");
session_register("zb_secret");
session_register("zb_last_connect_check");

mysql_close($connect);
?>
<script>
alert("���������� Ż�� �Ǿ����ϴ�.");
//opener.window.history.go(0);
window.close();
</script>
