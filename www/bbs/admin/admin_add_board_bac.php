<?
$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));
if($exec2=="add") $data=mysql_fetch_array(mysql_query("select * from $admin_table where no='$no'"));

$data=mysql_fetch_array(mysql_query("select * from $admin_table where no='$no'"));

if(!$data[bg_color]) $data[bg_color]="white";
if(!$data[table_width]) $data[table_width]="95";
if(!$data[cut_length]) $data[cut_length]="0";
if(!$data[page_num]) $data[page_num]="10";
if(!strlen($data[use_html])) $data[use_html]="1";
if(!strlen($data[use_showreply])) $data[use_showreply]="1";
if(!strlen($data[use_filter])) $data[use_filter]="1";
if(!strlen($data[use_autolink])) $data[use_autolink]="1";
if(!strlen($data[use_comment])) $data[use_comment]="1";
if(!strlen($data[use_alllist])) $data[use_alllist]="0";
if(!strlen($data[use_cart])) $data[use_cart]="0";
if(!strlen($data[use_formmail])) $data[use_formmail]="1";
if(!strlen($data[use_secret])) $data[use_secret]="1";
if(!$data[header]) $data[header]="<div align=center>";
if(!$data[footer]) $data[footer]="</div>";
if(!$data[memo_num]) $data[memo_num]=20;
?>
<script>
 function check_submit()
 {
  if(!write.name.value) {alert("�Խ��� �̸��� �Է��Ͽ� �ֽʽÿ�");write.name.focus();return false;}
  if(!write.table_width.value) {alert("�Խ��� ����ũ���� �Է��Ͽ� �ֽʽÿ�");write.table_width.focus();return false;}
  if(!write.memo_num.value) {alert("��ϼ��� �Է��Ͽ� �ֽʽÿ�");write.memo_num.focus();return false;}
  if(!write.page_num.value) {alert("���������� �Է��Ͽ� �ֽʽÿ�");write.page_num.focus();return false;}
  return true;
 }
</script>
<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#b0b0b0>
<form method=post action=<?=$PHP_SELF?> name=write onsubmit="return check_submit();">
<input type=hidden name=no value=<?echo $data[no];?>>
<input type=hidden name=exec value=view_board>
<input type=hidden name=exec2 value=<?if($no) echo "modify_ok"; else echo "add_ok";?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=group_no value=<?=$group_no?>>
<tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_webboard.gif></td>
</tr>
<tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td>
</tr>
<tr bgcolor=bbbbbb height=30>
  <td align=right colspan=8 height=25 colspan=2 style=font-family:Tahoma;font-size:8pt;> �׷� �̸� : <b><?=$group_data[name]?></b>&nbsp;&nbsp;&nbsp;</td>
</tr>
<!-- �⺻���� -->
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>�Խ��� �̸� &nbsp;</td>
  <td >&nbsp;&nbsp; <input type=text name=name value='<?echo $data[name];?>' <?if($no) echo "readonly"; ?> size=20 maxlength=40 class=input style=border-color:#b0b0b0></td>
</tr>

<!-- ��Ų ���� -->
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>��Ų ����&nbsp;</td>
  <td >&nbsp;&nbsp; 
    <select name=skinname>
<?
// /skin ���丮���� ���丮�� ����
$skin_dir="skin";
$handle=opendir($skin_dir);
while ($skin_info = readdir($handle))
{
	if(!preg_match("/\./i",$skin_info))
	{
		if($skin_info==$data[skinname]) $select="selected"; else $select="";
		echo "<option value=$skin_info $select>$skin_info</option>";
	}
}
closedir($handle);
?>

    </select>
  </td>
</tr>

<script>
function check1()
{
 write.use_showreply.checked=true;
 write.only_board.checked=true;
 write.use_alllist.checked=false;
}

function check2()
{
 write.use_alllist.checked=true;
 write.use_showreply.checked=false;
 write.use_secret.checked=false;
 write.only_board.checked=false;
}
</script>

<tr height=70 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>��Ų ���� ����&nbsp;</td>
  <td>&nbsp;&nbsp; 
<? unset($check);$check[$data[only_board]]="checked";?>
    <input type=checkbox name=only_board value=1 checked> �Խ������θ� ���� �����Ͽ� �ֽʽÿ�. (��Ųó�� �ӵ��� ���˴ϴ�.)<br>
    &nbsp;&nbsp; <input type=button class=input onclick=check1() style=border-color:#b0b0b0;height=18px value="�Խ��� ����"> ������ ��Ͽ� ������ �ʴ� �Խ��� ������ ��Ų
    <br> 
    <img src=images/t.gif border=0 height=4><br>&nbsp;&nbsp;
    <input type=button class=input onclick=check2() style=border-color:#b0b0b0;height=18px value="���� ����"> ������ ��Ͽ� ������ ���� ������ ��Ų
  </td>
</tr>
<!-- �Խ��� �Ӽ� ����  -->
<tr height=25 bgcolor=bbbbbb><td  colspan=2  align=center  style=font-family:Tahoma;font-size:8pt;><b>Edit Properties</b></td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>��� �׸�&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text  name=bg_image value='<?echo $data[bg_image];?>' size=50 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>��� ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text  name=bg_color value='<?echo $data[bg_color];?>' size=20 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>�Խ��� ���� ũ��&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text  name=table_width value='<?echo $data[table_width];?>' size=4 maxlength=4 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
    �Խ��� ����ũ�� (100�����̸� %�� ����) 
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>��Ͽ��� ���� ���� ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text  name=cut_length value='<?echo $data[cut_length];?>' size=11 maxlength=11 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
    ������ ���� �̻��� ������� ... �� ������ ǥ�� (0:������)
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>�������� ��� ��&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text  name=memo_num value='<?echo $data[memo_num];?>' size=3 maxlength=3 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
    ���������� ��µ� ����� �� (1~999) 
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>������ ǥ�� ��&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text name=page_num value='<?echo $data[page_num];?>' size=3 maxlength=3 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
    ����� �Ʒ��κп� ǥ�õ� �������� ���� (1~999) 
  </td>
</tr>
<!-- ���, Ǫ��  -->
<tr height=25 bgcolor=bbbbbb><td colspan=2  align=center  style=font-family:Tahoma;font-size:8pt;><b>�Խ��� ��, �ϴܿ� ǥ�õ� ���� ����</td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>Ÿ��Ʋ ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text  name=title value='<?echo $data[title];?>' size=20 maxlength=250 class=input style=border-color:#b0b0b0> &nbsp; ������ ����� Ÿ��Ʋ�� ����
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>�Խ��� ��ܿ� �ҷ��� ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text  name=header_url value='<?echo stripslashes($data[header_url]);?>' size=40 maxlength=255 class=input style=border-color:#b0b0b0> &nbsp;&nbsp;
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>�Խ��� ��ܿ� ����� ����&nbsp;</td>
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
  <td  align=right style=font-family:Tahoma;font-size:8pt;><b>�Խ��� �ϴܿ� ����� ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <textarea name=footer cols=70 rows=10 class=textarea style=border-color:#b0b0b0><?echo stripslashes($data[footer]);?></textarea>
  </td>
</tr>
<!-- ��� ����  -->
<tr height=25 bgcolor=#bbbbbb><td colspan=2  align=center  style=font-family:Tahoma;font-size:8pt;><b>�߰� ��� ����</b></td>
</tr>
<? unset($check);$check[$data[use_alllist]]="checked";?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>��ü ��� ��� (�۳��� ����)&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox name=use_alllist value='1' <?echo $check[1];?>> �۳��뺼�� �Ʒ��� ��ü ����Ʈ ���&nbsp; 
  </td>
</tr>
<? unset($check);$check[$data[use_category]]="checked";?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>ī�װ� ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox name=use_category value='1' <?echo $check[1];?>> ī�װ� ��ɻ�� &nbsp;
  </td>
</tr>
<? unset($check);$check[$data[use_html]]="checked";?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>HTML ��뿩��&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=radio name=use_html value='0' <?echo $check[0];?>> ��θ��� &nbsp;
    <input type=radio name=use_html value='1' <?echo $check[1];?>> �κ���� &nbsp;
    <input type=radio name=use_html value='2' <?echo $check[2];?>> ������ &nbsp; 
  </td>
</tr>
<? unset($check);if($data[use_showreply]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>�亯�� ��Ͽ� ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_showreply value='1' <?echo $check;?>> ��ۺ����ֱ�
  </td>
</tr>
<? if($data[use_filter]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>�ҷ��ܾ� ���͸� ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_filter value='1' <?echo $check;?>> 
    ��/���۵ ���� ���ͱ�� ��� 
  </td>
</tr>
<? if($data[use_status]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>�̸����� ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_status value='1' <?echo $check;?>>
    �̸����� ��� ��� (���� �����ϰ� ���� ��� ������ ���)
  </td>
</tr>
<? if($data[use_homelink]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>���� ����Ʈ ��ũ #1&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_homelink value='1' <?echo $check;?>>
    ��ũ ��� ���
  </td>
</tr>
<? if($data[use_filelink]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>���� ����Ʈ ��ũ #2&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_filelink value='1' <?echo $check;?>>
    ��ũ ��� ���
  </td>
</tr>
<? if($data[use_pds]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>�ڷ�� ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_pds value='1' <?echo $check;?>>
    �ڷ�� ��� ���,
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>÷������ #1�� ��� Ȯ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text  name=pds_ext1 value='<?echo $data[pds_ext1];?>' size=50 maxlength=250 class=input style=border-color:#b0b0b0><br>&nbsp;&nbsp; 1�� ���ε� ���� Ȯ���� ���� (����� �˻���������. ��ǥ(,)�� ����) 
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td  align=right  style=font-family:Tahoma;font-size:8pt;><b>÷������ #2 ��� Ȯ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text  name=pds_ext2 value='<?echo $data[pds_ext2];?>' size=50 maxlength=250 class=input style=border-color:#b0b0b0><br>&nbsp;&nbsp; 2�� ���ε� ���� Ȯ���� ���� (����� �˻���������. ��ǥ(,)�� ����)
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>�ְ� ���ε� ���� �뷮&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=text name=max_upload_size value=2097152 size=10  class=input style=border-color:#b0b0b0> byte &nbsp;&nbsp; (�ְ��ѵ� : <?echo get_cfg_var("upload_max_filesize"); ?> byte)
  </td>
</tr>
<? if($data[use_cart]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>�ٱ��� ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_cart value='1' <?echo $check;?>>
    �ٱ��� ��� ��� 
  </td>
</tr>
<? if($data[use_autolink]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>�ڵ���ũ ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_autolink value='1' <?echo $check;?>>
    �ڵ���ũ ��� ���
  </td>
</tr>
<? if($data[use_showip]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>Image Box ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_showip value='1' <?echo $check;?>>
	Image Box�� ��� ����
  </td>
</tr>
<? if($data[use_comment]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>������ ��� ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_comment value='1' <?echo $check;?>>
    ������ ��� ��� ���
  </td>
</tr>
<? if($data[use_formmail]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>�۾��� ����޴� ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_formmail value='1' <?echo $check;?>>
	���� �۾����� �̸� Ŭ���� ���� ���̾� �޴� ǥ�� 
  </td>
</tr>
<? if($data[use_secret]) $check="checked"; else $check=""; ?>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>��б� ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <input type=checkbox  name=use_secret value='1' <?echo $check;?>>
    ��б� ��ɻ��. �����ڿ� ��� �ƴ� ����� ���� ����
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>�ҷ��ܾ� ���&nbsp;</td>
  <td >&nbsp;&nbsp;
    <textarea name=filter cols=70 rows=6 class=textarea style=border-color:#b0b0b0><?include "admin/base_filter.txt";?></textarea><br> &nbsp;&nbsp;
    �ҷ��ܾ� ���͸� ����Դϴ�. <b>, (�޸�)</b> �� �����ϼ���
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>����� HTML �±�&nbsp;</td>
  <td >&nbsp;&nbsp;
    <textarea name=avoid_tag cols=70 rows=6 class=textarea style=border-color:#b0b0b0><?include "admin/base_avoid_tag.txt";?></textarea><br> &nbsp;&nbsp; HTML�� �κ���������� ����Ͽ� �ִ� �±��Դϴ�.<br>
    &nbsp;&nbsp; &lt;,&gt;�� �±� �̸����� �Է��ϼ���.<br>
    &nbsp;&nbsp; <b>, (�޸�)</b> �� �����ϼ���
  </td>
</tr>
<tr height=25 bgcolor=#e0e0e0>
  <td align=right style=font-family:Tahoma;font-size:8pt;><b>IP ����&nbsp;</td>
  <td >&nbsp;&nbsp;
    <textarea name=avoid_ip cols=70 rows=4 class=textarea style=border-color:#b0b0b0><?=$data[avoid_ip]?></textarea><br> &nbsp;&nbsp; ������ ���ϴ� Ư�� �����ǰ� ������ ����ϼ���.&nbsp;&nbsp; <b>, (�޸�)</b> �� �����ϼ���
  </td>
</tr>
<!-- Submit  -->
<tr height=30 bgcolor=#ffffff>
  <td colspan=2 align=right ><img src=images/t.gif height=5><br>
    <input type=image border=0 src=images/button_confirm.gif accesskey="s"> &nbsp;
    <img src=images/button_cancel.gif border=0 onClick=reset() style=cursor:hand>&nbsp;&nbsp;&nbsp;
  </td>
</tr>
</form>
</table>
