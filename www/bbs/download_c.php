<?
ob_start(); //_head.php 파일에 이미 웹로그 분석 html 코드가 삽입돼 있어 경고에러를 방지하기 위한것.

/***************************************************************************
* 공통 파일 include
**************************************************************************/
include "_head.php";

if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)) die();

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
$filename="s_file_name".$filenum;
$filepath=$data["file_name".$filenum];
$filename=$data[$filename];

header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=\"$filename\""); 
readfile("$filepath");

if($connect) {
	@mysql_close($connect);
	unset($connect);
}
?>