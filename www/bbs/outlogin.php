<?
/*******************************************************************************
 * Zeroboard 4.1 pl2 �ܺ� �α��� ����
 *
 * �� ������ �ܺηα������� ����ҽÿ� ����Ͻø� �˴ϴ�.
 *
 * ������� ������ �����ϴ�.
 *
 * �ܺηα����� ���Ͻô� ������ ���� ��ܿ� ������ ���� �Է��ϼ���
 *
 * <? 
 *   $_zb_url = "http://������/���κ�����/";                 // ���� �� / �� ���ּ���
 *   $_zb_path = "/home/�������̵�/public_html/���κ�����/"; // ���� �� / �� ���ּ���
 *   include $_zb_path."outlogin.php"; 
 * ?>
 * 
 *
 * �׷��� �ܺηα��� ���̳� �α��� ���¸� ǥ���ϰ� �������� ������ ���� �Է��ϼ���
 *
 * <?print_outlogin("��Ų�̸�","�׷��ȣ","��뷹��");?>
 *
 *
 * ������ "/home/���� ���̵�/public_html/���κ��� ���/" ��� ���� ���κ����� ���� ��θ� ��Ÿ���ϴ�.
 * 
 * ������ $_zb_url �� $_zb_path �� �� ���� �ּž� �մϴ�.
 *
 * �����δ� ������ ������ ���� ���� �Ʒ��� �ֽ��ϴ�
 *
 * ���� ���� �ϸ� �α����� �Ǿ������� �α��� ������, �׷��� ���� ��쿡�� �α��� ���� ��Ÿ���ϴ�.
 *
 * �α��� ������ �α��� ���� �����ϽǶ����� ���κ�����/outlogin_skin/ �� �ִ� ������ �����Ͻø� �˴ϴ�.
 *
 * �α��� �Ǿ� �ִ� ���� : logged.html
 * �α��� �� : login.html
 *
 * ���� �� ������ ���� �Ͻø� �˴ϴ�.
 *
 * �׸��� ���� ���ϴ� html ���Ͽ��� ������ ���� ������ ���� �ϰ� ���������� $level ������ �����Ͻø� �˴ϴ�.
 *
 * ��� �Ͻø� 9������ ������ �ش� �������� ������ �����մϴ�.
 *
 * ���� ���� ������ ���÷��� outlogin_skin ���丮���� index.html ������ �������.
 *
 * �ܺηα��� ����� �ٲٽ÷��� outloing_skin ���丮 ���� README.TXT ������ �� �о� �ֽñ� �ٶ��ϴ�.
 *
 *******************************************************************************/
global $member, $_head_php_excuted, $REQUEST_URI, $_zb_lib_included, $HTTP_SESSION_VARS, $total_member_connect, $total_guest_connect;
global $a_member_join, $a_member_modify, $a_member_memo, $member_memo_icon, $memo_on_sound, $a_logout, $a_login, $id, $PHP_SELF, $_outlogin_include;

if(preg_match("/:\/\//i",$_zb_path)||preg_match("/\.\./i",$_zb_path)) $_zb_path ="./";


// outlogin.php ������ include �Ǿ������� üũ
if(!$_outlogin_include) {
	$_outlogin_include = TRUE;
} else {
	return FALSE;
}

// ó���� include �Ǿ����� �ʿ��� ������ include �ϴ� �κ�
if(!$_head_php_excuted&&!$_zb_lib_included) {

	// ���κ��� ���丮 ���� üũ
	if(!file_exists($_zb_path."lib.php")) {
		echo "���κ��� ���丮�� �ƴմϴ�";
		return;
	}

	// _head.php ����
	@include $_zb_path."_head.php";

}

// �ܺηα��� ��� �Լ�
function print_outlogin($skinname = "default", $group_no = 1, $level = "10") {
	global $member, $_head_php_excuted, $REQUEST_URI, $HTTP_SESSION_VARS, $total_member_connect, $total_guest_connect, $_zb_path, $_zb_url;
	global $a_member_join, $a_member_modify, $a_member_memo, $member_memo_icon, $memo_on_sound, $a_logout, $a_login, $id, $PHP_SELF;

	if($level < $member[level]) {
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script>
	alert("������ ȸ���� ���� �����մϴ�");
	history.back();
</script>
<?
		exit;
	}

	// ȸ�� ������ �ִ��� �������� üũ�ؼ� �ش� ��Ų ������ ����
	if(!$member[no]) {

		$f = fopen($_zb_path."script/outlogin_script.php",r);
		$_outlogin_script = fread($f, filesize($_zb_path."script/outlogin_script.php"));
		fclose($f);

		$f = fopen($_zb_path."outlogin_skin/$skinname/login.html",r);
		$_outlogin_data = fread($f, filesize($_zb_path."outlogin_skin/$skinname/login.html"));
		fclose($f);

		$login_img = $_zb_url."outlogin_skin/$skinname/images/i_login.gif";
		$join_img = $_zb_url."outlogin_skin/$skinname/images/i_join.gif";
		$help_img = $_zb_url."outlogin_skin/$skinname/images/i_help.gif";

		$_outlogin_data = str_replace("[action]", $_zb_url."login_check.php",$_outlogin_data);
		$s_url = $REQUEST_URI;
		if($id&&!preg_match("/".$id."/i", $s_url)) {
			if(preg_match("/\?/i",$s_url)) $s_url = $s_url . "&id=$id";
			else $s_url = $s_url . "?id=$id";
		}
		$_outlogin_data = str_replace("[s_url]", urlencode($s_url),$_outlogin_data);

		$aUrl = "?group_no=".$group_no;

		$_outlogin_data = str_replace("[member_join]", "<a href=# onclick=\"window.open('".$_zb_url."member_join.php".$aUrl."','zbMemberJoin','width=560,height=590,toolbars=no,resizable=yes,scrollbars=yes')\"><img src=$join_img border=0></a>",$_outlogin_data);
		$_outlogin_data = str_replace("[login]", "<input type=image src=$login_img border=0>",$_outlogin_data);
		$_outlogin_data = str_replace("[lost_id]", "<a href=# onclick='window.open(\"".$_zb_url."lostid.php\",\"lost_id\",\"width=400,height=200,toolbars=no,autoscrollbars=no\")'><img src=$help_img border=0></a>",$_outlogin_data);

		$_outlogin_data = str_replace("[total_member_connect]",number_format($total_member_connect),$_outlogin_data);
		$_outlogin_data = str_replace("[total_guest_connect]",number_format($total_guest_connect),$_outlogin_data);
		$_outlogin_data = str_replace("[total_connect]",number_format($total_member_connect+$total_guest_connect),$_outlogin_data);
		$_outlogin_data = str_replace("[dir]",$_zb_url."outlogin_skin/$skinname/images/",$_outlogin_data);

		if($group_no) {
			$_outlogin_data = str_replace("</form>","<input type=hidden name=group_no value='$group_no'></form>",$_outlogin_data);
		}

		print $_outlogin_script."\n";
		print $_outlogin_data."\n";

	} else {

		$f = fopen($_zb_path."outlogin_skin/$skinname/logged.html",r);
		$_outlogin_data = fread($f, filesize($_zb_path."outlogin_skin/$skinname/logged.html"));
		fclose($f);

		$memo_on_img = $_zb_url."outlogin_skin/$skinname/images/i_memo_on.gif";
		$memo_off_img = $_zb_url."outlogin_skin/$skinname/images/i_memo_off.gif";
		$logout_img = $_zb_url."outlogin_skin/$skinname/images/i_logout.gif";
		$info_img = $_zb_url."outlogin_skin/$skinname/images/i_info.gif";
		$admin_img = $_zb_url."outlogin_skin/$skinname/images/i_admin.gif";
		$memo_swf = $_zb_url."outlogin_skin/$skinname/images/i_memo.swf";

		if($member[new_memo]) {
			$memo_on_image = "<img src=$memo_on_img border=0 align=absmiddle> ";
			$memo_on_sound_out ="<embed src='$memo_swf' loop='false' width='1' height='1'></embed>"; 
		} else {
			$memo_on_image = "<img src=$memo_off_img border=0 align=absmiddle> ";
		}

		$_outlogin_data = str_replace("[memo]",$memo_on_image,$_outlogin_data);
		$_outlogin_data = str_replace("[name]",$a_member_memo."<b>".del_html($member[name])."</b></a>",$_outlogin_data);
		$_outlogin_data = str_replace("[logout]",$a_logout."<img src=$logout_img border=0></a>",$_outlogin_data);

		$_outlogin_data = str_replace("[info]",$a_member_modify."<img src=$info_img border=0></a>",$_outlogin_data);
		if($member[is_admin]==1||$member[is_admin]==2) $_outlogin_data = str_replace("[admin]","<a href=".$_zb_url."admin.php target=blank><img src=$admin_img border=0></a>",$_outlogin_data);
		else $_outlogin_data = str_replace("[admin]","",$_outlogin_data);
		$_outlogin_data = str_replace("[join_date]",date("Y/m/d",$member[reg_date]),$_outlogin_data);
		$_outlogin_data = str_replace("[level]",$member[level],$_outlogin_data);
		$_outlogin_data = str_replace("[point]",number_format($member[point1]*10+$member[point2]),$_outlogin_data);
		$_outlogin_data = str_replace("[write_num]",number_format($member[point1]),$_outlogin_data);
		$_outlogin_data = str_replace("[write_comment]",number_format($member[point2]),$_outlogin_data);
		$_outlogin_data = str_replace("[total_member_connect]",number_format($total_member_connect),$_outlogin_data);
		$_outlogin_data = str_replace("[total_guest_connect]",number_format($total_guest_connect),$_outlogin_data);
		$_outlogin_data = str_replace("[total_connect]",number_format($total_member_connect+$total_guest_connect),$_outlogin_data);
		$_outlogin_data = str_replace("[dir]",$_zb_url."outlogin_skin/$skinname/images/",$_outlogin_data);
		
		print $_outlogin_data.$memo_on_sound_out ."\n";

	}

	$a_member_join = "<Zeroboard";
	$a_member_modify = "<Zeroboard";
	$a_member_memo = "<Zeroboard";
	$member_memo_icon = "<Zeroboard";
	$memo_on_sound = "";
	$a_logout = "<Zeroboard";
	$a_login = "<Zeroboard";

}

/*******************************************************
 * �ֱٸ�� �����ֱ⸦ ���� �Լ� ����
 ******************************************************/

// �ֱ� �� ��� (�Ϲ� �Խ��� ��)
function print_bbs($skinname, $title, $id, $num=5, $textlen=30, $datetype="Y/m/d") {
	global $_zb_path, $_zb_url, $connect, $t_board, $admin_table;

	if(!$skinname||!$id||!$title) return;

	$str = zReadFile($_zb_path."latest_skin/".$skinname."/main.html");
	if(!$str) { 
		echo "�����Ͻ� $skinname �̶�� �ֱٸ�� ��Ų�� �������� �ʽ��ϴ�<br>";
		return;
	}

	$setup = mysql_fetch_array(mysql_query("select use_alllist from $admin_table where name='$id'"));
	if($setup[use_alllist]) $target = "zboard.php?id=".$id;
	else $target = "view.php?id=".$id;

	$result = mysql_query("select * from $t_board"."_$id where is_secret=0 order by no desc limit $num", $connect) or die(mysql_error());

	$tmpStr = explode("[loop]",$str);
	$header = $tmpStr[0];
	$tmpStr2 = explode("[/loop]",$tmpStr[1]);
	$loop = $tmpStr2[0];
	$footer = $tmpStr2[1];

	// �������� ������ ���鶧 ���
	if(preg_match("/\[notice\_/i",$header)) {
		$data=mysql_fetch_array($result);
		$memo = strip_tags($data[memo]);
		$filename1 = $data[file_name1];
		$filename2 = $data[file_name2];
		if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$filename1))$uploadimage1 = "<img src=".$_zb_url.$filename1." border=0><br>"; else $uploadimage1="";
		if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$filename2))$uploadimage2 = "<img src=".$_zb_url.$filename1." border=0><br>"; else $uploadimage2="";
		$memo = autolink($uploadimage1.$uploadimage2.$memo);
		if($data[ismember]) {
			$imageBoxPattern = "/\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,align\=([a-z]+){0,}\,width\=([0-9]+)\,height\=([0-9]+)\,vspace\=([0-9]+)\,hspace\=([0-9]+)\,border\=([0-9]+)\]/i";
			$memo=preg_replace($imageBoxPattern,"<img src='".$_zb_url."icon/member_image_box/$data[ismember]/\\1.\\2' align='\\3' width='\\4' height='\\5' vspace='\\6' hspace='\\7' border='\\8'>", $memo);
		}
		$subject = del_html(cut_str(strip_tags($data[subject]),$textlen))."</font></b>";
		$date = date($datetype, $data[reg_date]);
		$header = str_replace("[notice_memo]",$memo,$header);
		$header = str_replace("[notice_subject]",$subject,$header);
		$header = str_replace("[notice_date]",$date,$header);
	}

	$main_data = "";
	while($data=mysql_fetch_array($result)) {
		$name = $data[name];
		$sbj_all = $data[subject]=strip_tags($data[subject]);
		$sbj_all = del_html(str_replace("\"","&quot;",$sbj_all));
		$subject = del_html(cut_str($data[subject],$textlen))."</font></b>";
		$date = date($datetype, $data[reg_date]);
		if($data[total_comment]) $comment = "[".$data[total_comment]."]"; else $comment="";

		$main = $loop;
		$main = str_replace("[name]",$name,$main);
		$main = str_replace("[date]",$date,$main);
		$main = str_replace("[subject]","<a href='".$_zb_url.$target."&no=$data[no]' title=\"$sbj_all $comment\">".$subject."</a>",$main);
		$main = str_replace("[comment]",$comment,$main);
		$main_data .= "\n".$main;
	}
	$list = $header.$main_data.$footer;
	$list = str_replace("[title]","<a href='".$_zb_url."zboard.php?id=".$id."'>".$title."</a>",$list);
	$list = str_replace("[dir]",$_zb_url."latest_skin/".$skinname."/images/",$list);

	echo $list;
}

// �ֱ� �������� (�Ϲ� �Խ��� ��)
function print_survey($skinname, $title, $id, $textlen=30) {
	global $_zb_path, $_zb_url, $connect, $t_board, $admin_table, $HTTP_SESSION_VARS;

	if(!$skinname||!$id) return;

	$str = zReadFile($_zb_path."latest_skin/".$skinname."/main.html");
	if(!$str) { 
		echo "�����Ͻ� $skinname �̶�� �ֱٸ�� ��Ų�� �������� �ʽ��ϴ�<br>";
		return;
	}

	$tmpResult = mysql_query("select use_alllist from $admin_table where name='$id'") or die(mysql_error());
	$setup = mysql_fetch_array($tmpResult);
	if($setup[use_alllist]) $target = "zboard.php?id=".$id;
	else $target = "view.php?id=".$id;

	$result = mysql_query("select * from $t_board"."_$id order by headnum,arrangenum limit 1", $connect) or die(mysql_error());
	$tmpData = mysql_fetch_array($result);
	$no = $tmpData[no];
	$headnum = $tmpData[headnum];
	$main_subject="<a href='".$_zb_url.$target."&no=$no'>".del_html(strip_tags($tmpData[subject]))."</a>";
	if($tmpData[vote]) $main_vote = "[�� ".$tmpData[vote]."ǥ]"; else $main_vote="";

	$result = mysql_query("select * from $t_board"."_$id where headnum='$headnum' and arrangenum > 0 order by arrangenum", $connect) or die(mysql_error());

	$tmpStr = explode("[loop]",$str);
	$header = $tmpStr[0];
	$tmpStr2 = explode("[/loop]",$tmpStr[1]);
	$loop = $tmpStr2[0];
	$footer = $tmpStr2[1];

	$main_data = "";
	while($data=mysql_fetch_array($result)) {
		$subject = del_html(cut_str(strip_tags($data[subject]),$textlen))."</font></b>";
		if($data[vote]) $vote = "[".$data[vote]."ǥ]"; else $vote="";
		$main = $loop;
		$main = str_replace("[subject]","<a href='".$_zb_url."apply_vote.php?id=$id&no=$no&sub_no=$data[no]'>".$subject."</a>",$main);
		$main = str_replace("[vote]",$vote,$main);
		$main_data .= "\n".$main;
	}
	$list = $header.$main_data.$footer;
	$list = str_replace("[title]","<a href='".$_zb_url."zboard.php?id=".$id."'>".$title."</a>",$list);
	$list = str_replace("[dir]",$_zb_url."latest_skin/".$skinname."/images/",$list);
	$list = str_replace("[main_subject]",$main_subject,$list);
	$list = str_replace("[main_vote]",$main_vote,$list);

	echo $list;
}

// ������ �̹��� �̾ƿ��� ��Ų
function print_gallery($skinname, $title, $id, $num=10, $xsize=80, $ysize=80, $xnum=10) {
	global $_zb_path, $_zb_url, $connect, $t_board, $admin_table, $HTTP_SESSION_VARS;

	if(!$skinname||!$id) return;

	$str = zReadFile($_zb_path."latest_skin/".$skinname."/main.html");
	if(!$str) { 
		echo "�����Ͻ� $skinname �̶�� �ֱٸ�� ��Ų�� �������� �ʽ��ϴ�<br>";
		return;
	}

	$tmpResult = mysql_query("select use_alllist from $admin_table where name='$id'") or die(mysql_error());
	$setup = mysql_fetch_array($tmpResult);
	if($setup[use_alllist]) $target = "zboard.php?id=".$id;
	else $target = "view.php?id=".$id;

	$result = mysql_query("select * from $t_board"."_$id order by no desc limit $num", $connect) or die(mysql_error());

	$i = 0;
	while($data=mysql_fetch_array($result)) {
		
		if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name1])) $filename = $_zb_url.$data[file_name1];
		elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name2])) $filename = $_zb_url.$data[file_name2];
		else $filename="";

		if($filename) $imgList.="<a href='".$_zb_url.$target."&no=$data[no]'><img src='$filename' border=1 style=border-color:black width=$xsize height=$ysize vspacing=10 hspacing=10></a>";
		else $imgList.="<a href='".$_zb_url.$target."&no=$data[no]'><img src='[dir]t.gif' border=1 style=border-color:black width=$xsize height=$ysize vspacing=10 hspacing=10></a>";
		$i++;
		if($i>=$xnum) {
			$imgList.="<br>";
			$i=0;
		} else {
			$imgList.="&nbsp;";
		}
	}
	$str = str_replace("[title]","<a href='".$_zb_url."zboard.php?id=".$id."'>".$title."</a>",$str);
	$str = str_replace("[img]",$imgList,$str);
	$str = str_replace("[dir]",$_zb_url."latest_skin/".$skinname."/images/",$str);
	echo $str;
}

?>