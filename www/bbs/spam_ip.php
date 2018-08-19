<?
$_zb_path="./";
include "lib.php";
if(!$connect) $connect=dbConn();
$member=member_info();
$s_keyword = $keyword;
if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)||!$_SESSION['DEL_COMM_SEC']||$_SESSION['DEL_COMM_SEC']!=$delsec) Error("보안코드가 일치하지 않습니다.");
if(!($member[no]&&$member[is_admin]==1&&$member[level]==1)) Error("레벨1의 최고 관리자만이 사용할수 있습니다");
// 실제 검색부분
if($keyword) {
	$comment_search=1;
	$s_que = "";
	if($keykind) {
		if(!$s_que) $s_que .= " where islevel > 8 and $keykind like '%$keyword%' order by no desc ";
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
	$hop = 0; // 삭제할 총 레코드 갯수 카운트
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
			mysql_query("update $admin_table set avoid_ip='$avoid_ip' where name='$table_name'",$connect) or error(mysql_error());
		}
		// 스팸 아이피 글 일괄 삭제
		unset($result);unset($data);
		$result=mysql_query("select * from $t_board"."_$table_name $s_que", $connect) or error(mysql_error());

		$cnt1 = 0; $cnt2 = 0; // 게시판에서 삭제할 레코드 갯수 카운트

		while($data=mysql_fetch_array($result))
		{
			if(!$data[child]) // 답글이 없을때;;
			{
				mysql_query("delete from $t_board"."_$table_name where no='$data[no]'", $connect) or error(mysql_error());
				$cnt1 += mysql_affected_rows();
				// 파일삭제
				@z_unlink("./".$data[file_name1]);
				@z_unlink("./".$data[file_name2]);
				// 빈 파일 폴더 삭제
				if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$data[file_name1],$out))
					if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
				if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$data[file_name2],$out))
					if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);

				mysql_query("update $t_division"."_$table_name set num=num-1 where division='$data[division]'",$connect) or error(mysql_error());

				if($data[depth]==0)
				{
					if($data[prev_no]) mysql_query("update $t_board"."_$table_name set next_no='$data[next_no]' where next_no='$data[no]'",$connect) or error(mysql_error()); // 이전글이 있으면 빈자리 메꿈;;;
					if($data[next_no]) mysql_query("update $t_board"."_$table_name set prev_no='$data[prev_no]' where prev_no='$data[no]'",$connect) or error(mysql_error()); // 다음글이 있으면 빈자리 메꿈;;;
				}
				else
				{
					$temp=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$table_name where father='$data[father]'"));
					if(!$temp[0]) mysql_query("update $t_board"."_$table_name set child='0' where no='$data[father]'",$connect) or error(mysql_error()); // 원본글이 있으면 원본글의 자식글을 없앰;;;
				}

				// 간단한 답글(코멘트) 삭제
				unset($del_comment_result);unset($c_data);
				$del_comment_result=mysql_query("select * from $t_comment"."_$table_name where parent='$data[no]'",$connect) or error(mysql_error());
				mysql_query("delete from $t_comment"."_$table_name where parent='$data[no]'",$connect) or error(mysql_error());
				$cnt2 += mysql_affected_rows();
				while($c_data=mysql_fetch_array($del_comment_result)) {
					// Movie, Sell 덧글 포인트 테이블 삭제
					@mysql_query("delete from $t_comment"."_$table_name"."_movie where parent='$data[no]' and reg_date='$c_data[reg_date]'");
					// 파일삭제
					@z_unlink("./".$c_data[file_name1]);
					@z_unlink("./".$c_data[file_name2]);
					// 빈 파일 폴더 삭제
					if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$c_data[file_name1],$out))
						if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
					if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$c_data[file_name2],$out))
						if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
				}

				// 카테고리 필드 조절
				mysql_query("update $t_category"."_$table_name set num=num-1 where no='$data[category]'",$connect) or error(mysql_error());
			}
		}

		// 전체글수 조정
		$total=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$table_name "));
		mysql_query("update $admin_table set total_article='$total[0]' where name='$table_name'",$connect) or error(mysql_error());

		unset($result);unset($data);
		// 본문
		$result=mysql_query("select * from $t_board"."_$table_name $s_que", $connect) or error(mysql_error());
?>

<br><br><br>

&nbsp;&nbsp;<a href=zboard.php?id=<?=$table_name?> target=_blank><font size=4 style=font-family:tahoma; color=black><?=$table_name?>&nbsp;<b>게시판</b>에서 총<?=$cnt1?>개의 레코드가 삭제되었습니다</font></a><br>
<?
		while($data=mysql_fetch_array($result))
		{
			flush();
			$data[subject] = del_html($data[subject]);
?>

&nbsp;&nbsp; [<?=del_html($data[name])?>] &nbsp;
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
			unset($result);unset($c_data);
			// 스팸 아이피 덧글 일괄 삭제
			$result=mysql_query("select * from $t_comment"."_$table_name $s_que", $connect) or error(mysql_error());
			while($c_data=mysql_fetch_array($result)) {
				// 코멘트 갯수 정리를 위해 배열 저장
				$table_name_array[] = $table_name;
				$parent_no_array[] = $c_data[parent];
				// 코멘트 삭제
				mysql_query("delete from $t_comment"."_$table_name where no='$c_data[no]'",$connect) or error(mysql_error());
				$cnt2 += mysql_affected_rows();
				// Movie, Sell 덧글 포인트 테이블 삭제
				@mysql_query("delete from $t_comment"."_$table_name"."_movie where reg_date='$c_data[reg_date]'");

				// 파일삭제
				@z_unlink("./".$c_data[file_name1]);
				@z_unlink("./".$c_data[file_name2]);
				// 빈 파일 폴더 삭제
				if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$c_data[file_name1],$out))
					if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
				if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$c_data[file_name2],$out))
					if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
			}
?>

<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<a href=zboard.php?id=<?=$table_name?> target=_blank><font size=3 style=font-family:tahoma;><?=$table_name?><b>게시판</b> 의 간단한 답글에서 총<?=$cnt2?>개의 레코드가 삭제되었습니다</font></a>
<br>
<?
			unset($result);unset($data);
			// 스팸 아이피 덧글 일괄 삭제 후 덧글 항목 표시
			$result=mysql_query("select * from $t_comment"."_$table_name $s_que", $connect) or error(mysql_error());
			while($data=mysql_fetch_array($result))
			{
				flush();
				$data[memo] = del_html(strip_tags($data[memo]));
				// 계층 코멘트 표식 불러와 처리
				unset($c_match);
				if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",$data[memo],$c_match))
					$data[memo] = str_replace($c_match[0],"",$data[memo]);
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [ <?=del_html(str_replace("&rlm;","",$data[name]))?> ]
&nbsp;<a href=<?=$file?>?id=<?=$table_name?>&no=<?=$data[parent]?> target=_blank><?=$data[memo]?></a> &nbsp;&nbsp;
<font color=666666>(<font color=blue><?=date("Y-m-d H:i:s",$data[reg_date])?></font>)</font>
<img src=images/t.gif border=0 height=20><Br>

<?
			}
		}
		// 삭제된 레코드 수 카운트 초기화
		$hop += $cnt1+$cnt2;
		$cnt1=0; $cnt2=0;
	}
}

// 코멘트 갯수 정리 시작
if($keyword&&$s_que)
{
	unset($total);
	for($i=0;$i<count($table_name_array);$i++)
	{

		$table_name=$table_name_array[$i];
		// 코멘트 갯수를 구해서 정리
		$total=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$table_name where parent='$parent_no_array[$i]'"));
		mysql_query("update $t_board"."_$table_name set total_comment='$total[0]' where no='$parent_no_array[$i]'",$connect) or error(mysql_error());
	}
}

echo "<br><br><br>{$keyword} 란 아이피의 모든 게시글/덧글이 모두 {$hop}개 삭제 후 차단되었습니다.\n차단해제는 게시판 관라자메뉴를 이용하십시요.";
?>
<br><br><br>
<script>
alert("<?=$keyword?> 란 아이피의 모든 게시글/덧글이 모두 <?=$hop?>개 삭제 후 차단되었습니다.\n차단해제는 게시판 관라자메뉴를 이용하십시요.");
</script>
<?
foot();
?>
