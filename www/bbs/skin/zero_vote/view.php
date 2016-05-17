<?
$data2=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where headnum='$data[headnum]' and depth=0"));
?>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<col width=13></col> <col width=></col> <col width=13></col>
<tr>
	<td><img src=<?=$dir?>/1.gif border=0></td>
	<td background=<?=$dir?>/2.gif width=100%>
	<td><img src=<?=$dir?>/3.gif border=0></td>
</tr>
<tr>
	<td background=<?=$dir?>/4.gif><img src=<?=$dir?>/4.gif border=0></td>
	<td width=100%>
		<table border=0 cellspacing=0 cellpadding=0 width=100% height=25>
		<tr>
			<td align=left width=70>Subject</td>
			<td align=left style='word-break:break-all;'><img src=images/t.gif border=0 height=1><br><?=stripslashes($data2[subject])?><font size=1 color=444444>(<?=$data2[vote]?> voted)</td>
		</tr>
		</table>
<?
//// 삭제하지 마세요;; 설문조사를 위한 프로그램 불러오는 부분입니다 //////
include "include/vote_check.php";
//// 위의 파일에서는 현재 스킨디렉토리의 vote_list.php파일을 불러씁니다///
?>

	</td>
	<td background=<?=$dir?>/6.gif><img src=<?=$dir?>/6.gif border=0></td>
</tr>
<tr>
	<td background=<?=$dir?>/4.gif><img src=<?=$dir?>/4.gif border=0></td>
	<td align=left><font color="blue">투표합계 검증: </font>개별투표수와 전체 투표수가 <? if(($data2[vote]==1&&$hop_vote==0)||$data2[vote]==$hop_vote) echo "일치함"; else echo "<font color='red'>일치하지 않음!</font>"; ?></td>
	<td background=<?=$dir?>/6.gif><img src=<?=$dir?>/6.gif border=0></td>
</tr>
<tr>
	<td><img src=<?=$dir?>/7.gif border=0></td>
	<td background=<?=$dir?>/8.gif width=100%>
	<td><img src=<?=$dir?>/9.gif border=0></td>
</tr>
</table>
<!-- 간단한 답글 시작하는 부분 -->
<?=$hide_comment_start?>