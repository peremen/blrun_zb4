<?
if(!$data[is_secret]) $subject = str_replace(">","><font class=list_han>",$subject);
else $subject = str_replace(">","><font style='color:gray; text-decoration:none;'>",$subject);
$name= str_replace(">","><font class=list_han>",$name);

/* Check New Article to $new */
if(time()-$data['reg_date']<60*60*24) $new = "&nbsp;<font color=red style='font-size:8pt;'>new</font>";
elseif(time()-$data['reg_date']<60*60*48) $new = "&nbsp;<font color=blue style='font-size:8pt;'>new</font>";
else $new = "";

/* Check New Comment $comment_new */
$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
$last_comment_time = $last_comment['reg_date'];
if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
else $comment_new = "&nbsp;<font class=list_eng style='font-size:8pt;'>".$comment_num."</font>";
?>

<tr align=center class=list<?=$coloring%2?>>
	<? if($browser=="1"){ ?><td class=list_eng><?=$number?></td><? } ?>

	<?=$hide_category_start?><td class=list_eng nowrap='nowrap'><div style="overflow:hidden"><nobr><?=$category_name?></nobr></div></td><?=$hide_category_end?>

	<td align=left nowrap='nowrap'><div style="overflow:hidden"><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><?=$subject?><?=$comment_new?><?=$new?></div></td>
	<? if($browser=="1"){ ?><td nowrap='nowrap'><div style="overflow:hidden"><nobr><?=$face_image?><?=$name?></nobr></div></td><? } ?>

	<? if($browser=="1"){ ?><td nowrap='nowrap' class=list_eng><?=$reg_date?></td><? } ?>

	<? if($browser=="1"){ ?><td nowrap='nowrap' class=list_eng><?=$vote?></td><td nowrap='nowrap' class=list_eng><?=$hit?></td><? } ?>

</tr>
<?$coloring++;?>
