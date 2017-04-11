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

	<tr align=center height=45 style=padding-bottom:0px class=list<?=$coloring%2?>>
		<?if($hide_no=="off"){?><? if($browser=="1"){ ?><td style=padding-top:0px;padding-bottom:4px class=com4 align=center nowrap><div style="overflow:hidden"><img src=<?=$dir?>/images/notice_fr.gif align=absmiddle border=0></div></td><? } ?><?}?>

		<? if($browser=="1"){ ?><td style=padding-top:0px;padding-bottom:4px border=0 align=center><?=$view_img?><img src=<?=$thumb_img?> width=52 height=39 class=shadow2 style=border-width:1pt;border-style:solid;border-color:#000000;></td><? } ?>

		<td>
			<table border=0 cellspacing=0 cellpadding=0 width=100% align=center style=table-layout:fixed>
			<col width=100%></col><?if($hide_name=="off"){?><? if($browser=="1"){ ?><col width=100></col><? } ?><?}?><?if($hide_date=="off"){?><? if($browser=="1"){ ?><col width=65></col><? } ?><?}?><?if($hide_vote=="off"){?><? if($browser=="1"){ ?><col width=35></col><? } ?><?}?><?if($hide_hit=="off"){?><? if($browser=="1"){ ?><col width=50></col><? } ?><?}?>

			<tr>
				<td align=left nowrap><div style="overflow:hidden"><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?><img src=<?=$dir?>/images/notice_fr2.gif align=absmiddle border=0>&nbsp;<?=$insert?><B><?=$subject?></B><?=$comment_new?></div></td>
				<?if($hide_name=="off"){?><? if($browser=="1"){ ?><td nowrap align=center><div style="overflow:hidden"><nobr><?=$face_image?><?=$name?></nobr></div></td><? } ?><?}?>

				<?if($hide_date=="off"){?><? if($browser=="1"){ ?><td nowrap class=list_eng align=center><?=$reg_date?></td><? } ?><?}?>

				<?if($hide_vote=="off"){?><? if($browser=="1"){ ?><td nowrap class=list_eng align=center><?=$vote?></td><? } ?><?}?>

				<?if($hide_hit=="off"){?><? if($browser=="1"){ ?><td nowrap class=list_eng align=center><?=$hit?></td><? } ?><?}?>

			</tr>
			<tr><td background=<?=$dir?>/images/dot.gif border=0 height=1 colspan=<?=$cols?>></td>
			</tr>
			<tr valign=middle>
				<td align=left><div style="overflow:hidden"><nobr><font style=color:#B0B0B0><? if(!$data[is_secret]) echo del_html(substr($_name1[0],0,400)); else echo "비밀글입니다"; ?></font></nobr></div></td>
				<?if($hide_name=="off"){?><? if($browser=="1"){ ?><td align=center class=com3><div style="overflow:hidden"><img src=<?=$dir?>/images/point.gif align=absmiddle>&nbsp;<?=($m_data[point1]*10+$m_data[point2])?></div></td><? } ?><?}?>

				<?if($hide_date=="off"){?><? if($browser=="1"){ ?><td align=center><font class=com3 color=#aaaaaa><?=date("H:i:s",$data[reg_date])?></font></td><? } ?><?}?>

				<?if($hide_vote=="off"){?><? if($browser=="1"){ ?><td></td><? } ?><?}?>

				<?if($hide_hit=="off"){?><? if($browser=="1"){ ?><td align=center valign=bottom><? if ($data[hit]<=$max_hit/15)
					echo "<img src=$dir/images/hit_gra1.gif border=0 align=absmiddle>";
				elseif ($data[hit]<=$max_hit/3)
					echo "<img src=$dir/images/hit_gra2.gif border=0 align=absmiddle>";
				elseif ($data[hit]<=$max_hit*2/3)
					echo "<img src=$dir/images/hit_gra3.gif border=0 align=absmiddle>";
				elseif ($data[hit]<=$max_hit)
					echo "<img src=$dir/images/hit_gra4.gif border=0 align=absmiddle>";
				else echo "<img src=$dir/images/hit_gra5.gif border=0 align=absmiddle>";
				?></td><? } ?><?}?>

			</tr>
			</table>
		</td>
	</tr>
	<tr><td colspan=<?=$colspan?> height=1 bgcolor=#cccccc></td></tr>
	<tr><td height=1 bgcolor=#eaeaea colspan=<?=$colspan?>></td></tr>
	<tr><td height=1 bgcolor=#efefef colspan=<?=$colspan?>></td></tr>
	<tr><td height=1 bgcolor=#f3f3f3 colspan=<?=$colspan?>></td></tr>
	<tr><td height=1 bgcolor=#f6f6f6 colspan=<?=$colspan?>></td></tr>
	<tr><td height=1 bgcolor=#f9f9f9 colspan=<?=$colspan?>></td></tr>
<?$coloring++;?>