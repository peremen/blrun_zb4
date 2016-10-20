<?
	include $dir."/swe/ed_seting_head_comment.php";
?>

<img src=<?=$dir?>/images/t.gif border=0 height=4><br>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
<form method=post id=write name=write action=comment_ok.php onsubmit="return check_comment_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="write"><input type=hidden name=antispam value="<?=$num1num2?>">
<col width=10></col><col width=></col><col width=10></col>
<tr valign=top>
	<td height=9 background=<?=$dir?>/images/c_head_bg1.gif></td>
	<td background=<?=$dir?>/images/c_head_bg2.gif></td>
	<td background=<?=$dir?>/images/c_head_bg3.gif></td>
</tr>
<tr>
	<td background=<?=$dir?>/images/c_middle_bg1.gif></td>
	<td bgcolor=424242>
	<? include $dir."/swe/ed_seting_option_comment.php"; ?><? include $dir."/swe/ed_seting_edit.php"; ?>
	</td>

	<td background=<?=$dir?>/images/c_middle_bg2.gif></td>
</tr>
</table>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0 align=center style=table-layout:fixed>
<col width=10></col><col width=></col><col width=200></col><col width=10></col>
<tr valign=bottom height=9>
	<td background=<?=$dir?>/images/c_foot_bg1-1.gif></td>
	<td background=<?=$dir?>/images/c_foot_bg1-2.gif></td>
	<td background=<?=$dir?>/images/c_foot_bg1-2.gif></td>
	<td background=<?=$dir?>/images/c_foot_bg1-3.gif></td>
</tr>
</table>
<table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
<tr valign=top>
<?=$hide_pds_start?>

	<td width=52 align=right><font class=list_eng>Upload #1</font></td>
	<td align=left class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
	<td width=52 align=right><font class=list_eng>Upload #2</font></td>
	<td align=left class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
<?=$hide_pds_end?>

</tr>
</form>
</table>
<BR>
