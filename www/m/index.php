<?
// �ڵ����� www �ٿ��ش�.
//if(!preg_match("#www#i",$HTTP_HOST)) header("location: http://www.".$HTTP_HOST.$REQUEST_URI);
include "../bbs/include/get_url.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>��Ƽ�� ������ ���Ͽ�...</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="description" content="��Ƽ��Į���� ���� ���� ȯ���մϴ�...">
<meta name="keywords" content="��Ƽ��,Į��,Į���Ͻ�Ʈ,���α�,������,����Ǻ���,��Ƽ��_���,Ư�����ںҰ�,����Į��,��Ƽ��Į��,Į���Խ���,Į���ڷ��">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="image_src" href="../blrun2_fb.jpg">
<link rel="alternate" type="application/rss+xml" title="��Ƽ�� ������ ���Ͽ�..." href="<?=str_replace("www.","",substr(zbUrl(),0,strpos(zbUrl(),"/bbs/")))."/rss/"?>">
<script type="text/javascript">
// ����� �ּ� ǥ���� �����
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
