<?
unset($_point);
unset($tmp_memo);
unset($aver_point);

/* Check New Comment $comment_new */
$last_comment = mysqli_fetch_array(mysqli_query($connect,"select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
$last_comment_time = $last_comment['reg_date'];
if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
else $comment_new = "&nbsp;<font class=list_eng style='font-size:8pt;'>".$comment_num."</font>";

$m_memo = explode("|||",$data[memo]);
$_name1 = $m_memo[0];
$_name2 = $m_memo[1];
$_name3 = $m_memo[2];
$_name4 = $m_memo[3];
$_name5 = $m_memo[4];
$_name6 = $m_memo[5];
$_name7 = $m_memo[6];
$_name8 = $m_memo[7];
$_name9 = $m_memo[8];
$_name10 = $m_memo[9];
$_name1=strip_tags($_name1);
//$subject = str_replace(">","><font class=title_han4>",$subject);
$list_memo=explode("\n",cut_str($_name1,150));
for($i=0;$i<=count($list_memo)-1;$i++)
	$tmp_memo=$tmp_memo.trim($list_memo[$i]);

$tmp_memo = love_convert($tmp_memo);

$total_comment=mysqli_fetch_array(mysqli_query($connect,"select count(*) from $table where parent='$data[no]' and point1+point2 > 0"));
if($total_comment[0]>0){
	$total_point=0;
	$query1=mysqli_query($connect,"select * from $table where parent='$data[no]' and point1+point2 > 0");
	while($result1=mysqli_fetch_array($query1)){
		$total_point=$total_point+$result1[point1]*2+$result1[point2];
	}
	$aver=$total_point/$total_comment[0];
	$aver=$aver / 2;
	for($i=1;$i<=floor($aver);$i++) $aver_point.="★";
	if(round($aver)==ceil($aver)&&ceil($aver)!=$aver) $aver_point=$aver_point."☆";
}

include "list_image_info.php";

for($i=1;$i<=$_name6;$i++){
	$_point.="★";
}
if($_name7==1) $_point=$_point."☆";

if($counter%$num==1){?>
	<tr><?}?>

	<td align=center valign=top>
		<table border=0 cellspacing=0 cellpadding=0 align=center width=100% style=table-layout:fixed>
		<tr>
		<td align=left valign=top>
			<?=$view_img?><img src=<?=$thumb_img?> border=0 align=left width=<?=$min_width_size?> height=<?=$min_width_size*3/2?> class=shadow2 style=border-width:4pt;border-style:solid;border-color:#f1f1f1;></a>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=2 background=<?=$dir?>/images/main_bar_line.gif></td></tr>
			<tr><td height=5></td></tr>
			</table>
			<?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?><?=$hide_category_start?><nobr>[<?=$category_name?>]</nobr> <?=$hide_category_end?><?=$subject?>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
			<img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle>&nbsp;<B>감독</B> :&nbsp;<?=$_name2?><BR>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
			<img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle>&nbsp;<B>개봉일</B> :&nbsp;<?=$_name3?><BR>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
			<img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle>&nbsp;<B>장르</B> :&nbsp;<?=$_name4?><BR>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
			<img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle>&nbsp;<B>상영시간</B> :&nbsp;<?=$_name8?>분<BR>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
			<img src=<?=$dir?>/images/point_fr2.gif border=0 align=absmiddle> :&nbsp;<?=$_point?><BR>
			<img src=<?=$dir?>/images/point_fr3.gif border=0 align=absmiddle> :&nbsp;<?=$aver_point?><BR>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
		</td>
		</tr>
		<tr>
		<td align=left>
			<table border=0 cellspacing=0 cellpadding=2 width=100%>
			<tr><td><img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle>&nbsp;<B>주연</B>(출연)
			<BR>&nbsp;<?=$_name5?></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr>
			</table>
			<table border=0 cellspacing=0 cellpadding=3 width=100% height=80 style=border-width:1px;border-color:#eeeeee;border-style:solid;>
			<tr><td valign=top><div style="overflow:hidden"><B>· 영화내용</B>(줄거리) :&nbsp;<?=del_html($tmp_memo)?><?=$comment_new?></div></td></tr>
			</table>
		</td>
		</tr>
		</table>
	</td>
<?if($counter%$num==0){?>
	</tr>
<?} $counter++; ?>
