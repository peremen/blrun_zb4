<?
	if($is_admin) $show_comment_ip = "<font class=list_eng>".$c_data['ip']."</font>";
	else $show_comment_ip = "";
?>
<table width=<?=$width?> border=0 cellspacing=0 cellpadding=0 style=table-layout:fixed>
<tr>
    <td width=100% bgcolor=#B4D2DE><img src=<?=$dir?>/t.gif height=1></td>
</tr>
<tr>
	<td height=3><img src=<?=$dir?>/t.gif border=0 hieght=3></td>
</tr>
<tr valign=top>
	<td style='word-break:break-all;padding-left:10px;' class=list_han>
		<a name="<?=$c_data[no]?>">
		<table border=0 cellspacing=0 cellpadding=0 width=100% style=table-layout:fixed>
		<tr>
			<td width=><?=$c_face_image?> <?=$comment_name?> </b><font class=list_eng color=888888>(<?=date("Y-m-d H:i:s",$c_data[reg_date])?>)</font> <?=$show_comment_ip?></td>
			<td width=70 align=right style=font-family:verdana;font-size:9px;><?=$a_edit2?><img src=<?=$dir?>/edit2.gif border=0 valign=absmiddle></a> <?=$a_edit?><img src=<?=$dir?>/edit.gif border=0 valign=absmiddle></a> <?=$a_del?><img src=<?=$dir?>/del.gif border=0 valign=absmiddle></a><img src=images/t.gif border=0 width=1 height=1>&nbsp;</td>
		</tr>
		</table>
		</a>
	</td>
</tr>
<tr>
	<td style='word-break:break-all;padding:2px;padding-left:10px;padding-top:5px;'>&nbsp;::: 
		<?
		if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$member[level]>$setup[grant_view_secret])
			echo "<span style='color:gray;font-size:10pt'>비밀 덧글입니다</span>";
		else {
		?>
			<?=$c_hide_download1_start?><br><font class=list_eng>- <b>Download #1</b> : <?=$c_file_link1?><?=$c_file_name1?> (<?=$c_file_size1?>)</a>, Download : <?=$c_file_download1?></font><br><?=$c_upload_image1?><?=$c_hide_download1_end?>
			<?=$c_hide_download2_start?><br><font class=list_eng>- <b>Download #2</b> : <?=$c_file_link2?><?=$c_file_name2?> (<?=$c_file_size2?>)</a>, Download : <?=$c_file_download2?></font><br><?=$c_upload_image2?><?=$c_hide_download2_end?>
			<br><?if($c_data[is_secret]) echo "<img src=".$dir."/post_security.gif border=0>";?><?=$c_memo?>
		<? } ?>
	</td>
</tr>
<tr>
	<td height=3><img src=images/t.gif border=0 hieght=3></td>
</tr>
</table>