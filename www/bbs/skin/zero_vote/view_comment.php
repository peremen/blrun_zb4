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

<tr>
<td align=center>
	<a name="<?=$c_data[no]?>">
	<table border=0 width=90%>
	<tr>
	<td width=10%><?=$c_face_image?> <b><?=$comment_name?></b></td><td style='word-break:break-all;font-size:9pt;font-color:444444' width=80%>
		<?
		if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$member[level]>$setup[grant_view_secret])
			echo "<span style='color:gray;font-size:10pt;'>��� �����Դϴ�</span>";
		else {
		?>

		<font color=888888 size=1>:::</font> <?if($c_data[is_secret]) echo "<img src=".$dir."/post_security.gif border=0>";?><?=autolink($c_memo)?> <?=$c_reg_date?> 
		<? } ?>

	</td>
	<td width=10% align=right><?=$a_edit2?><img src=<?=$dir?>/edit2.gif border=0 valign=absmiddle></a> <?=$a_edit?><img src=<?=$dir?>/edit.gif border=0 valign=absmiddle></a> <?=$a_del?><b>X</b></a></td>
	</tr>
	</table>
	</a>
</td>
</tr>
