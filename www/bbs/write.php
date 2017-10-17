<?
/***************************************************************************
 * 공통 파일 include
 **************************************************************************/
include "_head.php";
include("securimage/securimage.php");

if(!empty($_POST['code']) || $member[no] || $password) {

	if(!($member[no] || $password)) {

		// 스팸방지코드 체크 관련
		$img = new Securimage();
		$valid = $img->check($_POST['code']);

		if($valid == true) {

		} else {
			Error("스팸방지 코드를 잘못 입력하셨습니다.");
		}
	}

/***************************************************************************
 * 게시판 설정 체크
 **************************************************************************/

 	if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)) Error("정상적으로 글을 작성하여 주시기 바랍니다.");

	if(preg_match("/:\/\//i",$dir)) $dir=".";

// 스팸방지 보안 세션변수 설정과 Mode변수 로그인 유형별 넘겨받기 셋팅
	if($member[no]) {
		$mode = $_GET[mode];
	} else {
		$mode = $_POST[mode];
	}

// 랜덤한 두 숫자를 발생(1-1000) 후 변수에 대입
	$wnum1 = mt_rand(1,1000);
	$wnum2 = mt_rand(1,1000);
	$wnum1num2 = $wnum1*10000 + $wnum2;
	//글쓰기 보안을 위해 세션변수를 설정
	$_SESSION['WRT_SS_VRS'] = $wnum1num2;

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
	if($mode!="write"&&$no) {
		unset($data);
		$_dbTimeStart = getmicrotime();
		$result=@mysql_query("select * from $t_board"."_$id where no='$no'") or error(mysql_error());
		$data=mysql_fetch_array($result);
		$_dbTime += getmicrotime()-$_dbTimeStart;
		$ip_array = explode("|||",$data[memo]);
		if($setup[skinname]!="zero_vote" && substr($ip_array[0],0,9)=="설문조사|")
			Error("투표 내용은 수정할 수 없습니다.");
		if(!$data[no]) Error("원본글이 존재하지 않습니다");
	}

// 수정 글일때 권한 체크
	if($mode=="modify"&&$data[ismember]) {
		if($data[ismember]!=$member[no]&&!$is_admin&&$member[level]>$setup[grant_delete]) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");
	}

// ask_password.php에서 사용할 폼타켓을 write.php로 설정
	$target="write.php";

// 비밀글이고 패스워드가 틀리고 관리자가 아니면 에러 표시
	if($mode!="write"&&$data[is_secret]&&!$is_admin&&$data[ismember]!=$member[no]) {
		if($member[no]) {
			$_dbTimeStart = getmicrotime();
			$secret_check=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where no='$data[no]' and ismember='$member[no]'"));
			$_dbTime += getmicrotime()-$_dbTimeStart;
			if(!$secret_check[0]) error("비밀글을 열람할 권한이 없습니다");
		} else {
			if(!get_magic_quotes_gpc()) {
				$password = addslashes($password);
			}
			$_dbTimeStart = getmicrotime();
			$secret_check=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where no='$data[no]' and password=password('$password')"));
			$_dbTime += getmicrotime()-$_dbTimeStart;
			if(!$secret_check[0]) {
				head();
				$a_list="<a onfocus=blur() href='zboard.php?$href$sort'>";
				$a_view="<Zeroboard ";
				$title="이 글은 비밀글입니다.<br>비밀번호를 입력하여 주십시요";
				$input_password="<input type=password name=password size=20 maxlength=20 class=input>";
				if(preg_match("/:\/\//i",$dir)||preg_match("/\.\./i",$dir)) $dir="./";
				include $dir."/ask_password.php";
				foot();
				exit();
			} else {
				// 세션이 초기화되는 버그 때문에 세션변수를 재설정
				$secret_str = $setup[no]."_".$no;
				$_SESSION['zb_s_check'] = $secret_str;
			}
		}
	}

// 공지글에는 답글이 안 달리게 처리
	if($mode=="reply"&&$data[headnum]<=-2000000000) Error("공지글에는 답글을 달수 없습니다");

// 카테고리 데이타 가져옴;;
	$_dbTimeStart = getmicrotime();
	$category_result=mysql_query("select * from $t_category"."_$id order by no");
	$_dbTime += getmicrotime()-$_dbTimeStart;

// 카테고리 데이타 갖고 오기;;
	if($setup[use_category]) {
		$category_kind="<select id=category name=category><option value=0>Category</option>";

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
	$name=htmlspecialchars(stripslashes($_SESSION['zb_writer_name']));
	$email=htmlspecialchars(stripslashes($_SESSION['zb_writer_email']));
	$homepage=htmlspecialchars(stripslashes($_SESSION['zb_writer_homepage']));

/******************************************************************************************
 * 글쓰기 모드에 따른 내용 체크
 *****************************************************************************************/
	if($data[use_html]<2) {
		$data[memo]=str_replace("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;","\t",$data[memo]);
		$data[memo]=str_replace("&nbsp;&nbsp;","  ",$data[memo]);
		$data[memo]=preg_replace("#(?m)^&nbsp;(.+)$#i"," \\1",$data[memo]);
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

		// 비밀글이고 관리자가 아니고 멤버가 일치하지 않고 세션값이 틀리면 리턴
		if($data[is_secret]&&!$is_admin&&$data[ismember]!=$member[no]&&$_SESSION['zb_s_check']!=$zb_check) error("정상적인 방법으로 수정하세요");

		$name=htmlspecialchars($data[name]); // 이름
		$email=htmlspecialchars($data[email]); // 메일
		$homepage=htmlspecialchars($data[homepage]); // 홈페이지
		$subject=$data[subject]=htmlspecialchars($data[subject]); // 제목
		$memo=str_replace("&nbsp;","&amp;nbsp;",$memo); // 내용
		$sitelink1=$data[sitelink1]=htmlspecialchars($data[sitelink1]); // 사이트 링크
		$sitelink2=$data[sitelink2]=htmlspecialchars($data[sitelink2]);
		if($data[file_name1])$file_name1="<br>&nbsp;".$data[s_file_name1]."이 등록되어 있습니다. <input type=checkbox name=del_file1 value=1> 삭제";
		if($data[file_name2])$file_name2="<br>&nbsp;".$data[s_file_name2]."이 등록되어 있습니다. <input type=checkbox name=del_file2 value=1> 삭제";

		if($data[use_html]) $use_html=" checked ";

		if($data[reply_mail]) $reply_mail=" checked ";
		if($data[is_secret]) $secret=" checked ";
		if($data[headnum]<=-2000000000) $notice=" checked ";

	// 답글일때 제목과 내용 수정;;
	} elseif($mode=="reply") {

		// 비밀글이고 관리자가 아니고 멤버가 일치하지 않고 세션값이 틀리면 리턴
		if($data[is_secret]&&!$is_admin&&$data[ismember]!=$member[no]&&$_SESSION['zb_s_check']!=$zb_check) error("정상적인 방법으로 답글을 다세요");

		if($data[is_secret]) $secret=" checked ";

		$subject=$data[subject]=htmlspecialchars($data[subject]); // 제목
		$memo=str_replace("&nbsp;","&amp;nbsp;",$data[memo]); // 내용
		if(!preg_match("/\[re\]/i",$subject)) $subject="[re] ".$subject; // 답글일때는 앞에 [re] 붙임;;
		$memo=str_replace("\n","\n>",$memo);
		$memo="\n\n>".$memo."\n";
		$title="$name님의 글에 대한 답글쓰기";
	}

// textarea 태그가 들어있을시 깨짐 방지
	$memo=str_replace("<","&lt;",$memo);

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

// HTML 헤더 출력
	print "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>\n";
	head("onload=unlock() onunload=hideImageBox()","script_write.php");

// 각 스킨 디렉토리 write.php 인클루드
	$_skinTimeStart = getmicrotime();
	include $dir."/write.php";
	$_skinTime += getmicrotime()-$_skinTimeStart;

} else {

	// HTML 헤더 출력
	print "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>\n";
	head("onload=unlock() onunload=hideImageBox()","script_write.php");
?>
<script language="javascript">
<!--
function sendit() {
	//패스워드
	if(document.myform.code.value=="") {
		alert("스팸방지 코드를 입력해 주십시요");
		document.myform.code.focus();
		return false;
	}
	document.myform.submit();
}
//-->
</script>
<form name="myform" method="post" action="write.php">
<input type=hidden name="page" value="<?=$page?>"><input type=hidden name="id" value="<?=$id?>"><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value="<?=$select_arrange?>"><input type=hidden name=desc value="<?=$desc?>"><input type=hidden name=page_num value="<?=$page_num?>"><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>"><input type=hidden name=zb_check value="<?=$setup[no]."_".$no?>">
<table width=310 height=85 border=0 cellpadding=1 cellspacing=0 bgcolor=#FFFFFF align=center>
<tr>
	<td align=center>
		<div style="width: 310px; float: left; height: 85px; line-height: 12px">
		<img id="siimage" align="left" valign=absmiddle style="padding-right: 5px; border: 0" src="securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" />
		<p><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="33" height="33" id="SecurImage_as3" align="middle">
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="allowFullScreen" value="false" />
			<param name="movie" value="securimage/securimage_play.swf?audio=securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<embed src="securimage/securimage_play.swf?audio=securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="33" height="33" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</object>
		<br />
		<!-- pass a session id to the query string of the script to prevent ie caching -->
		<a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="securimage/images/refresh.gif" width="33" height="33" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a></p>
		</div>
		<div style="clear: both"></div>
		<b>익명글쓰기 코드입력:</b>
		<!-- NOTE: the "name" attribute is "code" so that $img->check($_POST['code']) will check the submitted form field -->
		<input type="text" name="code" size="12" /><br /><br />
	</td>
</tr>
<tr class=list0>
	<td align=center><input type=button value=" 확 인 " onClick="javascript:sendit()"></td>
</tr>
</table>
</form>
<?
}

foot();
?>