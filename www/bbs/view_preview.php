<?
include "lib.php";

if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)) Error("���������� ���� �ۼ��Ͽ� �ֽñ� �ٶ��ϴ�.","window.close");
if(!preg_match("/write.php/i",$HTTP_REFERER)) Error("���������� ���� ���ñ� �ٶ��ϴ�","window.close");
if(getenv("REQUEST_METHOD") == 'GET' ) Error("���������� ���� ���ñ� �ٶ��ϴ�","window.close");

if($_name1) $memo=$_name1;
if(!$subject) Error("����Ʈ ������ �Է��Ͽ� �ֽʽÿ�","window.close");
if(!$memo) Error("����Ʈ ������ �Է��Ͽ� �ֽʽÿ�","window.close");

$connect=dbconn();

// �Խ��� ���� �о� ����
$setup=get_table_attrib($id);

// �������� ���� �Խ���
if(!$setup[name]) Error("�������� ���� �Խ����Դϴ�.<br><br>�Խ����� ������ ����Ͻʽÿ�","window.close()"); 

// ���� �Խ����� �׷��� ���� �о� ����
$group=group_info($setup[group_no]);

// ȸ�� ����Ÿ �о� ����
$member = member_info();

// �� �Խñ� ���� �о����
if($no&&$mode="modify") $data=mysql_fetch_array(mysql_query("select * from  $t_board"."_$id  where no='$no'"));

// ���� �α��εǾ� �ִ� ����� ��ü, �Ǵ� �׷���������� �˻�
if($member[is_admin]==1||($member[is_admin]==2&&$member[group_no]==$setup[group_no])||check_board_master($member, $setup[no])) $is_admin=1; else $is_admin="";

// &lt,&gt�� ���ý����̶���Ʈ���� ����ϱ� ���� �ӽ� ġȯ
$memo=str_replace("&lt;","my_lt_ek",$memo);
$memo=str_replace("&gt;","my_gt_ek",$memo);

// �������̰ų� HTML��뷹���� ������ �±��� ���������� üũ
if(!$is_admin&&$setup[grant_html]<$member[level]) {

	// ������ HTML ����;;
	if(!$use_html||$setup[use_html]==0) $memo=del_html($memo);

	// HTML�� �κ�����϶�;;
	if($use_html&&$setup[use_html]==1) {
		$memo=str_replace("<","&lt;",$memo);
		$tag=explode(",",$setup[avoid_tag]);
		for($i=0;$i<count($tag);$i++) {
			if(!isblank($tag[$i])) { 
				$memo=eregi_replace("&lt;".$tag[$i]." ","<".$tag[$i]." ",$memo); 
				$memo=eregi_replace("&lt;".$tag[$i].">","<".$tag[$i].">",$memo); 
				$memo=eregi_replace("&lt;/".$tag[$i],"</".$tag[$i],$memo); 
			}
		}
		// XSS ��ŷ �̺�Ʈ �ڵ鷯 ����
		$xss_pattern1 = "!(<[^>]*?)on(load|click|error|abort|activate|afterprint|afterupdate|beforeactivate|beforecopy|beforecut|beforedeactivate|beforeeditfocus|beforepaste|beforeprint|beforeunload|beforeupdate|blur|bounce|cellchange|change|contextmenu|controlselect|copy|cut|dataavailable|datasetchanged|datasetcomplete|dblclick|deactivate|drag|dragend|dragenter|dragleave|dragover|dragstart|drop|errorupdate|filterchange|finish|focus|focusin|focusout|help|keydown|keypress|keyup|layoutcomplete|losecapture|mousedown|mouseenter|mouseleave|mousemove|mouseout|mouseover|mouseup|mousewheel|move|moveend|movestart|paste|propertychange|readystatechange|reset|resize|resizeend|resizestart|rowenter|rowexit|rowsdelete|rowsinserted|scroll|select|selectionchange|selectstart|start|stop|submit|unload)([^>]*?)(>)!i";
		$xss_pattern2 = "!on(load|click|error|abort|activate|afterprint|afterupdate|beforeactivate|beforecopy|beforecut|beforedeactivate|beforeeditfocus|beforepaste|beforeprint|beforeunload|beforeupdate|blur|bounce|cellchange|change|contextmenu|controlselect|copy|cut|dataavailable|datasetchanged|datasetcomplete|dblclick|deactivate|drag|dragend|dragenter|dragleave|dragover|dragstart|drop|errorupdate|filterchange|finish|focus|focusin|focusout|help|keydown|keypress|keyup|layoutcomplete|losecapture|mousedown|mouseenter|mouseleave|mousemove|mouseout|mouseover|mouseup|mousewheel|move|moveend|movestart|paste|propertychange|readystatechange|reset|resize|resizeend|resizestart|rowenter|rowexit|rowsdelete|rowsinserted|scroll|select|selectionchange|selectstart|start|stop|submit|unload)=!i";
		if(preg_match($xss_pattern1,$memo))
			$memo=preg_replace($xss_pattern1,"\\1\\4",$memo);
		if(preg_match($xss_pattern2,$memo))
			$memo=preg_replace($xss_pattern2,"",$memo);
	}
} else {
	if(!$use_html) {
		$memo=del_html($memo);
	}
}

$memo=trim(stripslashes($memo));

if($mode=="modify") {
	if($member[no]!=$data[ismember])
		$ismember=$data[ismember];
	else $ismember=$member[no];
}
else $ismember=$member[no];

// SyntaxHighlighter �ڵ� ���� ����
$code=array("applescript","as3","bash","cf","csharp","cpp","css","delphi","diff","erl","groovy","js","java","jfx","perl","php","plain","ps","py","ruby","scss","scala","sql","vb","html");

// ���ý����̶���Ʈ ó�� ����
$codePattern = "#(\[[a-z]+\_code\:[0-9]+\{[^}]*?\}\]|[\/[a-z]+\_code\])#si";
$temp = preg_split($codePattern,$memo,-1,PREG_SPLIT_DELIM_CAPTURE);

for($i=0;$i<count($temp);$i++) {
	for($j=0;$j<count($code);$j++) {
		$pattern1 = "#\[".$code[$j]."\_code\:([0-9]+)\{([^}]*?)\}\]#i";
		$pattern2 = "#\[\/".$code[$j]."\_code\]#i";
		if(preg_match($pattern1,$temp[$i])) {
			if($code[$j]=="php")
				$temp[$i]=preg_replace($pattern1,"<pre class=\"brush: $code[$j]; html_script: true; first-line: \\1\" title=\"\\2\">",$temp[$i]);
			else
				$temp[$i]=preg_replace($pattern1,"<pre class=\"brush: $code[$j]; first-line: \\1\" title=\"\\2\">",$temp[$i]);

			$temp[$i+1]=str_replace("&amp;","&amp;amp;",$temp[$i+1]);
			$temp[$i+1]=str_replace("&#039;","&amp;#039;",$temp[$i+1]);
			$temp[$i+1]=str_replace("&quot;","&amp;quot;",$temp[$i+1]);
			$temp[$i+1]=str_replace("&nbsp;","&amp;nbsp;",$temp[$i+1]);
			$temp[$i+1]=str_replace("my_lt_ek","&amp;lt;",$temp[$i+1]); // &lt ���!
			$temp[$i+1]=str_replace("my_gt_ek","&amp;gt;",$temp[$i+1]); // &gt ���!
			$temp[$i+1]=str_replace("<","&lt;",$temp[$i+1]);
			//$temp[$i+1]=str_replace("\'","&#039;",$temp[$i+1]);
			//$temp[$i+1]=str_replace("\"","&quot;",$temp[$i+1]);
			$i+=1;
		}
		elseif(preg_match($pattern2,$temp[$i])) {
			$temp[$i]="</pre>";
		}
	}
}

$memo="";

for($i=0;$i<count($temp);$i++) {
	$memo = $memo.$temp[$i];
}
// ���ý����̶���Ʈ ó�� ��

// �ӽ� ġȯ�� ���ڸ� ������
$memo=str_replace("my_lt_ek","&lt;",$memo);
$memo=str_replace("my_gt_ek","&gt;",$memo);

$memo=trim($memo);

if($use_html<2) {
	$memo=str_replace("  ","&nbsp;&nbsp;",$memo);
	$memo=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$memo);
}

// html �̹��� ��������
$imagePattern = "#<img(.+?)src=([^>]*?)>#i";
$memo=preg_replace($imagePattern,"<div align=left><img name=zb_target_resize\\1src=\\2></div>",$memo);

// �̹��� �ڽ� �ؼ� �� ������¡, Ȯ�뺸�⸦ ���ؼ� ����ǥ���� ���
if($ismember) {
	// ����� �̹��� ���� ó��
	$imagePattern="#\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,#i";
	preg_match_all($imagePattern,$memo,$out3,PREG_SET_ORDER);
	for($i=0;$i<count($out3);$i++) {
		$iview_large="vXL_".$out3[$i][1].".jpg";
		if(preg_match("#\.(jpg|jpeg|png)$#i",$out3[$i][1].".".$out3[$i][2])){
			// ����� ���丮 �� �� ȸ���� ���丮 ����
			$error_check=0;
			if(!is_dir($_zb_path."data/$id/thumbnail/".$ismember."/")) {
				if(!@mkdir($_zb_path."data/$id/thumbnail/".$ismember."/",0777)) $error_check+=1;
				if(!@chmod($_zb_path."data/$id/thumbnail/".$ismember."/",0707)) $error_check+=2;
			}
			if($error_check==2) echo "<br> ".$_zb_path."data/$id/thumbnail/".$ismember."/ ���丮�� ������ 707�� �����ϼ���<br><br>";
			elseif($error_check==3) echo "<br> ".$_zb_path."data/$id/thumbnail/ ���丮 ���� ".$ismember."�� ȸ�� ���丮 ������ �����߽��ϴ�.<br> �ش��ο� ���丮�� �������� �ֽð� ������ 707�� �����ϼ���<br><br>";

			$src_img="icon/member_image_box/".$ismember."/".$out3[$i][1].".".$out3[$i][2];
			if(file_exists($src_img) && !file_exists($_zb_path."data/$id/thumbnail/".$ismember."/".$iview_large)){
				thumbnail3(640,$src_img,$_zb_path."data/$id/thumbnail/".$ismember."/".$iview_large);
			}
		}
	}

	$imageBoxPattern=array("/\[img\:(.+?)\.(jpg|jpeg|png)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i","/\[img\:(.+?)\.(gif|bmp)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i");
	$imageBoxReplace=array("<img src='data/$id/thumbnail/$ismember/vXL_\\1.jpg' name=zb_target_resize style=\"cursor:pointer\" onclick=\"javascript: window.open('img_view.php?img=icon/member_image_box/$ismember/\\1.\\2&width='+(\\4+10)+'&height='+(\\5+55),'imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\" align='\\3' vspace='\\6' hspace='\\7' border='\\8'>","<img src='icon/member_image_box/$ismember/\\1.\\2' name=zb_target_resize style=\"cursor:pointer\" onclick=\"javascript: window.open('img_view.php?img=icon/member_image_box/$ismember/\\1.\\2&width='+(\\4+10)+'&height='+(\\5+55),'imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\" align='\\3' width='\\4' height='\\5' vspace='\\6' hspace='\\7' border='\\8'>");
	$imageBoxPattern2="/\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,/e";
	$memo=preg_replace($imageBoxPattern2,"'[img:'.str_replace('%2F', '/', urlencode('\\1.\\2')).','",$memo);
	$memo=preg_replace($imageBoxPattern,$imageBoxReplace,$memo);
}

if($use_html<2) {
	$memo=nl2br($memo);

	// ���ý����̶���Ʈ ó�� ����
	$codePattern = "#(<pre[^>]*?>|<\/pre>)#si";
	$temp = preg_split($codePattern,$memo,-1,PREG_SPLIT_DELIM_CAPTURE);

	for($i=0;$i<count($temp);$i++) {
		$pattern1 = "#<pre[^>]*?>#i";
		if(preg_match($pattern1,$temp[$i])) {
			$temp[$i+1]=preg_replace("#<br \/>|<br>#si","",$temp[$i+1]);
			$i+=1;
		}
	}

	$memo="";

	for($i=0;$i<count($temp);$i++) {
		$memo = $memo.$temp[$i];
	}
	// ���ý����̶���Ʈ ó�� ��
}

// �ڵ���ũ �Ŵ� �κ�;;
if($setup[use_autolink]&&!preg_match("/url\(/i",$memo)) $memo=autolink($memo);

// ���� ����
if(($is_admin||$member[level]<=$setup[use_html])&&$use_html) $data[subject]=$subject;
else $data[subject]=del_html($subject);

?>
<html>
<head>
<title><?=$setup[title]?></title>
<meta http-equiv=Content-Type content=text/html; charset=EUC-KR>
<meta name="viewport" content="width=device-width">
<link rel=StyleSheet HREF=skin/<?=$setup[skinname]?>/style.css type=text/css title=style>

<!-- SyntaxHighlighter ���� ��� -->
<link rel="stylesheet" type="text/css" href="syntaxhighlighter/styles/shThemeDefault.css" />
<link rel="stylesheet" type="text/css" href="syntaxhighlighter/styles/shCore.css" />

<SCRIPT type="text/javascript" src="syntaxhighlighter/scripts/jquery-1.4.2.min.js"></SCRIPT>
<script type="text/javascript" src="syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/shAutoloader.js"></script>
<SCRIPT type="text/javascript" src="syntaxhighlighter/scripts/jQuery.js"></SCRIPT>

<!-- �̹��� ������� ���ؼ� ó���ϴ� �κ� -->
<script>
	function zb_img_check(){
		var zb_main_table_width = document.zb_get_table_width.width*(100-4)/100;
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

</head>
<body topmargin='10'  leftmargin='10' marginwidth='10' marginheight='10' <?
	if($setup[bg_color]) echo " bgcolor=".$setup[bg_color];
	if($setup[bg_image]) echo " background=".$setup[bg_image];?>>
<table border=0 cellspacing=0 cellpadding=0 width=100% height=1 style="table-layout:fixed;">
<col width=100%></col>
<tr>
	<td><img src=images/t.gif border=0 width=98% height=1 name=zb_get_table_width><br><img src=images/t.gif border=0 name=zb_target_resize width=1 height=1></td>
</tr>
</table>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0 bgcolor=white style=table-layout:fixed>
<tr>
	<td align=left><img src=images/pv_title_left.gif border=0></td>
	<td width=100% background=images/pv_title_back.gif><img src=images/pv_title_back.gif></td>
	<td align=right><img src=images/pv_title_right.gif border=0></td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=10 width=100% height=100% bgcolor=black style=table-layout:fixed>
<tr bgcolor=white valign=top>
	<td height=40 class=title2_han>
		<b>����: <?=$data[subject]?></b><br>
	</td>
</tr>
<tr bgcolor=white valign=top>
	<td>
		<?=$memo?>
	</td>
</tr>
</table>
</body>
</html>

<?
@mysql_close($connect);
?>