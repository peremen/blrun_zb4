<?
$temp=str_replace("\"","'",$data[subject]);

if($keyword != "")
{
	if(preg_match(" <img src='images/ico_file.gif' border=0>",$subject)) {
		$link=str_replace(" <img src='images/ico_file.gif' border=0></a>","<img src=$dir/detail.gif border=0 align=absmiddle alt=\"찾은문자열 : $keyword\"> <img src='images/ico_file.gif' border=0></a>",$subject);
	}
	else {
		$link=str_replace("</a>","<img src=$dir/detail.gif border=0 align=absmiddle alt=\"찾은문자열 : $keyword\"></a>",$subject);
	}
}
else
{
	if(preg_match(" <img src='images/ico_file.gif' border=0>",$subject)) {
		$subject=str_replace(" <img src='images/ico_file.gif' border=0>","",$subject);
		$link=str_replace("$data[subject]</a>","<img src=$dir/detail.gif border=0 align=absmiddle alt=\"제목 : $temp\"> <img src='images/ico_file.gif' border=0></a>",$subject);
	}
	else {
		$link=str_replace("$data[subject]</a>","<img src=$dir/detail.gif border=0 align=absmiddle alt=\"제목 : $temp\"></a>",$subject);
	}
}

/* Check New Comment $comment_new */
$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
$last_comment_time = $last_comment['reg_date'];
if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
else $comment_new = "&nbsp;<font class=list_eng style='font-size:8pt;'>".$comment_num."</font>";

if($Exif_use=="on") {
	$str=cut_str($data[memo],200);
	$str=str_replace("<br>","\n",$str);
	$str=str_replace("<br />","",$str);
	$str=strip_tags($str);
	$str=str_replace("\"","",$str);
	$str="제목 : ".$temp."\n내용 : ".$str."\n";
	if($hide_date=="off") $str="작성일 : ".date("m-d",$data[reg_date])."\n".$str;
	if($hide_name=="off") $str="작성자 : ".$data[name]."\n".$str;
}
else $str="";

include "list_image_info.php";

if($counter==1) echo "
	<tr valign=top>";
elseif($counter%$num==1) echo "
	</tr>
	<tr valign=top>";?>

		<td valign=top>
			<table cellspacing=0 cellpadding=0><tr><td height=10></td></tr></table>
			<table cellspacing=0 cellpadding=0 align=center style=border-width:3pt;border-style:solid;border-color:#f1f1f1 class=shadow2>
			<tr><td valign=top>
				<?=$view_img?><img src=<?=$thumb_img?> border=0 width=<?=$min_width_size?> height=<?=$min_width_size*3/4?> alt="<?=$str?>" style=border-width:1pt;border-style:solid;border-color:#000000;></span>
			</td></tr>
			</table>
			<table cellspacing=0 cellpadding=0 align=center border=0 width=100 height=13>
			<tr><td><?=$full_img?><img src=<?=$dir?>/show_img.gif border=0></a></td><td align=left><?=$comment_new?></td>
			<td align=right><?=$link?><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?></td>
			</tr>
			</table>
		</td><?if($loop_number==1) echo "
	</tr>"; $counter++;?>
