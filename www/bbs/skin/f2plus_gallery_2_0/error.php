
<form>
<br><br><br>
<table border=0 width=250 class=zv3_writeform height=30 align=center>
<tr class=title>
	<td class=title_han2 align=center><b>Message</b></td>
</tr>
<tr class=list0>
    <td align=center height=50 class=list_han>
      <?echo $message;?>
	</td>
</tr>
</table>
<? if(!$url) { ?>
<br>
<center><input type=button value="이전 화면" onclick=history.back() class=list_han></center>
<? } else { ?>
<br>
<div align=center><input type=button value='페이지 이동' onclick=location.href="<?echo $url;?>" class=list_han></div>
<? } ?>
</form>
<br>
<br>
