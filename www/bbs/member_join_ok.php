<?
// 라이브러리 함수 파일 인크루드
include "lib.php";
$group_no=(int)$group_no;

// $HTTP_HOST 에서 포트번호 빼고 도메인 추출
if($mypos=strrpos($HTTP_HOST,":")) // 마지막 : 위치 찾아 제거
	$HTTP_HOST=substr($HTTP_HOST,0,$mypos);
if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)||$_SESSION['WRT_SS_VRS']==""||$_SESSION['WRT_SS_VRS']!=$wantispam||$_SESSION['WRT_SPM_PWD']==""||$_SESSION['WRT_SPM_PWD']!=$_POST['code']) Error("정상적으로 작성하여 주시기 바랍니다.");
if(!preg_match("/member_join.php/i",$HTTP_REFERER)) Error("정상적으로 작성하여 주시기 바랍니다","");
if(getenv("REQUEST_METHOD") == 'GET' ) Error("정상적으로 글을 쓰시기 바랍니다","");

// DB 연결
if(!$connect) $connect=dbConn();

// 멤버 정보 구해오기;;; 멤버가 있을때
$member=member_info();
if($mode=="admin"&&($member[is_admin]==1||($member[is_admin]==2&&$member[group_no]==$group_no))) $mode = "admin";
else $mode = "";

if($member[no]&&!$mode) Error("이미 가입이 되어 있습니다.","window.close");

// 현재 게시판 설정 읽어 오기
if($id) {
	$setup=get_table_attrib($id);

	// 설정되지 않은 게시판일때 에러 표시
	if(!$setup[name]) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시요");

	// 현재 게시판의 그룹의 설정 읽어 오기
	$group_data=group_info($setup[group_no]);
	if(!$group_data[use_join]&&!$mode) Error("현재 지정된 그룹은 추가 회원을 모집하지 않습니다");

} else {
	preg_match('/[0-9a-zA-Z\_]+/',$group_no,$result); //특수문자가 들어갔는지 조사
	if(!$group_no || $result[0]!=$group_no) Error("회원그룹을 정해주셔야 합니다");
	$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));
	preg_match('/[0-9a-zA-Z\_]+/',$group_data[no],$result); //특수문자가 들어갔는지 조사
	if(!$group_data[no] || $result[0]!=$group_data[no]) Error("지정된 그룹이 존재하지 않습니다");
	preg_match('/[0-9a-zA-Z\_]+/',$group_data[use_join],$result); //특수문자가 들어갔는지 조사
	if((!$group_data[use_join]&&!$mode) || $result[0]!=$group_data[use_join]) Error("현재 지정된 그룹은 추가 회원을 모집하지 않습니다");
}

// 빈문자열인지를 검사
$user_id = str_replace("ㅤ","",$user_id);
$name = str_replace("ㅤ","",$name);

if(!get_magic_quotes_gpc()) {
	$user_id = addslashes($user_id);
	$password = addslashes($password);
	$password1 = addslashes($password1);
	$email = addslashes($email);
}

$user_id=trim($user_id);
preg_match('/[0-9a-zA-Z\_]+/',$user_id,$result); //특수문자가 들어갔는지 조사
if(isBlank($user_id) || $result[0]!=$user_id) Error("ID를 입력하셔야 합니다(영문자와 숫자, _만을 사용!)","");

$check=mysql_fetch_array(mysql_query("select count(*) from $member_table where user_id='$user_id'",$connect));
if($check[0]>0) Error("이미 등록되어 있는 ID입니다","");

unset($check);
$check=mysql_fetch_array(mysql_query("select count(*) from $member_table where email='$email'",$connect));
if($check[0]>0) Error("이미 등록되어 있는 E-Mail입니다","");

if(isBlank($password)||isBlank($password1)) Error("비밀번호를 입력하셔야 합니다!","");
if($password!=$password1) Error("비밀번호와 비밀번호 확인이 일치하지 않습니다","");
// 패스워드를 암호화
if($password) {
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];   
}

if(isBlank($name)) Error("이름을 입력하셔야 합니다","");
if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$name)) Error("이름을 영문, 한글, 숫자등으로 입력하여 주십시요");

if($group_data[use_jumin]&&!$mode) {

	// 주민등록 번호 루틴
	if(isBlank($jumin1)||isBlank($jumin2)||strlen($jumin1)!=6||strlen($jumin2)!=7) Error("주민등록번호를 올바르게 입력하여 주십시요","");

	if(!check_jumin($jumin1.$jumin2)) Error("잘못된 주민등록번호입니다","");

	$check=mysql_fetch_array(mysql_query("select count(*) from $member_table where jumin=password('".$jumin1.$jumin2."')",$connect));
	if($check[0]>0) Error("이미 등록되어 있는 주민등록번호입니다","");
	$jumin=$jumin1.$jumin2;
}

$name=addslashes($name);

preg_match('/[0-9a-zA-Z.\@\_]+/',$email,$result); //특수문자가 들어갔는지 조사
if($result[0]!=$email) Error("E-mail 문자를 확인하세요(영문자와 숫자, ., @, _만을 사용!)","");
$email=addslashes($email);
if($_zbDefaultSetup[check_email]=="true"&&!mail_mx_check($email)) Error("입력하신 $email 은 존재하지 않는 메일주소입니다.<br>다시 한번 확인하여 주시기 바랍니다.");

if(preg_match("/[\!\\\#\$%\^&\+\|=\{\}\[\]\;<>\?\/\'\"]/i",$home_address)) Error("주소를 영문, 한글, 숫자, @, ( ), . , 등으로 입력하여 주십시요");
$home_address=addslashes($home_address);

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$home_tel)) Error("집전화를 영문, 한글, 숫자등으로 입력하여 주십시요");
$home_tel=addslashes($home_tel);

if(preg_match("/[\!\\\#\$%\^&\+\|=\{\}\[\]\;<>\?\/\'\"]/i",$office_address)) Error("사무실 주소를 영문, 한글, 숫자, @, ( ), . , 등으로 입력하여 주십시요");
$office_address=addslashes($office_address);

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$office_tel)) Error("사무실 전화번호를 영문, 한글, 숫자등으로 입력하여 주십시요");
$office_tel=addslashes($office_tel);

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$handphone)) Error("핸드폰 번호를 영문, 한글, 숫자등으로 입력하여 주십시요");
$handphone=addslashes($handphone);

if(preg_match("/[@\\\#\$&\(\)\+\|=\{\}\'\"]/i",$comment)) Error("자기소개를 영문, 한글, 숫자, !, %, ^, -, _, ; ?, /, <>, . 등으로 입력하여 주십시요. 괄호나 그밖의 특수문자, 따옴표 등은 허용되지 않습니다!");
$comment=addslashes($comment);

$birth=mktime(0,0,0,$birth_2,$birth_3,$birth_1);
if(!preg_match("/http:\/\//i",$homepage)&&$homepage) $homepage="http://$homepage";
$reg_date=time();

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$job)) Error("직업을 영문, 한글, 숫자등으로 입력하여 주십시요");
$job = addslashes($job);

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\'\"]/i",$homepage)) Error("홈페이지 주소를 영문, 한글, 숫자, -, ., / 등으로 입력하여 주십시요");
$homepage = addslashes($homepage);

$birth = addslashes($birth);

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\'\"]/i",$hobby)) Error("취미를 영문, 한글, 숫자, / 등으로 입력하여 주십시요");
$hobby = addslashes($hobby);

preg_match('/[0-9a-zA-Z.\@\_]+/',$icq,$result); //특수문자가 들어갔는지 조사
if($result[0]!=$icq) Error("icq 아이디를 확인하세요(영문자와 숫자, ., @, _만을 사용!)","");
$icq = addslashes($icq);

//AIM(aol) 아이디 정규표현
preg_match('/[0-9a-zA-Z.\@\_]+/',$aol,$result); //특수문자가 들어갔는지 조사
if($result[0]!=$aol) Error("AIM(aol) 아이디를 확인하세요(영문자와 숫자, ., @, _만을 사용!)","");
$aol = addslashes($aol);

preg_match('/[0-9a-zA-Z.\@\_]+/',$msn,$result); //특수문자가 들어갔는지 조사
if($result[0]!=$msn) Error("msn 아이디를 확인하세요(영문자와 숫자, ., @, _만을 사용!)","");
$msn = addslashes($msn);

if($_FILES[picture]) {
	$picture = $_FILES[picture][tmp_name];
	$picture_name = $_FILES[picture][name];
	$picture_type = $_FILES[picture][type];
	$picture_size = $_FILES[picture][size];
}

if($picture_name) {
	//특수문자가 들어갔는지 조사
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$picture_name,$result);
	if($result[0]!=$picture_name) Error("파일명은 한글,영문자,숫자,괄호,공백,+,-,_ 만을 사용할 수 있습니다!");

	if(!is_uploaded_file($picture)) Error("정상적인 방법으로 업로드 해주세요");
	if(!preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$picture_name)) Error("사진은 jpg(jpeg)/png/gif/bmp 파일을 올려주세요!");
	$size=GetImageSize($picture);
	if($size[0]>480||$size[1]>480) Error("사진의 크기는 480*480이하여야 합니다!");
	$kind=array("","jpg","jpeg","png","gif","bmp");
	$n=$size[2];
	$path="icon/member_".time().".".$kind[$n];
	if(!@move_uploaded_file($picture,$path)) Error("사진 업로드가 제대로 되지 않았습니다");
	$picture_name=$path;
}

mysql_query("insert into $member_table (level,group_no,user_id,password,name,email,homepage,icq,aol,msn,jumin,comment,job,hobby,home_address,home_tel,office_address,office_tel,handphone,mailing,birth,reg_date,openinfo,open_email,open_homepage,open_icq,open_msn,open_comment,open_job,open_hobby,open_home_address,open_home_tel,open_office_address,open_office_tel,open_handphone,open_birth,open_picture,picture,open_aol) values ('$group_data[join_level]','$group_data[no]','$user_id','$password','$name','$email','$homepage','$icq','$aol','$msn',password('$jumin'),'$comment','$job','$hobby','$home_address','$home_tel','$office_address','$office_tel','$handphone','$mailing','$birth','$reg_date','$openinfo','$open_email','$open_homepage','$open_icq','$open_msn','$open_comment','$open_job','$open_hobby','$open_home_address','$open_home_tel','$open_office_address','$open_office_tel','$open_handphone','$open_birth','$open_picture','$picture_name','$open_aol')") or error("회원 데이타 입력시 에러가 발생했습니다<br>".mysql_error());
mysql_query("update $group_table set member_num=member_num+1 where no='$group_data[no]'");

if(!$mode) {
	$member_data=mysql_fetch_array(mysql_query("select * from $member_table where user_id='$user_id' and password=password('$password')"));

	// 5.3 이상용 세션 처리
	$_SESSION['zb_logged_no'] = $member_data[no];
	$_SESSION['zb_logged_time'] = time();
	$_SESSION['zb_logged_ip'] = $REMOTE_ADDR;
	$_SESSION['zb_last_connect_check'] = '0';
}

// 보안을 위해 세션변수 삭제
unset($_SESSION['WRT_SS_VRS']);
unset($_SESSION['WRT_SPM_PWD']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script>
alert("회원가입이 정상적으로 처리 되었습니다\n\n회원이 되신것을 진심으로 축하드립니다.");
//opener.reload();
window.close();
</script>
