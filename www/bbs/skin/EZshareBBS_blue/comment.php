<?
$a_preview = str_replace(">","><font class=view_title1>",$a_preview)."&nbsp;&nbsp;";
$a_imagebox = str_replace(">","><font class=view_title1>",$a_imagebox)."&nbsp;&nbsp;";
$a_codebox = str_replace(">","><font class=view_title1>",$a_codebox)."&nbsp;&nbsp;";
?>

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
<table border=0 cellspacing=1 cellpadding=0 width=<?=$width?> class=zv3_viewform>
<tr>
  <td>
    <table border=0 cellspacing=0 cellpadding=4 width=100% height=100>
    <col width=80></col><col width=></col><col width=80></col>
    <tr>
      <td align=center style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><img src=images/t.gif border=0 width=80 height=1><br><b>Option</b></td>
      <td align=left style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;>
        <?=$hide_html_start?> <input type=checkbox id=use_html2 name=use_html2<?=$use_html2?>>HTML사용<?=$hide_html_end?><?=$hide_secret_start?> <input type=checkbox name=is_secret id=is_secret <?=$secret?> value=1>비밀글<?=$hide_secret_end?> <font id="state"></font></td>
      <td width=80>&nbsp;</td>
    </tr>
    <tr align=center>
<!--코멘트 이름, 비번, 내용 시작-->
      <td height=20 style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><img src=images/t.gif border=0 width=80 height=1><br><b>이름</b></td>
      <td style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><b>코멘트</b> &nbsp;&nbsp;&nbsp; <img src=<?=$dir?>/btn_down.gif border=0 valign=absmiddle style=cursor:pointer; onclick="document.getElementById('memo').rows=document.getElementById('memo').rows+4"></td>
      <td>&nbsp;</td>
    </tr>
    <tr align=center valign=top>
      <td width=80>
        <? $c_name=stripslashes($c_name); echo $c_name; ?><?=$hide_c_password_start?><br><img src=images/t.gif border=0 height=10><br><font style=font-family:Verdana;font-size:9pt;letter-spacing:-1px;><b>패스워드</b></font><br><img src=images/t.gif border=0 height=5><br><input type=password id=password name=password <?=size(8)?> maxlength=20 class=zv3_input onkeyup="ajaxLoad2()" title="이름과 비번을 재입력하면 임시저장이 복원됨"><?=$hide_c_password_end?></td>
      <td>
        <table border=0 cellspacing=2 cellpadding=0 width=100% height=100 style=table-layout:fixed>
        <tr>
          <td width=100% valign=top>
            <textarea id=memo name=memo <?=size(40)?> rows=8 class=zv3_textarea style=width:100% onkeydown='return doTab(event);' onkeyup="addStroke()"><?=$memo?></textarea>
          </td>
        </tr>
        </table>
      </td>
      <td valign=middle><input type=button class=zv3_submit value='임시저장' onclick=autoSave() accesskey="a" style="height:50%" title="1주일간 글을 임시보관 합니다"><br><input type=submit <?if($browser){?>class=zv3_submit<?}?> value='작성완료' accesskey="s" style="height:50%"></td>
    </tr>
    </table>
    <table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
    <col width=6%></col><col width=44%></col><col width=6%></col><col width=44%>
    <tr valign=top>
<?=$hide_pds_start?>
      <td width=52 align=right><font class=zv3_comment>Upload #1</font></td>
      <td align=left class=zv3_comment><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name1?></td>
      <td width=52 align=right><font class=zv3_comment>Upload #2</font></td>
      <td align=left class=zv3_comment><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name2?></td>
<?=$hide_pds_end?>
    </tr>
    </table>
  </td>
</tr>
</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
  <td align=left>
    <?=$a_preview?><img src=<?=$dir?>/btn_preview.gif border=0></a>
    <?=$a_imagebox?><img src=<?=$dir?>/btn_imagebox.gif border=0></a>
    <?=$a_codebox?>코드삽입</a>
  </td>
</tr>
</table>
</form>
</div>
