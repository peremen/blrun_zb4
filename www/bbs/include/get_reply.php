<?
	if(preg_match("/:\/\//i",$dir)||preg_match("/\.\./i",$dir)) $dir ="./";

	$reply_result=mysql_query("select * from $t_board"."_$id where headnum='$data[headnum]' and depth>0 order by arrangenum");

	while($reply_data=mysql_fetch_array($reply_result)) {
		include "include/reply_check.php";
		include "$dir/list_reply.php";
	}

?>

