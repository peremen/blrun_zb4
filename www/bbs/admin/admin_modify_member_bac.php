<?
$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));

$member_data=mysql_fetch_array(mysql_query("select * from $member_table where no='$no'"));

if($member[is_admin]>1&&$member[no]!=$member_data[no]&&$member_data[level]<=$member[level]&&$member_data[is_admin]<=$member[is_admin]) error("�����Ͻ� ȸ���� ������ ������ ������ �����ϴ�");

$check[1]="checked";
?>

<script>
 function check_submit()
 {
  if(write.password.value!=write.password1.value) {alert("�н����尡 ��ġ���� �ʽ��ϴ�.");write.password.value="";write.password1.value=""; write.password.focus(); return false;}
  if(!write.name.value) { alert("�̸��� �Է��ϼ���"); write.name.focus(); return false; }

<? if($group_data[use_birth]) { ?>

  if ( write.birth_1.value < 1000 || write.birth_1.value <= 0 )  {
    alert('������ �߸��ԷµǾ����ϴ�.');
    write.birth_1.value='';
    write.birth_1.focus();
    return false;
  }
  if ( write.birth_2.value > 12 || write.birth_2.value <= 0 ) {
    alert('������ �߸��ԷµǾ����ϴ�.');
    write.birth_2.value='';
    write.birth_2.focus();
    return false;
  }
  if ( write.birth_3.value > 31 || write.birth_3.value <= 0 )  {
    alert('������ �߸��ԷµǾ����ϴ�.');
    write.birth_3.value='';
    write.birth_3.focus();
    return false;
  }
<? } ?>

  if(!write.email.value) {alert("E-Mail�� �Է��Ͽ� �ֽʽÿ�.");write.email.focus(); return false;}

  return true;
 }


  function add_board_manager() {

	var pSel=document.getElementById("board_name");
	var no=pSel.options[pSel.selectedIndex].value;

	if(no) {
		location.href="<?=$PHP_SELF?>?exec=view_member&exec2=add_member_board_manager&group_no=<?=$group_no?>&member_no=<?=$no?>&page=<?=$page?>&keyword=<?=$keyword?>&keykind=<?=$keykind?>&like=<?=$like?>&board_num="+ no + "&sid=<?=$sid?>";
	}
  }

</script>
<table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=#b0b0b0>
<tr height=30><td bgcolor=#3d3d3d colspan=2><img src=images/admin_webboard.gif></td>
</tr>
<tr height=1><td bgcolor=#000000 style=padding:0px; colspan=2><img src=images/t.gif height=1></td>
</tr>
<form name=write method=post action=<?=$PHP_SELF?> enctype=multipart/form-data onsubmit="return check_submit();">
<input type=hidden name=exec value=view_member>
<input type=hidden name=exec2 value=modify_member_ok>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=member_no value=<?=$no?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keykind value=<?=$keykind?>>
<input type=hidden name=keyword value=<?=$keyword?>>
<input type=hidden name=like value=<?=$like?>>
<input type=hidden name=sid value=<?=$sid?>>
<tr height=22 align=center><td height=30 colspan=2><b><?=$member_data[name]?></b> ȸ�� ���� ����</td>
</tr>
<tr height=22 align=center bgcolor=#e0e0e0>
  <td width=25% align=right bgcolor=#a0a0a0 style=font-family:Tahoma;font-size:9pt;font-weight:bold;>���̵�&nbsp;&nbsp;</td>
  <td align=left>&nbsp;<?=$member_data[user_id]?> &nbsp;(<?=date("Y�� m�� d�� H�� i��",$member_data[reg_date])?>�� ����)</td>
</tr>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>��й�ȣ&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=password name=password size=20 maxlength=20 class=input style=border-color:#b0b0b0> Ȯ�� : <input type=password name=password1 size=20 maxlength=20 class=input style=border-color:#b0b0b0></td>
</tr>
<?
if($member[no]==$no) $locking = "disabled";

if($member[is_admin]==1)
{
	$select[$member_data[is_admin]]="selected";
?>
<tr height=22 align=center>  
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>������ ����&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0>
    <select name=is_admin <?=$locking?>>
    <option value=3 <?=$select[3]?>>�Ϲݻ����</option>
    <option value=2 <?=$select[2]?>>�׷������</option>
    <option value=1 <?=$select[1]?>>�ְ������</option>
    </select> (������ ������ �Ϲ� ������ �켱�մϴ�)
  </td>
</tr>
<?
}
?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>����&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0>
    <select name=level <?=$locking?>>
<?
for($i=$member[level];$i<=10;$i++) if($i==$member_data[level]) echo "<option value=$i selected>$i</option>"; else echo "<option value=$i>$i</option>";
?>

    </select>
  </td>
</tr>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>�̸�&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=name size=20 maxlength=20 value="<?=$member_data[name]?>" class=input style=border-color:#b0b0b0></td>
</tr>
<?                                                                                                  
if($member_data[is_admin]>2)                                                                          
{                                                                                                 

	if(trim($member_data[board_name])) {
		$manager_board_temp = preg_split("/,/",$member_data[board_name]);
		$get_string .= " (no = '$manager_board_temp[0]') ";
		for($__k=1;$__k<count($manager_board_temp);$__k++){
			if(trim($manager_board_temp[$__k])) $get_string .= " or (no = '$manager_board_temp[$__k]') ";
		}
		$manager_board_list = mysql_query("select * from $admin_table where $get_string",$connect) or die(mysql_error());
		while($__manager_data = mysql_fetch_array($manager_board_list)) {
			$__manager_board_name .= "&nbsp;".stripslashes($__manager_data[name])." &nbsp; <a href='$PHP_SELF?exec=view_member&exec2=modify_member_board_manager&group_no=$group_no&member_no=$no&page=$page&keyword=$keyword&board_num=$__manager_data[no]&sid=$sid' onclick=\"return confirm('������ ��ҽ�Ű�ðڽ��ϱ�?')\">[�������]</a><br><img src=images/t.gif border=0 height=4><br>";

		}
	}

	$select[$member_data[board_name]]="selected";                                                      
	$board_list=mysql_query("select no,name from $admin_table where group_no='$group_data[no]'") or error(mysql_error());
?>                                                                                                  
<tr height=22 align=center>                                                                       
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>�Խ��� ������ ����&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0>
    <?=$__manager_board_name?>

    <select id=board_name name=board_name>
    <option value="">�Խ��ǰ����� ����</option>
<?
	while($board_data_list=mysql_fetch_array($board_list))
	{
		if(!preg_match("/".$board_data_list[no].",/i",$member_data[board_name]))echo "
		<option value='$board_data_list[no]'>$board_data_list[name]</option>";
	}
?>

    </select> <input type=button value="�Խ��� ���� ���� �߰�" onclick="add_board_manager()" style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:9pt;font-family:Tahoma;height:20px;>
  </td>
</tr>
<?                                                                                                  
}
?> 
<? if($group_data[use_birth]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>����&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=birth_1 size=4 maxlength=4 value="<?=date("Y",$member_data[birth])?>" class=input style=border-color:#b0b0b0> �� 
    <input type=text name=birth_2 size=2 maxlength=2 value="<?=date("m",$member_data[birth])?>" class=input style=border-color:#b0b0b0> ��
    <input type=text name=birth_3 size=2 maxlength=2 value="<?=date("d",$member_data[birth])?>" class=input style=border-color:#b0b0b0> �� 
</tr>
<? } ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>E-mail&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=email size=50 maxlength=200 value="<?
  $member_data[email]=stripslashes($member_data[email]);
  // email IP ǥ�� �ҷ��� ó��
  unset($c_match);
  if(preg_match("#\|\|\|([0-9.]{1,})$#",$member_data[email],$c_match)) {
    //$tokenID = $c_match[1];
    $member_data[email] = str_replace($c_match[0],"",$member_data[email]);
  }
  echo $member_data[email];
  ?>" class=input style=border-color:#b0b0b0></td>
</tr>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>Ȩ������&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=homepage size=50 maxlength=255 value="<?=stripslashes($member_data[homepage])?>" class=input style=border-color:#b0b0b0></td>
</tr>
<? if($group_data[use_icq]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>ICQ&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=icq size=20 maxlength=20 value="<?=stripslashes($member_data[icq])?>" class=input style=border-color:#b0b0b0></td>
</tr>
<? } ?>
<? if($group_data[use_aol]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>AIM(AOL)&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=aol size=20 maxlength=20 value="<?=stripslashes($member_data[aol])?>" class=input style=border-color:#b0b0b0></td>
</tr>
<? } ?>
<? if($group_data[use_msn]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>MSN&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=msn size=20 maxlength=20 value="<?=stripslashes($member_data[msn])?>" class=input style=border-color:#b0b0b0></td>
</tr>
<? } ?>
<? if($group_data[use_hobby]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>���&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=hobby size=50 maxlength=50 value="<?=stripslashes($member_data[hobby])?>" class=input style=border-color:#b0b0b0></td>
</tr>
<? } ?>
<? if($group_data[use_job]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>����&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=job size=20 maxlength=20 value="<?=stripslashes($member_data[job])?>" class=input style=border-color:#b0b0b0></td>
</tr>
<? } ?>
<? if($group_data[use_home_address]) { ?> 
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>�� �ּ�&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=home_address size=50 maxlength=255 value="<?=stripslashes($member_data[home_address])?>" class=input style=border-color:#b0b0b0></td>
</tr>
<? } ?>
<? if($group_data[use_home_tel]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>�� ��ȭ��ȣ&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=home_tel size=20 maxlength=20 value="<?=stripslashes($member_data[home_tel])?>" class=input style=border-color:#b0b0b0></td>
</tr>
<? } ?>
<? if($group_data[use_office_address]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>ȸ�� �ּ�&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=office_address size=50 maxlength=255 value="<?=stripslashes($member_data[office_address])?>" class=input style=border-color:#b0b0b0></td>
</tr>
<? } ?>
<? if($group_data[use_office_tel]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>ȸ�� ��ȭ��ȣ&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=office_tel size=20 maxlength=20 value="<?=stripslashes($member_data[office_tel])?>" class=input style=border-color:#b0b0b0></td>
</tr>
<? } ?>
<? if($group_data[use_handphone]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>�ڵ���&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=text name=handphone size=20 maxlength=20 value="<?=stripslashes($member_data[handphone])?>" class=input style=border-color:#b0b0b0></td>
</tr>
<? } ?>
<? if($group_data[use_mailing]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>���ϸ�����Ʈ ����&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=checkbox name=mailing value=1 <?=$check[$member_data[mailing]]?>></td>
</tr>
<? } ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>���� ���� ����&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=checkbox name=openinfo value=1 <?=$check[$member_data[openinfo]]?>></td>
</tr>
<? if($group_data[use_picture]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>����&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><input type=file name=picture size=37 maxlength=255 class=input style=border-color:#b0b0b0> (480X480 �̳�)
    <? if($member_data[picture]) echo "<br>&nbsp;<img src='$member_data[picture]' border=0>"; ?>
  </td>
</tr>
<? } ?>
<? if($group_data[use_comment]) { ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>�Ұ���&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0><textarea cols=50 rows=4 name=comment class=textarea style=border-color:#b0b0b0><?=stripslashes($member_data[comment])?></textarea></td>
</tr>
<? } ?>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>Point&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0>&nbsp;<?=($member_data[point1]*10+$member_data[point2])?> �� ( �ۼ��ۼ� : <?=$member_data[point1]?>, �ڸ�Ʈ : <?=$member_data[point2]?> )</td>
</tr>
<tr height=22 align=center>
  <td colspan=2 bgcolor=#a0a0a0 style=font-family:Tahoma;font-size:9pt;font-weight:bold; align=center>������ ��������</td>
</tr>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>Image Box �뷮 ����&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0>
<?
$maxDirSize = zReadFile("icon/member_image_box/".$no."_maxsize.php");
if($maxDirSize) {
	$maxDirSize = str_replace("<?/*","",$maxDirSize);
	$maxDirSize = str_replace("*/?>","",$maxDirSize);
	$maxDirSize = (int)($maxDirSize / 1024);
} else {
	$maxDirSize = 20000;
}
?>
    <input type=input name=maxdirsize value="<?=$maxDirSize?>" size=10 maxlength=20 class=input> KByte &nbsp; �̹��� â���� ��� �뷮�� ������ �ټ� �ֽ��ϴ�.
  </td>
</tr>
<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>��ũ �׸�&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0>&nbsp;
<? 
$private_icon = get_private_icon($member_data[no],1);
if($private_icon) {
?>
    <img src='<?=$private_icon?>' border=1>
    <input type=checkbox value=1 name=delete_private_icon > Delete
<?
} else echo "
    <img src=images/t.gif border=1 width=16 height=15>";
?>
    <br>
    <input type=file name=private_icon value="" size=20 maxlength=20 class=input >
    <br>
    <img src=images/t.gif border=0 height=5><br>
    * ������ ȸ���� �̸� �տ��� ��Ÿ���� �������Դϴ�. <br>
    <font color=#e0e0e0>* </font>(GIF ���ϸ� �����մϴ�. 16x16 px ���Ϸ� ���ּ���)
  </td>
</tr>

<tr height=22 align=center>
  <td bgcolor=#a0a0a0 align=right style=font-family:Tahoma;font-size:9pt;font-weight:bold;>�̸� �׸�&nbsp;&nbsp;</td>
  <td align=left bgcolor=#e0e0e0>&nbsp;
<?
$private_name = get_private_icon($member_data[no],2);
if($private_name) {
?>

    <img src='<?=$private_name?>' border=1>
    <input type=checkbox value=1 name=delete_private_name > Delete
<?
} else echo "
    <img src=images/t.gif border=1 width=16 height=15>";
	?>

    <br>
    <input type=file name=private_name value="" size=20 maxlength=20 class=input >
    <br>
    <img src=images/t.gif border=0 height=5><br>
    * ������ ȸ���� �̸��� ����ؼ� ��Ÿ���� �������Դϴ�. <br>
    <font color=#e0e0e0>* </font>��Ų�� ���� �������� ����ų�� ������ Ȯ���� �� �Ͽ��ּ���<br>
    <font color=#e0e0e0>* </font>(GIF ���ϸ� �����մϴ�. ũ��� 60x16 px ���Ϸ� ���ּ���)
  </td>
</tr>
<tr height=22 align=center>
  <td colspan=2><input type=submit value='  ���� �Ϸ�  ' style=font-weight:bold;border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:9pt;font-family:Tahoma;height:23px;>
    <input type=button value='  ���� ���  ' style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:9pt;font-family:Tahoma;height:23px; onclick=location.href="<?="$PHP_SELF?exec=view_member&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&keykind=$keykind&like=$like&sid=$sid"?>">
  </td>
</tr>
</form>
</table>
