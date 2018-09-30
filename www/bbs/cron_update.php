<?
include "lib.php";

// DB 연결
if(!$connect) $connect=dbConn();

@mysqli_query($connect,"delete from $board_imsi_table where reg_date < ".strtotime('-1 week'));
@mysqli_query($connect,"delete from $comment_imsi_table where reg_date < ".strtotime('-1 week'));
?>
