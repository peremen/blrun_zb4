
//====================[ sw_edit 파일명: layers_no_grant.js ]====================

var sw_layers_ng = new String;
var sw_skins_dir = document.getElementById("sw_skins_dir").value;
var sw_d_zb_self_dir = document.getElementById("sw_d_zb_self_dir").value;

var sw_layers_ng_search = "<div id='ed_searchdiv' style='position:absolute; visibility:hidden;'>";
sw_layers_ng_search += "<table width='180' border='0' cellpadding='0' cellspacing='0' class='sw_bd_style_5'><tr><td style='padding:5;'>";
sw_layers_ng_search += "<input type='text' name='Search_text' id='Search_text' class='text' style='width:100%;' onChange='ser_n = 0;'>";
sw_layers_ng_search += "</td></tr>" + tdbrd_line_0 + "<tr><td style='padding:5;'><table width='100%' border='0' cellpadding='0' cellspacing='0' class='sw_bg_style_1'><tr><td align='center' style='padding:5;' class='sw_ft_style_1'>";
sw_layers_ng_search += "찾을 내용을 입력해주세요.";
sw_layers_ng_search += "</td></tr></table></td></tr>" + tdbrd_line_0 + "<tr><td align='center' style='padding:5;'>";
sw_layers_ng_search += "<a onClick='javascript:layerClick_no_grant(ed_searchdiv);' style='cursor:hand;'><img src=" + sw_skins_dir + "/images/ed_search.gif border='0' style='margin:0 10 0 0;'></a>";
sw_layers_ng_search += "<a onClick='javascript:layerClick_no_grant(ed_searchdiv,\"div_clear\");' style='cursor:hand;'><img src=" + sw_skins_dir + "/images/sw_a_back.gif border='0'></a>";
sw_layers_ng_search += "</td></tr></table></div>";

var sw_layers_ng_emoticon = "<div id='ed_emoticondiv' style='position:absolute; visibility:hidden;'>";
sw_layers_ng_emoticon += "<table id='ed_emoticontable' border='0' cellpadding='0' cellspacing='0' class='sw_bd_style_5' onmousemove='clear_timeout()' onmouseout='start_timeout(this)'><tr><td style='padding:3;'>";
sw_layers_ng_emoticon += "<table width='110' height='130' border='0' cellpadding='2' cellspacing='0'>";

var emoticon_dir = sw_skins_dir + "/images/emoticon/";

function ed_emoticonF()
{
	var e_list = new String;

	for(var i=0 ; i < 40 ; i++)
	{
		if(!(i % 5)) e_list += "<tr>";
		if (emoIcon[0][i] == "blank") {
			e_list += "<td align='center'><img src='"+ emoticon_dir +"emtc_blank.gif' width='15' height='15' border='0'></td>";
		} else {
			e_list += "<td align='center' onClick='javascript:layerClick_no_grant(ed_emoticondiv,"+ [i] +");' onMouseOver=this.className='sw_MouseOver_0' onMouseOut=this.className='sw_MouseOut_0' style='cursor:hand;'><img src='" + emoticon_dir + "emtc_" + emoIcon[0][i] + ".gif' border='0'></td>";
		}
		if(i % 5 == 4) e_list += "</tr>";
	}
	return e_list;
}

sw_layers_ng_emoticon += ed_emoticonF();
sw_layers_ng_emoticon += "</table></td></tr></table></div>";

var sw_layers_ng_asword = "<div id='ed_asworddiv' style='position:absolute; visibility:hidden;'>";
sw_layers_ng_asword += "<table id='ed_aswordtable' border='0' cellpadding='0' cellspacing='0' class='sw_bd_style_5' onmousemove='clear_timeout()' onmouseout='start_timeout(this)'><tr><td style='padding:3;'>";
sw_layers_ng_asword += "<table width='210' height='170' border='0' cellpadding='2' cellspacing='0'>";

function ed_aswordF()
{
	var e_list = new String;

	for(var i=0 ; i < 80 ; i++)
	{
		if(!(i % 10)) e_list += "<tr>";
		if (inasw[0][i] == "blank") {
			e_list += "<td align='center'><font class='sw_ft_style_1'>X</font></td>";
		} else {
			e_list += "<td align='center' onClick='javascript:layerClick(ed_asworddiv,\""+ inasw[0][i] +"\");' onMouseOver=this.className='sw_MouseOver_0' onMouseOut=this.className='sw_MouseOut_0' style='cursor:hand;'><font class='sw_ft_style_0'>" + inasw[0][i] + "</font></td>";
		}
		if(i % 10 == 9) e_list += "</tr>";
	}
	return e_list;
}

sw_layers_ng_asword += ed_aswordF();
sw_layers_ng_asword += "</table></td></tr></table></div>";

var sw_layers_ng_color = "<div id='ed_colordiv' style='position:absolute; visibility:hidden;'>";
sw_layers_ng_color += "<table width='60' id='ed_colortable' border='1' cellpadding='0' cellspacing='2' class='sw_bd_style_5' onmousemove='clear_timeout()' onmouseout='start_timeout(this)'>";

function ed_colorF()
{
	var c_list = new String;
	var Color_Chart = new Array();
	Color_Chart[0] = new Array('FF0000','00FF00','0000FF','FFFF00','00FFFF','FF00FF','CCCCCC','999999','666666');

	for(var i=0 ; i < 9 ; i++)
	{
		if(!(i % 3)) c_list += "<tr>";
		c_list += "<td width='15' height='15' onClick='javascript:layerClick_no_grant(ed_colordiv,"+ "\"" + Color_Chart[0][i] + "\"" +");' bgcolor='"+ Color_Chart[0][i] +"' style='cursor:hand;' class='sw_ft_style_0'>&nbsp;</td>";
		if(i % 3 == 2) c_list += "</tr>";
	}
	return c_list;
}

sw_layers_ng_color += ed_colorF();
sw_layers_ng_color += "</table></div>";

sw_layers_ng = sw_layers_ng_search + sw_layers_ng_emoticon + sw_layers_ng_asword + sw_layers_ng_color;

document.writeln(sw_layers_ng);
