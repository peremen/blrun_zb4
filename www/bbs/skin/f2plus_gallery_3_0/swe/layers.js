
//====================[ sw_edit 파일명: layers.js ]====================

var sw_layers = new String;
var sw_skins_dir = document.getElementById("sw_skins_dir").value;
var sw_d_zb_self_dir = document.getElementById("sw_d_zb_self_dir").value;

var sw_layers_search = "<div id='ed_searchdiv' style='position:absolute; visibility:hidden;'>";
sw_layers_search += "<table width='180' border='0' cellpadding='0' cellspacing='0' class='sw_bd_style_5'><tr><td style='padding:5;'>";
sw_layers_search += "<input type='text' name='Search_text' id='Search_text' class='text' style='width:100%;' onChange='ser_n = 0;'>";
sw_layers_search += "</td></tr>" + tdbrd_line_0 + "<tr><td style='padding:5;'><table width='100%' border='0' cellpadding='0' cellspacing='0' class='sw_bg_style_1'><tr><td align='center' style='padding:5;' class='sw_ft_style_1'>";
sw_layers_search += "찾을 내용을 입력해주세요.";
sw_layers_search += "</td></tr></table></td></tr>" + tdbrd_line_0 + "<tr><td align='center' style='padding:5;'>";
sw_layers_search += "<a onClick='javascript:layerClick(ed_searchdiv);' style='cusor:pointer;'><img src=" + sw_skins_dir + "/images/ed_search.gif border='0' style='margin:0 10 0 0;'></a>";
sw_layers_search += "<a onClick='javascript:layerClick(ed_searchdiv,\"div_clear\");' style='cusor:pointer;'><img src=" + sw_skins_dir + "/images/sw_a_back.gif border='0'></a>";
sw_layers_search += "</td></tr></table></div>";

var sw_layers_Url_Image = "<div id='ed_Url_Imagediv' style='position:absolute; visibility:hidden;'>";
sw_layers_Url_Image += "<table width='230' border='0' cellpadding='0' cellspacing='0' class='sw_bd_style_5'><tr><td style='padding:5;'>";
sw_layers_Url_Image += "<input type='text' name='urlimage_text' id='urlimage_text' class='text' style='width:100%;' value=\"http://\">";
sw_layers_Url_Image += "</td></tr>" + tdbrd_line_0 + "<tr><td style='padding:5;'><table width='100%' border='0' cellpadding='0' cellspacing='0' class='sw_bg_style_1'><tr><td style='padding:5;' class='sw_ft_style_1'>";
sw_layers_Url_Image += "이미지주소(URL)를 넣어주세요.<br>예) http://www.siqm.com/a.gif<br>http://를 꼭 써야 합니다.";
sw_layers_Url_Image += "</td></tr></table></td></tr>" + tdbrd_line_0 + "<tr><td align='center' style='padding:5;'>";
sw_layers_Url_Image += "<a onClick='javascript:layerClick(ed_Url_Imagediv);' style='cusor:pointer;'><img src=" + sw_skins_dir + "/images/sw_a_confirm.gif border='0' style='margin:0 10 0 0;'></a>";
sw_layers_Url_Image += "<a onClick='javascript:layerClick(ed_Url_Imagediv,\"div_clear\");' style='cusor:pointer;'><img src=" + sw_skins_dir + "/images/sw_a_back.gif border='0'></a>";
sw_layers_Url_Image += "</td></tr></table></div>";

var sw_layers_Url_media = "<div id='ed_Url_mediadiv' style='position:absolute; visibility:hidden;'>";
sw_layers_Url_media += "<table width='245' border='0' cellpadding='0' cellspacing='0' class='sw_bd_style_5'><tr><td align='right' style='padding:5;' class='sw_ft_style_1'>";
sw_layers_Url_media += "가로<input type='text' id='urlmedia_width' name='urlmedia_width' class='text' style='width:40; margin:0 10 0 3;' value=\"640\">";
sw_layers_Url_media += "세로<input type='text' id='urlmedia_height' name='urlmedia_height' class='text' style='width:40; margin:0 32 0 3;' value=\"480\">";
sw_layers_Url_media += "동영상<input type='checkbox' id='urlmedia_mv' name='urlmedia_mv'>";
sw_layers_Url_media += "</td></tr>" + tdbrd_line_0 + "<tr><td style='padding:5;'>";
sw_layers_Url_media += "<input type='text' name='urlmedia_text' id='urlmedia_text' class='text' style='width:100%;' value=\"http://\">";
sw_layers_Url_media += "</td></tr>" + tdbrd_line_0 + "<tr><td style='padding:5;'><table width='100%' border='0' cellpadding='0' cellspacing='0' class='sw_bg_style_1'><tr><td style='padding:5;' class='sw_ft_style_1'>";
sw_layers_Url_media += "동영상,음악,플래시<br>미디어주소(URL)를 넣어주세요.<br>예) http://www.siqm.com/a.wma<br>http://를 꼭 써야 합니다.<br><br>동영상일 경우 동영상에 체크하지<br>않으시면 원래 크기로 출력됩니다.";
sw_layers_Url_media += "</td></tr></table></td></tr>" + tdbrd_line_0 + "<tr><td align='center' style='padding:5;'>";
sw_layers_Url_media += "<a onClick='javascript:layerClick(ed_Url_mediadiv);' style='cusor:pointer;'><img src=" + sw_skins_dir + "/images/sw_a_confirm.gif border='0' style='margin:0 10 0 0;'></a>";
sw_layers_Url_media += "<a onClick='javascript:layerClick(ed_Url_mediadiv,\"div_clear\");' style='cusor:pointer;'><img src=" + sw_skins_dir + "/images/sw_a_back.gif border='0'></a>";
sw_layers_Url_media += "</td></tr></table></div>";

var sw_layers_createLink = "<div id='ed_createLinkdiv' style='position:absolute; visibility:hidden;'>";
sw_layers_createLink += "<table width='200' border='0' cellpadding='0' cellspacing='0' class='sw_bd_style_5'><tr><td align='right' style='padding:5;'>";
sw_layers_createLink += "<input type='text' name='hyper_layer' id='hyper_layer' class='text' style='width:100%;' value=\"http://\">";
sw_layers_createLink += "</td></tr>" + tdbrd_line_0 + "<tr><td style='padding:5;'><table width='100%' border='0' cellpadding='0' cellspacing='0' class='sw_bg_style_1'><tr><td style='padding:5;' class='sw_ft_style_1'>";
sw_layers_createLink += "링크주소(URL)를 넣어주세요.<br>예) http://www.siqm.com<br>http://를 꼭 써야 합니다.";
sw_layers_createLink += "</td></tr></table></td></tr>" + tdbrd_line_0 + "<tr><td align='center' style='padding:5;'>";
sw_layers_createLink += "<a onClick='javascript:layerClick(ed_createLinkdiv);' style='cusor:pointer;'><img src=" + sw_skins_dir + "/images/sw_a_confirm.gif border='0' style='margin:0 10 0 0;'></a>";
sw_layers_createLink += "<a onClick='javascript:layerClick(ed_createLinkdiv,\"div_clear\");' style='cusor:pointer;'><img src=" + sw_skins_dir + "/images/sw_a_back.gif border='0'></a>";
sw_layers_createLink += "</td></tr></table></div>";

var sw_layers_emoticon = "<div id='ed_emoticondiv' style='position:absolute; visibility:hidden;'>";
sw_layers_emoticon += "<table id='ed_emoticontable' border='0' cellpadding='0' cellspacing='0' class='sw_bd_style_5' onmousemove='clear_timeout()' onmouseout='start_timeout(this)'><tr><td style='padding:3;'>";
sw_layers_emoticon += "<table width='110' height='130' border='0' cellpadding='2' cellspacing='0'>";

var emoticon_dir = sw_d_zb_self_dir + sw_skins_dir + "/images/emoticon/";

function ed_emoticonF()
{
	var e_list = new String;

	for(var i=0 ; i < 40 ; i++)
	{
		if(!(i % 5)) e_list += "<tr>";
		if (emoIcon[0][i] == "blank") {
			e_list += "<td align='center'><img src='"+ emoticon_dir +"emtc_blank.gif' width='15' height='15' border='0'></td>";
		} else {
			e_list += "<td align='center' onClick='javascript:layerClick(ed_emoticondiv,"+ [i] +");' onMouseOver=this.className='sw_MouseOver_0' onMouseOut=this.className='sw_MouseOut_0' style='cusor:pointer;'><img src='" + emoticon_dir + "emtc_" + emoIcon[0][i] + ".gif' border='0'></td>";
		}
		if(i % 5 == 4) e_list += "</tr>";
	}
	return e_list;
}

sw_layers_emoticon += ed_emoticonF();
sw_layers_emoticon += "</table></td></tr></table></div>";

var sw_layers_asword = "<div id='ed_asworddiv' style='position:absolute; visibility:hidden;'>";
sw_layers_asword += "<table id='ed_aswordtable' border='0' cellpadding='0' cellspacing='0' class='sw_bd_style_5' onmousemove='clear_timeout()' onmouseout='start_timeout(this)'><tr><td style='padding:3;'>";
sw_layers_asword += "<table width='210' height='170' border='0' cellpadding='2' cellspacing='0'>";

function ed_aswordF()
{
	var e_list = new String;

	for(var i=0 ; i < 80 ; i++)
	{
		if(!(i % 10)) e_list += "<tr>";
		if (inasw[0][i] == "blank") {
			e_list += "<td align='center'><font class='sw_ft_style_1'>X</font></td>";
		} else {
			e_list += "<td align='center' onClick='javascript:layerClick(ed_asworddiv,\""+ inasw[0][i] +"\");' onMouseOver=this.className='sw_MouseOver_0' onMouseOut=this.className='sw_MouseOut_0' style='cusor:pointer;'><font class='sw_ft_style_0'>" + inasw[0][i] + "</font></td>";
		}
		if(i % 10 == 9) e_list += "</tr>";
	}
	return e_list;
}

sw_layers_asword += ed_aswordF();
sw_layers_asword += "</table></td></tr></table></div>";

var sw_layers_cells = "<div id='ed_cellsdiv' style='position:absolute; visibility:hidden; width:200;'>";
sw_layers_cells += "<table id='ed_cellstable' border='1' cellpadding='0' cellspacing='0' class='sw_bg_style_3' bordercolorlight='DDDDDD' bordercolordark='666666' onmousemove='clear_timeout()' onmouseout='start_timeout(this)'>";

function ed_cellF()
{
	var cell_list = new String;

	for (i=0; i<10; i++) {
		if (i==0) {
			cell_list += "<tr id='base'>";
		} else {
			cell_list += "<tr>";
		}
		for (i2=0; i2<10; i2++) {
			cell_list += "<td width='15' height='15' onmousemove='coloring(this,event)' onClick='javascript:selectXY(this,event);' class='sw_ft_style_0'>&nbsp;</td>";
		}
	}
	return cell_list;
}

sw_layers_cells += ed_cellF();
sw_layers_cells += "<tr><td align='center' colspan='10' id='xy_display' class='sw_ft_style_1' style='font-weight:bold; padding-top:4;'>가로:0&nbsp;&nbsp;세로:0</td></tr></table></div>";

var sw_layers_color = "<div id='ed_colordiv' style='position:absolute; visibility:hidden;'>";
sw_layers_color += "<table id='ed_colortable' border='1' cellpadding='0' cellspacing='3' class='sw_bd_style_5' onmousemove='clear_timeout()' onmouseout='start_timeout(this)'>";
sw_layers_color += "<tr><td width='50%' height='20' id='ed_selcolor' bgcolor='#000000' class='sw_ft_style_0'>&nbsp;</td>";
sw_layers_color += "<td width='50%' align='center' id='ed_seltext' class='sw_ft_style_0'>#000000</td></tr><tr><td colspan='2'>";
sw_layers_color += "<img usemap='#colmap' src='" + sw_skins_dir + "/images/color_table.gif' border='0' width='289' height='67'>";
sw_layers_color += "</td></tr></table></div>";
disp_map();

sw_layers = sw_layers_search + sw_layers_Url_Image + sw_layers_Url_media + sw_layers_createLink + sw_layers_emoticon + sw_layers_asword + sw_layers_cells + sw_layers_color;

document.writeln(sw_layers);
