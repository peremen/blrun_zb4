<?
if($emoticon_use=="on") $c_memo=str_to_emoticon($c_memo,$emoticon_url);
?>

<div id=IAMCOMMENT_<?=$c_data[no]?> align=right style="display:none;width:<?=$width?>">
<table id=comment_<?=$c_data[no]?> border=0 width=<?=$width?> cellspacing=0 cellpadding=0 style=table-layout:fixed>
<tr><td>
<a name="<?=$c_data[no]?>">
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0 align=center style=table-layout:fixed>
<col width=10></col><col width=></col><col width=10></col>
<tr valign=top>
	<td height=9 background=<?=$dir?>/cc_head_bg1.gif></td>
	<td background=<?=$dir?>/cc_head_bg2.gif></td>
	<td background=<?=$dir?>/cc_head_bg3.gif></td>
</tr>
<tr>
	<td background=<?=$dir?>/cc_middle_bg1.gif></td>
	<td align=left class=memo><font color=#F2955C class=com><?=++$count?>.</font>&nbsp;:::
		<?
		if($o_data[ismember]=="") $ismember0="0"; else $ismember0=$o_data[ismember];
		if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$ismember0!=$member[no]&&$member[level]>$setup[grant_view_secret])
			echo "<span style='color:gray;font-size:10pt'>비밀 덧글입니다</span>";
		else {
		?>

		<?=$c_hide_download1_start?><br><font class=com2>- <b>Download #1</b> : <?=$c_file_link1?><?=$c_file_name1?> (<?=$c_file_size1?>)</a>, Download : <?=$c_file_download1?></font><br><?=$c_upload_image1?><?=$c_hide_download1_end?>

		<?=$c_hide_download2_start?><br><font class=com2>- <b>Download #2</b> : <?=$c_file_link2?><?=$c_file_name2?> (<?=$c_file_size2?>)</a>, Download : <?=$c_file_download2?></font><br><?=$c_upload_image2?><?=$c_hide_download2_end?>

		<br><font class=com2><?if($c_data[is_secret]) echo "<img src=".$dir."/post_security.gif border=0>";?><?if(preg_match("#\|\|\|[0-9]{1,}\|[0-9]{1,10}$#",$o_data[memo])) echo "<font color=blue>To $o_data[name]</font>";?>

		<!-- 덧글 내용 시작 -->
		<div id=IAMCONT_<?=$c_data[no]?>></div>
		<textarea style='display:none' id=IAMAREA_<?=$c_data[no]?>><?=$c_memo?></textarea>
		<script>document.getElementById("IAMCONT_"+<?=$c_data[no]?>).innerHTML = document.getElementById("IAMAREA_"+<?=$c_data[no]?>).value</script>
		<!-- 덧글 내용 끝 -->
		<? } ?></td>
	<td background=<?=$dir?>/cc_middle_bg2.gif></td>
</tr>
</table>
</a>
<table border=0 width=<?=$width?> height=45 cellspacing=0 cellpadding=0 align=center style=table-layout:fixed>
<col width=10></col><col width=></col><col width=70%></col><col width=10></col>
<tr valign=bottom>
	<td background=<?=$dir?>/cc_foot_bg1.gif height=9></td>
	<td background=<?=$dir?>/cc_foot_bg2.gif align=left valign=top><BR><img src=images/t.gif height=4><BR><?=$c_face_image?> <font class=thm7pt><?=$comment_name?>&nbsp;</font><?=$a_comm_r?><img src=<?=$dir?>/reply.gif border=0 align=absmiddle></a></td>
	<td background=<?=$dir?>/cc_foot_bg2.gif align=right><font class=com5><?=$c_bitly?>[bitly]</a> <?=$show_comment_ip?></font><BR><img src=<?=$dir?>/t.gif height=7 align=absmiddle><BR><font class=com3><img src=<?=$dir?>/c_date.gif border=0 align=absmiddle> <?=date("Y-m-d",$c_data[reg_date])?>&nbsp;<?=date("H:i:s",$c_data[reg_date])?>&nbsp;</font> <?=$a_edit2?><img src=<?=$dir?>/edit2.gif border=0 valign=absmiddle></a> <?=$a_edit?><img src=<?=$dir?>/edit.gif border=0 valign=absmiddle></a><font style=font-family:tahoma;color:#f1f1f1;font-size:7pt><?=$a_del?><img id=deleteButton_<?=$c_data[no]?> src=<?=$dir?>/c_del.gif border=0 align=top></a></font></td>
	<td background=<?=$dir?>/cc_foot_bg3.gif align=left></td>
</tr>
</table>
</td></tr>
</table>
<div id=commentContainer_<?=$c_data[no]?>></div>
</div>
<? print $script; ?>
