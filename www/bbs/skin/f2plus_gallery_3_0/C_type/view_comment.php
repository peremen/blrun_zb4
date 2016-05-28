<?
$c_memo = love_convert($c_memo);
if($is_admin) $show_comment_ip = $c_data['ip'];
else $show_comment_ip = "";
$a_del=str_replace("del_comment.php?","del_comment.php?_zb_url=$zb_url/&_zb_path=$zb_path&",$a_del);
?>

<div id=IAMCOMMENT_<?=$c_data[no]?> align=right style="display:none;width:<?=$width?>">
<table id=comment_<?=$c_data[no]?> border=0 width=<?=$width?> cellspacing=0 cellpadding=0 style=table-layout:fixed>
<tr><td>
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
	if($o_data[ismember]=="") $ismember0="0"; else $ismember0=$o_data[ismember];
	if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$ismember0!=$member[no]&&$member[level]>$setup[grant_view_secret])
		echo "<span style='color:gray;font-size:10pt'>비밀 덧글입니다</span>";
	else {
	?>

	<?=$c_hide_download1_start?><br><font class=com2>- <b>Download #1</b> : <?=$c_file_link1?><?=$c_file_name1?> (<?=$c_file_size1?>)</a>, Download : <?=$c_file_download1?></font><br><?=$c_upload_image1?><?=$c_hide_download1_end?>

	<?=$c_hide_download2_start?><br><font class=com2>- <b>Download #2</b> : <?=$c_file_link2?><?=$c_file_name2?> (<?=$c_file_size2?>)</a>, Download : <?=$c_file_download2?></font><br><?=$c_upload_image2?><?=$c_hide_download2_end?>

	<br><font class=com2><?if($c_data[is_secret]) echo "<img src=".$dir."/images/post_security.gif border=0>";?><?if(preg_match("#\|\|\|[0-9]{1,}\|[0-9]{1,10}$#",$o_data[memo])) echo "<font color=blue>To $o_data[name]</font>";?><?=$c_memo?></font>
	<? } ?></td>
	<td background=<?=$dir?>/images/cc_middle_bg2.gif></td>
</tr>
</table>
</a>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=3 align=center style=table-layout:fixed>
<col width=10></col><col width=></col><col width=240></col><col width=10></col>
<tr valign=bottom>
	<td background=<?=$dir?>/images/cc_foot_bg1.gif height=45></td>
	<td background=<?=$dir?>/images/cc_foot_bg2.gif valign=top><?if($hide_name=="off"){?><BR><img src=images/t.gif height=4><BR><?=$c_face_image?> <font class=thm7pt><?=$comment_name?>&nbsp;</font><?}?><?=$a_comm_r?><img src=<?=$dir?>/reply.gif border=0 valign=absmiddle></a></td>
	<td background=<?=$dir?>/images/cc_foot_bg2.gif align=right><font class=com5><?=$show_comment_ip?></font><BR><img src=<?=$dir?>/images/t.gif height=7 align=absmiddle><BR><?if($hide_date=="off"){?><font class=com3><img src=<?=$dir?>/images/c_date.gif border=0 align=absmiddle> <?=date("Y-m-d",$c_data[reg_date])?>&nbsp;<?=date("H:i:s",$c_data[reg_date])?>&nbsp;</font><?}?> <?=$a_edit2?><img src=<?=$dir?>/images/edit2.gif border=0 valign=absmiddle></a> <?=$a_edit?><img src=<?=$dir?>/images/edit.gif border=0 valign=absmiddle></a><font style=font-family:tahoma;color:f1f1f1;font-size:7pt><?=$a_del?><img id=deleteButton_<?=$c_data[no]?> src=<?=$dir?>/images/c_del.gif border=0 align=top></a></font></td>
	<td background=<?=$dir?>/images/cc_foot_bg3.gif align=left></td>
</tr>
</table>
</td></tr>
</table>
<div id=commentContainer_<?=$c_data[no]?>></div>
</div>

<script>
var oCur = document.getElementById("IAMCOMMENT_"+<?=$c_data[no]?>);
if (<?=$c_org?> > 0 && <?=$c_depth?> > 0)
{
    var oOrg = document.getElementById("commentContainer_"+<?=$c_org?>);
    var oCom = document.getElementById("comment_"+<?=$c_data[no]?>);

	//oCom.style.width = (100 - (5*<?=$c_depth?>)).toString() + "%";
	var imgX = Math.round(40*(document.documentElement.clientWidth)/1132).toString()+"px";
	var imgY = Math.round(28*(document.documentElement.clientWidth)/1132).toString()+"px";
	oCur.innerHTML = "<table width=<?=$width?> border=0 cellspacing=0 cellpadding=0><tr><td width=5% valign=top><p align=right><br><img src=<?=$dir?>/reply_arrow.gif width=" + imgX +" height=" + imgY + " style=display:display></p></td><td width=95% align=right>" + oCur.innerHTML + "</td></tr></table>";
    
    if (oOrg==null)
    {
        oCur.style.display = "";
    }
    else
    {
        oOrg.innerHTML += oCur.innerHTML;
        document.getElementById("deleteButton_"+<?=$c_org?>).style.display = "none";
        oCur.removeNode(true);
    }
}
else
{
    oCur.style.display = "";
}
</script>
