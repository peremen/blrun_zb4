<?
 /* 간단한 답글 쓰기 표시

  -- 간단한 답글 관련
  <?=$hide_comment_start?> <?=$hide_comment_end?> : 간단한 답글 쓰기 보여주기/ 숨기기
  <?=$hide_c_password_start?> <?=$hide_c_password_end?> : 간단한 답글시 비밀번호 입력 보여주기/ 숨기기;;

  <?=$c_name?> : 코멘트시 이름 입력하는 곳;;

  ** view.php 제일 아래쪽에 간답한 답글이 시작하는 <table>태그 시작부분이 있습니다.
	 그리고 간단한 답글이 있으면 view_comment_view.php 파일에서 출력을 합니다.

 */
?>

<!-- 간단한 답변글 쓰기 -->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
<td width=100%>
	<table border=0 width=100% cellspacing=0 cellpadding=0 height=30>
	<tr>
	<td width=0>
		<form method=post id=write name=write action=comment_ok.php onsubmit="return check_submit();">
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
		<input type=hidden name=mode value="write">
		<input type=hidden name=antispam value="<?=$num1num2?>">
	</td>
	<td align=center>
		<font color=444444 >이름 : </b></font><b><?=$c_name?> &nbsp;</b>
		<font color=444444 >의견 : </b></font><input type=text id=memo name=memo <?=size(40)?> maxlength=3000 class=input onkeyup="addStroke()">
		<?=$hide_c_password_start?> &nbsp;
		<font color=444444 >비밀번호 : </b></font><input type=password id=password name=password <?=size(10)?> maxlength=20 class=input onkeyup="ajaxLoad2()"> 비번을 재입력하면 임시저장이 복원됨.
		<?=$hide_c_password_end?><?=$hide_secret_start?> <input type=checkbox id=is_secret name=is_secret <?=$secret?> value=1> 비밀글 <?=$hide_secret_end?> <input type=button value='임시저장' class=submit onclick=autoSave()> <input type=submit value="입력" class=submit> <font id="state"></font>
	</td>
	</tr>
	</table>
</td>
</tr>
</form>
</table>
