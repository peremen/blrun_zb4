<?
$pass = $_POST["pwd"];
$pass = stripslashes($pass);
/***************************************************************************
 * ���� ���� include
 **************************************************************************/
include "_head.php";

if($pass == "gg" || $member[no]) {

/***************************************************************************
 * �Խ��� ���� üũ
 **************************************************************************/

 	if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)) Error("���������� ���� �ۼ��Ͽ� �ֽñ� �ٶ��ϴ�.");

	if(preg_match("/:\/\//i",$dir)) $dir=".";
// ���Թ��� ���� ���Ǻ��� ������ Mode���� �α��� ������ �Ѱܹޱ� ����
	if($member[no]) {
		$mode = $HTTP_GET_VARS[mode];
		$WRT_SPM_PWD = "gg";
	} else {
		$mode = $HTTP_POST_VARS[mode];
		$WRT_SPM_PWD = $pass;
	}
	session_register("WRT_SPM_PWD");

// ������ �� ���ڸ� �߻�(1-8) �� ���Ǻ����� ����
	$wnum1 = rand(1,8);
	$wnum2 = rand(1,8);
	$wnum1num2 = $wnum1*10 + $wnum2;
	session_register("wnum1num2");
	//�۾��� ������ ���� ���Ǻ����� ����
	$WRT_SS_VRS = $wnum1num2;
	session_register("WRT_SS_VRS");

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
	if(($mode=="reply"||$mode=="modify")&&$no) {
		$result=@mysql_query("select * from $t_board"."_$id where no='$no'") or error(mysql_error());
		unset($data);
		$data=mysql_fetch_array($result);
		if(!$data[no]) Error("�������� �������� �ʽ��ϴ�");
	}

// ���� ���϶� ���� üũ
	if($mode=="modify"&&$data[ismember]) {
		if($data[ismember]!=$member[no]&&!$is_admin&&$member[level]>$setup[grant_delete]) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");
	}

// �����ۿ��� ����� �� �޸��� ó��
	if($mode=="reply"&&$data[headnum]<=-2000000000) Error("�����ۿ��� ����� �޼� �����ϴ�");

// ī�װ� ����Ÿ ������;;
	$category_result=mysql_query("select * from $t_category"."_$id order by no");

// ī�װ� ����Ÿ ���� ����;;
	if($setup[use_category]) {
		$category_kind="<select name=category><option>Category</option>";

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
	$name=$HTTP_SESSION_VARS["zb_writer_name"];
	$email=$HTTP_SESSION_VARS["zb_writer_email"];
	$homepage=$HTTP_SESSION_VARS["zb_writer_homepage"];

/******************************************************************************************
 * �۾��� ��忡 ���� ���� üũ
 *****************************************************************************************/
	if($data[use_html]<2) {
		$data[memo]=str_replace("&nbsp;&nbsp;&nbsp;&nbsp;","\t",$data[memo]);
		$data[memo]=str_replace("&nbsp;&nbsp;","  ",$data[memo]);
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

		// ��б��̰� �н����尡 Ʋ���� �����ڰ� �ƴϸ� ����
		if($data[is_secret]&&!$is_admin&&$data[ismember]!=$member[no]&&$HTTP_SESSION_VARS[zb_s_check]!=$setup[no]."_".$no) error("�������� ������� �����ϼ���");

			$name=stripslashes($data[name]); // �̸�
			$email=stripslashes($data[email]); // ����
			$homepage=stripslashes($data[homepage]); // Ȩ������ 
			$subject=$data[subject]=stripslashes($data[subject]); // ����
			$subject=str_replace("\"","&quot;",$subject);
			$homepage=str_replace("\"","&quot;",$homepage);
			$name=str_replace("\"","&quot;",$name);
			$sitelink1=str_replace("\"","&quot;",$sitelink1);
			$sitelink2=str_replace("\"","&quot;",$sitelink2);
			$memo=str_replace("&nbsp;","&amp;nbsp;",stripslashes($memo)); // ����
			$sitelink1=$data[sitelink1]=stripslashes($data[sitelink1]);
			$sitelink2=$data[sitelink2]=stripslashes($data[sitelink2]);
			if($data[file_name1])$file_name1="<br>&nbsp;".$data[s_file_name1]."�� ��ϵǾ� �ֽ��ϴ�. <input type=checkbox name=del_file1 value=1> ����";
			if($data[file_name2])$file_name2="<br>&nbsp;".$data[s_file_name2]."�� ��ϵǾ� �ֽ��ϴ�. <input type=checkbox name=del_file2 value=1> ����";

			if($data[use_html]) $use_html=" checked ";

			if($data[reply_mail]) $reply_mail=" checked ";
			if($data[is_secret]) $secret=" checked ";
			if($data[headnum]<=-2000000000) $notice=" checked ";

	// ����϶� ����� ���� ����;;
	} elseif($mode=="reply") {

		// ��б��̰� �н����尡 Ʋ���� �����ڰ� �ƴϸ� ����
		if($data[is_secret]&&!$is_admin&&$data[ismember]!=$member[no]&&$HTTP_SESSION_VARS[zb_s_check]!=$setup[no]."_".$no) error("�������� ������� ����� �ټ���");

		if($data[is_secret]) $secret=" checked ";

		$subject=$data[subject]=stripslashes($data[subject]); // ����
		$subject=str_replace("\"","&quot;",$subject);
		$sitelink1=str_replace("\"","&quot;",$sitelink1);
		$sitelink2=str_replace("\"","&quot;",$sitelink2);
		$memo=str_replace("&nbsp;","&amp;nbsp;",stripslashes($data[memo])); // ����
		if(!preg_match("/\[re\]/i",$subject)) $subject="[re] ".$subject; // ����϶��� �տ� [re] ����;;
		$memo=str_replace("\n","\n>",$memo);
		$memo="\n\n>".$memo."\n";
		$title="$name���� �ۿ� ���� ��۾���";
	}


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

// HTML ��� 

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
<title>��ȣ�Է� ������</title>
<script language="javascript">
<!--
function sendit() {
	//�н�����
	if(document.myform.pwd.value=="") {
		alert("�н����带 �Է��� �ֽʽÿ�");
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
		<tr><td height="45" align="center"><b><span style="font-size:11pt">�͸� �۾���!!<br>���Թ��� ���(<font color="red">gg</font>)�� �Է�: </span></b><input type="password" name="pwd" size="20"></td>
		</tr>
		<tr><td height="25" align="center"><input type="button" value="Ȯ��" onClick="javascript:sendit();">
		<tr>
		</table>
	</td>
</tr>
</table>
</form>
</body>
</html>
<? } ?>