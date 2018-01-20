<?
$emoticon_url=$dir."/emoticon";
if($mode=="reply") $title="답글 쓰기";
elseif($mode=="modify") $title="글 수정하기";
else $title="새로 글 쓰기";

$a_preview = str_replace("view_preview()","preview_m()",$a_preview);
$a_preview = str_replace(">","><font class=com2>",$a_preview)."";
$a_imagebox = str_replace(">","><font class=com2>",$a_imagebox)."";
$a_codebox = str_replace(">","><font class=com2>",$a_codebox)."";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function zb_formresize(obj) {
	obj.rows += 4;
}
//-->
</SCRIPT><br><br>
<table border=0 cellspacing=0 cellpadding=2 width=<?=$width?> align=center style=border-width:1pt;border-style:solid;border-color:#cccccc style=table-layout:fixed>
<tr align=left valign="middle" height=25>
  <td class=list_eng>&nbsp;&nbsp;<img src=<?=$dir?>/front_img.gif>&nbsp;&nbsp;새글쓰기</td>
</tr>
</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0 style=table-layout:fixed>
<form method=post id=write name=write action=<?=$dir?>/write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>"><input type=hidden name=wantispam value="<?=$wnum1num2?>">
<input type=hidden name=_zb_path value="<?=$config_dir?>"><input type=hidden name=_zb_url value="<?=$_zb_url?>">
<col width=80 align=right style=padding-right:10px;height:28px class=com2></col><col class=list1 style=padding-left:10px;height:28px width=></col>
<?=$hide_start?>

<tr>
  <td align=right><font class=com2><b>Name</b></font></td>
  <td align=left><input type=text id=name name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input onkeyup="ajaxLoad2()" title="이름과 비번을 재입력하면 임시저장이 복원됨"></td>
</tr>
<tr>
  <td background=<?=$dir?>/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2><b>Password</b></font></td>
  <td align=left><input type=password id=password name=password <?=size(20)?> maxlength=20 class=input onkeyup="ajaxLoad2()" title="이름과 비번을 재입력하면 임시저장이 복원됨"></td>
</tr>
<tr>
  <td background=<?=$dir?>/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>E-mail</font></td>
  <td align=left><input type=text id=email name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>Homepage</font></td>
  <td align=left><input type=text id=homepage name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<?=$hide_end?>

<tr>
  <td background=<?=$dir?>/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>Option</font></td>
  <td align=left class=com2>
    <?=$hide_category_start?><?=$category_kind?><?=$hide_category_end?>

    <?=$hide_notice_start?> <input type=checkbox id=notice name=notice <?=$notice?> value=1>공지사항<?=$hide_notice_end?><?=$hide_html_start?> <input type=checkbox id=use_html name=use_html <?=$use_html?>>HTML사용<?=$hide_html_end?> <input type=checkbox id=reply_mail name=reply_mail <?=$reply_mail?> value=1>답변메일받기<?=$hide_secret_start?> <input type=checkbox id=is_secret name=is_secret <?=$secret?> value=1>비밀글<?=$hide_secret_end?><?if($emoticon_use=="on"){?> <input onclick='showEmoticon()' type=checkbox name=Emoticons value='yes'><img src=<?=$dir?>/use_emo.gif><?}?> <font id="state"></font>

  </td>
</tr>
<tr>
  <td background=<?=$dir?>/dot.gif height=1 colspan=2></td>
</tr>
<tr valign=top>
  <td align=right><font class=com2><b>Subject</b></font></td>
  <td align=left><input type=text id=subject name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 style=width:99% class=input onkeyup="addStroke()"></td>
</tr>
<tr>
  <td background=<?=$dir?>/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right onclick=document.getElementById('memo').rows=document.getElementById('memo').rows+4 style=cursor:pointer><font class=com2><b>Memo</b></font> <font class=com2>▼</font></td>
  <td align=left style=padding-top:8px;padding-bottom:8px;><textarea id=memo name=memo <?=size2(90)?> rows=18 class=textarea style=width:99% onkeydown='return doTab(event);' onkeyup="addStroke()"><?=$memo?></textarea></td>
</tr>
<tr>
  <td background=<?=$dir?>/dot.gif height=1 colspan=2></td>
</tr>
<?=$hide_sitelink1_start?>

<tr>
  <td align=right><font class=com2>Link #1</font></td>
  <td align=left><input type=text id=sitelink1 name=sitelink1 value="<?=$sitelink1?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<tr>
  <td background=<?=$dir?>/dot.gif height=1 colspan=2></td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>

<tr>
  <td align=right><font class=com2>Link #2</font></td>
  <td align=left><input type=text id=sitelink2 name=sitelink2 value="<?=$sitelink2?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<tr>
  <td background=<?=$dir?>/dot.gif height=1 colspan=2></td>
</tr>
<?=$hide_sitelink2_end?>

<?=$hide_pds_start?>

<tr>
  <td align=right><font class=com2>Upload #1</font></td>
  <td align=left class=com2><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$file_name1?></td>
</tr>
<tr>
  <td background=<?=$dir?>/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>Upload #2</font></td>
  <td align=left class=com2><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$file_name2?></td>
</tr>
<?=$hide_pds_end?>

</table>
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 align="center" width=<?=$width?>>
<TR>
	<TD><?if($emoticon_use=="on") include "$dir/emo.php"; ?>
	</TD>
</TR>
</TABLE>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
  <td width=130 height=40 align=left>
    <?=$a_preview?><img src=<?=$dir?>/bt_prev.gif border=0></a>
    <?=$a_imagebox?><img src=<?=$dir?>/bt_imgbox.gif border=0></a>
  </td>
  <td width=60 align=left valign=middle><?=$a_codebox?>코드삽입</a></td>
  <td align=right>
    <img src=<?=$dir?>/bt_imsi_ok.gif border=0 accesskey="a" onclick=autoSave() style="cursor:pointer" title="1주일간 글을 임시보관 합니다">&nbsp;
    <input type=image src=<?=$dir?>/bt_write_ok.gif border=0 accesskey="s" onfocus=blur()>&nbsp;<a href=# onclick=history.back() onfocus=blur()><img src=<?=$dir?>/bt_cancel.gif border=0></a>
  </td>
</tr>
</form>
</table>
<br>
