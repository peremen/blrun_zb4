
<SCRIPT LANGUAGE="JavaScript">
<!--
function formresize(mode) {
	if (mode == 0) {
		document.write.memo.cols  = 80;
		document.write.memo.rows  = 20;
	}
	if (mode == 1) {
		document.write.memo.cols += 5;
	}
	if (mode == 2) {
		document.write.memo.rows += 3;
	}
}
// -->
</SCRIPT>
<br>
<?
  /*
  write.php �� �۾��� ���Դϴ�.
  �Ʒ� ������ ����մϴ�.

  ȸ���϶� ��Ÿ���� �ʴ� �κ��� ó���ϴ� �κ��Դϴ�. �����ָ� ȸ���϶��� ��Ÿ���� �ʽ��ϴ�.
  <?=$hide_start?> : ȸ���϶� �۾������ ��Ÿ���� �ʰ� �ϴ� �κ��Դϴ�;; ȸ���϶��� �ڵ� �ּ�(<!--)�� ���ϴ�.  
  <?=$hide_end?>  : ȸ���϶� ������ �ʰ� �մϴ�. <?=$hide_start?>�� �����ϰ� <?=$hide_end?> �� �����ָ� �˴ϴ�.

  <?=$hide_sitelink1_start?>, <?=$hide_sitelink1_end?> : ����Ʈ��ũ 1���� ����ϴ��� ���ϴ��� ǥ��
  <?=$hide_sitelink2_start?>, <?=$hide_sitelink2_end?> : ����Ʈ��ũ 2���� ����ϴ��� ���ϴ��� ǥ��
  <?=$hide_pds_start?>, <?=$hide_pds_end?> : �ڷ���� ����ϴ��� ���ϴ��� ǥ��
  <?=$hide_html_start?>, <?=$hide_html_end?> : HTML üũ�ڽ� ǥ�� 


  <?=$title?> : �ű�, ����, ����϶��� ���� ǥ��

  �Ʒ������� �ش����� �ִ°��� �״�� ���νø� �˴ϴ�.
  <?=$name?> : ���� �̸��Դϴ�.
  <?=$subject?> : ���� �����Դϴ�.
  <?=$email?> : ���� �����Դϴ�.
  <?=$homepage?> : Ȩ�������Դϴ�.
  <?=$memo?> : ���� �����Դϴ�.
  <?=$sitelink1?> : ����Ʈ ��ũ 1���Դϴ�
  <?=$sitelink2?> : ����Ʈ ��ũ 2���Դϴ�
  <?=$file_name1?> : ���ε�� ���� 1���Դϴ�.
  <?=$file_name2?> : ���ε�� ���� 2���Դϴ�.
  <?=$category_kind?> : ī�װ� ����Ʈ �ڽ�
  <?=$use_html?> : HTML üũ ǥ��;; �� htmlüũ������(����) checked �� �� ����;;
  <?=$reply_mail?> : �亯���� üũ ǥ��;;
  <?=$secret?> : ��б� ǥ��
  <?=$upload_limit?> : ���ε� �뷮
  */
  include "$dir/value.php3";

  if($mode=="reply") $title="<font class=view_tile1>Post a </font> <font class=view_title2>Reply</font>";
  elseif($mode=="modify") $title="<font class=view_tile1>Modify </font> <font class=view_title2>Article</font>";
  else $title="<font class=view_tile1>New </font> <font class=view_title2>Article</font>";

  $a_preview = str_replace(">","><font class=view_title1>",$a_preview)."&nbsp;&nbsp;";
  $a_imagebox = str_replace(">","><font class=view_title1>",$a_imagebox)."&nbsp;&nbsp;";
  $a_codebox = str_replace(">","><font class=view_title1>",$a_codebox)."&nbsp;&nbsp;";
?>
<table width=<?=$width?> border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>>
<tr>
  <td color=<?=$list_header_dark0?>><img src=images/t.gif height=3></td>
</tr>
</table>
<table border=0 cellspacing=1 cellpadding=0 width=<?=$width?> style=table-layout:fixed>
<form method=post name=write id=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>"><input type=hidden name=wantispam value="<?=$wnum1num2?>">
<tr>
  <td colspan=2 height=30>&nbsp;&nbsp;<?=$title?></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$list_divider?>><img src=images/t.gif height=1></td></tr>
</table>
<table border=0 width=<?=$width?> cellspacing=1 cellpadding=0 bgcolor=<?=$view_left_header_color?>>
<col width=80></col><col width=></col>
<?=$hide_start?>

<tr>
  <td colspan=2>
    <table border=0 cellspacing=0 cellpadding=0 width=100%>
    <col width=80></col><col width=></col><col width=80></col><col width=></col>
    <tr>
      <td width=80 align=right class=listnum><b>Name&nbsp;</b></td>
      <td><img src=images/t.gif width=1 align=absmiddle><input type=text name=name value="<? $name=stripslashes($name); echo $name; ?>" <?=size(20)?> maxlength=20 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>;border-style:solid;"></td>
      <td width=80 align=right class=listnum><b>Password&nbsp;</b></td>
      <td><input type=password name=password <?=size(20)?> maxlength=20 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"></td>
    </tr>
    </table>
  </td>
</tr>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td width=80 align=right class=listnum><b>E-mail&nbsp;</b></td>
  <td> <input type=text name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=listnum><b>Homepage&nbsp;</b></td>
  <td> <input type=text name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_end?>

<tr>
  <td align=right class=listnum width=80><img src=images/t.gif border=0 width=80 height=1><br><b>Special&nbsp;</b></td>
  <td> 
    <table border=0 cellpadding=0 cellspacing=0>
    <tr>
      <td><?=$category_kind?></td>
      <td><?=$hide_notice_start?> <input type=checkbox name=notice <?=$notice?> value=1></td><td class=listnum>��������<?=$hide_notice_end?></td>
      <td><?=$hide_html_start?> <input type=checkbox name=use_html <?=$use_html?> value=1></td><td class=listnum>HTML<?=$hide_html_end?></td>
      <td><input type=checkbox name=reply_mail <?=$reply_mail?> value=1></td><td class=listnum>�亯���� �ޱ�</td>  
      <td><?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1></td><td class=listnum>��б�<?=$hide_secret_end?></td>
    </tr>
    </table>
  </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=listnum><b>Subject&nbsp;</b></td>
  <td> <input type=text name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=listnum onclick=document.getElementById('memo').rows=document.getElementById('memo').rows+4 style=cursor:pointer><b>Contents&nbsp;</b></td>
  <td valign=top>
    <textarea id=memo name=memo <?=size2(70)?> rows=20 class=textarea style=width:99% onkeydown='return doTab(event);'><?=$memo?></textarea>
  </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink1_start?>

<tr>
  <td align=right class=listnum><b>Link &nbsp;</b></td>
  <td> <input type=text name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"></td>
</tr>
<?=$hide_sitelink1_end?>

<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink2_start?>

<tr>
  <td align=right class=listnum><b>Link &nbsp;</b></td>
  <td> <input type=text name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"> </td>
</tr>
<?=$hide_sitelink2_end?>

<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_pds_start?>

<tr>
  <td>&nbsp;</td>
  <td class=listnum><b>Maximum File size : <?=$upload_limit?></b></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=listnum><b>File #1&nbsp;</b></td>
  <td> <input type=file name=file1 <?=size(50)?> maxlength=255 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"> <?=$file_name1?></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=listnum><b>File #2&nbsp;</b></td>
  <td> <input type=file name=file2 <?=size(50)?> maxlength=255 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"> <?=$file_name2?></td>
</tr>
<?=$hide_pds_end?>

<tr height=1><td colspan=2 bgcolor=<?=$list_footer_bg_color?>><img src=images/t.gif height=1></td></tr>
</table>
<img src=images/t.gif border=0 height=10><br>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
	<td width=200 height=40>
		<?=$a_preview?>�̸�����</a>
		<?=$a_imagebox?>�׸�â��</a>
		<?=$a_codebox?>�ڵ����</a>
	</td>
	<td align=right>
		<input type=image border=0 src="<?=$dir?>/i_write.gif" accesskey="s" onfocus=blur()> &nbsp;&nbsp;
		<img src=<?=$dir?>/btn_back.gif border=0 onclick=history.back() style=cursor:pointer>
	</td>
</tr>
</form>
</table>
<br>