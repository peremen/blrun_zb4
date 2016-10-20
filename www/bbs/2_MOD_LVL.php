<?
$_zb_path="./";
include "lib.php";
if(!$connect) $connect=dbConn();
$member=member_info();
if(!$member[no]||$member[is_admin]>1||$member[level]>1) Error("최고 관리자만이 사용할수 있습니다");
// 실제 검색부분
$table_name_result=mysql_query("select name from $admin_table order by name",$connect) or error(mysql_error());

head(" bgcolor=white");
?>
<div align=center>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=98%>
<tr>
  <td><img src=images/trace_left.gif border=0></td>
  <td width=100% background=images/trace_back.gif><img src=images/trace_back.gif border=0></td>
  <td><img src=images/trace_right.gif border=0></td>
</tr>
</table>
</div>

<?
$hop=0;
while($table_data=mysql_fetch_array($table_name_result))
{
	$table_name=$table_data[name];
	$cnt1=0;

	unset($temp); unset($data);
	$temp=mysql_query("select no,level from $member_table order by no", $connect) or error(mysql_error());
	while($data=mysql_fetch_array($temp)) {
		// 게시판 테이블 islevel 일괄 변경
		mysql_query("update $t_board"."_$table_name set islevel='$data[level]' where ismember='$data[no]'", $connect) or error(mysql_error());
		$cnt1 += mysql_affected_rows();
	}
	mysql_query("update $t_board"."_$table_name set islevel='10' where ismember='0'", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();
?>

<br><br><br>
&nbsp;&nbsp;<font size=4 style=font-family:tahoma; color=black><?=$table_name?>&nbsp;<b>게시판</b> <?=$cnt1?>개 레코드 업데이트 성공!</font><br>
<br><img src=images/t.gif border=0 height=5><Br>
<?
	$cnt2=0;
	
	unset($temp); unset($data);
	$temp=mysql_query("select no,level from $member_table order by no", $connect) or error(mysql_error());
	while($data=mysql_fetch_array($temp)) {
		// 덧글 테이블 islevel 일괄 변경
		mysql_query("update $t_comment"."_$table_name set islevel='$data[level]' where ismember='$data[no]'", $connect) or error(mysql_error());
		$cnt2 += mysql_affected_rows();
	}
	mysql_query("update $t_comment"."_$table_name set islevel='10' where ismember='0'", $connect) or error(mysql_error());
	$cnt2 += mysql_affected_rows();
?>

<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<font size=3 style=font-family:tahoma;><?=$table_name?><b>게시판의 간단한 답글</b> <?=$cnt2?>개 레코드 업데이트 성공!</font><br>
<img src=images/t.gif border=0 height=20><Br>

<?

	// 변경된 레코드 수 카운트
	$hop += $cnt1+$cnt2;
	$cnt1=0; $cnt2=0;
}

echo "모든 게시판/덧글 테이블에서 모두 {$hop}개 레코드가 변경되었습니다.";
?>
<br><br><br>
<script>
alert("모든 게시판/덧글 테이블에서 모두 "+<?=$hop?>+"개 레코드가 변경되었습니다.");
</script>
<?
foot();
?>
