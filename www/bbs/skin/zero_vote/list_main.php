<?
if(!$data[is_secret]) $subject = str_replace(">","><font class=list_han>",$subject);
else $subject = str_replace(">","><font style='color:gray; text-decoration:none;'>",$subject);
$name= str_replace(">","><font class=list_han>",$name);

/* Check New Article to $new */
if(time()-$data['reg_date']<60*60*24) $new = "&nbsp;<font color=red style='font-size:8pt;'>new</font>";
elseif(time()-$data['reg_date']<60*60*48) $new = "&nbsp;<font color=blue style='font-size:8pt;'>new</font>";
else $new = "";

/* Check New Comment $comment_new */
$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
$last_comment_time = $last_comment['reg_date'];
if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
else $comment_new = "&nbsp;<font class=list_eng style='font-size:8pt;'>".$comment_num."</font>";
?>

	<table border=0 width=100% cellspacing=0 cellpadding=0>
	<col></col> <col></col> <col></col>
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
		<td align=left class=memo>
			<b><?=$loop_number?>. <?=$subject?><?=$comment_new?><?=$new?> (<?=$vote?>)</b>
		</td>
		<td background=<?=$dir?>/6.gif><img src=<?=$dir?>/6.gif border=0></td>
	</tr>
	<tr>
		<td background=<?=$dir?>/4.gif><img src=<?=$dir?>/4.gif border=0></td>
		<td class=memo>
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
		<td align=left><font color="blue">��ǥ�հ� ����: </font>������ǥ���� ��ü ��ǥ���� <? if(($data[vote]==1&&$hop_vote==0)||$data[vote]==$hop_vote) echo "��ġ��"; else echo "<font color='red'>��ġ���� ����!</font>"; ?></td>
		<td background=<?=$dir?>/6.gif><img src=<?=$dir?>/6.gif border=0></td>
	</tr>
	<tr>
		<td><img src=<?=$dir?>/7.gif border=0></td>
		<td background=<?=$dir?>/8.gif width=100%><img src=<?=$dir?>/8.gif border=0></td>
		<td><img src=<?=$dir?>/9.gif border=0></td>
	</tr>
	</table>
	<table border=0 cellspacing=0 cellpadding=0 height=5><tr><td>&nbsp;</td></tr></table>
