
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
  write.php 는 글쓰기 폼입니다.
  아래 변수를 사용합니다.

  회원일때 나타나지 않는 부분을 처리하는 부분입니다. 감싸주면 회원일때는 나타나지 않습니다.
  <?=$hide_start?> : 회원일때 글쓰기등을 나타나지 않게 하는 부분입니다;; 회원일때는 자동 주석(<!--)이 들어갑니다.  
  <?=$hide_end?>  : 회원일때 보이지 않게 합니다. <?=$hide_start?>로 시작하고 <?=$hide_end?> 로 감싸주면 됩니다.

  <?=$hide_sitelink1_start?>, <?=$hide_sitelink1_end?> : 싸이트링크 1번을 사용하는지 않하는지 표시
  <?=$hide_sitelink2_start?>, <?=$hide_sitelink2_end?> : 싸이트링크 2번을 사용하는지 않하는지 표시
  <?=$hide_pds_start?>, <?=$hide_pds_end?> : 자료실을 사용하는지 않하는지 표시
  <?=$hide_html_start?>, <?=$hide_html_end?> : HTML 체크박스 표시 


  <?=$title?> : 신규, 수정, 답글일때의 제목 표시

  아래변수는 해당폼에 있는것을 그대로 놔두시면 됩니다.
  <?=$name?> : 원본 이름입니다.
  <?=$subject?> : 원본 제목입니다.
  <?=$email?> : 원본 메일입니다.
  <?=$homepage?> : 홈페이지입니다.
  <?=$memo?> : 원본 내용입니다.
  <?=$sitelink1?> : 싸이트 링크 1번입니다
  <?=$sitelink2?> : 싸이트 링크 2번입니다
  <?=$file_name1?> : 업로드된 파일 1번입니다.
  <?=$file_name2?> : 업로드된 파일 2번입니다.
  <?=$category_kind?> : 카테고리 셀렉트 박스
  <?=$use_html?> : HTML 체크 표시;; 즉 html체크였을때(수정) checked 가 들어가 있음;;
  <?=$reply_mail?> : 답변메일 체크 표시;;
  <?=$secret?> : 비밀글 표시
  <?=$upload_limit?> : 업로드 용량
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
<form method=post id=write name=write action=write_ok.php onsubmit="return check_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>"><input type=hidden name=wantispam value="<?=$wnum1num2?>">
<tr>
  <td align=left colspan=2 height=30>&nbsp;&nbsp;<?=$title?></td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$list_divider?>><img src=images/t.gif height=1></td></tr>
</table>
<table border=0 width=<?=$width?> cellspacing=1 cellpadding=0 bgcolor=<?=$view_left_header_color?> style=table-layout:fixed>
<col width=80></col><col width=></col>
<?=$hide_start?>

<tr>
  <td colspan=2>
    <table border=0 cellspacing=0 cellpadding=0 width=100%>
    <col width=80></col><col width=></col><col width=80></col><col width=></col>
    <tr>
      <td width=80 align=right class=listnum><b>Name&nbsp;</b></td>
      <td align=left><img src=images/t.gif width=1 align=absmiddle><input type=text id=name name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>;border-style:solid;" onkeyup="ajaxLoad2()"></td>
      <td width=80 align=right class=listnum><b>Password&nbsp;</b></td>
      <td align=left><input type=password id=password name=password <?=size(20)?> maxlength=20 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;" onkeyup="ajaxLoad2()"> 비번을 재입력하면 임시저장이 복원됨</td>
    </tr>
    </table>
  </td>
</tr>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td width=80 align=right class=listnum><b>E-mail&nbsp;</b></td>
  <td align=left> <input type=text id=email name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=listnum><b>Homepage&nbsp;</b></td>
  <td align=left> <input type=text id=homepage name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_end?>

<tr>
  <td align=right class=listnum width=80><img src=images/t.gif border=0 width=80 height=1><br><b>Special&nbsp;</b></td>
  <td align=left> 
    <table border=0 cellpadding=0 cellspacing=0>
    <tr>
      <td><?=$category_kind?></td>
      <td><?=$hide_notice_start?> <input type=checkbox id=notice name=notice <?=$notice?> value=1></td><td class=listnum>공지사항<?=$hide_notice_end?></td>
      <td><?=$hide_html_start?> <input type=checkbox id=use_html name=use_html <?=$use_html?> value=1></td><td class=listnum>HTML<?=$hide_html_end?></td>
      <td><input type=checkbox id=reply_mail name=reply_mail <?=$reply_mail?> value=1></td><td class=listnum>답변메일 받기</td>  
      <td><?=$hide_secret_start?> <input type=checkbox id=is_secret name=is_secret <?=$secret?> value=1></td><td class=listnum>비밀글<?=$hide_secret_end?> <font id="state"></font></td>
    </tr>
    </table>
  </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=listnum><b>Subject&nbsp;</b></td>
  <td align=left> <input type=text id=subject name=subject value="<?=$subject?>" <?=size(60)?> maxlength=200 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;" onkeyup="addStroke()"> </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=listnum onclick=document.getElementById('memo').rows=document.getElementById('memo').rows+4 style=cursor:pointer><b>Contents&nbsp;</b></td>
  <td align=left valign=top>
    <textarea id=memo name=memo <?=size2(70)?> rows=20 class=textarea style=width:99% onkeydown='return doTab(event);' onkeyup="addStroke()"><?=$memo?></textarea>
  </td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink1_start?>

<tr>
  <td align=right class=listnum><b>Link &nbsp;</b></td>
  <td align=left> <input type=text id=sitelink1 name=sitelink1 value="<?=$sitelink1?>" <?=size(60)?> maxlength=200 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"></td>
</tr>
<?=$hide_sitelink1_end?>

<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink2_start?>

<tr>
  <td align=right class=listnum><b>Link &nbsp;</b></td>
  <td align=left> <input type=text id=sitelink2 name=sitelink2 value="<?=$sitelink2?>" <?=size(60)?> maxlength=200 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"> </td>
</tr>
<?=$hide_sitelink2_end?>

<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_pds_start?>

<tr>
  <td>&nbsp;</td>
  <td align=left class=listnum><b>Maximum File size : <?=$upload_limit?></b></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=listnum><b>File #1&nbsp;</b></td>
  <td align=left> <input type=file name=file1 <?=size(50)?> maxlength=255 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"> <?=$file_name1?></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr>
  <td align=right class=listnum><b>File #2&nbsp;</b></td>
  <td align=left> <input type=file name=file2 <?=size(50)?> maxlength=255 class=input style="border-width:1px; border-color:<?=$list_header_dark0?>; border-style:solid;"> <?=$file_name2?></td>
</tr>
<?=$hide_pds_end?>

<tr height=1><td colspan=2 bgcolor=<?=$list_footer_bg_color?>><img src=images/t.gif height=1></td></tr>
</table>
<img src=images/t.gif border=0 height=10><br>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
	<td width=200 height=40 align=left>
		<?=$a_preview?>미리보기</a>
		<?=$a_imagebox?>그림창고</a>
		<?=$a_codebox?>코드삽입</a>
	</td>
	<td align=right>
		<img src=<?=$dir?>/btn_save.gif border=0 accesskey="a" onclick=autoSave() style=cursor:pointer>
		<input type=image border=0 src="<?=$dir?>/i_write.gif" accesskey="s" onfocus=blur()> &nbsp;&nbsp;
		<img src=<?=$dir?>/btn_back.gif border=0 onclick=history.back() style=cursor:pointer>
	</td>
</tr>
</form>
</table>
<br>
