<?
	include "lib.php";
	$connect=dbConn();

	set_time_limit(0);

	function thisError($message) {
		print("<script>\nalert('$message');\nwindow.close();\n</script>\n");
		exit();
	}

	$member=member_info();
	if(!$member[no]) thisError("�α����� ����Ͽ��ֽʽÿ�");

	if($member[is_admin]>3||$member[is_admin]<1) thisError("�������������� ����Ҽ� �ִ� ������ �����ϴ�");

	if($s_comment) $comment = $s_comment;
	else $s_comment = $comment;

	if(isblank($from)) thisError("������ ���� mail�� �����ֽʽÿ�");
	if(isblank($name)) thisError("�����ô� ���� �̸��� �����ֽʽÿ�");
	if(isblank($subject)) thisError("������ �����ֽʽÿ�");
	if(isblank($comment)) thisError("������ �����ֽʽÿ�");

	// ������ �̵� �Ҷ� �������� ����
	if(!$page) $page = 1; else $page++;
	if(!$fault) $fault = 0;
	if(!$true) $true = 0;
	if(!$nomailing) $nomailing = 0;
	if(!$sendnum) $sendnum = 100;
    $group_no = (int)$group_no;
    $s_que = '';
	if(!$total_member_num) {
		$temp=mysql_fetch_array(mysql_query("select count(*) from $member_table where group_no='$group_no'",$connect));
		$total_member_num=$temp[0];
	}

	if($cart) {
		$temp = explode("||",$cart);
        for($i=0;$i<count($temp);$i++) $target_srls[] = (int)$temp[$i];
        $s_que = sprintf(' and ( no in (%s) )', "'".implode("','", $target_srls)."'");
	} else {
		// ���� ������ ������
		$s_que=stripslashes($s_que);
	}

	$startnum = ($page-1)*$sendnum;

	if(!$total_member) {
		$temp=mysql_fetch_array(mysql_query("select count(*) from $member_table where group_no='$group_no' $s_que",$connect));
		$total_member=$temp[0];
	}

	if(!$totalpage) $totalpage = (int)(($total_member-1)/$sendnum)+1;

	if($total_member==0) thisError("������ ���� ȸ���� �����ϴ�");

	$result=mysql_query("select name, email, mailing from $member_table where group_no='$group_no' $s_que order by no limit $startnum, $sendnum",$connect) or thisError(addslashes(mysql_error()));

	mysql_close($connect);  

	head( "onload=window.resizeTo(550,420); bgcolor=white");
?>

<br>
<center><b>���ϸ� �߼�</b></center><br>

<table border=0 cellpadding=4 cellspacing=1 width=100% bgcolor=white height=30>
<form action=<?=$PHP_SELF?> method=post>
<tr>
	<td>
		��ü �׷� ȸ�� �� : <?=number_format($total_member_num)?> ��<br>
		<img src=images/t.gif border=0 height=5><br>
		���ϸ� �߼� ��� ȸ�� �� : <?=number_format($total_member)?> ��<br>
		<img src=images/t.gif border=0 height=5><br>
		���� �߼� ����  : <?=$sendnum?> �� ������ �߶� �߼�<br>
		<img src=images/t.gif border=0 height=5><br>
		���� �߼� ������ : <?=$page?> / <?=$totalpage?><br>

<?
	$fault=0;
	$i=1;
	while($data=mysql_fetch_array($result)) {
		if($data[mailing]) {

			$temp=zb_sendmail($html, $data[email], $data[name], $from, $name, $subject, $comment);

			if(!$temp) $fault++;
			else $true ++;

			echo ".";

		} else {

			$nomailing ++;

		}

		flush();

	}
?>

		<img src=images/t.gif border=0 height=5><br>
		���� �߼� ��� : <?=$true?>�� �߼� ���� (<?=$nomailing?>���� ���ϸ� ���� �ź�)<br>
		<img src=images/t.gif border=0 height=5><br>
		<font color=white>���� �߼� ��� : </font><?=$fault?>�� �߼� ����<br>
		<img src=images/t.gif border=0 height=5><br>
		<center>
<?
	if($page==$totalpage) {
?>
		<input type=button value="���ϸ� �߼� �Ϸ��Ͽ����ϴ�" onclick=window.close() class=submit style=width:100%>
<?
	} else {
?>
		<input type=submit value="���� <?=$sendnum?>�� ���� ���� �߼�" class=submit style=width:100%>
<?
	}
?>
		</center>
		<textarea name="s_comment" cols=1 rows=1 style=width:1px;height:1px><?=stripslashes($s_comment)?></textarea>
	</td>
</tr>
<input type=hidden name="from" value="<?=$from?>">
<input type=hidden name="name" value="<?=$name?>">
<input type=hidden name="subject" value="<?=$subject?>">
<input type=hidden name="page" value="<?=$page?>">
<input type=hidden name="totalpage" value="<?=$totalpage?>">
<input type=hidden name="total_member_num" value="<?=$total_member_num?>">
<input type=hidden name="total_member" value="<?=$total_member?>">
<input type=hidden name="sendnum" value="<?=$sendnum?>">
<input type=hidden name="fault" value="<?=$fault?>">
<input type=hidden name="true" value="<?=$true?>">
<input type=hidden name="cart" value="<?=$cart?>">
<input type=hidden name="html" value="<?=$html?>">
<input type=hidden name="nomailing" value="<?=$nomailing?>">
<input type=hidden name="s_que" value="<?=$s_que?>">
<input type=hidden name="group_no" value="<?=$group_no?>">
</form>
</table>
<?
	foot();
?>
