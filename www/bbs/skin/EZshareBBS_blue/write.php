<?
if($mode=="reply") $title="<img src='$dir/title_postareply.gif'>";
elseif($mode=="modify") $title="<img src='$dir/title_modifyarticle.gif'>";
else $title="<img src='$dir/title_newarticle.gif'>";

$a_codebox = str_replace(">","><font class=view_title1>",$a_codebox)."&nbsp;&nbsp;";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function zb_formresize(obj) {
	obj.rows += 4;
}
// -->
</SCRIPT>

<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0 class=zv3_writetitle>
<form method=post name=write id=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>"><input type=hidden name=wantispam value="<?=$wnum1num2?>">
<tr>
  <td height=20 align=left>&nbsp;&nbsp;<?=$title?></td>
</tr>
<tr>
  <td height=2 bgcolor=#0099CC></td>
</tr>
</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0 class=zv3_writeform style=table-layout:fixed>
<col width=80></col><col width=></col>
<td height=2><img src=<?=$dir?>/t.gif border=0 height=2></td>
<?=$hide_start?>

<tr>
  <td><img src=<?=$dir?>/t.gif border=0 height=1><br><table  cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=right><img src=<?=$dir?>/w_password.gif></td></tr></table></td>
  <td><input type=password name=password <?=size(20)?> maxlength=20 class=zv3_input></td>
</tr>
<tr>
  <td><img src=<?=$dir?>/t.gif border=0 height=1><br><table  cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=right><img src=<?=$dir?>/w_name.gif></td></tr></table></td> 
  <td><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=zv3_input></td>
</tr>
<tr>
  <td><img src=<?=$dir?>/t.gif border=0 height=1><br><table  cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=right><img src=<?=$dir?>/w_email.gif></td></tr></table></td>
  <td><input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=zv3_input></td>
</tr>
<tr>
  <td><img src=<?=$dir?>/t.gif border=0 height=1><br><table  cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=right><img src=<?=$dir?>/w_homepage.gif></td></tr></table></td>
  <td><input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=zv3_input></td>
</tr>
<?=$hide_end?>

<tr>
  <td><img src=<?=$dir?>/t.gif border=0 height=1><br><table  cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=right><img src=<?=$dir?>/w_select.gif></td></tr></table></td>
  <td class=zv3_comment><?=$category_kind?><?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1>��������<?=$hide_notice_end?><?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1>HTML���<?=$hide_html_end?><input type=checkbox name=reply_mail <?=$reply_mail?> value=1>�亯���Ϲޱ�<?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1>��б�<?=$hide_secret_end?>&nbsp;&nbsp;&nbsp; <img src=<?=$dir?>/btn_down.gif border=0 valign=absmiddle style=cursor:pointer; onclick=zb_formresize(document.write.memo)></td>
</tr>
<tr valign=top>
  <td><img src=<?=$dir?>/t.gif border=0 height=1><br><table  cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=right><img src=<?=$dir?>/w_subject.gif></td></tr></table></td>
  <td><input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 style=width:99% class=zv3_input></td>
</tr>
<tr>
  <td colspan=2 style=padding:5px><textarea id=memo name=memo <?=size2(90)?> rows=18 class=zv3_w_textarea style=width:99% onkeydown='return doTab(event);'><?=$memo?></textarea></td>
</tr>
<?=$hide_sitelink1_start?>

<tr>
  <td><img src=<?=$dir?>/t.gif border=0 height=1><br><table  cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=right><img src=<?=$dir?>/w_link1.gif></td></tr></table></td>
  <td><input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(62)?> maxlength=200 class=zv3_input></td>
</tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>

<tr>
  <td><img src=<?=$dir?>/t.gif border=0 height=1><br><table  cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=right><img src=<?=$dir?>/w_link2.gif></td></tr></table></td>
  <td><input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(62)?> maxlength=200 class=zv3_input></td>
</tr>
<?=$hide_sitelink2_end?>

<?=$hide_pds_start?>

<tr>
  <td><img src=<?=$dir?>/t.gif border=0 height=1><br><table  cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=right><img src=<?=$dir?>/w_upload1.gif></td></tr></table></td>
  <td><input type=file name=file1 <?=size(50)?> maxlength=255 class=zv3_input> <?=$file_name1?></td>
</tr>
<tr>
  <td><img src=<?=$dir?>/t.gif border=0 height=1><br><table  cellspacing=0 cellpadding=0 width=100% height=100%><tr><td align=right><img src=<?=$dir?>/w_upload2.gif></td></tr></table></td>
  <td><input type=file name=file2 <?=size(50)?> maxlength=255 class=zv3_input> <?=$file_name2?></td>
</tr>
<?=$hide_pds_end?>

<tr>
  <td colspan=2><br>
    <table border=0 cellspacing=1 cellpadding=2 width=100% height=1>
    <tr>
      <td height=1 bgcolor=#999999></td>
    </tr>
    </table>
    <table border=0 cellspacing=1 cellpadding=2 width=100% height=40>
    <tr>
      <td><?=$a_preview?><img src=<?=$dir?>/btn_preview.gif border=0></a> <?=$a_imagebox?><img src=<?=$dir?>/btn_imagebox.gif border=0></a> <?=$a_codebox?>�ڵ����</a>&nbsp;</td>
      <td align=right>
        <input type=image src=<?=$dir?>/btn_writeok.gif border=0 onfocus=blur() border=0 accesskey="s">
        <a href=javascript:void(history.back()) onfocus=blur()><img src=<?=$dir?>/btn_writecancel.gif border=0></a>
      </td>
    </tr>
    </table>
  </td>
</tr>
</form>
</table>
<br>
