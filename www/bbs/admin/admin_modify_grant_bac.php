<?
$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));

if($member[is_admin]>2&&!preg_match("/".$no.",/i",$member[board_name])) error("��� ������ �����ϴ�");

$board_data=mysql_fetch_array(mysql_query("select * from $admin_table where no='$no'")); 
?>
<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#b0b0b0>
<tr height=30><td bgcolor=#3d3d3d colspan=10><img src=images/admin_webboard.gif></td>
</tr>
<tr height=30>
  <td bgcolor=white colspan=10 align=right style=font-family:Tahoma;font-size:9pt;>
    �׷� �̸� : <b><?=$group_data[name]?></b> , �Խ��� �̸� : <a href=zboard.php?id=<?=$board_data[name]?> target=_blank><b><?=$board_data[name]?></a></b> &nbsp;&nbsp;&nbsp;
    <input type=button value='�Խ��ǰ���' class=input style=width=100px onclick=location.href="<?=$PHP_SELF?>?exec=view_board&group_no=<?=$group_no?>&exec2=modify&no=<?=$no?>&page=<?=$page?>&page_num=<?=$page_num?>">
    <input type=button value='ī�װ� ����' class=input style=width=100px onclick=location.href="<?=$PHP_SELF?>?exec=view_board&group_no=<?=$group_no?>&exec2=category&no=<?=$no?>&page=<?=$page?>&page_num=<?=$page_num?>">&nbsp;&nbsp;&nbsp;
  </td>
</tr>
<tr height=1><td bgcolor=#000000 style=padding:0px; colspan=10><img src=images/t.gif height=1></td>
</tr>
<form method=post action=<?=$PHP_SELF?>>
<input type=hidden name=exec value=<?=$exec?>>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=exec2 value=modify_grant_ok>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=no value=<?=$no?>>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;width=30%><b>��� ���� ���� &nbsp;</td>
  <td >&nbsp;&nbsp;
    <select name=grant_list class=input >
<?
for($i=1;$i<=10;$i++)
if($i==$board_data[grant_list]) echo "<option value=$i selected>$i</option>";
else echo "<option value=$i>$i</option>";
?>

    </select> &nbsp;&nbsp;
    �� ��� ���� ������ �������� �����մϴ�
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;><b>���� ���� ���� &nbsp;</td>
  <td >&nbsp;&nbsp;
    <select name=grant_view  class=input>
<?
for($i=1;$i<=10;$i++)
if($i==$board_data[grant_view]) echo "<option value=$i selected>$i</option>";
else echo "<option value=$i>$i</option>";
?>

    </select> &nbsp;&nbsp;
    ���� ������ ������ �ִ� ������ �������� �����մϴ�
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;><b>�۾��� ���� &nbsp;</td>
  <td >&nbsp;&nbsp;
    <select name=grant_write class=input>
<?
for($i=1;$i<=10;$i++)
if($i==$board_data[grant_write]) echo "<option value=$i selected>$i</option>";
else echo "<option value=$i>$i</option>";
?>

    </select> &nbsp;&nbsp;
    �۾��� ������ �������� �����մϴ�.
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;><b>������ ��� ���� ���� &nbsp;</td>
  <td >&nbsp;&nbsp;
    <select name=grant_comment class=input>
<?
for($i=1;$i<=10;$i++)
if($i==$board_data[grant_comment]) echo "<option value=$i selected>$i</option>";
else echo "<option value=$i>$i</option>";
?>

    </select> &nbsp;&nbsp;
    ���(�ڸ�Ʈ) �ޱ� ������ �������� �����մϴ�
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;><b>�亯���� ���� &nbsp;</td>
  <td >&nbsp;&nbsp;
    <select name=grant_reply class=input>
<?
for($i=1;$i<=10;$i++)
if($i==$board_data[grant_reply]) echo "<option value=$i selected>$i</option>";
else echo "<option value=$i>$i</option>";
?>

    </select> &nbsp;&nbsp;
    �亯 �ޱ� ������ �������� �����մϴ�.
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;><b>���� ���� &nbsp;</td>
  <td >&nbsp;&nbsp;
    <select name=grant_delete class=input>
<?
for($i=1;$i<=10;$i++)
if($i==$board_data[grant_delete]) echo "<option value=$i selected>$i</option>";
else echo "<option value=$i>$i</option>";
?>

    </select> &nbsp;&nbsp;
    �� ���� ������ �������� �����մϴ�.
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;><b> HTML ��� ���� &nbsp;</td>
  <td >&nbsp;&nbsp;
    <select name=grant_html class=input>
<?
for($i=1;$i<=10;$i++)
if($i==$board_data[grant_html]) echo "<option value=$i selected>$i</option>";
else echo "<option value=$i>$i</option>";
?>

    </select> &nbsp;&nbsp;
    HTML ��� ����Ҽ� �ִ� ������ �������� �����մϴ�.
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;><b>�������� �ۼ� ���� &nbsp;</td>
  <td >&nbsp;&nbsp;
    <select name=grant_notice class=input>
<?
for($i=1;$i<=10;$i++)
if($i==$board_data[grant_notice]) echo "<option value=$i selected>$i</option>";
else echo "<option value=$i>$i</option>";
?>

    </select> &nbsp;&nbsp;
    �������� �ۼ� ������ �������� �����մϴ�.
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;><b>��б� ���� ���� &nbsp;</td>
  <td >&nbsp;&nbsp;
    <select name=grant_view_secret class=input>
<?
for($i=1;$i<=10;$i++)
if($i==$board_data[grant_view_secret]) echo "<option value=$i selected>$i</option>";
else echo "<option value=$i>$i</option>";
?>

    </select> &nbsp;&nbsp;
    ��� �� ���� ������ �������� �����մϴ�.
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;><b>Image Box ��� ���� &nbsp;</td>
  <td >&nbsp;&nbsp;
    <select name=grant_imagebox class=input>
<?
if(!$board_data[use_showip]) $board_data[use_showip]=1;
for($i=1;$i<10;$i++)
if($i==$board_data[use_showip]) echo "<option value=$i selected>$i</option>";
else echo "<option value=$i>$i </option>";
?>

    </select> &nbsp;&nbsp;
	Image Box �������� �������� �����մϴ�. (ȸ���� ��밡���մϴ�)
  </td>
</tr>
<!-- Submit  -->
<tr align=right bgcolor=#ffffff><td colspan=2><img src=images/t.gif height=5><br><input type=image border=0 src=images/button_confirm.gif accesskey="s"> &nbsp;<img style=cursor:hand onclick=reset() border=0 src=images/button_cancel.gif>&nbsp;&nbsp;</td>
</form>
</tr>
</table>
