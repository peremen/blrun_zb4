<?  
// ī�װ� ���� //////////////////////////////////////////////////////////////////////
$table_data=mysql_fetch_array(mysql_query("select name from $admin_table where no='$no'"));
$category_data=mysql_fetch_array(mysql_query("select * from $t_category"."_$table_data[name] where no='$category_no'"));
?>
<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#b0b0b0>
  <tr height=30><td bgcolor=#3d3d3d colspan=10><img src=images/admin_webboard.gif></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=10><img src=images/t.gif height=1></td></tr>
<form method=post action=<?=$PHP_SELF?>>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=exec value="<?=view_board?>">
<input type=hidden name=exec2 value=category_modify_ok>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=category_no value=<?=$category_no?>>
<tr height=30>
 <td align=center>
 	<table border=0 cellspacing=0 cellpadding=2>
	<tr>
 		<td align=center style=font-family:Tahoma;font-size:8pt;font-weight:bold>ī�װ� �̸� ���� </td>
 		<Td>&nbsp;<input type=text name=name value="<?=$category_data[name]?>"></td>
 		<td><input type=submit value=' �̸� ���� ' style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;> &nbsp; <input type=button value=" ����ȭ�� " style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px; onclick=history.back()></td>
	</tr>
	</table>
</tr>
</table>
</form>
<br>
