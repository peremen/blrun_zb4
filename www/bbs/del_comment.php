<?
/***************************************************************************
* ���� ���� include
**************************************************************************/
include "_head.php";

if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)) Error("���������� ���� �����Ͽ� �ֽñ� �ٶ��ϴ�.");

/***************************************************************************
* �ڸ�Ʈ ���� ������ ó��
**************************************************************************/

// �������� ������
$s_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where no='$c_no'"));

if($s_data[ismember]||$is_admin||$member[level]<=$setup[grant_delete]) {
	if(!$is_admin&&$s_data[ismember]!=$member[no]) Error("������ ������ �����ϴ�");
	$title="���� �����Ͻðڽ��ϱ�?";
} else {
	$title="���� �����մϴ�.<br>��й�ȣ�� �Է��Ͽ� �ֽʽÿ�";
	$input_password="<input type=password name=password size=20 class=input>";
}

$target="del_comment_ok.php";

$a_list="<a href=zboard.php?$href$sort>";

$a_view="<a href=view.php?$href$sort&no=$no>";

head();

include $dir."/ask_password.php";

foot();

include "_foot.php";
?>