<?
	if($mode=="reply") $title="답글 쓰기";
	elseif($mode=="modify") $title="글 수정하기";
	else $title="새로 글 쓰기";

	$a_preview = str_replace(">","><font class=list_eng>",$a_preview)."&nbsp;&nbsp;";
	$a_imagebox = str_replace(">","><font class=list_eng>",$a_imagebox)."&nbsp;&nbsp;";
	$a_codebox = str_replace(">","><font class=list_eng>",$a_codebox)."&nbsp;&nbsp;";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function zb_formresize(obj) {
	obj.rows += 3;
}
// -->
</SCRIPT>

<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0 style=table-layout:fixed>
<form method=post name=write id=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name="page" value="<?=$page?>"><input type=hidden name="id" value="<?=$id?>"><input type=hidden name=no value="<?=$no?>"><input type=hidden name=select_arrange value="<?=$select_arrange?>"><input type=hidden name=desc value="<?=$desc?>"><input type=hidden name=page_num value="<?=$page_num?>"><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>"><input type=hidden name=wantispam value="<?=$wnum1num2?>">
<col width=80 align=right style="padding-right:10px;height:28px" class=list1></col><col class=list0 style="padding-left:10px;height:28px" width=></col>
<tr class=title>
	<td colspan=2 class=title_han align=center>&nbsp;&nbsp;<?=$title?></td>
</tr>
<?=$hide_start?>
<tr>
  <td width=80 align=right><font class=list_eng><b>Password</b></font></td>
  <td><input type=password name=password <?=size(20)?> maxlength=20 class=input></td>
</tr>
<tr>
  <td align=right><font class=list_eng><b>Name</b></font></td>
  <td><input type=text name=name value="<? $name=stripslashes($name); echo $name; ?>" <?=size(20)?> maxlength=20 class=input></td>
</tr>
<tr>
  <td align=right><font class=list_eng>E-mail</font></td>
  <td><input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td align=right><font class=list_eng>Homepage</font></td>
  <td><input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<?=$hide_end?>
<tr>
  <td width=80 align=right><font class=list_eng>Option</font></td>
  <td class=list_eng>
       <?=$category_kind?>
       <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1> 공지사항 <?=$hide_notice_end?>
       <?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?>> HTML사용 <?=$hide_html_end?>
       <input type=checkbox name=reply_mail <?=$reply_mail?> value=1> 답변메일받기
       <?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> 비밀글 <?=$hide_secret_end?>
  </td>
</tr>
<tr valign=top>
  <td align=right><font class=list_eng><b>Subject</b></font></td>
  <td><input type=text name=subject id=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 style=width:99% class=input></td>
</tr>
<tr>
  <td align=right onclick=document.getElementById('memo').rows=document.getElementById('memo').rows+4 style=cursor:pointer><font class=list_eng><b>Memo</b></font> <font class=list_eng>▼</font></td>
  <td style=padding-top:8px;padding-bottom:8px;><textarea id=memo name=memo <?=size2(90)?> rows=18 class=textarea style=width:99% onkeydown='return doTab(event);'><?=$memo?></textarea></td>
</tr>
<?=$hide_sitelink1_start?>
<tr>
  <td width=80 align=right><font class=list_eng>Link #1</font></td>
  <td><input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<?=$hide_sitelink1_end?>
<?=$hide_sitelink2_start?>
<tr>
  <td width=80 align=right><font class=list_eng>Link #2</font></td>
  <td><input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<?=$hide_sitelink2_end?>
<?=$hide_pds_start?>
<tr>
  <td width=80 align=right><font class=list_eng>Upload #1</font></td>
  <td class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$file_name1?></td>
</tr>
<tr>
  <td align=right><font class=list_eng>Upload #2</font></td>
  <td class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$file_name2?></td>
</tr>
<?=$hide_pds_end?>
</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
	<td width=200 height=40>
		<?=$a_preview?>미리보기</a>
		<?=$a_imagebox?>그림창고</a>
		<?=$a_codebox?>코드삽입</a>
	</td>
	<td align=right>
		<input type=submit value="작성완료" class=submit accesskey="s">
		<input type=button value="취소하기" class=button onclick=history.back()>
	</td>
</tr>
</form>
</table>
<br>
