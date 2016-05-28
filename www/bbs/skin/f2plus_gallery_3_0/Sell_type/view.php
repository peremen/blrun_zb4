<?
unset ($_point);
unset ($aver_point);
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
$_name1 = love_convert($_name1);

for($i=1;$i<=$_name6;$i++){
	$_point.="★";
}
if($_name7==1) $_point=$_point."☆";

include "view_image_info.php";

if (!$connect) $connect=dbconn();
$m_data=mysql_fetch_array(mysql_query("SELECT * FROM zetyx_member_table where no=$data[ismember]"));

$total_comment=mysql_fetch_array(mysql_query("select count(*) from $table where parent='$data[no]' and point1+point2 > 0"));
if($total_comment[0]>0){
	$total_point=0;
	$query1=mysql_query("select * from $table where parent='$data[no]' and point1+point2 > 0");
	while($result1=mysql_fetch_array($query1)){
		$total_point=$total_point+$result1[point1]*2+$result1[point2];
	}
	$aver=$total_point/$total_comment[0];
	$aver=$aver / 2;
	for($i=1;$i<=floor($aver);$i++) $aver_point.="★";
	if(round($aver)==ceil($aver)&&ceil($aver)!=$aver) $aver_point=$aver_point."☆";
}
?>

<table border=0 cellspacing=0 cellpadding=2 width=<?=$width?> align=center style=table-layout:fixed;border-width:1pt;border-style:solid;border-color:cccccc>
<col width=74></col><col width=></col>
<tr align=left valign="middle" height=25>
	<td class=com>&nbsp;&nbsp;<img src=<?=$dir?>/images/front_img.gif>&nbsp;&nbsp;Subject : </td>
	<td class=title2_han><?=$hide_category_start?>[<?=$category_name?>] <?=$hide_category_end?><?=$subject?></td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=4 width=<?=$width?> align=center>
<tr class=list2 valign=top>
<td valign=top>
	<table border=0 cellspacing=0 cellpadding=2 width=100% align=center style=table-layout:fixed>
	<tr><?if($hide_name=="off"){?><td align=left>
	<?=$face_image?> <b><font class=title_han4><?=$name?></font></b>
	<?if($data['homepage']){?><font class=title_han4><a href="<?=$data['homepage']?>" target=_blank>(Homepage)</a></font><?}?>
	
	<font class=com5>&nbsp;|&nbsp;</font><font class=com3>Point : <?=($m_data[point1]*10+$m_data[point2])?></font><font class=com5>&nbsp;|&nbsp;</font><?}?><?if($hide_date=="off"){?><font class=com3><?=$date?></font><font class=com5>&nbsp;|&nbsp;</font><?}?><?if($hide_hit=="off"){?><font class=com3>Read : <?=number_format($hit)?></font><font class=com5>&nbsp;|&nbsp;</font><?}?><?if($hide_vote=="off"){?><font class=com3>Vote : <?=$vote?></font><?}?></td></tr>
	<tr><td height=1 colspan=2 background=<?=$dir?>/images/dot.gif></td></tr></table>
	<table border=0 cellspacing=0 cellpadding=3 width=100% style=table-layout:fixed>
	<tr><td>&nbsp;&nbsp;<img src=<?=$dir?>/images/sell_intro.gif></td></tr>
	<tr><td height=5></td></tr>
	<tr valign=top>
		<td style=padding-left:10px><?=$print_img1?><?=$view_img1?></a>
			<table border=0 cellpadding=0 cellspacing=0><tr><td nowrap width=55><img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle><B>&nbsp;제목</B> :&nbsp;</td><td nowrap width=100%><?=$subject?></td></tr></table>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
			<img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle><B>&nbsp;제조사</B> :&nbsp;<?=$_name2?><BR>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
			<img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle><B>&nbsp;원산지</B> :&nbsp;<?=$_name3?><BR>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
			<img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle><B>&nbsp;상품수</B> :&nbsp;<?=$_name4?><BR>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
			<img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle><B>&nbsp;판매가</B> :&nbsp;<?=$_name8?>원<BR>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
			<img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle><B>&nbsp;옵션</B>(종류) :&nbsp;<?=$_name5?><BR>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td height=4></td></tr>
			<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
			<tr><td height=4></td></tr></table>
			<BR><BR><BR>
			<table border=0 cellspacing=1 cellpadding=5 align=center width=250 style=border-width:1px;border-style:solid;border-color:C5C5C5>
			<col width=></col><col width=140></col>
			<tr bgcolor=eeeeee>
			<td>
				<a href=<?=$data[sitelink1]?> target=_blank><font class=list_eng><img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle>&nbsp;제조 홈페이지</font></a>
			</td>
			<td align=right><font class=list_eng><img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle>&nbsp;동영상 &nbsp;</font><a href=javascript: onclick="player('<?=$_name9?>','800','600')"><img src=<?=$dir?>/images/movie_view1.gif border=0 align=absmiddle></a> &nbsp;<a href=javascript: onclick="player('<?=$_name10?>','800','600')"><img src=<?=$dir?>/images/movie_view2.gif border=0 align=absmiddle></a></td>
			</tr>
			<tr>
			<td colspan=2><img src=<?=$dir?>/images/point_fr2.gif border=0 align=absmiddle> :&nbsp;<?=$_point?><br>
			<img src=<?=$dir?>/images/point_fr3.gif border=0 align=absmiddle> :&nbsp;<?=$aver_point?><BR></td>
			</tr>
			<tr bgcolor=eeeeee height=15><td align=right colspan=2>
				<table border=0 width=100% cellspacing=0 cellpadding=0 align=center>
				<col width=></col><col width=77></col>
				<tr><td align=right>
				<a href=<?=$data[sitelink2]?> target=_blank><font class=list_eng><img src=<?=$dir?>/images/bolddot.gif border=0 align=absmiddle>&nbsp;관련홈페이지</font></a> <a href="#m_review_w"><font class=list_eng><img src=<?=$dir?>/images/m_review_w.gif border=0 align=absmiddle>상품평쓰기</font></a></td>
				<td align=right><a href="#m_review_r"><font class=list_eng><img src=<?=$dir?>/images/m_review_r.gif border=0 align=absmiddle>상품평보기</font></a></td></tr>
				</table>
			</td>
			</tr>
			</table>
<? if (!$view_img2){
	echo "
		</td>
	</tr>
	<tr>
		<td class=memo>
			<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr>
				<td height=4></td>
			</tr>
			<tr>
				<td height=1 background=$dir/images/dot.gif></td>
			</tr>
			<tr>
				<td height=4></td>
			</tr>
			</table>
			<B>&nbsp;· 상품설명</B> :<BR><BR>".$_name1."<BR><BR>";
	include "script/sns.php";
	echo "
		</td>
	</tr>";
}else{?>
		</td>
	</tr>
	<tr><td height=2 background=<?=$dir?>/images/main_bar_line.gif></td></tr>
	<tr valign=top>
		<td class=memo><BR>			
		<?=$print_img2?><?=$view_img2?></A>
		<B>&nbsp;· 상품설명</B> :<BR><BR><?=$_name1?><BR><BR>
		<? include "script/sns.php"; ?>
		</td>
	</tr>
<?}?><BR>
	<tr>
		<td>
			<table width=100% border=0>
			<tr><td>
			<div align=right class=com5><?=$ip?></div><br>
			<a href="http://www.ntzn.net/" target="_blank" style="color:blue;">http://www.ntzn.net/</a>
			</td></tr>
			</table>
		</td>
	</tr>
	<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>		
	</table>
</td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=3 width=<?=$width?> align=center style=table-layout:fixed>
<TR>
<TD>&nbsp;<IMG height=30 src=<?=$dir?>/images/sell_foot_line.gif name=zb_target_resize width=612></TD>
</TR>
<TR>
<TD><DIV style="MARGIN: 5pt; LINE-HEIGHT: 17pt" align=justify>&nbsp;&nbsp;<IMG height=11 src=<?=$dir?>/images/sell_foot_bt.gif width=12>배송지역 : 전국<BR>&nbsp;&nbsp;<IMG height=11 src=<?=$dir?>/images/sell_foot_bt.gif width=12>미국 직배송 상품으로 받아보시는데 7일에서 최고 15일 이내 소요</DIV></TD>
</TR>
<tr><td height=1 background=<?=$dir?>/images/dot.gif></td></tr>
</table>

<img src=<?=$dir?>/images/t.gif border=0 height=2><br>
<?if($member['level']<=$setup['grant_comment']){?>
<?=$hide_comment_start?><img src=<?=$dir?>/images/t.gif border=0 height=2><br><?=$hide_comment_end?>
<?}?>
<table border=0 cellspacing=0 cellpadding=3 width=<?=$width?> align=center style=table-layout:fixed>
<tr><td align=left><a name="m_review_r"><img src=<?=$dir?>/images/sell_review.gif border=0></a><br></td></tr>
</table>
