
<script>
function check_submit() {
	if(!write.name.value) {
		alert("�׷��̸��� �Է��ϼž� �մϴ�");
		write.name.focus();
		return false;
	}
return true;
}
</script>
<table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=#b0b0b0>
<form name=write method=post action=<?=$PHP_SELF?> enctype=multipart/form-data onsubmit="return check_submit();">
<input type=hidden name=exec value=add_group_ok>
<tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_addgroup.gif></td>
</tr>
<tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;> <font color=red>*</font> <b>�׷� �̸�</b>&nbsp;&nbsp;</td><td align=left>&nbsp;<input type=text name=name size=20 maxlength=20 class=input style=border-color:#b0b0b0> �׷��̸��� �Է��ϼ���</td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;> <b>�׷� ���� ����</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=is_open checked value=1></td><td style=font-family:Tahoma;font-size:8pt;> Yes &nbsp;&nbsp;</td><td><input type=radio name=is_open value=0></td><td style=font-family:Tahoma;font-size:8pt;> No &nbsp; �����׷��̸� Yes, �ƴϸ� No�� �����ϼ���</td></tr></table></td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;><b>ȸ�� ���� ���</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=use_join checked value=1></td><td style=font-family:Tahoma;font-size:8pt;> Yes &nbsp;&nbsp;</td><td><input type=radio name=use_join value=0></td><td style=font-family:Tahoma;font-size:8pt;> No &nbsp; ȸ�������� ����ҰŸ� Yes, �ƴϸ� No�� �����ϼ���</td></tr></table></td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt; valign=top><img src=images/t.gif height=3><br><b>�׷� ������</b>&nbsp;&nbsp;</td><td align=left height=60 style=font-family:Tahoma;font-size:8pt;line-height:160%>&nbsp;<input type=file name=icon size=40 class=input style=border-color:#b0b0b0;font-family:Tahoma;font-size:8pt;> &nbsp; <br>&nbsp; �Ϲݸ������ �������� �����ϼ���.<br>&nbsp;(Under Width,Height 24pixel JPG/JEPG/GIF/PNG/BMP File format)</td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt;><b>ȸ�� ǥ�� ���</b>&nbsp;&nbsp;</td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td><input type=radio name=use_icon value=0 ></td><td style=font-family:Tahoma;font-size:8pt;> ������ ��� &nbsp&nbsp;</td><td><input type=radio name=use_icon checked value=1></td><td style=font-family:Tahoma;font-size:8pt;> ���� ���� &nbsp;&nbsp;</td><td><input type=radio name=use_icon value=2></td><td style=font-family:Tahoma;font-size:8pt;> ���� ���� ����&nbsp; </td><tr><td colspan=4 height=20>&nbsp;ȸ��ǥ�� ����� �����ϼ���</td></tr></table></td>
</tr>
<tr align=right bgcolor=#e0e0e0><td style=font-family:Tahoma;font-size:8pt; valign=top><img src=images/t.gif height=3><br><b>ȸ�������� �̵��� ������</b>&nbsp;&nbsp;</td><td align=left style=font-family:Tahoma;font-size:8pt;><input type=text name=join_return_url size=40 maxlength=255 class=input style=border-color:#b0b0b0><br><img src=images/t.gif border=0 height=4><br>&nbsp;�Խ����� �ƴѰ������� ȸ������, �α��ν� �̵��� URL�� �Է��ϼ���</td>
</tr>
<!-- ���, Ǫ��  -->
<tr height=25 bgcolor=bbbbbb><td colspan=2  align=center  style=font-family:Tahoma;font-size:8pt;><b>�Խ��� ��, �ϴܿ� ����� ����Footer</td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>�Խ��� ��ܿ� �ҷ��� ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text  name=header_url value='<?echo stripslashes($data[header_url]);?>' size=40 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>�Խ��� ��ܿ� ��µ� ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <textarea name=header cols=70 rows=10 class=textarea style=border-color:b0b0b0><?echo stripslashes($data[header]);?></textarea>
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>�Խ��� �ϴܿ� �ҷ��� ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text  name=footer_url value='<?echo stripslashes($data[footer_url]);?>' size=40 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>�Խ��� �ϴܿ� ��µ� ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <textarea name=footer cols=70 rows=10 class=textarea style=border-color:#b0b0b0><?echo stripslashes($data[footer]);?></textarea>
  </td>
</tr>
<tr align=right bgcolor=#ffffff><td colspan=2><img src=images/t.gif height=5><br><input type=image border=0 src=images/button_confirm.gif accesskey="s"> &nbsp;<img style=cursor:hand onclick=reset() border=0 src=images/button_cancel.gif>&nbsp;&nbsp;</td>
</tr>
</form>
</table>
