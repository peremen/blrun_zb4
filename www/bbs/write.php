<?
/***************************************************************************
 * ���� ���� include
 **************************************************************************/
include "_head.php";
include("securimage/securimage.php");

if(!empty($_POST['code']) || $member[no] || $password) {

	if(!($member[no] || $password)) {

		// ���Թ����ڵ� üũ ����
		$img = new Securimage();
		$valid = $img->check($_POST['code']);

		if($valid == true) {

		} else {
			Error("���Թ��� �ڵ带 �߸� �Է��ϼ̽��ϴ�.");
		}
	}

/***************************************************************************
 * �Խ��� ���� üũ
 **************************************************************************/

 	if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)) Error("���������� ���� �ۼ��Ͽ� �ֽñ� �ٶ��ϴ�.");

	if(preg_match("/:\/\//i",$dir)) $dir=".";

// ���Թ��� ���� ���Ǻ��� ������ Mode���� �α��� ������ �Ѱܹޱ� ����
	if($member[no]) {
		$mode = $_GET[mode];
	} else {
		$mode = $_POST[mode];
	}

// ������ �� ���ڸ� �߻�(1-1000) �� ������ ����
	$wnum1 = mt_rand(1,1000);
	$wnum2 = mt_rand(1,1000);
	$wnum1num2 = $wnum1*10000 + $wnum2;
	//�۾��� ������ ���� ���Ǻ����� ����
	$_SESSION['WRT_SS_VRS'] = $wnum1num2;

// ���� üũ
	if(!$mode||$mode=="write") {
		$mode = "write";
		unset($no);
	}

// ������ üũ
	if($mode=="reply"&&$setup[grant_reply]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");
	elseif($setup[grant_write]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");
	if($mode=="reply"&&$setup[grant_view]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");

// ����̳� �����϶� �������� ������;;
	if($mode!="write"&&$no) {
		unset($data);
		$_dbTimeStart = getmicrotime();
		$result=@mysql_query("select * from $t_board"."_$id where no='$no'") or error(mysql_error());
		$data=mysql_fetch_array($result);
		$_dbTime += getmicrotime()-$_dbTimeStart;
		$ip_array = explode("|||",$data[memo]);
		if($setup[skinname]!="zero_vote" && substr($ip_array[0],0,9)=="��������|")
			Error("��ǥ ������ ������ �� �����ϴ�.");
		if(!$data[no]) Error("�������� �������� �ʽ��ϴ�");
	}

// ���� ���϶� ���� üũ
	if($mode=="modify"&&$data[ismember]) {
		if($data[ismember]!=$member[no]&&!$is_admin&&$member[level]>$setup[grant_delete]) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");
	}

// ask_password.php���� ����� ��Ÿ���� write.php�� ����
	$target="write.php";

// ��б��̰� �н����尡 Ʋ���� �����ڰ� �ƴϸ� ���� ǥ��
	if($mode!="write"&&$data[is_secret]&&!$is_admin&&$data[ismember]!=$member[no]) {
		if($member[no]) {
			$_dbTimeStart = getmicrotime();
			$secret_check=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where no='$data[no]' and ismember='$member[no]'"));
			$_dbTime += getmicrotime()-$_dbTimeStart;
			if(!$secret_check[0]) error("��б��� ������ ������ �����ϴ�");
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
				$title="�� ���� ��б��Դϴ�.<br>��й�ȣ�� �Է��Ͽ� �ֽʽÿ�";
				$input_password="<input type=password name=password size=20 maxlength=20 class=input>";
				if(preg_match("/:\/\//i",$dir)||preg_match("/\.\./i",$dir)) $dir="./";
				include $dir."/ask_password.php";
				foot();
				exit();
			} else {
				// ������ �ʱ�ȭ�Ǵ� ���� ������ ���Ǻ����� �缳��
				$secret_str = $setup[no]."_".$no;
				$_SESSION['zb_s_check'] = $secret_str;
			}
		}
	}

// �����ۿ��� ����� �� �޸��� ó��
	if($mode=="reply"&&$data[headnum]<=-2000000000) Error("�����ۿ��� ����� �޼� �����ϴ�");

// ī�װ� ����Ÿ ������;;
	$_dbTimeStart = getmicrotime();
	$category_result=mysql_query("select * from $t_category"."_$id order by no");
	$_dbTime += getmicrotime()-$_dbTimeStart;

// ī�װ� ����Ÿ ���� ����;;
	if($setup[use_category]) {
		$category_kind="<select id=category name=category><option value=0>Category</option>";

		while($category_data=mysql_fetch_array($category_result)) {
			if($data[category]==$category_data[no]) $category_kind.="<option value=$category_data[no] selected>$category_data[name]</option>";
			else $category_kind.="<option value=$category_data[no]>$category_data[name]</option>";
		}

		$category_kind.="</select>";
	}

	if($mode=="modify") $title = " �� �����ϱ� ";
	elseif($mode=="reply") $title = " ��� �ޱ� ";
	else $title = " �ű� �۾��� ";

// ��Ű���� �̿�;;
	$name=htmlspecialchars(stripslashes($_SESSION['zb_writer_name']));
	$email=htmlspecialchars(stripslashes($_SESSION['zb_writer_email']));
	$homepage=htmlspecialchars(stripslashes($_SESSION['zb_writer_homepage']));

/******************************************************************************************
 * �۾��� ��忡 ���� ���� üũ
 *****************************************************************************************/
	if($data[use_html]<2) {
		$data[memo]=str_replace("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;","\t",$data[memo]);
		$data[memo]=str_replace("&nbsp;&nbsp;","  ",$data[memo]);
		$data[memo]=preg_replace("#(?m)^&nbsp;(.+)$#i"," \\1",$data[memo]);
	}

	if($mode=="modify") {

		// ���ý����̶���Ʈ ��� ó�� ����
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
		// ���ý����̶���Ʈ ��� ó�� ��

		// ��б��̰� �����ڰ� �ƴϰ� ����� ��ġ���� �ʰ� ���ǰ��� Ʋ���� ����
		if($data[is_secret]&&!$is_admin&&$data[ismember]!=$member[no]&&$_SESSION['zb_s_check']!=$zb_check) error("�������� ������� �����ϼ���");

		$name=htmlspecialchars($data[name]); // �̸�
		$email=htmlspecialchars($data[email]); // ����
		$homepage=htmlspecialchars($data[homepage]); // Ȩ������
		$subject=$data[subject]=htmlspecialchars($data[subject]); // ����
		$memo=str_replace("&nbsp;","&amp;nbsp;",$memo); // ����
		$sitelink1=$data[sitelink1]=htmlspecialchars($data[sitelink1]); // ����Ʈ ��ũ
		$sitelink2=$data[sitelink2]=htmlspecialchars($data[sitelink2]);
		if($data[file_name1])$file_name1="<br>&nbsp;".$data[s_file_name1]."�� ��ϵǾ� �ֽ��ϴ�. <input type=checkbox name=del_file1 value=1> ����";
		if($data[file_name2])$file_name2="<br>&nbsp;".$data[s_file_name2]."�� ��ϵǾ� �ֽ��ϴ�. <input type=checkbox name=del_file2 value=1> ����";

		if($data[use_html]) $use_html=" checked ";

		if($data[reply_mail]) $reply_mail=" checked ";
		if($data[is_secret]) $secret=" checked ";
		if($data[headnum]<=-2000000000) $notice=" checked ";

	// ����϶� ����� ���� ����;;
	} elseif($mode=="reply") {

		// ��б��̰� �����ڰ� �ƴϰ� ����� ��ġ���� �ʰ� ���ǰ��� Ʋ���� ����
		if($data[is_secret]&&!$is_admin&&$data[ismember]!=$member[no]&&$_SESSION['zb_s_check']!=$zb_check) error("�������� ������� ����� �ټ���");

		if($data[is_secret]) $secret=" checked ";

		$subject=$data[subject]=htmlspecialchars($data[subject]); // ����
		$memo=str_replace("&nbsp;","&amp;nbsp;",$data[memo]); // ����
		if(!preg_match("/\[re\]/i",$subject)) $subject="[re] ".$subject; // ����϶��� �տ� [re] ����;;
		$memo=str_replace("\n","\n>",$memo);
		$memo="\n\n>".$memo."\n";
		$title="$name���� �ۿ� ���� ��۾���";
	}

// textarea �±װ� ��������� ���� ����
	$memo=str_replace("<","&lt;",$memo);

// ȸ���϶��� �⺻ �Է»��� �Ⱥ��̰�;;
	if($member[no]) { $hide_start="<!--"; $hide_end="-->"; }

// ����Ʈ ��ũ ����� ������ ��ũ ����� ǥ��;;
	if(!$setup[use_homelink]) { $hide_sitelink1_start="<!--";$hide_sitelink1_end="-->";}
	if(!$setup[use_filelink]) { $hide_sitelink2_start="<!--";$hide_sitelink2_end="-->";}

// �ڷ�� ����� ����ϴ��� ���ϴ��� ǥ��;;
	if(!$setup[use_pds]) { $hide_pds_start="<!--";$hide_pds_end="-->";}

// HTML��� üũ��ư
	if($setup[use_html]==0) {
		if(!$is_admin&&$member[level]>$setup[grant_html]) {
			$hide_html_start="<!--";
			$hide_html_end="-->";
		}
	}

// HTML ��� üũ�� Ȯ���Ŵ
	if($mode!="reply") {
		if(!$data[use_html]) $value_use_html = 1;
		else $value_use_html=$data[use_html];
	} else {
		$value_use_html=1;
	}
	$use_html .= " value='$value_use_html' onclick='check_use_html(this)'><ZeroBoard";

// ��б� ���;;
	if(!$setup[use_secret]) { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

// ������� ����ϴ��� ���ϴ��� ǥ��;;
	if((!$is_admin&&$member[level]>$setup[grant_notice])||$mode=="reply") { $hide_notice_start="<!--";$hide_notice_end="-->"; }

// �ְ� ���ε� ���� �뷮
	if($setup[use_pds]) $upload_limit=GetFileSize($setup[max_upload_size]);

// �̹��� â�� ��ư
	if($member[no]&&$setup[grant_imagebox]>=$member[level]) $a_imagebox="<a onfocus=blur() href='javascript:showImageBox(\"$id\")'>"; else $a_imagebox="<Zeroboard ";
	if($mode=="modify"&&$data[ismember]!=$member[no]) $a_imagebox = "<Zeroboard";

// �ڵ���� ��ư
	if($setup[use_html]>0) $a_codebox="<a onfocus=blur() href='javascript:showCodeBox()'>"; else $a_codebox="<Zeroboard ";

// �̸����� ��ư
	$a_preview="<a onfocus=blur() href='#' onclick='javascript:return view_preview();'>";

// HTML ��� ���
	print "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>\n";
	head("onload=unlock() onunload=hideImageBox()","script_write.php");

// �� ��Ų ���丮 write.php ��Ŭ���
	$_skinTimeStart = getmicrotime();
	include $dir."/write.php";
	$_skinTime += getmicrotime()-$_skinTimeStart;

} else {

	// HTML ��� ���
	print "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>\n";
	head("onload=unlock() onunload=hideImageBox()","script_write.php");
?>
<script language="javascript">
<!--
function sendit() {
	//�н�����
	if(document.myform.code.value=="") {
		alert("���Թ��� �ڵ带 �Է��� �ֽʽÿ�");
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
		<b>�͸�۾��� �ڵ��Է�:</b>
		<!-- NOTE: the "name" attribute is "code" so that $img->check($_POST['code']) will check the submitted form field -->
		<input type="text" name="code" size="12" /><br /><br />
	</td>
</tr>
<tr class=list0>
	<td align=center><input type=button value=" Ȯ �� " onClick="javascript:sendit()"></td>
</tr>
</table>
</form>
<?
}

foot();
?>