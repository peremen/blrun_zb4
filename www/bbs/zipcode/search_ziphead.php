<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>�����ȣ ã��</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
body {margin: 0px;<?=$list_begin ? 'background-color: #f0f0f0;' : ''?>}
body,td,div,input {font-size: 12px;font-family: Verdana;}

a:link, a:visited {color:#666;font-size: 12px;font-family: Verdana;text-decoration:none;}
a:hover, a:active {color:#008000;font-size: 12px;font-family: Verdana;text-decoration:none;}
</style>
<script type='text/javascript'>
<!--
function check_submit()
{
	/*
	http://nzeo.wo.tc:8080
	*/
	var forms_s = document.forms['w_form'];
	if(!forms_s.dong.value || forms_s.dong.value.split(' ').join('') == '')
	{
	alert("�˻�� �Է��� �ֽʽÿ�.");
	forms_s.dong.value='';
	forms_s.dong.focus();
	return false;
	}
}

function returnmain()
{
	var frm_name = document.forms['ws_form'].frm_name.value;
	var accass = document.forms['ws_form'].accass.value;
	<? if($num == 1) {?>
	var home_address = opener.document.forms['write'].home_address;
	<?} else {?>
	var home_address = opener.document.forms['write'].office_address;
	<?}?>
	
	home_address.value = frm_name+" " +accass;
	home_address.focus();
	self.close();
}
-->
</script>
</head>

<body>
<div align="center" style="padding: 5px;background-color: #009900;font-size:9pt;"> 
<b><span style="color:#ffffff">�����ȣ�� �˻��մϴ�.</span></b></div>
<div align="center" style="background-color: #007900;font-size:1pt;height: 3px;"></div>
  <form name="w_form" method="post" action="<?=$PHP_SELF?>" onsubmit="return check_submit();" style="margin: 0px">
<input name="num" type="hidden" value="<?=$num?>">
<div align="center" style="padding: 14px;background-color: #f0f0f0;font-size:9pt;">
  ã���� �ϴ� ��/��/���� �̸��� �Է��Ͽ� �ֽʽÿ�.<br />
  ( ��: <b>��â��</b> �Ǵ� <b>���θ�</b> �Ǵ� <b>��</b> �Ǵ� <b>��3��</b> )
  <div style="padding-top: 4px"></div>
  <input name="dong" type="text" style="border:1px solid #e1e1e1;vertical-align: middle;background-color: #fff;" size="18" value="<?=$dong?>"<?=$address ? ' readonly' : ''?>> <input type="image" style="border: 0px;vertical-align: middle;width: 20px;height: 20px" src="../images/btn_search.gif"<?=$address ? " onclick=\"alert('���⿡���� ����� �� �����ϴ�.\\n\\n�Ʒ�ĭ�� ������ �ּҸ� �Է����ּ���.');return false\"" : ''?>>
</div>
  </form>
  <div align="center" style="background-color: <?=$list_begin ? 'background-color: #f0f0f0;' : '#E6E6E6;'?>font-size:1pt;height: 2px;"></div>
<?=$list_begin?>
<table border="0" cellspacing="0" cellpadding="0" width="100%">