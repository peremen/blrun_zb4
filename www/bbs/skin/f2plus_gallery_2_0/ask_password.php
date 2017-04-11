
<br><br><br>
<table width=100% border=0 cellspacing=0 cellpadding=0>
<form method=post name=delete action=<?=$target?>>
<input type=hidden name=_zb_path value=<?=$_zb_path?>>
<input type=hidden name=_zb_url value=<?=$_zb_url?>>
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
<input type=hidden name=mode value="<?=$mode?>">
<input type=hidden name=c_no value=<?=$c_no?>>
<input type=hidden name=zb_check value="<?=$zb_check?>">
<tr class=title>
	<td align=center class=title_han2><b><?=$title?></b></td>
</tr>
<?
if(!$member[no]) {
?>
<tr height=60>
	<td align=center>
		<font class=list_eng><b>Password</b> :</font><?=$input_password?>
	</td>
</tr>
<?
}
?>
<tr height=30>
	<td align=center>
		<input type=submit class=submit value=" 확  인 " border=0 accesskey="s">
		<input type=button class=button value="이전화면" onclick=history.back()>
	</td>
</tr>
</form>
</table>
