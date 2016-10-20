<?
if($_list_check_included) return;
$_list_check_included = true;

/*********************************************************************************************
* 넘겨지는 데이타에 대한 일괄 정리
 ********************************************************************************************/

function list_check(&$data,$view_check=0) {

	global 	$keyword, $sn, $ss, $sc, $setup, $member, $href, $href2, $id, $dir, $category_data, $is_admin, $_zbResizeCheck,
			$name,$email,$subject, $a_keyword, $sort, $prev_no, $no,$homepage, $memo, $hit, $vote, $ip, $comment_num, $sitelink1, $sitelink2,
			$file_name1, $file_name2, $file_download1, $file_download2, $file_size1, $file_size2,
			$upload_image1, $upload_image2, $category_name, $date, $reg_date, $insert, $icon, $face_image,$number,$loop_number,
			$a_file_link1, $a_file_link2, $a_reply, $a_delete, $a_modify, $zbLayer, $_zbCheckNum,
			$_listCheckTime, $cnum1num2;

	$_listCheckTimeStart = getmicrotime();

	if($view_check) $setup[only_board]=0;

	// 제목에 5줄로 툴바 만듬
	if($setup[use_status]) {
		$tmpData = explode("\n",del_html(str_replace("\"","&quot;",strip_tags($data[memo]))));
		$totalCommentLineNum = count($tmpData);
		$tmpData_Count = $totalCommentLineNum;
		$showCommentStr = "";
		$strCnt=0;
		for($i=0;$i<$tmpData_Count;$i++) {
			$tmpStr = trim($tmpData[$i]);
			for($j=0;$j<mb_strlen($tmpStr);$j++) {
				$strCnt++;
				if($strCnt>500) break;
				$showCommentStr .= mb_substr($tmpStr,$j,1);
			}
		}
		if($strCnt>500) $cntStr="...\n\n500 characters more...";
		else $cntStr="\n\n$strCnt characters";

		$showCommentStr_tail.="$cntStr (total : $totalCommentLineNum lines)";
		$showCommentStr .= $showCommentStr_tail;
	}
	// email IP 표식 불러와 처리
	if(preg_match("#\|\|\|([0-9.]{1,})$#",$data[email],$c_match)) {
		//$tokenID = $c_match[1];
		$data[email] = str_replace($c_match[0],"",$data[email]);
	}
	$_zbCount = check_zbLayer($data);
	
	// HTML 사용일 경우 현재 데이타 회원의 islevel이 익명사용자/게스트 레벨이라면 style 속성을 제거
	if($data[use_html]&&$data[islevel]>8) {
		$style_pattern = "/(<[^>]*?)style([^>]*?)(>)/i";
		$data[memo]=preg_replace($style_pattern,"\\1\\3",$data[memo]);
	}

	// ' " \ 등의 특수문자때문에 del_html 를 해준다
	$name=$data[name]=del_html(str_replace("\"","&quot;",$data[name])); 
	$temp_name = get_private_icon($data[ismember], "2");
	if($temp_name) $name="<img src='$temp_name' border=0 align=absmiddle>"; 

	$subject=str_replace("\"","&quot;",$data[subject]); // 제목
	$subject_all=strip_tags($subject);
	$subject=cut_str($subject,$setup[cut_length]); // 제목 자르는 부분

	// 검색어에 해당하는 글자를 빨간색으로 바꾸어줌;;
	if($keyword) {
		$keyword_pattern = "/".str_replace("\0","\\0",preg_quote($keyword,"/"))."/i";
		if($sn=="on") $name = preg_replace($keyword_pattern, "<span style='color:#FF001E;background-color:#FFF000;'>$keyword</span>", $name);
		if($ss=="on") $subject = preg_replace($keyword_pattern, "<span color='#FF001E' style='color:#FF001E;background-color:#FFF000;'>$keyword</span>", $subject);
	}

	if($data[file_name1]||$data[file_name2]) $subject = $subject." <img src='images/ico_file.gif' border=0>";

	$hit=$data[hit];  // 조회수
	$vote=$data[vote];  // 투표수
	$comment_num="[".$data[total_comment]."]"; // 간단한 답글 수
	if($data[total_comment]==0) $comment_num="";
	if($setup[use_alllist]) $view_file="zboard.php"; else $view_file="view.php";
	// 제목에 링크 거는 부분;
	if($member[level]<=$setup[grant_view]||$is_admin) {
		//if($setup[use_status]&&!$data[is_secret]) $addShowComment = " onMouseOver=\"showComment('$showCommentStr',true)\" onMouseOut=\"showComment('',false)\" ";
		if($setup[use_status]&&!$data[is_secret]) $addShowComment = " title=\"$showCommentStr $comment_num\" ";
		else $addShowComment = " title=\"$subject_all $comment_num\" ";
		$subject="<a href=\"".$view_file."?$href$sort&no=$data[no]\" $addShowComment >".$subject."</a>";
		if($keyword) 
			$a_keyword="<a href=\"".$view_file."?$href2$sort&no=$data[no]\">";
		else
			$a_keyword="<Zeroboard ";
	}

	if(!$setup[only_board]) {
		$homepage=$data[homepage]=del_html($data[homepage]);
		if($homepage) $homepage="<a href='$homepage' target=_blank>$homepage</a>";

		// html 이미지 리사이즈
		$imagePattern = "#<img(.+?)src=([^>]*?)>#i";
		$imagePattern2 = "#<div align=left><img name=zb_target_resize src=\"skin\/f2plus_gallery_3_0\/images\/emoticon\/([^>]*?)><\/div>#i";
		$data[memo]=preg_replace($imagePattern,"<div align=left><img name=zb_target_resize\\1src=\\2></div>",$data[memo]);
		$data[memo]=preg_replace($imagePattern2,"<img src=\"skin/f2plus_gallery_3_0/images/emoticon/\\1>",$data[memo]);

		// 이미지 박스 해석 및 리사이징, 확대보기를 위해서 정규표현식 사용
		if($data[ismember]) {
			// 썸네일 이미지 관련 처리
			$imagePattern="#\[img\:(.+?)\.(jpg|jpeg|png)\,#i";
			preg_match_all($imagePattern,$data[memo],$out3,PREG_SET_ORDER);
			for($i=0;$i<count($out3);$i++) {
				$iview_large="vXL_".$out3[$i][1].".".$out3[$i][2].".jpg";
				$src_img="icon/member_image_box/".$data[ismember]."/".$out3[$i][1].".".$out3[$i][2];
				if(file_exists($src_img) && !file_exists($_zb_path."data/$id/thumbnail/".$data[ismember]."/".$iview_large)){
					// 썸네일 디렉토리 내 각 회원별 디렉토리 생성
					$error_check=0;
					if(!is_dir($_zb_path."data/$id/thumbnail/".$data[ismember]."/")) {
						if(!@mkdir($_zb_path."data/$id/thumbnail/".$data[ismember]."/",0777,true)) $error_check+=1;
						if(!@chmod($_zb_path."data/$id/thumbnail/".$data[ismember]."/",0707)) $error_check+=2;
					}
					if($error_check==2) echo "<br> ".$_zb_path."data/$id/thumbnail/".$data[ismember]."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
					elseif($error_check==3) echo "<br> ".$_zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$data[ismember]."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

					thumbnail3(640,$src_img,$_zb_path."data/$id/thumbnail/".$data[ismember]."/".$iview_large);
				}
			}

			$imageBoxPattern=array("/\[img\:(.+?)\.(jpg|jpeg|png)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i","/\[img\:(.+?)\.(gif|bmp)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i");
			$imageBoxReplace=array("<img src='data/$id/thumbnail/$data[ismember]/vXL_\\1.\\2.jpg' name=zb_target_resize style=\"cursor:pointer\" onclick=\"javascript: window.open('img_view.php?img=icon/member_image_box/$data[ismember]/\\1.\\2&width='+(\\4+10)+'&height='+(\\5+55),'imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\" align='\\3' vspace='\\6' hspace='\\7' border='\\8'>","<img src='icon/member_image_box/$data[ismember]/\\1.\\2' name=zb_target_resize style=\"cursor:pointer\" onclick=\"javascript: window.open('img_view.php?img=icon/member_image_box/$data[ismember]/\\1.\\2&width='+(\\4+10)+'&height='+(\\5+55),'imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\" align='\\3' width='\\4' height='\\5' vspace='\\6' hspace='\\7' border='\\8'>");
			$imageBoxPattern2="/\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,/ie";
			$data[memo]=preg_replace($imageBoxPattern2,"'[img:'.str_replace('%2F', '/', urlencode('\\1.\\2')).','",$data[memo]);
			$data[memo]=preg_replace($imageBoxPattern,$imageBoxReplace,$data[memo]);
		}
		$_zbResizeCheck = true;

		if($data[use_html]<2) {
			$memo=$data[memo]=nl2br($data[memo]);

			// 신택스하이라이트 처리 시작
			$codePattern = "#(<pre[^>]*?>|<\/pre>)#si";
			$temp = preg_split($codePattern,$data[memo],-1,PREG_SPLIT_DELIM_CAPTURE);

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

			$data[memo]="";

			for($i=0;$i<count($temp);$i++) {
				$data[memo] = $data[memo].$temp[$i];
			}
			// 신택스하이라이트 처리 끝
		}
		$memo=$data[memo];

		// 검색어가 있을경우 내용의 키워드를 변경
		if($sc=="on" && $keyword) {
			$keyword_pattern = "/".str_replace("\0","\\0",preg_quote($keyword,"/"))."/i";
			$memo = preg_replace($keyword_pattern, "<span style='color:#FF001E;background-color:#FFF000;'>$keyword</span>", $memo);
		}

		// $memo의 &를 &amp 로 치환 후 textarea 태그 안의 textarea 태그 깨짐 방지를 위해 < 를 &lt; 로 한번더 치환
		$memo=str_replace("<","&lt;",str_replace("&","&amp;",$memo));

		// view.php 창이 깨지지 않게 하기 위해 조립
		$memo="<div id=MEMOCONT_$data[no]></div><textarea style='display:none' id=MEMOAREA_$data[no]>".$memo."</textarea><script>document.getElementById('MEMOCONT_'+$data[no]).innerHTML = document.getElementById('MEMOAREA_'+$data[no]).value</script>";

		// 스팸아이피 글 일괄삭제와 덧글삭제 보안을 위한 랜덤한 두 숫자를 발생(1-1000) 후 변수에 대입
		$cnum1 = mt_rand(1,1000);
		$cnum2 = mt_rand(1,1000);
		$cnum1num2 = $cnum1*10000 + $cnum2;

		// 아이피
		if($is_admin) $ip="IP Address : <a href='trace_ip.php?keykind=ip&keyword=".$data[ip]."' target='_blank'>".$data[ip]."</a> <a href='#' style='color:red' onclick='javascript: var yn=confirm(\"▶엎질러진 물은 돌이킬 수 없습니다.◀\\n정말로 [$data[name]]님의 전체 게시글/덧글 삭제 후 차단하시겠습니까?\"); if(yn) window.open(\"spam_ip.php?keykind=ip&keyword=$data[ip]&delsec=$cnum1num2\",\"_blank\"); else return false;'>[스팸]</a>&nbsp;";  

		$sitelink1=$data[sitelink1]=del_html($data[sitelink1]);
		$sitelink2=$data[sitelink2]=del_html($data[sitelink2]);
		if($sitelink1)$sitelink1="<a href='$sitelink1' target=_blank>$sitelink1</a>";
		if($sitelink2)$sitelink2="<a href='$sitelink2' target=_blank>$sitelink2</a>";
		$file_name1=del_html($data[s_file_name1]);
		$file_name2=del_html($data[s_file_name2]);
		$file_download1=$data[download1];
		$file_download2=$data[download2];
		if($file_name1) {
			$file_size1=@GetFileSize(filesize($data[file_name1]));
			$a_file_link1="<a href='download.php?$href$sort&no=$data[no]&filenum=1'>";
		} else {
			$file_size1=0;
			$a_file_link1="<Zeroboard";
		}
		if($file_name2) {
			$file_size2=@GetFileSize(filesize($data[file_name2]));
			$a_file_link2="<a href='download.php?$href$sort&no=$data[no]&filenum=2'>";
		} else {
			$file_size2=0;
			$a_file_link2="<Zeroboard";
		}
  
		$upload_image1=$upload_image2="";
		$file_name1_ = str_replace("%2F", "/", urlencode($data[file_name1]));
		$file_name2_ = str_replace("%2F", "/", urlencode($data[file_name2]));

		if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$file_name1)) {
			$img_info1=getimagesize($data[file_name1]); //폭과 높이 구하기
			$img_info1[0]=$img_info1[0]+10;
			$img_info1[1]=$img_info1[1]+55;
			$upload_image1="<img src=$file_name1_ border=0 name=zb_target_resize style=\"cursor:pointer\" onclick=\"javascript: window.open('img_view.php?img=$data[file_name1]&width=$img_info1[0]&height=$img_info1[1]','imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\"><br>";
		}
		elseif(preg_match("#\.(swf|asf|asx|wma|wmv|wav|mid|avi|mpeg|mpg)$#i",$file_name1)) $upload_image1="<embed width=640 height=480 type=application/x-mplayer2 pluginspage=http://www.microsoft.com/windows/mediaplayer/download/default.asp src='$file_name1_' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='-900' showcontrols='true' showstatusbar='true'><br>";
		elseif(preg_match("#\.(mp3|mp4|ogg|oga|mov|flv|m4v|f4v|webm|aac|m4a|f4a)$#i",$file_name1)) $upload_image1="<script src='./jwplayer/jwplayer.js'></script><div id='jwplayer0'>Loading the player ...</div><script>jwplayer('jwplayer0').setup({flashplayer: './jwplayer/player.swf', file: '$file_name1_', volume: 40, width: 640, height: 480});</script>";

		if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$file_name2)) {
			$img_info2=getimagesize($data[file_name2]); //폭과 높이 구하기
			$img_info2[0]=$img_info2[0]+10;
			$img_info2[1]=$img_info2[1]+55;
			$upload_image2="<img src=$file_name2_ border=0 name=zb_target_resize style=\"cursor:pointer\" onclick=\"javascript: window.open('img_view.php?img=$data[file_name2]&width=$img_info2[0]&height=$img_info2[1]','imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\"><br>";
		}
		elseif(preg_match("#\.(swf|asf|asx|wma|wmv|wav|mid|avi|mpeg|mpg)$#i",$file_name2)) $upload_image2="<embed width=640 height=480 type=application/x-mplayer2 pluginspage=http://www.microsoft.com/windows/mediaplayer/download/default.asp src='$file_name2_' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='-900' showcontrols='true' showstatusbar='true'><br>";
		elseif(preg_match("#\.(mp3|mp4|ogg|oga|mov|flv|m4v|f4v|webm|aac|m4a|f4a)$#i",$file_name2)) $upload_image2="<script src='./jwplayer/jwplayer.js'></script><div id='jwplayer1'>Loading the player ...</div><script>jwplayer('jwplayer1').setup({flashplayer: './jwplayer/player.swf', file: '$file_name2_', volume: 40, width: 640, height: 480});</script>";
	}

	// 카테고리의 이름을 구함
	if($data[category]&&$setup[use_category]) $category_name=$category_data[$data[category]];
	else $category_name="&nbsp;";

	// 글쓴 시간을 년월일 시분초 로 변환함
	$reg_date="<span title='".date("Y년 m월 d일 H시 i분 s초", $data[reg_date])."'>".date("Y/m/d", $data[reg_date])."</span>";
	$date=date("Y-m-d H:i:s", $data[reg_date]);
	
	// 폼메일을 사용하고 관련메뉴가 생성이 되면 레이어오픈
	if($_zbCount&&$setup[use_formmail]) {
		$name = "<span title=\"$data[name]\" onMousedown=\"ZB_layerAction('zbLayer$_zbCheckNum','visible',event)\" style=cursor:pointer>$name</span>";
	// 폼메일을 사용안할 경우 무조건 메일링크
	} else {
		if($data[email]) $name="<a href=\"javascript:void(window.open('open_window.php?mode=m&str=".urlencode(base64_encode($data[email]))."','ZBremote','width=1,height=1,left=1,top=1'))\">$name</a>";
		//$name="<a href=\"javascript:void(window.open('view_info.php?to=$email&id=$id&member_no=$data[ismember]','mailform','width=400,height=510,statusbar=no,scrollbars=yes,toolbar=no'))\">$name</a>";
	}

	// Depth에 의한 들임값을 정함
	$insert="";
	if($data[depth]>15) $data[depth]=15;
	for($z=0;$z<$data[depth];$z++) $insert .="&nbsp; ";

	$icon=get_icon($data);

	// 이름앞에 붙는 아이콘 정의;;
	$face_image=get_face($data);

	$number=$loop_number;

	// 바로 전에 본 글인 경우 번호를 아이콘으로 바꿈
	if($prev_no==$data[no]) $number="<img src=$dir/arrow.gif border=0 align=absmiddle>"; elseif($number!="&nbsp;") $number=$loop_number;

	// 답글 버튼
	if(($is_admin||$member[level]<=$setup[grant_reply])&&$data[headnum]>-2000000000&&$data[headnum]!=-1) $a_reply="<a href='write.php?$href$sort&no=$data[no]&mode=reply'>"; 
	else $a_reply="<Zeroboard";

	// 삭제버튼
	if(($is_admin||$member[level]<=$setup[grant_delete]||$data[ismember]==$member[no]||!$data[ismember])&&!$data[child]) $a_delete="<a href='delete.php?$href$sort&no=$data[no]'>"; 
	else $a_delete="<Zeroboard";

	// 수정버튼
	if(($is_admin||$member[level]<=$setup[grant_delete]||$data[ismember]==$member[no]||!$data[ismember])) $a_modify="<a href='write.php?$href$sort&no=$data[no]&mode=modify'>"; 
	else $a_modify="<Zeroboard";

	// 스팸메일러 금지
	$mail=$data[email]="";

	$_listCheckTime += getmicrotime() - $_listCheckTimeStart;
}
?>
