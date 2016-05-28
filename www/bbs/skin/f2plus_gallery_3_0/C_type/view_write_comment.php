<? 
$pass = $_POST["pwd"];
$pass = stripslashes($pass);

if($pass == "gg" || $member[no] || $data[is_secret] != 0) {

	//랜덤한 두 숫자를 발생(1-8) 후 세션변수에 대입
	$num1 = rand(1,8);
	$num2 = rand(1,8);
	$num1num2 = $num1*10 + $num2;
	session_register("num1num2");
	//코멘트 보안을 위해 세션변수를 설정
	$ZBRD_SS_VRS = $num1num2;
	session_register("ZBRD_SS_VRS");
	//미리보기, 그림창고, 코드삽입 버튼 보이게 하기
	$box_view=true;

	include $dir."/swe/ed_seting_head_comment.php";
	?>
	<img src=<?=$dir?>/images/t.gif border=0 height=4><br>
	<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> align=center>
	<form method=post id=write name=write action=comment_ok.php onsubmit="return check_comment_submit();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="write"><input type=hidden name=antispam value="<?=$num1num2?>">
	<col width=10></col><col width=></col><col width=10></col>
	<tr valign=top>
		<td height=9 background=<?=$dir?>/images/cc_head_bg1.gif></td>
		<td background=<?=$dir?>/images/cc_head_bg2.gif></td>
		<td background=<?=$dir?>/images/cc_head_bg3.gif></td>
	</tr>
	<tr>
		<td background=<?=$dir?>/images/cc_middle_bg1.gif></td>
		<td ><? include $dir."/swe/ed_seting_option_comment.php"; ?><? include $dir."/swe/ed_seting_edit.php"; ?></td>
		<td background=<?=$dir?>/images/cc_middle_bg2.gif></td>
	</tr>
	</table>
	<table border=0 width=<?=$width?> cellspacing=0 cellpadding=3 align=center>
	<col width=10></col><col width=></col><col width=200></col><col width=10></col>
	<tr valign=bottom height=9>
		<td background=<?=$dir?>/images/cc_foot_bg1-1.gif></td>
		<td background=<?=$dir?>/images/cc_foot_bg1-2.gif></td>
		<td background=<?=$dir?>/images/cc_foot_bg1-2.gif></td>
		<td background=<?=$dir?>/images/cc_foot_bg1-3.gif></td>
	</tr>
	</table>
	<table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
	<col width=5%></col><col width=45%></col><col width=5%></col><col width=45%>
	<tr valign=top>
	<?=$hide_pds_start?>
	  <td width=52 align=right><font class=list_eng>Upload #1</font></td>
	  <td class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
	  <td width=52 align=right><font class=list_eng>Upload #2</font></td>
	  <td class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%></td>
	<?=$hide_pds_end?>
	</tr>
	</form>
	</table>
	<BR>
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
	<img src=<?=$dir?>/images/t.gif border=0 height=4><br>
	<form name="myform" method="post" action=<?=$PHP_SELF?> enctype=multipart/form-data>
	<input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>">
	<table width=<?=$width?> height="120" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" align="center">
		<tr><td class=line1>
			<table width="320" height="70" border="1" style="border-collapse:collapse;" bordercolor="black" bgcolor="#BEEBDD" cellpadding="1" align="center">
				<tr><td height="45" align="center"><b><span style="font-size:11pt">덧글 달기!!<br>스팸방지 비번(<font color="red">gg</font>)을 입력: </span></b><input type="password" name="pwd" size="20">
				</td></tr>
				<tr><td height="25" align="center"><input type="button" value="확인" onClick="javascript:sendit();">
			</table>
		</td></tr>
	</table>
	</form>
<? } ?>