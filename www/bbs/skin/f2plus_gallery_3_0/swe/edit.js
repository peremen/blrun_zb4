	
//====================[ sw_edit 파일명: edit.js ]====================

var m_level = parseInt(document.getElementById("sw_m_level").value);
var s_grant_html = parseInt(document.getElementById("sw_s_grant_html").value);
var s_use_html = parseInt(document.getElementById("sw_s_use_html").value);
var edit_yn = document.getElementById("sw_edit_yn").value;
var edit_tag_yn = document.getElementById("sw_edit_tag_yn").value;
var sw_edit_use = document.getElementById("sw_edit_use").value;

var pattern = /(\[\w+\_code\:\d+\{[^}]*?\}\]|\[\/\w+\_code\])/gi;
var pattern2 = /\[\/\w+\_code\]/gi;
var matchArray, e_use_html;
var iePattern = /<br[^>]*?><(P|DIV|\/PRE|HR|LI|OL|O:P|UL|TABLE|TBODY|TR|TD|TH|CENTER|H1|H2|H3|H4)([^>]*?)>/gi;
var iePattern2 = /<(HR)([^>]*?)>\s*?<br[^>]*?>/gi;
var iePattern3 = / (?:\r\n|\r|\n)/g;
var ffPattern = /<br[^>]*?><(TBODY|TR|TD)([^>]*?)>/gi;

var uAgent = navigator.userAgent;
var re = new RegExp("rv:11"); //IE11 userAgent값 검출 정규식
var re2 = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})"); //IE6,7,8,9,10 userAgent값 검출 정규식
var DocReadyState = false;
var DocReloadInterval = null;
var memoiW = null;	
var close_id = null;
var which_color = null;
var selectionObj = null;
var sw_no_grant_color = null;
var default_source = "<HEAD><STYLE> body,td,div { font-family:굴림; font-size:10pt; color:#444444; line-height:140%; scrollbar-arrow-color: #CCCCCC; scrollbar-track-color: #EEEEEE; scrollbar-highlight-color: #FFFFFF; scrollbar-shadow-color: #CCCCCC; scrollbar-face-color:#FFFFFF; scrollbar-3dlight-color: #CCCCCC; scrollbar-darkshadow-color: #FFFFFF; margin-top:2px; margin-bottom:0px; margin-left:1px; margin-right:1px; } body { background-color:#FFFFFF; }</STYLE></HEAD>";
var img_mark = new Array('ed_emoticon_img','ed_asword_img','ed_createLink_img','ed_hr_img','ed_urlimage_img','ed_urlmedia_img','ed_print_img','ed_saveas_img','ed_table_img','ed_tablebgcolor_img','ed_height_out_img','ed_height_in_img','ed_height_default_img','ed_newdoc_img','ed_bold_img','ed_italic_img','ed_underline_img','ed_strikethrough_img','ed_fontcolor_img','ed_fontbgcolor_img','ed_selectall_img','ed_cut_img','ed_copy_img','ed_paste_img','ed_search_img','ed_left_img','ed_center_img','ed_right_img','ed_numlist_img','ed_itemlist_img','ed_outdent_img','ed_indent_img');
var img_mark_no_grant = new Array('ed_emoticon_img','ed_asword_img','ed_height_out_img','ed_height_in_img','ed_height_default_img','ed_newdoc_img','ed_print_img','ed_saveas_img','ed_bold_img','ed_italic_img','ed_underline_img','ed_fontcolor_img','ed_fontbgcolor_img','ed_selectall_img','ed_cut_img','ed_copy_img','ed_paste_img','ed_search_img');
var tdbrd_line_0 = "<tr><td class='sw_bg_style_0'></td></tr>";

var baseX;
var baseY;

function htClick()
{
	if (document.getElementById('htChk').checked) {
		ChangeEditMode('text');
	} else {
		ChangeEditMode('html');
	}
}

function CSelection()
{
	this.m_selection = null;
	this.GetSelection = get_selection;
	this.PutSelection = put_selection;
}

function get_selection()
{
	if(this.m_selection != null)
	{
		if(this.m_selection.type != "Control")
		{
			if(re.exec(uAgent) != null)
			{
				//IE11
				this.m_selection.removeAllRanges();
				this.m_selection.addRange(this.range);
			} else {
				//IE8
				if(memoiW.document.body.createTextRange().inRange(this.m_selection) == true)
				{
					this.m_selection.select();
				}
			}
		} else {
			this.m_selection.select();
		}
	}
}

function put_selection()
{
	if(typeof document.selection != "Control") {
		if(re.exec(uAgent) != null)
		{
			//IE11
			this.m_selection = memoiW.window.getSelection();
			this.range = this.m_selection.getRangeAt(0);
		} else {
			//IE8
			this.m_selection = memoiW.document.selection.createRange();
			this.m_selection.type = memoiW.document.selection.type;
		}
	} else {	//Chrome & FF
		this.m_selection = memoiW.window.getSelection();
		this.m_selection.type = typeof memoiW.document.getSelection;
	}
}

function deactivate_handler()
{
	if(DocReadyState)
	{
		selectionObj.PutSelection();
	}
}

function DocReload()
{		
	memoiE = document.getElementById("memoi");
	memoiW = memoiE.contentWindow;

	if(memoiW.document.readyState == "complete")
	{
		clearInterval(DocReloadInterval);
		memoE = document.getElementById("memo");
		DocLoading();
	}
}

function DocLoading()
{
	DocReadyState = true;

	memoiW.document.designMode = "On";
	selectionObj = new CSelection();

	if(edit_tag_yn == "Y" && memoE.value && !memoE.value.match(/(<IMG |<\/A>|<\/P>|<BR>|<BR \/>|<\/TABLE>)/i))
	{
		edit_tag_yn = "N";
	}

	if(edit_tag_yn == "Y")
	{
		var doc = memoiW.document.open("text/html");
		doc.write(default_source + memo2memoi(memoE.value));
		doc.close();
	}
	else
	{
		memoiE.style.display = "none";
		memoE.style.display = "block";

		if(edit_yn == "Y")
		{
			btnStyc();
			document.getElementById("htChk").checked = true;
		}
	}
	//memoiW.focus();
}

function btnStyc()
{
	if((sw_edit_use == "write" || sw_edit_use == "write_comment") && s_use_html > 0)
	{
		ed_fontE = document.getElementById("ed_font");
		ed_fontsizeE = document.getElementById("ed_fontsize");
			
		if(edit_tag_yn == "Y")
		{
			ed_fontE.disabled = false;
			ed_fontsizeE.disabled = false;
		} else {
			ed_fontE.disabled = true;
			ed_fontsizeE.disabled = true;
		}

		for(var i = 0 ; i < img_mark.length ; i++)
		{
			img_get = document.getElementById(img_mark[i]);
			
			if(edit_tag_yn == "Y") {
				if(typeof window.getSelection != "undefined") {
					img_get.style.opacity = ""; /* For Webkit browsers */
				} else if(typeof document.selection != "Control"){
					img_get.style.filter = "";
				}
			} else {
				if(typeof window.getSelection != "undefined") {
					img_get.style.opacity = "0.5"; /* For Webkit browsers */
				} else if(typeof document.selection != "Control"){
					img_get.style.filter = "gray() + alpha(opacity=50)";
				}
			}
		}
	}
	else
	{
		for(var i = 0 ; i < img_mark_no_grant.length ; i++)
		{
			img_get = document.getElementById(img_mark_no_grant[i]);
			
			if(edit_tag_yn == "Y") {
				if(typeof window.getSelection != "undefined") {
					img_get.style.opacity = ""; /* For Webkit browsers */
				} else if(typeof document.selection != "Control"){
					img_get.style.filter = "";
				}
			} else {
				if(typeof window.getSelection != "undefined") {
					img_get.style.opacity = "0.5"; /* For Webkit browsers */
				} else if(typeof document.selection != "Control"){
					img_get.style.filter = "gray() + alpha(opacity=50)";
				}
			}
		}
	}
}

function htmlspecialchars_encode(str){
	str = str.replace(/&amp;/gi,'&amp;amp;');
	str = str.replace(/&#039;/gi,'&amp;#039;');
	str = str.replace(/&quot;/gi,'&amp;quot;');
	str = str.replace(/&nbsp;/gi,'&amp;nbsp;');
	str = str.replace(/&lt;/g,'&amp;lt;').replace(/&gt;/g,'&amp;gt;');
	str = str.replace(/</g,'&lt;').replace(/>/g,'&gt;');
	str = str.replace(/\'/g,'&#039;');
	str = str.replace(/\"/g,'&quot;');

	return str;
}

function htmlspecialchars_decode(str){
	str = str.replace(/&quot;/g,'\"');
	str = str.replace(/&#039;/g,'\'');
	str = str.replace(/&lt;/g,'<').replace(/&gt;/g,'>');
	str = str.replace(/&amp;lt;/g,'&lt;').replace(/&amp;gt;/g,'&gt;');
	str = str.replace(/&amp;nbsp;/gi,'&nbsp;');
	str = str.replace(/&amp;quot;/gi,'&quot;');
	str = str.replace(/&amp;#039;/gi,'&#039;');
	str = str.replace(/&amp;/gi,'&');

	return str;
}

function brAddFix(str,use_html) {
	if(use_html < 2) {
		if(typeof window.getSelection != "undefined") //FF
		{
			str = str.replace(/\n/gi,"<br />");
			str = str.replace(ffPattern,"<$1$2>");
		}
		else if(typeof document.selection != "Control") //IE
		{
			str = str.replace(/\n/gi,"<br />");
			str = str.replace(iePattern,"<$1$2>");
			str = str.replace(iePattern2,"<$1$2>");
			str = str.replace(iePattern3,"");
		}
	}
	return str;
}

function brRemove(str,use_html) {
	if(use_html < 2) {
		str = str.replace(/<br \/>|<br>/gi,"\n");
		str = str.replace(iePattern3,"\n");
	}
	return str;
}

function memo2memoi(str){

	if(sw_edit_use == "write")
		e_use_html = parseInt(document.getElementById("use_html").value);
	else
		e_use_html = parseInt(document.getElementById("use_html2").value);

	var memo = "", temp, pt = 0;
	if(str.match(pattern) == null) {
		memo = brAddFix(str,e_use_html);
	} else {
		while((matchArray = pattern.exec(str)) != null){
			temp = str.substring(pt,matchArray.index);
			if(pattern2.test(matchArray[0]) == true) {
				temp = htmlspecialchars_encode(temp);
				temp = brAddFix(temp,e_use_html);
			} else {
				temp = brAddFix(temp,e_use_html);
			}
			memo += temp + matchArray[0];
			pt = matchArray.index + matchArray[0].length;
		}
		temp = str.substring(pt)
		memo += brAddFix(temp,e_use_html);
	}
	if(e_use_html < 2) {
		memo = memo.replace(/  /g,'&nbsp;&nbsp;');
		memo = memo.replace(/\t/g,'&nbsp;&nbsp;&nbsp;&nbsp;');
	}

	return memo;
}

function memoi2memo(str){

	if(sw_edit_use == "write")
		e_use_html = parseInt(document.getElementById("use_html").value);
	else
		e_use_html = parseInt(document.getElementById("use_html2").value);

	var memo = "", temp, pt = 0;
	if(e_use_html < 2) {
		str = str.replace(/&nbsp;&nbsp;&nbsp;&nbsp;/gi,'\t');
		str = str.replace(/&nbsp;&nbsp;/gi,'  ');
	}
	if(str.match(pattern) == null) {
		memo = brRemove(str,e_use_html);
	} else {
		while((matchArray = pattern.exec(str)) != null){
			temp = str.substring(pt,matchArray.index);
			if(pattern2.test(matchArray[0]) == true) {
				temp = brRemove(temp,e_use_html);
				temp = htmlspecialchars_decode(temp);
			} else {
				temp = brRemove(temp,e_use_html);
			}
			memo += temp + matchArray[0];
			pt = matchArray.index + matchArray[0].length;
		}
		temp = str.substring(pt)
		memo += brRemove(temp,e_use_html);
	}

	return memo;
}

function ChangeEditMode(mode)
{
	if(mode == "html")
	{
		edit_tag_yn = "Y";

		var doc = memoiW.document.open("text/html", "replace");
		doc.write(default_source + memo2memoi(memoE.value));
		doc.close();

		memoiE.style.display = "block";
		memoE.style.display = "none";

		selectionObj.m_selection = null;

		memoiW.focus();
	}
	else
	{
		edit_tag_yn = "N";

		memoE.value = memoi2memo(memoiW.document.body.innerHTML);

		memoiE.style.display = "none";
		memoE.style.display = "block";

		memoE.focus();
	}

	if(edit_yn == "Y")
	{
		btnStyc();
	}
}

function buttonover(td)
{
	if(edit_tag_yn == "Y") {
		td.style.filter='glow(color=#FF0000 strength=1)';
	}
}

function buttonout(td)
{
	if(edit_tag_yn == "Y") {
		td.style.filter='';
	}
}

function command(obj,myEvent)
{
	if(edit_tag_yn == "N") {
		return true;
	}

	memoiW.focus();
	
	if(selectionObj.m_selection != null)
	{
		selectionObj.GetSelection();
	}
	
	if(obj.tagName == "SELECT")
	{
		if(obj.id == "ed_font")
		{
			if(obj.selectedIndex != 0)
			{
				memoiW.document.execCommand("FontName", null, obj.options[obj.selectedIndex].value);
				obj.options[obj.selectedIndex].selected = true;
			}
		} 
		if(obj.id == "ed_fontsize")
		{
			if(obj.selectedIndex != 0)
			{
				memoiW.document.execCommand("FontSize", null, obj.options[obj.selectedIndex].value);
				obj.options[obj.selectedIndex].selected = true;
			}
		}
	} else {
		switch (obj.id) {
			case ("ed_selectall") :
				commandClick("SelectAll");
				break;
			case ("ed_cut") :
				commandClick("Cut");
				break;
			case ("ed_copy") :
				commandClick("Copy");
				break;
			case ("ed_paste") :
				commandClick("Paste");
				break;
			case ("ed_bold") :
				commandClick("Bold");
				break;
			case ("ed_italic") :
				commandClick("Italic");
				break;
			case ("ed_underline") :
				commandClick("Underline");
				break;
			case ("ed_strikethrough") :
				commandClick("strikethrough");
				break;
			case ("ed_left") :
				commandClick("JustifyLeft");
				break;
			case ("ed_center") :
				commandClick("JustifyCenter");
				break;
			case ("ed_right") :
				commandClick("JustifyRight");
				break;
			case ("ed_numlist") :
				commandClick("InsertOrderedList");
				break;
			case ("ed_itemlist") :
				commandClick("InsertUnorderedList");
				break;
			case ("ed_outdent") :
				commandClick("Outdent");
				break;
			case ("ed_indent") :
				commandClick("Indent");
				break;
			case ("ed_saveas") :
				commandClick("SaveAs","noname.html");
				break;
			case ("ed_print") :
				commandClick("Print");
				break;
			case ("ed_height_out") :
				edit_window_size('height_out');
				break;
			case ("ed_height_in") :
				edit_window_size('height_in');
				break;
			case ("ed_height_default") :
				edit_window_size('height_default');
				break;
			case ("ed_table") :
				make_table(myEvent);
				break;
			case ("ed_fontcolor") :
			{
				which_color = obj.id;
				select_color(myEvent);
				break;
			}
			case ("ed_fontbgcolor") :
			{
				which_color = obj.id;
				select_color(myEvent);
				break;
			}
			case ("ed_tablebgcolor") :
			{
				which_color = obj.id;
				select_color(myEvent);
				break;
			}
			case ("ed_hr") :
			{
				if(typeof document.selection != "Control") {
					if(re.exec(uAgent) != null)
					{
						//IE11
						var eEdit = memoiW.window.getSelection().getRangeAt(0);
						eEdit.deleteContents(); 
						eEdit.insertNode(eEdit.createContextualFragment("<hr size='1' color='#CCCCCC'>"));
					} else if(re2.exec(uAgent) != null) {
						//IE8
						var eEdit = memoiW.document.selection.createRange();
						eEdit.pasteHTML("<hr size='1' color='#CCCCCC'>");
					} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
						memoiW.document.execCommand("InsertHTML",false,"<hr size='1' color='#CCCCCC'>");
					}
				} else {	//Chrome & FF
					memoiW.document.execCommand("InsertHTML",false,"<hr size='1' color='#CCCCCC'>");
				}
				break;
			}
			case ("ed_createLink") :
			{
				Layer_hidden(ed_createLinkdiv);
				Layer_xy(ed_createLinkdiv,'',0,+10,myEvent);

				var URL_link = memoiW.document.selection.createRange().htmlText;
				var re3 = new RegExp("<A href=\"*\"", "gi");
				var result = re3.exec(URL_link);
				if (result != null)
				{
					url = URL_link.substring(URL_link.indexOf("<A href=\"")+9);
					url = url.substring(0, url.indexOf("\""));
					document.getElementById("hyper_layer").value = url;
				}
				break;
			}
			case ("ed_search") :
			{
				Layer_hidden(ed_searchdiv);
				Layer_xy(ed_searchdiv,'',0,-90,myEvent);
				break;
			}
			case ("ed_urlimage") :
			{
				Layer_hidden(ed_Url_Imagediv);
				Layer_xy(ed_Url_Imagediv,'',0,+10,myEvent);
				break;
			}
			case ("ed_urlmedia") :
			{
				Layer_hidden(ed_Url_mediadiv);
				Layer_xy(ed_Url_mediadiv,'',0,+10,myEvent);
				break;
			}
			case ("ed_emoticon") :
			{
				Layer_hidden(ed_emoticondiv);
				Layer_xy(ed_emoticondiv,'ed_emoticontable',0,+10,myEvent);
				break;
			}
			case ("ed_asword") :
			{
				Layer_hidden(ed_asworddiv);
				Layer_xy(ed_asworddiv,'ed_aswordtable',0,+10,myEvent);
				break;
			}
			case ("ed_newdoc") :
			{
				if(memoiW.document.body.innerHTML)
				{
					if(confirm("작성을 취소하시겠습니까?")) {
						var doc = memoiW.document.open("text/html", "replace");
						doc.write(default_source);
						doc.close();
					}
				} else {
					alert("입력된 내용이 없습니다.");
				}
				break;
			}
		}
	}
}

function command_no_grant(obj,myEvent)
{
	if(edit_tag_yn == "N") {
		return true;
	}

	memoiW.focus();

	if(selectionObj.m_selection != null)
	{
		selectionObj.GetSelection();
	}

	switch (obj.id) {
		case ("ed_selectall") :
			commandClick_no_grant("SelectAll");
			break;
		case ("ed_cut") :
			commandClick_no_grant("Cut");
			break;
		case ("ed_copy") :
			commandClick_no_grant("Copy");
			break;
		case ("ed_paste") :
			commandClick_no_grant("Paste");
			break;
		case ("ed_saveas") :
			commandClick_no_grant("SaveAs","noname.html");
			break;
		case ("ed_print") :
			commandClick_no_grant("Print");
			break;
		case ("ed_height_out") :
			edit_window_size('height_out');
			break;
		case ("ed_height_in") :
			edit_window_size('height_in');
			break;
		case ("ed_height_default") :
			edit_window_size('height_default');
			break;
		case ("ed_bold") :
		{
			if(typeof document.selection != "Control") {
				if(re.exec(uAgent) != null)
				{
					//IE11
					var insertCMD = memoiW.window.getSelection().getRangeAt(0);
					var eSel = insertCMD.toString();
					insertCMD.deleteContents();
					insertCMD.insertNode(insertCMD.createContextualFragment("[SW_B#]" + eSel + "[#SW_B]"));
				} else if(re2.exec(uAgent) != null) {
					//IE8
					var insertCMD = memoiW.document.selection.createRange();
					insertCMD.pasteHTML("[SW_B#]" + insertCMD.text + "[#SW_B]");
				} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
					var insertCMD = memoiW.window.getSelection().getRangeAt(0);
					var eSel = insertCMD.toString();
					insertCMD.deleteContents();
					memoiW.document.execCommand("InsertHTML",false,"[SW_B#]" + eSel + "[#SW_B]");
				}
			} else {	//Chrome & FF
				var insertCMD = memoiW.window.getSelection().getRangeAt(0);
				var eSel = insertCMD.toString();
				insertCMD.deleteContents();
				memoiW.document.execCommand("InsertHTML",false,"[SW_B#]" + eSel + "[#SW_B]");
			}
			break;
		}
		case ("ed_italic") :
		{
			if(typeof document.selection != "Control") {
				if(re.exec(uAgent) != null)
				{
					//IE11
					var insertCMD = memoiW.window.getSelection().getRangeAt(0);
					var eSel = insertCMD.toString();
					insertCMD.deleteContents();
					insertCMD.insertNode(insertCMD.createContextualFragment("[SW_I#]" + eSel + "[#SW_I]"));
				} else if(re2.exec(uAgent) != null) {
					//IE8
					var insertCMD = memoiW.document.selection.createRange();
					insertCMD.pasteHTML("[SW_I#]" + insertCMD.text + "[#SW_I]");
				} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
					var insertCMD = memoiW.window.getSelection().getRangeAt(0);
					var eSel = insertCMD.toString();
					insertCMD.deleteContents();
					memoiW.document.execCommand("InsertHTML",false,"[SW_I#]" + eSel + "[#SW_I]");
				}
			} else {	//Chrome & FF
				var insertCMD = memoiW.window.getSelection().getRangeAt(0);
				var eSel = insertCMD.toString();
				insertCMD.deleteContents();
				memoiW.document.execCommand("InsertHTML",false,"[SW_I#]" + eSel + "[#SW_I]");
			}
			break;
		}
		case ("ed_underline") :
		{
			if(typeof document.selection != "Control") {
				if(re.exec(uAgent) != null)
				{
					//IE11
					var insertCMD = memoiW.window.getSelection().getRangeAt(0);
					var eSel = insertCMD.toString();
					insertCMD.deleteContents();
					insertCMD.insertNode(insertCMD.createContextualFragment("[SW_U#]" + eSel + "[#SW_U]"));
				} else if(re2.exec(uAgent) != null) {
					//IE8
					var insertCMD = memoiW.document.selection.createRange();
					insertCMD.pasteHTML("[SW_U#]" + insertCMD.text + "[#SW_U]");
				} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
					var insertCMD = memoiW.window.getSelection().getRangeAt(0);
					var eSel = insertCMD.toString();
					insertCMD.deleteContents();
					memoiW.document.execCommand("InsertHTML",false,"[SW_U#]" + eSel + "[#SW_U]");
				}
			} else {	//Chrome & FF
				var insertCMD = memoiW.window.getSelection().getRangeAt(0);
				var eSel = insertCMD.toString();
				insertCMD.deleteContents();
				memoiW.document.execCommand("InsertHTML",false,"[SW_U#]" + eSel + "[#SW_U]");
			}
			break;
		}
		case ("ed_fontcolor") :
		{
			Layer_hidden(ed_colordiv);
			Layer_xy(ed_colordiv,'ed_colortable',-30,0,myEvent);
			sw_no_grant_color = "sw_fontcolor";
			break;
		}
		case ("ed_fontbgcolor") :
		{
			Layer_hidden(ed_colordiv);
			Layer_xy(ed_colordiv,'ed_colortable',-30,0,myEvent);
			sw_no_grant_color = "sw_fontbgcolor";
			break;
		}
		case ("ed_search") :
		{
			Layer_hidden(ed_searchdiv);
			Layer_xy(ed_searchdiv,'',0,-90,myEvent);
			break;
		}
		case ("ed_emoticon") :
		{
			Layer_hidden(ed_emoticondiv);
			Layer_xy(ed_emoticondiv,'ed_emoticontable',0,+10,myEvent);
			break;
		}
		case ("ed_asword") :
		{
			Layer_hidden(ed_asworddiv);
			Layer_xy(ed_asworddiv,'ed_aswordtable',0,+10,myEvent);
			break;
		}
		case ("ed_newdoc") :
		{
			if(memoiW.document.body.innerHTML)
			{
				if(confirm("작성을 취소하시겠습니까?")) {
					var doc = memoiW.document.open("text/html", "replace");
					doc.write(default_source);
					doc.close();
				}
			} else {
				alert("입력된 내용이 없습니다.");
			}
			break;
		}
	}
}

function commandClick(obj,objcmd)
{
	memoiW.focus();

	if(objcmd == null) {
		memoiW.document.execCommand(obj);
	} else {
		memoiW.document.execCommand(obj, false, objcmd);
	}
}

function commandClick_no_grant(obj,objcmd)
{
	memoiW.focus();

	if(objcmd == null) {
		memoiW.document.execCommand(obj);
	} else {
		memoiW.document.execCommand(obj, false, objcmd);
	}
}

function layerClick(obj,objcmd)
{
	memoiW.focus();

	if(selectionObj.m_selection != null)
	{
		selectionObj.GetSelection();
	}

	if(objcmd == "div_clear")
	{
		switch (obj.id) {
			case ("ed_Url_Imagediv") :
				ed_Url_Imagediv.style.visibility = "hidden";
				break;
			case ("ed_Url_mediadiv") :
				ed_Url_mediadiv.style.visibility = "hidden";
				break;
			case ("ed_createLinkdiv") :
				ed_createLinkdiv.style.visibility = "hidden";
				break;
			case ("ed_searchdiv") :
				ed_searchdiv.style.visibility = "hidden";
				break;
		}
	} else {
		if(obj.id == "ed_Url_Imagediv")
		{
			var image_url = document.getElementById("urlimage_text").value;
			if(typeof document.selection != "Control") {
				if(re.exec(uAgent) != null)
				{
					//IE11
					var eEdit = memoiW.window.getSelection().getRangeAt(0);
					eEdit.deleteContents(); 
					eEdit.insertNode(eEdit.createContextualFragment("<p><img src='"+image_url+"' border='0'></p>"));
				} else if(re2.exec(uAgent) != null) {
					//IE8
					var eEdit = memoiW.document.selection.createRange();
					eEdit.pasteHTML("<p><img src='"+image_url+"' border='0'></p>");
				} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
					memoiW.document.execCommand("InsertHTML",false,"<p><img src='"+image_url+"' border='0'></p>");
				}
			} else {	//Chrome & FF
				memoiW.document.execCommand("InsertHTML",false,"<p><img src='"+image_url+"' border='0'></p>");
			}
			ed_asworddiv.style.visibility = "hidden";
		}
		if(obj.id == "ed_Url_mediadiv")
		{
			var media_url = document.getElementById("urlmedia_text").value;
			var media_width = document.getElementById("urlmedia_width").value;
			var media_height = document.getElementById("urlmedia_height").value;

			if(document.getElementById("urlmedia_mv").checked == true) {
				if(typeof document.selection != "Control") {
					if(re.exec(uAgent) != null)
					{
						//IE11
						var eEdit = memoiW.window.getSelection().getRangeAt(0);
						eEdit.deleteContents(); 
						eEdit.insertNode(eEdit.createContextualFragment("<p><embed src='"+media_url+"' width='"+media_width+"' height='"+media_height+"' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='0' showcontrols='true' showstatusbar='true' type='application/x-mplayer2' pluginspage='http://www.microsoft.com/windows/mediaplayer/download/default.asp' wmode='transparent' /></p>"));
					} else if(re2.exec(uAgent) != null) {
						//IE8
						var eEdit = memoiW.document.selection.createRange();
						eEdit.pasteHTML("<p><embed src='"+media_url+"' width='"+media_width+"' height='"+media_height+"' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='0' showcontrols='true' showstatusbar='true' type='application/x-mplayer2' pluginspage='http://www.microsoft.com/windows/mediaplayer/download/default.asp' wmode='transparent' /></p>");
					} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
						memoiW.document.execCommand("InsertHTML",false,"<p><embed src='"+media_url+"' width='"+media_width+"' height='"+media_height+"' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='0' showcontrols='true' showstatusbar='true' type='application/x-mplayer2' pluginspage='http://www.microsoft.com/windows/mediaplayer/download/default.asp' wmode='transparent' /></p>");
					}
				} else {	//Chrome & FF
					memoiW.document.execCommand("InsertHTML",false,"<p><embed src='"+media_url+"' width='"+media_width+"' height='"+media_height+"' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='0' showcontrols='true' showstatusbar='true' type='application/x-mplayer2' pluginspage='http://www.microsoft.com/windows/mediaplayer/download/default.asp' wmode='transparent' /></p>");
				}
			} else {
				if(media_url.match(/(.SWF)$/i)) {
					if(typeof document.selection != "Control") {
						if(re.exec(uAgent) != null)
						{
							//IE11
							var eEdit = memoiW.window.getSelection().getRangeAt(0);
							eEdit.deleteContents(); 
							eEdit.insertNode(eEdit.createContextualFragment("<p><embed src='"+media_url+"' quality='high' width='"+media_width+"' height='"+media_height+"' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' wmode='transparent' /></p>"));
						} else if(re2.exec(uAgent) != null) {
							//IE8
							var eEdit = memoiW.document.selection.createRange();
							eEdit.pasteHTML("<p><embed src='"+media_url+"' quality='high' width='"+media_width+"' height='"+media_height+"' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' wmode='transparent' /></p>");
						} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
							memoiW.document.execCommand("InsertHTML",false,"<p><embed src='"+media_url+"' quality='high' width='"+media_width+"' height='"+media_height+"' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' wmode='transparent' /></p>");
						}
					} else {	//Chrome & FF
						memoiW.document.execCommand("InsertHTML",false,"<p><embed src='"+media_url+"' quality='high' width='"+media_width+"' height='"+media_height+"' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' wmode='transparent' /></p>");
					}
				} else {
					if(typeof document.selection != "Control") {
						if(re.exec(uAgent) != null)
						{
							//IE11
							var eEdit = memoiW.window.getSelection().getRangeAt(0);
							eEdit.deleteContents(); 
							eEdit.insertNode(eEdit.createContextualFragment("<p><embed src='"+media_url+"' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='0' showcontrols='true' showstatusbar='true' type='application/x-mplayer2' pluginspage='http://www.microsoft.com/windows/mediaplayer/download/default.asp' wmode='transparent' /></p>"));
						} else if(re2.exec(uAgent) != null) {
							//IE8
							var eEdit = memoiW.document.selection.createRange();
							eEdit.pasteHTML("<p><embed src='"+media_url+"' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='0' showcontrols='true' showstatusbar='true' type='application/x-mplayer2' pluginspage='http://www.microsoft.com/windows/mediaplayer/download/default.asp' wmode='transparent' /></p>");
						} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
							memoiW.document.execCommand("InsertHTML",false,"<p><embed src='"+media_url+"' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='0' showcontrols='true' showstatusbar='true' type='application/x-mplayer2' pluginspage='http://www.microsoft.com/windows/mediaplayer/download/default.asp' wmode='transparent' /></p>");
						}
					} else {	//Chrome & FF
						memoiW.document.execCommand("InsertHTML",false,"<p><embed src='"+media_url+"' showtracker='true' showpositioncontrols='true' EnableContextMenu='false' loop='false' autostart='false' volume='0' showcontrols='true' showstatusbar='true' type='application/x-mplayer2' pluginspage='http://www.microsoft.com/windows/mediaplayer/download/default.asp' wmode='transparent' /></p>");
					}
				}
			}
			ed_Url_mediadiv.style.visibility = "hidden";
		}
		if(obj.id == "ed_createLinkdiv")
		{
			var hyper_link = document.getElementById("hyper_layer").value;
			memoiW.document.execCommand("UnLink", false, "");
			memoiW.document.execCommand("CreateLink", false, hyper_link);
		
			var tagsLink = memoiW.document.getElementsByTagName("a");
			//alert(tagsLink[0]);
			for (var i = 0; i < tagsLink.length; i++) { 
				var target = tagsLink[i].target;
				if (!target) {
					tagsLink[i].target = '_blank';
				}
			}

			document.getElementById("hyper_layer").value = "http://";
			ed_createLinkdiv.style.visibility = "hidden";
		}
		if(obj.id == "ed_emoticondiv")
		{
			var emoticon = emoticon_dir + "emtc_" + emoIcon[0][objcmd] + ".gif";
			memoiW.document.execCommand("InsertImage", false, emoticon);
			ed_emoticondiv.style.visibility = "hidden";
		}
		if(obj.id == "ed_asworddiv")
		{
			if(typeof document.selection != "Control") {
				if(re.exec(uAgent) != null)
				{
					//IE11
					var eEdit = memoiW.window.getSelection().getRangeAt(0);
					eEdit.deleteContents(); 
					eEdit.insertNode(eEdit.createContextualFragment(objcmd));
				} else if(re2.exec(uAgent) != null) {
					//IE8
					var eEdit = memoiW.document.selection.createRange();
					eEdit.pasteHTML([objcmd]);
				} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
					memoiW.document.execCommand("InsertHTML",false,[objcmd]);
				}
			} else {	//Chrome & FF
				memoiW.document.execCommand("InsertHTML",false,[objcmd]);
			}
			ed_asworddiv.style.visibility = "hidden";
		}
		if(obj.id == "ed_searchdiv")
		{
			SearchText();
		}
	}
}

function layerClick_no_grant(obj,objcmd)
{
	memoiW.focus();

	if(selectionObj.m_selection != null)
	{
		selectionObj.GetSelection();
	}

	if(objcmd == "div_clear")
	{
		switch (obj.id) {
			case ("ed_searchdiv") :
				ed_searchdiv.style.visibility = "hidden";
				break;
		}
	} else {
		if(obj.id == "ed_emoticondiv")
		{
			if(typeof document.selection != "Control") {
				if(re.exec(uAgent) != null)
				{
					//IE11
					var eEdit = memoiW.window.getSelection().getRangeAt(0);
					eEdit.deleteContents(); 
					eEdit.insertNode(eEdit.createContextualFragment("[SW_EMTC" + objcmd + "]"));
				} else if(re2.exec(uAgent) != null) {
					//IE8
					var eEdit = memoiW.document.selection.createRange();
					eEdit.pasteHTML("[SW_EMTC" + [objcmd] + "]");
				} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
					memoiW.document.execCommand("InsertHTML",false,"[SW_EMTC" + [objcmd] + "]");
				}
			} else {	//Chrome & FF
				memoiW.document.execCommand("InsertHTML",false,"[SW_EMTC" + [objcmd] + "]");
			}
			ed_emoticondiv.style.visibility = "hidden";
		}
		if(obj.id == "ed_colordiv")
		{
			if(typeof document.selection != "Control") {
				if(re.exec(uAgent) != null)
				{
					//IE11
					var eEdit = memoiW.window.getSelection().getRangeAt(0);
					var eSel = eEdit.toString();
					eEdit.deleteContents();
					if(sw_no_grant_color == "sw_fontcolor") {
						eEdit.insertNode(eEdit.createContextualFragment("[" + objcmd + "_FC#]" + eSel + "[#FC_" + objcmd + "]"));
					} else {
						eEdit.insertNode(eEdit.createContextualFragment("[" + objcmd + "_FB#]" + eSel + "[#FB_" + objcmd + "]"));
					}
				} else if(re2.exec(uAgent) != null) {
					//IE8
					if(sw_no_grant_color == "sw_fontcolor") {
						var eEdit = memoiW.document.selection.createRange();
						eEdit.pasteHTML("[" + [objcmd] + "_FC#]" + eEdit.text + "[#FC_" + [objcmd] + "]");
					} else {
						var eEdit = memoiW.document.selection.createRange();
						eEdit.pasteHTML("[" + [objcmd] + "_FB#]" + eEdit.text + "[#FB_" + [objcmd] + "]");
					}
				} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
					var eEdit = memoiW.window.getSelection().getRangeAt(0);
					var eSel = eEdit.toString();
					eEdit.deleteContents();
					if(sw_no_grant_color == "sw_fontcolor") {
						memoiW.document.execCommand("InsertHTML",false,"[" + [objcmd] + "_FC#]" + eSel + "[#FC_" + [objcmd] + "]");
					} else {
						memoiW.document.execCommand("InsertHTML",false,"[" + [objcmd] + "_FB#]" + eSel + "[#FB_" + [objcmd] + "]");
					}
				}
			} else {	//Chrome & FF
				var eEdit = memoiW.window.getSelection().getRangeAt(0);
				var eSel = eEdit.toString();
				eEdit.deleteContents();
				if(sw_no_grant_color == "sw_fontcolor") {
					memoiW.document.execCommand("InsertHTML",false,"[" + [objcmd] + "_FC#]" + eSel + "[#FC_" + [objcmd] + "]");
				} else {
					memoiW.document.execCommand("InsertHTML",false,"[" + [objcmd] + "_FB#]" + eSel + "[#FB_" + [objcmd] + "]");
				}
			}
			ed_colordiv.style.visibility = "hidden";
		}
		if(obj.id == "ed_searchdiv")
		{
			SearchText();
		}
	}
}

function Layer_hidden(obj)
{
	if((sw_edit_use == "write" || sw_edit_use == "write_comment") && s_use_html > 0)
	{
		var sw_Layers = new Array('ed_searchdiv','ed_emoticondiv','ed_asworddiv','ed_Url_Imagediv','ed_Url_mediadiv','ed_createLinkdiv','ed_cellsdiv','ed_colordiv');
	} else {
		var sw_Layers = new Array('ed_searchdiv','ed_emoticondiv','ed_asworddiv','ed_colordiv');
	}

	for(var i = 0 ; i < sw_Layers.length ; i++)
	{
		if(obj != sw_Layers[i])
		{
			LayerView = document.getElementById(sw_Layers[i]);
			LayerView.style.visibility = "hidden";
		}
	}
}

function Layer_xy(obj,objt,lpx,lpy,myEvent)
{
	var scrollLeft = (document.documentElement && document.documentElement.scrollLeft) || document.body.scrollLeft;
	var scrollTop = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;

	obj.style.left = (myEvent.clientX + scrollLeft + lpx) + "px";
	obj.style.top = (myEvent.clientY + scrollTop + lpy) + "px";
	obj.style.visibility = "visible";

	if(objt) {
		start_timeout(document.getElementById(objt));
	}
}

function edit_window_size(window_size)
{
	var last_height = parseInt(edit_windowdiv.style.height);
	if(window_size == "height_in") {
		edit_windowdiv.style.height = (last_height + 50) + "px";
	}
	if(window_size == "height_out") {
		edit_windowdiv.style.height = (last_height - 50) + "px";
	}
	if(window_size == "height_default") {
		if(sw_edit_use == "write") {
			edit_windowdiv.style.height = "300px";
		} else {
			edit_windowdiv.style.height = "150px";
		}
	}
}

function make_table(myEvent)
{
	Layer_hidden(ed_cellsdiv);
	Layer_xy(ed_cellsdiv,'ed_cellstable',-10,-100,myEvent);

	baseX = myEvent.clientX+6;
	baseY = myEvent.clientY-98;

	if(typeof window.getSelection != "undefined")
		var collTD = document.getElementById("ed_cellstable");
	else if(typeof document.selection != "Control")
		var collTD = ed_cellstable.all;

	for(i=0 ; i < collTD.length ; i++)
	{
		if(collTD(i).tagName == "TD" && collTD(i).id != "xy_display")
		{
			collTD(i).bgColor = "";
		}
	}
}

var ser_n = 0;

function SearchText()
{
	var str = document.getElementById("Search_text").value;

	var txt, i, found;

	if (str == "") {
		return false;
	}

	txt = memoiW.document.body.createTextRange();

	for(i = 0; i <= ser_n && (found = txt.findText(str)) != false; i++) {
		txt.moveStart("character", 1);
		txt.moveEnd("textedit");
	}
	if (found) {
		txt.moveStart("character", -1);
		txt.findText(str);
		txt.select();
		txt.scrollIntoView();
		ser_n++;
	} else {
		if (ser_n > 0) {
			ser_n = 0;
			SearchText(str);
		} else {
			alert("일치하는 내용이 없습니다.");
		}
	}
	return false;
}

function coloring(td,myEvent)
{
	var i, rowNum, columnNum;
	rowNum = getRowNum(td,myEvent);
	columnNum = getColumnNum(td,myEvent);

	xy_display.innerHTML = "가로:" + columnNum + "&nbsp;&nbsp;세로:" + (11-rowNum);

	if(typeof window.getSelection != "undefined"){
		var collTD = document.getElementById("ed_cellstable").getElementsByTagName("TD");
		for(i=0 ; i < collTD.length ; i++)
		{
			if(collTD[i].id != "xy_display" && Math.ceil((i+1)/10) >= rowNum && (i%10)+1 <= columnNum)
			{
				collTD[i].bgColor = "#888888";
			} else {
				collTD[i].bgColor = "";
			}
		}
	}
	else if(typeof document.selection != "Control"){
		var collTD = ed_cellstable.all;
		for(i=0 ; i < collTD.length ; i++)
		{
			if(collTD(i).tagName == "TD" && collTD(i).id != "xy_display" && Math.ceil(i/11) >= rowNum && (i-1)%11 <= columnNum)
			{
				collTD(i).bgColor = "#888888";
			} else {
				collTD(i).bgColor = "";
			}
		}
	}
}

function selectXY(td,myEvent)
{
	var NumRows = 11-getRowNum(td,myEvent);
	var NumCols = getColumnNum(td,myEvent);
	var strTable = "<TABLE width='100%' border='1' cellpadding='3' cellspacing='0' bordercolor='#CCCCCC' style='border-collapse:collapse;'>\n";

	var widthCols = Math.ceil(100/getColumnNum(td,myEvent))-1;
	var CellAttrs = "width='" + widthCols + "%'";
	
	var i = 0, j = 0;
	for(i = 0 ; i < NumRows ; i++)
	{
		strTable += "<TR>\n";
		for(j = 0 ; j < NumCols ; j++)
		{
			strTable += "<TD " + CellAttrs + ">&nbsp;</TD>\n";
		}		
		strTable += "</TR>\n";
	}
	strTable += "</TABLE>\n";

	if(selectionObj.m_selection != null)
	{
		selectionObj.GetSelection();
	}
	
	if(typeof document.selection != "Control") {
		if(re.exec(uAgent) != null)
		{
			//IE11
			var eEdit = memoiW.window.getSelection().getRangeAt(0);
			eEdit.deleteContents(); 
			eEdit.insertNode(eEdit.createContextualFragment(strTable));
		} else if(re2.exec(uAgent) != null) {
			//IE8
			var eEdit = memoiW.document.selection.createRange();
			eEdit.pasteHTML(strTable);
		} else if(typeof window.getSelection != "undefined") {	//Chrome & FF
			memoiW.document.execCommand("InsertHTML",false,strTable);
		}
	} else {	//Chrome & FF
		memoiW.document.execCommand("InsertHTML",false,strTable);
	}
	close_div(ed_cellsdiv);
}

function getRowNum(td,myEvent)
{
	var gap = myEvent.clientY - baseY;

	var row;
	row = Math.round(gap/15);
	return row;
}

function getColumnNum(td,myEvent)
{
	var gap = myEvent.clientX - baseX;

	var col;
	col = Math.round(gap/16);
	return col;
}

function select_color(myEvent)
{
	Layer_hidden(ed_colordiv);
	Layer_xy(ed_colordiv,'ed_colortable',-95,0,myEvent);

	if(typeof window.getSelection != "undefined")
		var collTD = document.getElementById("ed_colortable");
	else if(typeof document.selection != "Control")
		var collTD = ed_colortable.all;

	for(i=0 ; i < collTD.length ; i++)
	{
		if(collTD(i).tagName == "TD" && collTD(i).id != "color_more")
		{
			collTD(i).borderColor = "";
		}
	}
}

function color_over(color)
{
	ed_selcolor.bgColor = color;
	ed_seltext.innerText = color;
}

function color_click(color)
{
	if(selectionObj.m_selection != null)
	{
		selectionObj.GetSelection();
	}		

	switch (which_color) {
		case ("ed_fontcolor") : {
			memoiW.document.execCommand("ForeColor", false, color);
			break;
		}
		case ("ed_fontbgcolor") : {
			memoiW.document.execCommand("BackColor", false, color);
			break;
		}
		case ("ed_tablebgcolor") : {
			table_color(color);
			break;
		}
	}
		
	which_color = "";
	close_div(ed_colordiv);
}

function table_color(bgColor)
{
	if(memoiW.document.selection.type == "None" || memoiW.document.selection.type == "Text")
	{
		var selectedTD;
		if((selectedTD = isintd(memoiW.document.selection.createRange().parentElement())) != null)
		{
			selectedTD.bgColor = bgColor;
		}
	}
	else if(memoiW.document.selection.type == "Control")
	{
		if(memoiW.document.selection.createRange().item(0).tagName == "TABLE")
		{
			memoiW.document.selection.createRange().item(0).bgColor = bgColor;
		}
	}
}

function isintd(obj)
{
	var i;
	for(i=0 ; i < 100 ; i++)
	{
		if(obj.tagName == "TD")
		{
			return obj;
		} else if(obj.tagName == "TABLE" || obj.tagName == "BODY" || obj.tagName == null) {
			return null;
		} else {
			obj = obj.parentElement;
		}
	}
	return null;
}

function close_div(obj)
{
	obj.style.visibility = "hidden";
	clearTimeout(close_id);
}

function start_timeout(table)
{
	if(close_id != null)
	{
		clearTimeout(close_id);
	}

	switch (table.id) {
		case ("ed_cellstable") : {
			cellsdiv = document.getElementById("ed_cellsdiv");
			close_id = setTimeout("close_div(cellsdiv)",1500);
			break;
		}
		case ("ed_colortable") : {
			colordiv = document.getElementById("ed_colordiv");
			close_id = setTimeout("close_div(colordiv)",1500);
			break;
		}
		case ("ed_emoticontable") : {
			emoticondiv = document.getElementById("ed_emoticondiv");
			close_id = setTimeout("close_div(emoticondiv)",1500);
			break;
		}
		case ("ed_aswordtable") : {
			asworddiv = document.getElementById("ed_asworddiv");
			close_id = setTimeout("close_div(asworddiv)",1500);
			break;
		}
	}
}

function clear_timeout()
{
	clearTimeout(close_id);
	close_id = null;
}

function disp(coords,color)
{
	document.writeln("<area shape='rect' coords='"+coords+"' href=javascript:color_click('"+color+"') onmouseover=color_over('"+color+"');>");
}

function disp_map()
{
	document.writeln("<map name='colmap'>");
	disp('1,1,7,10','#00FF00'); disp('9,1,15,10','#00FF33'); disp('17,1,23,10','#00FF66'); disp('25,1,31,10','#00FF99'); disp('33,1,39,10','#00FFCC'); disp('41,1,47,10','#00FFFF'); disp('49,1,55,10','#33FF00'); disp('57,1,63,10','#33FF33'); disp('65,1,71,10','#33FF66'); disp('73,1,79,10','#33FF99'); disp('81,1,87,10','#33FFCC'); disp('89,1,95,10','#33FFFF'); disp('97,1,103,10','#66FF00'); disp('105,1,111,10','#66FF33'); disp('113,1,119,10','#66FF66'); disp('121,1,127,10','#66FF99'); disp('129,1,135,10','#66FFCC'); disp('137,1,143,10','#66FFFF'); disp('145,1,151,10','#99FF00'); disp('153,1,159,10','#99FF33'); disp('161,1,167,10','#99FF66'); disp('169,1,175,10','#99FF99'); disp('177,1,183,10','#99FFCC'); disp('185,1,191,10','#99FFFF'); disp('193,1,199,10','#CCFF00'); disp('201,1,207,10','#CCFF33'); disp('209,1,215,10','#CCFF66'); disp('217,1,223,10','#CCFF99'); disp('225,1,231,10','#CCFFCC'); disp('233,1,239,10','#CCFFFF'); disp('241,1,247,10','#FFFF00'); disp('249,1,255,10','#FFFF33'); disp('257,1,263,10','#FFFF66'); disp('265,1,271,10','#FFFF99'); disp('273,1,279,10','#FFFFCC'); disp('281,1,287,10','#FFFFFF');
	disp('1,12,7,21','#00CC00'); disp('9,12,15,21','#00CC33'); disp('17,12,23,21','#00CC66'); disp('25,12,31,21','#00CC99'); disp('33,12,39,21','#00CCCC'); disp('41,12,47,21','#00CCFF'); disp('49,12,55,21','#33CC00'); disp('57,12,63,21','#33CC33'); disp('65,12,71,21','#33CC66'); disp('73,12,79,21','#33CC99'); disp('81,12,87,21','#33CCCC'); disp('89,12,95,21','#33CCFF'); disp('97,12,103,21','#66CC00'); disp('105,12,111,21','#66CC33'); disp('113,12,119,21','#66CC66'); disp('121,12,127,21','#66CC99'); disp('129,12,135,21','#66CCCC'); disp('137,12,143,21','#66CCFF'); disp('145,12,151,21','#99CC00'); disp('153,12,159,21','#99CC33'); disp('161,12,167,21','#99CC66'); disp('169,12,175,21','#99CC99'); disp('177,12,183,21','#99CCCC'); disp('185,12,191,21','#99CCFF'); disp('193,12,199,21','#CCCC00'); disp('201,12,207,21','#CCCC33'); disp('209,12,215,21','#CCCC66'); disp('217,12,223,21','#CCCC99'); disp('225,12,231,21','#CCCCCC'); disp('233,12,239,21','#CCCCFF'); disp('241,12,247,21','#FFCC00'); disp('249,12,255,21','#FFCC33'); disp('257,12,263,21','#FFCC66'); disp('265,12,271,21','#FFCC99'); disp('273,12,279,21','#FFCCCC'); disp('281,12,287,21','#FFCCFF');
	disp('1,23,7,32','#009900'); disp('9,23,15,32','#009933'); disp('17,23,23,32','#009966'); disp('25,23,31,32','#009999'); disp('33,23,39,32','#0099CC'); disp('41,23,47,32','#0099FF'); disp('49,23,55,32','#339900'); disp('57,23,63,32','#339933'); disp('65,23,71,32','#339966'); disp('73,23,79,32','#339999'); disp('81,23,87,32','#3399CC'); disp('89,23,95,32','#3399FF'); disp('97,23,103,32','#669900'); disp('105,23,111,32','#669933'); disp('113,23,119,32','#669966'); disp('121,23,127,32','#669999'); disp('129,23,135,32','#6699CC'); disp('137,23,143,32','#6699FF'); disp('145,23,151,32','#999900'); disp('153,23,159,32','#999933'); disp('161,23,167,32','#999966'); disp('169,23,175,32','#999999'); disp('177,23,183,32','#9999CC'); disp('185,23,191,32','#9999FF'); disp('193,23,199,32','#CC9900'); disp('201,23,207,32','#CC9933'); disp('209,23,215,32','#CC9966'); disp('217,23,223,32','#CC9999'); disp('225,23,231,32','#CC99CC'); disp('233,23,239,32','#CC99FF'); disp('241,23,247,32','#FF9900'); disp('249,23,255,32','#FF9933'); disp('257,23,263,32','#FF9966'); disp('265,23,271,32','#FF9999'); disp('273,23,279,32','#FF99CC'); disp('281,23,287,32','#FF99FF');
	disp('1,34,7,43','#006600'); disp('9,34,15,43','#006633'); disp('17,34,23,43','#006666'); disp('25,34,31,43','#006699'); disp('33,34,39,43','#0066CC'); disp('41,34,47,43','#0066FF'); disp('49,34,55,43','#336600'); disp('57,34,63,43','#336633'); disp('65,34,71,43','#336666'); disp('73,34,79,43','#336699'); disp('81,34,87,43','#3366CC'); disp('89,34,95,43','#3366FF'); disp('97,34,103,43','#666600'); disp('105,34,111,43','#666633'); disp('113,34,119,43','#666666'); disp('121,34,127,43','#666699'); disp('129,34,135,43','#6666CC'); disp('137,34,143,43','#6666FF'); disp('145,34,151,43','#996600'); disp('153,34,159,43','#996633'); disp('161,34,167,43','#996666'); disp('169,34,175,43','#996699'); disp('177,34,183,43','#9966CC'); disp('185,34,191,43','#9966FF'); disp('193,34,199,43','#CC6600'); disp('201,34,207,43','#CC6633'); disp('209,34,215,43','#CC6666'); disp('217,34,223,43','#CC6699'); disp('225,34,231,43','#CC66CC'); disp('233,34,239,43','#CC66FF'); disp('241,34,247,43','#FF6600'); disp('249,34,255,43','#FF6633'); disp('257,34,263,43','#FF6666'); disp('265,34,271,43','#FF6699'); disp('273,34,279,43','#FF66CC'); disp('281,34,287,43','#FF66FF');
	disp('1,45,7,54','#003300'); disp('9,45,15,54','#003333'); disp('17,45,23,54','#003366'); disp('25,45,31,54','#003399'); disp('33,45,39,54','#0033CC'); disp('41,45,47,54','#0033FF'); disp('49,45,55,54','#333300'); disp('57,45,63,54','#333333'); disp('65,45,71,54','#333366'); disp('73,45,79,54','#333399'); disp('81,45,87,54','#3333CC'); disp('89,45,95,54','#3333FF'); disp('97,45,103,54','#663300'); disp('105,45,111,54','#663333'); disp('113,45,119,54','#663366'); disp('121,45,127,54','#663399'); disp('129,45,135,54','#6633CC'); disp('137,45,143,54','#6633FF'); disp('145,45,151,54','#993300'); disp('153,45,159,54','#993333'); disp('161,45,167,54','#993366'); disp('169,45,175,54','#993399'); disp('177,45,183,54','#9933CC'); disp('185,45,191,54','#9933FF'); disp('193,45,199,54','#CC3300'); disp('201,45,207,54','#CC3333'); disp('209,45,215,54','#CC3366'); disp('217,45,223,54','#CC3399'); disp('225,45,231,54','#CC33CC'); disp('233,45,239,54','#CC33FF'); disp('241,45,247,54','#FF3300'); disp('249,45,255,54','#FF3333'); disp('257,45,263,54','#FF3366'); disp('265,45,271,54','#FF3399'); disp('273,45,279,54','#FF33CC'); disp('281,45,287,54','#FF33FF');
	disp('1,56,7,65','#000000'); disp('9,56,15,65','#000033'); disp('17,56,23,65','#000066'); disp('25,56,31,65','#000099'); disp('33,56,39,65','#0000CC'); disp('41,56,47,65','#0000FF'); disp('49,56,55,65','#330000'); disp('57,56,63,65','#330033'); disp('65,56,71,65','#330066'); disp('73,56,79,65','#330099'); disp('81,56,87,65','#3300CC'); disp('89,56,95,65','#3300FF'); disp('97,56,103,65','#660000'); disp('105,56,111,65','#660033'); disp('113,56,119,65','#660066'); disp('121,56,127,65','#660099'); disp('129,56,135,65','#6600CC'); disp('137,56,143,65','#6600FF'); disp('145,56,151,65','#990000'); disp('153,56,159,65','#990033'); disp('161,56,167,65','#990066'); disp('169,56,175,65','#990099'); disp('177,56,183,65','#9900CC'); disp('185,56,191,65','#9900FF'); disp('193,56,199,65','#CC0000'); disp('201,56,207,65','#CC0033'); disp('209,56,215,65','#CC0066'); disp('217,56,223,65','#CC0099'); disp('225,56,231,65','#CC00CC'); disp('233,56,239,65','#CC00FF'); disp('241,56,247,65','#FF0000'); disp('249,56,255,65','#FF0033'); disp('257,56,263,65','#FF0066'); disp('265,56,271,65','#FF0099'); disp('273,56,279,65','#FF00CC'); disp('281,56,287,65','#FF00FF');
	document.writeln("</map>");
}

var inasw = new Array();
inasw[0] = new Array('＃','＆','＊','＠','§','※','☆','★','○','●','◎','◇','◆','□','■','△','▲','▽','▼','→','←','↑','↓','↔','〓','◁','◀','▷','▶','♤','♠','♡','♥','♧','♣','⊙','◈','▣','◐','◑','▒','▤','▥','▨','▧','▦','▩','♨','☏','☎','☜','☞','¶','†','‡','↕','↗','↙','↖','↘','♭','♩','♪','♬','㉿','㈜','№','㏇','™','㏂','㏘','℡','®','ª','《','》','『','』','【','】');

var emoIcon = new Array();
emoIcon[0] = new Array('1_0','1_1','1_2','1_3','1_4','1_5','1_6','1_7','1_8','1_9','1_10','1_11','1_12','1_13','1_14','1_15','1_16','1_17','1_18','1_19','1_20','1_21','1_22','1_23','1_24','1_25','1_26','1_27','1_28','1_29','1_30','1_31','1_32','1_33','1_34','1_35','1_36','1_37','1_38','1_39','1_40','1_41','1_42','1_43');
