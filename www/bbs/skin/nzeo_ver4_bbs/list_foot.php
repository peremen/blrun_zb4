
</table>
<?
if(!preg_match("/Zeroboard/i",$a_cart)) $a_cart = str_replace(">","><font class=list_eng>",$a_cart)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$delete_all)) $a_delete_all = str_replace(">","><font class=list_eng>",$a_delete_all)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_1_prev_page)) $a_1_prev_page = str_replace(">","><font class=list_eng>",$a_1_prev_page)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_1_next_page)) $a_1_next_page = str_replace(">","><font class=list_eng>",$a_1_next_page)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_write)) $a_write = str_replace(">","><font class=list_eng>",$a_write)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_prev_page)) $a_prev_page = str_replace(">","><font class=list_eng>",$a_prev_page)."&nbsp;&nbsp;";
if(!preg_match("/Zeroboard/i",$a_next_page)) $a_next_page = str_replace(">","><font class=list_eng>",$a_next_page)."&nbsp;&nbsp;";
$print_page = str_replace("<font style=font-size:8pt>","<font class=list_eng>",$print_page);
$print_page = str_replace("��� �˻�","<font class=list_han>��� �˻�",$print_page);
$print_page = str_replace("���� �˻�","<font class=list_han>��� �˻�",$print_page);
?>
<img src=<?=$dir?>/t.gif border=0 height=10><br>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr valign=top>
	<td>
		<?=$hide_cart_start?><?=$a_cart?>īƮ����</a><?=$hide_cart_end?>

		<?=$a_delete_all?>�����ڱ��</a>
		<?=$a_1_prev_page?>����������</a>
		<?=$a_1_next_page?>����������</a>
		<?=$a_write?>�۾���</a>
	</td>
	<td align=right>
		<?=$a_prev_page?>[���� <?=$setup[page_num]?>��]</a></font> <?=$print_page?> <?=$a_next_page?>[���� <?=$setup[page_num]?>��]</font></a><br>
		<table border=0 cellspacing=0 cellpadding=0>
		</form>
		<form method=get name=search action="zboard.php"><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=category value="<?=$category?>">
		<tr>
			<td>
				<a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a>&nbsp;
				<a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a>&nbsp;&nbsp;
				<a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a>&nbsp;&nbsp;
				<a href="javascript:OnOff('sm')" onfocus=blur()><img src=<?=$dir?>/comment_<?=$sm?>.gif border=0 name=sm></a>&nbsp;&nbsp;
			</td>
			<td><input type=text name=keyword value="<?=$keyword?>" class=input size=10></td>
			<td><input type=submit class=submit value="�˻�"></td>
			<td><input type=button class=button value="���" onclick=location.href="zboard.php?id=<?=$id?>"></td>
		</tr>
		</form>
		</table>
	</td>
</tr>
</table>
<br>
