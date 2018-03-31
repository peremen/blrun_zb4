<?

	if($_list_check_included) return;
	$_list_check_included = true;

/*********************************************************************************************
 * �Ѱ����� ����Ÿ�� ���� �ϰ� ����
 ********************************************************************************************/

function list_check(&$data,$view_check=0) {

	global 	$keyword, $sn, $ss, $sc, $setup, $member, $href, $href2, $id, $dir, $category_data, $is_admin, $_zbResizeCheck,
			$name,$email,$subject, $a_keyword, $sort, $prev_no, $no,$homepage, $memo, $hit, $vote, $ip, $comment_num, $sitelink1, $sitelink2,
			$file_name1, $file_name2, $file_download1, $file_download2, $file_size1, $file_size2,
			$upload_image1, $upload_image2, $category_name, $date, $reg_date, $insert, $icon, $face_image,$number,$loop_number,
			$a_file_link1, $a_file_link2, $a_reply, $a_delete, $a_modify, $zbLayer, $_zbCheckNum,
			$_listCheckTime;

	$_listCheckTimeStart = getmicrotime();

	if($view_check) $setup[only_board]=0;

	// ���� 5�ٷ� ���� ����
	if($setup[use_status]) {
		$tmpData = explode("\n",strip_tags(stripslashes($data[memo])));
		$totalCommentLineNum = count($tmpData);
		$tmpData_Count = $totalCommentLineNum;
		$showCommentStr = "";
		$strCnt=0;
		for($i=0;$i<$tmpData_Count;$i++) {
			$tmpStr = trim($tmpData[$i]);
			for($j=0;$j<strlen($tmpStr);$j++) {
				$strCnt++;
				if($strCnt>500) break;
				$showCommentStr .= substr($tmpStr,$j,1);
			}
		}
		if($strCnt>500) $cntStr="...\n\n500 characters more...";
		else $cntStr="\n\n$strCnt characters";

		$showCommentStr_tail.="$cntStr (total : $totalCommentLineNum lines)";
		$showCommentStr = str_replace("'","",$showCommentStr);
		$showCommentStr = str_replace("\"","",$showCommentStr);
		$showCommentStr .= $showCommentStr_tail;
	}	

	$_zbCount = check_zbLayer($data);
	
	// HTML ����� ��� ���� ȸ���� admin ������ �͸����ڶ�� style �Ӽ��� ����
	/*if($data[use_html]&&$data[islevel]=="0") {
		$style_pattern = "/(<[^>]*?)style([^>]*?)(>)/i";
		$data[memo]=preg_replace($style_pattern,"\\1\\3",$data[memo]);
	}*/

	// ' ���� Ư�����ڶ����� ���� \(��������)�� �����
	$name=$data[name]=stripslashes($data[name]); 
	$temp_name = get_private_icon($data[ismember], "2");
	if($temp_name) $name="<img src='$temp_name' border=0 align=absmiddle>"; 

	$subject=$data[subject]=stripslashes($data[subject]); // ����
	$subject_all=strip_tags(str_replace("\"","'",$subject));
	$subject=cut_str($subject,$setup[cut_length]); // ���� �ڸ��� �κ�

	// �˻�� �ش��ϴ� ���ڸ� ���������� �ٲپ���;;
	if($keyword) {
		$keyword_pattern = "/".str_replace("\0","\\0",preg_quote($keyword,"/"))."/i";
		if($sn=="on") $name = preg_replace($keyword_pattern, "<span style='color:#FF001E;background-color:#FFF000;'>$keyword</span>", $name);
		if($ss=="on") $subject = preg_replace($keyword_pattern, "<span color='FF001E' style='color:#FF001E;background-color:#FFF000;'>$keyword</span>", $subject);
	}

	if($data[file_name1]||$data[file_name2]) $subject = $subject." <img src='images/ico_file.gif' border=0>";

	$hit=$data[hit];  // ��ȸ��
	$vote=$data[vote];  // ��ǥ��
	$comment_num="[".$data[total_comment]."]"; // ������ ��� ��
	if($data[total_comment]==0) $comment_num="";
	if($setup[use_alllist]) $view_file="zboard.php"; else $view_file="view.php";
	// ���� ��ũ �Ŵ� �κ�;
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
		$homepage=$data[homepage]=stripslashes($data[homepage]);
		if($homepage) $homepage="<a href='$homepage' target=_blank>$homepage</a>";
		$data[memo]=stripslashes($data[memo]);

		// �̹��� �ڽ� �ؼ� �� ������¡, Ȯ�뺸�⸦ ���ؼ� ����ǥ���� ���
		if($data[ismember]) {
			$imageBoxPattern = "/\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i";
			$imageBoxPattern2 = "/\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,/e";
			$data[memo]=preg_replace($imageBoxPattern2,"'[img:'.str_replace('%2F', '/', urlencode('\\1.\\2')).','",$data[memo]);
			$data[memo]=preg_replace($imageBoxPattern,"<img src='icon/member_image_box/$data[ismember]/\\1.\\2' name=zb_target_resize style=\"cursor:pointer\" onclick=\"javascript: var IMG = new Image(); IMG.src = 'icon/member_image_box/$data[ismember]/\\1.\\2'; var w = IMG.width; var h = IMG.height; window.open('img_view.php?img=icon/member_image_box/$data[ismember]/\\1.\\2&width='+(w+10)+'&height='+(h+55),'imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\" align='\\3' width='\\4' height='\\5' vspace='\\6' hspace='\\7' border='\\8'>",$data[memo]);
		}
		$_zbResizeCheck = true;

		if($data[use_html]<2) {
			$memo=$data[memo]=nl2br($data[memo]);

			//���ý����̶���Ʈ ó�� ����
			$codePattern = "#(<pre[^>]*?>|<\/pre>)#si";
			$temp = preg_split($codePattern,$data[memo],-1,PREG_SPLIT_DELIM_CAPTURE);

			for($i=0;$i<count($temp);$i++) {
				$pattern1 = "#<pre[^>]*?>#i";
				if(preg_match($pattern1,$temp[$i])) {
					$temp[$i+1]=preg_replace("#<br \/>|<br>#si","",$temp[$i+1]);
					$i+=1;
				}
			}

			$data[memo]="";

			for($i=0;$i<count($temp);$i++) {
				$data[memo] = $data[memo].$temp[$i];
			}
			//���ý����̶���Ʈ ó�� ��
		}
		$memo=$data[memo];

		// �ڵ���ũ �Ŵ� �κ�;;
		if($setup[use_autolink]&&!preg_match("/url\(/i",$memo)) $memo=autolink($memo);

		$memo .= "<!--\"<-->";

		// �˻�� ������� ������ Ű���带 ����
		if($sc=="on" && $keyword) {
			$keyword_pattern = "/".str_replace("\0","\\0",preg_quote($keyword,"/"))."/i";
			$memo = preg_replace($keyword_pattern, "<span style='color:#FF001E;background-color:#FFF000;'>$keyword</span>", $memo);
		}

		// ������
		if($is_admin) $ip="IP Address : ".$data[ip]."&nbsp;";  

		$sitelink1=$data[sitelink1]=stripslashes($data[sitelink1]);
		$sitelink2=$data[sitelink2]=stripslashes($data[sitelink2]);
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

		if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$file_name1)) $upload_image1="<img src=$file_name1_ border=0 name=zb_target_resize style=\"cursor:hand\" onclick=window.open(this.src)><br>";
		elseif(preg_match("#\.(swf|asf|asx|wma|wmv|wav|mid|avi|mpeg|mpg)$#i",$file_name1)) $upload_image1="<embed width=640 height=480 type=application/x-mplayer2 pluginspage=http://www.microsoft.com/windows/mediaplayer/download/default.asp src='$file_name1_' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='0' showcontrols='true' showstatusbar='true'><br>";
		elseif(preg_match("#\.(mp3|mp4|ogg|oga|mov|flv|m4v|f4v|webm|aac|m4a|f4a)$#i",$file_name1)) $upload_image1="<script src='/bbs/jwplayer/jwplayer.js'></script><div id='jwplayer0'>Loading the player ...</div><script>jwplayer('jwplayer0').setup({flashplayer: '/bbs/jwplayer/player.swf', file: '$file_name1_', width: 640, height: 480});</script>";

		if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$file_name2)) $upload_image2="<img src=$file_name2_ border=0 name=zb_target_resize style=\"cursor:hand\" onclick=window.open(this.src)><br>";
		elseif(preg_match("#\.(swf|asf|asx|wma|wmv|wav|mid|avi|mpeg|mpg)$#i",$file_name2)) $upload_image2="<embed width=640 height=480 type=application/x-mplayer2 pluginspage=http://www.microsoft.com/windows/mediaplayer/download/default.asp src='$file_name2_' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='0' showcontrols='true' showstatusbar='true'><br>";
		elseif(preg_match("#\.(mp3|mp4|ogg|oga|mov|flv|m4v|f4v|webm|aac|m4a|f4a)$#i",$file_name2)) $upload_image2="<script src='/bbs/jwplayer/jwplayer.js'></script><div id='jwplayer1'>Loading the player ...</div><script>jwplayer('jwplayer1').setup({flashplayer: '/bbs/jwplayer/player.swf', file: '$file_name2_', width: 640, height: 480});</script>";
	}

	// ī�װ��� �̸��� ����
	if($data[category]&&$setup[use_category]) $category_name=$category_data[$data[category]];
	else $category_name="&nbsp;";

	// �۾� �ð��� ����� �ú��� �� ��ȯ��
	$reg_date="<span title='".date("Y�� m�� d�� H�� i�� s��", $data[reg_date])."'>".date("Y/m/d", $data[reg_date])."</span>";
	$date=date("Y-m-d H:i:s", $data[reg_date]);
	
	// �������� ����ϰ� ���ø޴��� ������ �Ǹ� ���̾����
	if($_zbCount&&$setup[use_formmail]) {
		$name = "<span title=\"$data[name]\" onMousedown=\"ZB_layerAction('zbLayer$_zbCheckNum','visible',event)\" style=cursor:pointer>$name</span>";
	// �������� ������ ��� ������ ���ϸ�ũ
	} else {
		if($data[email]) $name="<a href=\"javascript:void(window.open('open_window.php?mode=m&str=".urlencode(base64_encode($data[email]))."','ZBremote','width=1,height=1,left=1,top=1'))\">$name</a>";
		//$name="<a href=\"javascript:void(window.open('view_info.php?to=$email&id=$id&member_no=$data[ismember]','mailform','width=400,height=510,statusbar=no,scrollbars=yes,toolbar=no'))\">$name</a>";
	}

	// Depth�� ���� ���Ӱ��� ����
	$insert="";
	if($data[depth]>15) $data[depth]=15;
	for($z=0;$z<$data[depth];$z++) $insert .="&nbsp; ";

	$icon=get_icon($data);

	// �̸��տ� �ٴ� ������ ����;;
	$face_image=get_face($data);

	$number=$loop_number;

	// �ٷ� ���� �� ���� ��� ��ȣ�� ���������� �ٲ�
	if($prev_no==$data[no]) $number="<img src=$dir/arrow.gif border=0 align=absmiddle>"; elseif($number!="&nbsp;") $number=$loop_number;

	// ��� ��ư
	if(($is_admin||$member[level]<=$setup[grant_reply])&&$data[headnum]>-2000000000&&$data[headnum]!=-1) $a_reply="<a href='write.php?$href$sort&no=$data[no]&mode=reply'>"; 
	else $a_reply="<Zeroboard";

	// ������ư
	if(($is_admin||$member[level]<=$setup[grant_delete]||$data[ismember]==$member[no]||!$data[ismember])&&!$data[child]) $a_delete="<a href='delete.php?$href$sort&no=$data[no]'>"; 
	else $a_delete="<Zeroboard";

	// ������ư
	if(($is_admin||$member[level]<=$setup[grant_delete]||$data[ismember]==$member[no]||!$data[ismember])) $a_modify="<a href='write.php?$href$sort&no=$data[no]&mode=modify'>"; 
	else $a_modify="<Zeroboard";

	// ���Ը��Ϸ� ����
	$mail=$data[email]="";

	$_listCheckTime += getmicrotime() - $_listCheckTimeStart;
}
?>
