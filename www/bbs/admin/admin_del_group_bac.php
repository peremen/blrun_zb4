<?
  $data=mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));
  $check_open[$data[is_open]]="checked";
  $check_join[$data[use_join]]="checked";

  // ���� �׷쵥��Ÿ �̾ƿ�;;;
  $temp=mysql_query("select no,name from $group_table where no!='$group_no'");
  while($temp2=mysql_fetch_array($temp))
  {
   $group_option.="<option value='$temp2[no]'>$temp2[name]</option>";
  }
?>
<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#b0b0b0>
  <tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_deletegroup.gif></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td></tr>

<form name=write method=post action=<?=$PHP_SELF?> enctype=multipart/form-data onsubmit="return confirm('�����Ͻðڽ��ϱ�?')">
<input type=hidden name=exec value=del_group_ok>
<input type=hidden name=group_no value=<?=$group_no?>>

  <tr align=center><td bgcolor=bbbbbb colspan=2 height=25 style=font-family:Tahoma;font-size:8pt;>Group Name : <b><?=$data[name]?></b></td></tr>
  <tr align=center><td colspan=2 style=line-height:180%; bgcolor=#e0e0e0><br>
  �׷��� �����Ҷ��� �ش� �׷쿡 �����ִ� ȸ����� <br>
  �׷쿡�� ������ �Խ��ǵ鿡 ���ؼ� �̵��� ���־�� �մϴ�.<br>
  �����ϰ� ������ �Ͽ� �ֽñ� �ٶ��ϴ�.<br><br>
  <B style=color:#cc0000>����� ���� �ֿ������� �����ϴ� -_-��</b><br><br>
  </td></tr>

  <tr align=right>
    <td width=47%  style=font-family:Tahoma;font-size:8pt;><br>ȸ������ �̵���ų �׷� ���� : &nbsp;</font></td>
    <td align=left><br>&nbsp;<select name=member_move><?=$group_option?></select></td>
  </tr>
  <tr align=right>
    <td style=font-family:Tahoma;font-size:8pt;>�Խ����� �̵���ų �׷� ���� : &nbsp;<br><br></td>
    <td align=left>&nbsp;<select name=board_move><?=$group_option?></select><br><br></td>
  </tr>
  <tr align=center><td colspan=2 bgcolor=#e0e0e0><br><input type=submit value=' Delete Group ' style='border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;font-weight:bold;color=#ff5555'> <input type=button value= ' go Back ' onclick=history.back() style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;><br><br></td></tr>
  </form>
</table>
