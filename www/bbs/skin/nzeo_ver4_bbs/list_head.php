<script language="JavaScript">
function AlertFunc() {
	document.write("<font color='red'>��� ������ ���� �������� : " +  window.innerHeight + " �������� : " +   window.innerWidth + " �Դϴ�.<br>�� �������� ��� ��ũ���� ���� �� �ֽ��ϴ�<br>������(android 4.1)���� ���׷��̵� �ϰų� ���� �������� ����ϼ���.<br>" + uAgent + "</font>");
}
var uAgent = navigator.userAgent.toLowerCase();
//var webKit = new Array('applewebkit/533.16','applewebkit/534.30','tablet; rv:15.0');
//var safari = new Array('safari/533.16','safari/534.30','firefox/15.0.1');
//for(var i=0;i<webKit.length;i++)
if( uAgent.indexOf("android 4.0.4") != -1 ) {
window.addEventListener("resize", AlertFunc());
//break;
}
//alert(uAgent);
</script>
<?$coloring=0;?>
<table border=0 cellspacing=1 cellpadding=4 width=<?=$width?> style=table-layout:fixed>
<form method=post name=list action=list_all.php>
<input type=hidden name=page value=<?=$page?>>
<input type=hidden name=id value=<?=$id?>>
<input type=hidden name=select_arrange value=<?=$select_arrange?>>
<input type=hidden name=desc value=<?=$desc?>>
<input type=hidden name=page_num value=<?=$page_num?>>
<input type=hidden name=selected>
<input type=hidden name=exec>
<input type=hidden name=keyword value="<?=$keyword?>">
<input type=hidden name=sn value="<?=$sn?>">
<input type=hidden name=ss value="<?=$ss?>">
<input type=hidden name=sc value="<?=$sc?>">
<input type=hidden name=sm value="<?=$sm?>">
<? if($browser=="1"){ ?><col width=50></col><? } ?><?=$hide_category_start?><col width=50></col><?=$hide_category_end?><col width=></col><? if($browser=="1"){ ?><col width=80></col><? } ?><? if($browser=="1"){ ?><col width=70></col><? } ?><? if($browser=="1"){ ?><col width=50></col><col width=50></col><? } ?>
<tr align=center class=title>
	<? if($browser=="1"){ ?><td class=title_han width=50 height=30>��ȣ</td><? } ?>
	<?=$hide_category_start?><td width=50 class=title_han nowrap='nowrap'>�з�</td><?=$hide_category_end?>
	<td class=title_han>����</td>
	<? if($browser=="1"){ ?><td width=80 class=title_han>�ۼ���</td><? } ?>
	<? if($browser=="1"){ ?><td width=70 class=title_han>�ۼ���</td><? } ?>
	<? if($browser=="1"){ ?>
	<td width=50 class=title_han><?=$a_vote?><font class=title_han>��õ</font></a></td>
	<td width=50 class=title_han><?=$a_hit?><font class=title_han>��ȸ</font></a></td>
	<? } ?>
</tr>

