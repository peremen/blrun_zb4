<?
$_zb_path="./";
include "lib.php";
if(!$connect) $connect=dbConn();
$member=member_info();
$s_keyword = $keyword;
if(!$member[no]||$member[is_admin]>1||$member[level]>1) Error("최고 관리자만이 사용할수 있습니다");
// 실제 검색부분
if($keyword) {
	$comment_search=1;
	$s_que = "";
	if($keykind) {
		if(!$s_que) $s_que .= " where $keykind like '%$keyword%' ";
	}
	$table_name_result=mysql_query("select name, use_alllist from $admin_table order by name",$connect) or error(mysql_error());
}

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
<form action=<?=$PHP_SELF?> method=post>
<tr>
  <td colspan=3 align=right>

  <Table border=0>
	<tr>
  	<td style=line-height:180% height=40 align=right>
  		<input type=checkbox name=keykind value="ip" <?if($keykind) echo "checked";?>> 아이피 &nbsp;
  	</td>
  	<td><input type=text name=keyword value="<?=$s_keyword?>" size=20 class=input>&nbsp;</td>
  	<td><input type=image src=images/trace_search.gif border=0 valign=absmiddle></td>
	</tr>
	<tr>
  	<td colspan=3 align=right>
		<font color=darkred>* ip로 검색된 결과는 비밀글도 모두 보여집니다.</font>
  	</td>
	</tr>
	</form>
	</table>
  </td>
</tr>
</table>
</div>

<?
if($keyword&&$s_que)
{
	while($table_data=mysql_fetch_array($table_name_result))
	{

		$table_name=$table_data[name];
		if($table_data[use_alllist]) $file="zboard.php"; else $file="view.php";

		// 스팸 아이피 일괄 차단
		$setup = get_table_attrib($table_name);
		$avoid_ip=explode(",",$setup[avoid_ip]);
		$Blocked = 0;
		$count = count($avoid_ip);
		for($i=0;$i<$count;$i++){
			$TrimedAvoidIp = trim($avoid_ip[$i]);
			if(!isblank($TrimedAvoidIp)&&preg_match("/".$keyword."/i", $TrimedAvoidIp)) {
				$Blocked=1;
				break;
			}
		}
		if(!$Blocked) {
			$avoid_ip = $keyword.", ".$setup[avoid_ip];
			mysql_query("update $admin_table set avoid_ip='$avoid_ip' where name='$table_name'");
		}
		// 스팸 아이피 글 일괄 삭제
		mysql_query("delete from $t_board"."_$table_name $s_que", $connect) or error(mysql_error());
		// 본문
		$result=mysql_query("select * from $t_board"."_$table_name $s_que", $connect) or error(mysql_error());
?>

<br><br><br>

&nbsp;&nbsp;<a href=zboard.php?id=<?=$table_name?> target=_blank><font size=4 style=font-family:tahoma; color=black><?=$table_name?>&nbsp;<b>게시판</b></font></a><br>
<?
		while($data=mysql_fetch_array($result))
		{
			flush();
			$data[subject] = del_html($data[subject]);
?>

&nbsp;&nbsp; [<?=$data[name]?>] &nbsp;
<b><a href=<?=$file?>?id=<?=$table_name?>&no=<?=$data[no]?> target=_blank><?=$data[subject]?></a></b>
&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
<font color=666666>(<font color=blue><?=date("Y-m-d H:i:s",$data[reg_date])?></font>)</font><img src=images/t.gif border=0 height=20><Br>
&nbsp;&nbsp; <?=del_html(strip_tags($data[memo]))?><br>
<img src=images/t.gif border=0 height=5><Br>

<?
		}

		mysql_free_result($result);

		/// 코멘트
		if($comment_search)
		{
			// 스팸 아이피 덧글 일괄 삭제
			mysql_query("delete from $t_comment"."_$table_name $s_que", $connect) or error(mysql_error());
			$result=mysql_query("select * from $t_comment"."_$table_name $s_que", $connect) or error(mysql_error());
?>

<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<a href=zboard.php?id=<?=$table_name?> target=_blank><font size=3 style=font-family:tahoma;><?=$table_name?><b>게시판</b> 의 간단한 답글</font></a>
<br>
<?
			while($data=mysql_fetch_array($result))
			{
				flush();
				$table_name_array[] = $table_name;
				$parent_no_array[] = $data[parent];
				$data[memo] = del_html(strip_tags($data[memo]));
				// 계층 코멘트 표식 불러와 처리
				unset($c_match);
				if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",$data[memo],$c_match))
					$data[memo] = str_replace($c_match[0],"",$data[memo]);
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [ <?=$data[name]?> ]
&nbsp;<a href=<?=$file?>?id=<?=$table_name?>&no=<?=$data[parent]?> target=_blank><?=$data[memo]?></a> &nbsp;&nbsp;
<font color=666666>(<font color=blue><?=date("Y-m-d H:i:s",$data[reg_date])?></font>)</font>
<img src=images/t.gif border=0 height=20><Br>

<?
			}
		}
	}
}

// 코멘트 갯수 정리 시작
if($keyword&&$s_que)
{
	for($i=0;$i<count($table_name_array);$i++)
	{

		$table_name=$table_name_array[$i];
		// 코멘트 갯수를 구해서 정리
		$total=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$table_name where parent='$parent_no_array[$i]'"));
		mysql_query("update $t_board"."_$table_name set total_comment='$total[0]' where no='$parent_no_array[$i]'") or error(mysql_error());
	}
}

mysql_close($connect);
$connect="";
?>
<br><br><br>
<script>
alert("<?=$keyword?> 란 아이피의 모든 게시글/덧글이 삭제 후 차단되었습니다.\n차단해제는 게시판 관라자메뉴를 이용하십시요.");
</script>
<?
foot();
?>