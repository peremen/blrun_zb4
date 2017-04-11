<?
//set_time_limit(0);
$del_que1 = $del_que2 = null;

/***************************************************************************
* 공통 파일 include
**************************************************************************/
include "_head.php";

// HTML 출력
print "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>\n";

if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)||!$_SESSION['ZBRD_SS_VRS']||$_SESSION['ZBRD_SS_VRS']!=$antispam) Error("정상적으로 글을 수정하여 주시기 바랍니다.");

if($flag != ok) {
	/***************************************************************************
	* 코멘트 수정 진행
	**************************************************************************/

	// 패스워드 addslashes
	if(!get_magic_quotes_gpc()) {
		$password = addslashes($password);
	}

	$pass =$password;
	// 패스워드를 암호화
	if($password) {
		$temp=mysql_fetch_array(mysql_query("select password('$password')"));
		$password=$temp[0];
	}

	// 원본글을 가져옴
	$s_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where no='$c_no'"));

	// 회원일때를 확인;;
	if(!$is_admin&&$member[level]>$setup[grant_delete]) {
		if(!$s_data[ismember]) {
			if($s_data[password]!=$password) Error("비밀번호가 올바르지 않습니다");
		} else {
			if($s_data[ismember]!=$member[no]) Error("비밀번호를 입력하여 주십시요");
		}
	}

	if($s_data[use_html2]<2) {
		$s_data[memo]=str_replace("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;","\t",$s_data[memo]);
		$s_data[memo]=str_replace("&nbsp;&nbsp;","  ",$s_data[memo]);
	}

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
		$result2=@mysql_query("select * from $t_comment"."_$id where no='$c_org'") or error(mysql_error());
		$o_data=mysql_fetch_array($result2);
		if(!$o_data[no]) Error("원본 덧글이 존재하지 않습니다");
	}

	$memo=str_replace("&nbsp;","&amp;nbsp;",trim($memo));

	// textarea 태그가 들어있을시 깨짐 방지
	$memo=str_replace("<","&lt;",$memo);

	if($s_data[file_name1])$s_file_name1="<br>&nbsp;".$s_data[s_file_name1]."이 등록되어 있습니다.<br> <input type=checkbox name=del_file1 value=1> 삭제";
	if($s_data[file_name2])$s_file_name2="<br>&nbsp;".$s_data[s_file_name2]."이 등록되어 있습니다.<br> <input type=checkbox name=del_file2 value=1> 삭제";

	// 자료실 기능을 사용하는지 않하는지 표시;;
	if(!$setup[use_pds]) { $hide_pds_start="<!--";$hide_pds_end="-->";}

	if($s_data[use_html2]) $use_html2=" checked ";
	// 비밀글 체크박스 처리
	if(!$o_data[is_secret]&&$s_data[is_secret])
		$secret=" checked ";
	elseif($o_data[is_secret])
		$secret=" checked disabled";
	// HTML사용 체크버튼
	if($setup[use_html]==0) {
		if(!$is_admin&&$member[level]>$setup[grant_html]) {
			$hide_html_start="<!--";
			$hide_html_end="-->";
		}
	}

	// HTML 사용 체크를 확장시킴
	if(!$s_data[use_html2]) $value_use_html2 = 1;
	else $value_use_html2=$s_data[use_html2];
	$use_html2 .= " value='$value_use_html2' onclick='check_use_html2(this)'><ZeroBoard";

	// 비밀글 사용;;
	if(!$setup[use_secret]||$o_data[ismember]=="0") { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

	// 이미지 창고 버튼
	if($member[no]&&$setup[grant_imagebox]>=$member[level]) $a_imagebox="<a onfocus=blur() href='javascript:showImageBox(\"$id\")'>"; else $a_imagebox="<Zeroboard ";
	if($s_data[ismember]!=$member[no]) $a_imagebox = "<Zeroboard";

	// 미리보기 버튼
	$a_preview="<a onfocus=blur() href='#' onclick='javascript:return view_preview();'>";

	// 코드삽입 버튼
	if($setup[use_html]>0) $a_codebox="<a onfocus=blur() href='javascript:showCodeBox()'>"; else $a_codebox="<Zeroboard ";

	$a_list="<a href=zboard.php?$href$sort>";
	$a_view="<a href=view.php?$href$sort&no=$no>";

	head("onload=unlock() onunload=hideImageBox()","script_comment_modify.php");
?>

<table border=0 cellspacing=1 cellpadding=1 class=line1 width=<?=$width?>>
<tr>
	<td bgcolor=white>
		<table border=0 cellspacing=1 cellpadding=8 width=100% height=120 bgcolor=white>
		<form method=post action="comment_modify_ok.php?flag=ok" onsubmit="return check_submit()" id=write name=write enctype=multipart/form-data>
		<input type=hidden name=page value=<?=$page?>>
		<input type=hidden name=id value=<?=$id?>>
		<input type=hidden name=no value=<?=$no?>>
		<input type=hidden name=select_arrange value=<?=$select_arrange?>>
		<input type=hidden name=desc value=<?=$desc?>>
		<input type=hidden name=page_num value=<?=$page_num?>>
		<input type=hidden name=keyword value="<?=$keyword?>">
		<input type=hidden name=category value="<?=$category?>">
		<input type=hidden name=sn value="<?=$sn?>">
		<input type=hidden name=ss value="<?=$ss?>">
		<input type=hidden name=sc value="<?=$sc?>">
		<input type=hidden name=sm value="<?=$sm?>">
		<input type=hidden name=mode value="<?=$mode?>">
		<input type=hidden name=c_no value=<?=$c_no?>>
		<input type=hidden name=c_org value=<?=$c_org?>>
		<input type=hidden name=c_depth value=<?=$c_depth?>>
		<input type=hidden name=antispam value=<?=$antispam?>>
		<col width=70 align=right style=padding-right:10px></col><col width=></col>
<?if(!$member['no']){?>
		<col width=70 align=right style=padding-right:10px></col><col width=></col>
		<tr>
			<td align=right class=list0><font class=list_eng><b>Name</b></font></td>
			<td align=left class=list1><input type=text id=name name=name <?=size(8)?> maxlength=20 class=input value="<?=trim(htmlspecialchars($s_data[name]))?>" onkeyup="ajaxLoad2()"></td>
		</tr>
		<tr>
			<td align=right class=list0><font class=list_eng><b>Password</b></font></td>
			<td align=left class=list1><input type=password id=password name=password <?=size(8)?> maxlength=20 class=input value="<?=htmlspecialchars(stripslashes($pass))?>" onkeyup="ajaxLoad2()"> 비번을 재입력하면 임시저장이 복원됨</td>
		</tr>
<?}?>
		<tr>
			<td align=right class=list0><font class=list_eng><b>Option</b></font></td>
			<td align=left class=list_eng>
				<?=$hide_html_start?> <input type=checkbox id=use_html2 name=use_html2<?=$use_html2?>> HTML사용<?=$hide_html_end?><?=$hide_secret_start?> <input type=checkbox id=is_secret name=is_secret <?=$secret?> value=1> 비밀글<?=$hide_secret_end?> <font id="state"></font>
			</td>
		</tr>
		<tr>
			<td align=right class=list0 onclick="document.getElementById('memo').rows=document.getElementById('memo').rows+4" style=cursor:pointer><font class=list_eng><b>Comment</b><br>▼</font></td>
			<td width=100% height=100% class=list1>
				<table border=0 cellspacing=2 cellpadding=0 width=100% height=100 style=table-layout:fixed>
				<col width=></col><col width=70></col>
				<tr>
					<td width=100%><textarea id=memo name=memo cols=20 rows=8 class=textarea style=width:100% onkeydown='return doTab(event);' onkeyup="addStroke()"><?=$memo?></textarea></td>
					<td width=70><input type=button class=submit value='임시저장' onclick=autoSave() accesskey="a" style="height:50%"><br><input type=submit class=submit value='수정완료' accesskey="s" style="height:50%"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan=2 class=list1>
				<table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
				<col width=5%></col><col width=45%></col><col width=5%></col><col width=45%></col>
				<tr valign=top>
<?=$hide_pds_start?>
				  <td width=52 align=right><font class=list_eng>Upload #1</font></td>
				  <td align=right class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name1?></td>
				  <td width=52 align=right><font class=list_eng>Upload #2</font></td>
				  <td align=right class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name2?></td>
<?=$hide_pds_end?>
				</tr>
				</table>
			</td>
		</tr>
		</form>
		</table>
	</td>
</tr>
</table>
<div align="left"><?=$a_preview?>미리보기</a> <?=$a_imagebox?>그림창고</a> <?=$a_codebox?>코드삽입</a></div>
<?
	foot();

	// 세션이 초기화되는 버그 때문에 세션변수를 재설정
	$_SESSION['ZBRD_SS_VRS'] = $antispam;

} else {
	// 각종 변수 검사;;
	$name = str_replace("ㅤ","",$name);
	$memo = str_replace("ㅤ","",$memo);

	if(!$member[no]) {
		if(isblank($name)) Error("이름을 입력하셔야 합니다");
		if(isblank($password)) Error("비밀번호를 입력하셔야 합니다");
	} else {
		$password = $member[password];
	}

	if(isblank($memo)) Error("내용을 입력하셔야 합니다");

	// 리플라이 덧글 관련 예약 문자열 검사
	if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",trim($memo))) Error("예약된 문자열은 사용할 수 없습니다");

	// 필터링;; 관리자가 아닐때;;
	if(!$is_admin&&$setup[use_filter]) {
		$filter=explode(",",$setup[filter]);
		$f_memo=preg_replace("#([\_\-\./~@?=%&! ]+)#i","",strip_tags($memo));
		for($i=0;$i<count($filter);$i++)
		if(!isblank($filter[$i])) {
			if(preg_match("#".$filter[$i]."#i",$f_memo)) Error("'$filter[$i]' 은(는) 등록하기에 적합한 단어가 아닙니다");
		}
	}

	// 패스워드 addslashes
	if(!get_magic_quotes_gpc()) {
		$password = addslashes($password);
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
	if(!$s_data[no]) Error("해당 덧글이 존재하지 않습니다!");

	$ismember = $member[no]; // 자동저장 멤버 번호
	// 회원등록이 되어 있을때 이름등을 가져옴;;
	if($member[no]) {
		if($member[no]!=$s_data[ismember]) {
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

	$reg_date=time(); // 현재의 시간구함

	if($c_depth) {
		$memo.="|||".$c_org."|".$c_depth;
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
		@z_unlink("./".$s_data[file_name1]);
		$del_que1=",file_name1='',s_file_name1=''";
		// 빈 파일 폴더 삭제
		if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name1],$out))
			if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
	}
	if($del_file2==1) {
		@z_unlink("./".$s_data[file_name2]);
		$del_que2=",file_name2='',s_file_name2=''";
		// 빈 파일 폴더 삭제
		if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name2],$out))
			if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
	}

	if($file1_size>0&&$setup[use_pds]&&$file1) {
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xE0-\xFF\x80-\xFF\x80-\xFF]+/',$file1_name,$result); // 특수문자가 들어갔는지 조사
		if($result[0]!=$file1_name) Error("한글,영문자,숫자,괄호,공백,+,-,_ 만을 사용할 수 있습니다!"); // 특수 문자가 들어갔으면

		if(!is_uploaded_file($file1)) Error("정상적인 방법으로 업로드 해주세요");
		if($file1_name==$file2_name) Error("같은 파일은 등록할수 없습니다");
		$file1_size=filesize($file1);

		if($setup[max_upload_size]<$file1_size&&!$is_admin) error("첫번째 파일 업로드는 최고 ".GetFileSize($setup[max_upload_size])." 까지 가능합니다");

		// 업로드 금지
		if($file1_size>0) {
			$s_file_name1=$file1_name;
			if(mb_substr($s_file_name1,0,1)=='.'||preg_match("#\.(inc|phtm|htm|shtm|phtml|html|shtml|ztx|php|dot|asp|cgi|pl)$#i",$s_file_name1)) Error("Html, PHP 관련파일은 업로드할수 없습니다");

			// 확장자 검사
			if($setup[pds_ext1]) {
				$temp=explode(".",$s_file_name1);
				$s_point=count($temp)-1;
				$upload_check=$temp[$s_point];
				if(!preg_match("/".$upload_check."/i",$setup[pds_ext1])||!$upload_check) Error("첫번째 업로드는 $setup[pds_ext1] 확장자만 가능합니다");
			}

			$file1=preg_replace("#\\\\#i","\\",$file1);
			$s_file_name1=str_replace(" ","_",$s_file_name1);
			$s_file_name1=str_replace("-","_",$s_file_name1);

			// 디렉토리를 검사함
			if(!is_dir("data/".$id)) {
				@mkdir("data/".$id,0777,true);
				@chmod("data/".$id,0707);
			}

			// 중복파일이 있을때;;
			if(file_exists("data/$id/".$s_file_name1)) {
				@mkdir("data/$id/".$reg_date,0777);
				if(!move_uploaded_file($file1,"data/$id/".$reg_date."/".$s_file_name1)) Error("파일업로드가 제대로 되지 않았습니다");
				$file_name1="data/$id/".$reg_date."/".$s_file_name1;
				@chmod($file_name1,0706);
				@chmod("data/$id/".$reg_date,0707);
			} else {
				if(!move_uploaded_file($file1,"data/$id/".$s_file_name1)) Error("파일업로드가 제대로 되지 않았습니다");
				$file_name1="data/$id/".$s_file_name1;
				@chmod($file_name1,0706);
			}
		}
	}

	if($file2_size>0&&$setup[use_pds]&&$file2) {
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xE0-\xFF\x80-\xFF\x80-\xFF]+/',$file2_name,$result); // 특수문자가 들어갔는지 조사
		if($result[0]!=$file2_name) Error("한글,영문자,숫자,괄호,공백,+,-,_ 만을 사용할 수 있습니다!"); // 특수 문자가 들어갔으면

		if(!is_uploaded_file($file2)) Error("정상적인 방법으로 업로드 해주세요");
		$file2_size=filesize($file2);
		if($setup[max_upload_size]<$file2_size&&!$is_admin) error("파일 업로드는 최고 ".GetFileSize($setup[max_upload_size])." 까지 가능합니다");
		if($file2_size>0) {
			$s_file_name2=$file2_name;
			if(mb_substr($s_file_name2,0,1)=='.'||preg_match("#\.(inc|phtm|htm|shtm|phtml|html|shtml|ztx|php|dot|asp|cgi|pl)$#i",$s_file_name2)) Error("Html, PHP 관련파일은 업로드할수 없습니다");

			// 확장자 검사
			if($setup[pds_ext2]) {
				$temp=explode(".",$s_file_name2);
				$s_point=count($temp)-1;
				$upload_check=$temp[$s_point];
				if(!preg_match("/".$upload_check."/i",$setup[pds_ext2])||!$upload_check) Error("업로드는 $setup[pds_ext2] 확장자만 가능합니다");
			}

			$file2=preg_replace("#\\\\#i","\\",$file2);
			$s_file_name2=str_replace(" ","_",$s_file_name2);
			$s_file_name2=str_replace("-","_",$s_file_name2);

			// 디렉토리를 검사함
			if(!is_dir("data/".$id)) {
				@mkdir("data/".$id,0777,true);
				@chmod("data/".$id,0707);
			}

			// 중복파일이 있을때;;
			if(file_exists("data/$id/".$s_file_name2)) {
				@mkdir("data/$id/".$reg_date,0777);
				if(!move_uploaded_file($file2,"data/$id/".$reg_date."/".$s_file_name2)) Error("파일업로드가 제대로 되지 않았습니다");
				$file_name2="data/$id/".$reg_date."/".$s_file_name2;
				@chmod($file_name2,0706);
				@chmod("data/$id/".$reg_date,0707);
			} else {
				if(!move_uploaded_file($file2,"data/$id/".$s_file_name2)) Error("파일업로드가 제대로 되지 않았습니다");
				$file_name2="data/$id/".$s_file_name2;
				@chmod($file_name2,0706);
			}
		}
	}

	/***************************************************************************
	 * 수정글일때-덧글 수정 관련
	 **************************************************************************/
	if($s_data[ismember]) {
		if(!$is_admin&&$member[level]>$setup[grant_delete]&&$s_data[ismember]!=$member[no]) Error("정상적인 방법으로 수정하세요");
	}

	// 파일등록
	if($file_name1) {$del_que1=",file_name1='$file_name1',s_file_name1='$s_file_name1'";}
	if($file_name2) {$del_que2=",file_name2='$file_name2',s_file_name2='$s_file_name2'";}

	// 관리자 수정 권한땐 패스워드를 업데이트 시키지 않는다
	if(!$is_admin&&$member[level]>$setup[grant_delete])
		$ps_str="password='$password',";
	else
		$ps_str="";

	$query = "update $t_comment"."_$id set ".$ps_str."name='$name',memo='$memo',use_html2='$use_html2',is_secret='$is_secret' $del_que1 $del_que2 where no = '$c_no'";
	$result = mysql_query($query,$connect);

	// 임시 저장 정보 삭제
	if($mode=="modify") mysql_query("delete from $comment_imsi_table where bname='$id' and cno='$c_no' and parent='$no' and ismember='$ismember' and name='$member[name]'");

	if($result) {
		// 보안을 위해 세션변수 삭제
		unset($_SESSION['ZBRD_SS_VRS']);
		// 페이지 이동
		if($setup[use_alllist]) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category");
		else movepage("view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category");
	}
	else {
		echo "<script>alert('코멘트 수정실패');</script>";
		unset($_SESSION['ZBRD_SS_VRS']);
	}
}
?>
