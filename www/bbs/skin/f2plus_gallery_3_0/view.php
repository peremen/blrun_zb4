<?
if($data[prev_no]) $prev_data=mysqli_fetch_array(mysqli_query($connect,"select * from  $t_board"."_$id  where no='$data[prev_no]'"));
if($data[next_no]) $next_data=mysqli_fetch_array(mysqli_query($connect,"select * from  $t_board"."_$id  where no='$data[next_no]'"));
$a_prev="<a onfocus=blur() href='".$target."?".$href.$sort."&no=$data[prev_no]'>";
$a_next="<a onfocus=blur() href='".$target."?".$href.$sort."&no=$data[next_no]'>";
include "$dir/config2.php";
$memo = love_convert($memo);
$view_img1=$view_img2="";
include $dir."/".$type."/view.php";
?>
