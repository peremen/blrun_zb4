<?
	$subject = str_replace(">","><font class=list_han>",$subject);
	$name= str_replace(">","><font class=list_han>",$name);

	/* Check New Comment $comment_new */
	$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
	$last_comment_time = $last_comment['reg_date'];
	if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
	elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
	else $comment_new = "&nbsp;<font class=list_eng style='font-size:8pt;'>".$comment_num."</font>";

	$number= str_replace("/arrow.gif","/images/arrow3.gif",$number);
	$icon= str_replace("/old_head.gif","/images/old_head.gif",$icon);
	$icon= str_replace("/new_head.gif","/images/new_head.gif",$icon);
	$icon= str_replace("/reply_new_head.gif","/images/reply_new_head.gif",$icon);
	$icon= str_replace("/secret_head.gif","/images/secret_head.gif",$icon);

	include "list_image_info.php";
	unset($_m);	
    unset($line);	
	$_m = explode("\n",strip_tags($data['memo']));	
	for($i=0;$i<count($_m);$i++) 
	if(trim($_m[$i])) $line[] = $_m[$i];
	$tmp_memo=$line[0]."".$line[1]."".$line[2]."".$line[3]."".$line[4]."".$line[5]."".$line[6]."".$line[7]."".$line[8]."".$line[9]."".$line[10];// 이부분이 미리나오는 내용 입니다. 라인 1,2,3 적용	if($line[11]) $tmp_memo.="..."; 
	$_name1=explode("||",$tmp_memo);
	$_name1[0] = love_convert($_name1[0]);
	$m_data=mysql_fetch_array(mysql_query("SELECT * FROM zetyx_member_table where no=$data[ismember]",$connect));
?>

<tr align=center height=55 style=padding-bottom:3px>
	<td class=list_main1></td><?if($hide_no!="on"){?>
	<? if($browser=="1"){ ?><td class=list_main2 nowrap><div style="overflow:hidden"><?=$number?></div></td><? } ?><?}?>
	<? if($browser=="1"){ ?><td class=list_main2_2 style=padding-top:4px border=0 align=center valign=top>
		<table border=0 cellspacing=0 cellpadding=0 align=center  width=56 style=border-width:1pt;border-style:solid;border-color:#eeeeee class=shadow2>
		<tr><td><?=$view_img?><img src=<?=$thumb_img?> width=52 height=39 style=border-width:1pt;border-style:solid;border-color:#000000;></td></tr></table>
	</td><? } ?>
	<td class=list_main3>
		<table border=0 cellspacing=0 cellpadding=0 width=100% align=center style=table-layout:fixed>
		<col width=100%></col>
		<?if($hide_name!="on"){?><? if($browser=="1"){ ?><col width=100></col><? } ?><?}?>
		<?if($hide_date!="on"){?><? if($browser=="1"){ ?><col width=65></col><? } ?><?}?>
		<?if($hide_vote!="on"){?><? if($browser=="1"){ ?><col width=35></col><? } ?><?}?>
		<?if($hide_hit!="on"){?><? if($browser=="1"){ ?><col width=50></col><? } ?><?}?>
		<tr valign=middle>
			<td align=left style=padding-top:7px nowrap><div style="overflow:hidden"><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?>&nbsp;<?=$hide_category_start?><nobr>[<?=$category_name?>]</nobr>&nbsp;<?=$hide_category_end?><?=$insert?><B><?=$subject?></B><?=$comment_new?>&nbsp;<?=$icon?></div></td> 
			<?if($hide_name!="on"){?><? if($browser=="1"){ ?><td align=center style=padding-top:4px><div style="overflow:hidden"><nobr><?=$face_image?><?=$name?></nobr></div></td><? } ?><?}?>
			<?if($hide_date!="on"){?><? if($browser=="1"){ ?><td nowrap class=list_eng align=center><?=$reg_date?></td><? } ?><?}?>
			<?if($hide_vote!="on"){?><? if($browser=="1"){ ?><td nowrap class=list_eng align=center><?=$vote?></td><? } ?><?}?>
			<?if($hide_hit!="on"){?><? if($browser=="1"){ ?><td nowrap class=list_eng align=center><?=$hit?></td><? } ?><?}?></tr>
		<tr valign=bottom>
			<td align=left style=padding-top:6px><div style="overflow:hidden"><nobr><font style=color:8D8D8D>&nbsp;&nbsp;&nbsp;
			<? if(!$data[is_secret]) echo substr(stripslashes($_name1[0]),0,400); else echo "비밀글입니다"; ?>
			</font></nobr></div></td>
			<?if($hide_name!="on"){?><? if($browser=="1"){ ?>
			<td align=center class=com8 style=padding-bottom:2px><div style="overflow:hidden"><img src=<?=$dir?>/images/point.gif align=absmiddle>&nbsp;<?=($m_data[point1]*10+$m_data[point2])?></div></td><? } ?><?}?>
			<?if($hide_date!="on"){?><? if($browser=="1"){ ?>
			<td align=center style=padding-top:8px><font class=com8 color=aaaaaa><?=date("H:i:s",$data[reg_date])?></font></td><? } ?><?}?>
			<?if($hide_vote!="on"){?><? if($browser=="1"){ ?><td></td><? } ?><?}?>
			<?if($hide_hit!="on"){?><? if($browser=="1"){ ?><td align=center valign=bottom style=padding-bottom:4px>
			<? if ($data[hit]<$max_hit/15)
						echo "<img src=$dir/images/hit_gra1.gif border=0 align=absmiddle>";
						elseif ($data[hit]<$max_hit/3)
							echo "<img src=$dir/images/hit_gra2.gif border=0 align=absmiddle>";
						elseif ($data[hit]<$max_hit*2/3)
							echo "<img src=$dir/images/hit_gra3.gif border=0 align=absmiddle>";
						elseif ($data[hit]<$max_hit)
							echo "<img src=$dir/images/hit_gra4.gif border=0 align=absmiddle>";
						else echo "<img src=$dir/images/hit_gra5.gif border=0 align=absmiddle>";
			?>			
			</td><? } ?><?}?>
		</tr>
		</table>
	</td>
	<td class=list_main4></td>
</tr>
<tr><td colspan=<?=$colspan?> height=3></td></tr>

