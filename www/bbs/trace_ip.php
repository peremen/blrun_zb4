<?
$_zb_path="./";
include "lib.php";
if(!$connect) $connect=dbConn();
$member=member_info();
$s_keyword = $keyword;
if(!$member[no]||$member[is_admin]>1||$member[level]>2) Error("레벨2 이상의 최고 관리자만이 사용할수 있습니다");
// 실제 검색부분
if($keyword) {
	$comment_search=1;
	$s_que = "";
	if($keykind) {
		if(!$s_que) $s_que .= " where $keykind like '%$keyword%' order by no desc ";
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

		// 본문
		$result=mysql_query("select * from $t_board"."_$table_name $s_que", $connect) or error(mysql_error());
?>

<br><br><br>

&nbsp;&nbsp;<a href=zboard.php?id=<?=$table_name?> target=_blank><font size=4 style=font-family:tahoma; color=black><?=$table_name?>&nbsp;<b>게시판</b></font></a><br>
<?
		while($data=mysql_fetch_array($result))
		{
			flush();
			$data[subject] = del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",$data[subject])));
?>

&nbsp;&nbsp; [<?=del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",$data[name])))?>] &nbsp;
<b><a href=<?=$file?>?id=<?=$table_name?>&no=<?=$data[no]?> target=_blank><?=$data[subject]?></a></b>
&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
<font color=666666>(<font color=blue><?=date("Y-m-d H:i:s",$data[reg_date])?></font>)</font><img src=images/t.gif border=0 height=20><Br>
&nbsp;&nbsp; <?=del_html(strip_tags($data[memo]))?><br>
<img src=images/t.gif border=0 height=5><Br>

<?
		}

		mysql_free_result($result);

		// 코멘트
		if($comment_search)
		{
			$result=mysql_query("select * from $t_comment"."_$table_name $s_que", $connect) or error(mysql_error());
?>

<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<a href=zboard.php?id=<?=$table_name?> target=_blank><font size=3 style=font-family:tahoma;><?=$table_name?><b>게시판</b> 의 간단한 답글</font></a>
<br>
<?
			while($data=mysql_fetch_array($result))
			{
				flush();
				$data[memo] = del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",strip_tags($data[memo]))));
				// 계층 코멘트 표식 불러와 처리
				unset($c_match);
				if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",$data[memo],$c_match))
					$data[memo] = str_replace($c_match[0],"",$data[memo]);
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [<?=del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",$data[name])))?>]
&nbsp;<a href=<?=$file?>?id=<?=$table_name?>&no=<?=$data[parent]?> target=_blank><?=$data[memo]?></a> &nbsp;&nbsp;
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