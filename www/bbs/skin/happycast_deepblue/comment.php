<?
 /* ������ ��� ���� ǥ��

  -- ������ ��� ����
  <?=$hide_comment_start?> <?=$hide_comment_end?> : ������ ��� ���� �����ֱ�/ �����
  <?=$hide_c_password_start?> <?=$hide_c_password_end?> : ������ ��۽� ��й�ȣ �Է� �����ֱ�/ �����;;

  <?=$c_name?> : �ڸ�Ʈ�� �̸� �Է��ϴ� ��;;

  ** view.php ���� �Ʒ��ʿ� ������ ����� �����ϴ� <table>�±� ���ۺκ��� �ֽ��ϴ�.
     �׸��� ������ ����� ������ view_comment_view.php ���Ͽ��� ����� �մϴ�.

 */
?>
<?
$a_preview = str_replace(">","><font class=view_title1>",$a_preview)."&nbsp;&nbsp;";
$a_imagebox = str_replace(">","><font class=view_title1>",$a_imagebox)."&nbsp;&nbsp;";
$a_codebox = str_replace(">","><font class=view_title1>",$a_codebox)."&nbsp;&nbsp;";
?>

<!-- ������ �亯�� ���� -->
<form method=post id=write name=write action=comment_ok.php onsubmit="return check_submit();" enctype=multipart/form-data>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=sm value="<?=$sm?>">
<input type=hidden name=mode value="<?=$mode?>">
<input type=hidden name=c_no value=<?=$c_no?>>
<input type=hidden name=c_org value=<?=$c_org?>>
<input type=hidden name=c_depth value=<?=$c_depth?>>
<input type=hidden name=antispam value="<?=$num1num2?>">
<div align=center>
<table width=<?=$width?> border=0 cellspacing=1 cellpadding=0 bgcolor=<?=$list_footer_bg_color?>>
<tr>
  <td bgcolor=<?=$list_header_back?>>
    <table border=0 cellspacing=0 cellpadding=4 width=100% height=100>
    <col width=80></col><col width=></col><col width=80></col>
    <tr>
      <td align=center style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><img src=images/t.gif border=0 width=80 height=1><br><b>Option</b></td>
      <td align=left class=listnum>
        <?=$hide_html_start?> <input type=checkbox id=use_html2 name=use_html2<?=$use_html2?>>HTML���<?=$hide_html_end?><?=$hide_secret_start?> <input type=checkbox name=is_secret id=is_secret <?=$secret?> value=1>��б�<?=$hide_secret_end?> <font id="state"></font>
      </td>
      <td width=80>&nbsp;</td>
    </tr>
    <tr align=center>
      <td height=20 style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><img src=images/t.gif border=0 width=80 height=1><br><b>Name</b></td>
      <td style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;cursor:pointer; onclick="document.getElementById('memo').rows=document.getElementById('memo').rows+4"><b>Memo ��</b></td>
      <td>&nbsp;</td>
    </tr>
    <tr align=center valign=top>
      <td width=80>
        <? $c_name=stripslashes($c_name); echo $c_name; ?>

        <?=$hide_c_password_start?>

        <br><img src=images/t.gif border=0 height=10><br>
        <font style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><b>Password</b></font><br>
        <img src=images/t.gif border=0 height=5><br>
        <input type=password id=password name=password <?=size(8)?> maxlength=20 class=input onkeyup="ajaxLoad2()"><br>����� ���Է��ϸ� �ӽ������� ������
        <?=$hide_c_password_end?>

      </td>
      <td>
        <table border=0 cellspacing=2 cellpadding=0 width=100% height=100 style=table-layout:fixed>
        <tr><td width=100% valign=top>
          <textarea id=memo name=memo cols=20 rows=8 class=textarea style=width:100% onkeydown='return doTab(event);' onkeyup="addStroke()"><?=$memo?></textarea>
        </td></tr>
        </table>
      </td>
      <td valign=middle><input type=button class=comment_submit value='�ӽ�����' onclick=autoSave() accesskey="a" style="height:50%"><br><input type=submit class=comment_submit value='�ۼ��Ϸ�' accesskey="s" style="height:50%"></td>
    </tr>
    </table>
    <table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
    <col width=6%></col><col width=44%></col><col width=6%></col><col width=44%>
    <tr valign=top>
    <?=$hide_pds_start?>

      <td width=52 align=right><font class=listnum>Upload #1</font></td>
      <td align=left class=listnum><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name1?></td>
      <td width=52 align=right><font class=listnum>Upload #2</font></td>
      <td align=left class=listnum><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name2?></td>
    <?=$hide_pds_end?>

    </tr>
    </table>
  </td>
</tr>
</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
  <td width=200 height=40>
    <?=$a_preview?>�̸�����</a><?=$a_imagebox?>�׸�â��</a><?=$a_codebox?>�ڵ����</a>
  </td>
</tr>
</table>
</form>
</div>
