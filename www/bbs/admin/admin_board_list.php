<?
// 현재 그룹의 데이타를 구함
$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));

// 오늘날짜 구함
$today_date=mktime(0,0,0,date("m"),date("d"),date("Y"));

// 게시판 관리자일 경우 게시판을 제한
if($member[is_admin]>=3 && $member[board_name]) {
	$boardList = explode(",",$member[board_name]);
	$s_que = "";
	for($i=0;$i<count($boardList);$i++) {
		if(trim($boardList[$i])) {
			if($s_que) $s_que .= " or no = ".$boardList[$i]." ";
			else $s_que .= " no = ".$boardList[$i]." ";
		}
	}
// 그룹관리자인 경우 그룹 게시판만 보여주기
} else {
	$s_que = " group_no = '$group_no' ";
}

// 전체 갯수를 구해옴
$temp=mysql_fetch_array(mysql_query("select count(*) from $admin_table where $s_que"));
$total=$temp[0];

// 페이지 구하는 부분
if($page_num==0)$page_num=10;
if(!$page) $page=1;
$start_num=($page-1)*$page_num;
$total_page=(int)(($total-1)/$page_num)+1;

// 게시물을 구해옴
$result=@mysql_query("select * from $admin_table where $s_que order by no desc limit $start_num,$page_num",$connect) 
or Error("게시판의 정보를 DB로 부터 가져오는 부분에서 에러가 발생했습니다");
?>
<script>
function board_recover(a,b)
{
 c = confirm(b + " 게시판을 정리하시겠습니까?")
 if(c==true)
 {
	window.open("admin/recover.php?no="+a,"recover","width=300,height=100,toolbars=no,resizable=no,scrollbars=no")
 }
}
</script>
<table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=#b0b0b0>
<tr height=30><td bgcolor=#3d3d3d colspan=9><img src=images/admin_webboard.gif></td>
</tr>
<tr height=1><td bgcolor=#000000 style=padding:0px; colspan=9><img src=images/t.gif height=1></td>
</tr>
<?
// 앞에 붙는 가상번호
$number=$total-($page-1)*$page_num;

echo "
<tr align=center height=23 bgcolor=#a0a0a0>
  <td style=font-family:Tahoma;font-size:9pt;><b>번호</td>
  <td style=font-family:Tahoma;font-size:9pt;><b>게시판 이름</td>
  <td style=font-family:Tahoma;font-size:9pt;><b>전체등록 수</td>
  <td style=font-family:Tahoma;font-size:9pt;><b>미리보기</td>
  <td style=font-family:Tahoma;font-size:9pt;><b>기본설정 변경</td>
  <td style=font-family:Tahoma;font-size:9pt;><b>권한 설정</td>
  <td style=font-family:Tahoma;font-size:9pt;><b>카테고리 관리</a></td>
  <td style=font-family:Tahoma;font-size:9pt;><b>오류복구</a></td>
  <td style=font-family:Tahoma;font-size:9pt;><b>삭제</a></td>
</tr>";

// 뽑아온 게시물 데이타를 화면에 출력
while($data=mysql_fetch_array($result))
{
	echo "
<tr align=center height=23 bgcolor=#e0e0e0>
  <td style=font-family:Tahoma;font-size:8pt;>$number</td>
  <td style=font-family:Tahoma;font-size:9pt;><b>$data[name]</b></td>
  <td style=font-family:Tahoma;font-size:9pt;>$data[total_article]</td>
  <td style=font-family:Tahoma;font-size:9pt;><a href=zboard.php?id=$data[name] target=_blank>View</a></td>
  <td style=font-family:Tahoma;font-size:9pt;><a href=$PHP_SELF?exec=view_board&group_no=$group_no&exec2=modify&no=$data[no]&page=$page&page_num=$page_num>Setup</a></td>
  <td style=font-family:Tahoma;font-size:9pt;><a href=$PHP_SELF?exec=view_board&group_no=$group_no&exec2=grant&no=$data[no]&page=$page&page_num=$page_num>Setup</a></td>
  <td style=font-family:Tahoma;font-size:9pt;><a href=$PHP_SELF?exec=view_board&group_no=$group_no&exec2=category&no=$data[no]&page=$page&page_num=$page_num>Setup</a></td>
  <td style=font-family:Tahoma;font-size:9pt;><a href=\"javascript:board_recover('$data[no]','$data[name]')\">정리</a></td>
  <td style=font-family:Tahoma;font-size:9pt;><a href=$PHP_SELF?exec=view_board&group_no=$group_no&exec2=del&no=$data[no]&page=$page&page_num=$page_num onclick=\"return confirm('$data[name] 게시판을 \\n\\n삭제하시겠습니까?')\">삭제</a></td>
</tr>";
	// 가상 번호를 1씩 뺌
	$number--;
}
?>

</table>
<div align=right>
<!-- 각종 검색부분 -->
<table border=0 cellspacing=0 cellpadding=3>
<form method=post action=<?=$PHP_SELF?> name=search>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=exec value=<?=$exec?>>
<input type=hidden name=group_no value=<?=$group_no?>>
<tr>
  <td><input type=text name=page_num value=<?=$page_num?> size=2></td>
  <td><input type=submit value='페이지당 갯수' style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:9pt;font-family:Tahoma;height:20px;>&nbsp;&nbsp;</td>
  <td><input type=button onclick=location.href="<?=$PHP_SELF?>?exec=view_board&exec2=add&page=<?=$page?>&page_num=<?=$page_num?>&group_no=<?=$group_no?>" style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:9pt;font-family:Tahoma;height:20px; value=' 게시판 추가하기 '></td>
</tr>
</form>
</table>

</div>
<div align=center><br>
<?
//페이지 나타내는 부분
$show_page_num=10;
$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
$i=1;
if($page>$show_page_num){
	$prev_page=$start_page-1;
	echo "
<a href=$PHP_SELF?page=$prev_page&exec=view_board&page_num=$page_num&group_no=$group_no style=color:white>[이전페이지]</a>";
}
while($i+$start_page<=$total_page&&$i<=$show_page_num)
{
	$move_page=$i+$start_page;
	if($page==$move_page) echo "
<b style=color:white>$move_page</b>";
	else echo "<a href=$PHP_SELF?page=$move_page&exec=view_board&page_num=$page_num&group_no=$group_no style=color:white>[$move_page]</a>";
	$i++;
}
if($total_page>$move_page){$next_page=$move_page+1; echo "<a href=$PHP_SELF?page=$next_page&exec=view_board&page_num=$page_num&group_no=$group_no style=color:white>[다음페이지]</a>";}
//페이지 나타내는 부분 끝
?>

</div>
