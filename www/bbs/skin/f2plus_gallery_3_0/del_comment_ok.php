<?
@extract($HTTP_GET_VARS); 
@extract($HTTP_POST_VARS);

/***************************************************************************
 * ���� ���� include
**************************************************************************/
include $_zb_path."_head.php";

if(file_exists($id."_config.php")){ 
	include $id."_config.php";
}

if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� ���� �����Ͽ� �ֽñ� �ٶ��ϴ�.");

/***************************************************************************
* �ڸ�Ʈ ���� ����
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

// �н����� addslashes
if(!get_magic_quotes_gpc()) {
	$password = addslashes($password);
}

// �н����带 ��ȣȭ
if($password) {
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];   
}

// �������� ������
$s_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where no='$c_no'"));

// ȸ���϶��� Ȯ��;;
if(!$is_admin&&$member[level]>$setup[grant_delete]) {
	if(!$s_data[ismember]) {
		if($s_data[password]!=$password) Error1("��й�ȣ�� �ùٸ��� �ʽ��ϴ�");
	} else {
		if($s_data[ismember]!=$member[no]) Error1("��й�ȣ�� �Է��Ͽ� �ֽʽÿ�");
	}
}

// �ڸ�Ʈ ����
mysql_query("delete from $t_comment"."_$id where no='$c_no'") or Error1(mysql_error());
if($type=="Movie_type"||$type=="Sell_type") mysql_query("delete from $t_comment"."_$id"."_movie where parent='$no' and reg_date='$s_data[reg_date]'") or Error1(mysql_error());

// ���ϻ���
@z_unlink($_zb_path."/".$s_data[file_name1]);
@z_unlink($_zb_path."/".$s_data[file_name2]);
// �� ���� ���� ����
if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name1],$out))
	if(is_dir($_zb_path."/data/".$out[1]."/".$out[2])) @rmdir($_zb_path."/data/".$out[1]."/".$out[2]);
if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name2],$out))
	if(is_dir($_zb_path."/data/".$out[1]."/".$out[2])) @rmdir($_zb_path."/data/".$out[1]."/".$out[2]);

// �ڸ�Ʈ ���� ����
$total=mysql_fetch_array(mysql_query("select count(*) from $t_comment"."_$id where parent='$no'"));
mysql_query("update $t_board"."_$id set total_comment='$total[0]' where no='$no'")  or Error1(mysql_error()); 

// ȸ���� ��� �ش� �ؿ��� ���� �ֱ�
if($member[no]==$s_data[ismember]) @mysql_query("update $member_table set point2=point2-1 where no='$member[no]'",$connect) or Error1(mysql_error());

@mysql_close($connect);

// ������ �̵�
if($setup[use_alllist])
	movepage($zb_url."/zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category");
else
	movepage($zb_url."/view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$desc&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no&category=$category");
?>