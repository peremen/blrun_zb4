<?
@extract($_GET);
@extract($_POST);

//set_time_limit(0);
$del_que1 = $del_que2 = null;

/***************************************************************************
* 공통 파일 include
**************************************************************************/
include $_zb_path."_head.php";

if(file_exists($id."_config.php")){
	include $id."_config.php";
}

if($type=="Movie_type"||$type=="Sell_type"){
	if($_name6==5) $_name7="";
	$memo=$memo."|||".$_name2."|||".$_name3."|||".$_name4."|||".$_name5."|||".$_name6."|||".$_name7."|||".$_name8."|||".$_name9."|||".$_name10;
}

function Error1($message, $url="") {
	global $setup, $connect, $dir, $_zb_path, $_zb_url;

	$dir=$_zb_url."skin/".$setup[skinname];
	$message=str_replace("<br>","\\n",$message);
	$message=str_replace("\"","\\\"",$message);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script>
<!--
alert("<?=$message?>");
history.back(-1);
//-->
</script>
<?
	exit;
}
/***************************************************************************
* 게시판 설정 체크
**************************************************************************/

// 편법을 이용한 글쓰기 방지
$mode = $_POST[mode];
if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)||!$_SESSION['WRT_SS_VRS']||$_SESSION['WRT_SS_VRS']!=$wantispam) Error1("정상적으로 글을 작성하여 주시기 바랍니다.");
if(getenv("REQUEST_METHOD") == 'GET' ) Error1("정상적으로 글을 쓰시기 바랍니다","");
if(!$mode) $mode = "write";

// 사용권한 체크
if($mode=="reply"&&$setup[grant_reply]<$member[level]&&!$is_admin) Error1("사용권한이 없습니다","$zb_url/login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");
elseif($setup[grant_write]<$member[level]&&!$is_admin) Error1("사용권한이 없습니다","$zb_url/login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");

if(!$is_admin&&$setup[grant_notice]<$member[level]) $notice = 0;

// 각종 변수 검사;;
$name = str_replace("ㅤ","",$name);
$subject = str_replace("ㅤ","",$subject);
$memo = str_replace("ㅤ","",$memo);

if(!$member[no]) {
	if(isblank($name)) Error1("이름을 입력하셔야 합니다");
	if(isblank($password)) Error1("비밀번호를 입력하셔야 합니다");
	if(!get_magic_quotes_gpc()) {
		$password = addslashes($password);
	}
} else {
	$password = $member[password];
}

if(isblank($subject)) Error1("제목을 입력하셔야 합니다");
if(isblank($memo)) Error1("내용을 입력하셔야 합니다");

if(!$category) {
	$cate_temp=mysql_fetch_array(mysql_query("select min(no) from $t_category"."_$id",$connect));
	$category=$cate_temp[0];
}

// 필터링;; 관리자가 아닐때;;
if(!$is_admin&&$setup[use_filter]) {
	$filter=explode(",",$setup[filter]);
	$f_memo=preg_replace("#([\_\-\./~@?=%&! ]+)#i","",strip_tags($memo));
	$f_name=preg_replace("#([\_\-\./~@?=%&! ]+)#i","",strip_tags($name));
	$f_subject=preg_replace("#([\_\-\./~@?=%&! ]+)#i","",strip_tags($subject));
	$f_email=preg_replace("#([\_\-\./~@?=%&! ]+)#i","",strip_tags($email));
	$f_homepage=preg_replace("#([\_\-\./~@?=%&! ]+)#i","",strip_tags($homepage));
	for($i=0;$i<count($filter);$i++) {
		if(!isblank($filter[$i])) {
			if(preg_match("#".$filter[$i]."#i",$f_memo)) Error1("'$filter[$i]' 은(는) 등록하기에 적합한 단어가 아닙니다");
			if(preg_match("#".$filter[$i]."#i",$f_name)) Error1("'$filter[$i]' 은(는) 등록하기에 적합한 단어가 아닙니다");
			if(preg_match("#".$filter[$i]."#i",$f_subject)) Error1("'$filter[$i]' 은(는) 등록하기에 적합한 단어가 아닙니다");
			if(preg_match("#".$filter[$i]."#i",$f_email)) Error1("'$filter[$i]' 은(는) 등록하기에 적합한 단어가 아닙니다");
			if(preg_match("#".$filter[$i]."#i",$f_homepage)) Error1("'$filter[$i]' 은(는) 등록하기에 적합한 단어가 아닙니다");
		}
	}
}

// 패스워드를 암호화
if($password) {
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];
}

// &lt,&gt를 신택스하이라이트에서 사용하기 위해 임시 치환
$memo=str_replace("&lt;","my_lt_ek",$memo);
$memo=str_replace("&gt;","my_gt_ek",$memo);

// 관리자이거나 HTML허용레벨이 낮을때 태그의 금지유무를 체크
if(!$is_admin&&$setup[grant_html]<$member[level]) {

	// 내용의 HTML 금지;;
	if(!$use_html||$setup[use_html]==0) $memo=del_html($memo);

	// HTML의 부분허용일때;;
	if($use_html&&$setup[use_html]==1) {
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
	if(!$use_html) {
		$memo=del_html($memo);
	}
}

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
	if($cnt==0) {
		// 위지윅에디터에서 &가 &amp;로 바뀔때 썸네일이 보이지 않는 현상 해결
		$imagePattern="#<img[^>]*src=[\']?[\"]?([^>]+)[\']?[\"]?[^>]*>#i";
		preg_match_all($imagePattern,$temp[$i],$img,PREG_SET_ORDER);
		for($j=0;$j<count($img);$j++)
			$temp[$i]=str_replace($img[$j][1],str_replace("&amp;","&",$img[$j][1]),$temp[$i]);
		// 자동 저장 잘림 방지
		$temp[$i]=str_replace("&#160;"," ",$temp[$i]);
	}
}

$memo="";

for($i=0;$i<count($temp);$i++) {
	$memo = $memo.$temp[$i];
}
// 신택스하이라이트 처리 끝

// 임시 치환된 문자를 복원함
$memo=str_replace("my_lt_ek","&lt;",$memo);
$memo=str_replace("my_gt_ek","&gt;",$memo);

if($setup[use_alllist]) $view_target="zboard.php"; else $view_target="view.php";
// 원본글을 가져옴
unset($s_data);
$s_data=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$no'"));

// 원본글을 이용한 비교
if($mode=="modify"||$mode=="reply") {
	if(!$s_data[no]) Error1("원본글이 존재하지 않습니다");
}

// 공지글에는 답글이 안 달리게 처리
if($mode=="reply"&&$s_data[headnum]<=-2000000000) Error1("공지글에는 답글을 달수 없습니다");

$ismember = $member[no]; // 자동저장 멤버 번호
// 회원등록이 되어 있을때 이름등을 가져옴;;
if($member[no]) {
	if($mode=="modify"&&$member[no]!=$s_data[ismember]) {
		$name=$s_data[name];
		$email=$s_data[email];
		$homepage=$s_data[homepage];
	} else {
		$name=$member[name];
		$email=$member[email];
		$homepage=$member[homepage];
	}
	if(!get_magic_quotes_gpc()) $name=addslashes($name);
	$name = trim($name);
} else {
	if(!get_magic_quotes_gpc()) $name=addslashes($name);
	$member[name] = trim($name);
	$ismember = '0';
}

// 각종 변수의 addslashes 시킴;;
if(!get_magic_quotes_gpc()) {
	$email=addslashes($email);
	$homepage=addslashes($homepage);
	$subject=addslashes($subject);
	$memo=addslashes($memo);
	$sitelink1=addslashes($sitelink1);
	$sitelink2=addslashes($sitelink2);
}

$email=trim($email);
$homepage=trim($homepage);
if(($is_admin||$member[level]<=$setup[use_html])&&$use_html) $subject=trim($subject);
else $subject=trim(del_html($subject));
$memo=trim($memo);
if($use_html<2) {
	$memo=str_replace("  ","&nbsp;&nbsp;",$memo);
	$memo=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$memo);
}
$sitelink1=trim($sitelink1);
$sitelink2=trim($sitelink2);

// 홈페이지 주소의 경우 http:// 가 없으면 붙임
if((!preg_match("/http:\/\//i",$homepage))&&$homepage) $homepage="http://".$homepage;

// 각종 변수 설정
$ip=$REMOTE_ADDR; // 아이피값 구함;;
$reg_date=time(); // 현재의 시간구함;;

// 도배인지 아닌지 검사;; 우선 같은 아이피대에 30초이내의 글은 도배로 간주;;
if(!$is_admin&&$mode!="modify") {
	$max_no=mysql_fetch_array(mysql_query("select max(no) from $t_board"."_$id"));
	$temp=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where ip='$ip' and $reg_date - reg_date <5 and no='$max_no[0]'"));
	if($temp[0]>0) Error1("글등록은 30초이상이 지나야 가능합니다");
}

// 같은 내용이 있는지 검사;;
if(!$is_admin&&$mode!="modify") {
	$max_no=mysql_fetch_array(mysql_query("select max(no) from $t_board"."_$id"));
	$temp=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where memo='$memo' and no='$max_no[0]'"));
	if($temp[0]>0) Error1("같은 내용의 글은 등록할수가 없습니다");
}

// 쿠키 설정;;
if($mode!="modify") {
	// 5.3 이상용 세션 처리
	if($name) {
		$_SESSION['zb_writer_name'] = $name;
	}
	if($email) {
		$_SESSION['zb_writer_email'] = $email;
	}
	if($homepage) {
		$_SESSION['zb_writer_homepage'] = $homepage;
	}
}

// 수정글일 때 비빌번호 먼저 체크
if($mode=="modify"&&$no) {
	if($s_data[ismember]) {
		if(!$is_admin&&$member[level]>$setup[grant_delete]&&$s_data[ismember]!=$member[no]) Error1("정상적인 방법으로 수정하세요");
	}

	// 비밀번호 검사;;
	if($s_data[ismember]!=$member[no]&&!$is_admin) {
		if($password!=$s_data[password]) Error1("비밀번호가 틀렸습니다");
	}
}

/***************************************************************************
* 업로드가 있을때
**************************************************************************/
if($_FILES[file1]) {
	$file1 = $_FILES[file1][tmp_name];
	$file1_name = $_FILES[file1][name];
	$file1_size = $_FILES[file1][size];
}
if($_FILES[file2]) {
	$file2 = $_FILES[file2][tmp_name];
	$file2_name = $_FILES[file2][name];
	$file2_size = $_FILES[file2][size];
}

// 파일삭제
if($del_file1==1) {
	if(preg_match("#\.(jpg|jpeg|png)$#i",$s_data[file_name1])){
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fs_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fl_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fXL_".$s_data[reg_date].".jpg");
	}
	@z_unlink($_zb_path."/".$s_data[file_name1]);$del_que1=",file_name1='',s_file_name1=''";
	// 빈 파일 폴더 삭제
	if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name1],$out))
		if(is_dir($_zb_path."/data/".$out[1]."/".$out[2])) @rmdir($_zb_path."/data/".$out[1]."/".$out[2]);
}
if($del_file2==1) {
	if(preg_match("#\.(jpg|jpeg|png)$#i",$s_data[file_name2])){
		  @z_unlink($_zb_path."data/".$id."/thumbnail/ss_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/sl_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/sXL_".$s_data[reg_date].".jpg");
	}
	@z_unlink($_zb_path."/".$s_data[file_name2]);$del_que2=",file_name2='',s_file_name2=''";
	// 빈 파일 폴더 삭제
	if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name2],$out))
		if(is_dir($_zb_path."/data/".$out[1]."/".$out[2])) @rmdir($_zb_path."/data/".$out[1]."/".$out[2]);
}

if($file1_size>0&&$setup[use_pds]&&$file1) {
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xE0-\xFF\x80-\xFF\x80-\xFF]+/',$file1_name,$result); //특수문자가 들어갔는지 조사
	if($result[0]!=$file1_name) Error1("한글,영문자,숫자,괄호,공백,+,-,_ 만을 사용할 수 있습니다!"); //특수 문자가 들어갔으면

	if(!is_uploaded_file($file1)) Error1("정상적인 방법으로 업로드 해주세요");
	if($file1_name==$file2_name) Error1("같은 파일은 등록할수 없습니다");
	$file1_size=filesize($file1);

	if($setup[max_upload_size]<$file1_size&&!$is_admin) Error1("첫번째 파일 업로드는 최고 ".GetFileSize($setup[max_upload_size])." 까지 가능합니다");

	// 업로드 금지
	if($file1_size>0) {
		$s_file_name1=$file1_name;
		if(substr($s_file_name1,0,1)=='.'||preg_match("#\.(inc|phtm|htm|shtm|phtml|html|shtml|ztx|php|dot|asp|cgi|pl)$#i",$s_file_name1)) Error1("Html, PHP 관련파일은 업로드할수 없습니다");

		// 확장자 검사
		if($setup[pds_ext1]) {
			$temp=explode(".",$s_file_name1);
			$s_point=count($temp)-1;
			$upload_check=$temp[$s_point];
			if(!preg_match("#".$upload_check."#i",$setup[pds_ext1])||!$upload_check) Error1("첫번째 업로드는 $setup[pds_ext1] 확장자만 가능합니다");
		}

		$file1=preg_replace("#\\\\#i","\\",$file1);
		$s_file_name1=str_replace(" ","_",$s_file_name1);
		$s_file_name1=str_replace("-","_",$s_file_name1);

		// 디렉토리를 검사함
		if(!is_dir($_zb_path."data/".$id)) {
			@mkdir($_zb_path."data/".$id,0777);
			@chmod($_zb_path."data/".$id,0707);
		}

		// 중복파일이 있을때;;
		if(file_exists($_zb_path."data/$id/".$s_file_name1)) {
			@mkdir($_zb_path."data/$id/".$reg_date,0777);
			if(!move_uploaded_file($file1,$_zb_path."data/$id/".$reg_date."/".$s_file_name1)) Error1("파일업로드가 제대로 되지 않았습니다");
			$file_name1="data/$id/".$reg_date."/".$s_file_name1;
			@chmod($_zb_path.$file_name1,0706);
			@chmod($_zb_path."data/$id/".$reg_date,0707);
		} else {
			if(!move_uploaded_file($file1,$_zb_path."data/$id/".$s_file_name1)) Error1("파일업로드가 제대로 되지 않았습니다");
			$file_name1="data/$id/".$s_file_name1;
			@chmod($_zb_path.$file_name1,0706);
		}
		if(preg_match("#\.(jpg|jpeg|png)$#i",$s_data[file_name1])){
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fs_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fl_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fXL_".$s_data[reg_date].".jpg");
		}
	}
}

if($file2_size>0&&$setup[use_pds]&&$file2) {
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xE0-\xFF\x80-\xFF\x80-\xFF]+/',$file2_name,$result); //특수문자가 들어갔는지 조사
	if($result[0]!=$file2_name) Error1("한글,영문자,숫자,괄호,공백,+,-,_ 만을 사용할 수 있습니다!"); //특수 문자가 들어갔으면

	if(!is_uploaded_file($file2)) Error1("정상적인 방법으로 업로드 해주세요");
	$file2_size=filesize($file2);

	if($setup[max_upload_size]<$file2_size&&!$is_admin) Error1("파일 업로드는 최고 ".GetFileSize($setup[max_upload_size])." 까지 가능합니다");

	// 업로드 금지
	if($file2_size>0) {
		$s_file_name2=$file2_name;
		if(substr($s_file_name2,0,1)=='.'||preg_match("#\.(inc|phtm|htm|shtm|phtml|html|shtml|ztx|php|dot|asp|cgi|pl)$#i",$s_file_name2)) Error1("Html, PHP 관련파일은 업로드할수 없습니다");

		// 확장자 검사
		if($setup[pds_ext2]) {
			$temp=explode(".",$s_file_name2);
			$s_point=count($temp)-1;
			$upload_check=$temp[$s_point];
			if(!preg_match("#".$upload_check."#i",$setup[pds_ext2])||!$upload_check) Error1("업로드는 $setup[pds_ext2] 확장자만 가능합니다");
		}

		$file2=preg_replace("#\\\\#i","\\",$file2);
		$s_file_name2=str_replace(" ","_",$s_file_name2);
		$s_file_name2=str_replace("-","_",$s_file_name2);

		// 디렉토리를 검사함
		if(!is_dir($_zb_path."data/".$id)) {
			mkdir($_zb_path."data/".$id,0777);
			@chmod($_zb_path."data/".$id,0707);
		}

		// 중복파일이 있을때;;
		if(file_exists($_zb_path."data/$id/".$s_file_name2)) {
			@mkdir($_zb_path."data/$id/".$reg_date,0777);
			if(!move_uploaded_file($file2,$_zb_path."data/$id/".$reg_date."/".$s_file_name2)) Error1("파일업로드가 제대로 되지 않았습니다");
			$file_name2="data/$id/".$reg_date."/".$s_file_name2;
			@chmod($_zb_path.$file_name2,0706);
			@chmod($_zb_path."data/$id/".$reg_date,0707);
		} else {
			if(!move_uploaded_file($file2,$_zb_path."data/$id/".$s_file_name2)) Error1("파일업로드가 제대로 되지 않았습니다");
			$file_name2="data/$id/".$s_file_name2;
			@chmod($_zb_path.$file_name2,0706);

		}
		if(preg_match("#\.(jpg|jpeg|png)$#i",$s_data[file_name2])){
		  @z_unlink($_zb_path."data/".$id."/thumbnail/ss_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/sl_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/sXL_".$s_data[reg_date].".jpg");
		}
	}
}

/***************************************************************************
* 수정글일때
**************************************************************************/
if($mode=="modify"&&$no) {
	// 기존 첨부파일 썸네일 삭제
	if(preg_match("#\.(jpg|jpeg|png)$#i",$s_data[file_name1])){
		@z_unlink($_zb_path."data/".$id."/thumbnail/fs_".$s_data[reg_date].".jpg");
		@z_unlink($_zb_path."data/".$id."/thumbnail/fl_".$s_data[reg_date].".jpg");
		@z_unlink($_zb_path."data/".$id."/thumbnail/fXL_".$s_data[reg_date].".jpg");
	}
	if(preg_match("#\.(jpg|jpeg|png)$#i",$s_data[file_name2])){
		@z_unlink($_zb_path."data/".$id."/thumbnail/ss_".$s_data[reg_date].".jpg");
		@z_unlink($_zb_path."data/".$id."/thumbnail/sl_".$s_data[reg_date].".jpg");
		@z_unlink($_zb_path."data/".$id."/thumbnail/sXL_".$s_data[reg_date].".jpg");
	}
	// 기존 외부 html 썸네일 삭제
	$Thumbnail_small1="fs_".$s_data[reg_date].".jpg";
	$Thumbnail_small2="ss_".$s_data[reg_date].".jpg";

	$Thumbnail_large1="fl_".$s_data[reg_date].".jpg";
	$Thumbnail_large2="sl_".$s_data[reg_date].".jpg";
	if(file_exists($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_small1)){
		@z_unlink($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_small1);
		@z_unlink($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_large1);
	}
	if(file_exists($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_small2)){
		@z_unlink($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_small2);
		@z_unlink($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_large2);
	}
	// 메인페이지 최근 갤러리 썸네일 삭제
	if(file_exists($_zb_path."data/latest_thumb/".$id."/".$s_data[reg_date]."_small.jpg")){
		@z_unlink($_zb_path."data/latest_thumb/".$id."/".$s_data[reg_date]."_small.jpg");
		@z_unlink($_zb_path."data/latest_thumb/".$id."/".$s_data[reg_date]."_large.jpg");
	}

	// 파일등록
	if($file_name1) {$del_que1=",file_name1='$file_name1',s_file_name1='$s_file_name1'";}
	if($file_name2) {$del_que2=",file_name2='$file_name2',s_file_name2='$s_file_name2'";}

	// 공지 -> 일반글
	if(!$notice&&$s_data[headnum]<="-2000000000") {
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id"));
		$max_division=$temp[0];
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
		if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

		// 헤드넘+1 한값을 가짐;;
		$max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000")); // 공지가 아닌 최소 headnum 구함
		$headnum=$max_headnum[0]-1;

		$next_data=mysql_fetch_array(mysql_query("select no,headnum,division from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum='$max_headnum[0]' and arrangenum='0'")); // 다음글을 구함;;
		if(!$next_data[0]) $next_data[0]="0";
		$next_no=$next_data[0];

		if(!$next_data[division]) $division=1; else $division=$next_data[division];

		$prev_data=mysql_fetch_array(mysql_query("select no from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum<'$headnum' and no!='$no' order by headnum desc limit 1")); // 이전글을 구함;;
		if($prev_data[0]) $prev_no=$prev_data[0]; else $prev_no=0;

		$child="0";
		$depth="0";
		$arrangenum="0";
		$father="0";
		minus_division($s_data[division]);
		@mysql_query("update $t_board"."_$id set headnum='$headnum',prev_no='$prev_no',next_no='$next_no',child='$child',depth='$depth',arrangenum='$arrangenum',father='$father',name='$name',email='$email',homepage='$homepage',subject='$subject',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category' $del_que1 $del_que2 where no='$no'") or error(mysql_error());
		plus_division($division);

		// 다음글의 이전글을 수정
		if($next_no)mysql_query("update $t_board"."_$id set prev_no='$no' where division='$next_data[division]' and headnum='$next_data[headnum]'");

		// 이전글의 다음글을 수정
		if($prev_no)mysql_query("update $t_board"."_$id set next_no='$no' where no='$prev_no'");

		mysql_query("update $t_board"."_$id set prev_no=0 where (division='$max_division' or division='$second_division') and prev_no='$s_data[no]' and headnum!='$next_data[headnum]'");
		mysql_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);
		mysql_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);
	}

	// 일반글 -> 공지
	elseif($notice&&$s_data[headnum]>-2000000000) {
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id"));
		$max_division=$temp[0];
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
		if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

		$max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$id where division='$max_division' or division='$second_division'"));  // 최고글을 구함;;
		$headnum=$max_headnum[0]-1;
		if($headnum>-2000000000) $headnum=-2000000000; // 최고 headnum이 공지가 아니면 현재 글에 공지를 넣음;

		$next_data=mysql_fetch_array(mysql_query("select no,headnum,division from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum='$max_headnum[0]' and arrangenum='0'"));
		if(!$next_data[0]) $next_data[0]="0";
		$next_no=$next_data[0];
		$prev_no=0;
		$child="0";
		$depth="0";
		$arrangenum="0";
		$father="0";
		minus_division($s_data[division]);
		$division=add_division();
		@mysql_query("update $t_board"."_$id set division='$division',headnum='$headnum',prev_no='$prev_no',next_no='$next_no',child='$child',depth='$depth',arrangenum='$arrangenum',father='$father',name='$name',email='$email',homepage='$homepage',subject='$subject',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category' $del_que1 $del_que2 where no='$no'") or error(mysql_error());

		if($s_data[father]) mysql_query("update $t_board"."_$id set child='$s_data[child]' where no='$s_data[father]'"); // 답글이었으면 원본글의 답글을 현재글의 답글로 대체
		if($s_data[child]) mysql_query("update $t_board"."_$id set depth=depth-1,father='$s_data[father]' where no='$s_data[child]'"); // 답글이 있으면 현재글의 위치로;;

		// 원래 다음글로 이글을 가지고 있었던 데이타의 prev_no을 바꿈;
		$temp=mysql_fetch_array(mysql_query("select max(headnum) from $t_board"."_$id where headnum<='$s_data[headnum]'"));
		$temp=mysql_fetch_array(mysql_query("select no from $t_board"."_$id where headnum='$temp[0]' and depth='0'"));
		mysql_query("update $t_board"."_$id set prev_no='$temp[no]' where prev_no='$s_data[no]'");

		mysql_query("update $t_board"."_$id set next_no='$s_data[next_no]' where next_no='$s_data[no]'");

		mysql_query("update $t_board"."_$id set prev_no='$no' where prev_no='0' and no!='$no'") or error(mysql_error()); // 다음글의 이전글을 설정
		mysql_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);
		mysql_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);

	// 일반->일반, 공지->공지 일때
	} else {
		@mysql_query("update $t_board"."_$id set name='$name',subject='$subject',email='$email',homepage='$homepage',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category' $del_que1 $del_que2 where no='$no'") or error(mysql_error());
		mysql_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);
		mysql_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);
	}

/***************************************************************************
* 답변글일때
**************************************************************************/
} elseif($mode=="reply"&&$no) {

	$prev_no=$s_data[prev_no];
	$next_no=$s_data[next_no];
	$father=$s_data[no];
	$child=0;
	$headnum=$s_data[headnum];
	if($headnum<=-2000000000&&$notice) Error1("공지사항에는 답글을 달수가 없습니다");
	$depth=$s_data[depth]+1;
	$arrangenum=$s_data[arrangenum]+1;
	$move_result=mysql_query("select no from $t_board"."_$id where division='$s_data[division]' and headnum='$headnum' and arrangenum>='$arrangenum'");
	while($move_data=mysql_fetch_array($move_result)) {
		mysql_query("update $t_board"."_$id set arrangenum=arrangenum+1 where no='$move_data[no]'");
	}

	$division=$s_data[division];
	plus_division($s_data[division]);

	// 답글 데이타 입력;;
	mysql_query("insert into $t_board"."_$id (division,headnum,arrangenum,depth,prev_no,next_no,father,child,ismember,memo,ip,password,name,homepage,email,subject,use_html,reply_mail,category,is_secret,sitelink1,sitelink2,file_name1,file_name2,s_file_name1,s_file_name2,reg_date,islevel) values ('$division','$headnum','$arrangenum','$depth','$prev_no','$next_no','$father','$child','$member[no]','$memo','$ip','$password','$name','$homepage','$email','$subject','$use_html','$reply_mail','$category','$is_secret','$sitelink1','$sitelink2','$file_name1','$file_name2','$s_file_name1','$s_file_name2','$reg_date','$member[level]')") or error(mysql_error());

	// 원본글과 원본글의 아래글의 속성 변경;;
	$no=mysql_insert_id();
	mysql_query("update $t_board"."_$id set child='$no' where no='$s_data[no]'");
	mysql_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);

	// 현재글의 조회수를 올릴수 없게 세션 등록
	$hitStr=",".$setup[no]."_".$no;
	$_SESSION['zb_hit']=$_SESSION['zb_hit'].$hitStr;

	// 현재글의 추천을 할수 없게 세션 등록
	$voteStr=",".$setup[no]."_".$no;
	$_SESSION['zb_vote']=$_SESSION['zb_vote'].$voteStr;

	// 응답글 보내기일때;;
	if($s_data[reply_mail]&&$s_data[email]) {

		if($use_html<2) $memo=nl2br($memo);
		$memo = stripslashes($memo);

		zb_sendmail($use_html, $s_data[email], $s_data[name], $email, $name, $subject, $memo);
	}

/***************************************************************************
* 신규 글쓰기일때
**************************************************************************/
} elseif($mode=="write") {

	// 공지사항이 아닐때;;
	if(!$notice) {
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id"));
		$max_division=$temp[0];
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
		if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

		$max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000"));
		if(!$max_headnum[0]) $max_headnum[0]=0;

		$headnum=$max_headnum[0]-1;

		$next_data=mysql_fetch_array(mysql_query("select division,headnum,arrangenum from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000 order by headnum limit 1"));
		if(!$next_data[0]) $next_data[0]="0";
		else {
			$next_data=mysql_fetch_array(mysql_query("select no,headnum,division from $t_board"."_$id where division='$next_data[division]' and headnum='$next_data[headnum]' and arrangenum='$next_data[arrangenum]'"));
		}

		$prev_data=mysql_fetch_array(mysql_query("select no from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum<=-2000000000 order by headnum desc limit 1"));
		if($prev_data[0]) $prev_no=$prev_data[0]; else $prev_no="0";

	// 공지사항일때;;
	} else {
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id"));
		$max_division=$temp[0]+1;
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
		if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

		$max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$id where division='$max_division' or division='$second_division'"));
		$headnum=$max_headnum[0]-1;
		if($headnum>-2000000000) $headnum=-2000000000;

		$next_data=mysql_fetch_array(mysql_query("select division,headnum from $t_board"."_$id where division='$max_division' or division='$second_division' order by headnum limit 1"));
		if(!$next_data[0]) $next_data[0]="0";
		else {
			$next_data=mysql_fetch_array(mysql_query("select no,headnum,division from $t_board"."_$id where division='$next_data[division]' and headnum='$next_data[headnum]' and arrangenum='0'"));
		}
		$prev_no=0;
	}

	$next_no=$next_data[no];
	$child="0";
	$depth="0";
	$arrangenum="0";
	$father="0";
	$division=add_division();

	mysql_query("insert into $t_board"."_$id (division,headnum,arrangenum,depth,prev_no,next_no,father,child,ismember,memo,ip,password,name,homepage,email,subject,use_html,reply_mail,category,is_secret,sitelink1,sitelink2,file_name1,file_name2,s_file_name1,s_file_name2,reg_date,islevel) values ('$division','$headnum','$arrangenum','$depth','$prev_no','$next_no','$father','$child','$member[no]','$memo','$ip','$password','$name','$homepage','$email','$subject','$use_html','$reply_mail','$category','$is_secret','$sitelink1','$sitelink2','$file_name1','$file_name2','$s_file_name1','$s_file_name2','$reg_date','$member[level]')") or error(mysql_error());
	$no=mysql_insert_id();

	// 현재글의 조회수를 올릴수 없게 세션 등록
	$hitStr=",".$setup[no]."_".$no;
	$_SESSION['zb_hit']=$_SESSION['zb_hit'].$hitStr;

	// 현재글의 추천을 할수 없게 세션 등록
	$voteStr=",".$setup[no]."_".$no;
	$_SESSION['zb_vote']=$_SESSION['zb_vote'].$voteStr;

	if($prev_no) mysql_query("update $t_board"."_$id set next_no='$no' where no='$prev_no'");
	if($next_no) mysql_query("update $t_board"."_$id set prev_no='$no' where headnum='$next_data[headnum]' and division='$next_data[division]'");
	mysql_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);
}

// 임시 저장 정보 삭제
if($mode=="write"||$mode=="reply") mysql_query("delete from $board_imsi_table where bname='$id' and bno='0' and ismember='$ismember' and name='$member[name]' and password='$password'");
elseif($mode=="modify") mysql_query("delete from $board_imsi_table where bname='$id' and bno='$no' and ismember='$ismember' and name='$member[name]'");

// 글의 갯수를 다시 갱신
$total=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id "));
mysql_query("update $admin_table set total_article='$total[0]' where name='$id'");

// 회원일 경우 해당 해원의 점수 주기
if($mode=="write"||$mode=="reply") @mysql_query("update $member_table set point1=point1+1 where no='$member[no]'",$connect) or error(mysql_error());

// 보안을 위해 세션변수 삭제
unset($_SESSION['WRT_SS_VRS']);

// 페이지 이동
$view_file =$zb_url."/".$view_target;
movepage($view_file."?id=$id&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no");
?>
