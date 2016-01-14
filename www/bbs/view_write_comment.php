<?
$pass = $_POST["pwd"];
$pass = stripslashes($pass);

if($pass == "gg" || $member[no] || $data[is_secret] != 0) {

	//랜덤한 두 숫자를 발생(1-1000) 후 변수에 대입
	$num1 = mt_rand(1,1000);
	$num2 = mt_rand(1,1000);
	$num1num2 = $num1*10000 + $num2;
	//코멘트 보안을 위해 세션변수를 설정
	$ZBRD_SS_VRS = $num1num2;
	session_register("ZBRD_SS_VRS");
	//미리보기, 그림창고, 코드삽입 버튼 보이게 하기
	$box_view=true;

	include $dir."/view_write_comment.php";

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
<img src=images/t.gif border=0 height=4><br>
<form name="myform" method="post" action=<?=$PHP_SELF?> enctype=multipart/form-data>
<input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>">
<table width=320 height=100 border=0 cellpadding=1 cellspacing=0 bgcolor=#FFFFFF align=center>
<tr>
	<td>
		<table width=100% height=100% border=1 style="border-collapse:collapse" bordercolor=gray cellpadding=2 cellspacing=0 align=center>
		<tr class=list0><td align=center><b>덧글 달기!!<br>스팸방지 비번(<font color=red>gg</font>)을 입력: </span></b><br><input type=password name=pwd size=20 class=input></td>
		</tr>
		<tr class=list0><td align=center><input type=button value=" 확 인 " onClick="javascript:sendit()"></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</form>
<? } ?>