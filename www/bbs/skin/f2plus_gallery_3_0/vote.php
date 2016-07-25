<?
@extract($HTTP_GET_VARS); 
@extract($HTTP_POST_VARS); 
/***************************************************************************
* 공통파일 include
**************************************************************************/
include $_zb_path."_head.php";

function error1($message, $url="") {
	global $setup, $connect, $dir, $_zb_path, $_zb_url;

	$dir=$_zb_url."skin/".$setup[skinname];
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
	exit;
}

/***************************************************************************
 * 설정 체크
 **************************************************************************/
// 현재글의 Vote수 올림;;
$table="zetyx_board_comment_".$id."_movie";
$t_c=mysql_fetch_array(mysql_query("select * from $table where no='$c_no'"));
$vote_man=$t_c[who];
$whois=explode("!*)",$vote_man);
for($i=0;$i<=sizeof($whois)-1;$i++){
	if($who==$whois[$i]){ 
		error1("이미 투표를 하셨네요");
	}
}
if(!$vote_man) $vote_man=$who;
else $vote_man=$vote_man."!*)".$who;
mysql_query("update $table set vote=vote+1, who='$vote_man' where no='$c_no'");

// 페이지 이동
//if($setup[use_alllist]) $temp_href="zboard.php"; else $temp_href="view.php";
movepage($_url."?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&category=$category");
?>