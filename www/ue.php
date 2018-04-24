<?
// 폼을 전송했는지 검사하는 변수
$flag = $_GET['flag'];
if(empty($flag)) $flag = '';

if($flag != "ok") {
header("Content-Type: text/html; charset=UTF-8");
?>
<meta name="viewport" content="width=device-width">
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> Escape 문자 해독하기 </TITLE>
 </HEAD>

 <BODY>
  <h3> Escape 문자 해독하기 </h3>
  <FORM NAME="form1" METHOD="Post" ACTION="ue.php?flag=ok">
	<INPUT NAME="str1" TYPE="Text" SIZE="44" MAXLENGTH="700">
	<INPUT TYPE="Submit" VALUE="전송">
  </FORM>
 </BODY>
</HTML>
<?
} else {
	header("Content-Type: text/html; charset=EUC-KR");
?>
<meta name="viewport" content="width=device-width">
<?
	function JsUnescape($str){
	 return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'JsUnescapeFunc', $str));
	}

	function JsUnescapeFunc($str){
	 return iconv('UTF-16LE', 'UHC', chr(hexdec(substr($str[1], 2, 2))).chr(hexdec(substr($str[1],0,2))));
	}

	function getmicrotime(){
		list($usec, $sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
	}

	$string = $_POST['str1'];
	$time_start = getmicrotime();
	echo "urldecode: ".JsUnescape($string);
	$time = getmicrotime() - $time_start;
	print(iconv("utf-8","euc-kr","<p>수행시간 ( $time 초)</p>"));
}
?>