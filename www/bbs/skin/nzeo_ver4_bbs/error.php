
<form>
<br><br><br>
<table border=0 width=250 class=zv3_writeform height=30>
<tr class=title>
	<td class=title_han align=center><b>Message</b></td>
</tr>
<tr class=list0>
	<td align=center height=50 class=list_han>
		<?echo $message;?>

	</td>
</tr>
</table>
<?
if(!$url)
{
?>
<br>
<center><input type=button value="���� ȭ��" onclick=history.back() class=list_han></center>
<?
}
else
{
?>
<br>
<div align=center><input type=button value='������ �̵�' onclick=location.href="<?echo $url;?>" class=list_han></div>
<?
}
?>
</form>
<br><br>
