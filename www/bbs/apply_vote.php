<?
/***************************************************************************
* �������� include
**************************************************************************/
include "_head.php";

// ������ üũ
if($setup[grant_view]<$member[level]&&!$is_admin) Error("�������� �����ϴ�","login.php?id=$id&page=$page&page_num=$page_num&category=$category&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&file=zboard.php");

// �������
if(!get_magic_quotes_gpc()) {
	$no = addslashes($no);
	$sub_no = addslashes($sub_no);
}

// ��ȸ�� ��ŷ ����
$result=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$sub_no'",$connect));
$prev_no1=$result[prev_no]; //�����׸��� ��� ��ǥ �ѹ�
$next_no1=$result[next_no]; //���� �׸��� �ϴ� ��ǥ �ѹ�
$result=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$next_no1'",$connect));
$prev_no2=$result[prev_no]; //�ϴ� ��ǥ �ѹ��� ��� ��ǥ �ѹ�
$result=mysql_fetch_array(mysql_query("select * from $t_board"."_$id where no='$prev_no1'",$connect));
$next_no2=$result[next_no]; //��� ��ǥ �ѹ��� �ϴ� ��ǥ �ѹ�

// ���� �ֱ� ��ǥ�� �� �Ʒ� ��ǥ�� �Ʒ��� ���� ������ if�� ���� $next_no2,$prev_no2 ġȯ
if($prev_no1==0) $next_no2=$prev_no2;
else if($next_no1==0) $prev_no2=$next_no2;

// ���� �����ǰ� �ִ��� �˻�
$data = mysql_fetch_array(mysql_query("select memo from $t_board"."_$id where no='$no'",$connect));
$ip_array = explode("|||",$data[memo]);
$rows = 1;
for($i=1;$i<count($ip_array);$i++)
	if((preg_match("#".$REMOTE_ADDR."#",$ip_array[$i])) || ($member[user_id] && preg_match("#".$member[user_id]."#",$ip_array[$i]))) $rows = 0; //�����ϸ� �÷��� 0���� ����

if($rows) {
	// ������� Vote�� �ø�;;
	if(!preg_match("/".$setup[no]."_".$no."/i",  $HTTP_SESSION_VARS[zb_vote])&&$no==$prev_no2&&$no==$next_no2) {
		// ������ ���̺� ����
		unset($data);
		$data = mysql_fetch_array(mysql_query("select memo from $t_board"."_$id where no='$no'",$connect));
		$memo = $data[memo]."|||".$REMOTE_ADDR;
		if($member[user_id]) $memo .= "|||".$member[user_id];

		mysql_query("update $t_board"."_$id set vote=vote+1 where no='$sub_no'",$connect);
		mysql_query("update $t_board"."_$id set memo='$memo',vote=vote+1 where no='$no'",$connect);

		// 4.0x �� ���� ó��
		$zb_vote = $HTTP_SESSION_VARS[zb_vote] . "," . $setup[no]."_".$no;
		session_register("zb_vote");

		// ���� ���� ó�� (4.0x�� ���� ó���� ���Ͽ� �ּ� ó��)
		//$HTTP_SESSION_VARS[zb_vote] = $HTTP_SESSION_VARS[zb_vote] . "," . $setup[no]."_".$no;
	} else Error("�̹� ��ǥ�ϼ̽��ϴ�.");
} else Error("�̹� ��ǥ�ϼ̽��ϴ�..");

@mysql_close($connect);

// ������ �̵�
if($setup[use_alllist]) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no");
else  movepage("view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no");
?>