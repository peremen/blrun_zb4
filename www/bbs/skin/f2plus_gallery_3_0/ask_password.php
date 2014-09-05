<?
$input_password = str_replace("class=input","class='text'",$input_password);
$input_password = str_replace(">"," style='width:90;'>",$input_password);

if($target=="del_comment_ok.php"){
	$target=$dir."/del_comment_ok.php";
}else {
	if($target=="delete_ok.php"){
		$target=$dir."/delete_ok.php";
	}
}	
?>
<table width='<?=$setup['table_width']?>' border='0' cellpadding='0' cellspacing='0'>
<form method=post name=delete action=<?=$target?>>
<input type=hidden name=_zb_path value=<?=$_zb_path?>>
<input type=hidden name=_zb_url value=<?=$_zb_url?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=sm value="<?=$sm?>">
<input type=hidden name=mode value="<?=$mode?>">
<input type=hidden name=c_no value=<?=$c_no?>>
<tr>
	<td align='center' style='padding:50 0 50 0;'>
		<table width='250' border='0' cellpadding='0' cellspacing='0' background='<?=$dir?>/images/sw_window_bgi.gif' style='word-break:break-all; background-repeat:repeat-y;'>
		<tr><td><img src='<?=$dir?>/images/sw_window_t.gif' border='0'></td></tr>
		<tr>
			<td align='center' style='padding:7 0 7 0;' class='sw_ft_style_0'><strong><?=$title?></strong></td>
		</tr>
<? if(!$member['no']) { ?>
		<tr><td class='sw_bg_style_0'></td></tr>
		<tr><td align='center' style='padding:7;' class='sw_ft_style_0'>비밀번호 <?=$input_password?></td></tr>
<? } ?>
		<tr><td class='sw_bg_style_0'></td></tr>
		<tr>
			<td align='center' style='padding:7 0 7 0;'>
				<input type='submit' class='submit' value='확&nbsp;&nbsp;&nbsp;인' accesskey='s' style='margin:0 5 0 0;'>
				<input type='button' class='button' value='취&nbsp;&nbsp;&nbsp;소' onClick='history.back();'>
			</td>
		</tr>
		<tr><td><img src='<?=$dir?>/images/sw_window_b.gif' border='0'></td></tr>
		</table>
	</td>
</tr>
</form>
</table>
