<?
/***************************************************************************
* 공통 파일 include
**************************************************************************/
include "_head.php";

if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)) Error("정상적으로 글을 수정하여 주시기 바랍니다.");

//랜덤한 두 숫자를 발생(1-1000) 후 변수에 대입
$num1 = mt_rand(1,1000);
$num2 = mt_rand(1,1000);
$num1num2 = $num1*10000 + $num2;
//코멘트 보안을 위해 세션변수를 설정
$ZBRD_SS_VRS = $num1num2;
session_register("ZBRD_SS_VRS");

/***************************************************************************
* 코멘트 수정 페이지 처리
**************************************************************************/

// 원본글을 가져옴
$s_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where no='$c_no'"));

if($s_data[ismember]||$is_admin||$member[level]<=$setup[grant_delete]) {
	if(!$is_admin&&$s_data[ismember]!=$member[no]) Error("수정할 권한이 없습니다");
	$title="글을 수정하시겠습니까?";
} else {
	$title="글을 수정합니다.<br>비밀번호를 입력하여 주십시요";
	$input_password="<input type=password name=password size=20 class=input>";
}

$target="comment_modify_ok.php";

$a_list="<a href=zboard.php?$href$sort>";

$a_view="<a href=view.php?$href$sort&no=$no>";

head();
?>
<br><br><br>
<form method=post name=delete action=<?=$target?>>
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
<input type=hidden name=c_no value=<?=$c_no?>>
<input type=hidden name=antispam value=<?=$num1num2?>>
<table border=0 width=250 cellspacing=1 cellpadding=0>
<tr class=title>
	<td align=center style="color:black"><b><?=$title?></b></td>
</tr>
<?
if(!$member[no]) {
?>
<tr height=60>
	<td align=center class=list0>
		<font class=list_eng><b>Password</b> :</font><?=$input_password?> 
	</td>
</tr>
<?
}
?>
<tr class=list0 height=30>
	<td align=center>
		<input type=submit class=submit value=" 확  인 " border=0 accesskey="s">
		<input type=button class=button value="이전화면" onclick=history.back()>
	</td>
</tr>
</table>
</form>
<?
foot();

include "_foot.php";
?>