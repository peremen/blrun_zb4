<?
if(preg_match("/:\/\//i",$dir)||preg_match("/\.\./i",$dir)) $dir ="./";

$reply_result=mysqli_query($connect,"select * from $t_board"."_$id where headnum='$data[headnum]' and depth>0 order by arrangenum");

while($reply_data=mysqli_fetch_array($reply_result)) {
	include "include/reply_check.php";
	include "$dir/list_reply.php";
}
?>
