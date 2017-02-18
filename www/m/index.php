<?
// 자동으로 www 붙여준다. 
if(!preg_match("#www#i",$HTTP_HOST)) header("location: http://www.".$HTTP_HOST.$REQUEST_URI);
include "../bbs/include/get_url.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>네티즌 세상을 위하여...</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="description" content="네티즌칼럼에 오신 것을 환영합니다...">
<meta name="keywords" content="네티즌,칼럼,칼럼니스트,블로그,이윤찬,희망의빛™,네티즌_희망,특수문자불가,개인칼럼,네티즌칼럼,칼럼게시판,칼럼자료실">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="image_src" href="../blrun2_fb.jpg">
<link rel="alternate" type="application/rss+xml" title="네티즌 세상을 위하여..." href="<?=str_replace("www.","",substr(zbUrl(),0,strpos(zbUrl(),"/bbs/")))."/rss/"?>">
<script type="text/javascript">
// 모바일 주소 표시줄 숨기기
//  window.addEventListener('load', function(){ setTimeout(scrollTo, 0, 0, 1); }, false);
</script>
</head>

<frameset rows="75,*" cols="*">
  <frame src="fr_top.htm" frameborder="0" scrolling="no" noresize="noresize" name="top">
  <frame src="main.php" frameborder="0" scrolling="yes" noresize="noresize" name="frmain">
</frameset>
<body>
</body>
</html>
