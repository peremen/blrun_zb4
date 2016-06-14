<?
if(!empty($_POST['code']) || $member[no] || $data[is_secret] != 0) {

	if(!($member[no] || $data[is_secret] != 0)) {

		// 스팸방지코드 체크 관련
		include("securimage/securimage.php");
		$img = new Securimage();
		$valid = $img->check($_POST['code']);

		if($valid == true) {

		} else {
			Error("스팸방지 코드를 잘못 입력하셨습니다.");
		}
	}

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
	if(document.myform.code.value=="") {
		alert("스팸방지 코드를 입력해 주십시요");
		document.myform.code.focus();
		return false;
	}
	document.myform.submit();
}
-->
</script>
<img src=images/t.gif border=0 height=4><br>
<form name="myform" method="post" action="<?=$PHP_SELF?>">
<input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>">
<table width=310 height=85 border=0 cellpadding=1 cellspacing=0 bgcolor=#FFFFFF align=center>
<tr>
	<td align=center>
		<div style="width: 310px; float: left; height: 85px; line-height: 12px">
		<img id="siimage" align="left" valign=absmiddle style="padding-right: 5px; border: 0" src="securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" />
		<p><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="33" height="33" id="SecurImage_as3" align="middle">
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="allowFullScreen" value="false" />
			<param name="movie" value="securimage/securimage_play.swf?audio=securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
			<param name="quality" value="high" />

			<param name="bgcolor" value="#ffffff" />
			<embed src="securimage/securimage_play.swf?audio=securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="33" height="33" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</object>
		<br />
		<!-- pass a session id to the query string of the script to prevent ie caching -->
		<a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="securimage/images/refresh.gif" width="33" height="33" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a></p>
		</div>
		<div style="clear: both"></div>
		<b>익명덧글쓰기 코드입력:</b>
		<!-- NOTE: the "name" attribute is "code" so that $img->check($_POST['code']) will check the submitted form field -->
		<input type="text" name="code" size="12" /><br /><br />
	</td>
</tr>
<tr class=list0>
	<td align=center><input type=button value=" 확 인 " onClick="javascript:sendit()"></td>
</tr>
</table>
</form>
<? } ?>