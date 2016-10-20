<?
// 라이브러리 함수 파일 인크루드
include "lib.php";

if(!preg_match("/member_modify.php/i",$HTTP_REFERER)) Error("제대로 된 접근을 하여 주시기 바랍니다");

// DB 연결
if(!$connect) $connect=dbConn();

// 회원 정보를 얻어옴
$member=member_info();
$group_no = $member[group_no];

// 멤버 정보 삭제
@mysql_query("delete from $member_table where no='$member[no]'") or error(mysql_error());

// 쪽지 테이블에서 멤버 정보 삭제
@mysql_query("delete from $get_memo_table where member_no='$member[no]'") or error(mysql_error());
@mysql_query("delete from $send_memo_table where member_no='$member[no]'") or error(mysql_error());

// 각종 게시판에서 현재 탈퇴한 멤버의 모든 정보를 삭제 (부하 문제로 인해서 주석 처리)
/*
$result=mysql_query("select name from $admin_table");
while($data=mysql_fetch_array($result)) {
	// 게시판 테이블에서 삭제
	@mysql_query("update $t_board"."_$data[name] set ismember='0', password=password('".time()."') where ismember='$member[no]'") or error(mysql_error());
	// 코멘트 테이블에서 삭제
	@mysql_query("update $t_comment"."_$data[name] set ismember='0', password=password('".time()."')  where ismember='$member[no]'") or error(mysql_error());
}
*/

// 그룹테이블에서 회원수 -1
@mysql_query("update $group_table set member_num=member_num-1 where no = '$group_no'") or error(mysql_error());

// 로그아웃 시킴
destroyZBSessionID($member[no]);

// 5.3 이상용 세션 처리
$_SESSION['zb_logged_no']='';
$_SESSION['zb_logged_time']='';
$_SESSION['zb_logged_ip']='';
$_SESSION['zb_secret'];
$_SESSION['zb_last_connect_check']='0';
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script>
alert("정상적으로 탈퇴가 되었습니다.");
//opener.reload();
window.close();
</script>
