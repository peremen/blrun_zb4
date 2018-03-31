<?
/***************************************************************************
* 공통 파일 include
**************************************************************************/
include "_head.php";
include("securimage/securimage.php");
// HTML 출력
print "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>\n";

/***************************************************************************
* 게시판 설정 체크
**************************************************************************/

// 사용권한 체크
if($setup[grant_list]<$member[level] && !$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&s_url=".urlencode($REQUEST_URI));

$notice_que = "select * from $t_board"."_$id where headnum <= -2000000000 order by $select_arrange $desc limit 0, $page_num";
$notice_result = mysql_query($notice_que, $connect) or error(mysql_error());


// 검색조건이 있을때 : 상황 -> 카테고리 선택, Use_Showreply 사용, 또는 검색어로 검색을 할때
if($s_que) {
	$_dbTimeStart = getmicrotime();
	if($sm=="on") {
		$que="select $t_board"."_$id.no, division, headnum, arrangenum, depth, prev_no, next_no, father, child, $t_board"."_$id.ismember, $t_board"."_$id.islevel, $t_board"."_$id.memo, $t_board"."_$id.ip, $t_board"."_$id.name, homepage, email, subject, use_html, reply_mail, category, $t_board"."_$id.is_secret, $t_board"."_$id.file_name1, $t_board"."_$id.file_name2, $t_board"."_$id.reg_date, hit, vote, total_comment, x, y from $t_board"."_$id left join $t_comment"."_$id on parent=$t_board"."_$id.no $s_que group by $t_board"."_$id.no having count($t_board"."_$id.no)>=1 order by $select_arrange $desc limit $start_num, $page_num";
	} else {
		$que="select * from $t_board"."_$id $s_que order by $select_arrange $desc limit $start_num, $page_num";
	}
	$result=mysql_query($que,$connect) or Error(mysql_error());
	$_dbTime += getmicrotime()-$_dbTimeStart;
}

// 검색 조건이 없을때 : 상황 -> 일반 정렬, 또는 정렬기준을 가지거나 Desc, Asc 일때.
else {

	// 검색조건이 없고 정렬이 headnum에 의한 것일때;; 즉 일반 정렬일때;;
	if ($select_arrange=="headnum"&&$desc=="asc") {
		while($division_data=mysql_fetch_array($division_result)) {
			$sum=$sum+$division_data[num];
			$division=$division_data[division];

			if($sum>=$start_num) {
				$start_num=$start_num-($sum-$division_data[num]);
				$_dbTimeStart = getmicrotime();
				$que="select * from $t_board"."_$id where division='$division' and headnum<0 and headnum>-2000000000 order by headnum,arrangenum limit $start_num, $page_num";
//					echo $que;
				$result=mysql_query($que) or error(mysql_error());
				$_dbTime += getmicrotime()-$_dbTimeStart;
				$check1=1;

				$returnNum = mysql_num_rows($result);

				if($returnNum>=$page_num) {
					break;
				} else {
					if($division>1) {
						$division--;
						$minus=$page_num-$returnNum;
						$_dbTimeStart = getmicrotime();
						$que2="select * from $t_board"."_$id where division=$division and headnum!=0 and headnum>-2000000000 order by headnum,arrangenum limit $minus";
						$result2=mysql_query($que2) or error(mysql_error());
						$_dbTime += getmicrotime()-$_dbTimeStart;
						$check2=1;
						break;
					}
				}
			}
		}
	}

	// 검색조건은 없지만 정렬값이 생길때;;; //////////////////////////////
	else {
		$que="select * from $t_board"."_$id where headnum>-2000000000 order by $select_arrange $desc $add_on limit $start_num, $page_num";
//			echo $que;
		$_dbTimeStart = getmicrotime();
		$result=mysql_query($que,$connect) or Error(mysql_error());
		$_dbTime += getmicrotime()-$_dbTimeStart;
	}
}

// 관리자일때는 게시판 글 옮기기때문에 게시판 리스트를 뽑아옴;;
if($is_admin) {
	$_dbTimeStart = getmicrotime();
	$board_result=mysql_query("select no,name from $admin_table where no!='$setup[no]'");
	$_dbTime += getmicrotime()-$_dbTimeStart;
}

/***************************************************************************
* 스킨에서 사용할 페이지 정리
**************************************************************************/

$print_page="";
$show_page_num=$setup[page_num]; // 한번에 보일 페이지 갯수
$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
$i=1;

$a_1_prev_page= "<Zeroboard ";
$a_1_next_page= "<Zeroboard ";
$a_prev_page = "<Zeroboard ";
$a_next_page = "<Zeroboard ";

if($page>1) $a_1_prev_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=".($page-1)."&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";

if($page<$total_page) $a_1_next_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=".($page+1)."&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";

if($page>$show_page_num) {
	$prev_page=$start_page;
	$a_prev_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=$prev_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";
	$print_page.="<a onfocus=blur() href='$PHP_SELF?id=$id&page=1&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'><font style=font-size:9pt>[1]</a><font style=font-size:9pt>..";
	$prev_page_exists = true;
	}

while($i+$start_page<=$total_page&&$i<=$show_page_num) {
	$move_page=$i+$start_page;
	if($page==$move_page) $print_page.=" <font style=font-size:9pt><b>$move_page</b> ";
	else $print_page.="<a onfocus=blur() href='$PHP_SELF?id=$id&page=$move_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'><font style=font-size:9pt>[$move_page]</a>";
	$i++;
}

if($total_page>$move_page) {
	$next_page=$move_page+1;
	$a_next_page="<a onfocus=blur() href='$PHP_SELF?id=$id&page=$next_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'>";
	$print_page.="<font style=font-size:9pt>..<a onfocus=blur() href='$PHP_SELF?id=$id&page=$total_page&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$divpage'><font style=font-size:9pt>[$total_page]</a>";
	$next_page_exists = true;
}

// 검색시 Divsion 페이지 이동 표시
if($use_division) {
	if($prevdivpage&&!$prev_page_exists) $a_div_prev_page="<a onfocus=blur() href='$PHP_SELF?id=$id&&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$prevdivpage'>[이전 검색]</a>...";
	if($nextdivpage&&!$next_page_exists) $a_div_next_page="...<a onfocus=blur() href='$PHP_SELF?id=$id&&select_arrange=$select_arrange&desc=$desc&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&sn1=$sn1&divpage=$nextdivpage'>[계속 검색]</a>";
	$print_page = $a_div_prev_page.$print_page.$a_div_next_page;

}

/***************************************************************************
* 각종 링크를 미리 지정하는 부분
**************************************************************************/

// 글쓰기버튼
if($is_admin||$member[level]<=$setup[grant_write]) $a_write="<a onfocus=blur() href='write.php?$href$sort&no=$no&mode=write&sn1=$sn1&divpage=$divpage'>"; else $a_write="<Zeroboard ";

// 목록 버튼
if($is_admin||$member[level]<=$setup[grant_list]) $a_list="<a onfocus=blur() href='$PHP_SELF?id=$id&page=$page&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&prev_no=$no&sn1=$sn1&divpage=$divpage'>"; else $a_list="<Zeroboard ";

// 취소버튼
$a_cancel="<a onfocus=blur() href='$PHP_SELF?id=$id'>";


// 정렬 버튼의 경우 $desc를 역으로 변환
if($desc=="desc") $t_desc="asc"; else $t_desc="desc";

// 번호 정렬
$a_no="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=headnum&desc=$t_desc'>";

// 제목 정렬
$a_subject="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=subject&desc=$t_desc'>";

// 이름 정렬
$a_name="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=name&desc=$t_desc'>";

// 조회순 정렬
$a_hit="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=hit&desc=$t_desc'>";

// 추천수 정렬
$a_vote="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=vote&desc=$t_desc'>";

// 날자별 정렬
$a_date="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=reg_date&desc=$t_desc'>";

// 첫번째 항목의 다운로드 순서
$a_download1="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=download1&desc=$t_desc'>";

// 두번째 항목의 다운로드 순서
$a_download2="<a onfocus=blur() href='$PHP_SELF?$href&select_arrange=download2&desc=$t_desc'>";

/***************************************************************************
* 정리한 데이타를 출력하는 부분
**************************************************************************/

// 현재 선택된 데이타가 있을때, 즉 $no 가 있을때 $_view_included 변수 True로 셋.
if($no&&$setup[use_alllist])
	$_view_included = true;

// 헤더 출력
$_skinTimeStart = getmicrotime();
head("onload=unlock2() onunload=hideImageBox2()","script_list.php");

// $_view_included 변수가 True 일 때 추가 스크립트 포함
if($_view_included) {
	if($setup[skinname] != "ruvin_cubic_gu")
		include "script/script_comment.php";
} elseif($setup[skinname] == "ruvin_cubic_gu")
	include "script/script_write.php";

// 상단 현황 부분 출력
include "$dir/setup.php";
$_skinTime += getmicrotime()-$_skinTimeStart;

// 현재 선택된 데이타가 있을때, 즉 $no 가 있을때 데이타 가져옴
if($_view_included)
	include "view.php";

// 리스트의 상단 부분 출력
$_skinTimeStart = getmicrotime();
include $dir."/list_head.php";
$_skinTime += getmicrotime()-$_skinTimeStart;

// 가상번호를 정함
$loop_number=$total-($page-1)*$page_num;
if($setup[use_alllist]&&!$prev_no) $prev_no=$no;

// 뽑혀진 데이타만큼 출력함
while($data = @mysql_fetch_array($notice_result)) {
	list_check(&$data);
	$_skinTimeStart = getmicrotime();
	include $dir."/list_notice.php";
	$_skinTime += getmicrotime()-$_skinTimeStart;
}

while($data=@mysql_fetch_array($result)) {
	list_check(&$data);
	$_skinTimeStart = getmicrotime();
	include $dir."/list_main.php";
	$_skinTime += getmicrotime()-$_skinTimeStart;
	$loop_number--;
}

if($check2) {
	while($data=@mysql_fetch_array($result2)) {
		list_check(&$data);
		$_skinTimeStart = getmicrotime();
		include $dir."/list_main.php";
		$_skinTime += getmicrotime()-$_skinTimeStart;
		$loop_number--;
	}
}

// 마무리 부분 출력하는 부분;;
$_skinTimeStart = getmicrotime();
include $dir."/list_foot.php";
$_skinTime += getmicrotime()-$_skinTimeStart;

if($zbLayer) {
	$_skinTimeStart = getmicrotime();
	echo "\n<script>".$zbLayer."\n</script>";
	unset($zbLayer);
	$_skinTime += getmicrotime()-$_skinTimeStart;
}

foot();
?>
