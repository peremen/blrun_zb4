<?
include "lib.php";

if(!$id&&!$group_no) Error("�Խ��� �̸��̳� �׷��ȣ�� �����Ͽ� �ּž� �մϴ�.<br><br>(login.php?id=�Խ����̸�   �Ǵ�  login.php?group_no=��ȣ)","");

$connect=dbConn();

// ���� �Խ��� ���� �о� ����
if($id) {
	$setup=get_table_attrib($id);

	// �������� ���� �Խ����϶� ���� ǥ��
	if(!$setup[name]) Error("�������� ���� �Խ����Դϴ�.<br><br>�Խ����� ������ ����Ͻʽÿ�","");

	// ���� �Խ����� �׷��� ���� �о� ����
	$group=group_info($setup[group_no]);
	$dir="skin/".$setup[skinname];
	$file="skin/".$setup[skinname]."/login.php";

} else {

	if($group_no) $group=mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));
	if(!$group[no]) Error("������ �׷��� �������� �ʽ��ϴ�");
}

head();
?>

<script>
 function check_submit()
 {
  if(!login.user_id.value)
  {
   alert("���̵� �Է��Ͽ� �ּ���");
   login.user_id.focus();
   return false;
  }
  if(!login.password.value)
  {
   alert("��й�ȣ�� �Է��Ͽ� �ּ���");
   login.password.focus();
   return false;
  }
  check=confirm("�ڵ� �α��� ����� ����Ͻðڽ��ϱ�?\n\n�ڵ� �α��� ���� ���� ���Ӻ��ʹ� �α����� �Ͻ��ʿ䰡 �����ϴ�.\n\n��, ���ӹ�, �б��� ������ҿ��� �̿�� ���������� ����ɼ� ������ �����Ͽ� �ֽʽÿ�");
  if(check) {login.auto_login.value=1;}
  return true;
 }
</script>

<form method=post action=login_check.php onsubmit="return check_submit();" name=login>
<input type=hidden name=auto_login value=<?if(!$autologin[ok])echo "0"; else echo "1"?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=sm value="<?=$sm?>">
<input type=hidden name=mode value="<?=$mode?>">
<input type=hidden name=s_url value="<?=$s_url?>">
<input type=hidden name=referer value="<?=$referer?>">

<?
if($id) include $file;
?>
</form>
<?
foot();
@mysql_close($connect);
?>