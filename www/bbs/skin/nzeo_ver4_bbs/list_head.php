<script language="JavaScript">
function AlertFunc() {
	document.write("<font color='red'>당신 브라우저 안의 세로폭은 : " +  window.innerHeight + " 가로폭은 : " +   window.innerWidth + " 입니다.<br>이 브라우저는 목록 스크롤이 멈출 수 있습니다<br>젤리빈(android 4.1)으로 업그레이드 하거나 돌핀 브라우저를 사용하세요.<br>" + uAgent + "</font>");
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
	<? if($browser=="1"){ ?><td class=title_han width=50 height=30>번호</td><? } ?>
	<?=$hide_category_start?><td width=50 class=title_han nowrap='nowrap'>분류</td><?=$hide_category_end?>
	<td class=title_han>제목</td>
	<? if($browser=="1"){ ?><td width=80 class=title_han>작성자</td><? } ?>
	<? if($browser=="1"){ ?><td width=70 class=title_han>작성일</td><? } ?>
	<? if($browser=="1"){ ?>
	<td width=50 class=title_han><?=$a_vote?><font class=title_han>추천</font></a></td>
	<td width=50 class=title_han><?=$a_hit?><font class=title_han>조회</font></a></td>
	<? } ?>
</tr>

