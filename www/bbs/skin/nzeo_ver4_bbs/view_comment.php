<?
	if($is_admin) $show_comment_ip = "<font class=list_eng>".$c_data['ip']."</font>";
	else $show_comment_ip = "";
?>
<a name="<?=$c_data[no]?>">
<table border=0 cellspacing=0 cellpadding=0 height=1 width=<?=$width?>>
<tr><td height=1 class=line1 style=height:1px><img src=<?=$dir?>/t.gif border=0 height=1></td></tr>
<tr><td height=8 bgcolor=white></td></tr>
</table>
<table width=<?=$width?> cellspacing=1 cellpadding=4 style=table-layout:fixed>
<col width=70></col><col width=8></col><col width=></col><col width=64></col>
<tr valign=top bgcolor=white>
	<td>
		<table border=0 cellspacing=0 cellpadding=0 width=100% style=table-layout:fixed>
		<tr>
			<td class=list_han><NOBR><?=$c_face_image?> <?=$comment_name?></NOBR></td>
		</tr>
		</table>
		<?=$show_comment_ip?>
	</td>
	<td width=8 class=line2 style=padding:0px></td>
	<td>&nbsp;::: 
		<?
		if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$member[level]>$setup[grant_view_secret])
			echo "<span style='color:gray;font-size:10pt'>비밀 덧글입니다</span>";
		else {
		?>
			<?=$c_hide_download1_start?><br><font class=list_eng>- <b>Download #1</b> : <?=$c_file_link1?><?=$c_file_name1?> (<?=$c_file_size1?>)</a>, Download : <?=$c_file_download1?></font><br><?=$c_upload_image1?><?=$c_hide_download1_end?>
			<?=$c_hide_download2_start?><br><font class=list_eng>- <b>Download #2</b> : <?=$c_file_link2?><?=$c_file_name2?> (<?=$c_file_size2?>)</a>, Download : <?=$c_file_download2?></font><br><?=$c_upload_image2?><?=$c_hide_download2_end?>
			<br><font class=list_han><?if($c_data[is_secret]) echo "<img src=".$dir."/post_security.gif border=0>";?><?=$c_memo?></font>
		<? } ?>
	</td>
	<td align=right><font class=list_eng><?=date("Y-m-d",$c_data[reg_date])?><br><?=date("H:i:s",$c_data[reg_date])?></font><br><?=$a_edit2?><img src=<?=$dir?>/edit2.gif border=0 valign=absmiddle></a> <?=$a_edit?><img src=<?=$dir?>/edit.gif border=0 valign=absmiddle></a> <?=$a_del?><img src=<?=$dir?>/del.gif border=0 valign=absmiddle></a></td>
</tr>
<tr><td height=8 bgcolor=white></td></tr>
</table>
</a>