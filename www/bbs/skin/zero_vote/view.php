
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
			<td width=70>Subject</td>
			<td style='word-break:break-all;'><img src=images/t.gif border=0 height=1><br><?=$subject?><font size=1 color=444444>(<?=$vote?> voted)</td>
		</tr>
		</table>
<?
//// �������� ������;; �������縦 ���� ���α׷� �ҷ����� �κ��Դϴ� //////
include "include/vote_check.php";
//// ���� ���Ͽ����� ���� ��Ų���丮�� vote_list.php������ �ҷ����ϴ�///
?>

	</td>
	<td background=<?=$dir?>/6.gif><img src=<?=$dir?>/6.gif border=0></td>
</tr>
<tr>
	<td background=<?=$dir?>/4.gif><img src=<?=$dir?>/4.gif border=0></td>
	<td><font color="blue">��ǥ�հ� ����: </font>������ǥ���� ��ü ��ǥ���� <? if(($data[vote]==1&&$hop_vote==0)||$data[vote]==$hop_vote) echo "��ġ��"; else echo "<font color='red'>��ġ���� ����!</font>"; ?></td>
	<td background=<?=$dir?>/6.gif><img src=<?=$dir?>/6.gif border=0></td>
</tr>
<tr>
	<td><img src=<?=$dir?>/7.gif border=0></td>
	<td background=<?=$dir?>/8.gif width=100%>
	<td><img src=<?=$dir?>/9.gif border=0></td>
</tr>
</table>
<!-- ������ ��� �����ϴ� �κ� -->
<?=$hide_comment_start?><table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>><?=$hide_comment_end?>