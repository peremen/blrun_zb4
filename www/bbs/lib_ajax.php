<?
/******************************************************************************
 * Zeroboard library
 *
 * ������ �������� : 2006. 3. 15
 * �� ���ϳ��� ��� �Լ��� ���Ͻô´�� ����ϼŵ� �˴ϴ�.
 *
 * by zero (zero@nzeo.com)
 *
 ******************************************************************************/
// �ѱ� ���ڵ� �� W3C P3P �Ծ༳��
@header("Content-Type: text/html; charset=euc-kr");
@header("P3P : CP=\"ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC\"");

// ���� ����
$zb_version = "4.1 pl8";

/*******************************************************************************
 * ���� ������ ������ register_globals_off�϶� ���� �� ����
 ******************************************************************************/
@error_reporting(E_ALL ^ E_NOTICE);
foreach($_GET as $key=>$val) $$key = del_html($val);
@extract($_POST);
@extract($_SERVER);
@extract($_ENV);

$page = (int)$page;

$temp_filename=realpath(__FILE__);
if($temp_filename) $config_dir=preg_replace("#lib_ajax.php#i","",$temp_filename);
else $config_dir="";

/*******************************************************************************
 * �⺻ ���� �ʱ�ȭ. (php�� �������� ���� ���� ������;; �Ѥ�+)
 ******************************************************************************/
unset($member);
unset($group);
unset($setup);
unset($s_que);
$safe_sa=array('headnum','subject','name','hit','vote','reg_date','download1','download2');
if(!in_array($select_arrange,$safe_sa)) unset($select_arrange);
if(!in_array($desc,array('desc','asc'))) unset($desc);

/*******************************************************************************
 * include �Ǿ������� �˻�
 ******************************************************************************/
if(defined("_zb_lib_included")) return;
define("_zb_lib_included",true);

$_startTime=getmicrotime();

/*******************************************************************************
 * �⺻ ���� ������ ����
 ******************************************************************************/
include_once "include/get_url.php";
$_zbDefaultSetup = getDefaultSetup();
$_zb_url = zbUrl();
$_zb_path = $config_dir;
$ssl_url = sslUrl();

// ������ ���̺�� ȸ������ ���̺��� �̸��� �̸� ������ ����
$member_table = "zetyx_member_table";  // ȸ������ ����Ÿ�� ��� �ִ� �������� ���̺�
$group_table = "zetyx_group_table";   // �׷����̺�
$admin_table="zetyx_admin_table";     // �Խ����� ������ ���̺�
$board_imsi_table="zetyx_board_imsi"; // �Խ��� �ӽ����� ���̺�
$comment_imsi_table="zetyx_board_comment_imsi"; // �ڸ�Ʈ �ӽ����� ���̺�

$send_memo_table ="zetyx_send_memo";
$get_memo_table ="zetyx_get_memo";

$t_division="zetyx_division"; // Division ���̺�
$t_board = "zetyx_board"; // ���� ���̺�
$t_comment ="zetyx_board_comment"; // �ڸ�Ʈ���̺�
$t_category ="zetyx_board_category"; // ī�װ� ���̺�

/*******************************************************************************
 * install �������� �ƴ� ���
 ******************************************************************************/
if(!preg_match("/install/i",$PHP_SELF)&&file_exists($_zb_path."myZrCnf2019.php")) {

	// ���� ���丮�� �������� ������ ���� �� 777���� �ο�
	if(!is_dir($_zb_path.$_zbDefaultSetup[session_path])) {
		mkdir($_zb_path.$_zbDefaultSetup[session_path], 0777, true);
		chmod($_zb_path.$_zbDefaultSetup[session_path], 0777);
	}

	// Data, Icon, ���ǵ��丮�� ���� ������ ���ٸ� ���� ó��
	if(!is_writable($_zb_path."data")) error("Data ���丮�� ���� ������ �����ϴ�<br>���κ��带 ����ϱ� ���ؼ��� Data ���丮�� ���� ������ �־�� �մϴ�");
	if(!is_writable($_zb_path."icon")) error("icon ���丮�� ���� ������ �����ϴ�<br>���κ��带 ����ϱ� ���ؼ��� icon ���丮�� ���� ������ �־�� �մϴ�");
	if(!is_writable($_zb_path.$_zbDefaultSetup[session_path])) error("���� ���丮(".$_zb_path.$_zbDefaultSetup[session_path].")�� ���� ������ �����ϴ�<br>���κ��带 ����ϱ� ���ؼ��� ���ǵ��丮�� ���� ������ �־�� �մϴ�");

	$_sessionStart = getmicrotime();
	//@session_save_path($_zb_path.$_zbDefaultSetup[session_path]);
	@session_cache_limiter('nocache, must_revalidate');

	session_set_cookie_params(0,"/");

	// ���� ������ ���
	@session_start();

	// ��ȸ�� �� 512byte��, ��ǥ ���Ǻ����� 256byte�� ������ ���� (���μ����� �̿�ÿ��� ���� �� �÷��� ��)
	if(strlen($_SESSION['zb_hit'])>$_zbDefaultSetup[session_view_size]) {
		$_SESSION['zb_hit']='';
	}
	if(strlen($_SESSION['zb_vote'])>$_zbDefaultSetup[session_vote_size]) {
		$_SESSION['zb_vote']='';
	}

	// �ڵ� �α����϶� ����� �� �ڵ� �α������� üũ�ϴ� �κ�
	unset($autoLoginData);
	$autoLoginData = getZBSessionID();
	if($autoLoginData[no]) {
		// DB ����
		if(!$connect) $connect=dbConn();
		// ��� ���� ���ؿ���
		$_dbTimeStart = getmicrotime();
		$m=mysql_fetch_array(mysql_query("select email from $member_table where no ='".$autoLoginData[no]."'"));
		$_dbTime += getmicrotime()-$_dbTimeStart;
		// email IP ǥ�� �ҷ��� ó��
		if(preg_match("#\|\|\|([0-9.]{1,})$#",$m[email],$c_match)) {
			$tokenID = $c_match[1]; // lib_ajax.php ���� ������ ����.
		}
		// �ڵ��α��� ���� ó��
		$_SESSION['zb_logged_no']=$autoLoginData[no];
		$_SESSION['zb_logged_ip']=$REMOTE_ADDR;
		$_SESSION['zb_logged_time']=time();
		$_SESSION['_token']=$_COOKIE['token'];
	// ���� ���� üũ�Ͽ� �α����� ó��
	} elseif($_SESSION['zb_logged_no']) {
		// DB ����
		if(!$connect) $connect=dbConn();
		// ��� ���� ���ؿ���
		$_dbTimeStart = getmicrotime();
		$m=mysql_fetch_array(mysql_query("select email from $member_table where no ='".$_SESSION['zb_logged_no']."'"));
		$_dbTime += getmicrotime()-$_dbTimeStart;
		// email IP ǥ�� �ҷ��� ó��
		if(preg_match("#\|\|\|([0-9.]{1,})$#",$m[email],$c_match)) {
			$tokenID = $c_match[1]; // lib_ajax.php ���� ������ ����.
		}
		// �ڵ��α����� �ƴ� �� ���� ó��
		// ��ȿ�� ��� �α��� �ð��� �ٽ� ����
		$_SESSION['zb_logged_time']=time();
	}
	$_sessionEnd = getmicrotime();

	// ���� �������� ����Ÿ�� üũ�Ͽ� ���Ϸ� ���� (ȸ��, ��ȸ������ �����ؼ� ����)
	$_nowConnectStart = getmicrotime();
	if($_zbDefaultSetup[nowconnect_enable]=="true") {
		$_zb_now_check_intervalTime = time()-$_SESSION['zb_last_connect_check'];

		if(!$_SESSION['zb_last_connect_check']||$_zb_now_check_intervalTime>$_zbDefaultSetup[nowconnect_refresh_time]) {

			// 5.3 �̻�� ���� ó��
			$_SESSION['zb_last_connect_check'] = time();

			if($_SESSION['zb_logged_no']) {
				$total_member_connect = $total_connect = getNowConnector($_zb_path."data/now_member_connect.php",$_SESSION['zb_logged_no']);
				$total_guest_connect = getNowConnector_num($_zb_path."data/now_connect.php", TRUE);
			} else {
				$total_member_connect = $total_connect = getNowConnector_num($_zb_path."data/now_member_connect.php", TRUE);
				$total_guest_connect = getNowConnector($_zb_path."data/now_connect.php",$_SERVER['REMOTE_ADDR']);
			}
		} else {
			$total_member_connect = $total_connect = getNowConnector_num($_zb_path."data/now_member_connect.php",FALSE);
			$total_guest_connect = getNowConnector_num($_zb_path."data/now_connect.php",FALSE);
		}

	}

}

$_nowConnectEnd = getmicrotime();

// myZrCnf2019.php ������ ��ġ�� ����;;
$temp_filename=realpath(__FILE__);
if($temp_filename) $config_dir=preg_replace("#lib_ajax.php#i","",$temp_filename);
else $config_dir="";


// ������� ���� PC�� �� ó��
$browser=$HTTP_USER_AGENT; //echo $browser;
if(preg_match("/(iPhone|iPod|IEMobile|Mobile|lgtelecom|PPC)/i",$browser)) $browser="0"; else $browser="1";
//echo $browser;

// DB�� ������ �Ǿ������� �˻�
if(!file_exists($config_dir."myZrCnf2019.php")&&!preg_match("/install/i",$PHP_SELF)) {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=install.php\">";
	exit;
}

// ����ũ�� Ÿ�� ����
function getmicrotime() {
	$microtimestmp = preg_split("/ /",microtime());
	return $microtimestmp[0]+$microtimestmp[1];
}

// ����ũ�μ�����Ÿ�ӽ����� ����
function getMicrosecond()
{
	$microtimestmp = preg_split("/ /",microtime());
	return $microtimestmp[1].substr($microtimestmp[0], 2, 6);
}

/******************************************************************************
* Division ���� �Լ�
*****************************************************************************/
// ��ü division ����
function total_division() {
	global $connect, $t_division, $id;
	$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$id"));
	return $temp[0];
}

// ����϶� �ش� division�� num �� ����
function plus_division($division) {
	global $connect, $t_division, $id;
	mysql_query("update $t_division"."_$id set num=num+1 where division='$division'") or error(mysql_error());
}

// �����ϰų� �������� �Ϲݱ۷� �ű�� ���� division num�� ��ȭ�� �ش� division�� num�� ���ҽ�Ŵ
function minus_division($division) {
	global $connect, $t_division, $id;
	mysql_query("update $t_division"."_$id set num=num-1 where division='$division'") or error(mysql_error());
}

// �űԱ۾����϶� �ֱ� division�� num �� ����
function add_division($board_name="") {
	global $connect, $t_division, $id, $t_board;
	if($board_name) $board_id=$board_name;
	else $board_id=$id;
	$temp=mysql_fetch_array(mysql_query("select num from $t_division"."_$board_id order by division desc limit 1"));

	// ���� division�� num���� ���ذ��϶��� division +1 ����;
	if($temp[0]>=5000) {
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_id"));
		$max_division=$temp[0]+1;
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_id where num>0 and division!='$max_division'"));
		if(!$temp[0]) $second_division=0; else $second_division=$temp[0];
		$temp=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$board_id where (division='$max_division' or division='$second_division') and headnum<=-2000000000"));
		if($temp[0]>0) {
			mysql_query("update $t_board"."_$board_id set division='$max_division' where (division='$max_division' or division='$second_division') and  headnum<='-2000000000'") or error(mysql_error());
			mysql_query("update $t_division"."_$board_id set num=num-$temp[0] where division=$max_division-1") or error(mysql_error());
		}
		$num=$temp[0]+1;
		mysql_query("insert into $t_division"."_$board_id (division,num) values ('$max_division','$num')");
		return $max_division;
	} else {
	// ���� division�� ���ذ������� ������~
		$temp=mysql_fetch_array(mysql_query("select max(division) from $t_division"."_$board_id"));
		$division=$temp[0];
		mysql_query("update $t_division"."_$board_id set num=num+1 where division='$division'");
		return $division;
	}
}

/******************************************************************************
* �α����� �Ǿ� �ִ����� �˻��Ͽ� �α��εǾ������� �ش� ȸ���� ������ ����
*****************************************************************************/
function member_info() {

	global $member_table, $member, $connect;

	if(defined("_member_info_included")&&$member[no]) return $member;
	define("_member_info_included", true);

	if($member[no]) return $member;

	if($_SESSION['zb_logged_no']) {
		$member=mysql_fetch_array(mysql_query("select * from $member_table where no ='".$_SESSION['zb_logged_no']."'"));
		if(!$member[no]) {
			unset($member);
			$member[level] = 10;
		}
	} else $member[level] = 10;

	return $member;
}

function group_info($no) {
	global $group_table;
	$temp=mysql_fetch_array(mysql_query("select * from $group_table where no='$no'"));
	return $temp;
}

/******************************************************************************
* ���κ��� ���� �Լ�
*****************************************************************************/
// MySQL ����Ÿ ���̽��� ����
function dbconn() {

	global $connect, $config_dir, $autologin, $_COOKIE, $_dbconn_is_included;

	if($_dbconn_is_included) return;
	$_dbconn_is_included = true;

	$f=@file($config_dir."myZrCnf2019.php") or Error("myZrCnf2019.php������ �����ϴ�.<br>DB������ ���� �Ͻʽÿ�","install.php");

	for($i=1;$i<=4;$i++) $f[$i]=trim(str_replace("\n","",$f[$i]));

	if(!$connect){
		$connect = @mysql_connect($f[1],$f[2],$f[3]);
		@mysql_query("set names euckr",$connect);
	}
	if(!$connect) Error("DB ���ӽ� ������ �߻��߽��ϴ�!");

	@mysql_select_db($f[4], $connect) or Error("DB Select ������ �߻��߽��ϴ�","");

	return $connect;
}

// ���� �������� �̾���;;
function get_icon($data) {
	global $dir;

	// �۾� �ð� ����
	$check_time=(time()-$data[reg_date])/60/60;

	// �տ� �ٴ� ������ ����
	if($data[depth]) {
		if($check_time<=48) $icon="<img src=$dir/reply_new_head.gif border=0 align=absmiddle>&nbsp;"; // �ֱ� ���ϰ��
		else $icon="<img src=$dir/reply_head.gif border=0 align=absmiddle>&nbsp;"; // ����϶�
	} else {
		if($check_time<=48) $icon="<img src=$dir/new_head.gif border=0 align=absmiddle>&nbsp;"; // �ֱ� ���ϰ��
		else $icon="<img src=$dir/old_head.gif border=0 align=absmiddle>&nbsp;";          // ����� �ƴҶ�
	}
	if($data[headnum]<=-2000000000) $icon="<img src=$dir/notice_head.gif border=0 align=absmiddle>&nbsp;"; // ���������϶�
	else if($data[is_secret]==1) $icon="<img src=$dir/secret_head.gif border=0 align=absmiddle alt='��б��Դϴ�'>&nbsp;";
	return $icon;
}

// ȸ�� ���ο��� �־����� �������� ã�� �Լ�
// $type : 1 -> �̸��տ� ��Ÿ���� ������
// $type : 2 -> �̸��� ����ϴ� ������
function get_private_icon($no, $type) {
	if($type==1) $dir = "icon/private_icon/";
	elseif($type==2) $dir = "icon/private_name/";

	if(@file_exists($dir.$no.".gif")) return $dir.$no.".gif";
}

// �̸� �տ� �ٴ� �� ������
function get_face($data, $check=0) {
	global $group;

	// �̸��տ� �ٴ� ������ ����;;
	if($group[use_icon]==0) {
		if($data[ismember]) {
			if($data[islevel]==2) $face_image="<img src=images/admin2_face.gif border=0 align=absmiddle>";
			elseif($data[islevel]==1) $face_image="<img src=images/admin1_face.gif border=0 align=absmiddle>";
			else {
				if($group[icon]) $face_image="<img src=icon/$group[icon] border=0 align=absmiddle>";
				else $face_image="<img src=images/member_face.gif border=0 align=absmiddle>";
			}
		}
		else $face_image="<img src=images/blank_face.gif border=0 align=absmiddle> ";
	}

	$temp_name = get_private_icon($data[ismember], "1");
	if($temp_name) $face_image="<img src='$temp_name' border=0 align=absmiddle>";

	if($group[use_icon]<2&&$data[ismember]) $face_image .= "<b>";

	return $face_image;
}

// �Խ��� ���������� üũ�ϴ� �κ�
function check_board_master($member, $board_num) {
	$temp = preg_split("/,/",$member[board_name]);
	for($i=0;$i<count($temp);$i++) {
		$t = trim($temp[$i]);
		if($t&&$t==$board_num) return 1;
	}
	return 0;
}

//  �ʱ� ����� �ѷ��ִ� �κ�;;;;
function head($body="",$scriptfile="") {

	global $group, $setup, $dir, $member, $PHP_SELF, $id, $_head_executived, $_COOKIE, $width, $_view_included, $_zbDefaultSetup, $is_admin;

	if($_head_executived) return;
	$_head_executived = true;

	$f = @fopen("license.txt","r");
	$license = @fread($f,filesize("license.txt"));
	@fclose($f);

	print "<!--\n".$license."\n-->\n";

	if(!preg_match("/member_/i",$PHP_SELF)) $stylefile="skin/$setup[skinname]/style.css"; else $stylefile="style.css";

	if($setup[use_formmail]) {
		$f = fopen("script/script_zbLayer.php","r");
		$zbLayerScript = fread($f, filesize("script/script_zbLayer.php"));
		fclose($f);
	}

	// html ���ۺκ� ���
	if($setup[skinname]) {
	?>
<html>
<head>
<title><?=$setup[title]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="image_src" href="../blrun2_fb.jpg">
<link rel="alternate" type="application/rss+xml" title="<?=$_zbDefaultSetup[sitename]?>" href="<?=str_replace("www.","",substr(zbUrl(),0,strpos(zbUrl(),"/bbs/")))."/rss/"?>">
<link rel=StyleSheet HREF=<?=$stylefile?> type=text/css title=style>

<!-- SyntaxHighlighter ���� ��� -->
<link rel="stylesheet" type="text/css" href="syntaxhighlighter/styles/shThemeDefault.css" />
<link rel="stylesheet" type="text/css" href="syntaxhighlighter/styles/shCore.css" />
<script type="text/javascript" src="syntaxhighlighter/scripts/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/shAutoloader.js"></script>
<script type="text/javascript" src="syntaxhighlighter/scripts/jQuery.js"></script>
<!-- SyntaxHighlighter ���� ��� �� -->

<!-- �߰� ��ũ��Ʈ �ε� -->
<script language='JavaScript'>
// ī�װ� ���� ���ε� ���� ���
function category_change(obj) {
	var myindex=obj.selectedIndex;
	document.search.category.value=obj.options[myindex].value;
	document.search.submit();
	return true;
}
// ���� �̹��� �ڽ� �ڵ鷯 ���� ����
var imageBoxHandler;
</script>
<!-- �߰� ��ũ��Ʈ �ε� �� -->
<? if($setup[use_formmail]) echo $zbLayerScript; ?>
<? if($scriptfile) include "script/".$scriptfile; ?>

</head>
<body topmargin='4' leftmargin='0' marginwidth='0' marginheight='0' <?=$body?><? if($setup[bg_color]) echo " bgcolor=".$setup[bg_color]." "; if($setup[bg_image]) echo " background=".$setup[bg_image]." "; ?>>
<?
		if($group[header_url]) { @include $group[header_url]; }
		if($setup[header_url]) { @include $setup[header_url]; }
		if($group[header]) echo stripslashes($group[header]);
		if($setup[header]) echo stripslashes($setup[header]);
?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> height=1 style="table-layout:fixed;"><col width=100%></col><tr><td><img src=images/t.gif border=0 width=98% height=1 name=zb_get_table_width><br><img src=images/t.gif border=0 name=zb_target_resize width=1 height=1></td></tr></table>
<form name=check_attack><input type=hidden id=check name=check value=0></form>
<div id='zb_waiting' style='position:absolute; top:50%; left:50%; width:292px; height:91px; overflow:hidden; margin-top:-45px; margin-left:-146px; z-index:1; visibility: hidden'>
<table border=0 width=98% cellspacing=1 cellpadding=0 bgcolor=black>
<form name=waiting_form>
<tr bgcolor=white>
	<td>
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
		<tr>
			<td><img src=images/waiting_left.gif border=0></td>
			<td><img src=images/waiting_top.gif border=0><br><img src=images/waiting_text.gif></td>
		</tr>
		</table>
	</td>
</tr>
</form>
</table>
</div>
<?
	} else {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="image_src" href="../blrun2_fb.jpg">
<link rel="alternate" type="application/rss+xml" title="<?=$_zbDefaultSetup[sitename]?>" href="<?=str_replace("www.","",substr(zbUrl(),0,strpos(zbUrl(),"/bbs/")))."/rss/"?>">
<link rel=StyleSheet HREF=style.css type=text/css title=style>
<? if($scriptfile) include "script/".$scriptfile; ?>

</head>
<body topmargin='0' leftmargin='0' marginwidth='0' marginheight='0' <?=$body?>>
<?
		if($group[header_url]) { @include $group[header_url]; }
		if($group[header]) echo stripslashes($group[header]);
	}

}

// Ǫ�� �κ� ���
function foot($max_depth="",$all_depth="") {

	global $width, $group, $setup, $_startTime , $_queryTime , $_foot_executived, $_skinTime, $_sessionStart, $_sessionEnd, $_nowConnectStart, $_nowConnectEnd, $_dbTime, $_listCheckTime, $_zbResizeCheck, $max_depth, $all_depth;

	if(!$all_depth) $all_depth=$max_depth;

	if($_foot_executived) return;
	$_foot_executived = true;

	$maker_file=@file("skin/$setup[skinname]/maker.txt");
	if($maker_file[0]) $maker="/ skin by $maker_file[0]";
	else $maker = "";

	if($setup[skinname]) {
	?>

<table border=0 cellpadding=0 cellspacing=0 height=20 width=<?=$width?>>
<tr>
	<td align=right style=font-family:tahoma,����;font-size:8pt;line-height:150%;letter-spacing:0px>
		<font style=font-size:7pt>Copyright 1999-<?=date("Y")?></font> <font style=font-family:tahoma,����;font-size:8pt;><a href=http://www.xpressengine.com/zb4_main target=_blank onfocus=blur()>Zeroboard</a> <?=$maker?></font>
	</td>
</tr>
</table>

<?
		if($_zbResizeCheck) {
?>

<!-- �̹��� ������� ���ؼ� ó���ϴ� �κ� -->
<script>
// onload �߰� ���� ���� ���
function addLoadEvent(func){
	var oldonload = window.onload;
	if(typeof window.onload != 'function'){
		window.onload = func;
	}else{
		window.onload = function(){
			oldonload();
			func();
		};
	}
}
function zb_img_check(){
	var zb_main_table_width = document.zb_get_table_width.width*(100-5*<?=$all_depth?>-4)/100;
	var zb_target_resize_num = document.zb_target_resize.length;
	for(i=0;i<zb_target_resize_num;i++){
		if(document.zb_target_resize[i].width > zb_main_table_width) {
			document.zb_target_resize[i].height = document.zb_target_resize[i].height * zb_main_table_width / document.zb_target_resize[i].width;
			document.zb_target_resize[i].width = zb_main_table_width;
		}
	}
}
addLoadEvent(zb_img_check);
</script>
<!-- �̹��� ������� ���ؼ� ó���ϴ� �κ� �� -->

<?
		}

		if($setup[footer]) echo stripslashes($setup[footer]);
		if($group[footer]) echo stripslashes($group[footer]);
		if($setup[footer_url]) { @include $setup[footer_url]; }
		if($group[footer_url]) { @include $group[footer_url]; }
?>

<!-- ������� ���� ��� -->
<?
$_dbTimeStart = getmicrotime();
$re=mysql_fetch_array(mysql_query("SELECT target from `aokio_log_config` order by no desc limit 1"));
$_dbTime += getmicrotime()-$_dbTimeStart;
$target=$re[0];
@include "aanalyzer/aokio_analyzer.php";
?>
<script src="aanalyzer/screen.js" type="text/javascript"></script>

</body>
</html>
<?

	} else {

		if($group[footer]) echo stripslashes($group[footer]);
		if($group[footer_url]) { @include $group[footer_url]; }

?>

</body>
</html>
	<?
	}

	$_phpExcutedTime = (getmicrotime()-$_startTime)-($_sessionEnd-$_sessionStart)-($_nowConnectEnd-$_nowConnectStart)-$_dbTime-$_skinTime;
	// ����ð� ���
	echo "\n\n<!--";
	if($_sessionStart&&$_sessionEnd)  		echo "\n Session Excuted  : ".sprintf("%0.4f",$_sessionEnd-$_sessionStart);
	if($_nowConnectStart&&$_nowConnectEnd) 	echo "\n Connect Checked  : ".sprintf("%0.4f",$_nowConnectEnd-$_nowConnectStart);
	if($_dbTime)  							echo "\n Query Excuted  : ".sprintf("%0.3f",$_dbTime);
	if($_phpExcutedTime)  					echo "\n PHP Excuted  : ".sprintf("%0.3f",$_phpExcutedTime);
	if($_listCheckTime) 					echo "\n Check Lists : ".sprintf("%0.3f",$_listCheckTime);
	if($_skinTime) 							echo "\n Skins Excuted  : ".sprintf("%0.3f",$_skinTime);
	if($_startTime) 						echo "\n Total Excuted Time : ".sprintf("%0.3f",getmicrotime()-$_startTime);
	echo "\n-->\n";
}

// zbLayer ���
function check_zbLayer($data) {
	global $zbLayer, $setup, $member, $is_admin, $id, $_zbCheckNum;
	if($setup[use_formmail]) {
		if(!$_zbCheckNum) $_zbCheckNum=0;
		//$data[name]=stripslashes($data[name]);
		$data[name]=urlencode($data[name]);

		if($data[homepage]){
			$data[homepage]=str_replace("http://","",$data[homepage]);
			$data[homepage]="http://".str_replace("%2F", "/", urlencode($data[homepage]));
		}

		$data[email]=base64_encode($data[email]);

		$_zbCheckNum++;
		$_zbCount=1;

		if(($member[is_admin]==1||$member[is_admin]==2)&&$data[ismember]) {
			$traceID = $data[ismember];
			$traceType="t";
			$isAdmin=1;
		} elseif(($member[is_admin]==1||$member[is_admin]==2)&&!$data[ismember]) {
			$traceID = $data[name];
			$traceType="tn";
			$isAdmin=1;
		}

		if($member[no]) $isMember = 1;

		if($data[ismember]<1) $data[ismember]="";

		$zbLayer = $zbLayer."\nprint_ZBlayer('zbLayer$_zbCheckNum', '".$data[homepage]."', '$data[email]', '$data[ismember]', '$id', '$data[name]', '$traceID', '$traceType', '$isAdmin', '$isMember');";
	}
	return $_zbCount;
}

// ���� �޼��� ���
function error($message, $url="") {
	global $setup, $connect, $dir, $config_dir;

	$dir="skin/".$setup[skinname];

	if($url=="window.close") {
		$message=str_replace("<br>","\\n",$message);
		$message=str_replace("\"","\\\"",$message);
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script>
alert("<?=$message?>");
window.close();
</script>
<?
	} else {

		head();

		if($setup[skinname]) {
			include "skin/$setup[skinname]/error.php";
		} else {
			include $config_dir."error.php";
		}

		foot();

	}

	exit;
}

// �Խ��� ������ �о��
function get_table_attrib($id) {

	global $connect, $admin_table;
	if(!is_string($id)) return false;
	$id=mysql_real_escape_string($id);
	$data=mysql_fetch_assoc(mysql_query("select * from $admin_table where `name`='$id' limit 1;",$connect));

	if($data[table_width]<=100) $data[table_width]=$data[table_width]."%";

	// ������ IP�� �����ִ� ����ε�, DB ������ ���ϱ� ���ؼ� �̹��� �ڽ� ��� �������� �����Ͽ� ���
	if(!$data[use_showip]) $data[use_showip] = 0;
	$data[grant_imagebox] = $data[use_showip];

	return $data;
}

// �Խ����� �������� �˻�
function istable($str, $dbname='') {
	global $config_dir;
	if(!$dbname) {
		$f=@file($config_dir."myZrCnf2019.php") or Error("myZrCnf2019.php������ �����ϴ�.<br>DB������ ���� �Ͻʽÿ�","install.php");
		for($i=1;$i<=4;$i++) $f[$i]=str_replace("\n","",$f[$i]);
		$dbname=$f[4];
	}

	$result = mysql_query("show tables from $dbname") or error(mysql_error(),"");

	$i=0;

	while ($i < mysql_num_rows($result)) {
		if($str==mysql_tablename ($result, $i)) return 1;
		$i++;
	}
	return 0;
}

// ���� �����ǿ� �־��� ������ ����Ʈ�� ���Ͽ� ������ �� ��������� �˻�
function check_blockip() {
	global $setup;
	$avoid_ip=explode(",",$setup[avoid_ip]);
	$count = count($avoid_ip);
	for($i=0;$i<$count;$i++) {
		$avoid_ip[$i]=trim($avoid_ip[$i]);
		if(!isblank($avoid_ip[$i])&&preg_match("#".$avoid_ip[$i]."#i",$_SERVER['REMOTE_ADDR'])) Error("���ܴ��� IP �ּ��Դϴ�.");
	}
}

// �����ڼ� üũ
function getNowConnector($filename,$div) {
	global $_zbDefaultSetup;
	$_str = trim(zReadFile($filename));
	$num = 0;
	if($_str) {
		$_str = str_replace("<?php die('Access Denied');/*","",$_str);
		$_str = str_replace("*/?>","",$_str);
		$_connector = explode(":",$_str);
		$_sizeConnector = count($_connector);
		$_nowtime = date("YmdHi");
		unset($_realNowConnector);
		if($_sizeConnector) {
			for($i=0;$i<$_sizeConnector;$i++) {
				$_time = substr($_connector[$i],0,12);
				$_div = substr($_connector[$i],12);
				if($_time+$_zbDefaultSetup[nowconnect_time]>=$_nowtime&&$_div!=$div) {
					$_realNowConnector.=$_time.$_div.":";
					$num++;
				}
			}
		}
	}
	$_realNowConnector.=$_nowtime.$div;
	zWriteFile($filename, "<?php die('Access Denied');/*".$_realNowConnector."*/?>");
	return $num;
}

// �����ڼ� ���ϱ�
function getNowConnector_num($filename, $FLAG=FALSE) {
	global $_zbDefaultSetup;
	$_str = trim(zReadFile($filename));
	$num = 0;
	if($_str) {
		$_str = str_replace("<?php die('Access Denied');/*","",$_str);
		$_str = str_replace("*/?>","",$_str);
		$_connector = explode(":",$_str);
		$_sizeConnector = count($_connector);
		$_nowtime = date("YmdHi");
		unset($_realNowConnector);
		if($_sizeConnector) {
			for($i=0;$i<$_sizeConnector;$i++) {
				$_time = substr($_connector[$i],0,12);
				$_div = substr($_connector[$i],12);
				if($_time+$_zbDefaultSetup[nowconnect_time]>=$_nowtime) {
					$_realNowConnector.=$_time.$_div.":";
					$num++;
				}
			}
		}
	}
	if($FLAG) {
		zWriteFile($filename, "<?php die('Access Denied');/*".$_realNowConnector."*/?>");
	}
	return $num;
}

// ���κ��� �ڵ� �α��� ���ǰ��� �ִ��� �Ǵ��ؼ� ������ �ش� ���� ����
function getZBSessionID() {
	global $_zb_path, $_zbDefaultSetup;

	$zbSessionID = $_COOKIE['ZBSESSIONID'];

	if(!$_zb_path || !$_zbDefaultSetup || !$zbSessionID || !preg_match('/^[0-9a-f]+$/', $zbSessionID)) {
		return array();
	}
	$str = zReadFile($_zb_path.$_zbDefaultSetup['session_path'].'/zbSessionID_'.$zbSessionID.'.php');

	if(!$str) {
		@setcookie('ZBSESSIONID', '', time()+60*60*24*365, '/');
		@setcookie('ZB_AUTOLOGIN_TOKEN', '', time()+60*60*24*365, '/');
		return array();
	}

	$str = explode("\n",$str);

	$data = array();
	$data['no'] = trim($str[1]);
	$data['token'] = trim($str[2]);

	if(!$_COOKIE['ZB_AUTOLOGIN_TOKEN'] || $_COOKIE['ZB_AUTOLOGIN_TOKEN'] != $data['token']) {
		@setcookie('ZBSESSIONID', '', time()+60*60*24*365, '/');
		@setcookie('ZB_AUTOLOGIN_TOKEN', '', time()+60*60*24*365, '/');
		return array();
	}

	destroyZBSessionID($data['no'], $zbSessionID, false);
	makeZBSessionID($data['no']);

	return $data;
}

// ���κ��� �ڵ� �α��� ���ǰ��� ����� �Լ�
function makeZBSessionID($no) {
	global $_zb_path, $_zbDefaultSetup;

	$zbSessionID = hash('sha512', (string)microtime(true));
	$token = uniqid('', true);

	$newStr = "<?php /*\n$no\n$token\n*/ ?>";

	zWriteFile($_zb_path.$_zbDefaultSetup['session_path'].'/zbSessionID_'.$zbSessionID.'.php', $newStr);

	@setcookie('ZBSESSIONID', $zbSessionID, time()+60*60*24*365, '/');
	@setcookie('ZB_AUTOLOGIN_TOKEN', $token, time()+60*60*24*365, '/');
}

// ���κ��� �ڵ� �α��� ���ǰ� �ı��Ű�� �Լ�
function destroyZBSessionID($no, $zbSessionID='', $reset_cookie=true) {
	global $_zb_path, $_zbDefaultSetup;
	if(!$zbSessionID) {
		$zbSessionID = $_COOKIE['ZBSESSIONID'];
	}
	if(preg_match('/^[0-9a-f]+$/', $zbSessionID)) {
		z_unlink($_zb_path.$_zbDefaultSetup['session_path'].'/zbSessionID_'.$zbSessionID.'.php');
	}
	if($reset_cookie) {
		@setcookie('ZBSESSIONID', '', time()+60*60*24*365, '/');
		@setcookie('ZB_AUTOLOGIN_TOKEN', '', time()+60*60*24*365, '/');
	}
}

// ���κ����� �⺻ ���� ������ �о���� �Լ�
function getDefaultSetup() {
	global $_zb_path;
	$data = zReadFile($_zb_path."setup.php");
	$data = str_replace("<?php /*","",$data);
	$data = str_replace("*/ ?>","",$data);
	$data = explode("\n",$data);
	$_c = count($data);
	unset($defaultSetup);
	for($i=0;$i<$_c;$i++) {
		if(!preg_match("/;/",$data[$i])&&strlen(trim($data[$i]))) {
			$tmpStr = explode("=",$data[$i]);
			$name = trim($tmpStr[0]);
			$value = trim($tmpStr[1]);
			$defaultSetup[$name]=$value;
		}
	}
	if(!$defaultSetup[url]) $defaultSetup[url] = $HTTP_HOST;
	if(!$defaultSetup[sitename]) $defaultSetup[sitename] = $HTTP_HOST;
	if(!$defaultSetup[session_path]) $defaultSetup[session_path] = "data/__zbSessionTMP";
	if(!$defaultSetup[session_view_size]) $defaultSetup[session_view_size] = 512;
	if(!$defaultSetup[session_vote_size]) $defaultSetup[session_vote_size] = 256;
	if(!$defaultSetup[login_time]) $defaultSetup[login_time] = 60*30;
	if(!$defaultSetup[nowconnect_enable]) $defaultSetup[nowconnect_enable] = "true";
	if(!$defaultSetup[nowconnect_refresh_time]) $defaultSetup[nowconnect_refresh_time] = 60*3;
	if(!$defaultSetup[nowconnect_time]) $defaultSetup[nowconnect_time] = 60*5;
	if(!$defaultSetup[enable_hangul_id]) $defaultSetup[enable_hangul_id] = "false";
	if(!$defaultSetup[check_email]) $defaultSetup[check_email] = "true";
	if(!$defaultSetup[memo_limit_time]) $defaultSetup[memo_limit_time] = 7;
	$defaultSetup[memo_limit_time] = 60 * 60 * 24 * $defaultSetup[memo_limit_time];

	return $defaultSetup;
}

/******************************************************************************
 * �Ϲ� �Լ�
 *****************************************************************************/
// ���ڿ� ��� 1�� ����
function isblank($str) {
	$temp=str_replace("��","",$str);
	$temp=str_replace("\n","",$temp);
	$temp=strip_tags($temp);
	$temp=str_replace("&nbsp;","",$temp);
	$temp=str_replace(" ","",$temp);
	if(preg_match("/[^[:space:]&#xA0;&#160;&#x180E;&#6158;&#x2000;&#8192;&#x2001;&#8193;&#x2002;&#8194;	&ensp;&#x2003;&#8195;&emsp;&#x2004;&#8196;&#x2005;&#8197;&#x2006;&#8198;&#x2007;&#8199;&#x2008;&#8200;&#x2009;&#8201;&thinsp;&#x200A;&#8202;&#x200B;&#8203;&#x202F;&#8239;&#x205F;&#8287;&#x3000;&#12288;&#xFEFF;&#65279;&#x20;&#32;&#x9;&#9;&#xD;&#13;&nbsp&#8207;&rlm;]/i",$temp)) return 0;
	return 1;
}

// �����̽��� ��� 1�� ����
function isspace($str) {
	$temp=str_replace("��","",$str);
	$temp=str_replace("\n","",$temp);
	$temp=strip_tags($temp);
	$temp=str_replace("&nbsp;","",$temp);
	$temp=str_replace(" ","",$temp);
	if(preg_match("/[^[:space:]]/i",$temp)) return 0;
	return 1;
}

// ������ ��� 1�� ����
function isnum($str) {
	if(preg_match("/[^0-9]/i",$str)) return 0;
	return 1;
}

// ����, ������ �ϰ�� 1�� ����
function isalNum($str) {
	if(preg_match("/[^0-9a-zA-Z\_]/i",$str)) return 0;
	return 1;
}

// HTML Tag�� �����ϴ� �Լ�
function del_html( $str ) {
	$str = str_replace( ">", "&gt;",$str );
	$str = str_replace( "<", "&lt;",$str );
	return $str;
}

// �ֹε�Ϲ�ȣ �˻�
function check_jumin($jumin) {
	$weight = '234567892345'; // �ڸ��� weight ����
	$len = strlen($jumin);
	$sum = 0;

	if ($len <> 13) return false;

	for ($i = 0; $i < 12; $i++) {
		$sum = $sum + (substr($jumin,$i,1)*substr($weight,$i,1));
	}

	$rst = $sum%11;
	$result = 11 - $rst;

	if ($result == 10) $result = 0;
	else if ($result == 11) $result = 1;

	$ju13 = substr($jumin,12,1);

	if ($result <> $ju13) return false;
	return true;
}

// E-mail �ּҰ� �ùٸ��� �˻�
function ismail( $str ) {
	if( preg_match("/([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)/i", $str) ) return $str;
	else return '';
}

// E-mail �� MX�� �˻��Ͽ� ���� �����ϴ� �������� �˻�
function mail_mx_check($email) {
	if(!ismail($email)) return false;
	list($user, $host) = explode("@", $email);
	if (checkdnsrr($host, "MX") or checkdnsrr($host, "A")) return true;
	else return false;
}

// Ȩ������ �ּҰ� �ùٸ��� �˻�
function isHomepage( $str ) {
	if(preg_match("/^http://([a-z0-9\_\-\./~@?=&amp;-\#{5,}]+)/i", $str)) return $str;
	else return '';
}

// URL, Mail�� �ڵ����� üũ�Ͽ� ��ũ����
function autolink($str) {
	// URL ġȯ
	$str=str_replace("&nbsp;"," &nbsp;",$str);
	$homepage_pattern = "/([^\"\'\=\>\|])(mms|http|HTTP|https|HTTPS|ftp|FTP|telnet|TELNET)\:\/\/(.[^ \n\<\"\'\|]+)/";
	$str = preg_replace($homepage_pattern,"\\1<a href=\\2://\\3 target=_blank>\\2://\\3</a>", " ".$str);
	$str=str_replace(" &nbsp;","&nbsp;",$str);

	// ���� ġȯ
	$email_pattern = "/([; \n]+)([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)/";
	$str = preg_replace($email_pattern,"\\1<a href=mailto:\\2@\\3>\\2@\\3</a>", " ".$str);

	return $str;
}

// ���� ����� kb, mb�� ���߾ ��ȯ�ؼ� ����
function getfilesize($size) {
	if(!$size) return "0 Byte";
	if($size<1024) {
		return ($size." Byte");
	} elseif($size >1024 && $size< 1024 *1024)  {
		return sprintf("%0.1f KB",$size / 1024);
	}
	else return sprintf("%0.2f MB",$size / (1024*1024));
}

// ���ڿ� ���� (�̻��� �����϶��� ... �� ǥ��)
function cut_str($msg,$cut_size) {
	if($cut_size<=0) return $msg;
	if(preg_match("/\[re\]/",$msg)) $cut_size=$cut_size+4;
	for($i=0;$i<$cut_size;$i++) if(ord($msg[$i])>127) $han++; else $eng++;
	$cut_size=$cut_size+(int)$han*0.6;
	$point=1;
	for ($i=0;$i<strlen($msg);$i++) {
		if ($point>$cut_size) return $pointtmp."...";
		if (ord($msg[$i])<=127) {
			$pointtmp.= $msg[$i];
			if ($point%$cut_size==0) return $pointtmp."...";
		} else {
			if ($point%$cut_size==0) return $pointtmp."...";
			$pointtmp.=$msg[$i].$msg[++$i];
			$point++;
		}
		$point++;
	}
	return $pointtmp;
}

// ������ �̵� ��ũ��Ʈ
function movepage($url) {
	global $connect;
	echo "<meta http-equiv=\"refresh\" content=\"0; url=$url\">";
	exit;
}

// input �Ǵ� textarea�� ����� �ݾ��� �ͽ��϶� �����Ͽ� ����
function size($size) {
	global $browser;
	if(!$browser) return " size=".($size*0.6)." ";
	else return " size=$size ";
}

function size2($size) {
	global $browser;
	if(!$browser) return " cols=".($size*0.6)." ";
	else return " cols=$size ";
}

// ���� ������ �Լ�
function zb_sendmail($type, $to, $to_name, $from, $from_name, $subject, $comment, $cc="", $bcc="") {
	// email IP ǥ�� �ҷ��� ó��
	if(preg_match("#\|\|\|([0-9.]{1,})$#",$to,$c_match))
		$to = str_replace($c_match[0],"",$to);
	$recipient = "$to_name <$to>";

	if($type==1) $comment = nl2br($comment);

	// email IP ǥ�� �ҷ��� ó��
	unset($c_match);
	if(preg_match("#\|\|\|([0-9.]{1,})$#",$from,$c_match))
		$from = str_replace($c_match[0],"",$from);
	$headers = "From: $from_name <$from>\n";
	$headers .= "X-Sender: <$from>\n";
	$headers .= "X-Mailer: PHP ".phpversion()."\n";
	$headers .= "X-Priority: 1\n";
	$headers .= "Return-Path: <$from>\n";

	if(!$type) $headers .= "Content-Type: text/plain; ";
	else $headers .= "Content-Type: text/html; ";
	$headers .= "charset=euc-kr\n";

	if($cc) {
		// email IP ǥ�� �ҷ��� ó��
		unset($c_match);
		if(preg_match("#\|\|\|([0-9.]{1,})$#",$cc,$c_match))
			$cc = str_replace($c_match[0],"",$cc);
		$headers .= "cc: $cc\n";
	}
	if($bcc) {
		// email IP ǥ�� �ҷ��� ó��
		unset($c_match);
		if(preg_match("#\|\|\|([0-9.]{1,})$#",$bcc,$c_match))
			$bcc = str_replace($c_match[0],"",$bcc);
		$headers .= "bcc: $bcc";
	}

	$comment = stripslashes($comment);
	$comment = str_replace("\n\r","\n", $comment);

	return mail($recipient , $subject , $comment , $headers);

}

// ������ ���丮�� ���� ������ ����
function get_dirinfo($path) {

	$handle=@opendir($path);
	while($info = readdir($handle)) {
		if($info != "." && $info != "..") {
			$dir[] = $info;
		}
	}
	closedir($handle);
	return $dir;
}

// ������ �����ϴ� �Լ�
function z_unlink($filename) {
	@chmod($filename,0777);
	$handle = @unlink($filename);
	if(@file_exists($filename)) {
		@chmod($filename,0775);
		$handle=@unlink($filename);
	}
	return $handle;
}

// ������ ������ ������ �о��
function zReadFile($filename) {
	if(!file_exists($filename)) return '';

	$f = fopen($filename,"r");
	$str = fread($f, filesize($filename));
	fclose($f);

	return $str;
}

// ������ ���Ͽ� �־��� ����Ÿ�� ��
function zWriteFile($filename, $str) {
	$f = fopen($filename,"w");
	$lock=flock($f,2);
	if($lock) {
		fwrite($f,$str);
	}
	flock($f,3);
	fclose($f);
}

// ������ ������ Locking������ �˻�
function check_fileislocked($filename) {
	$f=@fopen($filename,w);
	$count = 0;
	$break = true;
	while(!@flock($f,2)) {
		$count++;
		if($count>10) {
			$break = false;
			break;
		}
	}
	if($break!=false) @flock($f,3);
	@fclose($f);
}

// ��ȯ������ ���丮�� ����
function zRmDir($path) {
	$directory = dir($path);
	while($entry = $directory->read()) {
		if ($entry != "." && $entry != "..") {
			if (Is_Dir($path."/".$entry)) {
				zRmDir($path."/".$entry);
			} else {
				@UnLink ($path."/".$entry);
			}
		}
	}
	$directory->close();
	@RmDir($path);
}

/*********************************************************************************************
 * ��� ��Ų�� �̹��� �ڽ� �̹��� ����� ����
 ********************************************************************************************/

function thumbnail3($size,$source_file,$save_file){

	$img_info=@getimagesize($source_file);

	if($img_info[2]==1) $srcimg=@ImageCreateFromGIF($source_file);
	elseif($img_info[2]==2) $srcimg=@ImageCreateFromJPEG($source_file);
	else                     $srcimg=@ImageCreateFromPNG($source_file);

	if($img_info[0]>=$size){
		$max_width=$size;
		$max_height=ceil($img_info[1]*$size/$img_info[0]);
	}else{
		$max_width=$img_info[0];
		$max_height=$img_info[1];
	}

	if($img_info[2]==1){
		$dstimg=@ImageCreate($max_width,$max_height);
		@ImageColorAllocate($dstimg,255,255,255);
		@ImageCopyResized($dstimg, $srcimg,0,0,0,0,$max_width,$max_height,ImageSX($srcimg),ImageSY($srcimg));
	}else{
		$dstimg=@ImageCreateTrueColor($max_width,$max_height);
		@ImageColorAllocate($dstimg,255,255,255);
		@ImageCopyResampled($dstimg, $srcimg,0,0,0,0,$max_width,$max_height,ImageSX($srcimg),ImageSY($srcimg));
	}

	@ImageJPEG($dstimg,$save_file,85);

	@ImageDestroy($dstimg);
	@ImageDestroy($srcimg);
}
?>