<?
/***************************************************************************
* ���� ���� include
**************************************************************************/
if(!$_view_included) {include "_head.php";}

/***************************************************************************
* �Խ��� ���� üũ
**************************************************************************/

// ������ üũ
if($setup[grant_view]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&s_url=".urlencode($REQUEST_URI));

// ���� ���õ� ����Ÿ�� ������, �� $no �� ������ ����Ÿ ������
unset($data);
$hide_prev_start=$hide_prev_end=$hide_next_start=$hide_next_end=$hide_sitelink1_start=$hide_sitelink1_end=$hide_sitelink2_start=$hide_sitelink2_end=$hide_download1_start=$hide_download1_end=$hide_download2_start=$hide_download2_end="";
$_dbTimeStart = getmicrotime();
$data=mysql_fetch_array(mysql_query("select * from  $t_board"."_$id  where no='$no'"));
$_dbTime += getmicrotime()-$_dbTimeStart;

$social_ref = urlencode($_zb_url."view.php?$href$sort&no=$no");
if(!$data[no]) Error("�����Ͻ� �Խù��� �������� �ʽ��ϴ�","zboard.php?$href$sort");

// �����۰� ���ı��� ����Ÿ�� ����;
if(!$setup[use_alllist]) {	
	$_dbTimeStart = getmicrotime();
	if($data[prev_no]) $prev_data=mysql_fetch_array(mysql_query("select * from  $t_board"."_$id  where no='$data[prev_no]'"));
	if($data[next_no]) $next_data=mysql_fetch_array(mysql_query("select * from  $t_board"."_$id  where no='$data[next_no]'"));
	$_dbTime += getmicrotime()-$_dbTimeStart;
}

// ��� ��� ���Ⱑ �ƴҶ� ���ñ��� ��� �о��;;
if(!$setup[use_alllist]) {	
	$_dbTimeStart = getmicrotime();
	$check_ref=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where division='$data[division]' and headnum='$data[headnum]'"));
	if($check_ref[0]>1) $view_result=mysql_query("select * from $t_board"."_$id  where division='$data[division]' and headnum='$data[headnum]' order by headnum desc,arrangenum");
	$_dbTime += getmicrotime()-$_dbTimeStart;
}

// ������ ����� ����Ÿ�� �������;;
$_dbTimeStart = getmicrotime();
$view_comment_result=mysql_query("select * from $t_comment"."_$id where parent='$no' order by no asc");
$_dbTime += getmicrotime()-$_dbTimeStart;

// zboard.php���� ��ũ���� ��� ��ġ�� zboard.php�� ����
if(!$_view_included) $target="view.php";
else $target="zboard.php";

// ��б��̰� �н����尡 Ʋ���� �����ڰ� �ƴϸ� ���� ǥ��
if($data[is_secret]&&!$is_admin&&$data[ismember]!=$member[no]&&$member[level]>$setup[grant_view_secret]) {
	if($member[no]) {
		$_dbTimeStart = getmicrotime();
		$secret_check=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where headnum='$data[headnum]' and ismember='$member[no]'"));
		$_dbTime += getmicrotime()-$_dbTimeStart;
		if(!$secret_check[0]) error("��б��� ������ ������ �����ϴ�");
	} else {
		if(!get_magic_quotes_gpc()) {
			$password = addslashes($password);
		}
		$_dbTimeStart = getmicrotime();
		$secret_check=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where headnum='$data[headnum]' and password=password('$password')"));
		$_dbTime += getmicrotime()-$_dbTimeStart;
		if(!$secret_check[0]) {
			head();
			$a_list="<a onfocus=blur() href='zboard.php?$href$sort'>";    
			$a_view="<Zeroboard ";
			$title="�� ���� ��б��Դϴ�.<br>��й�ȣ�� �Է��Ͽ� �ֽʽÿ�";
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

// ������� HIT���� �ø�;;
if(!preg_match("/".$setup[no]."_".$no."/i",$HTTP_SESSION_VARS["zb_hit"])) {
	$_dbTimeStart = getmicrotime();
//  mysql_query("update $t_board"."_$id set hit=hit+1 where no='$no'"); //�Ʒ� 3������
	if ($data[ismember]!=$member[no]) {
		mysql_query("update $t_board"."_$id set hit=hit+1 where no='$no'");
	}
	$_dbTime += getmicrotime()-$_dbTimeStart;
	$hitStr=",".$setup[no]."_".$no;
	
	// 4.0x �� ���� ó��
	$zb_hit=$HTTP_SESSION_VARS["zb_hit"].$hitStr;
	session_register("zb_hit");
}

// ������ ����
if($data[prev_no]&&!$setup[use_alllist]) {
	$prev_comment_num="[".$prev_data[total_comment]."]"; // ������ ��� ��
	if($prev_data[total_comment]==0) $prev_comment_num="";
	$a_prev="<a onfocus=blur() href='".$target."?".$href.$sort."&no=$data[prev_no]'>";
	$prev_subject=$prev_data[subject]=stripslashes($prev_data[subject])." ".$prev_comment_num;
	$prev_name=$prev_data[name]=stripslashes($prev_data[name]);
	$prev_data[email]=stripslashes($prev_data[email]);

	$temp_name = get_private_icon($prev_data[ismember], "2");
	if($temp_name) $prev_name="<img src='$temp_name' border=0 align=absmiddle>";

	if($setup[use_formmail]&&check_zbLayer($prev_data)) {
		$prev_name = "<span $show_ip onMousedown=\"ZB_layerAction('zbLayer$_zbCheckNum','visible',event)\" style=cursor:pointer>$prev_name</span>";
	} else {
		if($prev_data[ismember]) $prev_name="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?id=$id&member_no=$prev_data[ismember]','mailform','width=400,height=510,statusbar=no,scrollbars=yes,toolbar=no'))\" $show_ip>$prev_name</a>";
		else $prev_name="<div $show_ip>$prev_name</div>";
	}

	$prev_hit=stripslashes($prev_data[hit]);
	$prev_vote=stripslashes($prev_data[vote]);
	$prev_reg_date="<span title='".date("Y/m/d H:i:d",$prev_data[reg_date])."'>".date("Y/m/d",$prev_data[reg_date])."</span>";

	if(!isBlank($prev_email)||$prev_data[ismember]) {
		if(!$setup[use_formmail]) $a_prev_email="<a onfocus=blur() href='mailto:$prev_email'>";
		else $a_prev_email="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?to=$prev_email&id=$id&member_no=$prev_data[ismember]','mailform','width=400,height=500,statusbar=no,scrollbars=yes,toolbar=no'))\">";
		$prev_name=$a_prev_email.$prev_name."</a>";
	} 

	$prev="";
	$prev_icon=get_icon($prev_data);

	// �̸��տ� �ٴ� ������ ����;;
	$prev_face_image=get_face($prev_data);

	// ���� ���Ϸ� ������
	$prev_mail=$prev_data[email]="";
	$a_prev_email="<Zeroboard ";
} else {
	$hide_prev_start="<!--";
	$hide_prev_end="-->";
}

// ������ ����
if($data[next_no]&&!$setup[use_alllist]) {
	$a_next="<a onfocus=blur() href='".$target."?".$href.$sort."&no=$data[next_no]'>";
	$next_comment_num="[".$next_data[total_comment]."]"; // ������ ��� ��
	if($next_data[total_comment]==0) $next_comment_num="";
	$next_subject=$next_data[subject]=stripslashes($next_data[subject])." ".$next_comment_num;
	$next_name=$next_data[name]=stripslashes($next_data[name]);
	$next_data[email]=stripslashes($next_data[email]);

	$temp_name = get_private_icon($next_data[ismember], "2");
	if($temp_name) $next_name="<img src='$temp_name' border=0 align=absmiddle>";

	if($setup[use_formmail]&&check_zbLayer($next_data)) {
		$next_name = "<span $show_ip onMousedown=\"ZB_layerAction('zbLayer$_zbCheckNum','visible',event)\" style=cursor:pointer>$next_name</span>";
	} else {
		if($next_data[ismember]) $next_name="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?id=$id&member_no=$next_data[ismember]','mailform','width=400,height=510,statusbar=no,scrollbars=yes,toolbar=no'))\" $show_ip>$next_name</a>";
		else $next_name="<div $show_ip>$next_name</div>";
	}
	
	$next_hit=stripslashes($next_data[hit]);
	$next_vote=stripslashes($next_data[vote]);
	$next_reg_date="<span title='".date("Y/m/d H:i:d",$next_data[reg_date])."'>".date("Y/m/d",$next_data[reg_date])."</span>";
	if(!isBlank($next_email)||$next_data[ismember]) {
		if(!$setup[use_formmail]) $a_next_email="<a onfocus=blur() href='mailto:$next_email'>";
		else $a_next_email="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?to=$next_email&id=$id&member_no=$next_data[ismember]','mailform','width=400,height=500,statusbar=noscrollbars=yes,toolbar=no'))\">";
		$next_name=$a_next_email.$next_name."</a>";
	}

	$next_icon=get_icon($next_data);

	// �̸��տ� �ٴ� ������ ����;;
	$next_face_image=get_face($next_data);

	// ���� ���Ϸ� ������
	$next_mail=$next_data[email]="";
	$a_next_email="<Zeroboard ";
} else {
	$hide_next_start="<!--";
	$hide_next_end="-->";
}


// ���� ���õ� ���� ������
list_check($data,1);

/****************************************************************************************
* ���� ����
***************************************************************************************/

// �ۺ��⿡�� ���� ���� ����
$subject=$data[subject];
if($data[homepage]) $a_homepage="<a onfocus=blur() href='$data[homepage]' target=_blank>"; else $a_homepage="<Zetx"; // Ȩ������ �ּ� ��ũ

/****************************************************************************************
* ��ư ����
***************************************************************************************/

// �����ּҰ� ������ �̸��� ���� ��ũ
if(!isBlank($email)||$data[ismember]) {
	if(!$setup[use_formmail]) $a_email="<a onfocus=blur() href='mailto:$email'>";
	else $a_email="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?to=$email&id=$id&member_no=$data[ismember]','mailform','width=400,height=500,statusbar=no,scrollbars=yes,toolbar=no'))\">";
} else $a_email="<Zeroboard ";

// �۾����ư
if($is_admin||$member[level]<=$setup[grant_write]) $a_write="<a onfocus=blur() href='write.php?$href$sort&no=$no&mode=write&sn1=$sn1'>"; else $a_write="<Zeroboard ";

// ��� ��ư
if(($is_admin||$member[level]<=$setup[grant_reply])&&$no&&$data[headnum]>-2000000000) $a_reply="<a onfocus=blur() href='write.php?$href$sort&no=$no&mode=reply&sn1=$sn1'>"; else $a_reply="<Zeroboard ";

// ��� ��ư
if($is_admin||$member[level]<=$setup[grant_list]) $a_list="<a onfocus=blur() href='zboard.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&prev_no=$no&sn1=$sn1&divpage=$divpage&select_arrange=$select_arrange&desc=$desc'>"; else $a_list="<Zeroboard  ";

// ��ҹ�ư
$a_cancel="<a onfocus=blur() href='$PHP_SELF?id=$id'>";

// ������ư
if(($is_admin||$member[level]<=$setup[grant_delete]||$data[ismember]==$member[no]||!$data[ismember])&&!$data[child]) $a_delete="<a onfocus=blur() href='delete.php?$href$sort&no=$no'>"; else $a_delete="<Zeroboard ";

// ������ư
if(($is_admin||$member[level]<=$setup[grant_delete]||$data[ismember]==$member[no]||!$data[ismember])&&$no) $a_modify="<a onfocus=blur() href='write.php?$href$sort&no=$no&mode=modify'>"; else $a_modify="<Zeroboard ";

// ���ϸ�ũ
if($file_name1) $a_download1="<a onfocus=blur() href='download.php?$href$sort&no=$no&file=1'>"; else $a_download1="<Zeroboard ";
if($file_name2) $a_download2="<a onfocus=blur() href='download.php?$href$sort&no=$no&file=2'>"; else $a_download2="<Zeroboard ";

// ��õ��ư
if(!preg_match("/".$setup[no]."_".$no."/i",$HTTP_SESSION_VARS["zb_vote"])) $a_vote="<a onfocus=blur() href='vote.php?$href$sort&no=$no'>";
else $a_vote="<Zeroboard ";

// Ȩ��ư
$a_home="<a href='/' target=_parent>";

// �̹��� â�� ��ư
if($member[no]&&$setup[grant_imagebox]>=$member[level]) $a_imagebox="<a onfocus=blur() href='javascript:showImageBox(\"$id\")'>"; else $a_imagebox="<Zeroboard ";

// �̸����� ��ư
$a_preview="<a onfocus=blur() href='#' onclick='javascript:return view_preview();'>";

// �ڵ���� ��ư
if($setup[use_html]>0) $a_codebox="<a onfocus=blur() href='javascript:showCodeBox()'>"; else $a_codebox="<Zeroboard ";

// bit.ly ��ư
$a_bitly="<a href='bitly.php?social_ref=$social_ref' target=_blank>";

// ����Ʈ ��ũ�� ��Ÿ���� �ϴ� ����;;
if(!$sitelink1) {$hide_sitelink1_start="<!--";$hide_sitelink1_end="-->";}
if(!$sitelink2) {$hide_sitelink2_start="<!--";$hide_sitelink2_end="-->";}

// ���� �ٿ�ε带 ��Ÿ���� �ϴ� ����;;
if(!$file_name1) {$hide_download1_start="<!--";$hide_download1_end="-->";}
if(!$file_name2) {$hide_download2_start="<!--";$hide_download2_end="-->";}

// Ȩ�������� ��Ÿ���� �ϴ� ����
if(!$data[homepage]) {$hide_homepage_start="<!--";$hide_homepage_end="-->";}

// E-MAIL �� ��Ÿ���� �ϴ� ����
if(!$data[email]) {$hide_email_start="<!--";$hide_email_end="-->";}

// �ڷ�� ����� ����ϴ��� ���ϴ��� ǥ��;;
if(!$setup[use_pds]) { $hide_pds_start="<!--";$hide_pds_end="-->";}

// ��б� ���;;
if(!$setup[use_secret]||$data[ismember]=="0") { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

// �ڸ�Ʈ�� �� ���̰� �ϴ� ����;;
if(!$setup[use_comment])
{$hide_comment_start="<!--"; $hide_comment_end="-->";}

// ȸ���α����� �Ǿ� ������ �ڸ�Ʈ ��й�ȣ�� �� ��Ÿ����;;
if($member[no]) {
	$c_name=$member[name]; $hide_c_password_start="<!--"; $hide_c_password_end="-->"; 
	$temp_name = get_private_icon($member[no], "2");
	if($temp_name) $c_name="<img src='$temp_name' border=0 align=absmiddle>";
	$temp_name = get_private_icon($member[no], "1");
	if($temp_name) $c_name="<img src='$temp_name' border=0 align=absmiddle>".$c_name;
} else $c_name="<input type=text id=name name=name size=8 maxlength=10 class=input value=\"".$HTTP_SESSION_VARS["zb_writer_name"]."\">";

/****************************************************************************************
* ���� ��� �κ�
***************************************************************************************/
// ��� ���
if(!$_view_included) head(" onload=unlock() onunload=hideImageBox() ","script_comment.php");

// ��� ��Ȳ �κ� ��� 
if(!$_view_included) {
	$_skinTimeStart = getmicrotime();
	include "$dir/setup.php";
	$_skinTime += getmicrotime()-$_skinTimeStart;
}

// ���뺸�� ���
$_skinTimeStart = getmicrotime();
include $dir."/view.php";
$_skinTime += getmicrotime()-$_skinTimeStart;

$max_depth = 0;
// �ڸ�Ʈ ���;;
if($setup[use_comment]) {
	while($c_data=mysql_fetch_array($view_comment_result)) {
		$comment_name=stripslashes($c_data[name]);
		$temp_name = get_private_icon($c_data[ismember], "2");
		if($temp_name) $comment_name="<img src='$temp_name' border=0 align=absmiddle>";
		$c_data[memo]=trim(stripslashes($c_data[memo]));

		// html �̹��� ��������
		$imagePattern = "#<img(.+?)src=([^>]*?)>#i";
		$imagePattern2 = "#<div align=left><img name=zb_target_resize src=\"skin\/f2plus_gallery_3_0\/images\/emoticon\/([^>]*?)><\/div>#i";
		$c_data[memo]=preg_replace($imagePattern,"<div align=left><img name=zb_target_resize\\1src=\\2></div>",$c_data[memo]);
		$c_data[memo]=preg_replace($imagePattern2,"<img src=\"skin/f2plus_gallery_3_0/images/emoticon/\\1>",$c_data[memo]);

		// �̹��� �ڽ� �ؼ� �� ������¡, Ȯ�뺸�⸦ ���ؼ� ����ǥ���� ���
		if($c_data[ismember]) {
			// ����� �̹��� ���� ó��
			$imagePattern="#\[img\:(.+?)\.(jpg|jpeg|png)\,#i";
			preg_match_all($imagePattern,$c_data[memo],$out3,PREG_SET_ORDER);
			for($i=0;$i<count($out3);$i++) {
				$iview_large="vXL_".$out3[$i][1].".".$out3[$i][2].".jpg";
				$src_img="icon/member_image_box/".$c_data[ismember]."/".$out3[$i][1].".".$out3[$i][2];
				if(file_exists($src_img) && !file_exists($_zb_path."data/$id/thumbnail/".$c_data[ismember]."/".$iview_large)){
					// ����� ���丮 �� �� ȸ���� ���丮 ����
					$error_check=0;
					if(!is_dir($_zb_path."data/$id/thumbnail/".$c_data[ismember]."/")) {
						if(!@mkdir($_zb_path."data/$id/thumbnail/".$c_data[ismember]."/",0777,true)) $error_check+=1;
						if(!@chmod($_zb_path."data/$id/thumbnail/".$c_data[ismember]."/",0707)) $error_check+=2;
					}
					if($error_check==2) echo "<br> ".$_zb_path."data/$id/thumbnail/".$c_data[ismember]."/ ���丮�� ������ 707�� �����ϼ���<br><br>";
					elseif($error_check==3) echo "<br> ".$_zb_path."data/$id/thumbnail/ ���丮 ���� ".$c_data[ismember]."�� ȸ�� ���丮 ������ �����߽��ϴ�.<br> �ش��ο� ���丮�� �������� �ֽð� ������ 707�� �����ϼ���<br><br>";

					thumbnail3(640,$src_img,$_zb_path."data/$id/thumbnail/".$c_data[ismember]."/".$iview_large);
				}
			}

			$imageBoxPattern=array("/\[img\:(.+?)\.(jpg|jpeg|png)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i","/\[img\:(.+?)\.(gif|bmp)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i");
			$imageBoxReplace=array("<img src='data/$id/thumbnail/$c_data[ismember]/vXL_\\1.\\2.jpg' name=zb_target_resize style=\"cursor:pointer\" onclick=\"javascript: window.open('img_view.php?img=icon/member_image_box/$c_data[ismember]/\\1.\\2&width='+(\\4+10)+'&height='+(\\5+55),'imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\" align='\\3' vspace='\\6' hspace='\\7' border='\\8'>","<img src='icon/member_image_box/$c_data[ismember]/\\1.\\2' name=zb_target_resize style=\"cursor:pointer\" onclick=\"javascript: window.open('img_view.php?img=icon/member_image_box/$c_data[ismember]/\\1.\\2&width='+(\\4+10)+'&height='+(\\5+55),'imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\" align='\\3' width='\\4' height='\\5' vspace='\\6' hspace='\\7' border='\\8'>");
			$imageBoxPattern2="/\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,/ie";
			$c_data[memo]=preg_replace($imageBoxPattern2,"'[img:'.str_replace('%2F', '/', urlencode('\\1.\\2')).','",$c_data[memo]);
			$c_data[memo]=preg_replace($imageBoxPattern,$imageBoxReplace,$c_data[memo]);
		}

		if($c_data[use_html2]<2) {
			$c_memo=$c_data[memo]=nl2br($c_data[memo]);

			//���ý����̶���Ʈ ó�� ����
			$codePattern = "#(<pre[^>]*?>|<\/pre>)#si";
			$temp = preg_split($codePattern,$c_data[memo],-1,PREG_SPLIT_DELIM_CAPTURE);

			for($i=0;$i<count($temp);$i++) {
				$pattern1 = "#<pre[^>]*?>#i";
				if(preg_match($pattern1,$temp[$i])) {
					$temp[$i+1]=preg_replace("#<br \/>|<br>#si","",$temp[$i+1]);
					$i+=1;
				} else {
					// �ڵ���ũ �Ŵ� �κ�;;
					if($setup[use_autolink]&&!preg_match("/url\(/i",$temp[$i])) $temp[$i]=autolink($temp[$i]);
				}
			}

			$c_data[memo]="";

			for($i=0;$i<count($temp);$i++) {
				$c_data[memo] = $c_data[memo].$temp[$i];
			}
			//���ý����̶���Ʈ ó�� ��
		}
		$c_memo=$c_data[memo];

		// ���� �ڸ�Ʈ ǥ�� �ҷ��� ó��
		if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",$c_memo,$c_match)) {
			$c_org = $c_match[1];
			$c_depth = $c_match[2];
			if($max_depth<$c_depth) $max_depth=$c_depth;
			$c_memo = str_replace($c_match[0],"",$c_memo);
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
		}

		// �˻�� �ش��ϴ� ���ڸ� ���������� �ٲپ���;;
		if($keyword) {
			$keyword_pattern = "/".str_replace("\0","\\0",preg_quote($keyword,"/"))."/i";
			if($sm=="on" && $sn=="on") $comment_name = preg_replace($keyword_pattern, "<span style='color:#FF001E;background-color:#FFF000;'>$keyword</span>", $comment_name);
			if($sm=="on") $c_memo = preg_replace($keyword_pattern, "<span color='FF001E' style='color:#FF001E;background-color:#FFF000;'>$keyword</span>", $c_memo);
		}

		$c_file_name1=del_html($c_data[s_file_name1]);
		$c_file_name2=del_html($c_data[s_file_name2]);

		//hide ������ ������ �ʱ�ȭ
		$c_hide_download1_start=$c_hide_download1_end=$c_hide_download2_start=$c_hide_download2_end=null;

		// ���� �ٿ�ε带 ��Ÿ���� �ϴ� ����;;
		if(!$c_file_name1) {$c_hide_download1_start="<!--";$c_hide_download1_end="-->";}
		if(!$c_file_name2) {$c_hide_download2_start="<!--";$c_hide_download2_end="-->";}

		$c_file_download1=$c_data[download1];
		$c_file_download2=$c_data[download2];

		if($c_file_name1) {
			$c_file_size1=@GetFileSize(filesize($c_data[file_name1]));
			$c_file_link1="<a href='download_c.php?$href$sort&no=$c_data[no]&parent=$c_data[parent]&filenum=1'>";
		} else {
			$c_file_size1=0;
			$c_file_link1="<Zeroboard";
		}
		if($c_file_name2) {
			$c_file_size2=@GetFileSize(filesize($c_data[file_name2]));
			$c_file_link2="<a href='download_c.php?$href$sort&no=$c_data[no]&parent=$c_data[parent]&filenum=2'>";
		} else {
			$c_file_size2=0;
			$c_file_link2="<Zeroboard";
		}
  
		$c_upload_image1=$c_upload_image2="";
		$c_file_name1_ = str_replace("%2F", "/", urlencode($c_data[file_name1]));
		$c_file_name2_ = str_replace("%2F", "/", urlencode($c_data[file_name2]));

		if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$c_file_name1)) {
			$img_info3=getimagesize($c_data[file_name1]); //���� ���� ���ϱ�
			$img_info3[0]=$img_info3[0]+10;
			$img_info3[1]=$img_info3[1]+55;
			$c_upload_image1="<img src=$c_file_name1_ border=0 name=zb_target_resize style=\"cursor:pointer\"  onclick=\"javascript: window.open('img_view.php?img=$c_data[file_name1]&width=$img_info3[0]&height=$img_info3[1]','imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\"><br>";
		}
		elseif(preg_match("#\.(swf|asf|asx|wma|wmv|wav|mid|avi|mpeg|mpg)$#i",$c_file_name1)) $c_upload_image1="<embed width=640 height=480 type=application/x-mplayer2 pluginspage=http://www.microsoft.com/windows/mediaplayer/download/default.asp src='$c_file_name1_' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='-900' showcontrols='true' showstatusbar='true'><br>";
		elseif(preg_match("#\.(mp3|mp4|ogg|oga|mov|flv|m4v|f4v|webm|aac|m4a|f4a)$#i",$c_file_name1)) $c_upload_image1="<script src='/bbs/jwplayer/jwplayer.js'></script><div id='jwplayer2'>Loading the player ...</div><script>jwplayer('jwplayer2').setup({flashplayer: '/bbs/jwplayer/player.swf', file: '$c_file_name1_', volume: 40, width: 640, height: 480});</script>";

		if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$c_file_name2)) {
			$img_info4=getimagesize($c_data[file_name2]); //���� ���� ���ϱ�
			$img_info4[0]=$img_info4[0]+10;
			$img_info4[1]=$img_info4[1]+55;
			$c_upload_image2="<img src=$c_file_name2_ border=0 name=zb_target_resize style=\"cursor:pointer\"  onclick=\"javascript: window.open('img_view.php?img=$c_data[file_name2]&width=$img_info4[0]&height=$img_info4[1]','imgViewer','width=0,height=0,toolbar=no,scrollbars=no','status=no')\"><br>";
		}
		elseif(preg_match("#\.(swf|asf|asx|wma|wmv|wav|mid|avi|mpeg|mpg)$#i",$c_file_name2)) $c_upload_image2="<embed width=640 height=480 type=application/x-mplayer2 pluginspage=http://www.microsoft.com/windows/mediaplayer/download/default.asp src='$c_file_name2_' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='-900' showcontrols='true' showstatusbar='true'><br>";
		elseif(preg_match("#\.(mp3|mp4|ogg|oga|mov|flv|m4v|f4v|webm|aac|m4a|f4a)$#i",$c_file_name2)) $c_upload_image2="<script src='/bbs/jwplayer/jwplayer.js'></script><div id='jwplayer3'>Loading the player ...</div><script>jwplayer('jwplayer3').setup({flashplayer: '/bbs/jwplayer/player.swf', file: '$c_file_name2_', volume: 40, width: 640, height: 480});</script>";

		$c_reg_date="<span title='".date("Y�� m�� d�� H�� i�� s��",$c_data[reg_date])."'>".date("Y/m/d",$c_data[reg_date])."</span>";
		if($c_data[ismember]) {
			if(($c_data[ismember]==$member[no]||$is_admin||$member[level]<=$setup[grant_delete])&&$member[user_id]!="sprdrg") {
				$a_edit="<a onfocus=blur() href='comment.php?$href$sort&no=$no&c_no=$c_data[no]&mode=modify'>";
				$a_edit2="<a onfocus=blur() href='comment_modify.php?$href$sort&no=$no&c_no=$c_data[no]'>";
				$a_del="<a onfocus=blur() href='del_comment.php?$href$sort&no=$no&c_no=$c_data[no]' style='color:red'>";
			}
			else {
				$a_edit="&nbsp;<Zeroboard ";
				$a_edit2="&nbsp;<Zeroboard ";
				$a_del="&nbsp;<Zeroboard ";
			}
		} else {
			$a_edit="<a onfocus=blur() href='comment.php?$href$sort&no=$no&c_no=$c_data[no]&mode=modify'>";
			$a_edit2="<a onfocus=blur() href='comment_modify.php?$href$sort&no=$no&c_no=$c_data[no]'>";
			$a_del="<a onfocus=blur() href='del_comment.php?$href$sort&no=$no&c_no=$c_data[no]' style='color:red'>";
		}

		// �ڸ�Ʈ ���ö��� ��ư
		if($o_data[ismember]=="") $ismember0="0"; else $ismember0=$o_data[ismember];
		if($c_data[is_secret]&&!$is_admin&&$c_data[ismember]!=$member[no]&&$data[ismember]!=$member[no]&&$ismember0!=$member[no]&&$member[level]>$setup[grant_view_secret])
			$a_comm_r="&nbsp;<Zeroboard ";
		else
			$a_comm_r="<a onfocus=blur() href='comment.php?$href$sort&no=$no&c_no=$c_data[no]&mode=reply'>";

		// �̸��տ� �ٴ� ������ ����;;
		$c_face_image=get_face($c_data);

		if($is_admin) $show_ip=" title='$c_data[ip]' "; else $show_ip="";    

		if($setup[use_formmail]&&check_zbLayer($c_data)) {
			$comment_name = "<span $show_ip onMousedown=\"ZB_layerAction('zbLayer$_zbCheckNum','visible',event)\" style=cursor:pointer>$comment_name</span>";
		} else {
			if($c_data[ismember]) $comment_name="<a onfocus=blur() href=\"javascript:void(window.open('view_info.php?id=$id&member_no=$c_data[ismember]','mailform','width=400,height=510,statusbar=no,scrollbars=yes,toolbar=no'))\" $show_ip>$comment_name</a>";
			else $comment_name="<div $show_ip>$comment_name</div>";
		}

		$_skinTimeStart = getmicrotime();
		include $dir."/view_comment.php";
		$_skinTime += getmicrotime()-$_skinTimeStart;
		flush();
	}
	
	// HTML��� üũ��ư 
	if($setup[use_html]==0) {
		if(!$is_admin&&$member[level]>$setup[grant_html]) { 
			$hide_html_start="<!--";
			$hide_html_end="-->"; 
		}
	}

	// HTML ��� üũ�� Ȯ���Ŵ
	$value_use_html2 = 1;
	$use_html2 = " value='$value_use_html2' onclick='check_use_html2(this)'><ZeroBoard";

	//�̸�����,�׸�â��,�ڵ���� ��ư ����� ���̰� �ϴ� �÷��� ����
	unset($box_view);
	$box_view=false;
	
	if($exec!="view_all"&&$member[level]<=$setup[grant_comment]) {
		$_skinTimeStart = getmicrotime();
		include "view_write_comment.php";
		$_skinTime += getmicrotime()-$_skinTimeStart;
	}
}

// ��, �Ʒ��� ���, �ڸ�Ʈ, ��ư ���
$_skinTimeStart = getmicrotime();
include $dir."/view_foot.php";
$_skinTime += getmicrotime()-$_skinTimeStart;

// ���ñ��� ���
if($check_ref[0]>1) {

	$_skinTimeStart = getmicrotime();
	include "$dir/view_list_head.php";
	$_skinTime += getmicrotime()-$_skinTimeStart;

	while($data=mysql_fetch_array($view_result)) {
		// ����Ÿ ����
		list_check($data);

		if($data[no]==$no) $number="<img src=$dir/arrow.gif border=0>"; else $number="&nbsp;";

		// ����� ����ϴ� �κ�
		$_skinTimeStart = getmicrotime();
		include $dir."/view_list_main.php";
		$_skinTime += getmicrotime()-$_skinTimeStart;
	}

	$_skinTimeStart = getmicrotime();
	include "$dir/view_list_foot.php";
	$_skinTime += getmicrotime()-$_skinTimeStart;
}

// layer ���
if($zbLayer&&!$_view_included) {
	$_skinTimeStart = getmicrotime();
	echo "\n<script>".$zbLayer."\n</script>";
	$_skinTime += getmicrotime()-$_skinTimeStart;
	unset($zbLayer);
}

// ������ �κ� ���
if(!$_view_included) foot($max_depth);

/***************************************************************************
* ������ �κ� include
**************************************************************************/
if(!$_view_included) { 
	$_skinTimeStart = getmicrotime();
	include "_foot.php"; 
	$_skinTime += getmicrotime()-$_skinTimeStart;
}

?>