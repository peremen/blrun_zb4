<?
  /* 간단한 답글을 출력하는 부분입니다.
   view.php스킨파일에 간단한 답글을 시작하는 <table>시작 태그가 시작되어 있습니다.
   그리고view_foot.php 파일에 </table>태그가 간단한 답글 쓰기 폼과 같이 있습니다

  <?=$comment_name?> : 글쓴이
  <?=$c_memo?> : 내용
  <?=$c_reg_date?> : 글을 쓴 날자;;
  <?=$a_del?> : 코멘트 삭제 버튼링크
  <?=$c_face_image?> : 멤버용 아이콘;;
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
			echo "<span style='color:gray;font-size:10pt;'>비밀 덧글입니다</span>";
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
