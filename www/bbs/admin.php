<?
include "lib.php";
if(!$connect) $connect=dbConn();
$member=member_info();
if((($member[no]&&$member[is_admin]<3&&$member[is_admin]>=1)||($member[no]&&$member[board_name]))&&$_SESSION['_token2']) movepage("admin_setup_bac.php?sid=".$_SESSION['_token2']);
else {
	if($member[no]) {
		destroyZBSessionID($member[no]);
		// 토큰 초기화
		$_SESSION['_token']='';
		setCookie("token","",0,"/","");
		$_SESSION['_token2']='';
		setCookie("token2","",0,"/","");
		// 5.3 이상용 세션 처리
		$_SESSION['zb_logged_no']='';
		$_SESSION['zb_logged_time']='';
		$_SESSION['zb_logged_ip']='';
		$_SESSION['zb_secret']='';
		$_SESSION['zb_last_connect_check']='0';
	}
}

head(" bgcolor=444444 onload=write.user_id.focus()");
?>

<script src="script/get_url.php" type="text/javascript"></script>
<script>
function check_submit() {
	if(!write.user_id.value) {
		alert("ID를 입력하여 주십시요");
		write.user_id.focus();
		return false;
	}
	if(!write.password.value) {
		alert("Password를 입력하여 주십시요");
		write.password.focus();
		return false;
	}
	var f = document.forms["write"];
	// 보안접속을 체크했을 때의 액션
	if ( f.SSL_Login.checked ) {
		f.action = sslUrl()+"login_check2.php";
	}
	check=confirm("자동 로그인 기능을 사용하시겠습니까?\n\n자동 로그인 사용시 다음 접속부터는 로그인을 하실필요가 없습니다.\n\n단, 게임방, 학교등 공공장소에서 이용시 개인정보가 유출될수 있으니 조심하여 주십시요");
	if(check) {write.auto_login.value=1;}
	return true;
}

function check_SSL_Login() {
	if (document.write.SSL_Login.checked==true) {
		alert("SSL 암호화 보안접속을 설정합니다");
	} else {
		alert("SSL 암호화 보안접속을 해제합니다");
	}
}
</script>

<br><br><br>
<form name=write method=post action=login_check2.php onsubmit="return check_submit();">
<input type=hidden name=auto_login value=<?if(!$autologin[ok])echo "0"; else echo "1"?>>
<input type=hidden name=s_url value="<?=$REQUEST_URI?>">
<input type=hidden name=exec value=login>
<div align=center>
<table cellpadding=3 cellspacing=1 width=250 border=0 bgcolor="#000000">
<tr>
  <td height=25 align=center colspan=2 bgcolor=000000 style="font-weight:bold;color:#ffffff;font-family:Tahoma;font-size:9pt;">
  ZEROBOARD Administrator Login</td>
</tr>
<tr height=25>
  <td align=right bgcolor=#868686 style=font-family:Tahoma;font-size:9pt;padding:3px><b>User ID &nbsp;</b></td>
  <td bgcolor=#e0e0e0 align=left><input type=text name=user_id value='' size=19 maxlength=20 class=input style=border-color:#b0b0b0><input type=checkbox name=SSL_Login value=1 checked onclick=check_SSL_Login() title="보안접속 설정/해제"></td>
</tr>
<tr height=25>
  <td align=right bgcolor=#868686 style=font-family:Tahoma;font-size:9pt;padding:3px><b>Password &nbsp;</b></td>
  <td align=left bgcolor=#e0e0e0><input type=password name=password size=19 maxlength=20 class=input style=border-color:#b0b0b0></td>
</tr>
<tr height=25>
  <td align=center align=center colspan=2 bgcolor=3d3d3d>
      <input type=submit value=" Administrator Login " style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:9pt;font-family:Tahoma;height:23px;>
  </td>
</tr>
</table>
</form>

<?
foot();
?>
