<?
@extract($HTTP_GET_VARS); 
@extract($HTTP_POST_VARS); 

//set_time_limit(0);
$del_que1 = $del_que2 = null;

if(!$memo){
	if($_name6==5) $_name7="";
	$memo=$_name1."|||".$_name2."|||".$_name3."|||".$_name4."|||".$_name5."|||".$_name6."|||".$_name7."|||".$_name8."|||".$_name9."|||".$_name10;
}

/***************************************************************************
* ���� ���� include
**************************************************************************/
include $_zb_path."_head.php";

if(file_exists($id."_config.php")){ 
	include $id."_config.php";
}

function Error1($message, $url="") {
	global $setup, $connect, $dir, $_zb_path, $_zb_url;

	$dir=$_zb_url."/skin/".$setup[skinname];
		$message=str_replace("<br>","\\n",$message);
		$message=str_replace("\"","\\\"",$message);
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
		<script>
			<!--
			alert("<?=$message?>");
			history.back(-1);
			//-->
		</script>
	<?
	if($connect) @mysql_close($connect);

	exit;
}
/***************************************************************************
* �Խ��� ���� üũ
**************************************************************************/

// ����� �̿��� �۾��� ����
$mode = $HTTP_POST_VARS[mode];
if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)||$WRT_SS_VRS!=$wantispam||$WRT_SPM_PWD!="gg") Error1("���������� ���� �ۼ��Ͽ� �ֽñ� �ٶ��ϴ�.");
if(getenv("REQUEST_METHOD") == 'GET' ) Error1("���������� ���� ���ñ� �ٶ��ϴ�","");
if(!$mode) $mode = "write";

// ������ üũ
if($mode=="reply"&&$setup[grant_reply]<$member[level]&&!$is_admin) Error1("�������� �����ϴ�","$_zb_url/login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");
elseif($setup[grant_write]<$member[level]&&!$is_admin) Error1("�������� �����ϴ�","$_zb_url/login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");

if(!$is_admin&&$setup[grant_notice]<$member[level]) $notice = 0;

// ���� ���� �˻�;;
if(!$member[no]) {
	if(isblank($name)) Error1("�̸��� �Է��ϼž� �մϴ�");
	if(isblank($password)) Error1("��й�ȣ�� �Է��ϼž� �մϴ�");
	if(!get_magic_quotes_gpc()) {
		$password = addslashes($password);
	}
} else {
	$password = $member[password];
}

$subject = str_replace("��","",$subject);
$memo = str_replace("��","",$memo);
$name = str_replace("��","",$name);

if(isblank($subject)) Error1("������ �Է��ϼž� �մϴ�");
if(isblank($memo)) Error1("������ �Է��ϼž� �մϴ�");

if(!$category) {
	$cate_temp=mysql_fetch_array(mysql_query("select min(no) from $t_category"."_$id",$connect));
	$category=$cate_temp[0];
}

// ���͸�;; �����ڰ� �ƴҶ�;;
if(!$is_admin&&$setup[use_filter]) {
	$filter=explode(",",$setup[filter]);
	$f_memo=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($memo));
	$f_name=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($name));
	$f_subject=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($subject));
	$f_email=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($email));
	$f_homepage=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($homepage));
	for($i=0;$i<count($filter);$i++) {
		if(!isblank($filter[$i])) {
			if(eregi($filter[$i],$f_memo)) Error1("<b>$filter[$i]</b> ��(��) ����ϱ⿡ ������ �ܾ �ƴմϴ�");
			if(eregi($filter[$i],$f_name)) Error1("<b>$filter[$i]</b> ��(��) ����ϱ⿡ ������ �ܾ �ƴմϴ�");
			if(eregi($filter[$i],$f_subject)) Error1("<b>$filter[$i]</b> ��(��) ����ϱ⿡ ������ �ܾ �ƴմϴ�");
			if(eregi($filter[$i],$f_email)) Error1("<b>$filter[$i]</b> ��(��) ����ϱ⿡ ������ �ܾ �ƴմϴ�");
			if(eregi($filter[$i],$f_homepage)) Error1("<b>$filter[$i]</b> ��(��) ����ϱ⿡ ������ �ܾ �ƴմϴ�");
		}
	}
}

// �н����带 ��ȣȭ
if($password) {
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];   
}

// &lt,&gt�� ���ý����̶���Ʈ���� ����ϱ� ���� �ӽ� ġȯ
$memo=str_replace("&lt;","my_lt_ek",$memo);
$memo=str_replace("&gt;","my_gt_ek",$memo);

// �������̰ų� HTML��뷹���� ������ �±��� ���������� üũ
if(!$is_admin&&$setup[grant_html]<$member[level]) {

	// ������ HTML ����;;
	if(!$use_html||$setup[use_html]==0) $memo=del_html($memo);

	// HTML�� �κ�����϶�;;
	if($use_html&&$setup[use_html]==1) {
		$memo=str_replace("<","&lt;",$memo);
		$tag=explode(",",$setup[avoid_tag]);
		for($i=0;$i<count($tag);$i++) {
			if(!isblank($tag[$i])) { 
				$memo=eregi_replace("&lt;".$tag[$i]." ","<".$tag[$i]." ",$memo); 
				$memo=eregi_replace("&lt;".$tag[$i].">","<".$tag[$i].">",$memo); 
				$memo=eregi_replace("&lt;/".$tag[$i],"</".$tag[$i],$memo); 
			}
		}
		// XSS ��ŷ �̺�Ʈ �ڵ鷯 ����
		$xss_pattern1 = "!(<[^>]*?)on(load|click|error|abort|activate|afterprint|afterupdate|beforeactivate|beforecopy|beforecut|beforedeactivate|beforeeditfocus|beforepaste|beforeprint|beforeunload|beforeupdate|blur|bounce|cellchange|change|contextmenu|controlselect|copy|cut|dataavailable|datasetchanged|datasetcomplete|dblclick|deactivate|drag|dragend|dragenter|dragleave|dragover|dragstart|drop|errorupdate|filterchange|finish|focus|focusin|focusout|help|keydown|keypress|keyup|layoutcomplete|losecapture|mousedown|mouseenter|mouseleave|mousemove|mouseout|mouseover|mouseup|mousewheel|move|moveend|movestart|paste|propertychange|readystatechange|reset|resize|resizeend|resizestart|rowenter|rowexit|rowsdelete|rowsinserted|scroll|select|selectionchange|selectstart|start|stop|submit|unload)([^>]*?)(>)!i";
		$xss_pattern2 = "!on(load|click|error|abort|activate|afterprint|afterupdate|beforeactivate|beforecopy|beforecut|beforedeactivate|beforeeditfocus|beforepaste|beforeprint|beforeunload|beforeupdate|blur|bounce|cellchange|change|contextmenu|controlselect|copy|cut|dataavailable|datasetchanged|datasetcomplete|dblclick|deactivate|drag|dragend|dragenter|dragleave|dragover|dragstart|drop|errorupdate|filterchange|finish|focus|focusin|focusout|help|keydown|keypress|keyup|layoutcomplete|losecapture|mousedown|mouseenter|mouseleave|mousemove|mouseout|mouseover|mouseup|mousewheel|move|moveend|movestart|paste|propertychange|readystatechange|reset|resize|resizeend|resizestart|rowenter|rowexit|rowsdelete|rowsinserted|scroll|select|selectionchange|selectstart|start|stop|submit|unload)=!i";
		if(preg_match($xss_pattern1,$memo))
			$memo=preg_replace($xss_pattern1,"\\1\\4",$memo);
		if(preg_match($xss_pattern2,$memo))
			$memo=preg_replace($xss_pattern2,"",$memo);
	}
} else {
	if(!$use_html) {
		$memo=del_html($memo);
	}
}

// ���ý����̶���Ʈ ó�� ����
$codePattern = "#(\[[a-z]+[0-9]?\_code\:[0-9]+\{[^}]*?\}\]|[\/[a-z]+[0-9]?\_code\])#si";
$temp = preg_split($codePattern,$memo,-1,PREG_SPLIT_DELIM_CAPTURE);

for($i=0;$i<count($temp);$i++) {
	for($j=0;$j<count($code);$j++) {
		$pattern1 = "#\[".$code[$j]."\_code\:([0-9]+)\{([^}]*?)\}\]#i";
		$pattern2 = "#\[\/".$code[$j]."\_code\]#i";
		if(preg_match($pattern1,$temp[$i])) {
			if($code[$j]=="php")
				$temp[$i]=preg_replace($pattern1,"<pre class=\"brush: $code[$j]; html_script: true; first-line: \\1\" title=\"\\2\">",$temp[$i]);
			else
				$temp[$i]=preg_replace($pattern1,"<pre class=\"brush: $code[$j]; first-line: \\1\" title=\"\\2\">",$temp[$i]);

			$temp[$i+1]=str_replace("&amp;","&amp;amp;",$temp[$i+1]);
			$temp[$i+1]=str_replace("&#039;","&amp;#039;",$temp[$i+1]);
			$temp[$i+1]=str_replace("&quot;","&amp;quot;",$temp[$i+1]);
			$temp[$i+1]=str_replace("&nbsp;","&amp;nbsp;",$temp[$i+1]);
			$temp[$i+1]=str_replace("my_lt_ek","&amp;lt;",$temp[$i+1]); // &lt ���!
			$temp[$i+1]=str_replace("my_gt_ek","&amp;gt;",$temp[$i+1]); // &gt ���!
			$temp[$i+1]=str_replace("<","&lt;",$temp[$i+1]);
			//$temp[$i+1]=str_replace("\'","&#039;",$temp[$i+1]);
			//$temp[$i+1]=str_replace("\"","&quot;",$temp[$i+1]);
			$i+=1;
		}
		elseif(preg_match($pattern2,$temp[$i])) {
			$temp[$i]="</pre>";
		}
	}
}

$memo="";

for($i=0;$i<count($temp);$i++) {
	$memo = $memo.$temp[$i];
}
// ���ý����̶���Ʈ ó�� ��

// �ӽ� ġȯ�� ���ڸ� ������
$memo=str_replace("my_lt_ek","&lt;",$memo);
$memo=str_replace("my_gt_ek","&gt;",$memo);

if($setup[use_alllist]) $view_target="zboard.php"; else $view_target="view.php";
// �������� ������
unset($s_data);
$s_data=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$no'"));

// �������� �̿��� ��
if($mode=="modify"||$mode=="reply") {
	if(!$s_data[no]) Error1("�������� �������� �ʽ��ϴ�");
}

// �����ۿ��� ����� �� �޸��� ó��
if($mode=="reply"&&$s_data[headnum]<=-2000000000) Error1("�����ۿ��� ����� �޼� �����ϴ�");


// ȸ������� �Ǿ� ������ �̸����� ������;;
if($member[no]) {
	if($mode=="modify"&&$member[no]!=$s_data[ismember]) {
		$name=$s_data[name];
		$email=$s_data[email];
		$homepage=$s_data[homepage];
	} else {
		$name=$member[name];
		$email=$member[email];
		$homepage=$member[homepage];
	}
}

// ���� ������ addslashes ��Ŵ;;
$name=trim(addslashes(del_html($name)));
if(($is_admin||$member[level]<=$setup[use_html])&&$use_html) $subject=trim(addslashes($subject));
else $subject=trim(addslashes(del_html($subject)));
$memo=trim(addslashes($memo));
if($use_html<2) {
	$memo=str_replace("  ","&nbsp;&nbsp;",$memo);
	$memo=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$memo);
}	
$sitelink1=trim(addslashes(del_html($sitelink1)));
$sitelink2=trim(addslashes(del_html($sitelink2)));
$email=trim(addslashes(del_html($email)));
$homepage=trim(addslashes(del_html($homepage)));

// Ȩ������ �ּ��� ��� http:// �� ������ ����
if((!eregi("http://",$homepage))&&$homepage) $homepage="http://".$homepage;

// ���� ���� ����
$ip=$REMOTE_ADDR; // �����ǰ� ����;;
$reg_date=time(); // ������ �ð�����;;

$x = $zx;
$y = $zy;

// �������� �ƴ��� �˻�;; �켱 ���� �����Ǵ뿡 30���̳��� ���� ����� ����;;
if(!$is_admin&&$mode!="modify") {
	$max_no=mysql_fetch_array(mysql_query("select max(no) from $t_board"."_$id"));
	$temp=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where ip='$ip' and $reg_date - reg_date <5 and no='$max_no[0]'"));
	if($temp[0]>0) {Error1("�۵���� 30���̻��� ������ �����մϴ�"); exit;}
}

// ���� ������ �ִ��� �˻�;;
if(!$is_admin&&$mode!="modify") {
	$max_no=mysql_fetch_array(mysql_query("select max(no) from $t_board"."_$id"));
	$temp=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where memo='$memo' and no='$max_no[0]'"));
	if($temp[0]>0) {Error1("���� ������ ���� ����Ҽ��� �����ϴ�"); exit; }
}

// ��Ű ����;;
if($mode!="modify") {
	// 4.0x �� ���� ó��
	if($name) {
		$zb_writer_name = $name;
		session_register("zb_writer_name");
	}
	if($email) {
		$zb_writer_email = $email;
		session_register("zb_writer_email");
	}
	if($homepage) {
		$zb_writer_homepage = $homepage;
		session_register("zb_writer_homepage");
	}
}

// �������� �� �����ȣ ���� üũ
if($mode=="modify"&&$no) {
	if($s_data[ismember]) {
		if(!$is_admin&&$member[level]>$setup[grant_delete]&&$s_data[ismember]!=$member[no]) Error1("�������� ������� �����ϼ���");
	}

	// ��й�ȣ �˻�;;
	if($s_data[ismember]!=$member[no]&&!$is_admin) {
		if($password!=$s_data[password]) Error1("��й�ȣ�� Ʋ�Ƚ��ϴ�");
	}
}

/***************************************************************************
* ���ε尡 ������
**************************************************************************/
if($HTTP_POST_FILES[file1]) {
	$file1 = $HTTP_POST_FILES[file1][tmp_name];
	$file1_name = $HTTP_POST_FILES[file1][name];
	$file1_size = $HTTP_POST_FILES[file1][size];
}
if($HTTP_POST_FILES[file2]) {
	$file2 = $HTTP_POST_FILES[file2][tmp_name];
	$file2_name = $HTTP_POST_FILES[file2][name];
	$file2_size = $HTTP_POST_FILES[file2][size];
}

// ���ϻ���
if($del_file1==1) {
	if(eregi("\.jpg",$s_data[file_name1])||eregi("\.jpeg",$s_data[file_name1])||eregi("\.png",$s_data[file_name1])){ 
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fs_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fl_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fXL_".$s_data[reg_date].".jpg");
	}
	@z_unlink($_zb_path."/".$s_data[file_name1]);$del_que1=",file_name1='',s_file_name1=''";
	// �� ���� ���� ����
	if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name1],$out))
		if(is_dir($_zb_path."/data/".$out[1]."/".$out[2])) @rmdir($_zb_path."/data/".$out[1]."/".$out[2]);
} 
if($del_file2==1) {
	if(eregi("\.jpg",$s_data[file_name2])||eregi("\.jpeg",$s_data[file_name2])||eregi("\.png",$s_data[file_name2])){ 
		  @z_unlink($_zb_path."data/".$id."/thumbnail/ss_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/sl_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/sXL_".$s_data[reg_date].".jpg");
	}
	@z_unlink($_zb_path."/".$s_data[file_name2]);$del_que2=",file_name2='',s_file_name2=''";
	// �� ���� ���� ����
	if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name2],$out))
		if(is_dir($_zb_path."/data/".$out[1]."/".$out[2])) @rmdir($_zb_path."/data/".$out[1]."/".$out[2]);
} 

if($file1_size>0&&$setup[use_pds]&&$file1) {
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$file1_name,$result); //Ư�����ڰ� ������ ����
	if($result[0]!=$file1_name) Error1("�ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!"); //Ư�� ���ڰ� ������

	if(!is_uploaded_file($file1)) Error1("�������� ������� ���ε� ���ּ���");
	if($file1_name==$file2_name) Error1("���� ������ ����Ҽ� �����ϴ�");
	$file1_size=filesize($file1);

	if($setup[max_upload_size]<$file1_size&&!$is_admin) Error1("ù��° ���� ���ε�� �ְ� ".GetFileSize($setup[max_upload_size])." ���� �����մϴ�");

	// ���ε� ����
	if($file1_size>0) {
		$s_file_name1=$file1_name;
		if(substr($s_file_name1,0,1)=='.'||preg_match("#\.(inc|phtm|htm|shtm|ztx|php|dot|asp|cgi|pl)$#i",$s_file_name1)) Error1("Html, PHP ���������� ���ε��Ҽ� �����ϴ�");

		// Ȯ���� �˻�
		if($setup[pds_ext1]) {
			$temp=explode(".",$s_file_name1);
			$s_point=count($temp)-1;
			$upload_check=$temp[$s_point];
			if(!eregi($upload_check,$setup[pds_ext1])||!$upload_check) Error1("ù��° ���ε�� $setup[pds_ext1] Ȯ���ڸ� �����մϴ�");
		}
		
		$file1=eregi_replace("\\\\","\\",$file1);
		$s_file_name1=str_replace(" ","_",$s_file_name1);
		$s_file_name1=str_replace("-","_",$s_file_name1);

		// ���丮�� �˻���
		if(!is_dir($_zb_path."data/".$id)) { 
			@mkdir($_zb_path."data/".$id,0777);
			@chmod($_zb_path."data/".$id,0707);	
		}
		
		// �ߺ������� ������;; 
		if(file_exists($_zb_path."data/$id/".$s_file_name1)) {
			@mkdir($_zb_path."data/$id/".$reg_date,0777);
			if(!move_uploaded_file($file1,$_zb_path."data/$id/".$reg_date."/".$s_file_name1)) Error1("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
			$file_name1="data/$id/".$reg_date."/".$s_file_name1;
			@chmod($_zb_path.$file_name1,0706);
			@chmod($_zb_path."data/$id/".$reg_date,0707);
		} else {
			if(!move_uploaded_file($file1,$_zb_path."data/$id/".$s_file_name1)) Error1("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
			$file_name1="data/$id/".$s_file_name1;   
			@chmod($_zb_path.$file_name1,0706);
		}
		if(eregi("\.jpg",$s_data[file_name1])||eregi("\.jpeg",$s_data[file_name1])||eregi("\.png",$s_data[file_name1])){ 
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fs_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fl_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/fXL_".$s_data[reg_date].".jpg");
		}
	}
}

if($file2_size>0&&$setup[use_pds]&&$file2) {
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$file2_name,$result); //Ư�����ڰ� ������ ����
	if($result[0]!=$file2_name) Error1("�ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!"); //Ư�� ���ڰ� ������

	if(!is_uploaded_file($file2)) Error1("�������� ������� ���ε� ���ּ���");
	$file2_size=filesize($file2);

	if($setup[max_upload_size]<$file2_size&&!$is_admin) Error1("���� ���ε�� �ְ� ".GetFileSize($setup[max_upload_size])." ���� �����մϴ�");

	// ���ε� ����
	if($file2_size>0) {
		$s_file_name2=$file2_name;
		if(substr($s_file_name2,0,1)=='.'||preg_match("#\.(inc|phtm|htm|shtm|ztx|php|dot|asp|cgi|pl)$#i",$s_file_name2)) Error1("Html, PHP ���������� ���ε��Ҽ� �����ϴ�");

		// Ȯ���� �˻�
		if($setup[pds_ext2]) {
			$temp=explode(".",$s_file_name2);
			$s_point=count($temp)-1;
			$upload_check=$temp[$s_point];
			if(!eregi($upload_check,$setup[pds_ext2])||!$upload_check) Error1("���ε�� $setup[pds_ext2] Ȯ���ڸ� �����մϴ�");
		}
		
		$file2=eregi_replace("\\\\","\\",$file2);
		$s_file_name2=str_replace(" ","_",$s_file_name2);
		$s_file_name2=str_replace("-","_",$s_file_name2);

		// ���丮�� �˻���
		if(!is_dir($_zb_path."data/".$id)) {
			mkdir($_zb_path."data/".$id,0777);
			@chmod($_zb_path."data/".$id,0707);
		}

		// �ߺ������� ������;; 
		if(file_exists($_zb_path."data/$id/".$s_file_name2)) {
			@mkdir($_zb_path."data/$id/".$reg_date,0777);
			if(!move_uploaded_file($file2,$_zb_path."data/$id/".$reg_date."/".$s_file_name2)) Error1("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
			$file_name2="data/$id/".$reg_date."/".$s_file_name2;
			@chmod($_zb_path.$file_name2,0706);
			@chmod($_zb_path."data/$id/".$reg_date,0707);
		} else {
			if(!move_uploaded_file($file2,$_zb_path."data/$id/".$s_file_name2)) Error1("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
			$file_name2="data/$id/".$s_file_name2;              
			@chmod($_zb_path.$file_name2,0706);
			
		}
		if(eregi("\.jpg",$s_data[file_name2])||eregi("\.jpeg",$s_data[file_name2])||eregi("\.png",$s_data[file_name2])){ 
		  @z_unlink($_zb_path."data/".$id."/thumbnail/ss_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/sl_".$s_data[reg_date].".jpg");
		  @z_unlink($_zb_path."data/".$id."/thumbnail/sXL_".$s_data[reg_date].".jpg");
		}
	}
}

/***************************************************************************
* �������϶�
**************************************************************************/
if($mode=="modify"&&$no) {
	// ���� �ܺ� html ����� ����
	$Thumbnail_small1="fs_".$s_data[reg_date].".jpg";
	$Thumbnail_small2="ss_".$s_data[reg_date].".jpg";

	$Thumbnail_large1="fl_".$s_data[reg_date].".jpg";
	$Thumbnail_large2="sl_".$s_data[reg_date].".jpg";
	if(file_exists($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_small1)){
		@z_unlink($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_small1);
		@z_unlink($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_large1);
	}
	if(file_exists($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_small2)){
		@z_unlink($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_small2);
		@z_unlink($Thumbnail_path.$s_data[ismember]."/".$Thumbnail_large2);
	}

	// ���ϵ��
	if($file_name1) {$del_que1=",file_name1='$file_name1',s_file_name1='$s_file_name1'";}
	if($file_name2) {$del_que2=",file_name2='$file_name2',s_file_name2='$s_file_name2'";}

	// ���� -> �Ϲݱ� 
	if(!$notice&&$s_data[headnum]<="-2000000000") {
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id"));
		$max_division=$temp[0];
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
		if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

		// ����+1 �Ѱ��� ����;;
		$max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000")); // ������ �ƴ� �ּ� headnum ����
		$headnum=$max_headnum[0]-1; 

		$next_data=mysql_fetch_array(mysql_query("select no,headnum,division from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum='$max_headnum[0]' and arrangenum='0'")); // �������� ����;;
		if(!$next_data[0]) $next_data[0]="0";
		$next_no=$next_data[0];

		if(!$next_data[division]) $division=1; else $division=$next_data[division];

		$prev_data=mysql_fetch_array(mysql_query("select no from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum<'$headnum' and no!='$no' order by headnum desc limit 1")); // �������� ����;;
		if($prev_data[0]) $prev_no=$prev_data[0]; else $prev_no=0;

		$child="0";
		$depth="0";    
		$arrangenum="0";
		$father="0";
		minus_division($s_data[division]);
		@mysql_query("update $t_board"."_$id set headnum='$headnum',prev_no='$prev_no',next_no='$next_no',child='$child',depth='$depth',arrangenum='$arrangenum',father='$father',name='$name',email='$email',homepage='$homepage',subject='$subject',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category' $del_que1 $del_que2 where no='$no'") or error(mysql_error());
		plus_division($division);

		// �������� �������� ����
		if($next_no)mysql_query("update $t_board"."_$id set prev_no='$no' where division='$next_data[division]' and headnum='$next_data[headnum]'");  

		// �������� �������� ����
		if($prev_no)mysql_query("update $t_board"."_$id set next_no='$no' where no='$prev_no'");                  

		mysql_query("update $t_board"."_$id set prev_no=0 where (division='$max_division' or division='$second_division') and prev_no='$s_data[no]' and headnum!='$next_data[headnum]'");
		mysql_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);
		mysql_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);
	}

	// �Ϲݱ� -> ���� 
	elseif($notice&&$s_data[headnum]>-2000000000) {
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id"));
		$max_division=$temp[0];
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
		if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

		$max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$id where division='$max_division' or division='$second_division'"));  // �ְ���� ����;;
		$headnum=$max_headnum[0]-1;
		if($headnum>-2000000000) $headnum=-2000000000; // �ְ� headnum�� ������ �ƴϸ� ���� �ۿ� ������ ����;

		$next_data=mysql_fetch_array(mysql_query("select no,headnum,division from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum='$max_headnum[0]' and arrangenum='0'"));
		if(!$next_data[0]) $next_data[0]="0";
		$next_no=$next_data[0];
		$prev_no=0;
		$child="0";
		$depth="0";
		$arrangenum="0";
		$father="0";
		minus_division($s_data[division]);
		$division=add_division();
		@mysql_query("update $t_board"."_$id set division='$division',headnum='$headnum',prev_no='$prev_no',next_no='$next_no',child='$child',depth='$depth',arrangenum='$arrangenum',father='$father',name='$name',email='$email',homepage='$homepage',subject='$subject',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category' $del_que1 $del_que2 where no='$no'") or error(mysql_error());

		if($s_data[father]) mysql_query("update $t_board"."_$id set child='$s_data[child]' where no='$s_data[father]'"); // ����̾����� �������� ����� ������� ��۷� ��ü
		if($s_data[child]) mysql_query("update $t_board"."_$id set depth=depth-1,father='$s_data[father]' where no='$s_data[child]'"); // ����� ������ ������� ��ġ��;;

		// ���� �����۷� �̱��� ������ �־��� ����Ÿ�� prev_no�� �ٲ�;
		$temp=mysql_fetch_array(mysql_query("select max(headnum) from $t_board"."_$id where headnum<='$s_data[headnum]'"));
		$temp=mysql_fetch_array(mysql_query("select no from $t_board"."_$id where headnum='$temp[0]' and depth='0'"));
		mysql_query("update $t_board"."_$id set prev_no='$temp[no]' where prev_no='$s_data[no]'");

		mysql_query("update $t_board"."_$id set next_no='$s_data[next_no]' where next_no='$s_data[no]'");

		mysql_query("update $t_board"."_$id set prev_no='$no' where prev_no='0' and no!='$no'") or error(mysql_error()); // �������� �������� ���� 
		mysql_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);
		mysql_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);

	// �Ϲ�->�Ϲ�, ����->���� �϶� 
	} else {
		@mysql_query("update $t_board"."_$id set name='$name',subject='$subject',email='$email',homepage='$homepage',memo='$memo',sitelink1='$sitelink1',sitelink2='$sitelink2',use_html='$use_html',reply_mail='$reply_mail',is_secret='$is_secret',category='$category' $del_que1 $del_que2 where no='$no'") or error(mysql_error());
		mysql_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);
		mysql_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);
	}

/***************************************************************************
* �亯���϶�
**************************************************************************/
} elseif($mode=="reply"&&$no) {

	$prev_no=$s_data[prev_no];
	$next_no=$s_data[next_no];
	$father=$s_data[no];
	$child=0;
	$headnum=$s_data[headnum];    
	if($headnum<=-2000000000&&$notice) Error1("�������׿��� ����� �޼��� �����ϴ�");
	$depth=$s_data[depth]+1;
	$arrangenum=$s_data[arrangenum]+1;
	$move_result=mysql_query("select no from $t_board"."_$id where division='$s_data[division]' and headnum='$headnum' and arrangenum>='$arrangenum'");
	while($move_data=mysql_fetch_array($move_result)) {
		mysql_query("update $t_board"."_$id set arrangenum=arrangenum+1 where no='$move_data[no]'");
	}

	$division=$s_data[division];
	plus_division($s_data[division]);

	// ��� ����Ÿ �Է�;;
	mysql_query("insert into $t_board"."_$id (division,headnum,arrangenum,depth,prev_no,next_no,father,child,ismember,memo,ip,password,name,homepage,email,subject,use_html,reply_mail,category,is_secret,sitelink1,sitelink2,file_name1,file_name2,s_file_name1,s_file_name2,x,y,reg_date,islevel) values ('$division','$headnum','$arrangenum','$depth','$prev_no','$next_no','$father','$child','$member[no]','$memo','$ip','$password','$name','$homepage','$email','$subject','$use_html','$reply_mail','$category','$is_secret','$sitelink1','$sitelink2','$file_name1','$file_name2','$s_file_name1','$s_file_name2','$x','$y','$reg_date','$member[is_admin]')") or error(mysql_error());    

	// �����۰� �������� �Ʒ����� �Ӽ� ����;;
	$no=mysql_insert_id();
	mysql_query("update $t_board"."_$id set child='$no' where no='$s_data[no]'");
	mysql_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);

	// ������� ��ȸ���� �ø��� ���� ���� ���
	$hitStr=",".$setup[no]."_".$no;
	$zb_hit=$HTTP_SESSION_VARS["zb_hit"].$hitStr;
	session_register("zb_hit");

	// ������� ��õ�� �Ҽ� ���� ���� ���
	$voteStr=",".$setup[no]."_".$no;
	$zb_vote=$HTTP_SESSION_VARS["zb_vote"].$voteStr;
	session_register("zb_vote");

	// ����� �������϶�;;
	if($s_data[reply_mail]&&$s_data[email]) {

		if($use_html<2) $memo=nl2br($memo);
		$memo = stripslashes($memo);

		zb_sendmail($use_html, $s_data[email], $s_data[name], $email, $name, $subject, $memo);
	}

/***************************************************************************
* �ű� �۾����϶�
**************************************************************************/
} elseif($mode=="write") {

	// ���������� �ƴҶ�;;
	if(!$notice) {
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id"));
		$max_division=$temp[0];
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
		if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

		$max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000"));
		if(!$max_headnum[0]) $max_headnum[0]=0;

		$headnum=$max_headnum[0]-1;

		$next_data=mysql_fetch_array(mysql_query("select division,headnum,arrangenum from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum>-2000000000 order by headnum limit 1"));
		if(!$next_data[0]) $next_data[0]="0";
		else {
			$next_data=mysql_fetch_array(mysql_query("select no,headnum,division from $t_board"."_$id where division='$next_data[division]' and headnum='$next_data[headnum]' and arrangenum='$next_data[arrangenum]'"));
		}

		$prev_data=mysql_fetch_array(mysql_query("select no from $t_board"."_$id where (division='$max_division' or division='$second_division') and headnum<=-2000000000 order by headnum desc limit 1"));
		if($prev_data[0]) $prev_no=$prev_data[0]; else $prev_no="0";

	// ���������϶�;; 
	} else {
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id"));
		$max_division=$temp[0]+1;
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id where num>0 and division!='$max_division'"));
		if(!$temp[0]) $second_division=0; else $second_division=$temp[0];

		$max_headnum=mysql_fetch_array(mysql_query("select min(headnum) from $t_board"."_$id where division='$max_division' or division='$second_division'"));
		$headnum=$max_headnum[0]-1;
		if($headnum>-2000000000) $headnum=-2000000000;

		$next_data=mysql_fetch_array(mysql_query("select division,headnum from $t_board"."_$id where division='$max_division' or division='$second_division' order by headnum limit 1"));
		if(!$next_data[0]) $next_data[0]="0";
		else {
			$next_data=mysql_fetch_array(mysql_query("select no,headnum,division from $t_board"."_$id where division='$next_data[division]' and headnum='$next_data[headnum]' and arrangenum='0'"));
		}
		$prev_no=0; 
	}

	$next_no=$next_data[no];
	$child="0";
	$depth="0";
	$arrangenum="0";
	$father="0";
	$division=add_division();

	mysql_query("insert into $t_board"."_$id (division,headnum,arrangenum,depth,prev_no,next_no,father,child,ismember,memo,ip,password,name,homepage,email,subject,use_html,reply_mail,category,is_secret,sitelink1,sitelink2,file_name1,file_name2,s_file_name1,s_file_name2,x,y,reg_date,islevel) values ('$division','$headnum','$arrangenum','$depth','$prev_no','$next_no','$father','$child','$member[no]','$memo','$ip','$password','$name','$homepage','$email','$subject','$use_html','$reply_mail','$category','$is_secret','$sitelink1','$sitelink2','$file_name1','$file_name2','$s_file_name1','$s_file_name2','$x','$y','$reg_date','$member[is_admin]')") or error(mysql_error());
	$no=mysql_insert_id();

	// ������� ��ȸ���� �ø��� ���� ���� ���
	$hitStr=",".$setup[no]."_".$no;
	$zb_hit=$HTTP_SESSION_VARS["zb_hit"].$hitStr;
	session_register("zb_hit");

	// ������� ��õ�� �Ҽ� ���� ���� ���
	$voteStr=",".$setup[no]."_".$no;
	$zb_vote=$HTTP_SESSION_VARS["zb_vote"].$voteStr;
	session_register("zb_vote");

	if($prev_no) mysql_query("update $t_board"."_$id set next_no='$no' where no='$prev_no'");
	if($next_no) mysql_query("update $t_board"."_$id set prev_no='$no' where headnum='$next_data[headnum]' and division='$next_data[division]'");
	mysql_query("update $t_category"."_$id set num=num+1 where no='$category'",$connect);
}

// ���� ������ �ٽ� ����
$total=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id "));
mysql_query("update $admin_table set total_article='$total[0]' where name='$id'");

// ȸ���� ��� �ش� �ؿ��� ���� �ֱ�
if($mode=="write"||$mode=="reply") @mysql_query("update $member_table set point1=point1+1 where no='$member[no]'",$connect) or error(mysql_error());

// MySQL �ݱ� 
if($connect) {
	mysql_close($connect); 
	unset($connect);
}

//������ ���� ���Ǻ��� ����
session_unregister("WRT_SS_VRS");
session_unregister("WRT_SPM_PWD");

// ������ �̵�
$view_file =$_zb_url."/".$view_target;
movepage($view_file."?id=$id&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no");
?>