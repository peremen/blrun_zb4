<?
ob_start(); //_head.php ���Ͽ� �̹� ���α� �м� html �ڵ尡 ���Ե� �־� ������� �����ϱ� ���Ѱ�.

/***************************************************************************
* ���� ���� include
**************************************************************************/
include "_head.php";

if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)) die();

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