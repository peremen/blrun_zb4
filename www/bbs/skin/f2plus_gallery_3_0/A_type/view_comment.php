<?
$c_memo = love_convert($c_memo);
if($is_admin) $show_comment_ip = $c_data['ip'];
else $show_comment_ip = "";
$a_del=str_replace("del_comment.php?","del_comment.php?_zb_url=$zb_url/&_zb_path=$zb_path&",$a_del);
?>

<a name="<?=$c_data[no]?>">
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=3 align=center style=table-layout:fixed>
<col width=10></col><col width=></col><col width=10></col>
<tr valign=top>
	<td height=9 background=<?=$dir?>/images/cc_head_bg1.gif></td>
	<td background=<?=$dir?>/images/cc_head_bg2.gif></td>
	<td background=<?=$dir?>/images/cc_head_bg3.gif></td>
</tr>
<tr>
<td background=<?=$dir?>/images/cc_middle_bg1.gif></td>
<td><font color=F2955C class=com><?=++$count?>.</font>&nbsp;::: 
	<?
	if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$member[level]>$setup[grant_view_secret])
		echo "<span style='color:gray;font-size:10pt'>비밀 덧글입니다</span>";
	else {
	?>

	<?=$c_hide_download1_start?><br><font class=com2>- <b>Download #1</b> : <?=$c_file_link1?><?=$c_file_name1?> (<?=$c_file_size1?>)</a>, Download : <?=$c_file_download1?></font><br><?=$c_upload_image1?><?=$c_hide_download1_end?>

	<?=$c_hide_download2_start?><br><font class=com2>- <b>Download #2</b> : <?=$c_file_link2?><?=$c_file_name2?> (<?=$c_file_size2?>)</a>, Download : <?=$c_file_download2?></font><br><?=$c_upload_image2?><?=$c_hide_download2_end?>

	<br><font class=com2><?if($c_data[is_secret]) echo "<img src=".$dir."/images/post_security.gif border=0>";?><?=$c_memo?></font>
	<? } ?></td>
	<td background=<?=$dir?>/images/cc_middle_bg2.gif></td>
</tr>
</table>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=3 align=center style=table-layout:fixed>
<col width=10></col><col width=></col><col width=240></col><col width=10></col>
<tr valign=bottom>
	<td background=<?=$dir?>/images/cc_foot_bg1.gif height=45></td>
	<td background=<?=$dir?>/images/cc_foot_bg2.gif valign=top><BR><img src=images/t.gif height=4><BR><?=$c_face_image?> <font class=thm7pt><?=$comment_name?>&nbsp;</font></td>
	<td background=<?=$dir?>/images/cc_foot_bg2.gif align=right><font class=com5><?=$show_comment_ip?></font><BR><img src=<?=$dir?>/images/t.gif height=7 align=absmiddle><BR><font class=com3><img src=<?=$dir?>/images/c_date.gif border=0 align=absmiddle> <?=date("Y-m-d",$c_data[reg_date])?>&nbsp;<?=date("H:i:s",$c_data[reg_date])?>&nbsp;</font> <?=$a_edit2?><img src=<?=$dir?>/images/edit2.gif border=0 valign=absmiddle></a> <?=$a_edit?><img src=<?=$dir?>/images/edit.gif border=0 valign=absmiddle></a> <font style=font-family:tahoma;color:f1f1f1;font-size:7pt><?=$a_del?><img src=<?=$dir?>/images/c_del.gif border=0 align=top></font></a></td>
	<td background=<?=$dir?>/images/cc_foot_bg3.gif align=left></td>
</tr>
</table>
</a>
