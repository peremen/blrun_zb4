<!DOCTYPE html>  
<html>  
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width">
<title>XML - 네티즌 세상을 위하여...</title>
<style type="text/css">
	p {margin-top:0px; margin-bottom:0px;}
	.title {background-color:#9ECFCF; ;margin:10px; padding:5px;}
	.memo {background-color:white; margin:10px; padding:5px; word-wrap:break-word; word-break:break-word; word-break:keep-all;}
	.memo2 {background-color:white; margin:10px; padding:10px; word-wrap:break-word; word-break:break-word; word-break:keep-all;}
	.item-name {font-weight:bold;}
	.item-foot {background-color:white; color:#993300; font-size:10pt;}
</style>
</head>

<body>
<table border=0 cellspacing=0 cellpadding=0 width=100% height=1 style="table-layout:fixed;"><col width=100%></col><tr><td><img src=/t.gif border=0 width=98% height=1 name=zb_get_table_width><br><img src=/t.gif border=0 name=zb_target_resize width=1 height=1></td></tr></table>
<?
// DomXML Function include
if(PHP_VERSION>='5')
	require_once('domxml-php4-to-php5.php');

// Get XML Data
$url = "http://www.blrun.net/rss/zero_rss.php";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$xml = curl_exec($curl);
$info = curl_getinfo($curl);
curl_close($curl);

// Parse XML Data
if (!$doc = domxml_open_mem($xml)) {
	echo "Could not load xml...";
} else {
	$items = $doc->get_elements_by_tagname("item");
	foreach ($items as $item) {
?>
<table border=0 cellspacing=0 cellpadding=0 width=100% align=center>
	<tr><td bgcolor=white>
		<table border=0 cellspacing=2 cellpadding=4 width=100% align=center bgcolor=gray style=table-layout:fixed>
		<?
		$children = $item->child_nodes();
		foreach ($children as $child) { 
			$name = $child->node_name();
			if ($name != "#text") {
				if($name=="title") {
					$title1="제목";
					$new1 = $child->get_content();  
				}elseif($name=="link") {
					$title2="URL";
					$new2 = $child->get_content();
				}elseif($name=="description") {
					$title3="내용";
					$new3 = $child->get_content();
				}elseif($name=="author") {
					$title4="글쓴이";
					$new4 = $child->get_content();
				}elseif($name=="pubDate") {
					$title5="날짜";
					$new5 = $child->get_content();
				}elseif($name=="category") {
					$title6="분류";
					$new6 = $child->get_content();
				}
				//$new = htmlspecialchars($new, ENT_QUOTES, "UTF-8");
			}
		}
		echo "<tr><td width='70' align='center' class='title'><b>{$title1}</b></td><td class='memo'> {$new1}</td></tr>";
		echo "<tr><td align='center' class='title'><b>{$title2}</b></td><td class='memo'><a href={$new2} target=_blank>{$new2}</a></td></tr>";
		echo "<tr><td colspan=2 class='memo2'>{$new3}</td></tr>";
		echo "<tr><td colspan=2 class='item-foot'><b>{$new6} <font color='gray'>|</font> {$new5} <font color='gray'>|</font> {$new4}</b></td></tr><br />";
?>
		</table>
	</td></tr>
</table>
<?
	}
}
?>
<!-- 이미지 리사이즈를 위해서 처리하는 부분 -->
<script language="javascript">
	function zb_img_check(){
		var zb_main_table_width = document.zb_get_table_width.width - 50;
		var zb_target_resize_num = document.zb_target_resize.length;
		for(i=0;i<zb_target_resize_num;i++){ 
			if(document.zb_target_resize[i].width > zb_main_table_width) {
				document.zb_target_resize[i].height = document.zb_target_resize[i].height * zb_main_table_width / document.zb_target_resize[i].width;
				document.zb_target_resize[i].width = zb_main_table_width;
			}
		}
	}
	window.onload = zb_img_check;
</script>
</body>
</html>