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
if(!get_magic_quotes_gpc()) {
	$no = addslashes($no);
}

$result=@mysql_query("select * from $t_board"."_$id where no='$no'") or error(mysql_error());
$data=mysql_fetch_array($result);
$ip_array = explode("|||",$data[memo]);

// ������� Vote�� �ø�;;
if($setup[skinname]!="zero_vote") {
	if(substr($ip_array[0],0,9)=="��������|") Error("�������� ��ǥ�� ���� �����̽��ϴ�.");
	if(!preg_match("/".$setup[no]."_".$no."/",$_SESSION['zb_vote'])) {
		mysql_query("update $t_board"."_$id set vote=vote+1 where no='$no'");
		$vote_str =  ",".$setup[no]."_".$no;

		// 5.3 �̻�� ���� ó��
		$_SESSION['zb_vote'] = $_SESSION['zb_vote'].$vote_str;
	}
} else Error("�������� ��ǥ�� ���� �����̽��ϴ�..");

// ������ �̵�
if($setup[use_alllist]) $temp_href="zboard.php"; else $temp_href="view.php";
movepage("$temp_href?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no");
?>