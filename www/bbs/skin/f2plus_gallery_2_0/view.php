<?
  if($data[prev_no]) $prev_data=mysql_fetch_array(mysql_query("select * from  $t_board"."_$id  where no='$data[prev_no]'"));
  if($data[next_no]) $next_data=mysql_fetch_array(mysql_query("select * from  $t_board"."_$id  where no='$data[next_no]'"));
  $a_prev="<a onfocus=blur() href='".$target."?".$href.$sort."&no=$data[prev_no]'>";
  $a_next="<a onfocus=blur() href='".$target."?".$href.$sort."&no=$data[next_no]'>";
  include "$dir/config2.php";
  $view_img1=$view_img2="";
  include $dir."/".$type."/view.php";
 ?>