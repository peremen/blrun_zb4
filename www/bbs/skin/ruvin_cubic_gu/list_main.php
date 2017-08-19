
<table align=center border=0 cellpadding=0 cellspacing=0 width=<?=$width?>>
<tr>
	<td colspan=10 class=line1 height=1></td>
</tr>
<tr>
	<td colspan=10 class=line2 height=1></td>
</tr>
</table>
<table align=center border=0 cellpadding=3 cellspacing=0 width=<?=$width?>>
<tr>
	<td align=left class=cu><?=$hide_cart_start?><input type=checkbox name=cart value="<?=$data[no]?>"><?=$hide_cart_end?>&nbsp;<span class=notice>*&nbsp;</span><span class=v7><b>N</b>o. <?=$number?></span>&nbsp;&nbsp;<?=$name?></td>
	<td align=right class=cub><span class=v7><font title="답변"><?=$a_reply?>R&nbsp;&nbsp;</a></font><? if($data[homepage]){?><a href="<?=$data[homepage]?>" target="_blank" onfocus='this.blur()'><font title="홈페이지">H&nbsp;&nbsp;</a></font><?}else{?><?}?><font title="수정"><?=$a_modify?>M&nbsp;&nbsp;</a></font><font title="삭제"><?=$a_delete?>D</a></font></span></td>
</tr>
<tr>
	<td align=left valign=top colspan=2 class=cu><?=$memo?><br><span class=t7><?=$date?></span></td>
</tr>
<tr>
	<td valign=top colspan=2>
	<? include "include/get_reply.php";?>

	</td>
</tr>
</table>
