
<tr>
<!--�������� -->
  <td colspan=2 height=1 background=<?=$dir?>/dot_line.gif></td>
</tr>
</table>
<?
$pass = $_POST["pwd"];
$pass = stripslashes($pass);

if($pass == "gg" || $member[no] || $data[is_secret] != 0) {

	//������ �� ���ڸ� �߻�(1-8) �� ���Ǻ����� ����
	$num1 = rand(1,8);
	$num2 = rand(1,8);
	$num1num2 = $num1*10 + $num2;
	session_register("num1num2");
	//�ڸ�Ʈ ������ ���� ���Ǻ����� ����
	$ZBRD_SS_VRS = $num1num2;
	session_register("ZBRD_SS_VRS");

	//�̸�����, �׸�â��, �ڵ���� ��ư ���̰� �ϱ�
	$box_view=true;

?>
<form method=post name=write action=comment_ok.php onsubmit="return check_submit();" enctype=multipart/form-data>
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
<input type=hidden name=mode value="write">
<input type=hidden name=antispam value="<?=$num1num2?>"> 

<div align=center>
<table border=0 cellspacing=1 cellpadding=0 width=<?=$width?> class=zv3_viewform>
<tr>
  <td>
    <table border=0 cellspacing=0 cellpadding=4 width=100% height=100>
    <col width=80></col><col width=></col><col width=80></col>
    <tr>
      <td align=center style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><img src=images/t.gif border=0 width=80 height=1><br><b>Option</b></td>
      <td style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><?=$hide_html_start?> <input type=checkbox name=use_html2<?=$use_html2?>>HTML���<?=$hide_html_end?><?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1>��б�<?=$hide_secret_end?></td>
      <td width=80>&nbsp;</td>
    </tr>
    <tr align=center> 
<!--�ڸ�Ʈ �̸�, ���, ���� ����-->
      <td height=20 style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><img src=images/t.gif border=0 width=80 height=1><br><b>�̸�</b></td>
      <td style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><b>�ڸ�Ʈ</b> &nbsp;&nbsp;&nbsp; <img src=<?=$dir?>/btn_down.gif border=0 valign=absmiddle style=cursor:pointer; onclick=zb_formresize(document.write.memo)></td>
      <td>&nbsp;</td>
    </tr>
    <tr align=center valign=top>
      <td nowrap height=80><? $c_name=stripslashes($c_name); echo $c_name; ?><?=$hide_c_password_start?><br><img src=images/t.gif border=0 height=10><br><font style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><b>�н�����</b></font><br><img src=images/t.gif border=0 height=5><br><input type=password name=password <?=size(8)?> maxlength=20 class=zv3_input><?=$hide_c_password_end?></td>
      <td>
        <table border=0 cellspacing=2 cellpadding=0 width=100% height=100 style=table-layout:fixed>
        <tr><td width=100% valign=top>
          <textarea id=memo name=memo <?=size(40)?> rows=8 class=zv3_textarea style=width:100% onkeydown='return doTab(event);'></textarea></td>
        </tr>
        </table>
      </td>
      <td><input type=submit rows=5 <?if($browser){?>class=zv3_submit<?}?> value='�ۼ��Ϸ�' accesskey="s"></td>
    </tr>
    </table>
    <table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
    <col width=6%></col><col width=44%></col><col width=6%></col><col width=44%>
    <tr valign=top>
<?=$hide_pds_start?>

      <td width=52 align=right><font class=zv3_comment>Upload #1</font></td>
      <td class=zv3_comment><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
      <td width=52 align=right><font class=zv3_comment>Upload #2</font></td>
      <td class=zv3_comment><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
<?=$hide_pds_end?>

    </tr>
    </table>
  </td>
</tr>
</table>
</form>
</div>
<?
} else {
?>
<script language="javascript">
<!--
function sendit() {
	//�н�����
	if(document.myform.pwd.value=="") {
		alert("�н����带 �Է��� �ֽʽÿ�");
		return false;
	}
	document.myform.submit();
}
-->
</script>
<img src=<?=$dir?>/t.gif border=0 height=4><br>
<form name="myform" method="post" action=<?=$PHP_SELF?> enctype=multipart/form-data>
<input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>">
<table width=<?=$width?> height="120" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" align="center">
<tr>
	<td>
		<table width="320" height="70" border="1" style="border-collapse:collapse;" bordercolor="black" bgcolor="#BEEBDD" cellpadding="1" align="center">
		<tr><td height="45" align="center"><b><span style="font-size:11pt">���� �ޱ�!!<br>���Թ��� ���(<font color="red">gg</font>)�� �Է�: </span></b><input type="password" name="pwd" size="20"></td>
		</tr>
		<tr><td height="25" align="center"><input type="button" value="Ȯ��" onClick="javascript:sendit();">
		<tr>
		</table>
	</td>
</tr>
</table>
</form>
<? } ?>