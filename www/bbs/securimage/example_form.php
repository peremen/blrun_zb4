<?php

/**
 * 프로젝트:    Securimage: Form CAPTCHA 이미지를 만들고 관리하기위한 PHP 클래스
 * 파일:        example_form.php
 * URL:         www.phpcaptcha.org
*/

session_start();  // 코드가 저장 될 세션을 시작합니다.
?>
<html>
<head>
  <title>Securimage 테스트 양식</title>
</head>

<body>
<?php
if (empty($_POST)) {
?>
<form method="POST">
이름:<br />
<input type="text" name="username" /><br />
패스워드:<br />
<input type="text" name="password" /><br /><br />

<div style="width: 430px; float: left; height: 90px">
  <img id="siimage" align="left" style="padding-right: 5px; border: 0" src="securimage_show.php?sid=<?php echo md5(time()) ?>" />
  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
  <param name="allowScriptAccess" value="sameDomain" />
  <param name="allowFullScreen" value="false" />
  <param name="movie" value="securimage_play.swf?audio=securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
  <param name="quality" value="high" />
  <param name="bgcolor" value="#ffffff" />
  <embed src="securimage_play.swf?audio=securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
  </object>
  <br />
  <!-- ie 캐싱을 방지하기 위해 스크립트의 쿼리 문자열에 세션 ID를 전달합니다. -->
  <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage_show.php?sid=' + Math.random(); return false"><img src="images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a>
</div>
<div style="clear: both"></div>

Code:<br />
<!-- 참고: "name" 속성은 "code" 이므로 $img->check($_POST['code'])는 제출된 Form 필드를 검사합니다 -->
<input type="text" name="code" size="12" /><br /><br />
<input type="submit" value="Submit Form" />
</form>

<?php
}
else {
	//양식이 넘어왔을 때
	include("securimage.php");
	$img = new Securimage();
	$valid = $img->check($_POST['code']);

	if($valid == true) {
		echo "<center>감사합니다. 올바른 코드를 입력했습니다.<br />되돌아가기 위해 <a href=\"{$_SERVER['PHP_SELF']}\">여기를</a> 클릭하세요.</center>";
	}
	else {
		echo "<center>죄송합니다. 입력하신 코드가 유효하지 않습니다. 다시 시도하기 위해 <a href=\"javascript:history.go(-1)\">되돌아가기</a></center>";
	}
}
?>

</body>
</html>
