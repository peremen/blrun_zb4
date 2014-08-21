<?
$subject = str_replace(">","><font class=list_han>",$subject);

/* Check New Comment $comment_new */
$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
$last_comment_time = $last_comment['reg_date'];
if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
else $comment_new = "&nbsp;<font class=list_eng style='font-size:8pt;'>".$comment_num."</font>";
?>
	<tr><td></td>
	</tr>
	</table>
</td><td></td>
</tr>
<tr>
	<td nowrap colspan=2 style=padding:3,3,3,3><img src=<?=$dir?>/images/notice_fr.gif border=0 align=absmiddle>&nbsp;<?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?>&nbsp;<?=$insert?><B><nobr><?=$subject?></nobr></B><?=$comment_new?></td>
</tr>
<tr>	
	<td height=1 colspan=2 bgcolor=E0E0E0></td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
<tr><td valign=top>
	<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
