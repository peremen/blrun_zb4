<?
$dir="http://www.blrun.net/bbs/skin/f2plus_gallery_3_0/";
?>
<table width='<?=$setup['table_width']?>' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td align='center' style='padding:50 0 50 0;'>
		<table width='250' border='0' cellpadding='0' cellspacing='0' background='<?=$dir?>/images/sw_window_bgi.gif' style='word-break:break-all; background-repeat:repeat-y;'>
		<tr><td><img src='<?=$dir?>/images/sw_window_t.gif' border='0'></td></tr>
		<tr>
			<td align='center' style='padding:7 0 7 0;' class='sw_ft_style_0'><strong>알려드립니다</strong></td>
		</tr>
		<tr><td class='sw_bg_style_0'></td></tr>
		<tr><td align='center' style='padding:7;' class='sw_ft_style_0'><?=$message?></td></tr>
		<tr><td class='sw_bg_style_0'></td></tr>
		<tr>
			<td align='center' style='padding:7 0 7 0;'>
<? if(!$url) { ?>
				<input type='button' class='button' value='이전 화면' onClick='history.back();'>
<? } else { ?>
				<input type='button' class='button' value='페이지 이동' onClick=location.href="<?=$url?>">
<? } ?>
			</td>
		</tr>
		<tr><td><img src='<?=$dir?>/images/sw_window_b.gif' border='0'></td></tr>
		</table>
	</td>
</tr>
</table>
