<?
  /* ������ ����� ����ϴ� �κ��Դϴ�.
   view.php��Ų���Ͽ� ������ ����� �����ϴ� <table>���� �±װ� ���۵Ǿ� �ֽ��ϴ�.
   �׸���view_foot.php ���Ͽ� </table>�±װ� ������ ��� ���� ���� ���� �ֽ��ϴ�

  <?=$comment_name?> : �۾���
  <?=$c_memo?> : ����
  <?=$c_reg_date?> : ���� �� ����;;
  <?=$a_del?> : �ڸ�Ʈ ���� ��ư��ũ
  <?=$c_face_image?> : ����� ������;;
 */
?>

<div id=IAMCOMMENT_<?=$c_data[no]?> align=right style="display:none;width:<?=$width?>">
<table id=comment_<?=$c_data[no]?> border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td align=center>
	<a name="<?=$c_data[no]?>">
	<table border=0 width=100%>
	<tr>
	<td width=130 align=left class=memo>&nbsp; <?=$c_face_image?> <b><?=$comment_name?></b> <?=$a_comm_r?><img src=<?=$dir?>/reply_comment.gif border=0 align=absmiddle></a></td><td align=left style='word-break:break-all;font-size:9pt;font-color:#444444' width=>
		<?
		if($o_data[ismember]=="") $ismember0="0"; else $ismember0=$o_data[ismember];
		if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$ismember0!=$member[no]&&$member[level]>$setup[grant_view_secret])
			echo "<span style='color:gray;font-size:10pt;'>��� �����Դϴ�</span>";
		else {
		?>

		<font color=888888 size=1>:::</font> <?if($c_data[is_secret]) echo "<img src=".$dir."/post_security.gif border=0>";?><?if(preg_match("#\|\|\|[0-9]{1,}\|[0-9]{1,10}$#",$o_data[memo])) echo "<font color=blue>To $o_data[name]</font>";?>
		<!-- ���� ���� ���� -->
		<div id=IAMCONT_<?=$c_data[no]?>></div>
		<textarea style='display:none' id=IAMAREA_<?=$c_data[no]?>><?=autolink($c_memo)?> <?=$c_bitly?>[bitly]</a> <?=$c_reg_date?></textarea>
		<script>document.getElementById("IAMCONT_"+<?=$c_data[no]?>).innerHTML = document.getElementById("IAMAREA_"+<?=$c_data[no]?>).value</script>
		<!-- ���� ���� �� -->
		<? } ?>

	</td>
	<td width=70 align=right><?=$a_edit2?><img src=<?=$dir?>/edit2.gif border=0 valign=absmiddle></a> <?=$a_edit?><img src=<?=$dir?>/edit.gif border=0 valign=absmiddle></a> <?=$a_del?><img id=deleteButton_<?=$c_data[no]?> src=<?=$dir?>/del.gif border=0 valign=absmiddle></a></td>
	</tr>
	</table>
	</a>
</td>
</tr>
</table>
<div id=commentContainer_<?=$c_data[no]?>></div>
</div>
<? print $script; ?>
