<?php

/**
 * ������Ʈ:    Securimage: Form CAPTCHA �̹����� ����� �����ϱ����� PHP Ŭ����
 * ����:        example_form.php
 * URL:         www.phpcaptcha.org
*/

session_start();  // �ڵ尡 ���� �� ������ �����մϴ�.
?>
<html>
<head>
  <title>Securimage �׽�Ʈ ���</title>
</head>

<body>
<?php
if (empty($_POST)) {
?>
<form method="POST">
�̸�:<br />
<input type="text" name="username" /><br />
�н�����:<br />
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
  <!-- ie ĳ���� �����ϱ� ���� ��ũ��Ʈ�� ���� ���ڿ��� ���� ID�� �����մϴ�. -->
  <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage_show.php?sid=' + Math.random(); return false"><img src="images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a>
</div>
<div style="clear: both"></div>

Code:<br />
<!-- ����: "name" �Ӽ��� "code" �̹Ƿ� $img->check($_POST['code'])�� ����� Form �ʵ带 �˻��մϴ� -->
<input type="text" name="code" size="12" /><br /><br />
<input type="submit" value="Submit Form" />
</form>

<?php
}
else {
	//����� �Ѿ���� ��
	include("securimage.php");
	$img = new Securimage();
	$valid = $img->check($_POST['code']);

	if($valid == true) {
		echo "<center>�����մϴ�. �ùٸ� �ڵ带 �Է��߽��ϴ�.<br />�ǵ��ư��� ���� <a href=\"{$_SERVER['PHP_SELF']}\">���⸦</a> Ŭ���ϼ���.</center>";
	}
	else {
		echo "<center>�˼��մϴ�. �Է��Ͻ� �ڵ尡 ��ȿ���� �ʽ��ϴ�. �ٽ� �õ��ϱ� ���� <a href=\"javascript:history.go(-1)\">�ǵ��ư���</a></center>";
	}
}
?>

</body>
</html>
