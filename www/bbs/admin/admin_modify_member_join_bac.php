<?
  $data=mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));
  $check[1]="checked";
?>
<table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=#b0b0b0>
  <tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_memberjoin.gif></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td></tr>
<form name=write method=post action=<?=$PHP_SELF?>>
<input type=hidden name=exec value=modify_member_join_ok>
<input type=hidden name=group_no value=<?=$group_no?>>
  <tr align=center bgcolor=#e0e0e0>
     <td colspan=2 bgcolor=#e0e0e0 style=line-height:180%>
         �� �׷��� ȸ�����Խ� ��Ÿ���� ���Ծ���� �����Ҽ� �ֽ��ϴ�.<br>
         ���� �⺻���� ���̵�, ��й�ȣ, �̸�, E-Mail�� ���� �Ұ����մϴ�;;;
     </td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td width=20% align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>���Խ� �⺻ ����</td>
     <td align=left>&nbsp;<select name=join_level>
<?
 for($i=$member[level];$i<=10;$i++)
 {
  if($i==$data[join_level]) echo"<option value=$i selected>$i</option>"; else echo "<option value=$i>$i</option>";
 }
?></select>
     �⺻������ ���Ҽ� �ֽ��ϴ�. 1~10�����Դϴ�</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>ICQ </td>
     <td align=left>&nbsp;<input type=checkbox name=use_icq value=1 <?=$check[$data[use_icq]]?>> �ƾ�ť��ȣ�� �Է¹����� �ֽ��ϴ�</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>AIM(AOL) </td>
     <td align=left>&nbsp;<input type=checkbox name=use_aol value=1 <?=$check[$data[use_aol]]?>> AOL��ȣ�� �Է¹����� �ֽ��ϴ�</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>MSN </td>
     <td align=left>&nbsp;<input type=checkbox name=use_msn value=1 <?=$check[$data[use_msn]]?>> MSN ��ȣ�� �Է¹����� �ֽ��ϴ�</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>�ֹε�Ϲ�ȣ </td>
     <td align=left>&nbsp;<input type=checkbox name=use_jumin value=1 <?=$check[$data[use_jumin]]?>> �ֹε�Ϲ�ȣ�� �Է¹����� �ֽ��ϴ�. �����ֹε�Ϲ�ȣ�� �ڵ����� üũ�մϴ�</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>�ڱ�Ұ��� �ۼ� </td>
     <td align=left>&nbsp;<input type=checkbox name=use_comment value=1 <?=$check[$data[use_comment]]?>> �ڱ�Ұ����� �ۼ��Ҽ� �ְ� �մϴ�</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>���</td>
     <td align=left>&nbsp;<input type=checkbox name=use_hobby value=1 <?=$check[$data[use_hobby]]?>> ��̸� �Է¹����� �ֽ��ϴ�.</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>����</td>
     <td align=left>&nbsp;<input type=checkbox name=use_job value=1 <?=$check[$data[use_job]]?>> ������ �Է¹����� �ֽ��ϴ�.</td>
  </tr>

  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>�� �ּ�</td>
     <td align=left>&nbsp;<input type=checkbox name=use_home_address value=1 <?=$check[$data[use_home_address]]?>> ���ּҸ� �Է¹����� �ֽ��ϴ�.</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>�� ��ȭ��ȣ</td>
     <td align=left>&nbsp;<input type=checkbox name=use_home_tel value=1 <?=$check[$data[use_home_tel]]?>> ����ȭ��ȣ�� �Է��Ҽ� �ֽ��ϴ�.</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>ȸ�� �ּ�</td>
     <td align=left>&nbsp;<input type=checkbox name=use_office_address value=1 <?=$check[$data[use_office_address]]?>> ȸ���ּҸ� �Է��Ҽ� �ֽ��ϴ�</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>ȸ�� ��ȭ��ȣ</td>
     <td align=left>&nbsp;<input type=checkbox name=use_office_tel value=1 <?=$check[$data[use_office_tel]]?>> ȸ����ȭ��ȣ�� �Է��Ҽ� �ֽ��ϴ�.</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>�ڵ���</td>
     <td align=left>&nbsp;<input type=checkbox name=use_handphone value=1 <?=$check[$data[use_handphone]]?>> �ڵ��� ��ȣ�� �Է��Ҽ� �ֽ��ϴ�</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>���ϸ� ����</td>
     <td align=left>&nbsp;<input type=checkbox name=use_mailing value=1 <?=$check[$data[use_mailing]]?>> ���ϸ� ����Ʈ �ޱ� ������ �����Ҽ� �ֽ��ϴ�</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>���� </td>
     <td align=left>&nbsp;<input type=checkbox name=use_birth value=1 <?=$check[$data[use_birth]]?>> ������ �Է¹ް� �Ҽ� �ֽ��ϴ�</td>
  </tr>
  <tr align=center bgcolor=#e0e0e0>
     <td align=right style=font-family:Tahoma;font-size:8pt;font-weight:bold>����</td>
     <td align=left>&nbsp;<input type=checkbox name=use_picture value=1 <?=$check[$data[use_picture]]?>> ���������� �Է��Ҽ� �ֽ��ϴ�</td>
  </tr>
<tr align=right bgcolor=#ffffff><td colspan=2><img src=images/t.gif height=5><br><input type=image border=0 src=images/button_confirm.gif> &nbsp;<img style=cursor:hand onclick=reset() border=0 src=images/button_cancel.gif>&nbsp;&nbsp;</td></tr>

  </form>
</table>
