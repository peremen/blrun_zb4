<?
  /* 간단한 답글을 출력하는 부분입니다.
   view.php스킨파일에 간단한 답글을 시작하는 <table>시작 태그가 시작되어 있습니다.
   그리고view_foot.php 파일에 </table>태그가 간단한 답글 쓰기 폼과 같이 있습니다

  <?=$comment_name?> : 글쓴이
  <?=$c_memo?> : 내용
  <?=$c_reg_date?> : 글을 쓴 날자;;
  <?=$a_del?> : 코멘트 삭제 버튼링크
  <?=$c_face_image?> : 멤버용 아이콘;;
  <?=$show_comment_ip?> : 아이피

 */
?>
<?
if($is_admin) $show_comment_ip = "<font class=listnum>".$c_data['ip']."</font>";
else $show_comment_ip = "";
?>

<div id=IAMCOMMENT_<?=$c_data[no]?> align=right style="display:none;width:<?=$width?>">
<table id=comment_<?=$c_data[no]?> border=0 cellspacing=0 cellpadding=0 width=<?=$width?> style=table-layout:fixed>
<tr>
	<td width=100% bgcolor=dddddd><img src=images/t.gif height=1></td>
</tr>
<tr>
	<td height=3><img src=images/t.gif border=0 hieght=3></td>
</tr>
<tr valign=top>
	<td style='word-break:break-all;padding-left:10px;'>
		<a name="<?=$c_data[no]?>">
		<table border=0 cellspacing=0 cellpadding=0 width=100% style=table-layout:fixed>
		<tr>
			<td width=><?=$c_face_image?> <?=$comment_name?> </b><font class=listnum color=888888>(<?=date("Y-m-d H:i:s",$c_data[reg_date])?>)</font> <?=$show_comment_ip?> <?=$a_comm_r?><img src=<?=$dir?>/reply.gif border=0 valign=absmiddle></a></td>
			<td width=70 align=right style=font-family:verdana;font-size:9px;><?=$a_edit2?><img src=<?=$dir?>/edit2.gif border=0 valign=absmiddle></a> <?=$a_edit?><img src=<?=$dir?>/edit.gif border=0 valign=absmiddle></a> <?=$a_del?><img id=deleteButton_<?=$c_data[no]?> src=<?=$dir?>/del.gif border=0 valign=absmiddle></a><img src=images/t.gif border=0 width=1 height=1>&nbsp;</td>
		</tr>
		</table>
		</a>
	</td>
</tr>
<tr>
	<td style='word-break:break-all;padding:2px;padding-left:10px;padding-top:5px;'>&nbsp;::: 
		<?
		if($o_data[ismember]=="") $ismember0="0"; else $ismember0=$o_data[ismember];
		if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$ismember0!=$member[no]&&$member[level]>$setup[grant_view_secret])
			echo "<span style='color:gray;font-size:10pt'>비밀 덧글입니다</span>";
		else {
		?>

		<?=$c_hide_download1_start?><br><font class=listnum>- <b>Download #1</b> : <?=$c_file_link1?><?=$c_file_name1?> (<?=$c_file_size1?>)</a>, Download : <?=$c_file_download1?></font><br><?=$c_upload_image1?><?=$c_hide_download1_end?>

		<?=$c_hide_download2_start?><br><font class=listnum>- <b>Download #2</b> : <?=$c_file_link2?><?=$c_file_name2?> (<?=$c_file_size2?>)</a>, Download : <?=$c_file_download2?></font><br><?=$c_upload_image2?><?=$c_hide_download2_end?>

		<br><?if($c_data[is_secret]) echo "<img src=".$dir."/post_security.gif border=0>";?><?if(preg_match("#\|\|\|[0-9]{1,}\|[0-9]{1,10}$#",$o_data[memo])) echo "<font color=blue>To $o_data[name]</font>";?><?=$c_memo?><? } ?>

	</td>
</tr>
<tr>
	<td height=3><img src=images/t.gif border=0 hieght=3></td>
</tr>
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
