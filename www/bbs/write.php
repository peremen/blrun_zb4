<?
$pass = $_POST["pwd"];
$pass = stripslashes($pass);
/***************************************************************************
 * 공통 파일 include
 **************************************************************************/
include "_head.php";

if($pass == "gg" || $member[no]) {

/***************************************************************************
 * 게시판 설정 체크
 **************************************************************************/

 	if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)) Error("정상적으로 글을 작성하여 주시기 바랍니다.");

	if(preg_match("/:\/\//i",$dir)) $dir=".";
// 스팸방지 보안 세션변수 설정과 Mode변수 로그인 유형별 넘겨받기 셋팅
	if($member[no]) {
		$mode = $HTTP_GET_VARS[mode];
		$WRT_SPM_PWD = "gg";
	} else {
		$mode = $HTTP_POST_VARS[mode];
		$WRT_SPM_PWD = $pass;
	}
	session_register("WRT_SPM_PWD");

// 랜덤한 두 숫자를 발생(1-8) 후 세션변수에 대입
	$wnum1 = rand(1,8);
	$wnum2 = rand(1,8);
	$wnum1num2 = $wnum1*10 + $wnum2;
	session_register("wnum1num2");
	//글쓰기 보안을 위해 세션변수를 설정
	$WRT_SS_VRS = $wnum1num2;
	session_register("WRT_SS_VRS");

// 변수 체크
	if(!$mode||$mode=="write") {
		$mode = "write";
		unset($no);
	}

// 사용권한 체크
	if($mode=="reply"&&$setup[grant_reply]<$member[level]&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");
	elseif($setup[grant_write]<$member[level]&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");
	if($mode=="reply"&&$setup[grant_view]<$member[level]&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");

// 답글이나 수정일때 원본글을 가져옴;;
	if(($mode=="reply"||$mode=="modify")&&$no) {
		$result=@mysql_query("select * from $t_board"."_$id where no='$no'") or error(mysql_error());
		unset($data);
		$data=mysql_fetch_array($result);
		if(!$data[no]) Error("원본글이 존재하지 않습니다");
	}

// 수정 글일때 권한 체크
	if($mode=="modify"&&$data[ismember]) {
		if($data[ismember]!=$member[no]&&!$is_admin&&$member[level]>$setup[grant_delete]) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");
	}

// 공지글에는 답글이 안 달리게 처리
	if($mode=="reply"&&$data[headnum]<=-2000000000) Error("공지글에는 답글을 달수 없습니다");

// 카테고리 데이타 가져옴;;
	$category_result=mysql_query("select * from $t_category"."_$id order by no");

// 카테고리 데이타 갖고 오기;;
	if($setup[use_category]) {
		$category_kind="<select name=category><option>Category</option>";

		while($category_data=mysql_fetch_array($category_result)) {
			if($data[category]==$category_data[no]) $category_kind.="<option value=$category_data[no] selected>$category_data[name]</option>";
			else $category_kind.="<option value=$category_data[no]>$category_data[name]</option>";
		}

		$category_kind.="</select>";
	}
  
	if($mode=="modify") $title = " 글 수정하기 ";
	elseif($mode=="reply") $title = " 답글 달기 ";
	else $title = " 신규 글쓰기 "; 

// 쿠키값을 이용;;
	$name=$HTTP_SESSION_VARS["zb_writer_name"];
	$email=$HTTP_SESSION_VARS["zb_writer_email"];
	$homepage=$HTTP_SESSION_VARS["zb_writer_homepage"];

/******************************************************************************************
 * 글쓰기 모드에 따른 내용 체크
 *****************************************************************************************/
	if($data[use_html]<2) {
		$data[memo]=str_replace("&nbsp;&nbsp;&nbsp;&nbsp;","\t",$data[memo]);
		$data[memo]=str_replace("&nbsp;&nbsp;","  ",$data[memo]);
	}

	if($mode=="modify") {

		// 신택스하이라이트 헤더 처리 시작
		$codePattern = "#(<pre class\=\"brush\: [a-z]+[^>]*?>|<\/pre>)#si";
		$memo = $data[memo];
		$temp = preg_split($codePattern,$memo,-1,PREG_SPLIT_DELIM_CAPTURE);

		for($i=0;$i<count($temp);$i++) {
			$cnt=0;
			for($j=0;$j<count($code);$j++) {
				$pattern1 = "#<pre class\=\"brush\: ".$code[$j]."[^>]*? first-line\: ([0-9]+)\" title=\"([^\"]*?)\">#i";
				$pattern2 = "#<\/pre>#i";
				if(preg_match($pattern1,$temp[$i])) {
					$cnt++;
					$temp[$i]=preg_replace($pattern1,"[".$code[$j]."_code:\\1{\\2}]",$temp[$i]);
					$i+=1;
					if(preg_match($pattern2,$temp[$i+1])) {
						$temp[$i+1]="[/".$code[$j]."_code]";
						$i+=1;
					}
				}
			}
			if($cnt==0) {
				$temp[$i]=str_replace("&amp;","&amp;amp;",$temp[$i]);
				$temp[$i]=str_replace("&lt;","&amp;lt;",$temp[$i]);
				$temp[$i]=str_replace("&gt;","&amp;gt;",$temp[$i]);
			}
		}

		$memo="";

		for($i=0;$i<count($temp);$i++) {
			$memo = $memo.$temp[$i];
		}
		// 신택스하이라이트 헤더 처리 끝

		// 비밀글이고 패스워드가 틀리고 관리자가 아니면 리턴
		if($data[is_secret]&&!$is_admin&&$data[ismember]!=$member[no]&&$HTTP_SESSION_VARS[zb_s_check]!=$setup[no]."_".$no) error("정상적인 방법으로 수정하세요");

			$name=stripslashes($data[name]); // 이름
			$email=stripslashes($data[email]); // 메일
			$homepage=stripslashes($data[homepage]); // 홈페이지 
			$subject=$data[subject]=stripslashes($data[subject]); // 제목
			$subject=str_replace("\"","&quot;",$subject);
			$homepage=str_replace("\"","&quot;",$homepage);
			$name=str_replace("\"","&quot;",$name);
			$sitelink1=str_replace("\"","&quot;",$sitelink1);
			$sitelink2=str_replace("\"","&quot;",$sitelink2);
			$memo=str_replace("&nbsp;","&amp;nbsp;",stripslashes($memo)); // 내용
			$sitelink1=$data[sitelink1]=stripslashes($data[sitelink1]);
			$sitelink2=$data[sitelink2]=stripslashes($data[sitelink2]);
			if($data[file_name1])$file_name1="<br>&nbsp;".$data[s_file_name1]."이 등록되어 있습니다. <input type=checkbox name=del_file1 value=1> 삭제";
			if($data[file_name2])$file_name2="<br>&nbsp;".$data[s_file_name2]."이 등록되어 있습니다. <input type=checkbox name=del_file2 value=1> 삭제";

			if($data[use_html]) $use_html=" checked ";

			if($data[reply_mail]) $reply_mail=" checked ";
			if($data[is_secret]) $secret=" checked ";
			if($data[headnum]<=-2000000000) $notice=" checked ";

	// 답글일때 제목과 내용 수정;;
	} elseif($mode=="reply") {

		// 비밀글이고 패스워드가 틀리고 관리자가 아니면 리턴
		if($data[is_secret]&&!$is_admin&&$data[ismember]!=$member[no]&&$HTTP_SESSION_VARS[zb_s_check]!=$setup[no]."_".$no) error("정상적인 방법으로 답글을 다세요");

		if($data[is_secret]) $secret=" checked ";

		$subject=$data[subject]=stripslashes($data[subject]); // 제목
		$subject=str_replace("\"","&quot;",$subject);
		$sitelink1=str_replace("\"","&quot;",$sitelink1);
		$sitelink2=str_replace("\"","&quot;",$sitelink2);
		$memo=str_replace("&nbsp;","&amp;nbsp;",stripslashes($data[memo])); // 내용
		if(!preg_match("/\[re\]/i",$subject)) $subject="[re] ".$subject; // 답글일때는 앞에 [re] 붙임;;
		$memo=str_replace("\n","\n>",$memo);
		$memo="\n\n>".$memo."\n";
		$title="$name님의 글에 대한 답글쓰기";
	}


// 회원일때는 기본 입력사항 안보이게;;
	if($member[no]) { $hide_start="<!--"; $hide_end="-->"; }

// 싸이트 링크 기능이 없을때 링크 지우기 표시;;
	if(!$setup[use_homelink]) { $hide_sitelink1_start="<!--";$hide_sitelink1_end="-->";}
	if(!$setup[use_filelink]) { $hide_sitelink2_start="<!--";$hide_sitelink2_end="-->";}

// 자료실 기능을 사용하는지 않하는지 표시;;
	if(!$setup[use_pds]) { $hide_pds_start="<!--";$hide_pds_end="-->";}

// HTML사용 체크버튼 
	if($setup[use_html]==0) {
		if(!$is_admin&&$member[level]>$setup[grant_html]) { 
			$hide_html_start="<!--";
			$hide_html_end="-->"; 
		}
	}

// HTML 사용 체크를 확장시킴
	if($mode!="reply") {
		if(!$data[use_html]) $value_use_html = 1;
		else $value_use_html=$data[use_html];
	} else {
		$value_use_html=1;
	}
	$use_html .= " value='$value_use_html' onclick='check_use_html(this)'><ZeroBoard";


// 비밀글 사용;;
	if(!$setup[use_secret]) { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

// 공지기능 사용하는지 않하는지 표시;;
	if((!$is_admin&&$member[level]>$setup[grant_notice])||$mode=="reply") { $hide_notice_start="<!--";$hide_notice_end="-->"; }

// 최고 업로드 가능 용량
	if($setup[use_pds]) $upload_limit=GetFileSize($setup[max_upload_size]);

// 이미지 창고 버튼
	if($member[no]&&$setup[grant_imagebox]>=$member[level]) $a_imagebox="<a onfocus=blur() href='javascript:showImageBox(\"$id\")'>"; else $a_imagebox="<Zeroboard ";
	if($mode=="modify"&&$data[ismember]!=$member[no]) $a_imagebox = "<Zeroboard";

// 코드삽입 버튼
	if($setup[use_html]>0) $a_codebox="<a onfocus=blur() href='javascript:showCodeBox()'>"; else $a_codebox="<Zeroboard ";

// 미리보기 버튼
	$a_preview="<a onfocus=blur() href='#' onclick='javascript:return view_preview();'>";

// HTML 출력 

	head(" onload=unlock() onunload=hideImageBox() ","script_write.php");

	include $dir."/write.php";

	foot();

	include "_foot.php";

} else {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="viewport" content="width=device-width">
<title>암호입력 페이지</title>
<script language="javascript">
<!--
function sendit() {
	//패스워드
	if(document.myform.pwd.value=="") {
		alert("패스워드를 입력해 주십시요");
		return false;
	}
	document.myform.submit();
}
//-->
</script>
</head>

<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
<form name="myform" method="post" action="write.php">
<input type=hidden name="page" value="<?=$page?>"><input type=hidden name="id" value="<?=$id?>"><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value="<?=$select_arrange?>"><input type=hidden name=desc value="<?=$desc?>"><input type=hidden name=page_num value="<?=$page_num?>"><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>">
<table width=<?=$width?> height="120" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" align="center">
<tr>
	<td>
		<table width="320" height="70" border="1" style="border-collapse:collapse;" bordercolor="black" bgcolor="#BEEBDD" cellpadding="1" align="center">
		<tr><td height="45" align="center"><b><span style="font-size:11pt">익명 글쓰기!!<br>스팸방지 비번(<font color="red">gg</font>)을 입력: </span></b><input type="password" name="pwd" size="20"></td>
		</tr>
		<tr><td height="25" align="center"><input type="button" value="확인" onClick="javascript:sendit();">
		<tr>
		</table>
	</td>
</tr>
</table>
</form>
</body>
</html>
<? } ?>