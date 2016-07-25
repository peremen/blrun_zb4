<?
// 라이브러리 함수 파일 인크루드
include "lib.php";

// HTML 출력
head();

if(!empty($_POST['code'])) {

	// 스팸방지코드 체크 관련
	include("securimage/securimage.php");
	$img = new Securimage();
	$valid = $img->check($_POST['code']);

	if($valid == true) {

	} else {
		Error("스팸방지 코드를 잘못 입력하셨습니다.");
	}
	
	if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)) Error("정상적으로 글을 작성하여 주시기 바랍니다.");

	// 스팸방지 보안 세션변수 설정
	$_SESSION['WRT_SPM_PWD'] = $_POST['code'];

	// 랜덤한 두 숫자를 발생(1-1000) 후 변수에 대입
	$wnum1 = mt_rand(1,1000);
	$wnum2 = mt_rand(1,1000);
	$wnum1num2 = $wnum1*10000 + $wnum2;
	// 글쓰기 보안을 위해 세션변수를 설정
	$_SESSION['WRT_SS_VRS'] = $wnum1num2;

	// DB 연결
	if(!$connect) $connect=dbConn();

	// 그룹 번호 체크
	$group_no=(int)$group_no;
	if(!$group_no) {
		list($group_no) = mysql_fetch_row(mysql_query("select `no` from `$group_table` order by `no` limit 1;"));
	}

	// 멤버 정보 구해오기;;; 멤버가 있을때
	$member=member_info();

	if($mode=="admin"&&($member[is_admin]==1||($member[is_admin]==2&&$member[group_no]==$group_no))) $mode = "admin";
	else $mode = "";

	if($member[no]&&!$mode) Error("이미 가입이 되어 있습니다.","window.close");


	// 게시판과 그룹설정에 따라서 회원 가입 설정
	if($id) {
		// 현재 게시판 설정 읽어 오기
		$setup=get_table_attrib($id);

		// 설정되지 않은 게시판일때 에러 표시
		if(!$setup[name]) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시요","window.close");

		// 현재 게시판의 그룹의 설정 읽어 오기
		$group=group_info($setup[group_no]);
		if(!$group[use_join]&&!$mode) Error("현재 지정된 그룹은 추가 회원을 모집하지 않습니다","window.close");

	} else {

		if($group_name){
			$group_name=mysql_real_escape_string($group_name);
			$group=mysql_fetch_assoc(mysql_query("select * from $group_table where name='$group_name' limit 1;"));
		}elseif($group_no) $group=mysql_fetch_assoc(mysql_query("select * from $group_table where no='$group_no' limit 1;"));
		if(!$group[no]) Error("지정된 그룹이 존재하지 않습니다");
		if(!$group[use_join]&&!$mode) Error("현재 지정된 그룹은 추가 회원을 모집하지 않습니다");

	}

	$check[1]="checked";

	if(!$referer) $referer=$HTTP_REFERER;

	$setup[header]="";
	$setup[footer]="";
	$setup[header_url]="";
	$setup[footer_url]="";
	$group[header]="";
	$group[footer]="";
	$group[header_url]="";
	$group[footer_url]="";
	$setup[skinname]="";

?>

<script src="script/get_url.php" type="text/javascript"></script>
<script>
function address_popup(num)
{
  window.open('zipcode/search_zipcode.php?num='+num,'searchaddress','width=440,height=230,scrollbars=yes');
}

function check_submit()
{

<?
	if(file_exists("./join_license.txt")) {
?>

  if(!write.accept.checked) {
    alert("가입약관에 동의하셔야 회원가입을 할수 있습니다");
    return false;
  }

<?
	}
?>
  if(!write.user_id.value) {alert("아이디를 입력하여 주십시요.");write.user_id.focus(); return false;}
<?
	if($_zbDefaultSetup[enable_hangul_id]=="false") {
?>

  // ID Check
  if(write.user_id.value.length<4||write.user_id.value.length>40) {
    alert("아이디는 4자 이상, 40자 이하여야 합니다.");
    write.user_id.focus();
    return false;
  }
  var valid = "abcdefghijklmnopqrstuvwxyz0123456789_"; 
  var startChar = "abcdefghijklmnopqrstuvwxyz"; 
  var temp; 
  write.user_id.value = write.user_id.value.toLowerCase(); 
  temp = write.user_id.value.substring(0,1); 
  if (startChar.indexOf(temp) == "-1") {
    alert("아이디의 첫 글자는 영문이어야 합니다.");
    write.user_id.value = ""; 
    write.user_id.focus(); 
    return false;
  }
  for (var i=0; i<write.user_id.value.length; i++) { 
    temp = "" + write.user_id.value.substring(i, i+1); 
    if (valid.indexOf(temp) == "-1") { 
      alert("아이디는 영문과 숫자, _ 로만 이루어질수 있습니다.");
      write.user_id.value = "";
      write.user_id.focus(); 
      return false;
    }
  } 
<?
	}
?>

  if(!write.password.value) {alert("비밀번호를 입력하여 주십시요.");write.password.focus(); return false;}
  if(!write.password1.value) {alert("비밀번호 확인을 입력하여 주십시요.");write.password1.focus(); return false;}
  if(write.password.value!=write.password1.value) {alert("패스워드가 일치하지 않습니다.");write.password.value="";write.password1.value=""; write.password.focus(); return false;}
  if(!write.name.value) { alert("이름을 입력하세요"); write.name.focus(); return false; }

  var f = document.forms["write"];
  // 보안접속을 체크했을 때의 액션
  if ( f.SSL_Login.checked ) {
    f.action = sslUrl()+"member_join_ok.php";
  }

<? if($group[use_birth]) { ?>
  if ( write.birth_1.value < 1000 || write.birth_1.value <= 0 )  {
    alert('생년이 잘못입력되었습니다.');
    write.birth_1.value='';
    write.birth_1.focus();
    return false;
  }
  if ( write.birth_2.value > 12 || write.birth_2.value <= 0 ) {
    alert('생월이 잘못입력되었습니다.');
    write.birth_2.value='';
    write.birth_2.focus();
    return false;
  }
  if ( write.birth_3.value > 31 || write.birth_3.value <= 0 )  {
    alert('생일이 잘못입력되었습니다.');
    write.birth_3.value='';
    write.birth_3.focus();
    return false;
  }
<? } ?>

  if(!write.email.value) {alert("E-Mail을 입력하여 주십시요.");write.email.focus(); return false;}

<? if($group[use_jumin]&&!$mode) { ?>
  if(!write.jumin1.value) {alert("주민등록번호를 입력하여 주십시요");write.jumin1.focus(); return false;}
  if(!write.jumin2.value) {alert("주민등록번호를 입력하여 주십시요");write.jumin2.focus(); return false;}
<? } ?>

  return true;
}

function check_id()
{
  var id = document.getElementById("user_id").value;
  if(!id)
  {
    alert('아이디를 입력하여 주십시요');
  }
  else
  {
    window.open('check_user_id.php?user_id='+id,'check_user_id','width=200,height=100,toolbar=no,status=no,resizable=no');
  }
}

function check_accept() {
  return confirm("위의 가입 약관을 모두 보았으며, 동의하십니까?");
}

function check_SSL_Login() { 
  if (document.write.SSL_Login.checked==true) {
    alert("SSL 암호화 보안접속을 설정합니다");
  } else {
    alert("SSL 암호화 보안접속을 해제합니다");
  }
}
</script>

<div align=center><br>
<table border=0 cellspacing=1 cellpadding=0 width=540>
<form name=write method=post action=member_join_ok.php enctype=multipart/form-data onsubmit="return check_submit();">
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=referer value="<?=$referer?>">
<input type=hidden name=group_no value="<?=$group[no]?>">
<input type=hidden name=mode value="<?=$mode?>">
<input type=hidden name=wantispam value="<?=$wnum1num2?>">
<input type=hidden name=code value="<?=$_POST['code']?>">

<tr><td colspan=2><img src=images/member_joinin.gif><br><br></td>
</tr>

<?
	if(file_exists("./join_license.txt")) {
		$f=fopen("join_license.txt",r);
		$join_license = fread($f,filesize("join_license.txt"));
		fclose($f);
?>
<tr><td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="3"></td>
</tr>
<tr>
  <td colspan=2>
    <br><div align=center><textarea cols=80 rows=6 readonly style=border-color:#d8b3b3;width:95% class=input><?=$join_license?></textarea></div>
  </td>
</tr>
<tr>
  <td colspan=2>&nbsp;&nbsp;&nbsp;<input type=checkbox name=accept value=1 onclick="return check_accept()"> 위의 가입 약관에 동의합니다</td>
</tr>
<?
	}
?>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="3"></td>
</tr>
<tr align=right>
  <td width=25% style=font-family:Tahoma;font-size:9pt;><b>ID&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=user_id id=user_id size=20 maxlength=20 style=border-color:#d8b3b3 class=input> <input type=button value='Check ID' style=color:#000000;border-color:#dfb8b8;background-color:#f0f0f0;font-size:9pt;font-family:Tahoma;height:20px; onclick=check_id()> <input type=checkbox name=SSL_Login value=1 checked onclick=check_SSL_Login() title="보안접속 설정/해제"><br><img src=images/t.gif border=0 height=4><? if($_zbDefaultSetup[enable_hangul_id]=="false") {?><br>&nbsp;(영문,숫자,_로만 아이디를 작성하세요)<? } ?></td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;><B>Password&nbsp;</td>
  <td align=left>&nbsp;<input type=password name=password size=20 maxlength=20 style=border-color:#d8b3b3 class=input> 확인 : <input type=password name=password1 size=20 maxlength=20 style=border-color:#d8b3b3 class=input></td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;><b>Name&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=name size=20 maxlength=20 style=border-color:#d8b3b3 class=input></td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? if($group[use_birth]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;><b>Birthday&nbsp;</td>
  <td align=left>
    &nbsp;<input type=text name=birth_1 size=4 maxlength=4 style=border-color:#d8b3b3 class=input> 년 
    &nbsp;<input type=text name=birth_2 size=2 maxlength=2 style=border-color:#d8b3b3 class=input> 월
    &nbsp;<input type=text name=birth_3 size=2 maxlength=2 style=border-color:#d8b3b3 class=input> 일
    <input type=checkbox value=1 checked name=open_birth> 공개
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;><b>E-mail&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=email size=50 maxlength=200 style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_email checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>Homepage&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=homepage size=50 maxlength=255 style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_homepage checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>

<? if($group[use_icq]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>ICQ&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=icq size=20 maxlength=20 style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_icq checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_aol]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>AIM&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=aol size=20 maxlength=20 style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_aol checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_msn]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>MSN&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=msn size=20 maxlength=250 style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_msn checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_jumin]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt; valign=top><table border=0 cellspacing=0 cellpadding=0 height=4><tr><td></td></tr></table><b>주민등록번호 &nbsp;</td>
  <td align=left>&nbsp<input type=text name=jumin1 size=6 maxlength=6 style=border-color:#d8b3b3 class=input>-<input type=text name=jumin2 size=7 maxlength=7 style=border-color:#d8b3b3 class=input> <br>* 주민등록번호는 암호화되어 저장이 되므로 관리자도 알수 없습니다<br>&nbsp; (회원 중복가입을 막기 위한 검사수단으로만 사용이 됩니다)</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_hobby]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>Hobby&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=hobby size=50 maxlength=50 style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_hobby checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_job]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>Occupation(Job)&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=job size=20 maxlength=20 style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_job checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_home_address]) { ?> 
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>Home Address&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=home_address size=40 maxlength=255 style=border-color:#d8b3b3 class=input><input type=button value='검색' class=input style=border-color:#d8b3b3 onclick=address_popup(1)><input type=checkbox value=1 name=open_home_address checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_home_tel]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>Home Phone&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=home_tel size=20 maxlength=20 style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_home_tel checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_office_address]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>Office Address&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=office_address size=40 maxlength=255 style=border-color:#d8b3b3 class=input><input type=button value='검색' class=input style=border-color:#d8b3b3 onclick=address_popup(2)><input type=checkbox value=1 name=open_office_address checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_office_tel]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>Office Phone&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=office_tel size=20 maxlength=20 style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_office_tel checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_handphone]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>Cellular&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=handphone size=20 maxlength=20 style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_handphone checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_mailing]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;><b>Mailling List&nbsp;</td>
  <td align=left>&nbsp;<input type=checkbox name=mailing value=1 checked> 메일링 가입</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_picture]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>Photo&nbsp;</td>
  <td align=left>&nbsp;<input type=file name=picture size=35 maxlength=255 style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_picture checked> 공개 (480X480 이하)
  </td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group[use_comment]) { ?>
<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;>자기 소개서</td>
  <td align=left>&nbsp;<textarea cols=50 rows=4 name=comment style=border-color:#d8b3b3 class=textarea></textarea><br>&nbsp;<input type=checkbox value=1 name=open_comment checked> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<tr align=right height=28>
  <td style=font-family:Tahoma;font-size:9pt;><b>개인정보 공개</td>
  <td align=left>&nbsp;<input type=checkbox name=openinfo value=1 checked> 정보 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>

<tr height=30 bgcolor=#ffffff>
  <td  colspan=2 align=right ><img src=images/t.gif height=5><br>
  <input type=image border=0 src=images/button_join.gif> &nbsp;
  <img src=images/memo_close.gif border=0 onClick=window.close() style=cursor:hand>&nbsp;&nbsp;&nbsp;
  </td>
</tr>

</form>
</table>
</div>

<?
	// 세션이 초기화되는 버그 때문에 세션변수를 재설정
	$_SESSION['WRT_SPM_PWD'] = $_POST['code'];

} else {
?>
<script language="javascript">
<!--
function sendit() {
	// 스팸방지코드 입력 유무 체크
	if(document.myform.code.value=="") {
		alert("스팸방지 코드를 입력해 주십시요");
		document.myform.code.focus();
		return false;
	}
	document.myform.submit();
}
//-->
</script>
<table width=100% height=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
	<form name="myform" method="post" action="member_join.php">
	<input type=hidden name=group_no value=<?=$group_no?>>
	<input type=hidden name=mode value=<?=$mode?>>
	<table width=310 height=85 border=0 cellpadding=1 cellspacing=0 bgcolor=#FFFFFF align=center>
	<tr>
		<td align=center>
			<div style="width: 310px; float: left; height: 85px; line-height: 12px">
			<img id="siimage" align="left" valign=absmiddle style="padding-right: 5px; border: 0" src="securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" />
			<p><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="33" height="33" id="SecurImage_as3" align="middle">
				<param name="allowScriptAccess" value="sameDomain" />
				<param name="allowFullScreen" value="false" />
				<param name="movie" value="securimage/securimage_play.swf?audio=securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
				<param name="quality" value="high" />

				<param name="bgcolor" value="#ffffff" />
				<embed src="securimage/securimage_play.swf?audio=securimage/securimage_play.php&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="33" height="33" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object>
			<br />
			<!-- pass a session id to the query string of the script to prevent ie caching -->
			<a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="securimage/images/refresh.gif" width="33" height="33" alt="Reload Image" border="0" onclick="this.blur()" align="bottom" /></a></p>
			</div>
			<div style="clear: both"></div>
			<b>스팸방지코드 입력:</b>
			<!-- NOTE: the "name" attribute is "code" so that $img->check($_POST['code']) will check the submitted form field -->
			<input type="text" name="code" size="12" /><br /><br />
		</td>
	</tr>
	<tr class=list0>
		<td align=center><input type=button value=" 확 인 " onClick="javascript:sendit()"></td>
	</tr>
	</table>
	</form>
</td></tr>
</table>

<? 
}
foot();
?>