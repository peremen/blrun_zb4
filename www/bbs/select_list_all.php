<?
include "lib.php";
if(!$connect) $connect=dbconn();
$result=mysqli_query($connect,"select name from $admin_table order by name");

// 멤버 정보 구해오기;;; 멤버가 있을때
$member=member_info();

// 그룹 정보 구해오기
$setup=get_table_attrib($id);

// 현재 로그인되어 있는 멤버가 전체, 또는 그룹관리자인지 검사
if($member[is_admin]==1||$member[is_admin]==2&&$member[group_no]==$setup[group_no]||$member[board_name]) $is_admin=1; else $is_admin="";

unset($setup);

if(!$is_admin) error("사용권한이 없습니다");

head();
?>

<script>
function change_board_name()
{
 select.board_name.value=select.select_board_name.value;
}

function board_delete()
{
 var check;
 select.exec.value="delete_all";
 check=confirm("삭제하시겠습니까?");
 if(check==true) {document.select.submit();}
}

function board_copy()
{
 var check;
 select.exec.value="copy_all";
 check=confirm(select.board_name.value+"게시판으로 복사 하시겠습니까?");
 if(check==true) {document.select.submit();}
}

function board_move()
{
 var check;
 select.exec.value="move_all";
 check=confirm(select.board_name.value+"게시판으로 이동하시겠습니까?");
 if(check==true) {document.select.submit();}
}
</script>

<table border=0 cellspacing=0 cellpadding=0>
<form name=select action=list_all.php method=post>
<input type=hidden name=id value="<?=$id?>">
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=category value="<?=$category?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=sm value="<?=$sm?>">
<input type=hidden name=exec value="">
<input type=hidden name=selected value="<?=$selected?>">
<tr>
	<td><img src=images/m_title.gif border=0></td>
</tr>
<tr>
	<td align=center>
		<input type=checkbox name=notice_user value=1> 회원에게 통보
		<input type=checkbox name=notice_bbs value=1 checked> 게시물에 기록
</tr>
<tr>
	<td><img src=images/m_top.gif border=0></td>
</tr>
<tr>
	<td background=images/m_back.gif align=center>
	<table border=0 width=240>
	<tr>
		<td><select name=select_board_name onchange=change_board_name() style=width:100%>
<?
$select="selected";
$s_name = "";
while($data=mysqli_fetch_array($result)) {
	if(!$s_name) $s_name = $data[name];
?>
			<option value="<?=$data[name]?>" <?=$select?>><?=$data[name]?></option>
<?
	$select="";
}
?>
		</select></td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td background=images/m_back.gif align=center>
		<img src=images/m_text.gif border=0><a href=javascript:void(board_copy()) onfocus=blur()><img src=images/m_copy.gif border=0></a> <a href=javascript:void(board_move()) onfocus=blur()><img src=images/m_move.gif border=0></a>
	</td>
</tr>
<tr>
	<td><img src=images/m_bottom.gif border=0></td>
</tr>
<tr>
	<td><a href=javascript:void(board_delete()) onfocus=blur()><img src=images/m_del.gif border=0></a></td>
</tr>
<input type=hidden name=board_name value="<?=$s_name?>">
</form>
</table>
<?
foot();
?>
