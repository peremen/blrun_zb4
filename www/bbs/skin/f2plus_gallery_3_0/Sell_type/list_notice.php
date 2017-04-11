<?
$subject = str_replace(">","><font class=list_han>",$subject);
//$name= str_replace(">","><font class=list_han>",$name);

/* Check New Comment $comment_new */
$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
$last_comment_time = $last_comment['reg_date'];
if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
else $comment_new = "&nbsp;<font class=list_eng style='font-size:8pt;'>".$comment_num."</font>";
?>
	<tr><td colspan=<?=$num?>>
		<table border=0 cellspacing=0 cellpadding=2 align=left width=100% style=border-width:1pt;border-style:solid;border-color:#cccccc>
		<tr align=center height=10 style=padding-bottom:3px>
			<col width=100></col><col width=></col>
			<td width=100 class=list_eng nowrap><img src=<?=$dir?>/images/notice.gif align=absmiddle border=0></td>
			<td align=left nowrap><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?><?=$insert?><B><?=$subject?></B><?=$comment_new?></td>
		</tr>
		</table>
	</td></tr>
