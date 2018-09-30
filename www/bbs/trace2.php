<?
$_zb_path="./";
include "lib.php";
if(!$connect) $connect=dbConn();
$member=member_info();
$s_keyword = $keyword;
if($keykind[4]) {
	$userno = mysqli_fetch_array(mysqli_query($connect,"select no from zetyx_member_table where user_id='$keyword'"));
	$userno = $userno[0];
}
// 실제 검색부분
if($keyword) {
	$comment_search=1;
	$s_que = "";
	for($i=0;$i<5;$i++) {
		if($keykind[$i]) {
			if($keykind[$i]!="ismember") {
				if(!$s_que) $s_que .= " where $keykind[$i] like '%$keyword%' ";
				else $s_que .= " and $keykind[$i] like '%$keyword%' ";
			} else {
				if($userno) {
					if(!$s_que) $s_que .= " where $keykind[$i] = '$userno' ";
					else $s_que .= " and $keykind[$i] = '$userno' ";
				}
			}
			if($keykind[$i]=="email"||$keykind[$i]=="subject") $comment_search=0;
		}
		$table_name_result=mysqli_query($connect,"select name, use_alllist from $admin_table order by name") or error(mysqli_error($connect));
	}
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
  		<input type=checkbox name=keykind[0] value="name" <?if($keykind[0]) echo "checked";?>> 이름 &nbsp;
  		<input type=checkbox name=keykind[1] value="email" <?if($keykind[1]) echo "checked";?>> E-Mail &nbsp;
  		<input type=checkbox name=keykind[2] value="subject" <?if($keykind[2]) echo "checked";?>> 제목 &nbsp;
  		<input type=checkbox name=keykind[3] value="memo" <?if($keykind[3]) echo "checked";?>> 내용 &nbsp;
  		<input type=checkbox name=keykind[4] value="ismember" <?if($keykind[4]) echo "checked";?>> 아이디 &nbsp;
  	</td>
  	<td><input type=text name=keyword value="<?=$s_keyword?>" size=20 class=input>&nbsp;</td>
  	<td><input type=image src=images/trace_search.gif border=0 valign=absmiddle></td>
	</tr>
	<tr>
  	<td colspan=3 align=right>
		<font color=darkred>* 체크된 항목은 AND 연산됩니다, 즉 선택된 항목이 모두 해당될때입니다.</font>
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
	while($table_data=mysqli_fetch_array($table_name_result))
	{
		$table_name=$table_data[name];
		if($table_data[use_alllist]) $file="zboard.php"; else $file="view.php";

		// 본문
		$result=mysqli_query($connect,"select * from $t_board"."_$table_name $s_que order by no desc") or error(mysqli_error($connect));
?>

<br><br><br>

&nbsp;&nbsp;<a href=zboard.php?id=<?=$table_name?> target=_blank><font size=4 style=font-family:tahoma; color=black><?=$table_name?>&nbsp;<b>게시판</b></font></a><br>
<?
		while($data=mysqli_fetch_array($result))
		{
			flush();
			$data[subject] = preg_replace("#".$keyword."#i","<font color=red>$keyword</font>",del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",$data[subject]))));
?>

&nbsp;&nbsp; [<?=del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",$data[name])))?>] &nbsp;
<b><a href=<?=$file?>?id=<?=$table_name?>&no=<?=$data[no]?> target=_blank><?=$data[subject]?></a></b>
&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
<font color=666666>(<font color=blue><?=date("Y-m-d H:i:s",$data[reg_date])?></font>)</font>

<img src=images/t.gif border=0 height=20><Br>

<?
		}

		mysqli_free_result($result);

		/// 코멘트
		if($comment_search)
		{
			$result=mysqli_query($connect,"select * from $t_comment"."_$table_name $s_que order by no desc") or error(mysqli_error($connect));
?>

<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<a href=zboard.php?id=<?=$table_name?> target=_blank><font size=3 style=font-family:tahoma;><?=$table_name?><b>게시판</b> 의 간단한 답글</font></a>
<br>
<?
			while($data=mysqli_fetch_array($result))
			{
				flush();
				$data[memo] = preg_replace("#".$keyword."#i","<font color=red>$keyword</font>",del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",$data[memo]))));
				// 계층 코멘트 표식 불러와 처리
				unset($c_match);
				if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",$data[memo],$c_match))
					$data[memo] = str_replace($c_match[0],"",$data[memo]);
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [<?=del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",$data[name])))?>]
&nbsp;<a href=<?=$file?>?id=<?=$table_name?>&no=<?=$data[parent]?> target=_blank><? if($data[is_secret]) echo "<font color='gray'>비밀 덧글입니다</font>"; else echo $data[memo]; ?></a> &nbsp;&nbsp;
<font color=666666>(<font color=blue><?=date("Y-m-d H:i:s",$data[reg_date])?></font>)</font>
<img src=images/t.gif border=0 height=20><Br>

<?
			}
		}
	}
}
?>
<br><br><br>
<?
foot();
?>
