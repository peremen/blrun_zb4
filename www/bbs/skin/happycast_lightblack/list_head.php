<? /////////////////////////////////////////////////////////////////////////
  /*
  �� ������ ����Ʈ�� ��� �κ��� �����ִ� ���Դϴ�
  <?=$a_ �� ���۵Ǵ� �׸��� HTML�� <a ��� �����Ͻø� �˴ϴ�.
  �ڿ� </a>�� �ٿ��ָ� ����;
  ������ ��Ų ���۽� ����� �ִ� ���� �Դϴ�. �״�� ����Ͻø� �˴ϴ�;;;;

  <?=$width?> : �Խ����� ����ũ��
  <?=$dir?> : ��Ų���丮�� ����ŵ�ϴ�.
  <?=$print_page?> : �������� �����ݴϴ�
  <?=$a_status?> : ��踵ũ
  <?=$a_login?> : �α��� ��ư
  <?=$a_logout?> : �α׿�����ư
  <?=$a_no?> : ��������.. �� ������� ����
  <?=$a_subject?> : ��������
  <?=$a_name?> : �̸�����
  <?=$a_hit?> : ��ȸ�� ����
  <?=$a_vote?> : ��õ�� ����
  <?=$a_date?> : ���ں� ����
  <?=$a_download1?> : ù���� �׸��� �ڷ� �ٿ�ε� ���� ����
  <?=$a_download2?> : �ι�° �׸��� �ڷ� �ٿ�ε� ���� ����
  <?=$a_cart?> : �ٱ��� ���� ��ũ
  <?=$a_category?> : ī�װ� ����

  <?=$a_write?> : �۾��� ��ư
  <?=$a_list?> : ��Ϻ��� ��ư
  <?=$a_reply?> : ��۾��� ��ư
  <?=$a_delete?> : �ۻ��� ��ư
  <?=$a_modify?> : �ۼ��� ��ư
  <?=$a_delete_all?> : �������϶� ��Ÿ���� ���õ� �� ���� ��ư;;

  �ٱ��Ͽ� ī�װ��� ��� ������� �ʴ� ���� �����Ƿ� ���ܳ����� ���� ����;;
  <?=$hide_cart_start?> ���� <?=$hide_cart_end?> : start �� end ���̿��� �����;; �ٱ���
  <?=$hide_category_start?> ���� <?=$hide_category_end?> : Start�� end ���̿��� �����;; �ٱ���
  */ 
?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> style=table-layout:fixed>
<form method=post name=list action=list_all.php><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=selected><input type=hidden name=exec><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>">
<? if($browser=="1"){ ?><col width=30></col><? } ?><?=$hide_cart_start?><col width=20></col><?=$hide_cart_end?><col width=></col><? if($browser=="1"){ ?><col width=90></col><? } ?><? if($browser=="1"){ ?><col width=80></col><? } ?><? if($browser=="1"){ ?><col width=40></col><col width=30></col><? } ?>

<tr align=center>
<? if($browser=="1"){ ?>
  <td width=30>
    <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>>
    <tr>
     <td align=center><?=$a_no?><font class=list_header>no</font></a></td>
    </tr>
    </table>
  </td>
<? } ?>
<?=$hide_cart_start?>

  <td width=20>
    <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>>
    <tr>
      <td align=center><?=$a_cart?><font class=list_header>C</font></a></td>
    </tr>
    </table>
  </td>
<?=$hide_cart_end?>

  <td width=100%>
    <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>>
    <tr>
      <td align=center><?=$a_subject?><font class=list_header>subject</font></a></td>
    </tr>
    </table>
  </td>
<? if($browser=="1"){ ?>
  <td width=90>
    <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>>
    <tr>
      <td align=center><?=$a_name?><font class=list_header>name</font></a></td>
    </tr>
    </table>
  </td>
<? } ?>
<? if($browser=="1"){ ?>
  <td width=80>
    <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>>
    <tr>
      <td align=center><?=$a_date?><font class=list_header>date</font></a></td>
    </tr>
    </table>
  </td>
<? } ?>
<? if($browser=="1"){ ?>
  <td width=40>
    <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>>
    <tr>
      <td align=center><?=$a_hit?><font class=list_header>hit</font></a></td>
    </tr>
    </table>
  </td>
  <td width=30>
    <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=<?=$list_header_bg_color?> bordercolorlight=<?=$list_header_dark0?> bordercolordark=<?=$list_header_dark1?>>
    <tr>
      <td align=center><?=$a_vote?><font class=list_header>*</font></a></td>
    </tr>
    </table>
  </td>
<? } ?>
</tr>
