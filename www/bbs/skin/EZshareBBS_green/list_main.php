<?
	/* Check New Article to $new */
	if(time()-$data['reg_date']<60*60*24) $new = "&nbsp;<font color=red style='font-size:8pt;'>new</font>";
	elseif(time()-$data['reg_date']<60*60*48) $new = "&nbsp;<font color=blue style='font-size:8pt;'>new</font>";
	else $new = "";

	/* Check New Comment $comment_new */
	$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
	$last_comment_time = $last_comment['reg_date'];
	if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
	elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
	else $comment_new = "&nbsp;<font class=zv3_comment style='font-size:8pt;'>".$comment_num."</font>";
?>
<tr align=center class=zv3_listBox>

<!--카트-->
	<?=$hide_cart_start?>
	<td><input type=checkbox name=cart value="<?=$data[no]?>"></td>
	<?=$hide_cart_end?>

<!--게시물번호-->
	<? if($browser=="1"){ ?><td class=zv3_small height=25><?=$number?></td><? } ?>

<!--게시물아이콘, 카테고리,제목, 답변글수-->	
	<td align=left nowrap='nowrap' <?=$td_bg?>><div style="overflow:hidden"><?=$insert?><?=$icon?><?=$hide_category_start?>[<?=$category_name?>] <?=$hide_category_end?><?=$subject?><?=$comment_new?><?=$new?></div></td> 

<!--작성자-->
	 <? if($browser=="1"){ ?><td nowrap='nowrap'><div style="overflow:hidden"><?=$face_image?>&nbsp;<?=$name?></div></td><? } ?>

<!--작성일-->
	<? if($browser=="1"){ ?><td nowrap='nowrap' class=zv3_small><?=$reg_date?></td><? } ?>
<!--조회--><!--추천-->
	<? if($browser=="1"){ ?>
	<td nowrap class=zv3_small><?=$hit?></td>
	<td nowrap class=zv3_small><?=$vote?></td>
	<? } ?>
</tr>
<!--게시물과 게시물 사이의 점선-->
<tr>
	<td colspan=<?=$colspanNum?> background=<?=$dir?>/dot_line.gif height=1></td>
</tr>

