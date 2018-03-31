<?
// mb_substr()과 mb_strlen(), mb_strpos()과 mb_strrpos() 함수 인코딩 지정
mb_internal_encoding("UTF-8");

// 자동으로 www 붙여준다.
//if(!preg_match("#www#i",$HTTP_HOST)) header("location: http://www.".$HTTP_HOST.$REQUEST_URI);

include "./bbs/include/get_url.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html lang="ko">
<head>
<title>네티즌 세상을 위하여...</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="네티즌칼럼에 오신 것을 환영합니다...">
<meta name="keywords" content="네티즌,칼럼,칼럼니스트,블로그,이윤찬,blrun,희망의빛™,네티즌_희망,특수문자불가,개인칼럼,네티즌칼럼,칼럼게시판,칼럼자료실">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
<link rel="image_src" href="./blrun2_fb.jpg">
<link rel="alternate" type="application/rss+xml" title="네티즌 세상을 위하여..." href="<?=str_replace("www.","",mb_substr(zbUrl(),0,mb_strpos(zbUrl(),"/bbs/")))."/rss/"?>">
<script type="text/javascript">
var uAgent = navigator.userAgent;
if(uAgent.match(/iPhone|iPod|IEMobile|Mobile|lgtelecom|PPC/i))
{
// 모바일 주소 표시줄 숨기기
  window.addEventListener('load', function(){ setTimeout(scrollTo, 0, 0, 1); }, false);
  window.location.href="/m/"; // 저중 하나라도 조건이 만족하면 /m/index.html 로 이동한다.
}
</script>
</head>

<frameset rows="75,*" cols="*">
  <frame src="fr_top.htm" frameborder="0" scrolling="no" noresize="noresize" name="top">
  <frameset rows="*" cols="20%,*,20%">
    <frame src="fr_left.htm" name="left" frameborder="0">
    <frame src="main.php" frameborder="0" scrolling="yes" noresize="noresize" name="frmain">
    <frame src="fr_right.htm" frameborder="0" scrolling="yes" noresize="noresize" name="right">
  </frameset>
</frameset>
<body>
</body>
</html>
