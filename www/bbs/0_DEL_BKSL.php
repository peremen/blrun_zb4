<?
/* ���� ���� ����(1.2.7.4897 ����)���� �ȳ��� �帰��� �齽������ DB���� �ѹ� ��� ���̺��� �����Ͻ� �е���
�� ��ũ��Ʈ�� �����Ͻø� �ȵ˴ϴ�. �齽������ �ѹ� ������ ������ HTML�� �ٸ��� ǥ�õǹǷ� �����ؾ� �մϴ�. ��
��ũ��Ʈ�� ���κ���4.1pl8 ������ ��ġ �� �ѹ��� "���¼ҽ� �Խ��� ����������" �� ��ġ���� �ʾҴ� �е��� ���� ��
�̸� �� �����������̶�� �ϴ��� 1.2.6.110 ���� ���� ���� ���� ��ġ�ڵ��� �ش������ ������ 1.2.7.XXXX ����
���� �������� �����ϱ� ���� ��ũ��Ʈ�Դϴ�. �� �����Ͻñ� �ٶ��ϴ�. ^^; */

$_zb_path="./";
include "lib.php";
if(!$connect) $connect=dbConn();
$member=member_info();
if(!($member[no]&&$member[is_admin]==1&&$member[level]==1)) Error("����1�� �ְ� �����ڸ��� ����Ҽ� �ֽ��ϴ�");
// ���� �˻��κ�
$table_name_result=mysql_query("select name from $admin_table order by name",$connect) or error(mysql_error());

head(" bgcolor=white");
?>
<div align=center>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=98%>
<tr>
  <td><img src=images/trace_left.gif border=0></td>
  <td width=100% background=images/trace_back.gif><img src=images/trace_back.gif border=0></td>
  <td><img src=images/trace_right.gif border=0></td>
</tr>
</table>
</div>

<?
$hop=0;
while($table_data=mysql_fetch_array($table_name_result))
{
	$table_name=$table_data[name];
	$cnt1=0;

	#\' �� ' �� ġȯ
	mysql_query("UPDATE $t_board"."_$table_name SET subject=REPLACE(subject,\"\\\\'\",\"\\'\") where subject like \"%\\\\'%\"", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();
	mysql_query("UPDATE $t_board"."_$table_name SET memo=REPLACE(memo,\"\\\\'\",\"\\'\") where memo like \"%\\\\'%\"", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();

	#\" �� " �� ġȯ
	mysql_query("UPDATE $t_board"."_$table_name SET subject=REPLACE(subject,'\\\\\"','\\\"') where subject like '%\\\\\"%'", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();
	mysql_query("UPDATE $t_board"."_$table_name SET memo=REPLACE(memo,'\\\\\"','\\\"') where memo like '%\\\\\"%'", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();

	#\\ �� \ �� ġȯ
	mysql_query("UPDATE $t_board"."_$table_name SET subject=REPLACE(subject,'\\\\\\\\','\\\\') where subject like '%\\\\\\\\%'", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();
	mysql_query("UPDATE $t_board"."_$table_name SET memo=REPLACE(memo,'\\\\\\\\','\\\\') where memo like '%\\\\\\\\%'", $connect) or error(mysql_error());
	$cnt1 += mysql_affected_rows();
?>

<br><br><br>
&nbsp;&nbsp;<font size=4 style=font-family:tahoma; color=black><?=$table_name?>&nbsp;<b>�Խ���</b> <?=$cnt1?>�� �齽���� ���� ����!</font><br>
<br><img src=images/t.gif border=0 height=5><Br>
<?
	$cnt2=0;

	#\' �� ' �� ġȯ
	mysql_query("UPDATE $t_comment"."_$table_name SET memo=REPLACE(memo,\"\\\\'\",\"\\'\") where memo like \"%\\\\'%\"", $connect) or error(mysql_error());
	$cnt2 += mysql_affected_rows();

	#\" �� " �� ġȯ
	mysql_query("UPDATE $t_comment"."_$table_name SET memo=REPLACE(memo,'\\\\\"','\\\"') where memo like '%\\\\\"%'", $connect) or error(mysql_error());
	$cnt2 += mysql_affected_rows();

	#\\ �� \ �� ġȯ
	mysql_query("UPDATE $t_comment"."_$table_name SET memo=REPLACE(memo,'\\\\\\\\','\\\\') where memo like '%\\\\\\\\%'", $connect) or error(mysql_error());
	$cnt2 += mysql_affected_rows();
?>

<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<font size=3 style=font-family:tahoma;><?=$table_name?><b>�Խ����� ������ ���</b> <?=$cnt2?>�� �齽���� ���� ����!</font><br>
<img src=images/t.gif border=0 height=20><Br>

<?

	// ����� ���ڵ� �� ī��Ʈ
	$hop += $cnt1+$cnt2;
	$cnt1=0; $cnt2=0;
}

echo "��� �Խ���/���� ���̺��� ��� {$hop}�� �齽���� ���Ÿ� �Ͽ����ϴ�.";
?>
<br><br><br>
<script>
alert("��� �Խ���/���� ���̺��� ��� "+<?=$hop?>+"�� �齽���� ���Ÿ� �Ͽ����ϴ�.");
</script>
<?
foot();
?>