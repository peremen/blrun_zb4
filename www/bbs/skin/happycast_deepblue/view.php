<? /////////////////////////////////////////////////////////////////////////
  /*
  �� ������ ����Ʈ�� ��� �κ��� �����ִ� ���Դϴ�
  <?=$a_ �� ���۵Ǵ� �׸��� HTML�� <a ��� �����Ͻø� �˴ϴ�.
  �ڿ� </a>�� �ٿ��ָ� ����;
  ������ ��Ų ���۽� ����� �ִ� ���� �Դϴ�. �״�� ����Ͻø� �˴ϴ�;;;;

  <?=$face_image?> : ���� ���� ���� �۾��� �� ������;;

  <?=$width?> : �Խ����� ����ũ��
  <?=$dir?> : ��Ų���丮�� ����ŵ�ϴ�.
  <?=$a_download1?> : ù��° ������ �ٿ�ε�
  <?=$a_download2?> : �ι�° ������ �ٿ�ε�
  <?=$a_email?> : ���ϸ�ũ
  <?=$a_homepage?> : Ȩ������ ��ũ

  <?=$a_write?> : �۾��� ��ư
  <?=$a_list?> : ��Ϻ��� ��ư
  <?=$a_reply?> : ��۾��� ��ư
  <?=$a_delete?> : �ۻ��� ��ư
  <?=$a_vote?> : ��õ��ư
  <?=$a_modify?> : �ۼ��� ��ư

  �ٱ��Ͽ� ī�װ��� ��� ������� �ʴ� ���� �����Ƿ� ���ܳ����� ���� ����;;
  <?=$hide_cart_start?> ���� <?=$hide_cart_end?> : start �� end ���̿��� �����;; �ٱ���
  <?=$hide_category_start?> ���� <?=$hide_category_end?> : Start�� end ���̿��� �����;; �ٱ���
  <?=$hide_sitelink1_start?> ���� <?=$hide_sitelink1_end?> : ����Ʈ��ũ ǥ�� #1
  <?=$hide_sitelink2_start?> ���� <?=$hide_sitelink2_end?> : ����Ʈ��ũ ǥ�� #2
  <?=$hide_download1_start?> ���� <?=$hide_download1_end?> : �ٿ�ε� ǥ�� #1
  <?=$hide_download2_start?> ���� <?=$hide_download2_end?> : �ٿ�ε� ǥ�� #2
  <?=$hide_homepage_start?> ���� <?=$hide_homepage_end?> : Ȩ������ ǥ��
  <?=$hide_email_start?> ���� <?=$hide_email_end?> : Email ǥ��

  -- ������ ��� ����
  <?=$hide_comment_start?> <?=$hide_comment_end?> : ������ ��� ���� �����ֱ�/ �����


  <?=$name?> : ������ ��ũ�Ǿ� �ִ� �̸� * ���� �״�� <?=$data[name]?>
  <?=$email?> : ����.. ���� ���� ������ ����;; ���ϸ� �ִ� ���� <?=$data[email]?>
  <?=$subject?> : ����  * ���� �״�� <?=$data[suject]?>
  <?=$memo?> : ���� �κ�
  <?=$homepage?> : ��ũ�� �ɸ� Ȩ������ * Ȩ������ �ּҸ� : <?=$data[homepage]?>
  <?=$hit?> : ��ȸ��
  <?=$vote?> : ��õ��
  <?=$ip?> : �����ּ�
  <?=$comment_num?> : ������ ��� ��
  <?=$reg_date?> : �۾� ����
  <?=$category_name?> : ī�װ� �̸�
  <?=$insert?> : ����ϰ�� ��ĭ�� ���� ���̸� ����մϴ�.
  <?=$icon?>   : ���� ���� ���¿� ���� �������� ����մϴ�.
  <?=$a_file_link1?> : �ٿ�ε� ������ ������ ���ϸ�ũ #1
  <?=$a_file_link2?> : �ٿ�ε� ������ ������ ���ϸ�ũ #2
  <?=$file_name1?> : �ٿ�ε� ������ ������ �����̸� #1
  <?=$file_name2?> : �ٿ�ε� ������ ������ �����̸� #2
  <?=$file_size1?> : �ٿ�ε� ������ ������ ����ũ�� #1
  <?=$file_size2?> : �ٿ�ε� ������ ������ ����ũ�� #2
  <?=$file_download1?> : �ٿ�ε���� ȸ�� #1;
  <?=$file_download2?> : �ٿ���� ȸ�� #2
  <?=$sitelink1?> : ����Ʈ ��ũ(��ũ �ɸ���) #1
  <?=$sitelink2?> : ����Ʈ ��ũ(��ũ �ɸ���) #2

  <?=$upload_image1?> : �̹����� ���ε�Ǿ����� �׸������̸�;; #1
  <?=$upload_image2?> : �̹����� ���ε�Ǿ����� �׸������̸�;; #2

  ����: old_head.gif : �������̸鼭 12�ð��� ���� ���� ������
       new_head.gif : 12�ð��� ���� ��� ��. ����/��� �������
       reply_head.gif : 12�ð��� ���� ����� ������
       notice_head.gif : ���������϶� ������
       arror.gif : ���� ����Ʈ���� ���õǾ� �ִ� �� �տ� �ٴ� ������

  --- ����/ ���ı� ��ũ ---
  <?=$a_prev?> : ������ ��ũ
  <?=$a_next?> : ������ ��ũ

  <?=hide_prev_start?> <?=$hide_prev_end?> : ������ ��Ÿ����/ �����
  <?=hide_next_start?> <?=$hide_next_end?> : ������ ��Ÿ����/ �����
 
  ��Ÿ �����̳� �۾��̵��� ���� ����Ÿ���� �տ� prev_ , next_ �� �� ���ΰ���;
  ex) ������ ���� : <?=$prev_subject?>
  
  */ 
  include "$dir/value.php3";
///////////////////////////////////////////////////////////////////////////// ?>

<table width=<?=$width?> border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>>
<tr>
  <td><img src=images/t.gif height=3></td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> bgcolor=white style=table-layout:fixed>
<col width=100></col><col width=></col>
<tr>
  <td height=30>&nbsp;&nbsp;<font class=view_title1>View</font> <font class=view_title2>Articles</font></td>
  <td align=right valign=bottom>
    <?=$a_modify?><img src=<?=$dir?>/i_modify.gif border=0 align=absmiddle></a>
    <?=$a_delete?><img src=<?=$dir?>/i_delete.gif border=0 align=absmiddle></a>
  </td>
</tr>
<tr height=1><td colspan=2 bgcolor=<?=$view_divider?>><img src=images/t.gif height=1></td></tr>
<tr>
  <td height=23 align=right class=listnum width=100 bgcolor=<?=$view_left_header_color?> class=view_left_menu><img src=images/t.gif border=0 width=100 height=1><br><b>Name&nbsp;&nbsp;</b></td>
  <td align=left width=100%><table border=0 cellpadding=0 cellspacing=0><tr><td><img src=images/t.gif height=3></td></tr><tr><td>&nbsp;</td><td><?=$face_image?> <?=$name?>&nbsp;<? if($data[email]) { ?> <font style=font-size:7pt;font-family:Tahoma;font-weight:normal>[<a href=mailto:<?=$data[email]?>><?=$data[email]?></a>]</font><? } ?> ( <?=$date?>, Hit : <b><?=$hit?></b>, Vote : <b><?=$vote?></b>&nbsp;)</td></tr></table></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_homepage_start?>

<tr>
  <td height=23 align=right class=listnum width=100 bgcolor=<?=$view_left_header_color?> class=view_left_menu><b>Homepage&nbsp;&nbsp;</b></td>
  <td><img src=images/t.gif height=3><br>&nbsp;<font class=listnum><?=$homepage?></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_homepage_end?>

<?=$hide_download1_start?>

<tr>
  <td height=23 align=right class=listnum width=100 bgcolor=<?=$view_left_header_color?> class=view_left_menu><b>File #1&nbsp;&nbsp;</b></td>
  <td><img src=images/t.gif height=3><br>&nbsp;<font class=listnum><?=$a_file_link1?><?=$file_name1?> (<?=$file_size1?>)</a> &nbsp; <font style=font-size:7pt;>Download : <b><?=$file_download1?></b></font></font></td>
</tr>

<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_download1_end?>

<?=$hide_download2_start?>

<tr>
  <td height=23 align=right class=listnum width=100 bgcolor=<?=$view_left_header_color?> class=view_left_menu><b>File #2&nbsp;&nbsp;</b></td>
  <td><img src=images/t.gif height=3><br>&nbsp;<font class=listnum><?=$a_file_link2?><?=$file_name2?> (<?=$file_size2?>)</a> &nbsp; <font style=font-size:7pt;>Download : <b><?=$file_download2?></b></font></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_download2_end?>

<?=$hide_sitelink1_start?>

<tr>
  <td height=23 align=right class=listnum width=100 bgcolor=<?=$view_left_header_color?>  class=view_left_menu><b>Link #1&nbsp;&nbsp;</b></td>
  <td><img src=images/t.gif height=3><br>&nbsp;<font class=listnum><?=$sitelink1?></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink1_end?>

<?=$hide_sitelink2_start?>

<tr>
  <td height=23 align=right class=listnum width=100 bgcolor=<?=$view_left_header_color?>  class=view_left_menu><b>Link #2&nbsp;&nbsp;</b></td>
  <td><img src=images/t.gif height=3><br>&nbsp;<font class=listnum><?=$sitelink2?></font></td>
</tr>
<tr><td bgcolor=#ffffff height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<?=$hide_sitelink2_end?>

<tr>
  <td height=23 align=right class=listnum width=100 bgcolor=<?=$view_left_header_color?> class=view_left_menu style='word-break:break-all;'><b>Subject&nbsp;&nbsp;</b></td>
  <td><img src=images/t.gif height=3><br>&nbsp;<b><?=$hide_category_start?>[<?=$category_name?>] <?=$hide_category_end?><?=$subject?></b></td>
</tr>
<tr><td bgcolor=f0f0f0 height=1 colspan=2><img src=images/t.gif height=1></td></tr>
<tr><td colspan=2 bgcolor=<?=$view_divider?>><img src=images/t.gif height=1></td></tr>
</table>
<table border=0 cellspacing=0 cellpadding=10 width=<?=$width?> style=table-layout:fixed>
<tr>
  <td style='word-break:break-all;' bgcolor=#ffffff valign=top>
    <span style=line-height:160%>
    <?=$upload_image1?><br>
    <?=$upload_image2?><br>
    <!--������� ���� ���� �����Դϴ�-->
    <?=$memo?><br><br>
    <? include "script/sns.php"; ?>
    <br><div align=right style=font-family:Tahoma;font-size:7pt;><?=$ip?></div><br>
    <a href="http://www.ntzn.net/" target="_blank" style="color:blue;">http://www.ntzn.net/</a>
    <!--������� ���� ���� ���Դϴ�-->
    </span>
  </td>
</tr>
</table>

<!-- ������ ��� �����ϴ� �κ� -->
<?=$hide_comment_start?>