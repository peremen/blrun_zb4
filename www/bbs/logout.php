<?
include "lib.php";

// DB ����
if(!$connect) $connect=dbConn();

// ��� ���� ���ؿ���
$member=member_info();

if(!$member[no]) Error("�α��� ���°� �ƴմϴ�");

if(!$group_no) $group_no=$member[group_no];

if($id) $setup=get_table_attrib($id);

if($setup[group_no]&&!$group_no) $group_no=$setup[group_no];

mysql_close($connect);

destroyZBSessionID($member[no]);
// ��ū �ʱ�ȭ
$_SESSION['_token']='';
setCookie("token","",0,"/","");
$_SESSION['_token2']='';
setCookie("token2","",0,"/","");
// 5.3 �̻�� ���� ó��
$_SESSION['zb_logged_no']='';
$_SESSION['zb_logged_time']='';
$_SESSION['zb_logged_ip']='';
$_SESSION['zb_secret']='';
$_SESSION['zb_last_connect_check']='0';
session_destroy();

if($s_url) movepage($s_url);
if($id) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&category=$category&no=$no");
elseif($group[join_return_url]) movepage($group[join_return_url]);
elseif($referer) movepage($referer);
else echo "<script>history.go(-2);</script>";
?>