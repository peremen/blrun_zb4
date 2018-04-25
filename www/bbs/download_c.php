<?
ob_start(); //_head.php 파일에 이미 웹로그 분석 html 코드가 삽입돼 있어 경고에러를 방지하기 위한것.

/***************************************************************************
* 공통 파일 include
**************************************************************************/
include "_head.php";

if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)) die();

/***************************************************************************
* 게시판 설정 체크
**************************************************************************/

// 사용권한 체크
if($setup[grant_view]<$member[level]&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$parent&file=zboard.php");

// 현재글의 Download 수를 올림;;
if($filenum==1) {
	mysql_query("update `$t_comment"."_$id` set download1=download1+1 where no='$no'");
} else {
	mysql_query("update `$t_comment"."_$id` set download2=download2+1 where no='$no'");
}

$data=mysql_fetch_array(mysql_query("select * from `$t_comment"."_$id` where no='$no'"));

// 다운로드;;
function mb_basename($path) { $arr=explode('/',$path); return end($arr); }
function utf2euc($str) { return iconv("UTF-8","cp949//IGNORE",$str); }
function is_ie() {
	if(!isset($_SERVER['HTTP_USER_AGENT'])) return false;
	if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false) return true; // IE10 이하
	if(strpos($_SERVER['HTTP_USER_AGENT'],'rv:11')!==false) return true; // IE11
	if(strpos($_SERVER['HTTP_USER_AGENT'],'Edge')!==false) return true; // Edge
	return false;
}

$filepath = $data["file_name".$filenum];
$filesize = filesize($filepath);
$filename = mb_basename($filepath);
if(is_ie()) $filename = utf2euc($filename);

header("Pragma: public");
header("Expires: 0");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");

readfile($filepath);
?>
