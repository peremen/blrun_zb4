<?
/***************************************************************************
* 공통파일 include
**************************************************************************/
include "_head.php";

/***************************************************************************
* 설정 체크
**************************************************************************/

// 사용권한 체크
if($setup[grant_view]<$member[level]&&!$is_admin) Error("사용권한이 없습니다","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");

// 보안향상
if(!get_magic_quotes_gpc()) {
	$no = addslashes($no);
}

$result=@mysql_query("select * from $t_board"."_$id where no='$no'") or error(mysql_error());
$data=mysql_fetch_array($result);
$ip_array = explode("|||",$data[memo]);

// 현재글의 Vote수 올림;;
if($setup[skinname]!="zero_vote") {
	if(mb_substr($ip_array[0],0,5)=="설문조사|") Error("정상적인 투표를 하지 않으셨습니다.");
	if(!preg_match("/".$setup[no]."_".$no."/",$_SESSION['zb_vote'])) {
		mysql_query("update $t_board"."_$id set vote=vote+1 where no='$no'");
		$vote_str =  ",".$setup[no]."_".$no;

		// 4.0x 용 세션 처리
		$_SESSION['zb_vote'] = $_SESSION['zb_vote'].$vote_str;
	}
} else Error("정상적인 투표를 하지 않으셨습니다..");

// 페이지 이동
if($setup[use_alllist]) $temp_href="zboard.php"; else $temp_href="view.php";
movepage("$temp_href?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no"); 
?>
