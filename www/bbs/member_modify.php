<?
// 라이브러리 함수 파일 인크루드
include "lib.php";

// DB 연결
if(!$connect) $connect=dbConn();

// 현재 게시판 설정 읽어 오기
if($id) {
	$setup=get_table_attrib($id);

	// 설정되지 않은 게시판일때 에러 표시
	if(!$setup[name]) Error("생성되지 않은 게시판입니다.<br><br>게시판을 생성후 사용하십시요","window.close");
}

// 멤버 정보 구해오기;;; 멤버가 있을때
$member=member_info();

if(!$member[no]) Error("회원 정보가 존재하지 않습니다","window.close");

// 폼타켓을 member_modify.php로 설정
$target="member_modify.php";

// 패스워드가 틀리면 에러 표시
if($password) {
	if(!get_magic_quotes_gpc()) {
		$password = addslashes($password);
	}
	$secret_check=mysql_fetch_array(mysql_query("select count(*) from $member_table where user_id='$member[user_id]' and password=password('$password')"));
	if(!$secret_check[0]) error("비밀번호 오류! 회원정보를 수정할 권한이 없습니다");
	$target2=$ssl_url."member_modify_ok.php";
} else {
	head();
	$title="회원 비밀번호를 다시한번 입력하여 주십시요.";
	$input_password="<input type=password name=password size=20 maxlength=20 class=input>";
	$target=$ssl_url."member_modify.php";
	if(preg_match("/:\/\//i",$dir)||preg_match("/\.\./i",$dir)) $dir="./";
?>

<script src="script/get_url.php" type="text/javascript"></script>
<script>
 function check_submit()
 {
  if(!member_secret.password.value) { alert("패스워드를 입력하세요"); member_secret.password.focus(); return false; }

  var f = document.forms["member_secret"];
  // 보안접속을 체크했을 때의 액션
  if ( f.SSL_Login.checked ) {
	f.action = sslUrl()+"member_modify.php";
  } else {
	f.action = zbUrl()+"member_modify.php";
  }

  return true;
 }

 function check_SSL_Login() {
  if (document.member_secret.SSL_Login.checked==true) {
   alert("SSL 암호화 보안접속을 설정합니다");
  } else {
   alert("SSL 암호화 보안접속을 해제합니다");
  }
 }

</script>

<br><br><br>
<form method=post name=member_secret action=<?=$target?> onsubmit="return check_submit();">
<input type=hidden name=id value=<?=$id?>>
<table border=0 width=300 cellspacing=1 cellpadding=0 align=center>
<tr class=title>
	<td align=center class=title_han><b><?=$title?></b></td>
</tr>
<tr height=60>
	<td align=center class=list0>
		<font class=list_eng><b>Password</b> :</font><?=$input_password?> <input type=checkbox name=SSL_Login value=1 checked onclick=check_SSL_Login() title="보안접속 설정/해제">
	</td>
</tr>
<tr class=list0 height=30>
	<td align=center>
		<input type=submit class=submit value=" 확  인 " border=0 accesskey="s">
	</td>
</tr>
</table>
</form>

<?

	foot();
	exit();
}

$member[name] = stripslashes($member[name]);
$member[job] = stripslashes($member[job]);
$member[email] = stripslashes($member[email]);
// email IP 표식 불러와 처리
unset($c_match);
if(preg_match("#\|\|\|([0-9.]{1,})$#",$member[email],$c_match)) {
	//$tokenID = $c_match[1];
	$member[email] = str_replace($c_match[0],"",$member[email]);
}
$member[homepage] = stripslashes($member[homepage]);
$member[birth] = stripslashes($member[birth]);
$member[hobby] = stripslashes($member[hobby]);
$member[icq] = stripslashes($member[icq]);
$member[aol] = stripslashes($member[aol]);
$member[msn] = stripslashes($member[msn]);
$member[home_address] = stripslashes($member[home_address]);
$member[home_tel] = stripslashes($member[home_tel]);
$member[office_address] = stripslashes($member[office_address]);
$member[office_tel] = stripslashes($member[office_tel]);
$member[handphone] = stripslashes($member[handphone]);
$member[comment] = stripslashes($member[comment]);

// 그룹데이타 읽어오기;;
$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no='$member[group_no]'"));
$group=$group_data;
$group_no=$group[no];

$check[1]="checked";

$referer=$HTTP_REFERER;

$setup[header]="";
$setup[footer]="";
$setup[header_url]="";
$setup[footer_url]="";
$group[header]="";
$group[footer]="";
$group[header_url]="";
$group[footer_url]="";
$setup[skinname]="";

head();

?>

<script src="script/get_url.php" type="text/javascript"></script>
<script>
 function jusoCallBack(roadFullAddr,zipNo,num)
 {
  if(num == 1) {
   var home_address = document.forms['write'].home_address;
  } else {
   var home_address = document.forms['write'].office_address;
  }
  home_address.value = zipNo+" " +roadFullAddr;
  home_address.focus();
 }
 function address_popup(num)
 {
  //window.open('zipcode/search_zipcode.php?num='+num,'searchaddress','width=440,height=230,scrollbars=yes');
  var pop = window.open("zipcode/jusoPopup.php?num="+num,"pop","width=570,height=420, scrollbars=yes, resizable=yes");
 }
 function check_submit()
 {
  if(write.password.value!=write.password1.value) {alert("패스워드가 일치하지 않습니다.");write.password.value="";write.password1.value=""; write.password.focus(); return false;}
  if(!write.name.value) { alert("이름을 입력하세요"); write.name.focus(); return false; }

<? if($group_data[use_birth]) { ?>

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

  var f = document.forms["write"];
  // 보안접속을 체크했을 때의 액션
  if ( f.SSL_Login.checked ) {
	f.action = sslUrl()+"member_modify_ok.php";
  } else {
	f.action = zbUrl()+"member_modify_ok.php";
  }

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
<div align=center><br>
<table border=0 cellspacing=1 cellpadding=0 width=540>
<form name=write method=post action=<?=$target2?> enctype=multipart/form-data onsubmit="return check_submit();">
<input type=hidden name=one_page value="<?=$HTTP_REFERER?>">
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
<input type=hidden name=referer value="<?=$referer?>">

<tr>
  <td colspan=2><img src=images/member_modify.gif></td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="3"></td>
</tr>
<tr height=28 align=right>
  <td width=28% style=font-family:Tahoma;font-size:9pt;><b>ID&nbsp;</td>
  <td align=left>&nbsp;<?=$member[user_id]?> &nbsp;(<?=date("Y년 m월 d일 H시 i분",$member[reg_date])?>에 가입) <input type=checkbox name=SSL_Login value=1 checked onclick=check_SSL_Login() title="보안접속 설정/해제"></td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;><b>Password&nbsp;</td>
  <td align=left>&nbsp;<input type=password name=password size=20 maxlength=20 style=border-color:#d8b3b3 class=input> 확인 : <input type=password name=password1 size=20 maxlength=20 style=border-color:#d8b3b3 class=input></td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Level&nbsp;</td>
  <td align=left>&nbsp;<?=$member[level]?></td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;><b>Name&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=name size=20 maxlength=20 value="<?=$member[name]?>" style=border-color:#d8b3b3 class=input></td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? if($group_data[use_birth]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;><b>Birthday&nbsp;</td>
  <td align=left>
    &nbsp;<input type=text name=birth_1 size=4 maxlength=4 value="<?=date("Y",$member[birth])?>" style=border-color:#d8b3b3 class=input> 년
	&nbsp;<input type=text name=birth_2 size=2 maxlength=2 value="<?=date("m",$member[birth])?>" style=border-color:#d8b3b3 class=input> 월
	&nbsp;<input type=text name=birth_3 size=2 maxlength=2 value="<?=date("d",$member[birth])?>" style=border-color:#d8b3b3 class=input> 일
	<input type=checkbox value=1 name=open_birth <?=$check[$member[open_birth]]?>> 공개
  </td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;><b>E-mail&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=email size=40 maxlength=200 value="<?=$member[email]?>" style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_email <?=$check[$member[open_email]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Homepage&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=homepage size=40 maxlength=255 value="<?=$member[homepage]?>" style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_homepage <?=$check[$member[open_homepage]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>

<? if($group_data[use_icq]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>ICQ&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=icq size=20 maxlength=20 value="<?=$member[icq]?>" style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_icq <?=$check[$member[open_icq]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group_data[use_aol]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>AIM&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=aol size=20 maxlength=30 value="<?=$member[aol]?>" style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_aol <?=$check[$member[open_aol]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group_data[use_msn]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>MSN&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=msn size=20 maxlength=250 value="<?=$member[msn]?>" style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_msn <?=$check[$member[open_msn]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group_data[use_hobby]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Hobby&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=hobby size=40 maxlength=40 value="<?=$member[hobby]?>" style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_hobby <?=$check[$member[open_hobby]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group_data[use_job]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Occupation(Job)&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=job size=20 maxlength=20 value="<?=$member[job]?>" style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_job <?=$check[$member[open_job]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group_data[use_home_address]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Home Address&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=home_address size=40 maxlength=255 value="<?=$member[home_address]?>" style=border-color:#d8b3b3 class=input><input type=button value='검색' class=input style=border-color:#d8b3b3 onclick=address_popup(1)><input type=checkbox value=1 name=open_home_address <?=$check[$member[open_home_address]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group_data[use_home_tel]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Home Phone&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=home_tel size=20 maxlength=20 value="<?=$member[home_tel]?>" style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_home_tel <?=$check[$member[open_home_tel]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group_data[use_office_address]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Office Address&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=office_address size=40 maxlength=255 value="<?=$member[office_address]?>" style=border-color:#d8b3b3 class=input><input type=button value='검색' class=input style=border-color:#d8b3b3 onclick=address_popup(2)><input type=checkbox value=1 name=open_office_address <?=$check[$member[open_office_address]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group_data[use_office_tel]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Office Phone&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=office_tel size=20 maxlength=20 value="<?=$member[office_tel]?>" style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_office_tel <?=$check[$member[open_office_tel]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group_data[use_handphone]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Cellular&nbsp;</td>
  <td align=left>&nbsp;<input type=text name=handphone size=20 maxlength=20 value="<?=$member[handphone]?>" style=border-color:#d8b3b3 class=input><input type=checkbox value=1 name=open_handphone <?=$check[$member[open_handphone]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group_data[use_mailing]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;><b>Mailling List</td>
  <td align=left>&nbsp;<input type=checkbox name=mailing value=1 <?=$check[$member[mailing]]?>> 메일링 가입</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;><b>Disclose Info</td>
  <td align=left>&nbsp;<input type=checkbox name=openinfo value=1 <?=$check[$member[openinfo]]?>> 정보 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>

<? if($group_data[use_picture]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Photo</td>
  <td align=left>&nbsp;<input type=file name=picture size=34 maxlength=255 style=border-color:#d8b3b3 class=input>
    <? if($member[picture]) echo "<br>&nbsp;<img src='$member[picture]' border=0> <input type=checkbox name=del_picture value=1> 삭제"; ?>
    <input type=checkbox value=1 name=open_picture <?=$check[$member[open_picture]]?>> 공개 (480X480 이하)
  </td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<? if($group_data[use_comment]) { ?>
<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Comments</td>
  <td align=left>&nbsp;<textarea cols=40 rows=4 name=comment style=border-color:#d8b3b3 class=textarea><?=$member[comment]?></textarea><br>&nbsp;<input type=checkbox value=1 name=open_comment <?=$check[$member[open_comment]]?>> 공개</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<? } ?>

<tr height=28 align=right>
  <td style=font-family:Tahoma;font-size:9pt;>Point</td>
  <td align=left>&nbsp;<?=($member[point1]*10+$member[point2])?> 점 ( 작성글수 : <?=$member[point1]?>, 코멘트 : <?=$member[point2]?> )</td>
</tr>
<tr>
  <td colspan=2 bgcolor="#EBD9D9" align="center"><img src="images/t.gif" width="10" height="1"></td>
</tr>
<tr height=30 bgcolor=#ffffff>
  <td align=center><? if($member[no]>1) {?><a href=member_out.php?id=<?=$id?>&group_no=<?=$group_no?> onclick="return confirm('탈퇴하시겠습니까?\n\n탈퇴를 하시면 모든 정보가 DB에서 사라집니다.\n\n탈퇴후 언제라도 재 가입가능합니다\n')"><img src=images/button_out.gif border=0 alt="회원탈퇴"></a><?}?></td>
  <td align=right ><img src=images/t.gif height=5><br>
    <input type=image border=0 src=images/button_modify.gif> &nbsp;
    <img src=images/memo_close.gif border=0 onClick=window.close() style=cursor:hand>&nbsp;&nbsp;&nbsp;
  </td>
</tr>
</form>
</table>
</div>

<?
foot();
?>
