<?
unset($_point);
if($emoticon_use=="on") $c_memo=str_to_emoticon($c_memo,$emoticon_url);
if($is_admin) $show_comment_ip = "<font class=com5>".$c_data['ip']."</font>";
else $show_comment_ip = "";
$a_del=str_replace("del_comment.php?","$dir/del_comment.php?_zb_url=$zb_url&_zb_path=$zb_path&",$a_del);
$t_c=mysql_fetch_array(mysql_query("select * from $table where reg_date='$c_data[reg_date]'"));
//$t_memo=str_replace("<","&lt",$t_c[memo]);
$a_c_vote="$dir/vote.php?id=$id&no=$data[no]&c_no=$t_c[no]&who=$member[no]";
$c_vote=$t_c[vote];
if ($t_c[point1]!=0){
	for($i=1;$i<=$t_c[point1];$i++){
		$_point.="★";
	}
}
if($t_c[point2]==1) $_point=$_point."☆";
$c_colspan=2;
if($member[no]){
	$c_colspan=3;
}
?>

<img src=<?=$dir?>/t.gif border=0 height=8><br>
<a name="<?=$c_data[no]?>">
<table border=0 width=<?=$width?> cellspacing=1 cellpadding=0 align=center style=table-layout:fixed;border-width:1pt;border-style:solid;border-color:f1f1f1>
<tr><td>
	<table border=0 width=100% cellspacing=0 cellpadding=2 align=center style=table-layout:fixed>
	<col width=></col><col width=150></col><?if($member[no]){?><col width=70></col><?}?>

	<tr valign=top>
		<td style='word-break:break-all;' align=left><font color=F2955C class=com4>&nbsp;<B><?=++$count?>.</B>&nbsp;&nbsp;<?if($hide_name=="off"){?><?=$c_face_image?></font><font class=thm7pt><?=$comment_name?>&nbsp;</font><?}?></td>
		<td valign=top align=right><font style=font-family:tahoma;color:cc9999;font-size:8pt;font-weight:bold>Point :</font> <?=$_point?>&nbsp;<font style=font-family:tahoma;color:cc9999;font-size:8pt;font-weight:bold>[<?=$c_vote?>]</font></td>
		<?if($member[no]){?>

		<td align=right><FORM METHOD=POST ACTION="<?=$a_c_vote?>"><input type=hidden name=_zb_path value="<?=$config_dir?>"><input type=hidden name=_zb_url value="<?=$zb_url?>"><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=_url value="<?=$PHP_SELF?>"><INPUT TYPE=image src=<?=$dir?>/vote.gif border=0 align=absmiddle></td><?}?>

	</tr>
	<tr><td height=1 background=<?=$dir?>/dot3.gif colspan=<?=$c_colspan?>></td></tr>
	<tr>
		<td valign=top bgcolor=eeeeee colspan=<?=$c_colspan?>>&nbsp;::: 
		<?
		if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$member[level]>$setup[grant_view_secret])
			echo "<span style='color:gray;font-size:10pt'>비밀 덧글입니다</span>";
		else {
		?>

		<?=$c_hide_download1_start?><br><font class=com2>- <b>Download #1</b> : <?=$c_file_link1?><?=$c_file_name1?> (<?=$c_file_size1?>)</a>, Download : <?=$c_file_download1?></font><br><?=$c_upload_image1?><?=$c_hide_download1_end?>

		<?=$c_hide_download2_start?><br><font class=com2>- <b>Download #2</b> : <?=$c_file_link2?><?=$c_file_name2?> (<?=$c_file_size2?>)</a>, Download : <?=$c_file_download2?></font><br><?=$c_upload_image2?><?=$c_hide_download2_end?>

		<br><font class=list_han><?if($c_data[is_secret]) echo "<img src=".$dir."/post_security.gif border=0>";?><?=$c_memo?></font>
		<? } ?>

		</td>
	</tr>
	<tr><td height=1 background=<?=$dir?>/dot3.gif colspan=<?=$c_colspan?>></td></tr>
	<tr valign=top>
		<td colspan=<?=$c_colspan?> align=right><?if($hide_date=="off"){?> DATE :<font class=com3> <?=date("m-d",$c_data[reg_date])?>&nbsp;<?=date("H:i:s",$c_data[reg_date])?>&nbsp;</font><?}?><?if ($member[isadmin]==1){?>/ &nbsp;IP :&nbsp;<?=$show_comment_ip?></font><?}?> <?=$a_edit2?><img src=<?=$dir?>/edit2.gif border=0 valign=absmiddle></a> <?=$a_edit?><img src=<?=$dir?>/edit.gif border=0 valign=absmiddle></a> <?=$a_del?><img src=<?=$dir?>/del.gif border=0 valign=absmiddle></a>
		</FORM>
		</td>
	</tr>
	</table>
</td></tr>
</table>
</a>
