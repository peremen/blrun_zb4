<?
ob_start(); //_head.php ���Ͽ� �̹� ���α� �м� html �ڵ尡 ���Ե� �־� ������� �����ϱ� ���Ѱ�.

/***************************************************************************
* ���� ���� include
**************************************************************************/
include "_head.php";

if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)) die();

/***************************************************************************
* �Խ��� ���� üũ
**************************************************************************/

// ������ üũ
if($setup[grant_view]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$parent&file=zboard.php");

// ������� Download ���� �ø�;;
if($filenum==1) {
	mysql_query("update `$t_comment"."_$id` set download1=download1+1 where no='$no'");
} else {
	mysql_query("update `$t_comment"."_$id` set download2=download2+1 where no='$no'");
}

$data=mysql_fetch_array(mysql_query("select * from `$t_comment"."_$id` where no='$no'"));

// �ٿ�ε�;;
function mb_basename($path) { $arr=explode('/',$path); return end($arr); }
function euc2utf($str) { return iconv("cp949//IGNORE","UTF-8",$str); }
function is_ie() {
	if(!isset($_SERVER['HTTP_USER_AGENT'])) return false;
	if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false) return true; // IE10 ����
	if(strpos($_SERVER['HTTP_USER_AGENT'],'rv:11')!==false) return true; // IE11
	if(strpos($_SERVER['HTTP_USER_AGENT'],'Edge')!==false) return true; // Edge
	return false;
}

$filepath = $data["file_name".$filenum];
$filesize = filesize($filepath);
$filename = mb_basename($filepath);
if(!is_ie()) $filename = euc2utf($filename);

header("Pragma: public");
header("Expires: 0");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");

readfile($filepath);
?>