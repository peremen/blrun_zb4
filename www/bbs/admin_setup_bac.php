<?
/***************************************************************************
 * ������ ������
 **************************************************************************/

include "lib.php";

$connect=dbConn();

$member=member_info();

if(!$member[no]) Error("�α����� ����Ͽ��ֽʽÿ�","admin.php");

if($member[is_admin]>=3&&!$member[board_name]) Error("�������������� ����Ҽ� �ִ� ������ �����ϴ�","admin.php");


// �Խ��� �������϶�
if($member[is_admin]>=3&&$member[board_name]&&$exec!="logout") $exec="view_board";

// DB ����϶�
if($member[is_admin]==1&&$exec=="db_dump") {
	set_time_limit(0);
	include "admin/dbDump.php";
	$dbData = file("myZrCnf2019.php");
	$dbname = trim($dbData[4]);
	$filename = $dbname."_".date("Ymd").".sql";
	zbDB_Header($filename);
	zbDB_All_down($dbname);
	exit();
}

// �� ��ɺ� ���� ȣ��
if($exec=="view_board") { include "admin/admin_exec_board_bac.php"; }
elseif($exec=="view_member") { include "admin/admin_exec_member_bac.php"; }
else { include "admin/admin_exec_group_bac.php"; }

head(" bgcolor=444444 ");
?>

<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#000000" height=100%>
<tr bgcolor="#FFFFFF"> 
  <td width="195" height="64"><a href="admin.php" target="_top"><img src="images/logo.gif" width="159" height="64" border="0"></a></td>
  <td bgcolor="#6F080A" width=100%> 

    <table width="100%" border="0" cellspacing="0" cellpadding="0" height="64">
    <tr> 
      <td valign="top" colspan="2" align=right>
        <img src=images/t.gif border=0 height=5><br> 

<? if($member[is_admin]==1) {?>
        <a href=admin_setup_bac.php?exec=uninstall><font color=white style=font-size:9pt onclick="return confirm('���κ��带 �����Ͻðڽ��ϱ�?')"><b>Uninstall</b></font></a> &nbsp;|&nbsp;
        <a href=admin_setup_bac.php?exec=db_dump><font color=white style=font-size:9pt onclick="return confirm('����Ͻðڽ��ϱ�?')"><b>DB ���</b></font></a> &nbsp;|&nbsp;
        <a href=admin_setup_bac.php?exec=db_status><font color=white style=font-size:9pt><b>DB ���� ����</b></font></a> &nbsp;|&nbsp;
        <a href=admin/arrangefile.php target=_blank onclick="return confirm('÷������ �����ÿ��� ÷�������� ������ ���� �ð��� ���� �ɸ��� �ֽ��ϴ�\n\n�����Ͻðڽ��ϱ�?')"><font color=white style=font-size:9pt><b>÷������ ����</b></font></a> &nbsp;|&nbsp;
        <a href=admin/delsession.php target=_blank onclick="return confirm('������ ���� �������� ��ü���� �ӵ��� �������� �ֽ��ϴ�.\n\n���� ���丮�� �����Ͻðڽ��ϱ�?')"><font color=white style=font-size:9pt><b>���� ����</b></font></a> &nbsp;|&nbsp;
        <a href=admin/trace.php target=_blank><font color=white style=font-size:9pt><b>�Խù� ����</b></font></a> &nbsp;|&nbsp;
        <a href=zb4_manual/ target=_blank><font color=white style=font-size:9pt><b>�Ŵ���</b></font></a>&nbsp;&nbsp;
<? } ?>

      </td>
    </tr>
    <tr> 
      <td valign="bottom" width="180"><img src="images/admintop.gif" width="180" height="20"></td>
      <td valign="bottom" align="right"> 

        <table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="images/adminid.gif" width="100" height="24"></td>
          <td nowrap='nowrap' style="font-family:Tahoma;font-size:8pt;"><font color="#FFFFFF"><b><?=$member[user_id]?></b></font></td>
          <td><img src="images/adminlevel.gif" width="49" height="24"></td>
          <td nowrap='nowrap' style="font-family:Tahoma;font-size:8pt;">

<?
// �ְ�������϶�
if($member[is_admin]==1) 
	echo "<b><font color=#ffffff>Super Administrator</font></b> <a href=$PHP_SELF?exec=view_member&exec2=modify&no=$member[no]><font color=#ffffff style=font-family:Tahoma;font-size:8pt;>(Edit information)</font></a>";

// �׷�������϶�
elseif($member[is_admin]==2) 
	echo "<b><font color=#ffffff>Group Administrator</font></b> <a href=$PHP_SELF?exec=view_member&group_no=$member[group_no]&exec2=modify&no=$member[no]><font color=#ffffff style=font-family:Tahoma;font-size:8pt;>(Edit information)</font></a>";

// �Խ��� �������϶�
elseif($member[board_name])
	echo "<b><font color=#ffffff>Board Administrator</font></b>";

// ��Ÿ�϶�;; -_-;;
else
	echo "<b><font color=#ffffff>Normal Member</font></b> <a href=$PHP_SELF?exec=view_member&group_no=$member[group_no]&exec2=modify&no=$member[no]><font color=#ffffff style=font-family:Tahoma;font-size:8pt;>(Edit information)</font></a>";
?>
              		&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href=logout.php?s_url=admin.php><font color=white style=font-size:9pt><b>Log Out</b></font></a>&nbsp;&nbsp;
          </td>
        </tr>
        </table>

      </td>
    </tr>
    </table>

  </td>
</tr>
<tr bgcolor="#FFFFFF"> 

<!-- �׷��� �����ϴ� �κ� -->
  <td bgcolor="#3F3F3F" valign="top">  

<!-- �׷���� -->

<?

// �ְ�������ΰ�� ��� �׷� �����ְ� �߰�/���� ����

if($member[is_admin]==1) {

	// ���׷��� ����Ÿ �����;;
	$result=mysql_query("select * from $group_table order by no ");
?>
    <table width=100% border=0 cellspacing=0 cellpadding=0>
    <tr> 
      <td bgcolor=#595959><img src=images/l_group.gif></td>
    </tr>
    </table>
<?
	while($group_data=mysql_fetch_array($result)) {

		//$t_member_num=mysql_fetch_array(mysql_query("select count(*) from $member_table where group_no='$group_data[no]'"));
		//$t_board_num=mysql_fetch_array(mysql_query("select count(*) from $admin_table where group_no='$group_data[no]'"));

		//mysql_query("update $group_table set member_num='$t_member_num[0]',board_num='$t_board_num[0]' where no='$group_data[no]'") or Error(mysql_error());

		//$group_data[member_num]=$t_member_num[0];
		//$group_data[board_num]=$t_board_num[0];

		if($group_data[no]==$group_no) $b="<b>"; else $b="";

		// �׷��̸� ���
?>
    <table width=100% border=0 cellspacing=0 cellpadding=0>
    <tr> 
      <td height=29 background=images/gnamebg.gif align=center><img src=images/t.gif width=10 height=3><br>&nbsp;<a href=<?=$PHP_SELF?>?exec=view_group&group_no=<?=$group_data[no]?>><font color=white><?=$b.$group_data[name]?> (<?=$group_data[no]?>)</b></font></a></td>
    </tr>
<?

		// ���� ���õ� �׷�� ���εǴ� �׷�� ��ġ�ɶ�;;
		if($group_no==$group_data[no]) {
?>
    <tr> 
      <td bgcolor=#868686 style=font-family:Tahoma;font-size:8pt;padding:3px><img src=images/g_top.gif width=38 height=14><br>
        <a href=<?=$PHP_SELF?>?group_no=<?=$group_data[no]?>&exec=modify_group><img src=images/g_properties.gif border=0 alt="�׷� ����"></a>
<?
			if($member[is_admin]==1) 
				echo "
        <a href=$PHP_SELF?group_no=$group_data[no]&exec=del_group><img src=images/g_delete.gif border=0 alt=\"�׷� ����\"></a>
"; 
?>
        <img src=images/t.gif width=10 height=5><br>
        <img src=images/m_top1.gif width=51 height=14 align=absmiddle><b><font color=#FFFFFF><?=$group_data[member_num]?></font></b><img src=images/m_top2.gif width=6 height=14 align=absmiddle><br>
        <a href=<?=$PHP_SELF?>?exec=view_member&group_no=<?=$group_data[no]?>><img src=images/m_manage.gif border=0 alt="ȸ�� ����"></a><a href=<?=$PHP_SELF?>?exec=modify_member_join&group_no=<?=$group_data[no]?>><img src=images/m_joinform.gif border=0 alt="���Ծ�� ����"></a><br>
        <img src=images/t.gif width=10 height=5><br>
        <img src=images/w_top1.gif width=58 height=14 align=absmiddle><b><font color=#FFFFFF><?=$group_data[board_num]?></font></b><img src=images/w_top2.gif width=4 height=14 align=absmiddle> 
        <br>
        <a href=<?=$PHP_SELF?>?exec=view_board&group_no=<?=$group_data[no]?>&page=<?=$page?>&page_num=<?=$page_num?>><img src=images/w_manage.gif alt="�Խ��� ����" border=0></a><a href=<?=$PHP_SELF?>?exec=view_board&exec2=add&group_no=<?=$group_data[no]?>><img src=images/w_add.gif alt="�Խ��� �߰�" border=0></a> 
      </td>
    </tr>
<?
		} 
   
		echo "
    </table>
		"; 
	} 
} 


// �ְ�����ڰ��ƴҶ�;;

else {  

	$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no=$member[group_no]"));
?>

    <table width=100% border=0 cellspacing=0 cellpadding=0>
    <tr>
      <td bgcolor=#595959 align=center><img src=images/l_group.gif></td>
    </tr>
    </table>
    <table width=100% border=0 cellspacing=0 cellpadding=0>
    <tr>
      <td height=29 background=images/gnamebg.gif align=center><img src=images/t.gif width=10 height=3><br>
        <a href=<?=$PHP_SELF?>?exec=view_group&group_no=<?=$group_data[no]?>><b><font color=white><?=$b.$group_data[name]?> (<?=$group_data[no]?>)</b></font></a>
      </td>
    </tr>
<?
	// �޴����
	if($member[is_admin]==2) {
?>
    <tr>
      <td bgcolor=#868686 style=font-family:Tahoma;font-size:8pt;padding:3px><img src=images/g_top.gif width=38 height=14><br>
        <a href=<?=$PHP_SELF?>?group_no=<?=$group_data[no]?>&exec=modify_group><img src=images/g_properties.gif width=60 height=12 border=0 alt="�׷� ����"></a><br>
        <img src=images/t.gif width=10 height=5><br>
        <img src=images/m_top1.gif width=51 height=14 align=absmiddle><b><font color=#FFFFFF><?=$group_data[member_num]?></font></b><img src=images/m_top2.gif width=6 height=14 align=absmiddle><br>
        <a href=<?=$PHP_SELF?>?exec=view_member&group_no=<?=$group_data[no]?>><img src=images/m_manage.gif width=73 height=12 border=0 alt="ȸ�� ����"></a><a href=<?=$PHP_SELF?>?exec=modify_member_join&group_no=<?=$group_data[no]?>><img src=images/m_joinform.gif width=55 height=12 border=0 alt="����������"></a><br>
        <img src=images/t.gif width=10 height=5><br>
        <img src=images/w_top1.gif width=58 height=14 align=absmiddle><b><font color=#FFFFFF><?=$group_data[board_num]?></font></b><img src=images/w_top2.gif width=4 height=14 align=absmiddle>
        <br>
        <a href=<?=$PHP_SELF?>?exec=view_board&group_no=<?=$group_data[no]?>><img src=images/w_manage.gif width=73 height=12 alt="�Խ��� ����" border=0></a><a href=<?=$PHP_SELF?>?exec=view_board&exec2=add&group_no=<?=$group_data[no]?>><img src=images/w_add.gif width=29 height=12 alt="�Խ��� �߰�" border=0></a>
      </td>
    </tr>
<?
	} 
	echo "
    </table>"; 
} 
?>

<!-- ī�Ƕ���Ʈ -->
    <table width=100% border=0 cellspacing=0 cellpadding=0>
    <tr>
      <td bgcolor=666666 height=1><img src=images/t.gif border=0 height=1></td>
    </tr>
<?
if($member[is_admin]==1) {
?>
    <tr>
	  <td bgcolor="#3F3F3F" valign="bottom"><img src="images/t.gif" width="10" height="10"><br><a href=<?=$PHP_SELF?>?exec=add_group><img src=images/l_addgroup.gif border=0></a></td>
    </tr>
<?
}
?>
    </table>
    <table width=100% border=0 cellspacing=0 cellpadding=0>
    <tr>
      <td bgcolor="#3F3F3F" valign="bottom" height="45"><img src="images/t.gif" width="10" height="10"><br>
        <a href="http://www.xpressengine.com/zb4_main" target="_blank"><img src="images/admincopyright.gif" width="159" height="35" border="0"></a>
      </td>
    </tr>
    </table>

  </td>

<!-- �������� Ȱ������~~ ������~ -->
  <td width=100% align=center valign=top bgcolor=#3d3d3d>

<?
// �ְ�������϶�
if($member[is_admin]==1) {
	if($exec=="add_group") { include "admin/admin_add_group_bac.php"; }
	elseif($exec=="uninstall") { include "admin/admin_uninstall.php"; }
	elseif($exec=="db_status") {include "admin/admin_dbstatus.php";}
	elseif($exec=="modify_group") { include "admin/admin_modify_group_bac.php";}
	elseif($exec=="view_group") { include "admin/admin_view_group.php"; }
	elseif($exec=="del_group") { include "admin/admin_del_group_bac.php"; }
	elseif($exec=="modify_member_join") { include "admin/admin_modify_member_join_bac.php"; }
	elseif($exec=="view_member") { 
		if($exec2=="sendmail") {include "admin/admin_sendmail.php";}
		elseif($exec2=="modify") {include "admin/admin_modify_member_bac.php";}
		else {include "admin/admin_view_member.php";} 
	} elseif($exec=="view_board") {
		if($exec2=="add") {include "admin/admin_add_board_bac.php";}
		elseif($exec2=="modify") {include "admin/admin_modify_board_bac.php";}
		elseif($exec2=="category") {include "admin/admin_category_bac.php";}
		elseif($exec2=="modify_category") {include "admin/admin_category_modify_bac.php";}
		elseif($exec2=="grant") {include "admin/admin_modify_grant_bac.php";}
		else {include "admin/admin_board_list.php";}
	} else {include "admin/readme.php";}

// �׷� �������� ���
} elseif($member[is_admin]==2) {
	$group_no=$group_data[no];
	if($exec=="modify_group") { include "admin/admin_modify_group_bac.php";}
	elseif($exec=="modify_group") { include "admin/admin_modify_group_bac.php";}
	elseif($exec=="modify_member_join") { include "admin/admin_modify_member_join_bac.php"; }
	elseif($exec=="view_member") { 
		if($exec2=="sendmail") {include "admin/admin_sendmail.php";} 
		elseif($exec2=="modify") {include "admin/admin_modify_member_bac.php";}
		else {include "admin/admin_view_member.php";}
	} elseif($exec=="view_board") {
		if($exec2=="add") {include "admin/admin_add_board_bac.php";}
		elseif($exec2=="modify") {include "admin/admin_modify_board_bac.php";}
		elseif($exec2=="category") {include "admin/admin_category_bac.php";}
		elseif($exec2=="modify_category") {include "admin/admin_category_modify_bac.php";}
		elseif($exec2=="grant") {include "admin/admin_modify_grant_bac.php";}
		else {include "admin/admin_board_list.php";}
	} else {include "admin/admin_view_group.php"; }
	} elseif($member[board_name]) {
		if($exec=="view_board") {
		if($exec2=="modify") {include "admin/admin_modify_board_bac.php";}                                                                                      
		elseif($exec2=="category") {include "admin/admin_category_bac.php";}                                                                                        
		elseif($exec2=="modify_category") {include "admin/admin_category_modify_bac.php";}                                                                          
		elseif($exec2=="grant") {include "admin/admin_modify_grant_bac.php";}                                                                                       
		else {include "admin/admin_board_list.php";}
	} 

// �Խ��� �������϶�
} elseif($member[board_name]&&exec=="view_board") {
		if($exec2=="modify") {include "admin/admin_modify_board_bac.php";}
		elseif($exec2=="category") {include "admin/admin_category_bac.php";}
		elseif($exec2=="modify_category") {include "admin/admin_category_modify_bac.php";}
		else {include "admin/admin_board_list.php";}
}
?>

  </td>
</tr>
</table>

<?
mysql_close($connect);
foot();
?>