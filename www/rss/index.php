<!DOCTYPE html>  
<html>  
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width">
<title>XML - 네티즌 세상을 위하여...</title>
<style type="text/css">
	.title {background-color:#9ECFCF; ;margin:10px; padding:5px;}
	.memo {background-color:white; margin:10px; padding:5px;}
	.memo2 {background-color:white; margin:10px; padding:10px;}
	.item-name {font-weight:bold;}
	.item-foot {background-color:white; color:#993300; font-size:10pt;}
</style>
</head>

<body>
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
		</table><?
	}
}
?>
</body>
</html>