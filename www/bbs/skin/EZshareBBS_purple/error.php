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
  <center><a href=# onclick=history.back() onfocus=blur()><img src=<?=$dir?>/btn_writecancel.gif border=0></a>

<?
  }
  else
  {
?>
	<br>
  <div align=center><a href=# onclick=location.href="<?echo $url;?>" onfocus=blur()><img src=<?=$dir?>/btn_move.gif border=0></a>

<?
  }
?>
   <br><br>
</form>
<br><br>
