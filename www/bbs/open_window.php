<?
	if(!$mode||!$str) die("<script>window.close()</script>");
	if($mode!="i"&&$mode!="t"&&$mode!="tn") die("<script>window.close()</script>");

	include "lib.php";
	if(!$connect) $connect=dbconn();

	// ��� ���� ���ؿ���;;; ����� ������
	$member=member_info();

	// ���� �α��εǾ� �ִ� ����� ��ü, �Ǵ� �׷���������� �˻�
	if($member[is_admin]==1||$member[is_admin]==2||$member[group_no]==$setup[group_no]) $is_admin=1; else $is_admin="";

	if($is_admin&&($mode=="i"||$mode=="t")) $data = mysql_fetch_array(mysql_query("select * from $member_table where no='$str'"));

	mysql_close($connect);

	if(($mode=="i"||$mode=="t")&&$is_admin&&$data[user_id]) {
		if($mode=="i") {
			$href = "admin_setup_bac.php?exec=view_member&group_no=$data[group_no]&exec2=modify&no=$data[no]";
		} else {
			$href = "admin/trace.php?keykind[5]=ismember&keyword=$data[user_id]";
		}
	} elseif($mode=="tn"&&$is_admin&&$str) {
		$href = "admin/trace.php?keykind[0]=name&keyword=$str";
	}
?>

<script>
	location.href="<?=$href?>";
</script>
