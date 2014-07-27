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
<tr>
	<td width=78 nowrap valign=top>
		<a name="<?=$c_data[no]?>">
		<table border=0 cellspacing=0 cellpadding=0 width=100% style=table-layout:fixed>
		<tr>
			<td><img src=images/t.gif border=0 height=1 width=78><br><?=$c_face_image?> <?=$comment_name?></td>
		</tr>
		</table>
		</a>
		<?=$show_comment_ip?>
	</td>
	<td width=100%>&nbsp;::: 
		<?
		if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$member[level]>$setup[grant_view_secret])
			echo "<span style='color:gray;font-size:10pt'>비밀 덧글입니다</span>";
		else {
		?>
			<?=$c_hide_download1_start?><br><font class=listnum>- <b>Download #1</b> : <?=$c_file_link1?><?=$c_file_name1?> (<?=$c_file_size1?>)</a>, Download : <?=$c_file_download1?></font><br><?=$c_upload_image1?><?=$c_hide_download1_end?>
			<?=$c_hide_download2_start?><br><font class=listnum>- <b>Download #2</b> : <?=$c_file_link2?><?=$c_file_name2?> (<?=$c_file_size2?>)</a>, Download : <?=$c_file_download2?></font><br><?=$c_upload_image2?><?=$c_hide_download2_end?>
			<br><?if($c_data[is_secret]) echo "<img src=".$dir."/post_security.gif border=0>";?><?=$c_memo?>
		<? } ?>
	</td>
	<td nowrap align=right valign=top><font class=listnum><?=date("Y-m-d",$c_data[reg_date])?><br><?=date("H:i:s",$c_data[reg_date])?></font><br><?=$a_edit2?><img src=<?=$dir?>/edit2.gif border=0 valign=absmiddle></a> <?=$a_edit?><img src=<?=$dir?>/edit.gif border=0 valign=absmiddle></a> <?=$a_del?><img src=<?=$dir?>/secret_head.gif border=0></a></td>
</tr>