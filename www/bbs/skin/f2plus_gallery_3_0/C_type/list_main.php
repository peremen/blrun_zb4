<?	
/* Check New Comment $comment_new */
$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
$last_comment_time = $last_comment['reg_date'];
if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
else $comment_new = "&nbsp;<font class=list_eng style='font-size:8pt;'>".$comment_num."</font>";

$temp=str_replace("\"","&quot;",$data[subject]);

if($keyword != "")
{
	if(preg_match(" <img src='images/ico_file.gif' border=0>",$subject)) {
		$link=str_replace(" <img src='images/ico_file.gif' border=0></a>","<img src=$dir/images/detail.gif border=0 align=absmiddle alt=\"찾은문자열 : $keyword\"> <img src='images/ico_file.gif' border=0></a>",$subject);
	}
	else {
		$link=str_replace("</a>","<img src=$dir/images/detail.gif border=0 align=absmiddle alt=\"찾은문자열 : $keyword\"></a>",$subject);
	}
}
else
{
	if(preg_match(" <img src='images/ico_file.gif' border=0>",$subject)) {
		$subject=str_replace(" <img src='images/ico_file.gif' border=0>","",$subject);
		$link=str_replace("$temp</a>","<img src=$dir/images/detail.gif border=0 align=absmiddle alt=\"제목 : $temp\"> <img src='images/ico_file.gif' border=0></a>",$subject);
	}
	else {
		$link=str_replace("$temp</a>","<img src=$dir/images/detail.gif border=0 align=absmiddle alt=\"제목 : $temp\"></a>",$subject);
	}
}

include "list_image_info.php";

if($Exif_use=="on") {
	$memo=explode("|||",$data[memo]);
	$str=htmlspecialchars(cut_str(strip_tags($memo[0]),200));
	$str="제목 : ".$temp."\n내용 : ".$str."\n";
	if($hide_date=="off") $str="작성일 : ".date("m-d",$data[reg_date])."\n".$str;
	if($hide_name=="off") $str="작성자 : ".htmlspecialchars($data[name])."\n".$str;
}
else $str="";

if($counter==1) echo "
	<tr valign=top>";
elseif($counter%$num==1) echo "
	</tr>
	<tr valign=top>";?>

		<td valign=top>
			<table cellspacing=0 cellpadding=0 align=center border=0>
			<col width=25></col><col width=<?=$min_width_size?>></col>
			<tr><td height=10 colspan=2></td></tr>
			<tr><td valign=top>
				<table cellspacing=0 cellpadding=0 align=right border=0 height=<?=$min_width_size*3/4+12?>>
				<tr><td align=right valign=top><?=$link?><BR><?=$comment_new?></td></tr>
				<tr><td valign=bottom align=right><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?></td></tr>
				</table>
			</td>
			<td>
				<table cellspacing=0 cellpadding=0 align=left style=border-width:3pt;border-style:solid;border-color:#f1f1f1 class=shadow2>
				<tr><td valign=top>
					<?=$view_img?><img src=<?=$thumb_img?> border=0 width=<?=$min_width_size?> height=<?=$min_width_size*3/4?> alt="<?=$str?>" style=border-width:1pt;border-style:solid;border-color:#000000;></a>
				</td></tr>
				</table>
			</td></tr>
			</table>
		</td>
<?if($loop_number==1) echo "
	</tr>"; $counter++;?>