<?
	$subject = str_replace(">","><font class=list_han>",$subject);
	$date= str_replace(">","><font class=com>",$date);

	/* Check New Comment $comment_new */
	$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
	$last_comment_time = $last_comment['reg_date'];
	if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
	elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
	else $comment_new = "&nbsp;<font class=list_eng style='font-size:8pt;'>".$comment_num."</font>";

	include "list_image_info.php";
	$memo=explode("||",$data[memo]);
	$str=cut_str($memo[0],200);
	$str=strip_tags($str);
	$str=str_replace("<br />","",$str);
	$str=str_replace("<br>","\n",$str);
	$str=str_replace("\"","",$str);
	$str2=cut_str($data[subject],10);
	$str3=str_replace("$data[subject]","$str2",$subject);
	$str3=str_replace("title=\"$str2 ","title=\"$data[subject] ",$str3);
?>
<?if($counter%$num==1){?><tr><?}?>
<td align=center valign=top>
<table cellspacing=0 cellpadding=0 align=center style=border-width:3pt;border-style:solid;border-color:#f1f1f1 class=shadow2>
	<tr><td valign=top colspan=2>
		<?=$view_img?><img src=<?=$thumb_img?> border=0 width=<?=$min_width_size?> alt="<? if($Exif_use=="on") { echo $str;} ?>" style=border-width:1pt;border-style:solid;border-color:#000000></a>
		</td>
	</tr>
</table>
<table cellspacing=0 cellpadding=0 align=center width=100 style=table-layout:fixed>
	<tr><td height=3></td></tr>
<tr><td height=1 background=<?=$dir?>/dot.gif></td></tr>
	<tr><td height=3></td></tr>
</table>
<table cellspacing=0 cellpadding=0 align=center width=130>

<tr><td align=center><nobr>¡¤ <B><?=$str3?></B></nobr><?=$comment_new?></td></tr>
<tr><td align=center><?if($hide_name=="off"){?>¡¤ <font class=com2><?=$name?></font>&nbsp;<?if($hide_date=="off"){?><font class=com3>(<?=date("m-d",$data[reg_date])?>) </font><?}?><?}?><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?></td></tr>
</table></td>
<?if($counter%$num==0){?></tr><?} $counter++;?>

