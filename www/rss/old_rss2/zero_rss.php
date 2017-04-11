<?php
if (!empty($_SERVER['SERVER_SOFTWARE']) && strstr($_SERVER['SERVER_SOFTWARE'], 'Apache/2'))
{
header ('Cache-Control: no-cache, pre-check=0, post-check=0, max-age=0');
header ('Pragma: no-cache');
}
else
{
header ('Cache-Control: private, pre-check=0, post-check=0, max-age=0');
header ('Pragma: no-cache');
}
header ('Expires: '.$lastBuildDate.'');
header ('Last-Modified: '.$lastBuildDate.'');
header ('Content-Type: text/xml; charset=utf-8');
$lastBuildDate = date('D, d M Y H:i:s').' +0900';
if (preg_match("/:\/\//i",$_zb_path) || (preg_match("/\.\./i",$_zb_path))) $_zb_path="";
/*************************************
* 만든이:토토루(http://www.rwapm.server.ne.kr)
* 아래 설정을 본인의 홈에 맞게 수정하세요.
* 통합추출은..
* http://홈주소/zero_rss.php
*
* 개별추출은..
* http://홈주소/zero_rss.php?id=게시판아이디
*************************************/
//제로보드 주소 끝에 /을 붙이세요.
//(예제:http://test.com/bbs/)
include_once "../bbs/include/get_url.php";
$_zb_url = zbUrl();

//제로보드 절대경로 끝에 /을 붙이세요.
//(예제:/home/www/bbs/)
$main_dir = preg_replace("#zero_rss.php#","",realpath(__FILE__));
$_zb_path = str_replace("/rss/","",$main_dir)."/bbs/";

//홈 타이틀(예:우리집 등등,,,)
$site_names = "네티즌 세상을 위하여";

//홈주제(예:나만의 블로그세상..등등)
$site_names1 = "네티즌칼럼에 오신 것을 환영합니다!";

// 이건수정하지 않아도됨.
include $_zb_path."_head.php";

//홈 주소(예:http://test.com/)
$home = mb_substr(zbUrl(),0,mb_strpos(zbUrl(),"/bbs/"))."/";

// 추출개수를 적어주세요.
$nos = "100";

// 배너가 있으면 배너이미지주소를 적어주세요,
// 적지 않으면 출력안됩니다.(옵션)
// 예로 http://test.com/banner.gif
$banner_images = mb_substr(zbUrl(),0,mb_strpos(zbUrl(),"/bbs/"))."/rss/banner1.gif";
// 배너의 가로사이즈
$width_w = "300";
// 배너의 세로사이즈
$height_h = "116";

// 저작권 표시를 하시겠다면 카피라이트를 적어주세요.
// 예로 Copyright 2004 - 2005 rwapm
// 적지 않으면 출력안됩니다.(옵션)
$copyright_s = "Copyright 2008 - 2013 blrun";

// 웹마스터(관리자) 이메일 주소
// 예로 test@test.com
// 적지 않으면 출력안됩니다.(옵션)
$webMaster_q = "blrun39@hanafos.com";

// 통합추출 게시판 아이디를 적어주세요.
// 아이디|아이디|아이디 형식으로 추가가능.
$boardzero = "clmn1|blrun1|cap1|basket1|bug1|blog1";

// 금지시킬 게시판 아이디
// 아이디|아이디|아이디 형식으로 추가가능.
$board_close = "/add1|visit1|poll1|gal1|mov1|mov2|sell1|past1/i";

// 아래부터는 수정 않하셔도됩니다.
if(preg_match($board_close,$id)) {
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<rss version=\"2.0\">";
echo "<response>";
echo "<error>1</error>";
echo "<message>잘못된 접근. 해당 게시판은 추출할 수 없습니다.</message>";
echo "</response>";
echo "</rss>";
exit;
}
if($id) {
$id = $id;
$bbss = explode("|", $id);
} else {
$boardss = $boardzero;
$bbss = explode("|", $boardss);}
$li = 0;

for ($i = 0; $i < sizeof($bbss); $i++)
{
$boards = "zetyx_board_".$bbss[$i];
$boards_category = "zetyx_board_category_".$bbss[$i];
$query = "select $boards.no,$boards.name,$boards.subject,$boards.file_name1,$boards.file_name2,$boards.ismember,$boards.memo,$boards.use_html,$boards.total_comment,$boards.category,$boards.reg_date,$boards_category.name as category_name from $boards,$boards_category where $boards.category=$boards_category.no and $boards.is_secret=0 order by $boards.reg_date desc limit $nos";
$result = mysql_query($query);
while ($data_board = mysql_fetch_array($result))
{
$bbs_tmp[] = $bbss[$i];
$subject[] = str_replace("\"","&quot;",$data_board[subject]);
$name[] = htmlspecialchars($data_board[name]);

$category_name[] = htmlspecialchars($data_board[category_name]);
$comment[] = $data_board[total_comment];
$num[] = $data_board[no];
$use_htmls[] = $data_board[use_html];
$date1[] = $data_board[reg_date];
$datetm[] = $data_board[reg_date];
$date2[] = date('D, d M Y H:i:s',$data_board[reg_date]).' +0900';
// html 이미지 리사이즈 시작
$imagePattern = "#<img(.+?)src=([^>]*?)>#i";
$data_board[memo]=preg_replace($imagePattern,"<div align=left><img name=zb_target_resize\\1src=\\2></div>",$data_board[memo]);
// html 이미지 리사이즈 끝
$imageBoxPattern = "/\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i";
$data_board[memo]=preg_replace($imageBoxPattern,"<img src='".$_zb_url."icon/member_image_box/$data_board[ismember]/\\1.\\2' name=zb_target_resize align='\\3' width='\\4' height='\\5' vspace='\\6' hspace='\\7' border='\\8'>",$data_board[memo]);
if($data_board[use_html]<2) $data_board[memo]=str_replace("\n","<br />",$data_board[memo]);
$memo[] = $data_board[memo];
$file_name1[] = $data_board[file_name1];
$file_name2[] = $data_board[file_name2];

$setup0 = mysql_fetch_array(mysql_query("select * from $admin_table where name='$bbss[$i]'"));
$category[] = $setup0[use_category];
$use_alllist[] = $setup0[use_alllist];
$title[] = $setup0[title];
$grant_view[] = $setup0[grant_view];
$grant_list[] = $setup0[grant_list];
$li++;
}
}
?><?="<?xml version=\"1.0\" encoding=\"utf-8\"?>\n" ?>
<rss version="2.0" xmlns:slash="http://purl.org/rss/1.0/modules/slash/">
<channel>
<?if($copyright_s !=''){?><copyright><?=$copyright_s?></copyright><?}?>
<pubDate><?=$lastBuildDate?></pubDate>
<lastBuildDate><?=$lastBuildDate?></lastBuildDate>
<description><?=htmlspecialchars($site_names1)?></description>
<link><?=htmlspecialchars($home)?></link>
<title><?=htmlspecialchars($site_names)?></title>
<?if($banner_images !=''){?><image>
<url><?=$banner_images?></url>
<title><?=htmlspecialchars($site_names)?></title>
<link><?=$home?></link>
<height><?=$height_h?></height>
<width><?=$width_w?></width>
<description><?=htmlspecialchars($site_names)?></description>
</image><?}?>
<?if($webMaster_q !=''){?><managingEditor><?=$webMaster_q?></managingEditor>
<webMaster><?=$webMaster_q?></webMaster><?}?>
<language>ko</language>
<?
$date3 = $date1;
@rsort($date1);
for($j=0;$j<$nos;$j++)
{
$tmp_date = $date1[$j];
for($i=0;$i<count($subject);$i++)
{
if($tmp_date==$date3[$i])
{
if($comment[$i]==0) $comments=""; else $comments=" (".$comment[$i].")";
if($grant_list[$i]<$member[level] && !$is_admin) {
$comments = "";}

if($use_alllist[$i]) $target = "".$_zb_url."zboard.php"; else $target = "".$_zb_url."view.php";

$title[$i] = htmlspecialchars(stripslashes($title[$i]));
if($title[$i]) $title_bbs = "".$title[$i].""; else $title_bbs = "".$bbs_tmp[$i]."";

if($category[$i]) $use_category = "<category>".$title_bbs." > ".$category_name[$i]."</category>"; else $use_category = "";
$memos = str_replace("\n", "<br />", $memo[$i]);
$h_memos = $memo[$i];
$file_name100 = $file_name1[$i];
$file_name200 = $file_name2[$i];
$file1_s = mb_substr(strrchr($file_name1[$i], '.'), 1);
$file2_s = mb_substr(strrchr($file_name2[$i], '.'), 1);
if(preg_match("#(jpg|png|gif|jpeg|bmp)$#i",$file1_s)) $file_name11="<img src=\"".$_zb_url.$file_name100."\" border=\"0\"><br /><br />"; elseif(preg_match("#(zip|exe|rar|alz|hwp|pdf|psd|ppt|txt|xls|fla|swf|ttf|asf|wma|avi|mp3|wmv)$#i",$file1_s)) $file_name11="다운로드1:<a href=\"".$_zb_url.$file_name100."\">".basename($file_name100)."</a><br /><br />"; else $file_name11 = "";
if(preg_match("#(jpg|png|gif|jpeg|bmp)$#i",$file2_s)) $file_name22="<img src=\"".$_zb_url.$file_name200."\" border=\"0\"><br /><br />"; elseif(preg_match("#(zip|exe|rar|alz|hwp|pdf|psd|ppt|txt|xls|fla|swf|ttf|asf|wma|avi|mp3|wmv)$#i",$file2_s)) $file_name22="다운로드2:<a href=\"".$_zb_url.$file_name200."\">".basename($file_name200)."</a><br /><br />"; else $file_name22 = "";

$sf1 = @filesize($file_name1[$i]);
$sf2 = @filesize($file_name2[$i]);
if(preg_match("#(jpg|jpeg)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"image/jpeg\" />";
elseif(preg_match("#(gif)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"image/gif\" />";
elseif(preg_match("#(png)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"image/png\" />";
elseif(preg_match("#(bmp)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"image/bmp\" />";
elseif(preg_match("#(zip|rar|alz)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"application/zip\" />";
elseif(preg_match("#(exe|hwp|psd|fla)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"application/octet-stream\" />";
elseif(preg_match("#(pdf)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"application/pdf\" />";
elseif(preg_match("#(ppt)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"application/vnd.ms-powerpoint\" />";
elseif(preg_match("#(txt)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"text/plain\" />";
elseif(preg_match("#(xls)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"application/vnd.ms-excel\" />";
elseif(preg_match("#(swf)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"application/x-shockwave-flash\" />";
elseif(preg_match("#(asf|wma|wmv)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"video/x-ms-asf\" />";
elseif(preg_match("#(asf|wma|wmv)$#i",$file1_s)) $enclosure ="<enclosure url=\"".$_zb_url.$file_name100."\" length=\"".$sf1."\" type=\"video/x-ms-asf\" />";
else $enclosure ="";

if(preg_match("#(jpg|jpeg)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"image/jpeg\" />";
elseif(preg_match("#(gif)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"image/gif\" />";
elseif(preg_match("#(png)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"image/png\" />";
elseif(preg_match("#(bmp)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"image/bmp\" />";
elseif(preg_match("#(zip|rar|alz)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"application/zip\" />";
elseif(preg_match("#(exe|hwp|psd|fla)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"application/octet-stream\" />";
elseif(preg_match("#(pdf)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"application/pdf\" />";
elseif(preg_match("#(ppt)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"application/vnd.ms-powerpoint\" />";
elseif(preg_match("#(txt)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"text/plain\" />";
elseif(preg_match("#(xls)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"application/vnd.ms-excel\" />";
elseif(preg_match("#(swf)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"application/x-shockwave-flash\" />";
elseif(preg_match("#(asf|wma|wmv)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"video/x-ms-asf\" />";
elseif(preg_match("#(asf|wma|wmv)$#i",$file2_s)) $enclosure2 ="<enclosure url=\"".$_zb_url.$file_name200."\" length=\"".$sf2."\" type=\"video/x-ms-asf\" />";
else $enclosure2 ="";

if($grant_list[$i]<$member[level] && !$is_admin) {
$subject[$i] = "사용권한이 없습니다.로그인 해주세요.";}

if($use_htmls[$i]==0) $memoss = "".$file_name11.$file_name22.$memos.""; else $memoss = "".$file_name11.$file_name22.$h_memos."";
if($grant_view[$i]<$member[level]&&!$is_admin) {
$memoss="내용보기 권한이 없습니다.로그인 해주세요.";}
setlocale (LC_TIME,"ko");
$name_sq = "<br /><br />작성자 : ".$name[$i]."<br />작성일자: ".strftime("%Y년 %m월 %d일 %A %p %I:%M:%S",$datetm[$i])."";
?>
<item>
<title><?=$name[$i]?> - <?=del_html(str_replace("\"","&quot;",$subject[$i]))?><?=$comments?></title>
<link><?=$target?>?id=<?=$bbs_tmp[$i]?>&amp;no=<?=$num[$i]?></link>
<description><?=htmlspecialchars($memoss.$name_sq)?></description>
<author><?=$name[$i]?></author>
<pubDate><?=$date2[$i]?></pubDate>
<slash:comments><?=$comment[$i]?></slash:comments>
<guid><?=$target?>?id=<?=$bbs_tmp[$i]?>&amp;no=<?=$num[$i]?></guid>
<?=$use_category?>
<?=$enclosure?>
<?=$enclosure2?>
</item>
<?
}
}
}
?>
</channel>
</rss>
