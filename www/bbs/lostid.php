<?
	include "lib.php";

	// �������� E-mail
	$_from = $_zbDefaultSetup[email];

	// ����Ʈ �ּ�
	$_homepage = $_zbDefaultSetup[url];

	// ����Ʈ �̸�
	$_sitename = $_zbDefaultSetup[sitename];

	if(!$_from||!$_homepage||!$_sitename) error("������ ������ �ԷµǾ� ���� �ʽ��ϴ�.<br>setup.php ������ �����ڰ� �����Ͽ��� �մϴ�");

	head();
?>

<div align=center>

<script>
function check_submit()
{
 if(!lostid.email.value) {alert("E-Mail�� �Է��Ͽ� �ֽʽÿ�"); lostid.email.focus(); return false; }
 if(!lostid.jumin1.value) {alert("�ֹε�Ϲ�ȣ�� �Է��Ͽ� �ֽʽÿ�"); lostid.jumin1.focus(); return false; }
 if(!lostid.jumin2.value) {alert("�ֹε�Ϲ�ȣ�� �Է��Ͽ� �ֽʽÿ�"); lostid.jumin2.focus(); return false; }
 return confirm("ID/Password�� E-Mail�� �޾ƺ��ðڽ��ϱ�?");
}
</script>
<form method=post action=lostid_search.php onsubmit="return check_submit()" name=lostid>
<table border=0 cellpadding=3>
<tr>
	<td>
	<table border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=white>
	<tr>
		<td><img src=images/lo_title.gif borrder=0 height=32></td>
		<td width=100% background=images/lo_back.gif><img src=images/lo_back.gif height=32 border=0></td>
		<td><img src=images/lo_right.gif height=32 border=0></td>
	</tr>
	</table>
	<table border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=white>
	<col width=7></col><col width=></col><col width=7>
	<tr> 
		<td><img src=images/t.gif border=0 width=7></td>
		<td>
			<table border=0 cellspacing=0 cellpadding=3>
			<tr>
				<td style=line-height:160% colspan=2 style=padding:5px>
					ȸ���Ե鲲�� ���̵� ��й�ȣ�� �н��Ͽ����� ȸ������ E-MAIL�� ���̵�� ��й�ȣ�� �����帳�ϴ�.<br>
					�̶� ��й�ȣ�� DB�� ��ȣȭ �Ǿ� ������ �Ǳ� ������ �˼��� ����, ���Ƿ� ��й�ȣ�� �ٲپ �����帳�ϴ�<br>
					<img src=images/t.gif border=0 height=4><br>
					<center>
					<img src=images/lo_email.gif border=0 align=absmiddle>&nbsp;<input type=text name=email size=17 class=input><br>
					<img src=images/lo_jumin.gif border=0 align=absmiddle>&nbsp;<input type=text name=jumin1 size=6 class=input maxlength=6> - <input type=password name=jumin2 size=7 class=input maxlength=7></td>
			</tr>
			<tr>
				<td colspan=2 align=right>
					<input type=image src=images/lo_ok.gif border=0>
					<a href=# onclick=window.close()><img src=images/lo_close.gif border=0>
				</td>
			</tr>
			</table>
		</td>
		<td><img src=images/t.gif border=0 width=7></td>
	</tr>
</form>
	</table>
	</td>
</tr>
</table>
<img src=images/t.gif border=0 height=5><br>
<?
	@mysql_close($connect);
	foot();
?>
