<?
/***************************************************************************
* �������� include
**************************************************************************/
include "_head.php";

// ������ üũ
if($setup[grant_view]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");

// �������
$no=stripslashes($no);
$sub_no=stripslashes($sub_no);
$no=addslashes($no);
$sub_no=addslashes($sub_no);

// ��ȸ�� ��ŷ ����
$result=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$sub_no'"));
$prev_no1=$result[prev_no]; //�����׸��� ��� ��ǥ �ѹ�
$next_no1=$result[next_no]; //���� �׸��� �ϴ� ��ǥ �ѹ�
$result=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$next_no1'"));
$prev_no2=$result[prev_no]; //�ϴ� ��ǥ �ѹ��� ��� ��ǥ �ѹ�
$result=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$prev_no1'"));
$next_no2=$result[next_no]; //��� ��ǥ �ѹ��� �ϴ� ��ǥ �ѹ�

// ���� �ֱ� ��ǥ�� �� �Ʒ� ��ǥ�� �Ʒ��� ���� ������ if�� ���� $next_no2,$prev_no2 ġȯ
if($prev_no1==0) $next_no2=$prev_no2;
else if($next_no1==0) $prev_no2=$next_no2;

// ������� Vote�� �ø�;;
if(!preg_match("/".$setup[no]."_".$no."/i",  $HTTP_SESSION_VARS[zb_vote])&&$no==$prev_no2&&$no==$next_no2) {
	mysql_query("update $t_board"."_$id set vote=vote+1 where no='$sub_no'");
	mysql_query("update $t_board"."_$id set vote=vote+1 where no='$no'");

	// 4.0x �� ���� ó��
	$zb_vote = $HTTP_SESSION_VARS[zb_vote] . "," . $setup[no]."_".$no;
	session_register("zb_vote");

	// ���� ���� ó�� (4.0x�� ���� ó���� ���Ͽ� �ּ� ó��)
	//$HTTP_SESSION_VARS[zb_vote] = $HTTP_SESSION_VARS[zb_vote] . "," . $setup[no]."_".$no;
}

@mysql_close($connect);

// ������ �̵�
if($setup[use_alllist]) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no");
else  movepage("view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no");
?>