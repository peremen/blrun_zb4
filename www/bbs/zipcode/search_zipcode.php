<?
/*
제로보드용 우편번호 플러그인
만든이: 이수영 (http://nzeo.wo.tc:8080)
본 소스의 무단배포,수정을 금합니다.
*/
require_once "../_head.php";
$dong = trim($_POST['dong']);
	
if(!get_magic_quotes_gpc())
{
	$dong = addslashes($dong);
}

if($dong || $address)
{
	$list_begin = '';
	$list_end = '';
}
else
{
	$list_begin = '<!--';
	$list_end = '-->';
}
	
include("search_ziphead.php");

if($dong)
{
	$dbqry="SELECT * FROM `zetyx_zipcode` WHERE dong like '%$dong%'";
	$rs = mysql_query($dbqry) or die(mysql_error());
	
	while($R=mysql_fetch_array($rs))
	{
		$address1 = "{$R['sido']} {$R['gugun']} {$R['dong']} {$R['bunji']}";
		$address2 = "{$R['sido']} {$R['gugun']} {$R['dong']}";
		$zip_code = $R['zipcode'];
		include("search_zipmain.php");
	}
}
elseif($address)
{
	include("search_zipmain2.php");
}

include("search_zipfoot.php");
?>
