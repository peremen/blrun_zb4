<?
$pass = $_POST["pwd"];
$pass = stripslashes($pass);

/***************************************************************************
* 공통 파일 include
**************************************************************************/
include "_head.php";

// HTML 출력
print "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>\n";
head(" onload=unlock() onunload=hideImageBox() ","script_comment.php");

if($pass == "gg" || $member[no] || $password) {

	/***************************************************************************
	 * 코멘트 수정 전처리기
	 **************************************************************************/
	if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)) Error("정상적으로 글을 작성하여 주시기 바랍니다.");

	if(preg_match("/:\/\//i",$dir)) $dir=".";

	// 대상 파일 이름 정리
	if(!$setup[use_alllist]) $view_file_link="view.php"; else $view_file_link="zboard.php";

	// 사용권한 체크
	if(!$is_admin&&$member[level]>$setup[grant_comment]) Error("사용권한이 없습니다.","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=$view_file_link");

	// 원본글을 가져옴
	unset($s_data);
	if($c_no) {
		$_dbTimeStart = getmicrotime();
		$result=@mysql_query("select * from $t_comment"."_$id where no='$c_no'") or error(mysql_error());
		$s_data=mysql_fetch_array($result);
		$_dbTime += getmicrotime()-$_dbTimeStart;
		if(!$s_data[no]) Error("해당 덧글이 존재하지 않습니다");
	}
	// 수정 글일때 권한 체크
	if($mode=="modify"&&$s_data[ismember]) {
		if($s_data[ismember]!=$member[no]&&!$is_admin&&$member[level]>$setup[grant_delete]) Error("사용권한이 없습니다..","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=$view_file_link");
	}

	// ask_password.php에서 사용할 폼타켓을 comment.php로 설정
	$target="comment.php";

	// 비밀글이고 패스워드가 틀리고 관리자가 아니면 에러 표시
	if($mode=="modify"&&$s_data[is_secret]&&!$is_admin&&$s_data[ismember]!=$member[no]) {
		if($member[no]) {
			$_dbTimeStart = getmicrotime();
			$secret_check=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where no='$s_data[no]' and ismember='$member[no]'"));
			$_dbTime += getmicrotime()-$_dbTimeStart;
			if(!$secret_check[0]) error("비밀글을 열람할 권한이 없습니다");
		} else {
			if(!get_magic_quotes_gpc()) {
				$password = addslashes($password);
			}
			$_dbTimeStart = getmicrotime();
			$secret_check=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where no='$s_data[no]' and password=password('$password')"));
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
				$secret_str = $setup[no]."_".$no;
				$HTTP_SESSION_VARS['zb_s_check'] = $secret_str;
			}
		}
	}

	// 랜덤한 두 숫자를 발생(1-1000) 후 변수에 대입
	$num1 = mt_rand(1,1000);
	$num2 = mt_rand(1,1000);
	$num1num2 = $num1*10000 + $num2;
	//글쓰기 보안을 위해 세션변수를 설정
	$ZBRD_SS_VRS = $num1num2;
	session_register("ZBRD_SS_VRS");

	if($mode=="modify"&&$s_data[use_html2]<2) {
		$s_data[memo]=str_replace("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;","\t",$s_data[memo]);
		$s_data[memo]=str_replace("&nbsp;&nbsp;","  ",$s_data[memo]);
	}

	if($mode=="modify"){
		// 신택스하이라이트 헤더 처리 시작
		$codePattern = "#(<pre class\=\"brush\: [a-z]+[^>]*?>|<\/pre>)#si";
		$memo = $s_data[memo];
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

		// 계층 코멘트 표식 불러와 처리
		unset($c_match);
		if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",$memo,$c_match)) {
			$c_org = $c_match[1];
			$c_depth = $c_match[2];
			$memo = str_replace($c_match[0],"",$memo);
		} else {
			$c_org = 0;
			$c_depth = 0;
		}
		unset($o_data);
		if($c_org) {
			$_dbTimeStart = getmicrotime();
			$result2=@mysql_query("select * from $t_comment"."_$id where no='$c_org'") or error(mysql_error());
			$o_data=mysql_fetch_array($result2);
			$_dbTime += getmicrotime()-$_dbTimeStart;
			if(!$o_data[no]) Error("원본 덧글이 존재하지 않습니다");
		}

		$name=trim(htmlspecialchars($s_data[name])); // 이름
		$memo=str_replace("&nbsp;","&amp;nbsp;",trim($memo)); // 내용
		if($s_data[file_name1])$s_file_name1="<br>&nbsp;".$s_data[s_file_name1]."이 등록되어 있습니다.<br> <input type=checkbox name=del_file1 value=1> 삭제";
		if($s_data[file_name2])$s_file_name2="<br>&nbsp;".$s_data[s_file_name2]."이 등록되어 있습니다.<br> <input type=checkbox name=del_file2 value=1> 삭제";
		if($s_data[use_html2]) $use_html2=" checked ";

	} elseif(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",$s_data[memo],$c_match)) {
		$c_org = $c_match[1];
		$c_depth = $c_match[2];
	} else {
		$c_org = 0;
		$c_depth = 0;
	}

	// textarea 태그가 들어있을시 깨짐 방지
	$memo=str_replace("<","&lt;",$memo);

	// 비밀글 체크박스 처리
	if($mode=="modify"&&!$o_data[is_secret]&&$s_data[is_secret])
		$secret=" checked ";
	elseif(($mode=="modify"&&$o_data[is_secret])||($mode!="modify"&&$s_data[is_secret]))
		$secret=" checked disabled";

	// 회원일때는 기본 입력사항 안보이게;;
	if($member[no]) { $hide_start="<!--"; $hide_end="-->"; }

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
	if($mode!="modify"||!$s_data[use_html2]) $value_use_html2 = 1;
	else $value_use_html2=$s_data[use_html2];
	$use_html2 .= " value='$value_use_html2' onclick='check_use_html2(this)'><ZeroBoard";

	// 비밀글 사용;;
	if(!$setup[use_secret]||$mode!="modify"&&$s_data[ismember]=="0"||$mode=="modify"&&$o_data[ismember]=="0") { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

	// 회원로그인이 되어 있으면 코멘트 비밀번호를 안 나타나게;;
	if($member[no]) {
		$c_name=$member[name]; $hide_c_password_start="<!--"; $hide_c_password_end="-->"; 
		$temp_name = get_private_icon($member[no], "2");
		if($temp_name) $c_name="<img src='$temp_name' border=0 align=absmiddle>";
		$temp_name = get_private_icon($member[no], "1");
		if($temp_name) $c_name="<img src='$temp_name' border=0 align=absmiddle>".$c_name;
	} elseif($mode=="modify") $c_name="<input type=text id=name name=name size=8 maxlength=10 class=input value=\"".$name."\" onkeyup='ajaxLoad2()'>";
	else $c_name="<input type=text id=name name=name size=8 maxlength=10 class=input onkeyup='ajaxLoad2()'>";

	// 이미지 창고 버튼
	if($member[no]&&$setup[grant_imagebox]>=$member[level]) $a_imagebox="<a onfocus=blur() href='javascript:showImageBox(\"$id\")'>"; else $a_imagebox="<Zeroboard ";
	if($mode=="modify"&&$s_data[ismember]!=$member[no]) $a_imagebox = "<Zeroboard";

	// 코드삽입 버튼
	if($setup[use_html]>0) $a_codebox="<a onfocus=blur() href='javascript:showCodeBox()'>"; else $a_codebox="<Zeroboard ";

	// 미리보기 버튼
	$a_preview="<a onfocus=blur() href='#' onclick='javascript:return view_preview();'>";

	// 각 스킨 디렉토리 comment.php 인클루드
	$_skinTimeStart = getmicrotime();
	include $dir."/comment.php";
	$_skinTime += getmicrotime()-$_skinTimeStart;

} else {
?>
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
<form name="myform" method="post" action="comment.php">
<input type=hidden name="page" value="<?=$page?>"><input type=hidden name="id" value="<?=$id?>"><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value="<?=$select_arrange?>"><input type=hidden name=desc value="<?=$desc?>"><input type=hidden name=page_num value="<?=$page_num?>"><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>"><input type=hidden name=c_no value=<?=$c_no?>>
<table width=320 height=100 border=0 cellpadding=1 cellspacing=0 bgcolor=#FFFFFF align=center>
<tr>
	<td>
		<table width=100% height=100% border=1 style="border-collapse:collapse" bordercolor=gray cellpadding=2 cellspacing=0 align=center>
		<tr class=list0><td align=center><b>스팸방지 비번(<font color=red>gg</font>)을 입력: </span></b><br><input type=password name=pwd size=20 class=input></td>
		</tr>
		<tr class=list0><td align=center><input type=button value=" 확 인 " onClick="javascript:sendit()"></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</form>
<? 
}

foot();

$_skinTimeStart = getmicrotime();
include "_foot.php";
$_skinTime += getmicrotime()-$_skinTimeStart;
?>