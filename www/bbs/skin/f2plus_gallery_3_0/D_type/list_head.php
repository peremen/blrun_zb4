<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
<tr><td colspan=2>
<table border=0 cellspacing=0 cellpadding=0 width=100% style=border-width:1pt;border-style:solid;border-color:cccccc;padding:0,0,0,3>
<form method='post' name='list' action='list_all.php'>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='select_arrange' value='<?=$select_arrange?>'>
<input type='hidden' name='desc' value='<?=$desc?>'>
<input type='hidden' name='page_num' value='<?=$page_num?>'>
<input type='hidden' name='selected'>
<input type='hidden' name='exec'>
<input type='hidden' name='keyword' value="<?=$keyword?>">
<input type='hidden' name='sn' value="<?=$sn?>">
<input type='hidden' name='ss' value="<?=$ss?>">
<input type='hidden' name='sc' value="<?=$sc?>">
<input type='hidden' name='sm' value="<?=$sm?>">

<col width=></col><col width=480></col>
<tr valign=top>
	<td align=left>
		<?=$a_list?><img src=<?=$dir?>/images/bt_list.gif border=0></a>
		<?=$a_1_prev_page?><img src=<?=$dir?>/images/prev.gif border=0></a>
		<?=$a_1_next_page?><img src=<?=$dir?>/images/next.gif border=0></a>
		<?=$a_write?><img src=<?=$dir?>/images/bt_write.gif border=0></a>
	</td>
	<td align=right>
		<?=$a_prev_page?>[이전 <?=$setup[page_num]?>개]</font></a><?=$print_page?></font><?=$a_next_page?>[다음 <?=$setup[page_num]?>개]</font></a><br>
	<td>
</tr></table></td></tr>
<tr><td height=5 colspan=2></td></tr>
<tr><td valign=top>
	<table border=0 cellspacing=0 cellpadding=2 width=100% align=center>
	
		
<?$counter=1;?>