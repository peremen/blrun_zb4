<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>도로명 주소 입력창</title>
<?
	if(empty($_POST['inputYn'])) $ADDR['inputYn'] = '';
	else $ADDR['inputYn'] = $_POST['inputYn'];
	
	if(empty($_POST['roadFullAddr'])) $ADDR['roadFullAddr'] = '';
	else $ADDR['roadFullAddr'] = $_POST['roadFullAddr'];
	//$ADDR['roadAddrPart1'] = $_POST['roadAddrPart1'];
	//$ADDR['roadAddrPart2'] = $_POST['roadAddrPart2'];
	//$ADDR['engAddr'] = $_POST['engAddr'];
	//$ADDR['jibunAddr'] = $_POST['jibunAddr'];
	
	if(empty($_POST['zipNo'])) $ADDR['zipNo'] = '';
	else $ADDR['zipNo'] = $_POST['zipNo'];
	//$ADDR['addrDetail'] = $_POST['addrDetail'];
	//$ADDR['admCd'] = $_POST['admCd'];
	//$ADDR['rnMgtSn'] = $_POST['rnMgtSn'];
	//$ADDR['bdMgtSn'] = $_POST['bdMgtSn'];
	
	if(empty($_GET['num'])) $ADDR['num'] = '';
	else $ADDR['num'] = $_GET['num'];
?>
</head>
<script language="javascript">
function init(){
	var url = location.href;
	var confmKey = "U01TX0FVVEgyMDE2MDgwMjE4MjMwODE0MjY4";
	// php.ini 에 short_open_tag 가 On 으로 설정되어 되어 있는 경우 아래 소스 코드 사용
	var inputYn = "<?=$ADDR['inputYn']?>";
	var num = "<?=$ADDR['num']?>";
	// php.ini 에 short_open_tag 가 Off 으로 설정되어 되어 있는 경우 아래 소스 코드 사용
	// var inputYn= "<?php echo $ADDR['inputYn']; ?>";
	if(inputYn != "Y"){
		document.form.confmKey.value = confmKey;
		document.form.returnUrl.value = url;
		document.form.action="http://www.juso.go.kr/addrlink/addrLinkUrl.do"; //인터넷망
		document.form.submit();
	}else{
		opener.jusoCallBack("<?=$ADDR['roadFullAddr']?>","<?=$ADDR['zipNo']?>",num);
		window.close();
	}
}
</script>
<body onload="init();">
	<form id="form" name="form" method="post">
		<input type="hidden" id="confmKey" name="confmKey" value=""/>
		<input type="hidden" id="returnUrl" name="returnUrl" value=""/>
		<!-- 해당시스템의 인코딩타입이 EUC-KR일경우에만 추가 START-->
		<!--<input type="hidden" id="encodingType" name="encodingType" value="EUC-KR"/>-->
		<!-- 해당시스템의 인코딩타입이 EUC-KR일경우에만 추가 END-->
	</form>
</body>
</html>
