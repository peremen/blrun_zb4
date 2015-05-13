<?
$pass = $_POST["pwd"];
if(!$member[no] && $pass != "gg") {
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
<form name="myform" method="post" action="zboard.php">
<input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=mode value=<?=$mode?>>
<table width=320 height=100 border=0 cellpadding=1 cellspacing=0 bgcolor=#FFFFFF align=center>
<tr>
	<td>
		<table width=100% height=100% border=1 style="border-collapse:collapse" bordercolor=gray cellpadding=2 cellspacing=0 align=center>
		<tr class=list0><td align=center><b>글쓰기!!<br>스팸방지 비번(<font color=red>gg</font>)을 입력: </span></b><br><input type=password name=pwd size=20 class=input></td>
		</tr>
		<tr class=list0><td align=center><input type=button value=" 확 인 " onClick="javascript:sendit()"></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</form>
<?
} else {

//스팸방지 보안 세션변수 설정과 Mode변수 로그인 유형별 넘겨받기 셋팅
	if($member[no]) {
		$mode = $HTTP_GET_VARS[mode];
		$WRT_SPM_PWD = "gg";
	} else {
		$mode = $HTTP_POST_VARS[mode];
		$WRT_SPM_PWD = $pass;
	}
	session_register("WRT_SPM_PWD");

//랜덤한 두 숫자를 발생(1-8) 후 변수에 대입
	$wnum1 = rand(1,8);
	$wnum2 = rand(1,8);
	$wnum1num2 = $wnum1*10 + $wnum2;
	//글쓰기 보안을 위해 세션변수를 설정
	$WRT_SS_VRS = $wnum1num2;
	session_register("WRT_SS_VRS");
?>

<table border=0 cellspacing=0 cellpadding=0 class=width>
<tr>
<td width=1>
	<!-- 폼태그 부분;; 수정하지 않는 것이 좋습니다 -->
	<form method=post id=write name=write action=write_ok.php enctype=multipart/form-data>
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
	<input type=hidden name=mode value="<?=$mode?>">
	<input type=hidden name=subject value="Guest<?=$subject?>">
	<input type=hidden name=wantispam value=<?=$wnum1num2?>>
	<!----------------------------------------------->
</td>
<td align=center>
	<table border=0 cellspacing=0 cellpadding=0 width=100%>
	<tr>
		<td colspan=2><?=$title?></td>
	</tr>
	<tr>
		<td height=6 colspan=2></td>
	</tr>
<?=$hide_start?>

	<tr>
		<td width=70 align=right><span class=cu><span class=v7><b>N</b>ame&nbsp;</span></span></td>
		<td align=left><input type=text id=name name=name value="<? $name=stripslashes($name); echo $name; ?>" <?=size(16)?> maxlength=20 class=input2></td>
	</tr>
	<tr>
	<td width=70 align=right><span class=cu><span class=v7><b>P</b>assword&nbsp;</span></span></td>
	<td><input type=password id=password name=password <?=size(16)?> maxlength=20 class=input2></td>
	</tr>
	<tr>
		<td width=70 align=right><span class=cu><span class=v7><b>E</b>-mail&nbsp;</span></span></td>
		<td><input type=text name=email value="<?=$email?>" <?=size(22)?> maxlength=200 class=input2></td>
	</tr>
	<tr>
		<td width=70 align=right><span class=cu><span class=v7><b>H</b>omepage&nbsp;</span></span></td>
		<td><input type=text name=homepage value="<?=$homepage?>" <?=size(22)?> maxlength=200 class=input2></td>
	</tr>
<?=$hide_end?>

	<tr>
		<td colspan=2 class=cu align=center height=25><?=$hide_notice_start?><input type=checkbox name=notice <?=$notice?> value=1>&nbsp;<span class=v7><b>N</b>otice</span><?=$hide_notice_end?>&nbsp;<?=$hide_html_start?><input type=checkbox name=use_html <?=$use_html?> value=1>&nbsp;<span class=v7><b>H</b>tml</span><?=$hide_html_end?>&nbsp;<input type=checkbox name=reply_mail <?=$reply_mail?> value=1>&nbsp;<span class=v7><b>R</b>e.email</span></td>
	</tr>
	<tr>
		<td colspan=2 align=center><textarea name=memo <?=size2(35)?> class=text><?=$memo?></textarea></td>
	</tr>
	<tr>
		<td height=5 colspan=2></td>
	</tr>
	<tr>
		<td align=center valign=bottom colspan=2><input type=submit value="Confirm" class=submit onfocus='this.blur()' style=cursor:hand>&nbsp;&nbsp;<input type=button value="Back" onclick=history.go(-1) class=submit onfocus='this.blur()' style=cursor:hand></td>
	</tr>
	</table>
</td>
</tr>
</form>
</table>
<? } ?>