<?
/***************************************************************************
 * �������� include
 **************************************************************************/
	include "_head.php";


/***************************************************************************
 * ���� üũ
 **************************************************************************/

// ������ üũ
	if($setup[grant_view]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");

// �������
	$no=stripslashes($no);
	$no=addslashes($no);

// ������� Vote�� �ø�;;
	if(!preg_match("/".$setup[no]."_".$no."/",$HTTP_SESSION_VARS["zb_vote"])) {
		mysql_query("update $t_board"."_$id set vote=vote+1 where no='$no'");
		$vote_str =  "," . $setup[no]."_".$no;

		// ���� ���� ó�� (4.0x�� ���� ó���� ���Ͽ� �ּ� ó��)	
		//$HTTP_SESSION_VARS["zb_vote"] = $HTTP_SESSION_VARS["zb_vote"] . $vote_str;

		// 4.0x �� ���� ó��
		$zb_vote = $HTTP_SESSION_VARS["zb_vote"] . $vote_str;
		session_register("zb_vote");
	}

// MySQL �ݱ� 

	if($connect) mysql_close($connect);

// ������ �̵�
	if($setup[use_alllist]) $temp_href="zboard.php"; else $temp_href="view.php";
	movepage("$temp_href?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no"); 
?>
