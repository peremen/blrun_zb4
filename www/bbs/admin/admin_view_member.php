<?
/**************************************************************************
 * ȸ�� ��� ���� ������
 *************************************************************************/

// ��ü �׷���� ���� �׷��� ������ ����
	$tmpResult = mysql_fetch_array(mysql_query("select count(*) from $group_table"));
	$total_group_num = $tmpResult[0];
	$group_data = mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));

	$temp=mysql_fetch_array(mysql_query("select count(*) from $member_table where group_no='$group_no'"));
	$total_member=$temp[0];

// �˻�� ���ؼ� ó��
	$s_que="";
	$href="&keykind=$keykind&like=$like";

	if($total_group_num>1) $s_que = " where group_no = '$group_no' ";
	
	if($level_search>0) {
		if($s_que) $s_que.=" and "; else $s_que=" where ";
		$s_que.=" level='$level_search' ";
		$href.="&level_search=$level_search";
	}
	if($keyword&&$keykind) {
		if($s_que) $s_que.=" and "; else $s_que=" where ";
		if($keykind!="jumin") {
			if($like) $s_que .= " $keykind like '%".$keyword."%' ";
			else $s_que .= " $keykind = '$keyword' ";
		} else {
			$s_que .= " $keykind = password('$keyword') ";
		}
			
		$href.="&keyword=$keyword&keykind=$keykind&like=$like";
	}

	$temp=mysql_fetch_array(mysql_query("select count(*) from $member_table $s_que"));
	$total=$temp[0];
  
//������ ���ϴ� �κ�
	if(!$page_num)$page_num=10;
	$href.="&page_num=$page_num";
	if(!$page) $page=1;
	$start_num=($page-1)*$page_num;
	$total_page=(int)(($total-1)/$page_num)+1;


// ��������� ���ؿ�
	$result=@mysql_query("select * from $member_table $s_que order by no desc limit $start_num,$page_num",$connect) or Error(mysql_error(),"");

//  �տ� �ٴ� �����ȣ
	$number=$total-($page-1)*$page_num;

?>

<table border=0 cellspacing=1 cellpadding=0 width=100% bgcolor=#b0b0b0>
<tr height=30><td bgcolor=#3d3d3d colspan=10><img src=images/admin_webboard.gif></td></tr>
<tr height=1><td bgcolor=#000000 style=padding:0px; colspan=10><img src=images/t.gif height=1></td></tr>
<tr bgcolor=bbbbbb>
	<td align=right colspan=10 height=25 colspan=2 style=font-family:Tahoma;font-size:8pt;>
	�׷��̸� : <b><?=$group_data[name]?></b> , ��ü ȸ���� : <b><?echo $total_member;?></b> , <b><?echo $total;?></b> �� �˻�&nbsp;&nbsp;&nbsp;</td>
</tr>
<!-- ��λ����ϴ� �Ŷ�, ���Ѻ���, �׷��̵� ��ư ǥ�� -->
<script>

  function select() {
    var i, chked=0;
    for(i=0;i<document.write.length;i++) {
    if(document.write[i].type=='checkbox') { 
     if(document.write[i].checked) { document.write[i].checked=false; }
     else { document.write[i].checked=true; }
     }
    }
     return false;
   }

  function sendmail()
  {
   var i, chked=0, cart="";
   for(i=0;i<document.write.length;i++) 
   {
    if(document.write[i].type=='checkbox') 
    {
     if(document.write[i].checked)
     { cart = cart + "||" + document.write[i].value; chked=1; }
    }
   }
   if(chked)
   {
    search.cart.value=cart;
   }
   else { search.cart.value=""; }
   search.exec2.value="sendmail";
   search.submit();
   return true;
  }

  function delete_all()
  {
   var i, j=0, k=0;
   for(i=0;i<document.write.length;i++) {
    if(document.write[i].checked)
    k++;
   }
   if(k<1)
   {
    alert("������ �Ͽ� �ּ���");
    return false;
   }

   if(confirm("���õ� ����� ��� �����Ͻðڽ��ϱ�?"))
   {
    write.exec2.value="deleteall";
    write.submit();
    return true;
   }
   return false;
  }

  function move_all()
  {
   var i, j=0, k=0;
   for(i=0;i<document.write.length;i++) {
    if(document.write[i].checked)
    k++;
   }
   if(k<1)
   {
    alert("������ �Ͽ� �ּ���");
    return false;
   }


   if(confirm("���õ� ����� ��� "+write.movelevel.value+"�� �����Ͻðڽ��ϱ�?"))
   {
    write.exec2.value="moveall";
    write.submit();
    return true;
   }
   return false;
  }

<?if($member[is_admin]==1)
  {
?>
  function move_group()
  {
   var i, j=0, k=0;
   for(i=0;i<document.write.length;i++) {
    if(document.write[i].checked)
    k++;
   }
   if(k<1)
   {
    alert("������ �Ͽ� �ּ���");
    return false;
   }


   if(confirm("���õ� ����� ���õ� �׷����� �̵��Ͻðڽ��ϱ�?"))
   {
    write.exec2.value="move_group";
    write.submit();
    return true;
   }
   return false;
  }
<? } ?>
</script>

<tr align=center height=25 bgcolor=#a0a0a0>
  <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>��ȣ</td>
  <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;><a href=javascript: onclick="return select();">����</a></td>
  <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>������</td>
  <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>�̸�</td>
  <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>����</td>
  <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>����</td>
  <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>��������</td>
  <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>����</td>
  <td style=font-family:Tahoma;font-size:8pt;font-weight:bold;>����</td>
</tr>

   <form method=post action=<?=$PHP_SELF?> name=write>
   <input type=hidden name=page value=<?=$page?>>
   <input type=hidden name=keykind value=<?=$keykind?>>
   <input type=hidden name=keyword value=<?=$keyword?>>
   <input type=hidden name=like value=<?=$like?>>
   <input type=hidden name=group_no value=<?=$group_no?>>
   <input type=hidden name=exec value=<?=$exec?>>
   <input type=hidden name=page_num value=<?=$page_num?>>
   <input type=hidden name=exec2 value="">

<?
  while($data=mysql_fetch_array($result))
  {
   if($data[level]==1) $grant_color="<font color=red><b>";
   elseif($data[level]==2) $grant_color="<font color=blue><b>";
   elseif($data[level]==3) $grant_color="<font color=green><b>";
   else $grant_color="";

   echo"
        <tr align=center height=23 bgcolor=#e0e0e0>
           <td style=font-family:Tahoma;font-size:7pt;>$number</td>
           <td><input type=checkbox name=cart[] value=$data[no]></td>
           <td style=font-family:Tahoma;font-size:8pt;>$data[user_id]</td>
           <td><img src=images/t.gif height=3><br>$data[name]&nbsp;</td>
           <td style=font-family:Tahoma;font-size:8pt;>$grant_color$data[level]</td>
           <td style=font-family:Tahoma;font-size:8pt;>".($data[point1]*10+$data[point2])." <font style=font-size:7pt;>(".$data[point1]."/".$data[point2].")</font></td>
           <td style=font-family:Tahoma;font-size:8pt;>".date("Y-m-d",$data[reg_date])."</td>
           <td style=font-family:Tahoma;font-size:8pt;><a href=$PHP_SELF?exec=$exec&group_no=$group_no&exec2=modify&page=$page&no=$data[no]&keyword=$keyword&keykind=$keykind&like=$like&page_num=$page_num>Modify</a></td>
           <td style=font-family:Tahoma;font-size:8pt;>";
   if($data[no]>1) echo"<a href=$PHP_SELF?exec=$exec&group_no=$group_no&exec2=del&keyword=$keyword&page=$page&no=$data[no]$href onclick=\"return confirm('�����Ͻðڽ��ϱ�?')\">Delete</a>"; else echo"&nbsp;";
   echo"   </td>
        </tr>
        ";
   $number--;
  }
?>
<tr>
    <td height=30 align=right  colspan=9>

<!-- ����, ���� ��ư �κ� -->
    <table border=0 cellspacing=0 cellpadding=1>
    <tr>
       <td width=20>&nbsp;</td>
       <td><img src=images/t.gif height=1><br><select name=movelevel><?
  $select[0]=" selected ";
  for($i=1;$i<=10;$i++)
  echo "<option value=$i $select[$i]>$i Level</option>";?></select></td><td><input type=button value='��������' style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px; onclick=move_all()>
       </td><td><input type=button value='���õ� ȸ�� ����' style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px; onclick=delete_all()></td>
<?
  if($member[is_admin]==1)
  {
?>
       <td width=20>&nbsp;</td>
       <td><img src=images/t.gif height=1><br><select name=movegroup><?
  $temp_group=mysql_query("select * from $group_table where no!='$group_no'");
  $i=0;
  $select[0]=" selected ";
  while($temp_data=mysql_fetch_array($temp_group))
  {
   echo"<option value=$temp_data[no] $select[$i]>$temp_data[name]</option>";
   $i++;
  }
  ?></select></td>
    <td><input type=button value='�׷� ����' style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px; onclick=move_group()>&nbsp;</td>

<?
  }
?>

    </tr>
    </table>
    </td>
</form>
</tr>
<tr>
<td colspan=9 align=right bgcolor=666666>
<table border=0 cellpadding=2 cellspacing=0 width=100%>
<!-- �˻��ϴ� �κ�;;;; -->
<form method=post action=<?=$PHP_SELF?> name=search>
<input type=hidden name=exec2 value="">
<input type=hidden name=s_que value="<?=$s_que?>">
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=group_no value=<?=$group_no?>>
<input type=hidden name=exec value=<?=$exec?>>
<input type=hidden name=cart value=''>
<tr>
	<td rowspan=2 align=left>
		<input type=button value="���ϸ� ����Ʈ �߼�" style=line-height:150%;border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:50px; onclick="sendmail();">&nbsp;
		<input type=button value="ȸ�� �߰�" style=line-height:150%;border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:50px; onclick="window.open('member_join.php?mode=admin&group_no=<?=$group_no?>','zbMemberJoin','width=560,height=590,toolbars=no,resizable=yes,scrollbars=yes')">&nbsp;
	</td>
	<td align=right height=30 nowrap='nowrap'>
		<img src=images/t.gif height=2><br>
  		<select name=level_search>
  			<option>�����˻�</option>
<?
	$check[$level_search]="selected";
	for($i=1;$i<=10;$i++) echo "<option value=$i $check[$i]>$i Level</option>";
?>
		</select>
		<select name=keykind>
			<option value="user_id" <?if($keykind=="user_id")echo "selected";?>>User ID</option>
			<option value="name" <?if($keykind=="name")echo "selected";?>>Name</option>
			<option value="homepage" <?if($keykind=="homepage")echo "selected";?>>Homepage</option>
			<option value="email" <?if($keykind=="email")echo "selected";?>>Email</option>
			<option value="jumin" <?if($keykind=="jumin")echo "selected";?>>Jumin</option>
			<option value="comment" <?if($keykind=="comment")echo "selected";?>>Comment</option>
		</select>
		<input type=text name=keyword value='<?echo $keyword;?>'>
		<input type=checkbox name=like value=1 <?if($like) echo"checked";?> onclick='alert("Include üũ�� �˻�� �����ϴ� ����� �˻��մϴ�.\n\nüũ�� : *�˻���*\n\nüũ�� ���� ������� ������ ����� �˻��ϸ� �� �����ϴ�\n\nComment�� �����ϰ�� üũ���� �ʴ� ���� ���ص帳�ϴ�")'> <font style=color:#ffffff;font-size:8pt;font-family:Tahoma;>Include</font> &nbsp;
		<input type=submit value=' �˻� '  style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px; >
		<input type=button value=' ó������ ' style=border-color:#b0b0b0;background-color:#3d3d3d;color:#ffffff;font-size:8pt;font-family:Tahoma;height:20px; onclick=location.href="<?=$PHP_SELF?>?exec=<?=$exec?>&group_no=<?=$group_no?>">
	</td>
</tr>
<tr>
	<td style=font-family:Tahoma;font-size:8pt;font-weight:bold; align=right>
		�� �������� ǥ�õ� ȸ����	
		<input type=text name=page_num value='<?echo $page_num;?>' style=width:30px;>
    </td>
</tr>
</form>
</table>
</td></tr>
</table>
<br>

<font color=#ffffff style=font-size:8pt;font-family:Tahoma;>
<?
//������ ��Ÿ���� �κ�
$show_page_num=10;
$start_page=(int)(($page-1)/$show_page_num)*$show_page_num;
$i=1;
if($page>$show_page_num){$prev_page=$start_page-1;echo"<a href=$PHP_SELF?exec=$exec&group_no=$group_no&page=$prev_page$href><font color=#ffffff>[Prev]</font></a>";}
while($i+$start_page<=$total_page&&$i<=$show_page_num)
{
 $move_page=$i+$start_page;
 if($page==$move_page)echo"<b>$move_page</b>";
 else echo"<a href=$PHP_SELF?exec=$exec&group_no=$group_no&page=$move_page$href><font color=#ffffff>[$move_page]</font></a>";
 $i++;
}
if($total_page>$move_page){$next_page=$move_page+1;echo"<a href=$PHP_SELF?exec=$exec&group_no=$group_no&page=$next_page$href><font color=#ffffff>[Next]</font></a>";}
//������ ��Ÿ���� �κ� ��

?></font><br><br>
