<?
  $user_id = htmlspecialchars(trim($user_id));

  include "lib.php";
  $user_id = trim($user_id);
  $connect=dbconn();
  $check=mysql_fetch_array(mysql_query("select count(*) from $member_table where user_id='$user_id'"));
  mysql_close($connect);
  head();
?>
<table border=0 width=100% height=100%>
<tr>
  <td align=center>
<?
  if($check[0]) echo "$user_id �� �̹� ��ϵ�<br> ���̵��Դϴ�";
  else echo"$user_id �� ����ϽǼ� �ֽ��ϴ�";
?>

</td>
</tr>
<form>
<tr>
  <td align=center><input type=button value='Close window' onclick=window.close(); class=submit></td>
</tr>
</form>
</table>

<? 
	 @mysql_close($connect);
	 foot(); 
?>
