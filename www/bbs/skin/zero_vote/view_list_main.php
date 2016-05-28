<?
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name = str_replace(">","><font class=list_han>",$name);

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
