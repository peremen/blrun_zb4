<?
/* Check New Article to $new */
if(time()-$data['reg_date']<60*60*12) $new = "&nbsp;<font color=red style='font-size:8pt;'>new</font>";
elseif(time()-$data['reg_date']<60*60*24) $new = "&nbsp;<font color=blue style='font-size:8pt;'>new</font>";
else $new = "";

/* Check New Comment $comment_new */
$last_comment = mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where parent='$data[no]' order by reg_date desc limit 1"));
$last_comment_time = $last_comment['reg_date'];
if(time()-$last_comment_time<60*60*24) $comment_new = "&nbsp;<font color=red style='font-size:8pt;'>".$comment_num."</font>";
elseif(time()-$last_comment_time<60*60*48) $comment_new = "&nbsp;<font color=blue style='font-size:8pt;'>".$comment_num."</font>";
else $comment_new = "&nbsp;<font class=zv3_comment style='font-size:8pt;'>".$comment_num."</font>";
?>
<tr align=center class=zv3_listBox onMouseOver=this.style.backgroundColor='#FBFBFB' onMouseOut=this.style.backgroundColor=''>
<!--īƮ-->
<?=$hide_cart_start?>

  <td><input type=checkbox name=cart value="<?=$data[no]?>"></td>
<?=$hide_cart_end?>

<!--�Խ��� ������ ���� ����ǥ��-->
  <? if($browser=="1"){ ?><td height=25 align="center"><?=$icon?></td><? } ?>

<!--����������,ī�װ�,����, ������ ��ۼ�-->
  <td align=left nowrap='nowrap'><div style="overflow:hidden">&nbsp;(����)&nbsp;<?=$insert?><b><?=$subject?></b> <?=$comment_new?><?=$new?></div></td> 
<!--ȸ��������, �ۼ���-->
  <? if($browser=="1"){ ?><td nowrap='nowrap'><div style="overflow:hidden"><?=$face_image?>&nbsp;<?=$name?>&nbsp;</div></td><? } ?>

<!--�ۼ���-->
  <? if($browser=="1"){ ?><td nowrap='nowrap' class=zv3_small><?=$reg_date?></td><? } ?>

<!--��ȸ--><!--��õ-->
  <? if($browser=="1"){ ?><td nowrap='nowrap' class=zv3_small><?=$hit?></td><td nowrap='nowrap' class=zv3_small><?=$vote?></td><? } ?>

</tr>
<tr>
<!--�Խù��� �Խù������� ����-->
  <td colspan=<?=$colspanNum?>><img src=<?=$dir?>/line.gif width=100% height=2></td>
</tr>
