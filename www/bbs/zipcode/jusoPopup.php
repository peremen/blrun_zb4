<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
<title>���θ� �ּ� �Է�â</title>
<?
	$ADDR['inputYn'] = $_POST['inputYn'];
	$ADDR['roadFullAddr'] = $_POST['roadFullAddr'];
	//$ADDR['roadAddrPart1'] = $_POST['roadAddrPart1'];
	//$ADDR['roadAddrPart2'] = $_POST['roadAddrPart2'];
	//$ADDR['engAddr'] = $_POST['engAddr'];
	//$ADDR['jibunAddr'] = $_POST['jibunAddr'];
	$ADDR['zipNo'] = $_POST['zipNo'];
	//$ADDR['addrDetail'] = $_POST['addrDetail'];
	//$ADDR['admCd'] = $_POST['admCd'];
	//$ADDR['rnMgtSn'] = $_POST['rnMgtSn'];
	//$ADDR['bdMgtSn'] = $_POST['bdMgtSn'];
	$ADDR['num'] = $_GET['num'];
?>
</head>
<script language="javascript">
function init(){
	var url = location.href;
	var confmKey = "U01TX0FVVEgyMDE2MDgwMjE4MjMwODE0MjY4";
	// php.ini �� short_open_tag �� On ���� �����Ǿ� �Ǿ� �ִ� ��� �Ʒ� �ҽ� �ڵ� ���
	var inputYn = "<?=$ADDR['inputYn']?>";
	var num = "<?=$ADDR['num']?>";
	// php.ini �� short_open_tag �� Off ���� �����Ǿ� �Ǿ� �ִ� ��� �Ʒ� �ҽ� �ڵ� ���
	// var inputYn= "<?php echo $ADDR['inputYn']; ?>";
	if(inputYn != "Y"){
		document.form.confmKey.value = confmKey;
		document.form.returnUrl.value = url;
		document.form.action="http://www.juso.go.kr/addrlink/addrLinkUrl.do"; //���ͳݸ�
		document.form.submit();
	}else{
		opener.jusoCallBack("<?=$ADDR[roadFullAddr]?>","<?=$ADDR[zipNo]?>",num);
		window.close();
	}
}
</script>
<body onload="init();">
	<form id="form" name="form" method="post">
		<input type="hidden" id="confmKey" name="confmKey" value=""/>
		<input type="hidden" id="returnUrl" name="returnUrl" value=""/>
		<!-- �ش�ý����� ���ڵ�Ÿ���� EUC-KR�ϰ�쿡�� �߰� START-->
		<input type="hidden" id="encodingType" name="encodingType" value="EUC-KR"/>
		<!-- �ش�ý����� ���ڵ�Ÿ���� EUC-KR�ϰ�쿡�� �߰� END-->
	</form>
</body>
</html>