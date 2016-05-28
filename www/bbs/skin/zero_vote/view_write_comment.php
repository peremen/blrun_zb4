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
<?
$pass = $_POST["pwd"];
$pass = stripslashes($pass);

if($pass == "gg" || $member[no] || $data[is_secret] != 0) {

	//랜덤한 두 숫자를 발생(1-8) 후 변수에 대입
	$num1 = rand(1,8);
	$num2 = rand(1,8);
	$num1num2 = $num1*10 + $num2;
	//코멘트 보안을 위해 세션변수를 설정
	$ZBRD_SS_VRS = $num1num2;
	session_register("ZBRD_SS_VRS");
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
		<font color=444444 >의견 : </b></font><input type=text id=memo name=memo <?=size(40)?> maxlength=3000 class=input>
		<?=$hide_c_password_start?> &nbsp;
		<font color=444444 >비밀번호 : </b></font><input type=password id=password name=password <?=size(10)?> maxlength=20 class=input>
		<?=$hide_c_password_end?><?=$hide_secret_start?> <input type=checkbox name=is_secret <?=$secret?> value=1> 비밀글 <?=$hide_secret_end?><input type=submit value="입력" class=submit>
	</td>
	</tr>
	</table>
</td>
</tr>
</form>
</table>
<?
} else {
?>

<script language="javascript">
<!--
function sendit() {
	//패스워드
	if(document.myform.pwd.value=="") {
		alert("패스워드를 입력해 주십시요");
		return false;
	}
	document.myform.submit();
}
-->
</script>
<form name="myform" method="post" action=<?=$PHP_SELF?> enctype=multipart/form-data>
<input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>">
<table width=<?=$width?> height="70" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" align="center">
<tr>
	<td>
		<table width="320" height="100%" border="1" style="border-collapse:collapse;" bordercolor="black" bgcolor="#BEEBDD" cellpadding="1" align="center">
		<tr><td align="center"><b><span style="font-size:11pt">덧글 달기!!<br>스팸방지 비번(<font color="red">gg</font>)을 입력: </span></b><input type="password" name="pwd" size="20"></td>
		</tr>
		<tr><td align="center"><input type="button" value="확인" onClick="javascript:sendit();">
		<tr>
		</table>
	</td>
</tr>
</table>
</form>
<? } ?>