<?
/* 지난 배포 버전(1.2.7.4897 버전)에서 안내해 드린대로 백슬래쉬를 DB에서 한번 모든 테이블에서 제거하신 분들은
이 스크립트를 실행하시면 안됩니다. 백슬래쉬는 한번 제거할 때마다 HTML이 다르게 표시되므로 주의해야 합니다. 이
스크립트는 제로보드4.1pl8 버전을 설치 후 한번도 "오픈소스 게시판 수정증보판" 을 설치하지 않았던 분들을 위한 것
이며 또 수정증보판이라고 하더라도 1.2.6.110 버전 포함 이전 버전 설치자들은 해당사항이 없으며 1.2.7.XXXX 포함
이후 버전부터 적용하기 위한 스크립트입니다. 꼭 유념하시기 바랍니다. ^^; */

$_zb_path="./";
include "lib.php";
if(!$connect) $connect=dbConn();
$member=member_info();
if(!($member[no]&&$member[is_admin]==1&&$member[level]==1)) Error("레벨1의 최고 관리자만이 사용할수 있습니다");
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

	#\' 를 ' 로 치환
	mysql_query("UPDATE $t_board"."_$table_name SET subject=REPLACE(subject,\"\\\\'\",\"\\'\") where subject like \"%\\\\'%\"", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();
	mysql_query("UPDATE $t_board"."_$table_name SET memo=REPLACE(memo,\"\\\\'\",\"\\'\") where memo like \"%\\\\'%\"", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();

	#\" 를 " 로 치환
	mysql_query("UPDATE $t_board"."_$table_name SET subject=REPLACE(subject,'\\\\\"','\\\"') where subject like '%\\\\\"%'", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();
	mysql_query("UPDATE $t_board"."_$table_name SET memo=REPLACE(memo,'\\\\\"','\\\"') where memo like '%\\\\\"%'", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();

	#\\ 를 \ 로 치환
	mysql_query("UPDATE $t_board"."_$table_name SET subject=REPLACE(subject,'\\\\\\\\','\\\\') where subject like '%\\\\\\\\%'", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();
	mysql_query("UPDATE $t_board"."_$table_name SET memo=REPLACE(memo,'\\\\\\\\','\\\\') where memo like '%\\\\\\\\%'", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();
?>

<br><br><br>
&nbsp;&nbsp;<font size=4 style=font-family:tahoma; color=black><?=$table_name?>&nbsp;<b>게시판</b> <?=$cnt1?>개 백슬래쉬 제거 성공!</font><br>
<br><img src=images/t.gif border=0 height=5><Br>
<?
	$cnt2=0;

	#\' 를 ' 로 치환
	mysql_query("UPDATE $t_comment"."_$table_name SET memo=REPLACE(memo,\"\\\\'\",\"\\'\") where memo like \"%\\\\'%\"", $connect) or error(mysql_error());
	$cnt2 += mysql_affected_rows();

	#\" 를 " 로 치환
	mysql_query("UPDATE $t_comment"."_$table_name SET memo=REPLACE(memo,'\\\\\"','\\\"') where memo like '%\\\\\"%'", $connect) or error(mysql_error());
	$cnt2 += mysql_affected_rows();

	#\\ 를 \ 로 치환
	mysql_query("UPDATE $t_comment"."_$table_name SET memo=REPLACE(memo,'\\\\\\\\','\\\\') where memo like '%\\\\\\\\%'", $connect) or error(mysql_error());
	$cnt2 += mysql_affected_rows();
?>

<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<font size=3 style=font-family:tahoma;><?=$table_name?><b>게시판의 간단한 답글</b> <?=$cnt2?>개 백슬래쉬 제거 성공!</font><br>
<img src=images/t.gif border=0 height=20><Br>

<?

	// 변경된 레코드 수 카운트
	$hop += $cnt1+$cnt2;
	$cnt1=0; $cnt2=0;
}

echo "모든 게시판/덧글 테이블에서 모두 {$hop}개 백슬래쉬 제거를 하였습니다.";
?>
<br><br><br>
<script>
alert("모든 게시판/덧글 테이블에서 모두 "+<?=$hop?>+"개 백슬래쉬 제거를 하였습니다.");
</script>
<?
foot();
?>