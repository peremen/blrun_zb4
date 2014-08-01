<form>
<br><br><br>
<table border=0 width=250 class=zv3_writeform height=30>
<tr>
    <td align=center height=30 bgcolor=white>
      <?echo $message;?>
	</td>
</tr>
</table>
<?
  if(!$url)
  {
?>

  <br>
  <center><img src=<?=$dir?>/btn_writecancel.gif border=0 onclick=history.back() onfocus=blur() style=cursor:pointer></center>

<?
  }
  else
  {
?>
	<br>
  <div align=center><img src=<?=$dir?>/btn_move.gif border=0 onclick=location.href="<?echo $url;?>" onfocus=blur() style=cursor:pointer></div>

<?
  }
?>
   <br><br>
</form>
<br><br>
