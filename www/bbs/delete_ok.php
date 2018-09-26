<?
// 라이브러리 함수 파일 인크루드
require "lib.php";

if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)) Error("정상적으로 글을 삭제하여 주시기 바랍니다.");
if(getenv("REQUEST_METHOD") == 'GET' ) Error("정상적으로 글을 삭제하시기 바랍니다","");

// 게시판 이름 지정이 안되어 있으면 경고;;;
if(!$id) Error("게시판 이름을 지정해 주셔야 합니다.<br><br>예) zboard.php?id=이름","");

// DB 연결
if(!$connect) $connect=dbConn();

// 현재 게시판 설정 읽어 오기
$setup=get_table_attrib($id);

// 설정되지 않은 게시판일때 에러 표시
if(!$setup[name]) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시요","");

// 현재 게시판의 그룹의 설정 읽어 오기
$group=group_info($setup[group_no]);

// 멤버 정보 구해오기;;; 멤버가 있을때
$member=member_info();

// 현재 로그인되어 있는 멤버가 전체, 또는 그룹관리자인지 검사
if($member[is_admin]==1||$member[is_admin]==2&&$member[group_no]==$setup[group_no]||check_board_master($member, $setup[no])) $is_admin=1; else $is_admin="";

// 접근 금지 아이피인 경우 금지하기;;;
$avoid_ip=explode(",",$setup[avoid_ip]);
for($i=0;$i<count($avoid_ip);$i++)
{
	if(!isblank($avoid_ip[$i])&&preg_match("/".$avoid_ip[$i]."/i",$REMOTE_ADDR)&&!$is_admin)
	Error(" Access Denied ");
}

// 현재 그룹이 폐쇄그룹이고 로그인한 멤버가 비멤버일때 에러표시
if($group[is_open]==0&&!$is_admin&&$member[group_no]!=$setup[group_no]) Error("공개 되어 있지 않습니다");

// 패스워드 addslashes
if(!get_magic_quotes_gpc()) {
	$password = addslashes($password);
}

// 패스워드를 암호화
if($password)
{
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];
}

// 원본글을 가져옴
$s_data=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$no'"));

// 회원일때를 확인;;
if(!$is_admin&&$member[level]>$setup[grant_delete])
{
	if(!$s_data[ismember])
	{
		if($s_data[password]!=$password) Error("비밀번호가 올바르지 않습니다");
	}
	else
	{
		if($s_data[ismember]!=$member[no]) Error("비밀번호를 입력하여 주십시요");
	}
}

/////////////////////////////////////////////////////////////////////////////////////////////
// 글삭제일때
////////////////////////////////////////////////////////////////////////////////////////////

if(!$s_data[child]) // 답글이 없을때;;
{
	mysql_query("delete from $t_board"."_$id where no='$no'") or Error(mysql_error()); // 글삭제

	// 파일삭제
	@z_unlink("./".$s_data[file_name1]);
	@z_unlink("./".$s_data[file_name2]);
	// 빈 파일 폴더 삭제
	if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name1],$out))
		if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
	if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name2],$out))
		if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);

	minus_division($s_data[division]);

	if($s_data[depth]==0)
	{
		if($s_data[prev_no]) mysql_query("update $t_board"."_$id set next_no='$s_data[next_no]' where next_no='$s_data[no]'"); // 이전글이 있으면 빈자리 메꿈;;;
		if($s_data[next_no]) mysql_query("update $t_board"."_$id set prev_no='$s_data[prev_no]' where prev_no='$s_data[no]'"); // 다음글이 있으면 빈자리 메꿈;;;
	}
	else
	{
		$temp=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id where father='$s_data[father]'"));
		if(!$temp[0]) mysql_query("update $t_board"."_$id set child='0' where no='$s_data[father]'"); // 원본글이 있으면 원본글의 자식글을 없앰;;;
	}

	// 간단한 답글(코멘트) 삭제
	$del_comment_result=mysql_query("select * from $t_comment"."_$id where parent='$s_data[no]'");
	mysql_query("delete from $t_comment"."_$id where parent='$s_data[no]'") or Error(mysql_error());
	while($c_data=mysql_fetch_array($del_comment_result)) {
		// 파일삭제
		@z_unlink("./".$c_data[file_name1]);
		@z_unlink("./".$c_data[file_name2]);
		// 빈 파일 폴더 삭제
		if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$c_data[file_name1],$out))
			if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
		if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$c_data[file_name2],$out))
			if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
	}

	$total=mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$id "));
	mysql_query("update $admin_table set total_article='$total[0]' where name='$id'");

	// 카테고리 필드 조절
	mysql_query("update $t_category"."_$id set num=num-1 where no='$s_data[category]'",$connect);

	// 회원일 경우 해당 해원의 점수 주기
	if($member[no]==$s_data[ismember]) @mysql_query("update $member_table set point1=point1-1 where no='$member[no]'",$connect) or error(mysql_error());
}

$query_time=getmicrotime();

movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&sn1=$sn1&divpage=$divpage");
?>
