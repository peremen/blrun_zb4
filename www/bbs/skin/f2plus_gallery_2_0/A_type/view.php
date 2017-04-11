<?
include "view_image_info.php";
$_name1=explode("|||",$data[memo]);
$memo=str_replace($data[memo],$_name1[0],$memo);
if($emoticon_use=="on") $memo=str_to_emoticon($memo,$emoticon_url);
if (!$connect) $connect=dbconn();
$m_data=mysql_fetch_array(mysql_query("SELECT * FROM zetyx_member_table where no=$data[ismember]"));
?>

<table border=0 cellspacing=0 cellpadding=2 width=<?=$width?> align=center style=table-layout:fixed;border-width:1pt;border-style:solid;border-color:#cccccc>
<col width=74></col><col width=></col>
<tr align=left valign="middle" height=25>
	<td align=left class=com>&nbsp;&nbsp;<img src=<?=$dir?>/front_img.gif>&nbsp;&nbsp;Subject : </td>
	<td align=left class=title2_han><?=$hide_category_start?>[<?=$category_name?>] <?=$hide_category_end?><?=$subject?></td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=2 width=<?=$width?> align=center style=table-layout:fixed>
<col width=></col><col width=70></col><col width=100></col>
<tr><td align=left>
	<?=$face_image?> <b><font class=title_han4><?=$name?></font></b>
	<?if($data['homepage']){?><a class=list_eng href="<?=$data['homepage']?>" target=_blank>(Homepage)</a><?}?>

	<font class=com5>&nbsp;|&nbsp;</font><font class=com3>Point : <?=($m_data[point1]*10+$m_data[point2])?></font><font class=com5>&nbsp;|&nbsp;</font>
	<font class=com3><?=$date?></font><font class=com5>&nbsp;|&nbsp;</font>
	<font class=com3>Read : <?=number_format($hit)?></font><font class=com5>&nbsp;|&nbsp;</font>
	<font class=com3>Vote : <?=$vote?></font>
	</td>
	<?if($prev_thumb){?><td align=left><?=$a_prev?><span onMouseMove="msgposit(100,-15,event)";  onMouseOver="msgset('<img src=<?=$prev_thumb?> border=0 width=200>')"; onMouseOut="msghide();" class=shadow style='cursor:pointer'><img src=<?=$dir?>/prev_img.gif border=0 align=absmiddle></span></a></td><?}?>

	<?if($next_thumb){?><td align=left><?=$a_next?><span onMouseMove="msgposit(100,-15,event)";  onMouseOver="msgset('<img src=<?=$next_thumb?> border=0 width=200>')"; onMouseOut="msghide();" class=shadow style='cursor:pointer'><img src=<?=$dir?>/next_img.gif border=0 align=absmiddle></span></a></td><?}?>

</tr>
<tr><td height=1 colspan=3 background=<?=$dir?>/dot.gif></td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=4 width=<?=$width?> align=center>
<tr class=list2>
	<td height=100 valign=top>
		<table align=center border=0 cellspacing=0 width=100% style=table-layout:fixed height=10>
		<tr>
			<td align=left class=com2>
				<?=$hide_sitelink1_start?><font class=com2>- <b>SiteLink #1</b> : <?=$sitelink1?></font><br><?=$hide_sitelink1_end?>

				<?=$hide_sitelink2_start?><font class=com2>- <b>SiteLink #2</b> : <?=$sitelink2?></font><br><?=$hide_sitelink2_end?>

			</td>
		</tr>
		<tr>
			<td align=center>
				<?=$view_img1?><br>
				<?=$hide_download1_start?><font class=com2>- <b>Download #1</b> : <?=$a_file_link1?><?=$file_name1?> <font class=com6>(<?=$file_size1?>,<?=$img_info1[0]?>x<?=$img_info1[1]?>)</font></a>, Download : <?=$file_download1?></font>&nbsp;<?=$print_img1?><img src=<?=$dir?>/show_img.gif border=0 align=absmiddle></a><br><?=$hide_download1_end?>

			</td>
		</tr>
		<tr>
			<td align=center class=com2>
				<?=$view_img2?><br>
				<?=$hide_download2_start?><font class=com2>- <b>Download #2</b> : <?=$a_file_link2?><?=$file_name2?> <font class=com6>(<?=$file_size2?>,<?=$img_info2[0]?>x<?=$img_info2[1]?>)</font></a>, Download : <?=$file_download2?>&nbsp;<?=$print_img2?><img src=<?=$dir?>/show_img.gif border=0 align=absmiddle></a></font><?=$hide_download2_end?>

			</td>
		</tr>
		</table>
		<table border=0 cellspacing=0 cellpadding=10 width=100% style=table-layout:fixed>
		<tr>
			<td align=left class=memo>
				<!--여기부터 본문 내용 시작입니다-->
				<?=$memo?><BR><BR>
				<? include "script/sns.php"; ?>
				<div align=right class=com5><?=$ip?></div><br>
				<a href="http://www.ntzn.net/" target="_blank" style="color:blue;">http://www.ntzn.net/</a>
				<!--여기까지 본문 내용 끝입니다-->
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr><td background=<?=$dir?>/dot.gif border=0 height=1></td>
</tr>
</table>

<img src=<?=$dir?>/t.gif border=0 height=2><br>
<?if($member['level']<=$setup['grant_comment']){?>
<?=$hide_comment_start?><img src=<?=$dir?>/t.gif border=0 height=2><br><?=$hide_comment_end?>
<?}?>
