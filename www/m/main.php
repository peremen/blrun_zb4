<?
$_zb_url = "http://www.blrun.net/bbs/";
$_zb_path = "/home/hosting_users/blrun/www/bbs/";
include $_zb_path."outlogin.php";
include $_zb_path."latest_gal.php";
include $_zb_path."latest_skin/bes_latest_skin08/recent_bbs_skin08.php";
include $_zb_path."latest_skin/bes_latest_scroll/recent_bbs_scroll.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>��Ƽ�� ������ ���Ͽ�...</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="viewport" content="width=device-width">
<link rel="image_src" href="/blrun2_fb.jpg">
<link rel="alternate" type="application/rss+xml" title="��Ƽ�� ������ ���Ͽ�..." href="http://blrun.net/rss/">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td rowspan="2" width="150" valign="top">
		<? print_outlogin("nzeo", 1, 10); ?>
	</td>
	<td align="center" height="50">
		<b><span style="color:black;font-size:13pt; line-height:140%;">��Ƽ��Į���� ���Ű��� ȯ���մϴ�...</span></b>
	</td>
</tr>
<tr>
	<td>
		<span style="color:navy;font-size:10pt;">�츮 ���� ��ΰ� ������ ����, �츮 ��Ƽ�� ��ΰ� �����ϴ� ������ �����������Ǹ� ������ �����ô�. �̰��� �̷� ���信 �����ִ� �е�, �� �ű⿡ ���������� ���� ������ �е��� ���� �����Դϴ�. ������ ��ϴ� ��α׳� Į���� �����ø� �츮��� ���� �����սô�. [���ã��] ���� �װ��� ���� �����Դϴ�. ���� �����ٶ��ϴ�.</span>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<table  width="100%" border="0" cellspacing="2" cellpadding="0">
		<tr>
			<td width="50%" valign="top"><? print_bbs("nzeo/black_bbs", "��Ƽ��Į��", "clmn1", 10, 31); ?></td>
			<td width="50%" valign="top"><? print_bbs("nzeo/red_bbs", "�ڷ�Խ���", "blrun1", 12, 31); ?></td>
		</tr>
		<tr>
			<td colspan="2" width="100%" valign="top"><? print_survey("nzeo/survey", "��Ƽ��Poll", "poll1", 100) ?></td>
		</tr>
		<tr><td colspan="2" width="100%" valign="top">
		<? 
		$mb_id = array("clmn1", "blrun1", "cap1", "basket1");  
		$mb_title = array("��Ƽ��", "Į���ڷ�", "��ũ��", "��������"); 
		$mb_conf[showidtitle] = 1;
		if($browser==1) //ie �϶��� ����Ʈ���� �� ó��
			recent_scroll("bes_latest_scroll", "�ֱٰԽù�50��", 50,50);
		else
			recent_scroll("bes_latest_scroll", "�ֱٰԽù�50��", 50,20);
		echo "<div style='width: 100%; height: 117px; position: relative; overflow:hidden;' onMouseover='bMouseOver=0' onMouseout='bMouseOver=1' id='scroll_image'>";
		echo "<script>startscroll();</script>";
		echo "</div>";
		?>
		<? print_comment_total("bes_latest_skin08","�ֱ��ڸ�Ʈ","clmn1,blrun1,cap1,basket1",30,45); ?>
		</td></tr>
		<tr>
			<td colspan="2" width="100%" valign="top">
			<?
			if($browser==1) //ie �϶��� ����Ʈ���� �� ó��
				latest_gal("f2plus_latest_2", "gal1", "�ֱ� ������", 7, 110, 150, "m/d");
			else
				latest_gal("f2plus_latest_2", "gal1", "�ֱ� ������", 4, 38, 30, "m/d");
			?>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" height="30">
		<p style="line-height:100%; margin-top:0; margin-bottom:0;" align="center">&nbsp;<span style="font-family:����; font-size:9pt;">CopyRight&copy;<a href="mailto:blrun39@hanafos.com" style="color:black;text-decoration:none;"><b>Y.C.Lee</b></a> All Rights Reserved. Since 2007.12.13.</span>&nbsp;<a href="http://blrun.net/rss/" target="_blank"><img src="/rss/rss2.gif" border="0" align="absmiddle" vspace="5"></a></p>
	</td>
</tr>
</table>
<!-- ����Ʈ2.0 �α׺м��ڵ� ���� -->
<script type="text/javascript">
var JsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
var uname = escape("www.blrun.net");
document.write(unescape("%3Cscript id='log_script' src='" + JsHost + "blrun.weblog.cafe24.com/weblog.js?uid=blrun&uname="+uname+"' type='text/javascript'%3E%3C/script%3E"));
</script>
<!-- ����Ʈ2.0  �α׺м��ڵ� �Ϸ� -->
</body>
</html>
