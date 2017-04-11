<?
$subject = str_replace(">","><font class=list_han>",$subject);
$name= str_replace(">","><font class=list_han>",$name);

/* Check New Comment $comment_new */
$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
$last_comment_time = $last_comment['reg_date'];
if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
else $comment_new = "&nbsp;<font class=list_eng style='font-size:8pt;'>".$comment_num."</font>";

include "list_image_info.php";

unset($_m);
unset($line);
$_m = explode("\n",strip_tags($data['memo']));
for($i=0;$i<count($_m);$i++)
if(trim($_m[$i])) $line[] = $_m[$i];
$tmp_memo=$line[0]."".$line[1]."".$line[2]."".$line[3]."".$line[4]."".$line[5]."".$line[6]."".$line[7]."".$line[8]."".$line[9]."".$line[10];// 이부분이 미리나오는 내용 입니다. 라인 1,2,3 적용	if($line[11]) $tmp_memo.="...";
$_name1=explode("|||",$tmp_memo);
$_name1[0] = love_convert($_name1[0]);

$m_data=mysql_fetch_array(mysql_query("SELECT * FROM zetyx_member_table where no=$data[ismember]",$connect));
?>

	<tr align=center height=50 style=padding-bottom:3px class=list<?=$coloring%2?>>
		<td class=list_main1></td>
		<?if($hide_no!="on"){?><? if($browser=="1"){ ?><td class=list_main2 align=center nowrap><div style="overflow:hidden"><font class=title_font style=color:#FF4E00>notice</font></div></td><? } ?><?}?>

		<? if($browser=="1"){ ?><td style=padding-top:5px;padding-bottom:5px border=0 class=list_main2_2 align=center><?=$view_img?><img src=<?=$thumb_img?> width=52 height=39 class=shadow2 style=border-width:1pt;border-style:solid;border-color:#000000;></td><? } ?>

		<td class=list_notice3>
			<table border=0 cellspacing=0 cellpadding=0 width=100% align=center style=table-layout:fixed>
			<col width=100%></col><?if($hide_name!="on"){?><? if($browser=="1"){ ?><col width=100></col><? } ?><?}?><?if($hide_date!="on"){?><? if($browser=="1"){ ?><col width=65></col><? } ?><?}?><?if($hide_vote!="on"){?><? if($browser=="1"){ ?><col width=35></col><? } ?><?}?><?if($hide_hit!="on"){?><? if($browser=="1"){ ?><col width=50></col><? } ?><?}?>

			<tr>
				<td align=left style=padding-bottom:7px nowrap><div style="overflow:hidden"><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?>&nbsp;&nbsp;<img src=<?=$dir?>/images/notice_fr2.gif align=absmiddle border=0>&nbsp;<?=$insert?><B><?=$subject?></B><?=$comment_new?></div></td>

				<?if($hide_name!="on"){?><? if($browser=="1"){ ?><td nowrap align=center style=padding-bottom:7px><div style="overflow:hidden"><nobr><?=$face_image?><?=$name?></nobr></div></td><? } ?><?}?>

				<?if($hide_date!="on"){?><? if($browser=="1"){ ?><td nowrap class=list_eng align=center style=padding-bottom:7px><?=$reg_date?></td><? } ?><?}?>

				<?if($hide_vote!="on"){?><? if($browser=="1"){ ?><td nowrap class=list_eng align=center style=padding-bottom:7px><?=$vote?></td><? } ?><?}?>

				<?if($hide_hit!="on"){?><? if($browser=="1"){ ?><td nowrap class=list_eng align=center style=padding-bottom:7px><?=$hit?></td><? } ?><?}?>

			</tr>
			<tr valign=bottom>
				<td align=left style=padding-bottom:4px><div style="overflow:hidden"><nobr><font style=color:#ffffff>&nbsp;&nbsp;&nbsp;<? if(!$data[is_secret]) echo del_html(mb_substr($_name1[0],0,300)); else echo "비밀글입니다"; ?></font></nobr></div></td>
				<?if($hide_name!="on"){?><? if($browser=="1"){ ?><td align=center class=com7 style=padding-bottom:4px><div style="overflow:hidden"><img src=<?=$dir?>/images/point.gif align=absmiddle>&nbsp;<?=($m_data[point1]*10+$m_data[point2])?></div></td><? } ?><?}?>

				<?if($hide_date!="on"){?><? if($browser=="1"){ ?><td align=center style=padding-bottom:4px><font class=com7 color=aaaaaa><?=date("H:i:s",$data[reg_date])?></font></td><? } ?><?}?>

				<?if($hide_vote!="on"){?><? if($browser=="1"){ ?><td></td><? } ?><?}?>

				<?if($hide_hit!="on"){?><? if($browser=="1"){ ?><td align=center valign=bottom style=padding-bottom:7px><?if ($data[hit]<=$max_hit/15)
					echo "<img src=$dir/images/hit_gra1.gif border=0 align=absmiddle>";
				elseif ($data[hit]<=$max_hit/3)
					echo "<img src=$dir/images/hit_gra2.gif border=0 align=absmiddle>";
				elseif ($data[hit]<=$max_hit*2/3)
					echo "<img src=$dir/images/hit_gra3.gif border=0 align=absmiddle>";
				elseif ($data[hit]<=$max_hit)
					echo "<img src=$dir/images/hit_gra4.gif border=0 align=absmiddle>";
				else echo "<img src=$dir/images/hit_gra5.gif border=0 align=absmiddle>";?></td><?}?><?}?>

			</tr>
			</table>
		</td>
		<td class=list_notice4></td>
	</tr>
<? /*if ($hide_no=="on"||$browser=="1") $colspan=2; else $colspan=3;*/?>
	<tr><td height=2 colspan=<?=$colspan?>></td></tr>
<?$coloring++;?>
