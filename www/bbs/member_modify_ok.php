<?
// 라이브러리 함수 파일 인크루드
include "lib.php";

if(getenv("REQUEST_METHOD") == 'GET' ) Error("정상적으로 글을 쓰시기 바랍니다","");

// DB 연결
if(!$connect) $connect=dbConn();

// 멤버 정보 구해오기;;; 멤버가 있을때
$member=member_info();
if(!$member[no]) Error("회원정보가 존재하지 않습니다");
$group=group_info($member[group_no]);

$name = str_replace("ㅤ","",$name);

if(!get_magic_quotes_gpc()) {
	$password = addslashes($password);
	$password1 = addslashes($password1);
	$email = addslashes($email);
}

if(isblank($name)) Error("이름을 입력하셔야 합니다");
if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$name)) Error("이름을 영문, 한글, 숫자등으로 입력하여 주십시요");

// 패스워드를 입력 확인 및 암호화
if($password){
	//stripslashes($password);
	if($password) {
		$temp=mysql_fetch_array(mysql_query("select password('$password')"));
		$password=$temp[0];   
	}
}
if($password1){
	//stripslashes($password1);
	if($password1) {
		$temp=mysql_fetch_array(mysql_query("select password('$password1')"));
		$password1=$temp[0];   
	}
}
if($password!=$password1) Error("비밀번호와 비밀번호 확인이 일치하지 않습니다","");

$birth=mktime(0,0,0,$birth_2,$birth_3,$birth_1);

$check=mysql_fetch_array(mysql_query("select count(*) from $member_table where email='$email' and no <> ".$member[no],$connect));
if($check[0]>0) Error("이미 등록되어 있는 E-Mail입니다");

$name = addslashes(del_html($name));

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$job)) Error("직업을 영문, 한글, 숫자등으로 입력하여 주십시요");
$job = addslashes(del_html($job));

preg_match('/[0-9a-zA-Z.\@\_]+/',$email,$result); // 특수문자가 들어갔는지 조사
if($result[0]!=$email) Error("E-mail 문자를 확인하세요(영문자와 숫자, ., @, _만을 사용!)","");	
$email = addslashes(del_html($email));
if($_zbDefaultSetup[check_email]=="true"&&!mail_mx_check($email)) Error("입력하신 $email 은 존재하지 않는 메일주소입니다.<br>다시 한번 확인하여 주시기 바랍니다.");
// email IP 표식 불러와 처리
unset($c_match);
if(preg_match("#\|\|\|([0-9.]{1,})$#",$member[email],$c_match)) {
	$tokenID = $c_match[1];
}
$email.="|||".$tokenID;

if(!preg_match("/http:\/\//i",$homepage)&&$homepage) $homepage="http://$homepage";
if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\'\"]/i",$homepage)) Error("홈페이지 주소를 영문, 한글, 숫자, -, ., / 등으로 입력하여 주십시요");
$homepage = addslashes(del_html($homepage));

$birth = addslashes(del_html($birth));

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\'\"]/i",$hobby)) Error("취미를 영문, 한글, 숫자, / 등으로 입력하여 주십시요");
$hobby = addslashes(del_html($hobby));

preg_match('/[0-9a-zA-Z.\@\_]+/',$icq,$result); //특수문자가 들어갔는지 조사
if($result[0]!=$icq) Error("icq 아이디를 확인하세요(영문자와 숫자, ., @, _만을 사용!)","");
$icq = addslashes(del_html($icq));

//AIM(aol) 아이디 정규표현
preg_match('/[0-9a-zA-Z.\@\_]+/',$aol,$result); //특수문자가 들어갔는지 조사
if($result[0]!=$aol) Error("AIM(aol) 아이디를 확인하세요(영문자와 숫자, ., @, _만을 사용!)","");
$aol = addslashes(del_html($aol));

preg_match('/[0-9a-zA-Z.\@\_]+/',$msn,$result); //특수문자가 들어갔는지 조사
if($result[0]!=$msn) Error("msn 아이디를 확인하세요(영문자와 숫자, ., @, _만을 사용!)","");
$msn = addslashes(del_html($msn));

if(preg_match("/[\!\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\/\'\"]/i",$home_address)) Error("주소를 영문, 한글, 숫자, @, . 등으로 입력하여 주십시요");
$home_address = addslashes(del_html($home_address));

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$home_tel)) Error("집전화를 영문, 한글, 숫자등으로 입력하여 주십시요");
$home_tel = addslashes(del_html($home_tel));

if(preg_match("/[\!\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\/\'\"]/i",$office_address)) Error("사무실 주소를 영문, 한글, 숫자, @, . 등으로 입력하여 주십시요");
$office_address = addslashes(del_html($office_address));

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$office_tel)) Error("사무실 전화번호를 영문, 한글, 숫자등으로 입력하여 주십시요");
$office_tel = addslashes(del_html($office_tel));

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$handphone)) Error("핸드폰 번호를 영문, 한글, 숫자등으로 입력하여 주십시요");
$handphone = addslashes(del_html($handphone));

if(preg_match("/[@\\\#\$&\(\)\+\|=\{\}\'\"]/i",$comment)) Error("자기소개를 영문, 한글, 숫자, !, %, ^, -, _, ; ?, /, <>, . 등으로 입력하여 주십시요. 괄호나 그밖의 특수문자, 따옴표 등은 허용되지 않습니다!");
$comment = addslashes(del_html($comment));

$que="update $member_table set name='$name'";
if($password&&$password1&&$password==$password1) $que.=" ,password='$password' ";
if($birth_1&&$birth_2&&birth_3&&$group[use_birth]) $que.=",birth='$birth'";
if($email) $que.=",email='$email'";
$que.=",homepage='$homepage'";
if($group[use_job]) $que.=",job='$job'";
if($group[use_hobby]) $que.=",hobby='$hobby'";
if($group[use_icq]) $que.=",icq='$icq'";
if($group[use_aol]) $que.=",aol='$aol'";
if($group[use_msn]) $que.=",msn='$msn'";
if($group[use_home_address]) $que.=",home_address='$home_address'";
if($group[use_home_tel]) $que.=",home_tel='$home_tel'";
if($group[use_office_address]) $que.=",office_address='$office_address'";
if($group[use_office_tel]) $que.=",office_tel='$office_tel'";
if($group[use_handphone]) $que.=",handphone='$handphone'";
if($group[use_mailing]) $que.=",mailing='$mailing'";
$que.=",openinfo='$openinfo'";
if($group[use_comment]) $que.=",comment='$comment'";
$que.=",openinfo='$openinfo',open_email='$open_email',open_homepage='$open_homepage',open_icq='$open_icq',open_msn='$open_msn',open_comment='$open_comment',open_job='$open_job',open_hobby='$open_hobby',open_home_address='$open_home_address',open_home_tel='$open_home_tel',open_office_address='$open_office_address',open_office_tel='$open_office_tel',open_handphone='$open_handphone',open_birth='$open_birth',open_picture='$open_picture',open_aol='$open_aol' ";
$que.=" where no='$member[no]'";

@mysql_query($que) or Error("회원정보 수정시에 에러가 발생하였습니다 ".mysql_error());

if($del_picture) {
	@z_unlink($member[picture]);
	@mysql_query("update $member_table set picture='' where no='$member[no]'") or Error("사진 자료 업로드시 에러가 발생하였습니다");
}

if($HTTP_POST_FILES[picture]) {
	$picture = $HTTP_POST_FILES[picture][tmp_name];
	$picture_name = $HTTP_POST_FILES[picture][name];
	$picture_type = $HTTP_POST_FILES[picture][type];
	$picture_size = $HTTP_POST_FILES[picture][size];
}

if($picture_name) {
	// 특수문자가 들어갔는지 조사
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$picture_name,$result);
	if($result[0]!=$picture_name) Error("파일명은 한글,영문자,숫자,괄호,공백,+,-,_ 만을 사용할 수 있습니다!");

	if(!is_uploaded_file($picture)) Error("정상적인 방법으로 업로드 해주세요");
	if(!preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$picture_name)) Error("사진은 jpg(jpeg)/png/gif/bmp 파일을 올려주세요!");
	$size=GetImageSize($picture);
	if($size[0]>480||$size[1]>480) Error("사진의 크기는 480*480이하여야 합니다!");
	$kind=array("","jpg","jpeg","png","gif","bmp");
	$n=$size[2];
	$path="icon/member_".time().".".$kind[$n];
	if(!move_uploaded_file($picture,$path)) Error("사진 업로드가 제대로 되지 않았습니다");
	@mysql_query("update $member_table set picture='$path' where no='$member[no]'") or Error("사진 자료 업로드시 에러가 발생하였습니다");
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script>
alert("회원님의 정보 수정이 제대로 처리되었습니다.");
//opener.reload();
window.close();
</script>
