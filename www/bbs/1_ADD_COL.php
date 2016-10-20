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
	$cnt1=0;
	$table_name=$table_data[name];

	// 게시판 필드 일괄 추가

?>

<br><br><br>
&nbsp;&nbsp;<font size=4 style=font-family:tahoma; color=black><?=$table_name?>&nbsp;<b>게시판</b> <?=$cnt1?>개 필드 추가 성공!</font><br>
<br><img src=images/t.gif border=0 height=5><Br>
<?
	$cnt2=0;
	// 코멘트 islevel 필드 일괄 추가
	$result = mysql_fetch_array(mysql_query("SHOW COLUMNS FROM $t_comment"."_$table_name LIKE 'islevel'", $connect));
	if(!$result['Field']) {
		mysql_query("ALTER TABLE $t_comment"."_$table_name ADD `islevel` int(2) not null default '10' AFTER `ismember`", $connect) or error(mysql_error());
		$cnt2++;
	}

	unset($result);
	// 코멘트 use_html2 필드 일괄 추가
	$result = mysql_fetch_array(mysql_query("SHOW COLUMNS FROM $t_comment"."_$table_name LIKE 'use_html2'", $connect));
	if(!$result['Field']) {
		mysql_query("ALTER TABLE $t_comment"."_$table_name ADD `use_html2` char(1) default '0' CHARACTER SET euckr COLLATE euckr_korean_ci AFTER `reg_date`", $connect) or error(mysql_error());
		$cnt2++;
	}

	unset($result);
	// 코멘트 is_secret 필드 일괄 추가
	$result = mysql_fetch_array(mysql_query("SHOW COLUMNS FROM $t_comment"."_$table_name LIKE 'is_secret'", $connect));
	if(!$result['Field']) {
		mysql_query("ALTER TABLE $t_comment"."_$table_name ADD `is_secret` char(1) not null default '0' CHARACTER SET euckr COLLATE euckr_korean_ci AFTER `use_html2`", $connect) or error(mysql_error());
		$cnt2++;
	}

	unset($result);
	// 코멘트 file_name1 필드 일괄 추가
	$result = mysql_fetch_array(mysql_query("SHOW COLUMNS FROM $t_comment"."_$table_name LIKE 'file_name1'", $connect));
	if(!$result['Field']) {
		mysql_query("ALTER TABLE $t_comment"."_$table_name ADD `file_name1` char(255) CHARACTER SET euckr COLLATE euckr_korean_ci AFTER `is_secret`", $connect) or error(mysql_error());
		$cnt2++;
	}

	unset($result);
	// 코멘트 file_name2 필드 일괄 추가
	$result = mysql_fetch_array(mysql_query("SHOW COLUMNS FROM $t_comment"."_$table_name LIKE 'file_name2'", $connect));
	if(!$result['Field']) {
		mysql_query("ALTER TABLE $t_comment"."_$table_name ADD `file_name2` char(255) CHARACTER SET euckr COLLATE euckr_korean_ci AFTER `file_name1`", $connect) or error(mysql_error());
		$cnt2++;
	}

	unset($result);
	// 코멘트 s_file_name1 필드 일괄 추가
	$result = mysql_fetch_array(mysql_query("SHOW COLUMNS FROM $t_comment"."_$table_name LIKE 's_file_name1'", $connect));
	if(!$result['Field']) {
		mysql_query("ALTER TABLE $t_comment"."_$table_name ADD `s_file_name1` char(255) CHARACTER SET euckr COLLATE euckr_korean_ci AFTER `file_name2`", $connect) or error(mysql_error());
		$cnt2++;
	}

	unset($result);
	// 코멘트 s_file_name2 필드 일괄 추가
	$result = mysql_fetch_array(mysql_query("SHOW COLUMNS FROM $t_comment"."_$table_name LIKE 's_file_name2'", $connect));
	if(!$result['Field']) {
		mysql_query("ALTER TABLE $t_comment"."_$table_name ADD `s_file_name2` char(255) CHARACTER SET euckr COLLATE euckr_korean_ci AFTER `s_file_name1`", $connect) or error(mysql_error());
		$cnt2++;
	}

	unset($result);
	// 코멘트 download1 필드 일괄 추가
	$result = mysql_fetch_array(mysql_query("SHOW COLUMNS FROM $t_comment"."_$table_name LIKE 'download1'", $connect));
	if(!$result['Field']) {
		mysql_query("ALTER TABLE $t_comment"."_$table_name ADD `download1` int(11) not null default '0' AFTER `s_file_name2`", $connect) or error(mysql_error());
		$cnt2++;
	}

	unset($result);
	// 코멘트 download2 필드 일괄 추가
	$result = mysql_fetch_array(mysql_query("SHOW COLUMNS FROM $t_comment"."_$table_name LIKE 'download2'", $connect));
	if(!$result['Field']) {
		mysql_query("ALTER TABLE $t_comment"."_$table_name ADD `download2` int(11) not null default '0' AFTER `download1`", $connect) or error(mysql_error());
		$cnt2++;
	}
?>

<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<font size=3 style=font-family:tahoma;><?=$table_name?><b>게시판의 간단한 답글</b> <?=$cnt2?>개 필드 추가 성공!</font><br>
<img src=images/t.gif border=0 height=20><Br>

<?

	// 추가된 필드 수 카운트
	$hop += $cnt1+$cnt2;
	$cnt1=0; $cnt2=0;
}

echo "모든 게시판/덧글 테이블에서 모두 {$hop}개 필드가 추가되었습니다.";
?>
<br><br><br>
<script>
alert("모든 게시판/덧글 테이블에서 모두 "+<?=$hop?>+"개 필드가 추가되었습니다.");
</script>
<?
foot();
?>
