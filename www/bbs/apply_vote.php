<?
/***************************************************************************
* 공통파일 include
**************************************************************************/
include "_head.php";

// 사용권한 체크
if($setup[grant_view]<$member[level]&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");

// 보안향상
if(!get_magic_quotes_gpc()) {
	$no = addslashes($no);
	$sub_no = addslashes($sub_no);
}

// 조회수 해킹 검증
$result=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$sub_no'",$connect));
$prev_no1=$result[prev_no]; //현재항목의 상단 투표 넘버
$next_no1=$result[next_no]; //현재 항목의 하단 투표 넘버
$result=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$next_no1'",$connect));
$prev_no2=$result[prev_no]; //하단 투표 넘버의 상단 투표 넘버
$result=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$prev_no1'",$connect));
$next_no2=$result[next_no]; //상단 투표 넘버의 하단 투표 넘버

// 가장 최근 투표와 맨 아래 투표는 아래와 같이 다음행 if에 사용될 $next_no2,$prev_no2 치환
if($prev_no1==0) $next_no2=$prev_no2;
else if($next_no1==0) $prev_no2=$next_no2;

// 기존 아이피가 있는지 검사
$data = mysql_fetch_array(mysql_query("select memo from $t_board"."_$id where no='$no'",$connect));
$ip_array = explode("|||",$data[memo]);
$rows = 1;
for($i=1;$i<count($ip_array);$i++)
	if((preg_match("#".$REMOTE_ADDR."#",$ip_array[$i])) || ($member[user_id] && preg_match("#".$member[user_id]."#",$ip_array[$i]))) $rows = 0; //존재하면 플래그 0으로 셋팅

if($rows) {
	// 현재글의 Vote수 올림;;
	if(!preg_match("/".$setup[no]."_".$no."/i",  $HTTP_SESSION_VARS[zb_vote])&&$no==$prev_no2&&$no==$next_no2) {
		// 아이피 테이블 만듦
		unset($data);
		$data = mysql_fetch_array(mysql_query("select memo from $t_board"."_$id where no='$no'",$connect));
		$memo = $data[memo]."|||".$REMOTE_ADDR;
		if($member[user_id]) $memo .= "|||".$member[user_id];

		mysql_query("update $t_board"."_$id set vote=vote+1 where no='$sub_no'",$connect);
		mysql_query("update $t_board"."_$id set memo='$memo',vote=vote+1 where no='$no'",$connect);

		// 4.0x 용 세션 처리
		$zb_vote = $HTTP_SESSION_VARS[zb_vote] . "," . $setup[no]."_".$no;
		session_register("zb_vote");

		// 기존 세션 처리 (4.0x용 세션 처리로 인하여 주석 처리)
		//$HTTP_SESSION_VARS[zb_vote] = $HTTP_SESSION_VARS[zb_vote] . "," . $setup[no]."_".$no;
	} else Error("이미 투표하셨습니다.");
} else Error("이미 투표하셨습니다..");

@mysql_close($connect);

// 페이지 이동
if($setup[use_alllist]) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no");
else  movepage("view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no");
?>