<?
include $dir."/swe/ed_seting_head.php";

if($mode=="reply") $title="��� ����";
elseif($mode=="modify") $title="�� �����ϱ�";
else $title="���� �� ����";


$m_memo = explode("|||",$memo);
$memo = $m_memo[0];  
$_name2 = $m_memo[1];  
$_name3 = $m_memo[2]; 
$_name4 = $m_memo[3]; 
$_name5 = $m_memo[4];
$_name6 = $m_memo[5];
$_name7 = $m_memo[6];
$_name8 = $m_memo[7];
$_name9 = $m_memo[8];
$_name10 = $m_memo[9];

$a_preview = str_replace(">","><font class=com2>",$a_preview)."";
$a_imagebox = str_replace(">","><font class=com2>",$a_imagebox)."";
$a_codebox = str_replace(">","><font class=com2>",$a_codebox)."";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function zb_formresize(obj) {
	obj.rows += 4;
}

function check_submit_y()
{
	if(document.check_attack.check.value==1)
	{
		alert('�۾��� ��ư�� ������ �����ø� �ȵ˴ϴ�.');
		return false;
	}

	if(edit_tag_yn == "Y")
	{
		document.getElementById("memo").value = memoi2memo(memoiW.document.body.innerHTML);
	}

	if(use_category_yn == "Y")
	{
		var myindex=document.getElementById('write').category[1].selectedIndex;
		if (myindex<1)
		{
			alert('ī�װ��� �����Ͽ� �ּ���.');
			document.getElementById('write').category[1].focus();
			return false;
		}
	}

	if(member_yn == "Y")
	{
		if(!document.write.password.value)
		{
			alert('��ȣ�� �Է��Ͽ� �ּ���.\n\n��ȣ�� �Է��ϼž� ����/������ �� �� �ֽ��ϴ�.');
			document.write.password.focus();
			return false;
		}

		if(!document.write.name.value)
		{
			alert('�̸��� �Է��Ͽ� �ּ���.');
			document.write.name.focus();
			return false;
		}
	}

	if(!document.write.subject.value)
	{
		alert('������ �Է��Ͽ� �ּ���.');
		document.write.subject.focus();
		return false;
	}

	if(edit_tag_yn == "Y") {
		if(!memoiW.document.body.innerHTML||memoiW.document.body.innerHTML=="<P>&nbsp;</P>"||memoiW.document.body.innerHTML=="<br>")
		{
			alert('��ǰ������ �Է��Ͽ� �ּ���.');
			memoiW.focus();
			return false;
		}
	} else {
		if(!memoE.value||memoE.value=="<P>&nbsp;</P>"||memoE.value=="<br>")
		{
			alert('��ǰ������ �Է��Ͽ� �ּ���.');
			document.write.memo.focus();
			return false;
		}
	}

	if(document.write._name2.value==""){
		alert("�����縦 �Է��ϼ���!");
		document.write._name2.focus();
		return false;
	}
	else if(document.write._name3.value==""){
		alert("�������� �Է��ϼ���!");
		document.write._name3.focus();
		return false;
	}
	else if(document.write._name4.value==""){
		alert("��ǰ������ �Է��ϼ���!");
		document.write._name4.focus();
		return false;
	}
	else if(document.write._name5.value==""){
		alert("��ǰ�ɼ��� �Է��ϼ���!");
		document.write._name5.focus();
		return false;
	}
	else if(document.write._name6.value=="0"){
		alert("������ �Է��ϼ���!");
		document.write._name6.focus();
		return false;
	}
	else if(document.write._name8.value==""){
		alert("�ǸŰ����� �Է��ϼ���!");
		document.write._name8.focus();
		return false;
	}

	if(subeva_yn == "Y")
	{
		if(edit_tag_yn == "Y")
		{
			if(document.getElementById("subject").value && memoiW.document.body.innerHTML) { sub_val_ins(); }
		} else {
			if(document.getElementById("subject").value && memoE.value) { sub_val_ins(); }
		}
	}

	sw_mcpy();

	document.check_attack.check.value=1;
	show_waiting();
	hideImageBox();

	return true;
}
//-->
</SCRIPT><br>
<?$_url=$dir."/write_ok.php";?>
<table border=0 cellspacing=0 cellpadding=2 width=<?=$width?> align=center style=border-width:1pt;border-style:solid;border-color:cccccc style=table-layout:fixed>
<tr align=left valign="middle" height=25>
  <td class=list_eng>&nbsp;&nbsp;<img src=<?=$dir?>/images/front_img.gif>&nbsp;&nbsp;���۾��� </td>
</tr>
</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0 style=table-layout:fixed>
<form method=post id=write name=write action=<?=$_url?> onsubmit="return check_submit_y();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>"><input type=hidden name=wantispam value="<?=$wnum1num2?>"><input type=hidden name=_zb_path value="<?=$config_dir?>"><input type=hidden name=_zb_url value="<?=$zb_url?>">
<col width=80 align=right style=padding-right:10px;height:28px class=com2></col><col class=list1 style=padding-left:10px;height:28px width=></col>
<?=$hide_start?>

<tr>
  <td><font class=com2><b>�̸�</b></font></td>
  <td><input type=text name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2><b>��ȣ</b></font></td>
  <td><input type=password name=password <?=size(20)?> maxlength=20 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2>Ȩ������</font></td>
  <td><input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2>�̸���</font></td>
  <td><input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<?=$hide_end?>

<tr>
  <td><font class=com2>����</font></td>
  <td>
    <SELECT NAME=_name6 value=<?=$_name6?>>
<? $checked=array("","","","","",""); $checked[$_name6]="selected" ?>
    <option value=0 <?=$checked[0]?>>����Ʈ</option>
    <option value=1 <?=$checked[1]?>>��</option>
    <option value=2 <?=$checked[2]?>>�ڡ�</option>
    <option value=3 <?=$checked[3]?>>�ڡڡ�</option>
    <option value=4 <?=$checked[4]?>>�ڡڡڡ�</option>
    <option value=5 <?=$checked[5]?>>�ڡڡڡڡ�</option>
    </SELECT>
    <SELECT NAME=_name7 value=<?=$_name7?>>
<?$checked[$_name7]="selected"?>
    <option value=0 <?=$checked[0]?>>����</option>
    <option value=1 <?=$checked[1]?>>��</option>
    </select>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2>������</font></td>
  <td><input type=text name=_name2 value="<?=$_name2?>" <?=size(20)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2>������</font></td>
  <td><input type=text name=_name3 value="<?=$_name3?>" <?=size(20)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2>��ǰ����</font></td>
  <td><input type=text name=_name4 value="<?=$_name4?>" <?=size(10)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td><font class=com2>�ǸŰ���</font></td>
  <td><input type=text name=_name8 value="<?=$_name8?>" <?=size(10)?> maxlength=200 class=input>��</td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2>��ǰ�ɼ�</font></td>
  <td><input type=text name=_name5 value="<?=$_name5?>" <?=size(50)?> maxlength=200 style=width:99% class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2>������ URL</font></td>
  <td>������ : <input type=text name=_name9 value="<?=$_name9?>" <?=size(70)?> maxlength=200 class=input><BR>����� : <input type=text name=_name10 value="<?=$_name10?>" <?=size(70)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2>�ɼ�</font></td>
  <td class=com2>
    <?=$hide_category_start?><?=$category_kind?><?=$hide_category_end?>

    <?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1>��������<?=$hide_notice_end?> <input type=checkbox name=reply_mail <?=$reply_mail?> value=1>�亯���Ϲޱ�<?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1>��б�<?=$hide_secret_end?>

    <?=$hide_html_start?>
    <? include $dir."/swe/ed_seting_option.php"; ?>
    <?=$hide_html_end?>

  </td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2><b>����</b></font></td>
  <td><? include $dir."/swe/ed_seting_substyle.php"; ?></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td onclick='javascript:edit_window_size("height_in");' style=cursor:pointer>
  <font class=com2><b>��ǰ����</b></font> <font class=com2>��</font></td>
  <td style=padding-top:8px;padding-bottom:8px;>
  <? include $dir."/swe/ed_seting_edit.php"; ?>
  </td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2>������ Ȩ������</font></td>
  <td><input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<tr>
  <td><font class=com2>���� Ȩ������</font></td>
  <td><input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<?=$hide_pds_start?>

<tr>
  <td><font class=com2>���� #1</font></td>
  <td class=com2><? echo(filebox_add("1",$file_name1)) ?></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td><font class=com2>���� #2</font></td>
  <td class=com2><? echo( filebox_add("2",$file_name2)) ?></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<?=$hide_pds_end?>

</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
	<td width=130 height=40>
		<?=$a_preview?><img src=<?=$dir?>/images/bt_prev.gif border=0></a>
		<?=$a_imagebox?><img src=<?=$dir?>/images/bt_imgbox.gif border=0></a>
	</td>
	<td width=60 valign=middle><?=$a_codebox?>�ڵ����</a></td>
	<td align=right>
		<input type=image src=<?=$dir?>/images/bt_write_ok.gif border=0 accesskey="s" onfocus=blur()>&nbsp;<a href=# onclick=history.back() onfocus=blur()><img src=<?=$dir?>/images/bt_cancel.gif border=0></a>
	</td>
</tr>
</form>
</table>
<br>
