<?=$hide_comment_end?>
<?
if(!preg_match("/Zeroboard/i",$a_preview)) $a_preview = str_replace(">","><font class=view_title1>",$a_preview);
if(!preg_match("/Zeroboard/i",$a_imagebox)) $a_imagebox = str_replace(">","><font class=view_title1>",$a_imagebox);
if(!preg_match("/Zeroboard/i",$a_codebox))	$a_codebox = str_replace(">","><font class=view_title1>",$a_codebox);

if(!preg_match("/Zeroboard/i",$a_home)) $a_home = str_replace(">","><font class=view_title1>",$a_home);
if(!preg_match("/Zeroboard/i",$a_bitly)) $a_bitly = str_replace(">","><font class=view_title1>",$a_bitly);
if(!preg_match("/Zeroboard/i",$a_keyword)) $a_keyword = str_replace(">","><font class=view_title1>",$a_keyword);
?>

<table class=zv3_table width=<?=$width?> cellspacing=0 cellpadding=0>
<tr>
	<td colspan=2><img src=<?=$dir?>/t.gif height=1></td>
</tr>
<tr>
	<td height=30 align=left><?=$a_list?><img src=<?=$dir?>/btn_list.gif border=0 align=absmiddle></a> <?=$a_write?><img src=<?=$dir?>/btn_write.gif border=0 align=absmiddle></a> <? if($box_view) { echo $a_preview."<img src=$dir/btn_preview.gif border=0 align=absmiddle></a> ".$a_imagebox."<img src=$dir/btn_imagebox.gif border=0 align=absmiddle></a> ".$a_codebox."코드삽입</a>"; }?></td>
	<td align=right><?=$a_home?>[HOME]</a> <?=$a_bitly?>[bitly]</a> <?=$a_keyword?>[반전해제]</a> <?=$a_reply?><img src=<?=$dir?>/btn_reply.gif border=0 align=absmiddle></a> <?=$a_vote?><img src=<?=$dir?>/btn_vote.gif border=0 align=absmiddle></a> <?=$a_modify?><img src=<?=$dir?>/btn_modify.gif border=0 align=absmiddle></a> <?=$a_delete?><img src=<?=$dir?>/btn_delete.gif	border=0 align=absmiddle></a></td>
</tr>
</table>
<table border=0	cellspacing=0 cellpadding=0 width=<?=$width?> height=2>
<tr>
	<td height=2 class=zv3_footer><img src=<?=$dir?>/t.gif border=0	height=2></td>
</tr>
</table>
<br>
<?=$hide_prev_start?>

<table width=<?=$width?>>
<tr>
	<td align=left style='word-break:break-all;'>△ <?=$a_prev?><?=$prev_subject?></a></td>
</tr>
</table>
<?=$hide_prev_end?>

<?=$hide_next_start?>

<table width=<?=$width?>>
<tr>
	<td align=left style='word-break:break-all;'>▽ <?=$a_next?><?=$next_subject?></a></td>
</tr>
</table>
<?=$hide_next_end?>

<?
if (!$setup[use_alllist]) {
echo '<form method=get name=search action="zboard.php"><input type=hidden name=id value='.$id.'><input type=hidden name=select_arrange value='.$select_arrange.'><input type=hidden name=desc value='.$desc.'><input type=hidden name=page_num value='.$page_num.'><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value='.$sn.'><input type=hidden name=ss value='.$ss.'><input type=hidden name=sc value='.$sc.'><input type=hidden name=sm value='.$sm.'><input type=hidden name=category value='.$category.'><input type=hidden name=keyword value='.$keyword.'></form>'; }
?>
<br>
