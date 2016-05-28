<script language='JavaScript'>
var select_obj;
var _keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

function ZB_layerAction(name, status, myEvent) {
	var obj = document.getElementById(name);
	var _tmpx, _tmpy, marginx, marginy;
	
	_tmpx = myEvent.clientX + parseInt(obj.offsetWidth);
	_tmpy = myEvent.clientY + parseInt(obj.offsetHeight);
	_marginx = document.body.clientWidth - _tmpx;
	_marginy = document.body.clientHeight - _tmpy;
 
	var scrollLeft = (document.documentElement && document.documentElement.scrollLeft) || document.body.scrollLeft;
	var scrollTop = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
	
	if (_marginx < 0)
		_tmpx = myEvent.clientX + scrollLeft + _marginx;
	else
		_tmpx = myEvent.clientX + scrollLeft;
	if (_marginy < 0)
		_tmpy = myEvent.clientY + scrollTop + _marginy + 20;
	else
		_tmpy = myEvent.clientY + scrollTop;
 
	obj.style.left = (_tmpx - 13) + "px";
	obj.style.top = (_tmpy - 12) + "px";
 
	if (status == 'visible') {
		if (select_obj) {
			select_obj.style.visibility = 'hidden';
			select_obj = null;
		}
		select_obj = obj;
	} else {
		select_obj = null;
	}
	obj.style.visibility = status;
}

function decode64(input) {
	var output = "";
	var chr1, chr2, chr3;
	var enc1, enc2, enc3, enc4;
	var i = 0;
	input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
	while (i < input.length) {
		enc1 = this._keyStr.indexOf(input.charAt(i++));
		enc2 = this._keyStr.indexOf(input.charAt(i++));
		enc3 = this._keyStr.indexOf(input.charAt(i++));
		enc4 = this._keyStr.indexOf(input.charAt(i++));
		chr1 = (enc1 << 2) | (enc2 >> 4);
		chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
		chr3 = ((enc3 & 3) << 6) | enc4;
		output = output + String.fromCharCode(chr1);
		if (enc3 != 64) {
			output = output + String.fromCharCode(chr2);
		}
		if (enc4 != 64) {
			output = output + String.fromCharCode(chr3);
		}
	}
	output = utf8_decode(output);
	return output;
}

function utf8_decode(utftext) {
	var string = "";
	var i = 0;
	var c = c1 = c2 = 0;
	while (i < utftext.length) {
		c = utftext.charCodeAt(i);
		if (c < 128) {
			string += String.fromCharCode(c);
			i++;
		}
		else if ((c > 191) && (c < 224)) {
			c2 = utftext.charCodeAt(i + 1);
			string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
			i += 2;
		}
		else {
			c2 = utftext.charCodeAt(i + 1);
			c3 = utftext.charCodeAt(i + 2);
			string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
			i += 3;
		}
	}
	return string;
}

function print_ZBlayer(name, homepage, mail, member_no, boardID, writer, traceID, traceType, isAdmin, isMember) {
	var printHeight = 0;
	var printMain="";

	if(homepage) {
		printMain = "<tr onMouseOver=this.style.backgroundColor='#bbbbbb' onMouseOut=this.style.backgroundColor='' onMousedown=window.open('"+homepage+"');><td style=font-family:굴림;font-size:9pt height=18 nowrap='nowrap'>&nbsp;<img src=images/n_homepage.gif border=0 align=absmiddle>&nbsp;&nbsp;홈페이지&nbsp;&nbsp;</td></tr>";
		printHeight = printHeight + 16;
	}
	if(mail) {
		printMain = printMain +	"<tr onMouseOver=this.style.backgroundColor='#bbbbbb' onMouseOut=this.style.backgroundColor='' onMousedown=location.href='mailto:"+decode64(mail)+"';><td style=font-family:굴림;font-size:9pt height=18 nowrap='nowrap'>&nbsp;<img src=images/n_mail.gif border=0 align=absmiddle>&nbsp;&nbsp;메일 보내기&nbsp;&nbsp;</td></tr>";
		printHeight = printHeight + 16;
	}
	if(member_no) {
		if(isMember) {
			printMain = printMain +	"<tr onMouseOver=this.style.backgroundColor='#bbbbbb' onMouseOut=this.style.backgroundColor='' onMousedown=window.open('view_info.php?member_no="+member_no+"','view_info','width=400,height=510,toolbar=no,scrollbars=yes');><td style=font-family:굴림;font-size:9pt height=18 nowrap='nowrap'>&nbsp;<img src=images/n_memo.gif border=0 align=absmiddle>&nbsp;&nbsp;쪽지 보내기&nbsp;&nbsp;</td></tr>";
			printHeight = printHeight + 16;
		}
		printMain = printMain +	"<tr onMouseOver=this.style.backgroundColor='#bbbbbb' onMouseOut=this.style.backgroundColor='' onMousedown=window.open('view_info2.php?member_no="+member_no+"','view_info','width=400,height=510,toolbar=no,scrollbars=yes');><td style=font-family:굴림;font-size:9pt height=18 nowrap='nowrap'>&nbsp;<img src=images/n_information.gif border=0 align=absmiddle>&nbsp;&nbsp;회원정보 보기&nbsp;&nbsp;</td></tr>";
		printHeight = printHeight + 16;
	}
	if(writer) {
		printMain = printMain +	"<tr onMouseOver=this.style.backgroundColor='#bbbbbb' onMouseOut=this.style.backgroundColor='' onMousedown=location.href='zboard.php?id="+boardID+"&sn1=on&sn=on&ss=off&sc=off&keyword="+writer+"';><td style=font-family:굴림;font-size:9pt height=18 nowrap='nowrap'>&nbsp;<img src=images/n_search.gif border=0 align=absmiddle>&nbsp;&nbsp;이름으로 검색&nbsp;&nbsp;</td></tr>";
		printHeight = printHeight + 16;
	}
	if(isAdmin) {
		if(member_no) {
			printMain = printMain +	"<tr onMouseOver=this.style.backgroundColor='#bbbbbb' onMouseOut=this.style.backgroundColor='' onMousedown=window.open('open_window.php?mode=i&str="+member_no+"','ZBremote','width=870,height=500,left=1,top=1,toolbar=no,scrollbars=yes');><td style=font-family:굴림;font-size:9pt height=18 nowrap='nowrap'>&nbsp;<img src=images/n_modify.gif border=0 align=absmiddle>&nbsp;&nbsp;<font color=darkred>회원정보 변경&nbsp;&nbsp;</td></tr>";
			printHeight = printHeight + 16;
		}
		printMain = printMain +	"<tr onMouseOver=this.style.backgroundColor='#bbbbbb' onMouseOut=this.style.backgroundColor='' onMousedown=window.open('open_window.php?mode="+traceType+"&str="+traceID+"','ZBremote','width=870,height=500,left=1,top=1,toolbar=no,scrollbars=yes');><td style=font-family:굴림;font-size:9pt height=18 nowrap='nowrap'>&nbsp;<img src=images/n_relationlist.gif border=0 align=absmiddle>&nbsp;&nbsp;<font color=darkred>관련글 추적</font>&nbsp;&nbsp;</td></tr>";
		printHeight = printHeight + 16;
	
	}
	var printHeader = "<div id='"+name+"' style='position:absolute; left:10px; top:25px; width:127; height: "+printHeight+"; z-index:1; visibility: hidden' onMousedown=ZB_layerAction('"+name+"','hidden',event)><table border=0><tr><td colspan=3 onMouseover=ZB_layerAction('"+name+"','hidden',event) height=3></td></tr><tr><td width=5 onMouseover=ZB_layerAction('"+name+"','hidden',event) rowspan=2>&nbsp;</td><td height=5></td></tr><tr><td><table style=cursor:pointer border='0' cellspacing='1' cellpadding='0' bgcolor='black' width=100% height=100%><tr><td valign=top bgcolor=white><table border=0 cellspacing=0 cellpadding=3 width=100% height=100%>";
	var printFooter = "</table></td></tr></table></td><td width=5 rowspan=2 onMouseover=ZB_layerAction('"+name+"','hidden',event)>&nbsp;</td></tr><tr><td colspan=3 height=10 onMouseover=ZB_layerAction('"+name+"','hidden',event)></td></tr></table></div>";

	document.writeln(printHeader+printMain+printFooter);
}

function category_change(obj) {
var myindex=obj.selectedIndex;
document.search.category.value=obj.options[myindex].value;
document.search.submit();
return true;
}
</script>
