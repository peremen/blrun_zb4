<? /////////////////////////////////////////////////////////////////////////
 /*
 목록을 출력하는 부분입니다.
 목록은 여러개이기 때문에 이 파일을 계속 읽어서 출력합니다.
 순환이 되도록 잘 작성하셔야 합니다.
 아래는 HTML 안에 그대로 사용해주시면 순환을 하면서 출력을 합니다.

 <?=$number?> : 가상번호. 즉 순서대로 나오는 번호
 * <?=$data[no]?> : 절대번호, 절대 바뀌지 않는 번호..
 * <?=$loop_number?> : 현재 선택되어 있는 글이라도 번호로 나오게
 <?=$name?> : 메일이 링크되어 있는 이름 * 원래 그대로 <?=$data[name]?>
 <?=$email?> : 메일.. 거의 직접 쓸일은 없음;;
 <?=$subject?> : 링크가 되어 있는 제목  * 원래 그대로 <?=$data[suject]?>
 <?=$memo?> : 내용 부분
 <?=$hit?> : 조회수
 <?=$vote?> : 추천수
 <?=$ip?> : 아피주소
 <?=$comment_num?> : 간단한 답글 수 [ ] 가 둘러싸여 있는것;; <?=$data[comment_num]?> 은 숫자만;;
 <?=$reg_date?> : 글쓴 날자
 <?=$category_name?> : 카테고리 이름

 <?=$face_image?> : 현재 회원상태의 아이콘;;

 <?=$insert?> : 답글일경우 한칸씩 들어가는 깊이를 출력합니다.
 <?=$icon?>   : 현재 글의 상태에 따라서 아이콘을 출력합니다.

 바구니와 카테고리의 경우 사용하지 않는 수가 있으므로 숨겨놓을때 쓰는 변수;;
 <?=$hide_cart_start?> 내용 <?=$hide_cart_end?> : start 와 end 사이에는 사라짐;; 바구니
 <?=$hide_category_start?> 내용 <?=$hide_category_end?> : Start와 end 사이에는 사라짐;; 바구니


 참고: old_head.gif : 원본글이면서 12시간이 넘은 글의 아이콘
       new_head.gif : 12시간에 적히 모든 글. 원본/답글 상관없이
       reply_head.gif : 12시간이 지난 답글의 아이콘
       reply_new_head.gif : 12시간이 지나지 않은 답글의 아이콘;;
       notice_head.gif : 공지사항일때 아이콘
       secret_head.gif : 비밀글을때 나타나는 아이콘
       arror.gif : 현재 리스트에서 선택되어 있는 글 앞에 붙는 아이콘
 */
///////////////////////////////////////////////////////////////////////// ?>
<!-- 목록 부분 시작 -->
<?
/* Check New Article to $new */
if(time()-$data['reg_date']<60*60*24) $new = "&nbsp;<font color=red style='font-size:8pt;'>new</font>";
elseif(time()-$data['reg_date']<60*60*48) $new = "&nbsp;<font color=blue style='font-size:8pt;'>new</font>";
else $new = "";

/* Check New Comment $comment_new */
$last_comment = mysqli_fetch_array(mysqli_query($connect,"select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
$last_comment_time = $last_comment['reg_date'];
if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
else $comment_new = "&nbsp;<font class=listnum style='font-size:8pt;'>".$comment_num."</font>";
?>
<tr align=center bgcolor=<?=$list_bg_color?> onMouseOver=this.style.backgroundColor='<?=$list_mouse_over_color?>' onMouseOut=this.style.backgroundColor=''>
  <? if($browser=="1"){ ?><td height=22 class=listnum><?=$number?></td><? } ?>

  <?=$hide_cart_start?><td><input type=checkbox name=cart value="<?=$data[no]?>"></td><?=$hide_cart_end?>

  <td align=left nowrap='nowrap'><div style="overflow:hidden"><img src=images/t.gif height=3><br>&nbsp;<?=$hide_category_start?><nobr>[<?=$category_name?>]</nobr><?=$hide_category_end?><?=$insert?><?=$icon?><?=$subject?><?=$comment_new?><?=$new?></div></td>
  <? if($browser=="1"){ ?><td nowrap='nowrap'><div style="overflow:hidden"><img src=images/t.gif height=3><br><?=$face_image?><?=$name?></div></td><? } ?>

  <? if($browser=="1"){ ?><td nowrap='nowrap' class=listnum><?=$reg_date?></td><? } ?>

  <? if($browser=="1"){ ?><td nowrap='nowrap' class=listnum><?=$hit?></td><td nowrap='nowrap' class=listnum><?=$vote?></td><? } ?>

</tr>
<tr><td colspan=10 height=1 bgcolor=<?=$list_divider?>><img src=images/t.gif height=1></td></tr>
