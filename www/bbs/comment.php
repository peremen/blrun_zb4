<?
$mode = "modify";

/***************************************************************************
* ���� ���� include
**************************************************************************/
include "_head.php";

/***************************************************************************
 * �ڸ�Ʈ ���� ��ó����
 **************************************************************************/
if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)) Error("���������� ���� �ۼ��Ͽ� �ֽñ� �ٶ��ϴ�.");

if(preg_match("/:\/\//i",$dir)) $dir=".";

// ��� ���� �̸� ����
if(!$setup[use_alllist]) $view_file_link="view.php"; else $view_file_link="zboard.php";

// ������ üũ
if(!$is_admin&&$member[level]>$setup[grant_comment]) Error("�������� �����ϴ�.","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=$view_file_link");

// �������� ������
if($c_no) {
	$result=@mysql_query("select * from $t_comment"."_$id where no='$c_no'") or error(mysql_error());
	unset($s_data);
	$s_data=mysql_fetch_array($result);
	if(!$s_data[no]) Error("�ش� ������ �������� �ʽ��ϴ�");
}

// ���� ���϶� ���� üũ
if($s_data[ismember]) {
	if($s_data[ismember]!=$member[no]&&!$is_admin&&$member[level]>$setup[grant_delete]) Error("�������� �����ϴ�..","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=$view_file_link");
}

// ask_password.php���� ����� ��Ÿ���� comment.php�� ����
$target="comment.php";

// ��б��̰� �н����尡 Ʋ���� �����ڰ� �ƴϸ� ���� ǥ��
if($s_data[is_secret]&&!$is_admin&&$s_data[ismember]!=$member[no]) {
	if($member[no]) {
		$secret_check=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where no='$s_data[no]' and ismember='$member[no]'"));
		if(!$secret_check[0]) error("��б��� ������ ������ �����ϴ�");
	} else {
		$secret_check=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where no='$s_data[no]' and password=password('$password')"));
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

// ������ �� ���ڸ� �߻�(1-8) �� ���Ǻ����� ����
$num1 = rand(1,8);
$num2 = rand(1,8);
$num1num2 = $num1*10 + $num2;
session_register("num1num2");
//�۾��� ������ ���� ���Ǻ����� ����
$ZBRD_SS_VRS = $num1num2;
session_register("ZBRD_SS_VRS");

if($s_data[use_html2]<2) {
	$s_data[memo]=str_replace("&nbsp;&nbsp;&nbsp;&nbsp;","\t",$s_data[memo]);
	$s_data[memo]=str_replace("&nbsp;&nbsp;","  ",$s_data[memo]);
}

// ���ý����̶���Ʈ ��� ó�� ����
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
// ���ý����̶���Ʈ ��� ó�� ��

$name=trim(stripslashes($s_data[name])); // �̸�
$name=str_replace("\"","&quot;",$name);
$memo=str_replace("&nbsp;","&amp;nbsp;",trim(stripslashes($memo))); // ����
if($s_data[file_name1])$s_file_name1="<br>&nbsp;".$s_data[s_file_name1]."�� ��ϵǾ� �ֽ��ϴ�.<br> <input type=checkbox name=del_file1 value=1> ����";
if($s_data[file_name2])$s_file_name2="<br>&nbsp;".$s_data[s_file_name2]."�� ��ϵǾ� �ֽ��ϴ�.<br> <input type=checkbox name=del_file2 value=1> ����";
if($s_data[use_html2]) $use_html2=" checked ";
if($s_data[is_secret]) $secret=" checked ";

// ȸ���϶��� �⺻ �Է»��� �Ⱥ��̰�;;
if($member[no]) { $hide_start="<!--"; $hide_end="-->"; }

// �ڷ�� ����� ����ϴ��� ���ϴ��� ǥ��;;
if(!$setup[use_pds]) { $hide_pds_start="<!--";$hide_pds_end="-->";}

if($s_data[use_html2]) $use_html2=" checked ";
if($s_data[is_secret]) $secret=" checked ";

// HTML��� üũ��ư 
if($setup[use_html]==0) {
	if(!$is_admin&&$member[level]>$setup[grant_html]) { 
		$hide_html_start="<!--";
		$hide_html_end="-->"; 
	}
}

// HTML ��� üũ�� Ȯ���Ŵ
if(!$s_data[use_html2]) $value_use_html2 = 1;
else $value_use_html2=$s_data[use_html2];
$use_html2 .= " value='$value_use_html2' onclick='check_use_html2(this)'><ZeroBoard";

// ��б� ���;;
if(!$setup[use_secret]) { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

// ȸ���α����� �Ǿ� ������ �ڸ�Ʈ ��й�ȣ�� �� ��Ÿ����;;
if($member[no]) {
	$c_name=$member[name]; $hide_c_password_start="<!--"; $hide_c_password_end="-->"; 
	$temp_name = get_private_icon($member[no], "2");
	if($temp_name) $c_name="<img src='$temp_name' border=0 align=absmiddle>";
	$temp_name = get_private_icon($member[no], "1");
	if($temp_name) $c_name="<img src='$temp_name' border=0 align=absmiddle>".$c_name;
} else $c_name="<input type=text name=name size=8 maxlength=10 class=input value=\"".$name."\">";

// �̹��� â�� ��ư
if($member[no]&&$setup[grant_imagebox]>=$member[level]) $a_imagebox="<a onfocus=blur() href='javascript:showImageBox(\"$id\")'>"; else $a_imagebox="<Zeroboard ";
if($s_data[ismember]!=$member[no]) $a_imagebox = "<Zeroboard";

// �ڵ���� ��ư
if($setup[use_html]>0) $a_codebox="<a onfocus=blur() href='javascript:showCodeBox()'>"; else $a_codebox="<Zeroboard ";

// �̸����� ��ư
$a_preview="<a onfocus=blur() href='#' onclick='javascript:return view_preview();'>";

// HTML ��� 

head(" onload=unlock() onunload=hideImageBox() ","script_comment.php");

include $dir."/comment.php";

foot();

include "_foot.php";
?>