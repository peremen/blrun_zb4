<?
  /*
  �� ������ �Խ��ǿ��� ����� ���¸� �����ݴϴ�.
  
  <?=$width?> : �Խ����� ����ũ��
  <?=$dir?> : ��Ų���丮�� ����ŵ�ϴ�.
  <?=$total?> : ��ü �ۼ�
  <?=$total_page?> : ��ü ��������
  <?=$a_status?> : ��踵ũ
  <?=$a_login?> : �α��� ��ư
  <?=$a_logout?> : �α׿�����ư
  <?=$page?> : ���������� ǥ��

  <?=$a_member_join?> : ȸ������
  <?=$a_member_modify?> : ȸ����������
  <?=$a_member_memo?> : ����;;
  <?=$member_memo_icon?> : ����������;;
  <?=$memo_on_sound?> : ������ ������ �Ҹ� ������ ���� memo_on.swf

  <?=$total_connect?> : ���� ��ü ȸ�� �α��μ�
  <?=$group_connect?> : ���� �׷� �α��μ�

  * ������������ member_memo_on.gif, member_memo_off.gif ������ �ֽ��ϴ�. (�⺻)
    member_memo_on.gif�� ���ο� ������ ������, �۰� member_memo_off.gif�� �������� �������Դϴ�;;

  */ 
  // �÷����� �����ϴ� �κ�
  include "$dir/value.php3";
?>

<script language=JavaScript>
function findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}
function swapImage() {
  var i,j=0,x,a=swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>

<!-- HTML ���� -->
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<?=$memo_on_sound?>
<tr>
  <td valign=middle><a href=javascript:void(window.open('member_memo3.php','member_memo','width=450,height=500,status=no,toolbar=no,resizable=yes,scrollbars=yes'))><img src=<?=$dir?>/setup_logedmember.gif border=0 align=absmiddle></a></td>
  <td valign=bottom><font class=setup><?=$total_connect?></font></td>
  <td width=100% align=right><?=$a_member_memo?><span onClick="swapImage('memozzz','','<?=$dir?>/member_memo_off.gif',0)"><?=$member_memo_icon?></span></a></td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?>>
<tr>
  <td><img src=<?=$dir?>/setup_total.gif></td>
  <td><font class=setup>&nbsp;<?=$total?></font>&nbsp;</td>
  <td><img src=<?=$dir?>/setup_articles.gif ></td>
  <td><font class=setup>&nbsp;<?=$total_page?></font>&nbsp;</td>
  <td><img src=<?=$dir?>/setup_pages_nowpage.gif></td>
  <td><font class=setup>&nbsp;<?=$page?></font></td>
  <td align=right width=100%>
    <?=$a_member_join?><img src=<?=$dir?>/setup_signin.gif border=0></a>
    <?=$a_member_modify?><img src=<?=$dir?>/setup_userinfo.gif border=0></a>
    <?=$a_member_memo?><img src=<?=$dir?>/setup_memobox.gif border=0></a>
    <?=$a_login?><img src=<?=$dir?>/setup_login.gif border=0></a>
    <?=$a_logout?><img src=<?=$dir?>/setup_logout.gif border=0></a>
    <?=$a_setup?><img src=<?=$dir?>/setup_config.gif border=0></a></td>
</tr>
</table>
<?
if($setup[use_category])
{
?>
<table border=0 width=<?=$width?> cellspacing=0 cellpadding=0>
<tr valign=top>
  <td width=100>
    <? include "include/print_category.php"; ?>

  </td>
  <td align=right width=100%>
<?
  $width="98%";
}
?>