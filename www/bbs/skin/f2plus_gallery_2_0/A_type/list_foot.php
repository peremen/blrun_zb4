
	</table>
</td></tr>
</table>
<?
if(!eregi("Zeroboard",$a_cart)) $a_cart = str_replace(">","><font class=list_eng>",$a_cart)."";
if(!eregi("Zeroboard",$delete_all)) $a_delete_all = str_replace(">","><font class=list_eng>",$a_delete_all)."";
if(!eregi("Zeroboard",$a_1_prev_page)) $a_1_prev_page = str_replace(">","><font class=list_eng>",$a_1_prev_page)."";
if(!eregi("Zeroboard",$a_1_next_page)) $a_1_next_page = str_replace(">","><font class=list_eng>",$a_1_next_page)."";
if(!eregi("Zeroboard",$a_write)) $a_write = str_replace(">","><font class=list_eng>",$a_write)."";
if(!eregi("Zeroboard",$a_prev_page)) $a_prev_page = str_replace(">","><font class=list_eng>",$a_prev_page)."";
if(!eregi("Zeroboard",$a_next_page)) $a_next_page = str_replace(">","><font class=list_eng>",$a_next_page)."";
$print_page = str_replace("<font style=font-size:9pt>","<font class=list_eng>",$print_page);
$print_page = str_replace("계속 검색","<font class=list_han>계속 검색",$print_page);
$print_page = str_replace("이전 검색","<font class=list_han>계속 검색",$print_page);
?>
<img src=<?=$dir?>/t.gif border=0 height=10><br>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> align=center>
<tr><td height=1 colspan=2 background=<?=$dir?>/dot.gif></td></tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=<?=$width?> align=center>
<col width=></col><col width=480></col>
<tr valign=top>
	<td align=left>
		<?=$hide_cart_start?><?=$a_cart?><img src=<?=$dir?>/bt_list.gif border=0></a><?=$hide_cart_end?>

		<?=$a_delete_all?><img src=<?=$dir?>/bt_admin.gif border=0></a>
		<?=$a_1_prev_page?><img src=<?=$dir?>/prev.gif border=0></a>
		<?=$a_1_next_page?><img src=<?=$dir?>/next.gif border=0></a>
		<?=$a_write?><img src=<?=$dir?>/bt_write.gif border=0></a>
	</td>
	<td align=right>
		<?=$a_prev_page?>[이전 <?=$setup[page_num]?>개]</font></a><?=$print_page?></font><?=$a_next_page?>[다음 <?=$setup[page_num]?>개]</font></a><br>
	</td>
	</form>
</tr>
<tr>
	<td colspan=2 align=right>
		<table border=0 cellspacing=0 cellpadding=0>
		<form method=get name=search action=<?=$PHP_SELF?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=category value="<?=$category?>">
		<tr >
			<td valign="bottom">
				<a href="javascript:OnOff('sn')" onfocus=blur()><img src=<?=$dir?>/name_<?=$sn?>.gif border=0 name=sn></a><a href="javascript:OnOff('ss')" onfocus=blur()><img src=<?=$dir?>/subject_<?=$ss?>.gif border=0 name=ss></a><a href="javascript:OnOff('sc')" onfocus=blur()><img src=<?=$dir?>/content_<?=$sc?>.gif border=0 name=sc></a><a href="javascript:OnOff('sm')" onfocus=blur()><img src=<?=$dir?>/comment_<?=$sm?>.gif border=0 name=sm></a>
			</td>
			<td valign="middle"><input type=text name=keyword value="<?=$keyword?>" class=input size=10></td>
			<td><input type=image src=<?=$dir?>/bt_search.gif border=0></td>			
		</tr>
		</form>
		</table>
	</td>
</tr>
</table>
<br>
