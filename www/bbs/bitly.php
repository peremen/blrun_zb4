<? include "lib.php"; ?>
<meta name="viewport" content="width=device-width">
<?
/* returns the shortened url */
function get_bitly_short_url($url,$login,$appkey,$format='txt') {
	$connectURL = 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$appkey.'&uri='.urlencode($url).'&format='.$format;
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

$social_ref = stripslashes($_zb_url.$_GET['social_ref']);

if($flag != ok) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML lang="ko">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE> blrun's Short_URL for bit.ly</TITLE>
<script language="javascript">
/*
' ------------------------------------------------------------------
' Function    : fc_chk_byte(aro_name)
' Description : 입력한 글자수를 체크
' Argument    : Object Name(글자수를 제한할 컨트롤)
' Return      : 
' ------------------------------------------------------------------
*/
function fc_chk_byte(aro_name,ari_max)
{

   var ls_str     = aro_name.value; // 이벤트가 일어난 컨트롤의 value 값
   var li_str_len = ls_str.length;  // 전체길이

   // 변수초기화
   var li_max      = ari_max; // 제한할 글자수 크기
   var i           = 0;  // for문에 사용
   var li_gap     = 0;  // 캐릭터일 경우는 1 바이트일 경우는 2를 더함
   var li_len      = 0;  // substring하기 위해서 사용
   var ls_one_char = ""; // 한글자씩 검사한다
   var ls_str2     = ""; // 글자수를 초과하면 제한할수 글자전까지만 보여준다.

   for(i=0; i< li_str_len; i++)
   {
	  // 한글자추출
	  ls_one_char = ls_str.charAt(i);

	  /*// 한글이면 2를 더한다.
	  if (escape(ls_one_char).length > 4)
	  {
		 li_gap += 2;
	  }
	  // 그밗의 경우는 1을 더한다.
	  else
	  {
		 li_gap++;
	  }*/

	  li_gap += 1;

	  // 전체 크기가 li_max를 넘지않으면
	  if(li_gap <= li_max)
	  {
		 li_len = li_len + 1;
	  }
   }
   
   // 전체길이를 초과하면
   if(li_gap > li_max)
   {
	  alert( li_max + " 글자를 초과 입력할수 없습니다. \n 초과된 내용은 자동으로 삭제 됩니다. ");
	  ls_str2 = ls_str.mb_substr(0, li_len);
	  aro_name.value = ls_str2;
	  
   }
   aro_name.focus();   
}

</script>

</HEAD>

<BODY>
<font color="red"><b>bit.ly로 URL을 단축시키고 내용과 일정 길이로 결합시키는 프로그램입니다. 덧글수가 부족한 사이트에서 덧글을 쓴 후 네티즌 칼럼에 내용 전체를 올린 후 이 생성기에 붙여넣기 해 결합시키면 적절한 글자수로 단축링크가 들어간 덧글이 생성됩니다.</b></font>
<FORM NAME="form1" METHOD="Post" ACTION="bitly.php?flag=ok">
<b>Long URL: </b><INPUT NAME="l_url" TYPE="Text" SIZE="44" MAXLENGTH="3000" value="<?=$social_ref?>"><br>
<b>최대 글자수(한글): </b><INPUT NAME="max_ch" TYPE="Text" SIZE="11" MAXLENGTH="7" value="139"><br>
<b>자르기 전의 댓글 내용 전체 입력: </b><br>
<textarea name="memo" cols="20" rows="8" style="width:100%" onkeyup="fc_chk_byte(this,form1.max_ch.value-<?=mb_strlen($short_url = get_bitly_short_url($social_ref,'blrun','R_4c90949047276e64cd01c9ad4ce7ee53'))+1?>);"></textarea>
<input type="hidden" name="s_url" value="<?=$short_url?>">
<br><br><INPUT TYPE="Submit" VALUE="변환">
</FORM>
</BODY>
</HTML>
<?
} else {
	$string1 = trim(stripslashes($_POST['s_url']));
	$memo = trim(stripslashes($_POST['memo']));

	if($string1) {
		echo "<textarea name='memo' cols='20' rows='8' style='width:100%'>$memo $string1</textarea>";
	}
}
?>
