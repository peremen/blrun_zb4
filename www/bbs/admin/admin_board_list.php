<?
	// ���� �׷��� ����Ÿ�� ����
	$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));

	// ���ó�¥ ����
	$today_date=mktime(0,0,0,date("m"),date("d"),date("Y"));

	// �Խ��� �������� ��� �Խ����� ����
	if($member[is_admin]>=3 && $member[board_name]) {
		$boardList = explode(",",$member[board_name]);
		$s_que = "";
		for($i=0;$i<count($boardList);$i++) {
			if(trim($boardList[$i])) {
				if($s_que) $s_que .= " or no = ".$boardList[$i]." ";
				else $s_que .= " no = ".$boardList[$i]." ";
			}
		}
	// �׷�������� ��� �׷� �Խ��Ǹ� �����ֱ�
	} else {
		$s_que = " group_no = '$group_no' ";
	}

	// ��ü ������ ���ؿ�
	$temp=mysql_fetch_array(mysql_query("select count(*) from $admin_table where $s_que"));
	$total=$temp[0];

	// ������ ���ϴ� �κ�
	if($page_num==0)$page_num=10;
	if(!$page) $page=1;
	$start_num=($page-1)*$page_num;
	$total_page=(int)(($total-1)/$page_num)+1;

	// �Խù��� ���ؿ�
	$result=@mysql_query("select * from $admin_table where $s_que order by no desc limit $start_num,$page_num",$connect) 
	or Error("�Խ����� ������ DB�� ���� �������� �κп��� ������ �߻��߽��ϴ�");
?>
<script>
function board_recover(a,b)
{
 c = confirm(b + " �Խ����� �����Ͻðڽ��ϱ�?")
 if(c==true)
 {
	window.open("admin/recover.php?no="+a,"recover","width=300,height=100,toolbars=no,resizable=no,scrollbars=no")
 }
}
</script>
<table border=0 cellspacing=1 cellpadding=3 width=100% bgcolor=#b0b0b0>
  <tr height=30><td bgcolor=#3d3d3d colspan=9><img src=images/admin_webboard.gif></td></tr>
  <tr height=1><td bgcolor=#000000 style=padding:0px; colspan=9><img src=images/t.gif height=1></td></tr>
<?
// �տ� �ٴ� �����ȣ
$number=$total-($page-1)*$page_num;

echo"
     <tr align=center height=23 bgcolor=#a0a0a0>
       <td style=font-family:Tahoma;font-size:8pt;><b>��ȣ</td>
       <td style=font-family:Tahoma;font-size:8pt;><b>�Խ��� �̸�</td>
       <td style=font-family:Tahoma;font-size:8pt;><b>��ü��� ��</td>
       <td style=font-family:Tahoma;font-size:8pt;><b>�̸�����</td>
       <td style=font-family:Tahoma;font-size:8pt;><b>�⺻���� ����</td>
       <td style=font-family:Tahoma;font-size:8pt;><b>���� ����</td>
       <td style=font-family:Tahoma;font-size:8pt;><b>ī�װ� ����</a></td>
       <td style=font-family:Tahoma;font-size:8pt;><b>��������</a></td>
       <td style=font-family:Tahoma;font-size:8pt;><b>����</a></td>
     </tr>";

// �̾ƿ� �Խù� ����Ÿ�� ȭ�鿡 ���
while($data=mysql_fetch_array($result))
{
 echo"
     <tr align=center height=23 bgcolor=#e0e0e0>
       <td style=font-family:Tahoma;font-size:7pt;>$number</td>
       <td style=font-family:Tahoma;font-size:8pt;><b>$data[name]</b></td>
       <td style=font-family:Tahoma;font-size:8pt;>$data[total_article]</td>
       <td style=font-family:Tahoma;font-size:8pt;><a href=zboard.php?id=$data[name] target=_blank>View</a></td>
       <td style=font-family:Tahoma;font-size:8pt;><a href=$PHP_SELF?exec=view_board&group_no=$group_no&exec2=modify&no=$data[no]&page=$page&page_num=$page_num>Setup</a></td>
       <td style=font-family:Tahoma;font-size:8pt;><a href=$PHP_SELF?exec=view_board&group_no=$group_no&exec2=grant&no=$data[no]&page=$page&page_num=$page_num>Setup</a></td>
       <td style=font-family:Tahoma;font-size:8pt;><a href=$PHP_SELF?exec=view_board&group_no=$group_no&exec2=category&no=$data[no]&page=$page&page_num=$page_num>Setup</a></td>
       <td style=font-family:Tahoma;font-size:8pt;><a href=\"javascript:board_recover('$data[no]','$data[name]')\">����</a></td>
       <td style=font-family:Tahoma;font-size:8pt;><a href=$PHP_SELF?exec=view_board&group_no=$group_no&exec2=del&no=$data[no]&page=$page&page_num=$page_num onclick=\"return confirm('$data[name] �Խ����� \\n\\n�����Ͻðڽ��ϱ�?')\">����</a></td>
     </tr>";
 // ���� ��ȣ�� 1�� ��
 $number--;
}

?>
</tr>
</table>
<div align=right>
<!-- ���� �˻��κ� -->
<table border=0 cellspacing=0 cellpadding=3>
<form method=post action=<?=$PHP_SELF?> name=search>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=exec value=<?=$exec?>>
<input type=hidden name=group_no value=<?=$group_no?>>
<Tr>
  <td><input type=text name=page_num value=<?=$page_num?> size=2></td>
  <td><input type=submit value='�������� ����' style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px;>&nbsp;&nbsp;</td>
  <td><input type=button onclick=location.href="<?=$PHP_SELF?>?exec=view_board&exec2=add&page=<?=$page?>&page_num=<?=$page_num?>&group_no=<?=$group_no?>" style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px; value=' �Խ��� �߰��ϱ� '></td>
</tr>
</form>
</table>

</div><div align=center><br><?
//������ ��Ÿ���� �κ�
$show_page_num=10;
$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
$i=1;
if($page>$show_page_num){$prev_page=$start_page-1;echo"<a href=$PHP_SELF?page=$prev_page&exec=view_board&page_num=$page_num&group_no=$group_no>[����������]</a>";}
while($i+$start_page<=$total_page&&$i<=$show_page_num)
{
 $move_page=$i+$start_page;
 if($page==$move_page)echo"<b>$move_page</b>";
 else echo"<a href=$PHP_SELF?page=$move_page&exec=view_board&page_num=$page_num&group_no=$group_no>[$move_page]</a>";
 $i++;
}
if($total_page>$move_page){$next_page=$move_page+1;echo"<a href=$PHP_SELF?page=$next_page&exec=view_board&page_num=$page_num&group_no=$group_no>[����������]</a>";}
//������ ��Ÿ���� �κ� ��
?>
</div>