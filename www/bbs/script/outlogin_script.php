
<script src="bbs/script/get_url.php" type="text/javascript"></script>
<script>
function zb_login_check_submit() {
	if(!document.zb_login.user_id.value) {
		alert("ID를 입력하여 주십시요");
		document.zb_login.user_id.focus();
		return false;
	}
	if(!document.zb_login.password.value) {
		alert("Password를 입력하여 주십시요");
		document.zb_login.password.focus();
		return false;
	}
	var f = document.forms["zb_login"];
	//액션
	if ( f.SSL_Login.checked ) { //보안접속 체크 판별
		//보안접속을 체크했을 때의 액션
		f.action = sslUrl()+"login_check.php";
	}
	return true;
}

function check_SSL_Login() { 
	if (document.zb_login.SSL_Login.checked==true) {
		alert("SSL 암호화 보안접속을 설정합니다");
	} else {
		alert("SSL 암호화 보안접속을 해제합니다");
	}
}

function check_autologin() { 
	if (document.zb_login.auto_login.checked==true) {
		var check;  
		check = confirm("자동 로그인 기능을 사용하시겠습니까?\n\n자동 로그인 사용시 다음 접속부터는 로그인을 하실필요가 없습니다.\n\n단, 게임방, 학교등 공공장소에서 이용시 개인정보가 유출될수 있으니 주의해주세요");
		if(check==false) {document.zb_login.auto_login.checked=false;}
	}                               
}
</script>
