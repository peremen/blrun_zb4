<?
// ���� �޼��� ���
function error($message, $url="") {
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<?
	if($url=="window.close") {
		$message=str_replace("<br>","\\n",$message);
		$message=str_replace("\"","\\\"",$message);
?>
<script>
	alert("<?=$message?>");
	window.close();
</script>
<?
	} else {
		include "error.php";
	}
	exit;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="image_src" href="../blrun2_fb.jpg">
<link rel=StyleSheet HREF=style.css type=text/css title=style>
</head>
<body topmargin='0' leftmargin='0' marginwidth='0' marginheight='0'>
<?
if(file_exists("myZrCnf2019.php")) error("�̹� myZrCnf2019.php�� �����Ǿ� �ֽ��ϴ�.<br><br>�缳ġ�Ϸ��� �ش� ������ ���켼��");
?>
<body bgcolor=#000000 text=#ffffff>
<script>
 function check_submit()
 {
  if(!write.hostname.value)
  {
   alert("HostName�� �Է��ϼ���");
   write.hostname.focus();
   return false;
  }
  if(!write.user_id.value)
  {
   alert("USER ID �� �Է��ϼ���");
   write.user_id.focus();
   return false;
  }
  if(!write.dbname.value)
  {
   alert("DB Name�� �Է��ϼ���");
   write.dbname.focus();
   return false;
  }
  return true;
 }
</script>
<br><br><br>
<div align=center>
<table cellpadding=0 cellspacing=0 width=600 border=0>
<tr>
	<td height=30 colspan=3><img src=images/inst_top.gif></td>
</tr>
<tr>
	<td>
	<br>
    <img src=images/inst_step2.gif>
	</td>
</tr>
<tr>
	<td>
	<br>
	<form name=write method=post action=install_ok.php onsubmit="return check_submit();">
	<table border=0 cellpadding=2 cellspacing=0>
	<tr>
		<td width=90 align=right style=font-family:Tahoma;font-size:9pt;>Host Name</td>
		<td width=90><input type=text name=hostname value='localhost' style=font-family:Tahoma;font-size:9pt;></td>
		<td width=300>MySQL DB�� ȣ��Ʈ������ �Է��ϼ���.</font></td>
	</tr>
	<tr>
		<td align=right style=font-family:Tahoma;font-size:9pt;>SQL User ID</td>
		<td><input type=text name=user_id style=font-family:Tahoma;font-size:9pt;></td>
		<td>MySQL������ ID�� �Է��ϼ���</font></td>
	</tr>
	<tr>
		<td align=right style=font-family:Tahoma;font-size:9pt;>Password</td>
		<td><input type=password name=password style=font-family:Tahoma;font-size:9pt;></td>
		<td>Mysql DB�� �н����带 �Է��ϼ���</font></td>
	</tr>
	<tr>
		<td align=right style=font-family:Tahoma;font-size:9pt;>DB Name</td>
		<td><input type=text name=dbname style=font-family:Tahoma;font-size:9pt;></td>
		<td>Mysql DB�� Name�� �Է��ϼ���</font></td>
	</tr>
	<tr>
		<td align=right style=font-family:Tahoma;font-size:9pt;>���ȼ��� URL</td>
		<td><input type=text name=sslurl style=font-family:Tahoma;font-size:9pt;></td>
		<td>���κ��� SSL ���ȼ��� ��ƮURL�� �Է�..<br>��) <b style="color:yellow">https://www.blrun.net:47006/bbs/</b> (���� / ����)</font></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan=2>���ȼ��� URL�� SNI ������ <b style="color:yellow">https://www.blrun.net/bbs/</b> �̳� ���ȼ��� �������� <b style="color:yellow">http://www.blrun.net/bbs/</b> ������ URL�� ���԰���.</td>
	<tr>
		<td colspan=3 align=center><br><br><input type=image src=images/inst_b_2.gif border=0 align=absmiddle></td>
	</tr>
	</form>
	</table>
	<br>
	</td>
</tr>
</table>
</body>
</html>