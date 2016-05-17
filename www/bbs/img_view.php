<?
@header("Content-Type: text/html; charset=ks_c_5601-1987");
@extract($HTTP_GET_VARS);

$img=str_replace('%2F', '/', urlencode("/bbs/".$img));
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<script language="javascript">
<!--
function win_size(img_width,img_height)
{
	window.resizeTo(800, 600);
	if(img_width>screen.width) new_width = window.screen.width;
	else new_width=img_width;

	if(img_height>screen.height-30)
		new_height = window.screen.height-30;
	else new_height=img_height; 

	center_X = (window.screen.width-new_width)/2;
	center_Y = (window.screen.height-new_height)/2;

	window.moveTo(center_X,center_Y-20);
	window.resizeTo(new_width, new_height);
}

var rate_X = <?=$width?>/window.screen.width;
var rate_Y = <?=$height*1.2?>/window.screen.height;

function scroll_img(img_width,img_height,myEvent)
{
	if(window.screen.width<=img_width || window.screen.height-30<=img_height)
		window.scroll(Math.ceil(rate_X*(myEvent.clientX - 30)),Math.ceil(rate_Y*(myEvent.clientY - 30)));
}
-->
</script>
<TITLE>큰 이미지 보기</TITLE>
<meta meta http-equiv="Content-Type" content="text/html; charset=ks_c_5601-1987">
</HEAD>
<BODY topmargin='0' leftmargin='0' marginwidth='0' marginheight='0' onLoad="win_size('<?=$width?>','<?=$height?>')" onmousemove="scroll_img('<?=$width?>','<?=$height?>',event)">
</BODY>
<a href=# onclick=window.close();><img src="<?=$img?>" border=0></a>
</HTML>
