<?=$hide_comment_end?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td width=100%>
	<table border=0 cellspacing=0 cellpadding=0 width=100% height=40>
	<tr>
	<td align=left>
		<?=$a_list?><img src=<?=$dir?>/list.gif border=0></a>
		<?=$a_write?><img src=<?=$dir?>/write.gif border=0></a>
	</td>
	<td align=right>
		<a href="/" target="_parent" style="color:blue;">[HOME]<a>
		<?=$a_reply?><img src=<?=$dir?>/reply.gif border=0></a>
		<?=$a_modify?><img src=<?=$dir?>/modify.gif border=0></a>
		<?=$a_delete?><img src=<?=$dir?>/delete.gif border=0></a>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
<?
if (!$setup[use_alllist]) {
echo '<form method=get name=search action="zboard.php"><input type=hidden name=id value='.$id.'><input type=hidden name=select_arrange value='.$select_arrange.'><input type=hidden name=desc value='.$desc.'><input type=hidden name=page_num value='.$page_num.'><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value='.$sn.'><input type=hidden name=ss value='.$ss.'><input type=hidden name=sc value='.$sc.'><input type=hidden name=sm value='.$sm.'><input type=hidden name=category value='.$category.'><input type=hidden name=keyword value='.$keyword.'></form>'; }
?>

<br><br>
