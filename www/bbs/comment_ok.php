<?
/***************************************************************************
* ���� ���� include
**************************************************************************/
include "_head.php";

if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)||!$_SESSION['ZBRD_SS_VRS']||$_SESSION['ZBRD_SS_VRS']!=$antispam) Error("���������� ���� �ۼ��Ͽ� �ֽñ� �ٶ��ϴ�.");
if(getenv("REQUEST_METHOD") == 'GET' ) Error("���������� ���� ���ñ� �ٶ��ϴ�","");

/***************************************************************************
* �Խ��� ���� üũ
**************************************************************************/

// ��� ���� �̸� ����
if(!$setup[use_alllist]) $view_file_link="view.php"; else $view_file_link="zboard.php";

// ������ üũ
if($setup[grant_comment]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=$view_file_link");

// ���� ���� �˻�;;
$name = str_replace("��","",$name);
$memo = str_replace("��","",$memo);

if(!$member[no]) {
	if(isblank($name)) Error("�̸��� �Է��ϼž� �մϴ�");
	if(isblank($password)) Error("��й�ȣ�� �Է��ϼž� �մϴ�");
} else {
	$password = $member[password];
}

if(isblank($memo)) Error("������ �Է��ϼž� �մϴ�");

// ���ö��� ���� ���� ���� ���ڿ� �˻�
if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",trim($memo))) Error("����� ���ڿ��� ����� �� �����ϴ�");

// ���͸�;; �����ڰ� �ƴҶ�;;
if(!$is_admin&&$setup[use_filter]) {
	$filter=explode(",",$setup[filter]);
	$f_memo=preg_replace("#([\_\-\./~@?=%&! ]+)#i","",strip_tags($memo));
	$f_name=preg_replace("#([\_\-\./~@?=%&! ]+)#i","",strip_tags($name));
	for($i=0;$i<count($filter);$i++)
	if(!isblank($filter[$i])) {
		if(preg_match("#".$filter[$i]."#i",$f_memo)) Error("'$filter[$i]' ��(��) ����ϱ⿡ ������ �ܾ �ƴմϴ�");
		if(preg_match("#".$filter[$i]."#i",$f_name)) Error("'$filter[$i]' ��(��) ����ϱ⿡ ������ �ܾ �ƴմϴ�");
	}
}

// �н����� addslashes
if(!get_magic_quotes_gpc()) {
	$password = addslashes($password);
}

// �н����带 ��ȣȭ
if(strlen($password)) {
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];
}

// &lt,&gt�� ���ý����̶���Ʈ���� ����ϱ� ���� �ӽ� ġȯ
$memo=str_replace("&lt;","my_lt_ek",$memo);
$memo=str_replace("&gt;","my_gt_ek",$memo);

// �������̰ų� HTML��뷹���� ������ �±��� ���������� üũ
if(!$is_admin&&$setup[grant_html]<$member[level]) {

	// ������ HTML ����;;
	if(!$use_html2||$setup[use_html]==0) $memo=del_html($memo);

	// HTML�� �κ�����϶�;;
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
		// XSS ��ŷ �̺�Ʈ �ڵ鷯 ����
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

// ���ý����̶���Ʈ ó�� ����
$codePattern = "#(\[[a-z]+[0-9]?\_code\:[0-9]+\{[^}]*?\}\]|[\/[a-z]+[0-9]?\_code\])#si";
$temp = preg_split($codePattern,$memo,-1,PREG_SPLIT_DELIM_CAPTURE);

for($i=0;$i<count($temp);$i++) {
	$cnt=0;
	for($j=0;$j<count($code);$j++) {
		$pattern1 = "#\[".$code[$j]."\_code\:([0-9]+)\{([^}]*?)\}\]#i";
		$pattern2 = "#\[\/".$code[$j]."\_code\]#i";
		// �ڵ���� �±� ¦�� �߰ߵǸ�
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
			$temp[$i+1]=str_replace("my_lt_ek","&amp;lt;",$temp[$i+1]); // &lt ���!
			$temp[$i+1]=str_replace("my_gt_ek","&amp;gt;",$temp[$i+1]); // &gt ���!
			$temp[$i+1]=str_replace("<","&lt;",$temp[$i+1]);

			$temp[$i+2]="</pre>";
			$i+=2;
		}
	}
	if($cnt==0) {
		// �����������Ϳ��� &�� &amp;�� �ٲ� ������� ������ �ʴ� ���� �ذ�
		$imagePattern="#<img[^>]*src=[\']?[\"]?([^>]+)[\']?[\"]?[^>]*>#i";
		preg_match_all($imagePattern,$temp[$i],$img,PREG_SET_ORDER);
		for($j=0;$j<count($img);$j++)
			$temp[$i]=str_replace($img[$j][1],str_replace("&amp;","&",$img[$j][1]),$temp[$i]);
		// �ڵ� ���� �߸� ����
		$temp[$i]=str_replace("&#160;"," ",$temp[$i]);
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

// �������� ������
unset($s_data);
$s_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where no='$c_no'"));

// �������� �̿��� ��
if($mode=="modify") {
	if(!$s_data[no]) Error("�ش� ������ �������� �ʽ��ϴ�");
} elseif($mode=="reply") {
	if(!$s_data[no]) Error("���� ������ �������� �ʽ��ϴ�");
}

$ismember = $member[no]; // �ڵ����� ��� ��ȣ
// ȸ������� �Ǿ� ������ �̸����� ������;;
if($member[no]) {
	if($mode=="modify"&&$member[no]!=$s_data[ismember]) {
		$name=$s_data[name];
	} else {
		$name=$member[name];
	}
	$name=addslashes($name);
	$name = trim($name);
} else {
	if(!get_magic_quotes_gpc()) $name=addslashes($name);
	$member[name] = trim($name);
	$ismember = '0';
}

// ���� ������ addslashes ��Ŵ;;
if(!get_magic_quotes_gpc()) {
	$memo=addslashes($memo);
}

$memo=trim($memo);
if($use_html2<2) {
	$memo=str_replace("  ","&nbsp;&nbsp;",$memo);
	$memo=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$memo);
}

// ���� ���� ����
$ip=$REMOTE_ADDR; // �����ǰ� ����;;
$reg_date=time(); // ������ �ð�����;;

// �������� �ƴ��� �˻�;; �켱 ���� �����Ǵ뿡 30���̳��� ������ ����� ����;;
if(!$is_admin&&$mode!="modify") {
	$max_no=mysql_fetch_array(mysql_query("select max(no) from $t_comment"."_$id"));
	$temp=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where ip='$ip' and $reg_date - reg_date <30 and no='$max_no[0]'"));
	if($temp[0]>0) Error("���� ����� 30���̻��� ������ �����մϴ�");
}

// �ڸ�Ʈ�� �ְ� Number ���� ���� (�ߺ� üũ�� ���ؼ�)
$max_no=mysql_fetch_array(mysql_query("select max(no) from $t_comment"."_$id where parent='$no'"));

// ���� ������ �ִ��� �˻�;;
if(!$is_admin&&$mode!="modify") {
	$temp=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where memo='$memo' and no='$max_no[0]'"));
	if($temp[0]>0) Error("���� ������ ���� ����Ҽ��� �����ϴ�");
}

// ��Ű ����;;
// 5.3 �̻�� ���� ó��
if($c_name) {
	$_SESSION['writer_name']=$name;
}

// �ش���� �ִ� ���� �˻�
$check = mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where no = '$no'", $connect));
if(!$check[0]) Error("������(�θ��)�� �������� �ʽ��ϴ�.");

// �������� �� �����ȣ ���� üũ
if($mode=="modify"&&$c_no) {
	if($s_data[ismember]) {
		if(!$is_admin&&$member[level]>$setup[grant_delete]&&$s_data[ismember]!=$member[no]) Error("�������� ������� �����ϼ���");
	}
	// ��й�ȣ �˻�;;
	if($s_data[ismember]!=$member[no]&&!$is_admin) {
		if($password!=$s_data[password]) Error("��й�ȣ�� Ʋ�Ƚ��ϴ�");
	}
	if($c_depth) {
		$memo.="|||".$c_org."|".$c_depth;
	}
}
elseif($mode=="reply"&&$c_no) {
	$memo.="|||".$c_no."|".($c_depth+1);
}

/***************************************************************************
* ���ε尡 ������
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

// ���ϻ���
if($del_file1==1) {
	@z_unlink("./".$s_data[file_name1]);
	$del_que1=",file_name1='',s_file_name1=''";
	// �� ���� ���� ����
	if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name1],$out))
		if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
}
if($del_file2==1) {
	@z_unlink("./".$s_data[file_name2]);
	$del_que2=",file_name2='',s_file_name2=''";
	// �� ���� ���� ����
	if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name2],$out))
		if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
}

if($file1_size>0&&$setup[use_pds]&&$file1) {
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$file1_name,$result); // Ư�����ڰ� ������ ����
	if($result[0]!=$file1_name) Error("�ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!"); // Ư�� ���ڰ� ������

	if(!is_uploaded_file($file1)) Error("�������� ������� ���ε� ���ּ���");
	if($file1_name==$file2_name) Error("���� ������ ����Ҽ� �����ϴ�");
	$file1_size=filesize($file1);

	if($setup[max_upload_size]<$file1_size&&!$is_admin) error("ù��° ���� ���ε�� �ְ� ".GetFileSize($setup[max_upload_size])." ���� �����մϴ�");

	// ���ε� ����
	if($file1_size>0) {
		$s_file_name1=$file1_name;
		if(substr($s_file_name1,0,1)=='.'||preg_match("#\.(inc|phtm|htm|shtm|phtml|html|shtml|ztx|php|dot|asp|cgi|pl)$#i",$s_file_name1)) Error("Html, PHP ���������� ���ε��Ҽ� �����ϴ�");

		// Ȯ���� �˻�
		if($setup[pds_ext1]) {
			$temp=explode(".",$s_file_name1);
			$s_point=count($temp)-1;
			$upload_check=$temp[$s_point];
			if(!preg_match("/".$upload_check."/i",$setup[pds_ext1])||!$upload_check) Error("ù��° ���ε�� $setup[pds_ext1] Ȯ���ڸ� �����մϴ�");
		}

		$file1=preg_replace("#\\\\#i","\\",$file1);
		$s_file_name1=str_replace(" ","_",$s_file_name1);
		$s_file_name1=str_replace("-","_",$s_file_name1);

		// ���丮�� �˻���
		if(!is_dir("data/".$id)) {
			@mkdir("data/".$id,0777,true);
			@chmod("data/".$id,0707);
		}

		// �ߺ������� ������;;
		if(file_exists("data/$id/".$s_file_name1)) {
			@mkdir("data/$id/".$reg_date,0777);
			if(!move_uploaded_file($file1,"data/$id/".$reg_date."/".$s_file_name1)) Error("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
			$file_name1="data/$id/".$reg_date."/".$s_file_name1;
			@chmod($file_name1,0706);
			@chmod("data/$id/".$reg_date,0707);
		} else {
			if(!move_uploaded_file($file1,"data/$id/".$s_file_name1)) Error("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
			$file_name1="data/$id/".$s_file_name1;
			@chmod($file_name1,0706);
		}
	}
}

if($file2_size>0&&$setup[use_pds]&&$file2) {
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$file2_name,$result); // Ư�����ڰ� ������ ����
	if($result[0]!=$file2_name) Error("�ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!"); // Ư�� ���ڰ� ������

	if(!is_uploaded_file($file2)) Error("�������� ������� ���ε� ���ּ���");
	$file2_size=filesize($file2);
	if($setup[max_upload_size]<$file2_size&&!$is_admin) error("���� ���ε�� �ְ� ".GetFileSize($setup[max_upload_size])." ���� �����մϴ�");
	if($file2_size>0) {
		$s_file_name2=$file2_name;
		if(substr($s_file_name2,0,1)=='.'||preg_match("#\.(inc|phtm|htm|shtm|phtml|html|shtml|ztx|php|dot|asp|cgi|pl)$#i",$s_file_name2)) Error("Html, PHP ���������� ���ε��Ҽ� �����ϴ�");

		// Ȯ���� �˻�
		if($setup[pds_ext2]) {
			$temp=explode(".",$s_file_name2);
			$s_point=count($temp)-1;
			$upload_check=$temp[$s_point];
			if(!preg_match("/".$upload_check."/i",$setup[pds_ext2])||!$upload_check) Error("���ε�� $setup[pds_ext2] Ȯ���ڸ� �����մϴ�");
		}

		$file2=preg_replace("#\\\\#i","\\",$file2);
		$s_file_name2=str_replace(" ","_",$s_file_name2);
		$s_file_name2=str_replace("-","_",$s_file_name2);

		// ���丮�� �˻���
		if(!is_dir("data/".$id)) {
			@mkdir("data/".$id,0777,true);
			@chmod("data/".$id,0707);
		}

		// �ߺ������� ������;;
		if(file_exists("data/$id/".$s_file_name2)) {
			@mkdir("data/$id/".$reg_date,0777);
			if(!move_uploaded_file($file2,"data/$id/".$reg_date."/".$s_file_name2)) Error("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
			$file_name2="data/$id/".$reg_date."/".$s_file_name2;
			@chmod($file_name2,0706);
			@chmod("data/$id/".$reg_date,0707);
		} else {
			if(!move_uploaded_file($file2,"data/$id/".$s_file_name2)) Error("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
			$file_name2="data/$id/".$s_file_name2;
			@chmod($file_name2,0706);
		}
	}
}

/***************************************************************************
* �������϶�
**************************************************************************/
if($mode=="modify"&&$c_no) {
	// ���ϵ��
	if($file_name1) {$del_que1=",file_name1='$file_name1',s_file_name1='$s_file_name1'";}
	if($file_name2) {$del_que2=",file_name2='$file_name2',s_file_name2='$s_file_name2'";}

	@mysql_query("update $t_comment"."_$id set name='$name',memo='$memo',use_html2='$use_html2',is_secret='$is_secret' $del_que1 $del_que2 where no='$c_no'") or error(mysql_error());

} elseif($mode=="write"||($mode=="reply"&&$c_no)) {
	// �ڸ�Ʈ �Է�
	mysql_query("insert into $t_comment"."_$id (parent,ismember,islevel,name,password,memo,reg_date,ip,use_html2,is_secret,file_name1,file_name2,s_file_name1,s_file_name2) values ('$no','$member[no]','$member[level]','$name','$password','$memo','$reg_date','$ip','$use_html2','$is_secret','$file_name1','$file_name2','$s_file_name1','$s_file_name2')") or error(mysql_error());
	// ȸ���� ��� �ش� �ؿ��� ���� �ֱ�
	@mysql_query("update $member_table set point2=point2+1 where no='$member[no]'",$connect) or error(mysql_error());
}

// �ӽ� ���� ���� ����
if($mode=="write"||$mode=="reply") mysql_query("delete from $comment_imsi_table where bname='$id' and cno='0' and parent='$no' and ismember='$ismember' and name='$member[name]' and password='$password'");
elseif($mode=="modify") mysql_query("delete from $comment_imsi_table where bname='$id' and cno='$c_no' and parent='$no' and ismember='$ismember' and name='$member[name]'");

// �ڸ�Ʈ ������ ���ؼ� ����
$total=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where parent='$no'"));
mysql_query("update $t_board"."_$id set total_comment='$total[0]' where no='$no'") or error(mysql_error());

// ������ ���� ���Ǻ��� ����
unset($_SESSION['ZBRD_SS_VRS']);

// ������ �̵�
movepage("$view_file_link?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category");
?>