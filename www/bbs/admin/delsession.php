<?
	header("Content-Type: text/html; charset=EUC-KR");

	set_time_limit (0);

	$_zb_path="../";

	include "../lib.php";

	$connect=dbconn();

	$member=member_info();

	if(!$member[no]||$member[is_admin]>1||$member[level]>1) Error("�ְ� �����ڸ��� ����Ҽ� �ֽ��ϴ�");

	// ���� ����
	if($exec=="delete") {

		$i=0;
		$path = "../".$_zbDefaultSetup[session_path];
		$directory = dir($path);
		while($entry = $directory->read()) {
			if ($entry != "." && $entry != "..") {
				if(!eregi(session_id(), $entry)&&!eregi($HTTP_COOKIE_VARS[ZBSESSIONID], $entry)) {
					z_unlink($path."/".$entry);
					$i++;
					if($i%100==0) print(".");
					flush();
				}
			}
		}
		print("\n\n<script>\nalert('���� ���丮�� �����Ͽ����ϴ�');\nwindow.close();\n</script>");
		exit();
	}

	head(" bgcolor=white");
?>
<div align=center>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=98%>
<tr>
  <td><img src=../images/session_title.gif border=0></td>
  <td width=100% background=../images/trace_back.gif><img src=../images/trace_back.gif border=0></td>
  <td><img src=../images/trace_right.gif border=0></td>
</tr>
<tr>
  <td colspan=3 style=padding:15px;line-height:160%>
  	�� �������� ȸ�� �α��ε �ʿ��� ���� ���丮�� �����ϴ� ���Դϴ�.<br>
	������ ��� �����ϸ� ���� �α����� ȸ���� �α׾ƿ��� �Ǹ�, �ڵ� �α����� ������ ȸ������ ���<br>
	�ڵ��α����� ��Ұ� �˴ϴ�<br>
	������  ���� ���丮�� ������ �������� ��ü���� �ý��� ȿ������ ����߸��Ƿ�,<br>
	�Ʒ� ��Ȳ�� �ľ��� ���ð� �ѹ��� ����ֽô� ���� �����ϴ�<br>
  </td>
</tr>
</table>
</div>
<?flush()?>

	<div align=center>
	<form name=sdc action=<?=$PHP_SELF?> method=post>
	<input type=hidden name=exec value=delete>
	<table border=0 cellspacing=1 cellpadding=4 width=300 bgcolor=bbbbbb>
	<col width=40></col><col width=></col>
	<tr bgcolor=eeeeee>
		<td colspan=2 align=center><b>Session diectory checking...</b></td>
	</tr>
	<tr bgcolor=white>
		<td align=center>����</td><td><input type=input name=num value="" size=30 style=border:0;height:18px></td>
	</tr>
	<tr bgcolor=white>
		<td align=center>�뷮</td><td><input type=input name=size value="" size=30 style=border:0;height:18px></td>
	</tr>
	<tr bgcolor=cccccc>
		<td align=center colspan=2><input type=submit value="���� ���� ����" class=submit></td>
	</tr>
	</table>
	</form>
	<script>
<?
	
	// ��ü ���� ����� ����
	unset($list);
	$path = "../".$_zbDefaultSetup[session_path];
	$directory = dir($path);
	$i=0;
	$totalsize = 0;
	while($entry = $directory->read()) {
		if ($entry != "." && $entry != "..") {
			$list[] = $entry;
			$i++;
			$totalsize += filesize($path."/".$entry);
			if($i%100==0) {
				print "document.sdc.num.value='".$i." ��';\n";
				print "document.sdc.size.value='".getfilesize($totalsize)."';\n";
			}
			flush();
		}
	}
	$directory->close();
	print "document.sdc.num.value='".number_format($i)." ��';\n";
	print "document.sdc.size.value='".getfilesize($totalsize)."';\n";

	$totallist = count($list);
?>
	</script>
	</div>
<?
 mysql_close($connect);
 $connect="";
?>

<br><Br><Br>

<?
 foot();
?>
