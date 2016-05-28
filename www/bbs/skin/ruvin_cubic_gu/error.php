
<form><br><br>
<table width=200 border=0 cellpadding=0 cellspacing=0>
<tr><td colspan=10 class=line1 height=1></td></tr>
<tr><td colspan=10 class=line2 height=1></td></tr>
<tr><td height=15></td></tr>
<tr><td align=center><span class=cu><?echo $message;?></span><br><br>
<?
if(!$url)
{
?>
<center><input type=button value=" Back " onclick=history.go(-1) class=submit onfocus='this.blur()' style=cursor:hand>
<?
}
else
{
?>
<div align=center><input type=button value=" Back " onclick=location.href="<?echo $url;?>"  class=submit onfocus='this.blur()' style=cursor:hand>
<?
}
?>
<br><br>
</td></tr>
<tr><td colspan=10 class=line1 height=1></td></tr>
<tr><td colspan=10 class=line2 height=1></td></tr>
</form>
</table>
<br><br>
