
	<table border=0 width=100% cellspacing=0 cellpadding=0>
	<tr>
		<td><img src=<?=$dir?>/1.gif border=0></td>
		<td background=<?=$dir?>/2.gif width=100%><img src=<?=$dir?>/2.gif border=0></td>
		<td><img src=<?=$dir?>/3.gif border=0></td>
	</tr>
	<tr>
		<td background=<?=$dir?>/4.gif><img src=<?=$dir?>/4.gif border=0></td>
		<td>
			<table border=0 cellspacing=0 cellpadding=0 width=100%>
			<tr>
				<td align=right nowrap='nowrap'>&nbsp;
					<?=$a_reply?><img src=<?=$dir?>/reply.gif border=0></a>
					<?=$a_modify?><img src=<?=$dir?>/modify.gif border=0></a>
					<?=$a_delete?><img src=<?=$dir?>/delete.gif border=0></a>&nbsp;
				</td>
			</tr>
			</table>
		</td>
		<td background=<?=$dir?>/6.gif><img src=<?=$dir?>/6.gif border=0></td>
	</tr>
	<tr>
		<td background=<?=$dir?>/4.gif><img src=<?=$dir?>/4.gif border=0></td>
		<td style='word-break:break-all;'>
			<b><?=$loop_number?>. <?=$data[subject]?> (<?=$vote?>)</b>
		</td>
		<td background=<?=$dir?>/6.gif><img src=<?=$dir?>/6.gif border=0></td>
	</tr>
	<tr>
		<td background=<?=$dir?>/4.gif><img src=<?=$dir?>/4.gif border=0></td>
		<td style='word-break:break-all;'>
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
		<td><font color="blue">투표합계 검증: </font>개별투표수와 전체 투표수가 <? if(($data[vote]==1&&$hop_vote==0)||$data[vote]==$hop_vote) echo "일치함"; else echo "<font color='red'>일치하지 않음!</font>"; ?></td>
		<td background=<?=$dir?>/6.gif><img src=<?=$dir?>/6.gif border=0></td>
	</tr>
	<tr>
		<td><img src=<?=$dir?>/7.gif border=0></td>
		<td background=<?=$dir?>/8.gif width=100%><img src=<?=$dir?>/8.gif border=0></td>
		<td><img src=<?=$dir?>/9.gif border=0></td>
	</tr>
	</table>
	<table border=0 cellspacing=0 cellpadding=0 height=5><tr><td>&nbsp;</td></tr></table>
