<?
/***************************************************************************
* 공통 파일 include
**************************************************************************/
include $_zb_path."_head.php";

if(file_exists($id."_config.php")){
	include $id."_config.php";
}

if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)||!$_SESSION['ZBRD_SS_VRS']||$_SESSION['ZBRD_SS_VRS']!=$antispam) Error("정상적으로 글을 작성하여 주시기 바랍니다.");
if(getenv("REQUEST_METHOD") == 'GET' ) Error("정상적으로 글을 쓰시기 바랍니다","");

/***************************************************************************
* 게시판 설정 체크
**************************************************************************/

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
history.back();
//-->
</script>
<?
	exit;
}

if($_point1==5) $_point2=0;

// 대상 파일 이름 정리
if(!$setup[use_alllist]) $view_file_link="view.php"; else $view_file_link="zboard.php";

// 사용권한 체크
if($setup[grant_comment]<$member[level]&&!$is_admin) Error1("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=$view_file_link");

// 각종 변수 검사;;
$name = str_replace("ㅤ","",$name);
$memo = str_replace("ㅤ","",$memo);

if(!$member[no]) {
	if(isblank($name)) Error1("이름을 입력하셔야 합니다");
	if(isblank($password)) Error1("비밀번호를 입력하셔야 합니다");
} else {
	$password = $member[password];
}

if(isblank($memo)) Error1("내용을 입력하셔야 합니다");

// 리플라이 덧글 관련 예약 문자열 검사
if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",trim($memo))) Error("예약된 문자열은 사용할 수 없습니다");

// 필터링;; 관리자가 아닐때;;
if(!$is_admin&&$setup[use_filter]) {
	$filter=explode(",",$setup[filter]);
	$f_memo=preg_replace("#([\_\-\./~@?=%&! ]+)#i","",strip_tags($memo));
	$f_name=preg_replace("#([\_\-\./~@?=%&! ]+)#i","",strip_tags($name));
	for($i=0;$i<count($filter);$i++)
	if(!isblank($filter[$i])) {
		if(preg_match("#".$filter[$i]."#i",$f_memo)) Error1("'$filter[$i]' 은(는) 등록하기에 적합한 단어가 아닙니다");
		if(preg_match("#".$filter[$i]."#i",$f_name)) Error1("'$filter[$i]' 은(는) 등록하기에 적합한 단어가 아닙니다");
	}
}

// 패스워드 addslashes
if(!get_magic_quotes_gpc()) {
	$password = addslashes($password);
}

// 패스워드를 암호화
if(strlen($password)) {
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];
}

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

// 원본글을 가져옴
unset($s_data);
$s_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where no='$c_no'"));

// 원본글을 이용한 비교
if($mode=="modify") {
	if(!$s_data[no]) Error1("해당 덧글이 존재하지 않습니다");
} elseif($mode=="reply") {
	if(!$s_data[no]) Error1("원본 덧글이 존재하지 않습니다");
}

$ismember = $member[no]; // 자동저장 멤버 번호
// 회원등록이 되어 있을때 이름등을 가져옴;;
if($member[no]) {
	if($mode=="modify"&&$member[no]!=$s_data[ismember]) {
		$name=$s_data[name];
	} else {
		$name=$member[name];
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
	$memo=addslashes($memo);
}

if($use_html2<2) {
	$memo=str_replace("  ","&nbsp;&nbsp;",$memo);
	$memo=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$memo);
}

// 각종 변수 설정
$ip=$REMOTE_ADDR; // 아이피값 구함;;
$reg_date=time(); // 현재의 시간구함;;

// 도배인지 아닌지 검사;; 우선 같은 아이피대에 30초이내의 덧글은 도배로 간주;;
if(!$is_admin&&$mode!="modify") {
	$max_no=mysql_fetch_array(mysql_query("select max(no) from $t_comment"."_$id"));
	$temp=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where ip='$ip' and $reg_date - reg_date <30 and no='$max_no[0]'"));
	if($temp[0]>0) Error1("덧글 등록은 30초이상이 지나야 가능합니다");
}

// 코멘트의 최고 Number 값을 구함 (중복 체크를 위해서)
$max_no=mysql_fetch_array(mysql_query("select max(no) from $t_comment"."_$id where parent='$no'"));

// 같은 내용이 있는지 검사;;
if(!$is_admin&&$mode!="modify") {
	$temp=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where memo='$memo' and no='$max_no[0]'"));
	if($temp[0]>0) Error1("같은 내용의 글은 등록할수가 없습니다");
}

// 쿠키 설정;;
// 5.3 이상용 세션 처리
if($c_name) {
	$_SESSION['writer_name']=$name;
}

// 해당글이 있는 지를 검사
$check = mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where no = '$no'", $connect));
if(!$check[0]) Error1("원본글(부모글)이 존재하지 않습니다.");

// 수정글일 때 비빌번호 먼저 체크
if($mode=="modify"&&$c_no) {
	if($s_data[ismember]) {
		if(!$is_admin&&$member[level]>$setup[grant_delete]&&$s_data[ismember]!=$member[no]) Error1("정상적인 방법으로 수정하세요");
	}

	// 비밀번호 검사;;
	if($s_data[ismember]!=$member[no]&&!$is_admin) {
		if($password!=$s_data[password]) Error1("비밀번호가 틀렸습니다");
	}
	if($c_depth) {
		$memo.="|||".$c_org."|".$c_depth;
	}
}
elseif($mode=="reply"&&$c_no) {
	$memo.="|||".$c_no."|".($c_depth+1);
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
	@z_unlink($_zb_path.$s_data[file_name1]);
	$del_que1=",file_name1='',s_file_name1=''";
	// 빈 파일 폴더 삭제
	if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name1],$out))
		if(is_dir($_zb_path."data/".$out[1]."/".$out[2])) @rmdir($_zb_path."data/".$out[1]."/".$out[2]);
}
if($del_file2==1) {
	@z_unlink($_zb_path.$s_data[file_name2]);
	$del_que2=",file_name2='',s_file_name2=''";
	// 빈 파일 폴더 삭제
	if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name2],$out))
		if(is_dir($_zb_path."data/".$out[1]."/".$out[2])) @rmdir($_zb_path."data/".$out[1]."/".$out[2]);
}

if($file1_size>0&&$setup[use_pds]&&$file1) {
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xE0-\xFF\x80-\xFF\x80-\xFF]+/',$file1_name,$result); // 특수문자가 들어갔는지 조사
	if($result[0]!=$file1_name) Error1("한글,영문자,숫자,괄호,공백,+,-,_ 만을 사용할 수 있습니다!"); // 특수 문자가 들어갔으면

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
			if(!preg_match("/".$upload_check."/i",$setup[pds_ext1])||!$upload_check) Error1("첫번째 업로드는 $setup[pds_ext1] 확장자만 가능합니다");
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
	}
}

if($file2_size>0&&$setup[use_pds]&&$file2) {
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xE0-\xFF\x80-\xFF\x80-\xFF]+/',$file2_name,$result); // 특수문자가 들어갔는지 조사
	if($result[0]!=$file2_name) Error1("한글,영문자,숫자,괄호,공백,+,-,_ 만을 사용할 수 있습니다!"); // 특수 문자가 들어갔으면

	if(!is_uploaded_file($file2)) Error1("정상적인 방법으로 업로드 해주세요");
	$file2_size=filesize($file2);
	if($setup[max_upload_size]<$file2_size&&!$is_admin) Error1("파일 업로드는 최고 ".GetFileSize($setup[max_upload_size])." 까지 가능합니다");
	if($file2_size>0) {
		$s_file_name2=$file2_name;
		if(substr($s_file_name2,0,1)=='.'||preg_match("#\.(inc|phtm|htm|shtm|phtml|html|shtml|ztx|php|dot|asp|cgi|pl)$#i",$s_file_name2)) Error1("Html, PHP 관련파일은 업로드할수 없습니다");

		// 확장자 검사
		if($setup[pds_ext2]) {
			$temp=explode(".",$s_file_name2);
			$s_point=count($temp)-1;
			$upload_check=$temp[$s_point];
			if(!preg_match("/".$upload_check."/i",$setup[pds_ext2])||!$upload_check) Error1("업로드는 $setup[pds_ext2] 확장자만 가능합니다");
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
	}
}

/***************************************************************************
* 수정글일때
**************************************************************************/
if($mode=="modify"&&$c_no) {
	// 파일등록
	if($file_name1) {$del_que1=",file_name1='$file_name1',s_file_name1='$s_file_name1'";}
	if($file_name2) {$del_que2=",file_name2='$file_name2',s_file_name2='$s_file_name2'";}

	mysql_query("update $t_comment"."_$id set name='$name',memo='$memo',use_html2='$use_html2',is_secret='$is_secret' $del_que1 $del_que2 where no='$c_no'") or Error1(mysql_error());
	if($type=="Movie_type"||$type=="Sell_type") mysql_query("update $t_comment"."_$id"."_movie set point1='$_point1',point2='$_point2' where parent='$no' and reg_date='$c_date'") or Error1(mysql_error());

} elseif($mode=="write"||($mode=="reply"&&$c_no)) {
	// 코멘트 입력
	mysql_query("insert into $t_comment"."_$id (parent,ismember,islevel,name,password,memo,reg_date,ip,use_html2,is_secret,file_name1,file_name2,s_file_name1,s_file_name2) values ('$no','$member[no]','$member[level]','$name','$password','$memo','$reg_date','$ip','$use_html2','$is_secret','$file_name1','$file_name2','$s_file_name1','$s_file_name2')") or Error1(mysql_error());
	if($type=="Movie_type"||$type=="Sell_type") mysql_query("insert into $t_comment"."_$id"."_movie (parent,reg_date,point1,point2) values ('$no','$reg_date','$_point1','$_point2')") or Error1(mysql_error());
	// 회원일 경우 해당 해원의 점수 주기
	mysql_query("update $member_table set point2=point2+1 where no='$member[no]'",$connect) or Error1(mysql_error());
}

// 임시 저장 정보 삭제
if($mode=="write"||$mode=="reply") mysql_query("delete from $comment_imsi_table where bname='$id' and cno='0' and parent='$no' and ismember='$ismember' and name='$member[name]' and password='$password'");
elseif($mode=="modify") mysql_query("delete from $comment_imsi_table where bname='$id' and cno='$c_no' and parent='$no' and ismember='$ismember' and name='$member[name]'");

// 코멘트 갯수를 구해서 정리
$total=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where parent='$no'"));
mysql_query("update $t_board"."_$id set total_comment='$total[0]' where no='$no'") or Error1(mysql_Error());

// 보안을 위해 세션변수 삭제
unset($_SESSION['ZBRD_SS_VRS']);

// 페이지 이동
movepage($zb_url."/".$view_file_link."?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category");
?>
