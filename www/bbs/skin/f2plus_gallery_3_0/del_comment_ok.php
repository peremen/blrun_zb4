<?
@extract($HTTP_GET_VARS); 
@extract($HTTP_POST_VARS);

/***************************************************************************
 * 공통 파일 include
**************************************************************************/
include $_zb_path."_head.php";

if(file_exists($id."_config.php")){ 
	include $id."_config.php";
}

if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 글을 삭제하여 주시기 바랍니다.");

/***************************************************************************
* 코멘트 삭제 진행
**************************************************************************/

function Error1($message, $url="") {
	global $setup, $connect, $dir, $_zb_path, $_zb_url;

	$message=str_replace("<br>","\\n",$message);
	$message=str_replace("\"","\\\"",$message);
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script>
<!--
alert("<?=$message?>");
history.back();
//-->
</script>
<?
	if($connect) @mysql_close($connect);
	exit;
}

// 패스워드 addslashes
if(!get_magic_quotes_gpc()) {
	$password = addslashes($password);
}

// 패스워드를 암호화
if($password) {
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];   
}

// 원본글을 가져옴
$s_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where no='$c_no'"));

// 회원일때를 확인;;
if(!$is_admin&&$member[level]>$setup[grant_delete]) {
	if(!$s_data[ismember]) {
		if($s_data[password]!=$password) Error1("비밀번호가 올바르지 않습니다");
	} else {
		if($s_data[ismember]!=$member[no]) Error1("비밀번호를 입력하여 주십시요");
	}
}

// 코멘트 삭제
mysql_query("delete from $t_comment"."_$id where no='$c_no'") or Error1(mysql_error());
if($type=="Movie_type"||$type=="Sell_type") mysql_query("delete from $t_comment"."_$id"."_movie where parent='$no' and reg_date='$s_data[reg_date]'") or Error1(mysql_error());

// 파일삭제
@z_unlink($_zb_path."/".$s_data[file_name1]);
@z_unlink($_zb_path."/".$s_data[file_name2]);
// 빈 파일 폴더 삭제
if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name1],$out))
	if(is_dir($_zb_path."/data/".$out[1]."/".$out[2])) @rmdir($_zb_path."/data/".$out[1]."/".$out[2]);
if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name2],$out))
	if(is_dir($_zb_path."/data/".$out[1]."/".$out[2])) @rmdir($_zb_path."/data/".$out[1]."/".$out[2]);

// 코멘트 갯수 정리
$total=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where parent='$no'"));
mysql_query("update $t_board"."_$id set total_comment='$total[0]' where no='$no'")  or Error1(mysql_error()); 

// 회원일 경우 해당 해원의 점수 주기
if($member[no]==$s_data[ismember]) @mysql_query("update $member_table set point2=point2-1 where no='$member[no]'",$connect) or Error1(mysql_error());

@mysql_close($connect);

// 페이지 이동
if($setup[use_alllist])
	movepage($zb_url."/zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category");
else
	movepage($zb_url."/view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category");
?>