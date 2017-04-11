<?
/*********************************************************************
* 회원 정보 변경에 대한 처리
*********************************************************************/

function del_member($no) {
	global $group_no, $member_table, $get_memo_table,  $send_memo_table,$admin_table, $t_board, $t_comment, $connect, $group_table, $member;

	$member_data = mysql_fetch_array(mysql_query("select * from $member_table where no = '$no'"));
	if($member[is_admin]>1&&$member[no]!=$member_data[no]&&$member_data[level]<=$member[level]&&$member_data[is_admin]<=$member[is_admin]) error("선택하신 회원의 정보를 변경할 권한이 없습니다");

	// 멤버 정보 삭제
	@mysql_query("delete from $member_table where no='$no'") or error(mysql_error());

	// 쪽지 테이블에서 멤버 정보 삭제
	@mysql_query("delete from $get_memo_table where member_no='$no'") or error(mysql_error());
	@mysql_query("delete from $send_memo_table where member_no='$no'") or error(mysql_error());

	// 그룹테이블에서 회원수 -1
	@mysql_query("update $group_table set member_num=member_num-1 where no = '$group_no'") or error(mysql_error());

	// 이름 그림, 아이콘, 이미지 박스 사용용량 파일 삭제
	@z_unlink("icon/private_name/".$no.".gif");
	@z_unlink("icon/private_icon/".$no.".gif");
	@z_unlink("icon/member_image_box/".$no."_maxsize.php");
}


// 회원전체 삭제하는 부분

if($exec2=="deleteall"&&$member[is_admin]<3) {
	for($i=0;$i<sizeof($cart);$i++) {
		del_member($cart[$i]);
	}
	movepage("$PHP_SELF?exec=view_member&group_no=$group_no&page=$page&keyword=$keyword&keykind=$keykind&like=$like&level_search=$level_search&page_num=$page_num&sid=$sid");
}


// 회원 게시판 권한 취소시키는 부분

if($exec2=="modify_member_board_manager"&&$member[is_admin]<3) {

	$_temp=mysql_fetch_array(mysql_query("select * from $member_table where no = '$member_no'",$connect));

	$__temp = preg_split("/,/",$_temp[board_name]);

	$_st = "";

	for($u=0;$u<count($__temp);$u++) {
		$kk=trim($__temp[$u]);
		if($kk&&$kk!=$board_num&&isnum($kk)) $_st.=$kk.",";
	}

	mysql_query("update $member_table set board_name = '$_st' where no='$member_no'",$connect) or error(mysql_Error());

	movepage("$PHP_SELF?exec=view_member&exec2=modify&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&no=$member_no&keykind=$keykind&like=$like&sid=$sid");
}


// 회원 게시판 권한 추가시키는 부분

if($exec2=="add_member_board_manager"&&$member[is_admin]<3) {

	$_temp=mysql_fetch_array(mysql_query("select * from $member_table where no = '$member_no'",$connect));
	$_board_name = $_temp[board_name].$board_num.",";

	mysql_query("update $member_table set board_name = '$_board_name' where no='$member_no'",$connect) or error(mysql_Error());

	movepage("$PHP_SELF?exec=view_member&exec2=modify&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&no=$member_no&keykind=$keykind&like=$like&sid=$sid");
}


// 회원 권한 변경하는 부분

if($exec2=="moveall"&&$member[is_admin]==1) {
	for($i=0;$i<sizeof($cart);$i++) {
		mysql_query("update $member_table set level='$movelevel' where no='$cart[$i]'",$connect);
	}
	movepage("$PHP_SELF?exec=view_member&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&keykind=$keykind&like=$like&sid=$sid");
}


// 회원 그룹 변경하는 부분

if($exec2=="move_group"&&$member[is_admin]==1) {
	for($i=0;$i<sizeof($cart);$i++) {
		mysql_query("update $member_table set group_no='$movegroup' where no='$cart[$i]'",$connect);
		mysql_query("update $group_table set member_num=member_num-1 where no='$group_no'");
		mysql_query("update $group_table set member_num=member_num+1 where no='$movegroup'");
	}
	movepage("$PHP_SELF?exec=view_member&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&keykind=$keykind&like=$like&sid=$sid");
}


// 회원삭제하는 부분

if($exec2=="del"&&$member[is_admin]<3) {
	del_member($no);
	movepage("$PHP_SELF?exec=view_member&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&keykind=$keykind&like=$like&sid=$sid");
}


// 회원정보 변경하는 부분
preg_match('/[0-9a-zA-Z.\@\_]+/',$email,$result); //특수문자가 들어갔는지 조사
if($result[0]!=$email) Error("E-mail 문자를 확인하세요(영문자와 숫자, ., @, _만을 사용!)","");
$email=addslashes($email);
$member_data = mysql_fetch_array(mysql_query("select email from $member_table where no = '$member_no'"));
// email IP 표식 불러와 처리
unset($c_match);
if(preg_match("#(\|\|\|)([0-9.]{1,})$#",$member_data[email],$c_match))
	$email.=$c_match[1].$c_match[2];
$homepage=addslashes($homepage);
$icq=addslashes($icq);
$aol=addslashes($aol);
$msn=addslashes($msn);
$hobby=addslashes($hobby);
$job=addslashes($job);
$home_address=addslashes($home_address);
$home_tel=addslashes($home_tel);
$office_address=addslashes($office_address);
$office_tel=addslashes($office_tel);
$handphone=addslashes($handphone);
$comment=addslashes($comment);

if($exec2=="modify_member_ok") {
	// POST 방식이 아닌 경우 종료
	if($_SERVER['REQUEST_METHOD']!='POST') die("비정상적인 접근이라 차단됩니다");

	if($member[is_admin]>1) Error("회원정보변경 권한이 없습니다");
	if(isblank($name)) Error("이름을 입력하셔야 합니다");

	if($password&&$password1&&$password!=$password1) Error("비밀번호가 일치하지 않습니다");

	$birth=mktime(0,0,0,$birth_2,$birth_3,$birth_1);

	if($member[no]==$member_no) {
		$is_admin = $member[is_admin];
		$level = $member[level];
	}

	if(!get_magic_quotes_gpc()) {
		$password = addslashes($password);
		$password1 = addslashes($password1);
	}

	$que="update $member_table set name='$name'";

	if($level) $que.=",level='$level'";
	if($password&&$password1&&$password==$password1) $que.=" ,password=password('$password') ";
	if($member[is_admin]==1) $que.=",is_admin='$is_admin'";
	if($birth_1&&$birth_2&&$birth_3) $que.=",birth='$birth'";
	$que.=",email='$email'";
	$que.=",homepage='$homepage'";
	$que.=",icq='$icq'";
	$que.=",aol='$aol'";
	$que.=",msn='$msn'";
	$que.=",hobby='$hobby'";
	$que.=",job='$job'";
	$que.=",home_address='$home_address'";
	$que.=",home_tel='$home_tel'";
	$que.=",office_address='$office_address'";
	$que.=",office_tel='$office_tel'";
	$que.=",handphone='$handphone'";
	$que.=",mailing='$mailing'";
	$que.=",openinfo='$openinfo'";
	$que.=",comment='$comment'";
	$que.=" where no='$member_no'";

	@mysql_query($que) or Error("회원정보 수정시에 에러가 발생하였습니다 ".mysql_error());

	// 회원의 소개 사진
	if($_FILES[picture]) {
		$picture = $_FILES[picture][tmp_name];
		$picture_name = $_FILES[picture][name];
		$picture_type = $_FILES[picture][type];
		$picture_size = $_FILES[picture][size];
	}
	if($picture_name) {
		// 특수문자가 들어갔는지 조사
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$picture_name,$result);
		if($result[0]!=$picture_name) Error("사진 파일명은 한글,영문자,숫자,괄호,공백,+,-,_ 만을 사용할 수 있습니다!");

		if(!is_uploaded_file($picture)) Error("정상적인 방법으로 업로드하여 주십시요");
		if(!preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$picture_name)) Error("사진은 jpg(jpeg)/png/gif/bmp 파일을 올려주세요!");
		$size=GetImageSize($picture);
		if($size[0]>480||$size[1]>480) Error("사진의 크기는 480*480이하여야 합니다!");
		$kind=array("","jpg","jpeg","png","gif","bmp");
		$n=$size[2];
		$path="icon/member_".time().".".$kind[$n];
		@move_uploaded_file($picture,$path);
		@chmod($path,0707);
		@mysql_query("update $member_table set picture='$path' where no='$member_no'") or Error("사진 자료 업로드시 에러가 발생하였습니다");
	}

	// 이미지 박스 용량을 저장
	if($maxdirsize<>100) {
		$maxdirsize = $maxdirsize * 1024;
		// icon 디렉토리에 member_image_box 디렉토리가 없을경우 디렉토리 생성
		$path = "icon/member_image_box";
		if(!is_dir($path)) {
			@mkdir($path,0707,true);
			@chmod($path,0707);
		}

		zWriteFile("icon/member_image_box/".$member_no."_maxsize.php","<?/*".$maxdirsize."*/?>");
	}

	// 이름앞에 붙는 아이콘 삭제시
	if($delete_private_icon) @z_unlink("icon/private_icon/".$member_no.".gif");

	if($_FILES[private_icon]) {
		$private_icon = $_FILES[private_icon][tmp_name];
		$private_icon_name = $_FILES[private_icon][name];
		$private_icon_type = $_FILES[private_icon][type];
		$private_icon_size = $_FILES[private_icon][size];
	}
	// 이름앞에 붙는 아이콘 업로드시 처리
	if(@filesize($private_icon)) {
		if(!is_dir("icon/private_icon")) {
			@mkdir("icon/private_icon",0707,true);
			@chmod("icon/private_icon",0707);
		}

		// 한글문자가 들어갔는지 조사
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$private_icon_name,$result);
		if($result[0]!=$private_icon_name) Error("아이콘 파일명은 한글,영문자,숫자,괄호,공백,+,-,_ 만을 사용할 수 있습니다!");

		if(!is_uploaded_file($private_icon)) Error("정상적인 방법으로 업로드하여 주십시요");
		if(!preg_match("/\.gif$/i",$private_icon_name)) Error("이름앞의 아이콘은 Gif 파일만 올리실수 있습니다");
		$size=GetImageSize($private_icon);
		if($size[0]>16||$size[1]>16) Error("아이콘의 크기는 16*16이하여야 합니다");

		@move_uploaded_file($private_icon, "icon/private_icon/".$member_no.".gif");
		@chmod("icon/private_icon".$member_no.".gif",0707);
		@chmod("icon/private_icon",0707);
	}

	// 이름을 대신하는 아이콘 삭제시
	if($delete_private_name) @z_unlink("icon/private_name/".$member_no.".gif");

	// 이름을 대신하는 아이콘 업로드시 처리
	if($_FILES[private_name]) {
		$private_name = $_FILES[private_name][tmp_name];
		$private_name_name = $_FILES[private_name][name];
		$private_name_type = $_FILES[private_name][type];
		$private_name_size = $_FILES[private_name][size];
	}
	if(@filesize($private_name)) {
		if(!is_dir("icon/private_name")) {
			@mkdir("icon/private_name",0707,true);
			@chmod("icon/private_name",0707);
		}

		// 한글문자가 들어갔는지 조사
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$private_name_name,$result);
		if($result[0]!=$private_name_name) Error("이름을 대신하는 아이콘 파일명은 한글,영문자,숫자,괄호,공백,+,-,_ 만을 사용할 수 있습니다!");

		if(!is_uploaded_file($private_name)) Error("정상적인 방법으로 업로드하여 주십시요");
		if(!preg_match("/\.gif$/i",$private_name_name)) Error("이름을 대신하는 아이콘은 Gif 파일만 올리실수 있습니다");
		$size=GetImageSize($private_name);
		if($size[0]>60||$size[1]>16) Error("이름을 대신하는 아이콘의 크기는 60*16이하여야 합니다");

		@move_uploaded_file($private_name, "icon/private_name/".$member_no.".gif");
		@chmod("icon/private_name".$member_no.".gif",0707);
		@chmod("icon/private_name",0707);
	}
	// 관리자 자신의 비밀번호 변경시 새로이 쿠키를 설정하여 줌
	//if($member_no==$member[no]&&$password&&$password1&&$password==$password1) {
		//$password=mysql_fetch_array(mysql_query("select password('$password')"));
		//setcookie("zetyxboard_userid",$member[user_id],'',"/");
		//setcookie("zetyxboard_password",$password[0],'',"/");
	//}

	movepage("$PHP_SELF?exec=view_member&exec2=modify&no=$member_no&group_no=$group_no&page=$page&keyword=$keyword&level_search=$level_search&page_num=$page_num&keykind=$keykind&like=$like&sid=$sid");
}
?>