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
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<TITLE> blrun's Short_URL for bit.ly</TITLE>
<script language="javascript">
/*
' ------------------------------------------------------------------
' Function    : fc_chk_byte(aro_name)
' Description : �Է��� ���ڼ��� üũ
' Argument    : Object Name(���ڼ��� ������ ��Ʈ��)
' Return      :
' ------------------------------------------------------------------
*/
function fc_chk_byte(aro_name,ari_max)
{

   var ls_str     = aro_name.value; // �̺�Ʈ�� �Ͼ ��Ʈ���� value ��
   var li_str_len = ls_str.length;  // ��ü����

   // �����ʱ�ȭ
   var li_max      = ari_max; // ������ ���ڼ� ũ��
   var i           = 0;  // for���� ���
   var li_gap     = 0;  // ĳ������ ���� 1 ����Ʈ�� ���� 2�� ����
   var li_len      = 0;  // substring�ϱ� ���ؼ� ���
   var ls_one_char = ""; // �ѱ��ھ� �˻��Ѵ�
   var ls_str2     = ""; // ���ڼ��� �ʰ��ϸ� �����Ҽ� ������������ �����ش�.

   for(i=0; i< li_str_len; i++)
   {
	  // �ѱ�������
	  ls_one_char = ls_str.charAt(i);

	  li_gap += 1;

	  // ��ü ũ�Ⱑ li_max�� ����������
	  if(li_gap <= li_max)
	  {
		 li_len = li_len + 1;
	  }
   }

   // ��ü���̸� �ʰ��ϸ�
   if(li_gap > li_max)
   {
	  alert( li_max + " ���ڸ� �ʰ� �Է��Ҽ� �����ϴ�. \n �ʰ��� ������ �ڵ����� ���� �˴ϴ�. ");
	  ls_str2 = ls_str.substr(0, li_len);
	  aro_name.value = ls_str2;

   }
   aro_name.focus();
}
</script>
</HEAD>

<BODY>
<font color="red"><b>bit.ly�� URL�� �����Ű�� ����� ���� ���̷� ���ս�Ű�� ���α׷��Դϴ�. ���ۼ��� ������ ����Ʈ���� ������ �� �� ��Ƽ�� Į���� ���� ��ü�� �ø� �� �� �����⿡ �ٿ��ֱ� �� ���ս�Ű�� ������ ���ڼ��� ���ีũ�� �� ������ �����˴ϴ�.</b></font>
<FORM NAME="form1" METHOD="Post" ACTION="bitly.php?flag=ok">
<b>Long URL: </b><INPUT NAME="l_url" TYPE="Text" SIZE="44" MAXLENGTH="3000" value="<?=$social_ref?>"><br>
<b>�ִ� ���ڼ�(�ѱ�): </b><INPUT NAME="max_ch" TYPE="Text" SIZE="11" MAXLENGTH="7" value="169"><br>
<b>�ڸ��� ���� ��� ���� ��ü �Է�: </b><br>
<textarea name="memo" cols="20" rows="8" style="width:100%" onkeyup="fc_chk_byte(this,form1.max_ch.value-<?=strlen($short_url = get_bitly_short_url($social_ref,'blrun','R_4c90949047276e64cd01c9ad4ce7ee53'))+1?>);"></textarea>
<input type="hidden" name="s_url" value="<?=$short_url?>">
<br><br><INPUT TYPE="Submit" VALUE="��ȯ">
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