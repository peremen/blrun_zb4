<?
if($mode=="reply") $title="��� ����";
elseif($mode=="modify") $title="�� �����ϱ�";
else $title="���� �� ����";

$a_preview = str_replace(">","><font class=list_eng>",$a_preview)."&nbsp;&nbsp;";
$a_imagebox = str_replace(">","><font class=list_eng>",$a_imagebox)."&nbsp;&nbsp;";
$a_codebox = str_replace(">","><font class=list_eng>",$a_codebox)."&nbsp;&nbsp;";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function zb_formresize(obj) {
	obj.rows += 4;
}
// -->
</SCRIPT>

<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0 style=table-layout:fixed>
<form method=post id=write name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name="page" value="<?=$page?>"><input type=hidden name="id" value="<?=$id?>"><input type=hidden name=no value="<?=$no?>"><input type=hidden name=select_arrange value="<?=$select_arrange?>"><input type=hidden name=desc value="<?=$desc?>"><input type=hidden name=page_num value="<?=$page_num?>"><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>"><input type=hidden name=wantispam value="<?=$wnum1num2?>">
<col width=80 align=right style="padding-right:10px;height:28px" class=list1></col><col class=list0 style="padding-left:10px;height:28px" width=></col>
<tr class=title>
	<td colspan=2 class=title_han align=center>&nbsp;&nbsp;<?=$title?></td>
</tr>
<?=$hide_start?>

<tr>
	<td width=80 align=right><font class=list_eng><b>Name</b></font></td>
	<td align=left><input type=text id=name name=name value="<?=$name?>" <?=size(20)?> maxlength=20 onkeyup="ajaxLoad2()" title="�̸��� ����� ���Է��ϸ� �ӽ������� ������"></td>
</tr>
<tr>
	<td align=right><font class=list_eng><b>Password</b></font></td>
	<td align=left><input type=password id=password name=password <?=size(20)?> maxlength=20 onkeyup="ajaxLoad2()" title="�̸��� ����� ���Է��ϸ� �ӽ������� ������"></td>
</tr>
<tr>
	<td align=right><font class=list_eng>E-mail</font></td>
	<td align=left><input type=text id=email name=email value="<?=$email?>" <?=size(40)?> maxlength=200></td>
</tr>
<tr>
	<td align=right><font class=list_eng>Homepage</font></td>
	<td align=left><input type=text id=homepage name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200></td>
</tr>
<?=$hide_end?>

<tr>
	<td width=80 align=right><font class=list_eng>Option</font></td>
	<td align=left class=list_eng>
		<?=$category_kind?>

		<?=$hide_notice_start?> <input type=checkbox id=notice name=notice <?=$notice?> value=1>��������<?=$hide_notice_end?><?=$hide_html_start?> <input type=checkbox id=use_html name=use_html <?=$use_html?>>HTML���<?=$hide_html_end?> <input type=checkbox id=reply_mail name=reply_mail <?=$reply_mail?> value=1>�亯���Ϲޱ�<?=$hide_secret_start?> <input type=checkbox id=is_secret name=is_secret <?=$secret?> value=1>��б�<?=$hide_secret_end?> <font id="state"></font>
	</td>
</tr>
<tr valign=top>
	<td align=right><font class=list_eng><b>Subject</b></font></td>
	<td align=left><input type=text id=subject name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 style=width:99% onkeyup="addStroke()"></td>
</tr>
<tr>
	<td align=right onclick=document.getElementById('memo').rows=document.getElementById('memo').rows+4 style=cursor:pointer><font class=list_eng><b>Memo</b></font> <font class=list_eng>��</font></td>
	<td align=left style=padding-top:8px;padding-bottom:8px;><textarea id=memo name=memo <?=size2(90)?> rows=18 style=width:99% onkeydown='return doTab(event);' onkeyup="addStroke()"><?=$memo?></textarea></td>
</tr>
<?=$hide_sitelink1_start?>

<tr>
	<td width=80 align=right><font class=list_eng>Link #1</font></td>
	<td align=left><input type=text id=sitelink1 name=sitelink1 value="<?=$sitelink1?>" <?=size(62)?> maxlength=200 style=width:99%></td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>

<tr>
	<td width=80 align=right><font class=list_eng>Link #2</font></td>
	<td align=left><input type=text id=sitelink2 name=sitelink2 value="<?=$sitelink2?>" <?=size(62)?> maxlength=200 style=width:99%></td>
</tr>
<?=$hide_sitelink2_end?>

<?=$hide_pds_start?>

<tr>
	<td width=80 align=right><font class=list_eng>Upload #1</font></td>
	<td align=left class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 style=width:99%> <?=$file_name1?></td>
</tr>
<tr>
	<td align=right><font class=list_eng>Upload #2</font></td>
	<td align=left class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 style=width:99%> <?=$file_name2?></td>
</tr>
<?=$hide_pds_end?>

</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
	<td width=200 height=40 align=left>
		<?=$a_preview?>�̸�����</a>
		<?=$a_imagebox?>�׸�â��</a>
		<?=$a_codebox?>�ڵ����</a>
	</td>
	<td align=right>
		<input type=button value="�ӽ�����" accesskey="a" onclick=autoSave() title="1���ϰ� ���� �ӽú��� �մϴ�">
		<input type=submit value="�ۼ��Ϸ�" accesskey="s">
		<input type=button value="����ϱ�" onclick=history.back()>
	</td>
</tr>
</form>
</table>
<br>
