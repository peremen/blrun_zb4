<?
$data=mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));
$check_open[$data[is_open]]="checked";
$check_join[$data[use_join]]="checked";
$check_use_icon[$data[use_icon]]="checked";
?>

<script>
  function check_submit()
  {
   if(!write.name.value)
   {
    alert("�׷��̸��� �Է��ϼž� �մϴ�");
    write.name.focus();
    return false;
   }
   return true;
  }
</script>
<table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=#b0b0b0>
<form name=write method=post action=<?=$PHP_SELF?> enctype=multipart/form-data onsubmit="return check_submit();">
<input type=hidden name=exec value=modify_group_ok>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=sid value=<?=$sid?>>
<tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_editgroup.gif></td>
</tr>
<tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:9pt;> <font color=red>*</font> <b>�׷��̸�</b>&nbsp;&nbsp;</td><td align=left>&nbsp;<input value="<?=$data[name]?>" type=text name=name size=20 maxlength=20 class=input style=border-color:#b0b0b0> �׷��̸��� �Է��ϼ���</td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:9pt;> <b>�׷� ����</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=is_open <?=$check_open[1]?> checked value=1></td><td style=font-family:Tahoma;font-size:9pt;> Yes &nbsp;&nbsp;</td><td><input type=radio name=is_open <?=$check_open[0]?> value=0></td><td style=font-family:Tahoma;font-size:9pt;> No &nbsp; �����׷��̸� Yes, �ƴϸ� No�� �����Ͽ�</td></tr></table></td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:9pt;><b>ȸ�� ���� ���</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=use_join <?=$check_join[1]?> value=1></td><td style=font-family:Tahoma;font-size:9pt;> Yes &nbsp;&nbsp;</td><td><input type=radio name=use_join <?=$check_join[0]?> value=0></td><td style=font-family:Tahoma;font-size:9pt;> No &nbsp; ȸ�������� ����ҰŸ� Yes, �ƴϸ� No�� �����ϼ���</td></tr></table></td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:9pt; valign=top><img src=images/t.gif height=3><br><b>�׷� ������</b>&nbsp;&nbsp;</td><td align=left style=font-family:Tahoma;font-size:9pt;line-height:160%>&nbsp;<input type=file name=icon size=40 class=input style=border-color:#b0b0b0;font-family:Tahoma;font-size:9pt;><br>&nbsp; �Ϲݸ������ �������� �����ϼ���.<br>&nbsp;(Under Width,Height 24pixel JPG/JEPG/GIF/PNG/BMP File format)
<br><?if($data[icon]) echo "&nbsp;<b>���� �������� ����Ǿ� �ֽ��ϴ� (<img src=icon/$data[icon] border=0> <input type=checkbox name=del_icon value=1> ����)";?></td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:9pt;><b>ȸ�� ǥ�� ���</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=use_icon value=0 <?=$check_use_icon[0]?>></td><td style=font-family:Tahoma;font-size:9pt;> Icon &nbsp&nbsp;</td><td><input type=radio name=use_icon value=1 <?=$check_use_icon[1]?>></td><td style=font-family:Tahoma;font-size:9pt;> Bold Text &nbsp;&nbsp;</td><td><input type=radio name=use_icon value=2 <?=$check_use_icon[2]?>></td><td style=font-family:Tahoma;font-size:9pt;> None division viewing</td></tr><tr><Td colspan=4 height=20>&nbsp;ȸ��ǥ�� ����� �����ϼ���</td></tr></table></td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:9pt; valign=top><img src=images/t.gif height=3><br><b>ȸ�������� �̵��� ������</b>&nbsp;&nbsp;</td><td align=left style=font-family:Tahoma;font-size:9pt;line-height:160%><input type=text name=join_return_url size=40 maxlength=255 class=input style=border-color:#b0b0b0 value='<?echo stripslashes($data[join_return_url]);?>'><br>&nbsp;�Խ����� �ƴѰ������� ȸ������, �α��ν� �̵��� URL�� �Է��ϼ���</td>
</tr>
<!-- ���, Ǫ��  -->
<tr height=25 bgcolor=bbbbbb><td colspan=2 align=center style=font-family:Tahoma;font-size:9pt;><b>�Խ��� ���ϴܿ� ����� ����, ���� ����</td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:9pt;><b>�Խ��� ��ܿ� �ҷ��� ����&nbsp;</td>
  <td>&nbsp;&nbsp;
    <input type=text name=header_url value='<?echo stripslashes($data[header_url]);?>' size=40 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:9pt;><b>�Խ��� ��ܿ� ����� ����&nbsp;</td>
  <td>&nbsp;&nbsp;
    <textarea name=header cols=70 rows=10 class=textarea style=border-color:#b0b0b0><?echo stripslashes($data[header]);?></textarea>
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:9pt;><b>�Խ��� �ϴܿ� �ҷ��� ����&nbsp;</td>
  <td>&nbsp;&nbsp;
    <input type=text name=footer_url value='<?echo stripslashes($data[footer_url]);?>' size=40 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:9pt;><b>�Խ��� �ϴܿ� ����� ����&nbsp;</td>
  <td>&nbsp;&nbsp;
    <textarea name=footer cols=70 rows=10 class=textarea style=border-color:#b0b0b0><?echo stripslashes($data[footer]);?></textarea>
  </td>
</tr>
<tr align=right bgcolor=#ffffff><td colspan=2><img src=images/t.gif height=5><br><input type=image border=0 src=images/button_confirm.gif> &nbsp;<img style=cursor:hand onclick=reset() border=0 src=images/button_cancel.gif>&nbsp;&nbsp;</td>
</tr>
</form>
</table>
