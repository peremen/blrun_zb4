<?
$_zb_path = "../";
include "../lib.php";
if(!$connect) $connect=dbConn();
$member=member_info();
if(!$member[no]||$member[is_admin]>1||$member[level]>1) Error("최고 관리자만이 사용할수 있습니다");
$board_info=mysqli_fetch_array(mysqli_query($connect,"select * from $admin_table where no='$no'"));
$id=$board_info[name];

head("bgcolor=black")
?>
<img src=../images/t.gif border=0 width=1 height=8><Br>
<u><center><font color=aaaaaa>[<b><?=$id?></b>] 게시판 정리</font></center></u><Br>
<img src=../images/t.gif border=0 width=1 height=8><Br>
<font color=white>&nbsp;&nbsp;&nbsp;&nbsp;Category 정리 :
<?
$s_que="";
$f_cn="";
$temp=mysqli_query($connect,"select * from $t_category"."_$id order by no asc");
while($no=mysqli_fetch_array($temp))
{
	if(!$f_cn)$f_cn=$no[no];
	$s_que.=" category!='$no[no]' and ";
}
$s_que.=" category!=0";
$check=mysqli_query($connect,"update $t_board"."_$id set category='$f_cn' where $s_que") or (mysqli_error($connect));

$temp=mysqli_query($connect,"select * from $t_category"."_$id order by no asc");
while($no=mysqli_fetch_array($temp))
{
	$c=mysqli_fetch_array(mysqli_query($connect,"select count(*) from $t_board"."_$id where category='$no[no]'"));
	mysqli_query($connect,"update $t_category"."_$id set num='$c[0]' where no='$no[no]'") or error(mysqli_error($connect));
}
echo "<font color=yellow>성공</font>";
?>
<font color=white>&nbsp;&nbsp;&nbsp;&nbsp;Division 정리 :
<?
$temp=mysqli_query($connect,"select * from $t_division"."_$id order by no asc");
while($data=mysqli_fetch_array($temp))
{
	$c=mysqli_fetch_array(mysqli_query($connect,"select count(*) from $t_board"."_$id where division='$data[division]'"));
	mysqli_query($connect,"update $t_division"."_$id set num='$c[0]' where division='$data[division]'") or Error(mysqli_error($connect));
}
$temp=mysqli_fetch_array(mysqli_query($connect,"select count(*) from $t_board"."_$id"));
mysqli_query($connect,"update $admin_table set total_article='$temp[0]' where no='$no'") or Error(mysqli_error($connect));
echo "<font color=yellow>성공</font>";
?>
<br><br><center><a href=# onclick=window.close()><font color=888888>[close windows]</font></a>
<?
foot();
?>
