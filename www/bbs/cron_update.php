<?
include "lib.php";

// DB 연결
if(!$connect) $connect=dbConn();

@mysql_query("delete from $board_imsi_table where reg_date < ".strtotime('-1 week'),$connect);
@mysql_query("delete from $comment_imsi_table where reg_date < ".strtotime('-1 week'),$connect);
?>
