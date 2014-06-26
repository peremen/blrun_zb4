<meta name="viewport" content="width=device-width">
<?
if($flag != ok) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
  <TITLE> blrun's Short_URL & Long_URL Encoder for bit.ly</TITLE>
 </HEAD>

 <BODY>
  <font color="red"><b>bit.ly URL을 단축, 또는 원래대로 변환시키는 프로그램입니다. 둘 중에 어느 하나를 입력하고 변환을 누르세요! 두 개 동시에 넣고 변환해도 변환이 됩니다. 단 두번째는 단축 URL을 넣어야 합니다</b></font>
  <FORM NAME="form1" METHOD="Post" ACTION="bl.php?flag=ok">
	<b>Long URL: </b><INPUT NAME="l_url" TYPE="Text" SIZE="44" MAXLENGTH="3000"><br>
	<b>Short URL: </b><INPUT NAME="s_url" TYPE="Text" SIZE="22" MAXLENGTH="44">
	<br><br><INPUT TYPE="Submit" VALUE="변환">
  </FORM>
 </BODY>
</HTML>
<?
} else {
	/* returns the shortened url */
	function get_bitly_short_url($url,$login,$appkey,$format='txt') {
		$connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.urlencode($url).'&format='.$format;
		return curl_get_result($connectURL);
	}

	/* returns expanded url */
	function get_bitly_long_url($url,$login,$appkey,$format='txt') {
		$connectURL = 'http://api.bit.ly/v3/expand?login='.$login.'&apiKey='.$appkey.'&shortUrl='.urlencode($url).'&format='.$format;
		return curl_get_result($connectURL);
	}

	/* returns a result form url */
	function curl_get_result($url) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	$string1 = $_POST['l_url'];
	$string2 = $_POST['s_url'];

	if($string1) {
		/* get the short url */
		$short_url = get_bitly_short_url($string1,'blrun','R_4c90949047276e64cd01c9ad4ce7ee53');
		echo $string1."<br>=><input type='text' size='22' value='".$short_url."'><br><br>";
	}
	if($string2) {
		/* get the long url from the short one */
		$long_url = get_bitly_long_url($string2,'blrun','R_4c90949047276e64cd01c9ad4ce7ee53');
		echo $string2."<br>=><input type='text' size='44' value='".$long_url."'>";
	}
}
?>