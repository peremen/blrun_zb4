<?
@extract($HTTP_GET_VARS); 
@extract($HTTP_POST_VARS); 
/***************************************************************************
* �������� include
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
 * ���� üũ
 **************************************************************************/
// ������� Vote�� �ø�;;
$table="zetyx_board_comment_".$id."_movie";
$t_c=mysql_fetch_array(mysql_query("select * from $table where no='$c_no'"));
$vote_man=$t_c[who];
$whois=explode("!*)",$vote_man);
for($i=0;$i<=sizeof($whois)-1;$i++){
	if($who==$whois[$i]){ 
		error1("�̹� ��ǥ�� �ϼ̳׿�");
	}
}
if(!$vote_man) $vote_man=$who;
else $vote_man=$vote_man."!*)".$who;
mysql_query("update $table set vote=vote+1, who='$vote_man' where no='$c_no'");

// ������ �̵�
//if($setup[use_alllist]) $temp_href="zboard.php"; else $temp_href="view.php";
movepage($_url."?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&keyword=$keyword&no=$no&category=$category");
?>