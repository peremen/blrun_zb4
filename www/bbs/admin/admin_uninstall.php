<?
	if($exec=="uninstall"&&$uninstall=="ok"&&$member[is_admin]==1) {
		if(!$u_hostname) Error("Hostname�� �Է��ϼ���");
		if(!$u_userid) Error("User ID�� �Է��ϼ���");
		if(!$u_password) Error("Password�� �Է��ϼ���");
		if(!$u_dbname) Error("DB Name�� �Է��ϼ���");

		mysql_close($connect);

		$connect = @mysql_connect($u_hostname,$u_userid,$u_password) or error(mysql_error());
		@mysql_select_db($u_dbname) or Error(mysql_error());
		
		$result = mysql_query("show table status from $u_dbname like 'zetyx%'",$connect) or error(mysql_error());
		while($data=mysql_fetch_array($result)) {
			mysql_query("drop table $data[Name]");
		}

		zRmDir("./data");
		zRmDir("./icon");
		z_unlink("./myZrCnf2019.php");

		error("���κ��尡 �������� ������ ���ŵǾ����ϴ�","install.php"); 
		exit();
	}
?>


<table border=0 cellspacing=0 cellpadding=10 bgcolor=eeeeee width=100% height=100%>
<form name=uninstall method=post onsubmit="return confirm('�����Ͻðڽ��ϱ�?')">
<input type=hidden name=exec value="uninstall">
<input type=hidden name=uninstall value="ok">
<tr>
	<td valign=top style=line-height:160% align=center>
	<br>
	<font size=4 color=black><b>���κ��� ����</b><br></font>
	<br>
	<font color=black>
	<table border=0>
	<tr>
		<td style=line-height:160%;color=black>
			���κ��带 �����Ͻñ� ���� �� DB ����� �Ͻñ� �ٶ��ϴ�.<br>
			����� <b>DB ���</b> ��ư�� ������ ���� ���κ����� ��� ���̺��� ��� �����Ǽ� �ֽ��ϴ�.<br>
			����� �����̴ٸ� �Ʒ��� DB ������ �Է��Ͻð� Ȯ�� ��ư�� �����ø� ���κ���� ���Ű� �˴ϴ�.<br>
			���κ��� ���Ž� DB�� ������ data, icon, myZrCnf2019.php ���� ���ϱ��� ��� ������ �˴ϴ�.<br>
		</td>
	</tr>
	</table>
	<br>
	<table border=0 cellspacing=1 cellpadding=3 bgcolor=777777>
	<tr>
		<td bgcolor=555555 align=right style=font-family:tahoma;font-size:8pt;color:white width=100><b>Hostname&nbsp;</td>
		<td bgcolor=f3f3f3><input type=input name=u_hostname value="" class=input size=20></td>
	</tr>
	<tr>
		<td bgcolor=555555 align=right style=font-family:tahoma;font-size:8pt;color:white width=100><b>User ID&nbsp;</td>
		<td bgcolor=f3f3f3><input type=input name=u_userid value="" class=input size=20></td>
	</tr>
	<tr>
		<td bgcolor=555555 align=right style=font-family:tahoma;font-size:8pt;color:white width=100><b>Password&nbsp;</td>
		<td bgcolor=f3f3f3><input type=password name=u_password value="" class=input size=20></td>
	</tr>
	<tr>
		<td bgcolor=555555 align=right style=font-family:tahoma;font-size:8pt;color:white width=100><b>DB Name&nbsp;</td>
		<td bgcolor=f3f3f3><input type=input name=u_dbname value="" class=input size=20></td>
	</tr>
	<tr>
		<td colspan=2 bgcolor=555555 align=center><input type=submit value="    Ȯ        ��    " style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;></td>
	</tr>
	</table>
	</td>
</tr>
</form>
</table>
