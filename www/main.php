<?
// 자동으로 www 붙여준다.
//if(!preg_match("#www#i",$HTTP_HOST)) header("location: http://www.".$HTTP_HOST.$REQUEST_URI);

include_once "./bbs/include/get_url.php";
$_zb_url = zbUrl();
$main_dir = preg_replace("#main.php#","",realpath(__FILE__));
$_zb_path = $main_dir."bbs/";
include $_zb_path."outlogin.php";
include $_zb_path."latest_gal.php";
include $_zb_path."latest_skin/bes_latest_skin08/recent_bbs_skin08.php";
include $_zb_path."latest_skin/bes_latest_scroll/recent_bbs_scroll.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="ko">
<head>
<title><?=$_zbDefaultSetup[sitename]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width">
<link rel="image_src" href="./blrun2_fb.jpg">
<link rel="alternate" type="application/rss+xml" title="<?=$_zbDefaultSetup[sitename]?>" href="<?=str_replace("www.","",mb_substr(zbUrl(),0,mb_strpos(zbUrl(),"/bbs/")))."/rss/"?>">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td rowspan="2" width="150" valign="top">
		<? print_outlogin("nzeo", 1, 10) ?>
	</td>
	<td align="center" height="50">
		<b><span style="color:black;font-size:13pt; line-height:140%;">네티즌칼럼에 오신것을 환영합니다...</span></b>
	</td>
</tr>
<tr>
	<td>
		<span style="color:navy;font-size:10pt;">우리 국민 모두가 주인인 세상, 우리 네티즌 모두가 참여하는 진정한 참여민주주의를 실현해 나갑시다. 이곳은 이런 모토에 관심있는 분들, 또 거기에 열성적으로 뜻을 같이할 분들을 위한 공간입니다. 본인이 운영하는 블로그나 칼럼이 있으시면 우리모두 서로 공유합시다. 좌우 빈 여백은 그것을 위한 공간입니다. 많은 참여바랍니다.</span>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<table  width="100%" border="0" cellspacing="2" cellpadding="0">
		<tr>
			<td width="50%" valign="top"><? print_bbs("nzeo/black_bbs", "네티즌칼럼", "clmn1", 10, 31); ?></td>
			<td width="50%" valign="top"><? print_bbs("nzeo/red_bbs", "자료게시판", "blrun1", 12, 31); ?></td>
		</tr>
		<tr>
			<td colspan="2" width="100%" valign="top"><? print_survey("nzeo/survey", "네티즌Poll", "poll1", 100) ?></td>
		</tr>
		<tr><td colspan="2" width="100%" valign="top">
		<?
		$mb_id = array("clmn1", "blrun1", "cap1", "basket1");
		$mb_title = array("네티즌", "칼럼자료", "스크랩", "쓰레기통");
		$mb_conf[showidtitle] = 1;
		recent_scroll("bes_latest_scroll", "최근게시물50개", 50,50);
		echo "<div style='width: 100%; height: 117px; position: relative; overflow:hidden;' onMouseover='bMouseOver=0' onMouseout='bMouseOver=1' id='scroll_image'>";
		echo "<script>startscroll();</script>";
		echo "</div>";
		?>
		<? print_comment_total("bes_latest_skin08","최근코멘트","clmn1,blrun1,cap1,basket1,gal1,poll1,past1,blog1,bug1",50,45); ?>
		</td></tr>
		<tr>
			<td colspan="2" width="100%" valign="top"><? latest_gal("f2plus_latest_2", "gal1", "최근 갤러리", 7, 77, 100, "m/d"); ?></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" height="30">
		<p style="line-height:100%; margin-top:0; margin-bottom:0;" align="center">&nbsp;<span style="font-family:굴림; font-size:9pt;">CopyRight&copy;<a href="mailto:blrun39@hanafos.com" style="color:black;text-decoration:none;"><b>Y.C.Lee</b></a> All Rights Reserved. Since 2007.12.13.</span>&nbsp;<a href="<?=str_replace("www.","",mb_substr(zbUrl(),0,mb_strpos(zbUrl(),"/bbs/")))."/rss/"?>" target="_blank"><img src="./rss/rss2.gif" border="0" align="absmiddle" vspace="5"></a></p>
	</td>
</tr>
</table>
</body>
</html>
