<? /////////////////////////////////////////////////////////////////////////
 /*
 ����� ����ϴ� �κ��Դϴ�.
 ����� �������̱� ������ �� ������ ��� �о ����մϴ�.
 ��ȯ�� �ǵ��� �� �ۼ��ϼž� �մϴ�.
 �Ʒ��� HTML �ȿ� �״�� ������ֽø� ��ȯ�� �ϸ鼭 ����� �մϴ�.

 <?=$number?> : �����ȣ. �� ������� ������ ��ȣ
 * <?=$data[no]?> : �����ȣ, ���� �ٲ��� �ʴ� ��ȣ..
 * <?=$loop_number?> : ���� ���õǾ� �ִ� ���̶� ��ȣ�� ������
 <?=$name?> : ������ ��ũ�Ǿ� �ִ� �̸� * ���� �״�� <?=$data[name]?>
 <?=$email?> : ����.. ���� ���� ������ ����;;
 <?=$subject?> : ��ũ�� �Ǿ� �ִ� ����  * ���� �״�� <?=$data[suject]?>
 <?=$memo?> : ���� �κ� 
 <?=$hit?> : ��ȸ��
 <?=$vote?> : ��õ��
 <?=$ip?> : �����ּ�
 <?=$comment_num?> : ������ ��� �� [ ] �� �ѷ��ο� �ִ°�;; <?=$data[comment_num]?> �� ���ڸ�;;
 <?=$reg_date?> : �۾� ����
 <?=$category_name?> : ī�װ� �̸�

 <?=$face_image?> : ���� ȸ�������� ������;;

 <?=$insert?> : ����ϰ�� ��ĭ�� ���� ���̸� ����մϴ�.
 <?=$icon?>   : ���� ���� ���¿� ���� �������� ����մϴ�.

 �ٱ��Ͽ� ī�װ��� ��� ������� �ʴ� ���� �����Ƿ� ���ܳ����� ���� ����;;
 <?=$hide_cart_start?> ���� <?=$hide_cart_end?> : start �� end ���̿��� �����;; �ٱ���
 <?=$hide_category_start?> ���� <?=$hide_category_end?> : Start�� end ���̿��� �����;; �ٱ���

                
 ����: old_head.gif : �������̸鼭 12�ð��� ���� ���� ������
       new_head.gif : 12�ð��� ���� ��� ��. ����/��� �������
       reply_head.gif : 12�ð��� ���� ����� ������
       reply_new_head.gif : 12�ð��� ������ ���� ����� ������;;
       notice_head.gif : ���������϶� ������
       secret_head.gif : ��б����� ��Ÿ���� ������
       arror.gif : ���� ����Ʈ���� ���õǾ� �ִ� �� �տ� �ٴ� ������
 */
///////////////////////////////////////////////////////////////////////// ?>
<!-- ��� �κ� ���� -->
<?
/* Check New Article to $new */
if(time()-$data['reg_date']<60*60*24) $new = "&nbsp;<font color=red style='font-size:8pt;'>new</font>";
elseif(time()-$data['reg_date']<60*60*48) $new = "&nbsp;<font color=blue style='font-size:8pt;'>new</font>";
else $new = "";

/* Check New Comment $comment_new */
$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
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
