<?
include "lib.php";

if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)) Error("정상적으로 글을 작성하여 주시기 바랍니다.","window.close");
if(!preg_match("/(zboard.php|view.php|comment.php|comment_modify_ok.php)/i",$HTTP_REFERER)) Error("정상적으로 글을 쓰시기 바랍니다.","window.close");
if(getenv("REQUEST_METHOD") == 'GET' ) Error("정상적으로 글을 쓰시기 바랍니다..","window.close");

if(!$memo) Error("덧글 내용을 입력하여 주십시요","window.close");

if(!$connect) $connect=dbConn();

// 게시판 설정 읽어 오기
$setup=get_table_attrib($id);

// 설정되지 않은 게시판
if(!$setup[name]) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시요","window.close()");

// 현재 게시판의 그룹의 설정 읽어 오기
$group=group_info($setup[group_no]);

// 회원 데이타 읽어 오기
$member = member_info();

// 원 게시글 정보 읽어오기
$data=mysql_fetch_array(mysql_query("select * from  $t_board"."_$id  where no='$no'"));
if($c_no&&$mode=="modify") $s_data=mysql_fetch_array(mysql_query("select * from  $t_comment"."_$id  where no='$c_no'"));

// 현재 로그인되어 있는 멤버가 전체, 또는 그룹관리자인지 검사
if($member[is_admin]==1||($member[is_admin]==2&&$member[group_no]==$setup[group_no])||check_board_master($member, $setup[no])) $is_admin=1; else $is_admin="";

if(get_magic_quotes_gpc()) $memo=stripslashes($memo);

// &lt,&gt를 신택스하이라이트에서 사용하기 위해 임시 치환
$memo=str_replace("&lt;","my_lt_ek",$memo);
$memo=str_replace("&gt;","my_gt_ek",$memo);

// 관리자이거나 HTML허용레벨이 낮을때 태그의 금지유무를 체크
if(!$is_admin&&$setup[grant_html]<$member[level]) {

	// 내용의 HTML 금지;;
	if(!$use_html2||$setup[use_html]==0) $memo=del_html($memo);

	// HTML의 부분허용일때;;
	if($use_html2&&$setup[use_html]==1) {
		$memo=str_replace("<","&lt;",$memo);
		$tag=explode(",",$setup[avoid_tag]);
		for($i=0;$i<count($tag);$i++) {
			if(!isblank($tag[$i])) {
				$memo=preg_replace("#&lt;".$tag[$i]." #i","<".$tag[$i]." ",$memo);
				$memo=preg_replace("#&lt;".$tag[$i].">#i","<".$tag[$i].">",$memo);
				$memo=preg_replace("#&lt;/".$tag[$i]."#i","</".$tag[$i],$memo);
			}
		}
		// XSS 해킹 이벤트 핸들러 제거
		$xss_pattern1 = "!(<[^>]*?)on(load|click|error|abort|activate|afterprint|afterupdate|beforeactivate|beforecopy|beforecut|beforedeactivate|beforeeditfocus|beforepaste|beforeprint|beforeunload|beforeupdate|blur|bounce|cellchange|change|contextmenu|controlselect|copy|cut|dataavailable|datasetchanged|datasetcomplete|dblclick|deactivate|drag|dragend|dragenter|dragleave|dragover|dragstart|drop|errorupdate|filterchange|finish|focus|focusin|focusout|help|keydown|keypress|keyup|layoutcomplete|losecapture|mousedown|mouseenter|mouseleave|mousemove|mouseout|mouseover|mouseup|mousewheel|move|moveend|movestart|paste|propertychange|readystatechange|reset|resize|resizeend|resizestart|rowenter|rowexit|rowsdelete|rowsinserted|scroll|select|selectionchange|selectstart|start|stop|submit|unload)([^>]*?)(>)!i";
		$xss_pattern2 = "!on(load|click|error|abort|activate|afterprint|afterupdate|beforeactivate|beforecopy|beforecut|beforedeactivate|beforeeditfocus|beforepaste|beforeprint|beforeunload|beforeupdate|blur|bounce|cellchange|change|contextmenu|controlselect|copy|cut|dataavailable|datasetchanged|datasetcomplete|dblclick|deactivate|drag|dragend|dragenter|dragleave|dragover|dragstart|drop|errorupdate|filterchange|finish|focus|focusin|focusout|help|keydown|keypress|keyup|layoutcomplete|losecapture|mousedown|mouseenter|mouseleave|mousemove|mouseout|mouseover|mouseup|mousewheel|move|moveend|movestart|paste|propertychange|readystatechange|reset|resize|resizeend|resizestart|rowenter|rowexit|rowsdelete|rowsinserted|scroll|select|selectionchange|selectstart|start|stop|submit|unload)\s*\=!i";
		if(preg_match($xss_pattern1,$memo))
			$memo=preg_replace($xss_pattern1,"\\1\\4",$memo);
		if(preg_match($xss_pattern2,$memo))
			$memo=preg_replace($xss_pattern2,"",$memo);
	}
} else {
	if(!$use_html2) {
		$memo=del_html($memo);
	}
}

if($mode=="modify") {
	if($member[no]!=$s_data[ismember])
		$ismember=$s_data[ismember];
	else $ismember=$member[no];
}
else $ismember=$member[no];

// SyntaxHighlighter 코드 종류 변수
$code=array("applescript","as3","bash","cf","csharp","cpp","css","delphi","diff","erl","groovy","js","java","jfx","perl","php","plain","ps","py","ruby","scss","scala","sql","vb","html");

// 신택스하이라이트 처리 시작
$codePattern = "#(\[[a-z]+[0-9]?\_code\:[0-9]+\{[^}]*?\}\]|[\/[a-z]+[0-9]?\_code\])#si";
$temp = preg_split($codePattern,$memo,-1,PREG_SPLIT_DELIM_CAPTURE);

for($i=0;$i<count($temp);$i++) {
	$cnt=0;
	for($j=0;$j<count($code);$j++) {
		$pattern1 = "#\[".$code[$j]."\_code\:([0-9]+)\{([^}]*?)\}\]#i";
		$pattern2 = "#\[\/".$code[$j]."\_code\]#i";
		// 코드삽입 태그 짝이 발견되면
		if(preg_match($pattern1,$temp[$i])&&preg_match($pattern2,$temp[$i+2])) {
			$cnt++;
			if($code[$j]=="php")
				$temp[$i]=preg_replace($pattern1,"<pre class=\"brush: $code[$j]; html_script: true; first-line: \\1\" title=\"\\2\">",$temp[$i]);
			else
				$temp[$i]=preg_replace($pattern1,"<pre class=\"brush: $code[$j]; first-line: \\1\" title=\"\\2\">",$temp[$i]);

			$temp[$i+1]=str_replace("&amp;","&amp;amp;",$temp[$i+1]);
			$temp[$i+1]=str_replace("&#039;","&amp;#039;",$temp[$i+1]);
			$temp[$i+1]=str_replace("&quot;","&amp;quot;",$temp[$i+1]);
			$temp[$i+1]=str_replace("&nbsp;","&amp;nbsp;",$temp[$i+1]);
			$temp[$i+1]=str_replace("my_lt_ek","&amp;lt;",$temp[$i+1]); // &lt 사용!
			$temp[$i+1]=str_replace("my_gt_ek","&amp;gt;",$temp[$i+1]); // &gt 사용!
			$temp[$i+1]=str_replace("<","&lt;",$temp[$i+1]);

			$temp[$i+2]="</pre>";
			$i+=2;
		}
	}
	if($cnt==0) $temp[$i]=preg_replace("#delsec#i","",$temp[$i]);
}

$memo="";

for($i=0;$i<count($temp);$i++) {
	$memo = $memo.$temp[$i];
}
// 신택스하이라이트 처리 끝

// 임시 치환된 문자를 복원함
$memo=str_replace("my_lt_ek","&lt;",$memo);
$memo=str_replace("my_gt_ek","&gt;",$memo);

$memo=trim($memo);

if($use_html2<2) {
	$memo=str_replace("  ","&nbsp;&nbsp;",$memo);
	$memo=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$memo);
}

// HTML 사용일 경우 현재 회원의 level이 익명사용자/게스트 레벨이라면 style 속성을 제거
if($use_html2&&$member[level]>8) {
	$style_pattern = "/(<[^>]*?)style([^>]*?)(>)/i";
	$memo=preg_replace($style_pattern,"\\1\\3",$memo);
}

// html 이미지 리사이즈
$imagePattern = "#<img(.+?)src=([^>]*?)>#i";
$imagePattern2 = "#<div align=left><img name=zb_target_resize src=\"skin\/f2plus_gallery_3_0\/images\/emoticon\/([^>]*?)><\/div>#i";
$memo=preg_replace($imagePattern,"<div align=left><img name=zb_target_resize\\1src=\\2></div>",$memo);
$memo=preg_replace($imagePattern2,"<img src=\"skin/f2plus_gallery_3_0/images/emoticon/\\1>",$memo);

// 이미지 박스 해석 및 리사이징, 확대보기를 위해서 정규표현식 사용
if($ismember) {
	// 썸네일 이미지 관련 처리
	$imagePattern="#\[img\:(.+?)\.(jpg|jpeg|png)\,#i";
	preg_match_all($imagePattern,$memo,$out3,PREG_SET_ORDER);
	for($i=0;$i<count($out3);$i++) {
		$iview_large="vXL_".$out3[$i][1].".".$out3[$i][2].".jpg";
		$src_img="icon/member_image_box/".$ismember."/".$out3[$i][1].".".$out3[$i][2];
		if(file_exists($src_img) && !file_exists($_zb_path."data/$id/thumbnail/".$ismember."/".$iview_large)){
			// 썸네일 디렉토리 내 각 회원별 디렉토리 생성
			$error_check=0;
			if(!is_dir($_zb_path."data/$id/thumbnail/".$ismember."/")) {
				if(!@mkdir($_zb_path."data/$id/thumbnail/".$ismember."/",0777,true)) $error_check+=1;
				if(!@chmod($_zb_path."data/$id/thumbnail/".$ismember."/",0707)) $error_check+=2;
			}
			if($error_check==2) echo "<br> ".$_zb_path."data/$id/thumbnail/".$ismember."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
			elseif($error_check==3) echo "<br> ".$_zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$ismember."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

			thumbnail3(640,$src_img,$_zb_path."data/$id/thumbnail/".$ismember."/".$iview_large);
		}
	}

	$imageBoxPattern=array("/\[img\:(.+?)\.(jpg|jpeg|png)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i","/\[img\:(.+?)\.(gif|bmp)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i");
	$imageBoxReplace=array("<img src='data/$id/thumbnail/$ismember/vXL_\\1.\\2.jpg' name=zb_target_resize style=\"cursor:pointer\" onclick=\"javascript: window.open('img_view.php?img=icon/member_image_box/$ismember/\\1.\\2&width='+(\\4+10)+'&height='+(\\5+55),'imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\" align='\\3' vspace='\\6' hspace='\\7' border='\\8'>","<img src='icon/member_image_box/$ismember/\\1.\\2' name=zb_target_resize style=\"cursor:pointer\" onclick=\"javascript: window.open('img_view.php?img=icon/member_image_box/$ismember/\\1.\\2&width='+(\\4+10)+'&height='+(\\5+55),'imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\" align='\\3' width='\\4' height='\\5' vspace='\\6' hspace='\\7' border='\\8'>");
	$imageBoxPattern2="/\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,/ie";
	$memo=preg_replace($imageBoxPattern2,"'[img:'.str_replace('%2F', '/', urlencode('\\1.\\2')).','",$memo);
	$memo=preg_replace($imageBoxPattern,$imageBoxReplace,$memo);
}

if($use_html2<2) {
	$memo=nl2br($memo);

	// 신택스하이라이트 처리 시작
	$codePattern = "#(<pre[^>]*?>|<\/pre>)#si";
	$temp = preg_split($codePattern,$memo,-1,PREG_SPLIT_DELIM_CAPTURE);

	for($i=0;$i<count($temp);$i++) {
		$pattern1 = "#<pre[^>]*?>#i";
		if(preg_match($pattern1,$temp[$i])) {
			$temp[$i+1]=preg_replace("#<br \/>|<br>#si","",$temp[$i+1]);
			$i+=1;
		} else {
			// 자동링크 거는 부분;;
			if($setup[use_autolink]&&!preg_match("/url\(/i",$temp[$i])) $temp[$i]=autolink($temp[$i]);
		}
	}

	$memo="";

	for($i=0;$i<count($temp);$i++) {
		$memo = $memo.$temp[$i];
	}
	// 신택스하이라이트 처리 끝
}

// $memo의 &를 &amp 로 치환 후 textarea 태그 안의 textarea 태그 깨짐 방지를 위해 < 를 &lt; 로 한번더 치환
$memo=str_replace("<","&lt;",str_replace("&","&amp;",$memo));
?>
<html lang="ko">
<head>
<title><?=$setup[title]?></title>
<meta http-equiv=Content-Type content=text/html; charset=UTF-8>
<meta name="viewport" content="width=device-width">
<link rel=StyleSheet HREF=skin/<?=$setup[skinname]?>/style.css type=text/css title=style>

<!-- SyntaxHighlighter 관련 헤더 -->
<link rel="stylesheet" type="text/css" href="syntaxhighlighter/styles/shThemeDefault.css" />
<link rel="stylesheet" type="text/css" href="syntaxhighlighter/styles/shCore.css" />

<SCRIPT type="text/javascript" src="syntaxhighlighter/scripts/jquery-1.7.1.min.js"></SCRIPT>
<script type="text/javascript" src="syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/shAutoloader.js"></script>
<SCRIPT type="text/javascript" src="syntaxhighlighter/scripts/jQuery.js"></SCRIPT>

<!-- 이미지 리사이즈를 위해서 처리하는 부분 -->
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
	<td height=50 class=title2_han>
		<b>제목: [<?=$setup[title]?>]의 "<?=del_html($data[subject])?>" 게시글의 덧글</b><br>
	</td>
</tr>
<tr bgcolor=white valign=top>
	<td class=memo>
		<!-- 내용 창이 깨지지 않게 하기 위해 조립 -->
		<div id=IAMCONT></div>
		<textarea style='display:none' id=IAMAREA><?=$memo?></textarea>
		<script>document.getElementById('IAMCONT').innerHTML = document.getElementById('IAMAREA').value</script>
	</td>
</tr>
</table>
</body>
</html>

<?
// 세션이 초기화되는 버그 때문에 세션변수를 재설정
$_SESSION['ZBRD_SS_VRS'] = $antispam;
?>
