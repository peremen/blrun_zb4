<?
	include "lib.php";
	head();

	if(file_exists("myZrCnf2019.php")) error("�̹� myZrCnf2019.php�� �����Ǿ� �ֽ��ϴ�.<br><br>�缳ġ�Ϸ��� �ش� ������ ���켼��");
?>
<body bgcolor=#000000 text=#ffffff>
<script>
function check_submit() {
	if(!document.license.accept.checked) {
		alert("���̼����� �����ð� �����Ͻô� �и� ���κ��带 ����ϽǼ� �ֽ��ϴ�.\n\n���̼����� ��� �������� ���̼����� �����Ͻø� üũ�� �Ͻ��� ��ġ�����ϼ���");
		return false;
	}
	return true;
}

function check_view() {
	if(document.license.accept.checked) {
		if(confirm("���̼����� ��� �����ð� ���Ǹ� �Ͻʴϱ�?")) {
			return true;
		} else {
			return false;
		}
	}
}
</script>
<br><br><br>
<div align=center>
<form name=license>
<table cellpadding=3 cellspacing=0 width=600 border=0>
<tr>
  <td height=30 colspan=3><img src=images/inst_top.gif></td>
</tr>
<tr>
  <td><br>
    <img src=images/inst_step1.gif>
    <textarea cols=90 rows=15 readonly><? include "license.txt"; ?></textarea>
	<br>
	<input type=checkbox name=accept value=1 onclick="return check_view()"> ���� ���̼����� ��� �о����� �����մϴ�
  </td>
</tr>
</form>
<tr>
  <td><br>
    <img src=images/inst_step1-2.gif><br><br><br><div align=center>
<?
  if(fileperms(".")==16839||fileperms(".")==16895) $check="1";
  if(!$check) echo"<font color=red>���� 707�� �۹̼��� �Ǿ� ���� �ʽ��ϴ�. �ڳ��̳� FTP���� �۹̼��� �����ϼ���.<font><br><br>
                   <div align=center><table border=0><tr><form method=post action=$PHP_SELF><td align=center height=30><input type=submit value='�۹̼� �����Ͽ����ϴ�' style=height:20px;></td></tr></table>";
  else echo"<br><br><div align=center><table border=0><tr><form method=post action=install1.php onsubmit='return check_submit()'><td align=center height=30><input type=image src=images/inst_b_1.gif border=0 align=absmiddle></td></tr></table>";
?>
  <br>
  </td>
</tr>
</form>
</table>

<?
	foot();
?>
