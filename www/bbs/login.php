<?
// 자동으로 www 붙여준다.
//if(!preg_match("/www/i",$HTTP_HOST)) header("location: http://www.".$HTTP_HOST.$REQUEST_URI);

include "lib.php";

if(!$id&&!$group_no) Error("게시판 이름이나 그룹번호를 지정하여 주셔야 합니다.<br><br>(login.php?id=게시판이름   또는  login.php?group_no=번호)","");

if(!$connect) $connect=dbConn();

// 현재 게시판 설정 읽어 오기
if($id) {
	$setup=get_table_attrib($id);

	// 설정되지 않은 게시판일때 에러 표시
	if(!$setup[name]) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시요","");

	// 현재 게시판의 그룹의 설정 읽어 오기
	$group=group_info($setup[group_no]);
	$dir="skin/".$setup[skinname];
	$file="skin/".$setup[skinname]."/login.php";

} else {

	if($group_no) $group=mysqli_fetch_array(mysqli_query($connect,"select * from $group_table where no='$group_no'"));
	if(!$group[no]) Error("지정된 그룹이 존재하지 않습니다");
}

head();
?>

<script src="script/get_url.php" type="text/javascript"></script>
<script>
function check_submit()
{
	if(!login.user_id.value) {
		alert("아이디를 입력하여 주세요");
		login.user_id.focus();
		return false;
	}
	if(!login.password.value) {
		alert("비밀번호를 입력하여 주세요");
		login.password.focus();
		return false;
	}
	var f = document.forms["login"];
	// 보안접속을 체크했을 때의 액션
	if ( f.SSL_Login.checked ) {
		f.action = sslUrl()+"login_check.php";
	}
	check=confirm("자동 로그인 기능을 사용하시겠습니까?\n\n자동 로그인 사용시 다음 접속부터는 로그인을 하실필요가 없습니다.\n\n단, 게임방, 학교등 공공장소에서 이용시 개인정보가 유출될수 있으니 조심하여 주십시요");
	if(check) {login.auto_login.value=1;}
	return true;
}

function check_SSL_Login() {
	if (document.login.SSL_Login.checked==true) {
		alert("SSL 암호화 보안접속을 설정합니다");
	} else {
		alert("SSL 암호화 보안접속을 해제합니다");
	}
}
</script>

<form method=post action=login_check.php onsubmit="return check_submit();" name=login>
<input type=hidden name=auto_login value=<?if(!$autologin[ok])echo "0"; else echo "1"?>>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=no value=<?=$no?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=sm value="<?=$sm?>">
<input type=hidden name=mode value="<?=$mode?>">
<input type=hidden name=s_url value="<?=$s_url?>">
<input type=hidden name=referer value="<?=$referer?>">

<?
if($id) include $file;
?>
</form>
<?
foot();
?>
