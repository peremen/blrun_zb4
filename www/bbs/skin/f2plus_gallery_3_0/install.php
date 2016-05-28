<?
@extract($HTTP_GET_VARS); 
@extract($HTTP_POST_VARS); 

include $zb_path."lib.php";
if(!$connect) $connect=dbconn();
$result=mysql_fetch_array(mysql_query("select is_admin from zetyx_member_table where user_id='$user_id' and password='$password'"));
  
if($result[0]==1){
	if(file_exists($id."_config.php")){ 
		include $id."_config.php";
		$prev_type=$type;	
	}else{ 
		$type="A2_type";
		$gd_use=2;
		$zb_url=substr(zbUrl(),0,strlen(zbUrl())-1);
		$zb_path=$config_dir;
	}
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>f2plus gallery ver.3.0 install page</title>
<style>
BODY,TD {font-size:9pt;font-family:굴림;color:ffffff;line-height:160%}

.thm7pt {font-family:tahoma;font-size:8pt}

.com {font-family:tahoma;font-size:9pt;color:ffffff}
.com2 {font-family:tahoma;font-size:7pt;color:666666}
.com3 {font-family:tahoma;font-size:7pt;color:ff9966}
.han {font-family:tahoma;font-size:9pt;color:00ff00}
.han2 {font-family:tahoma;font-size:9pt;color:aaaaaa}
.han3 {font-family:tahoma;font-size:9pt;color:ff6600}
.han4 {font-family:tahoma;font-size:9pt;color:ffcccc}

.border {border:solid 1;border-color:595959}
.border2 {border:solid 1;border-color:cccccc}

.textarea {border:solid 1;border-color:cccccc;font-size:9pt;color:black;background-color:dddddd}
.textarea2 {border:solid 1;border-color:cccccc;font-size:9pt;color:black;background-color:dddddd;height:19px}
.input {border:solid 1;border-color:C4C4C4;font-size:9pt;color:301B04;background-color:white;height:19px}
.submit {border:solid 1;border-color:black;font-size:9pt;font-weight:bold;color:00ff00;background-color:black;height:25px}
.button {border:solid 1;border-color:black;font-size:9pt;font-weight:bold;color:ff3333;background-color:black;height:25px}


A:link    {color:cccccc;text-decoration:none;}
A:visited {color:cccccc;text-decoration:none;}
A:active  {color:cccccc;text-decoration:none;}
A:hover   {color:ffffff;text-decoration:underline}
</style>
</head>
<body bgcolor="black" text="black" link="blue" vlink="purple" alink="red" leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
<table border="0" cellpadding="5" cellspacing="0" width="100%" align=center>
<form name=write method=post action=install_ok.php onsubmit="return check_submit()">
<INPUT TYPE="hidden" name=prev_type value="<?=$prev_type?>">
<tr valign=top>
	<td>
		<table border="0" cellpadding="5" cellspacing="0" width="100%" align=center>
		<tr valign=top>
			<td>
				<table align=center border="0" cellpadding="2" cellspacing="0" width="100%">
				<col width=50%></col><col width=></col>
				<tr height=20 valign=bottom>
					<td class=com3 align=left><B>F2plus gallery ver3.0</B></td><td class=com2 align=right>configuration | for zeroboard</td>
				</tr>
				<tr><td colspan=2 height=1 bgcolor=555555></td>
				</tr>
				</table>
			</td>
		<tr>
			<td height=10></td>
		</tr>
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="98%" align=center>
				<col width=></col><col align=right width=100></col>
				<tr valign=bottom><td align=left class=com>▒ <B>공통사항</B></td><td><a href=<?=urlencode('매뉴얼.txt')?> target=_blank><font class=han3><U>매뉴얼/미리보기</U></font></a></td>
				</tr>
				</table>
			</td>
		</tr>

		<table border="0" cellpadding="5" cellspacing="0" width="98%" align=center class=border>
		<col width=240></col><col width=3></col><col width=200></col><col width=3></col><col width=></col>
		<tr valign=top>
			<td>
				<table border="0" cellpadding="1" cellspacing="0" width="95%" align=center>
				<col width=140></col><col align=right width=></col>
				<tr valign=top><td class=han2>1. 썸네일 사용 </td><?if($Thumbnail_use=="off") $select=""; else $select="checked";?><td><input type="checkbox" value=1 name=thumb <?=$select?>></td></tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				<tr valign=top><td class=han2>2. Exif 정보 </td><?if($Exif_use=="off") $select=""; else $select="checked";?><td><input type="checkbox"  value=1 name=exif <?=$select?>></td></tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				<tr valign=top><td class=han2>3. 웹에디터 사용 </td><?if($emoticon_use!="on") $select=""; else $select="checked";?><td><input type="checkbox"  value=1 name=emouse <?=$select?>></td></tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				<tr valign=top><td class=han2>4. 메인썸네일 사용 </td><?if($Thumbnail_view=="off") $select=""; else $select="checked";?><td><input type="checkbox" value=1 name=viewthumb <?=$select?>></td></tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				<tr valign=top><td class=han2>5. 최대 썸네일 가로크기 </td><td><input type="text" class=textarea name=maxwidth size=5 value=<?if($max_width_size=="") { echo "200";  } else { echo "$max_width_size"; }?>></td></tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				</table>
			</td>
			<td valign=middle>
				<table border="0" cellpadding="0" cellspacing="0" height=100 align=center>
				<tr><td width=1 bgcolor=444444></td></tr></table>
			</td>
			<td>
				<table border="0" cellpadding="1" cellspacing="0" width="95%" align=center>
				<col width=140></col><col align=right width=></col>
				<tr><td></td></tr>	
				<tr valign=top><td class=han2>1. No(글순번) 삭제</td><?if($hide_no=="off") $select=""; else $select="checked";?><td><input type="checkbox" value=1 name=no_use <?=$select?>></td></tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				<tr valign=top><td class=han2>2. 이름 삭제 </td><?if($hide_name=="off") $select=""; else $select="checked";?><td><input type="checkbox" value=1 name=name_use <?=$select?>></td></tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				<tr valign=top><td class=han2>3. Date 삭제 </td><?if($hide_date=="off") $select=""; else $select="checked";?><td><input type="checkbox" value=1 name=date_use <?=$select?>></td></tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				<tr valign=top><td class=han2>4. 추천기능 삭제 </td><?if($hide_vote=="off") $select=""; else $select="checked";?><td><input type="checkbox" value=1 name=vote_use <?=$select?>></td></tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				<tr valign=top><td class=han2>5. 조회수 삭제 </td><?if($hide_hit=="off") $select=""; else $select="checked";?><td><input type="checkbox" value=1 name=hit_use <?=$select?>></td></tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				</table>
			</td>
			<td valign=middle>
				<table border="0" cellpadding="0" cellspacing="0" height=100 align=center>
				<tr><td width=1 bgcolor=444444></td></tr></table>
			</td>
			<td align=left>
				<table border="0" cellpadding="1" cellspacing="0" width="95%" align=center>
				<col width=95></col><col width=></col>
				<tr valign=top><td class=han2>1. 제로보드 경로 </td>
				<td class=han2><input type="text" class=textarea name=zburl size=38 value=<?if($zb_url=="") { echo "http://홈페이지주소/제로보드";  } else { echo "$zb_url"; }?>></td>
				</tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				<tr valign=top><td class=han2>2. 절대 경로 </td>
				<td><input type="text" class=textarea name=zbpath size=38 value=<?=$zb_path?>></td></tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td>
				</tr>
				<tr valign=top><td class=han2>3. 이모티콘 경로 </td>
				<td class=han2><input type="text" class=textarea name=emoticon_url size=38 value=<?if($emoticon_url=="") { echo "/images/emoticon";  } else { echo "$emoticon_url"; }?>></td>
				</tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				<tr valign=top><td class=han2>4. 게시판 이름 </td>
				<td><input type="text" class=textarea name=board_id size=25 value=<?=$id?>></td>
				</tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				<tr><td height=6 colspan=2></td></tr>
<?$select1=""; $select2=""; $select3="";
if($gd_use==0) $select1="checked"; elseif($gd_use==1) $select2="checked"; else $select3="checked";
?>
				<tr><td colspan=2 align=left class=han3>◎ <a href=test.php target=_blank><font class=han3><U>GD Version</U></font></a> 선택&nbsp;&nbsp;<INPUT TYPE="radio" NAME="gd_use" value=2 <?=$select3?>>2.0이상<INPUT TYPE="radio" NAME="gd_use" value=1 <?=$select2?>>2.0이하<INPUT TYPE="radio" NAME="gd_use" value=0 <?=$select1?>>사용않함</td>
				</tr>
				<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
				</table>
			</td>
		</tr>
		<tr valign=top>
<?$select1=""; $select2=""; if($category_use==1) $select1="checked"; else $select2="checked";?>
			<td class=han2 align=left colspan=2>&nbsp;&nbsp;◎ 카테고리 선택 :
				<INPUT TYPE="radio" NAME=category_use value=1 <?=$select1?>>사용&nbsp;&nbsp;<INPUT TYPE="radio" NAME=category_use value=2 <?=$select2?>>미사용</td>
<?$select1=""; $select2="";	if($img_show=="on") $select1="checked"; else $select2="checked";?>
			<td colspan=3 align=left class=han2>&nbsp;&nbsp;◎ 목록이미지클릭시(D_type 제외) : <INPUT TYPE="radio" NAME=img_show value=on <?=$select1?>>원래크기의 이미지로(새창)&nbsp;&nbsp;<INPUT TYPE="radio" NAME=img_show value=off <?=$select2?>>글내용으로 
				<table border=0 cellspacing=0 cellpadding=0 width=100% align=100%>
				<tr><td align=right style=padding-right=5px>※ <U><B>경로를 정확히 입력하시기 바랍니다.</B></U></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr><td height=1 bgcolor=333333 colspan=5></td>
		</tr>
		</table>

		<tr><td height=1></td>
		</tr>
		<tr>
			<td>
				<table border="0" cellpadding="5" cellspacing="0" width="98%" align=center>
				<tr valign=bottom><td align=left class=com>▒ <B>형태선택</B></td>
				</tr>
				</table>
				<table border="0" cellpadding="5" cellspacing="0" width="98%" align=center class=border>
				<col width=260></col><col width=10></col><col width=></col>
				<tr valign=top>
					<td>
						<table border="0" cellpadding="1" cellspacing="0" width="95%" align=center>
						<col width=90></col><col align=left width=></col>
						<tr valign=top><td class=han2>1. A_type :</td><td class=han2>게시판형</td></tr>
						<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
						<tr valign=top><td class=han2>2. A2_type :</td><td class=han2>게시판형(Graphical)</td></tr>
						<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
						<tr valign=top><td class=han2>3. B_type :</td><td class=han2>전시회형</td></tr>
						<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
						<tr valign=top><td class=han2>4. C_type :</td><td class=han2>세로 오버형</td></tr>
						<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
						<tr valign=top><td class=han2>5. D_type :</td><td class=han2>가로 클릭형</td></tr>
						<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
						<tr valign=top><td class=han2>6. Movie_type :</td><td class=han2>영화 갤러리</td></tr>
						<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
						<tr valign=top><td class=han2>7. Sell_type :</td><td class=han2>판매 갤러리</td></tr>
						<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
						</table>
					</td>

					<td valign=middle>
						<table border="0" cellpadding="0" cellspacing="0" height=100 align=center>
						<tr><td width=1 bgcolor=444444></td></tr></table>
					</td>

					<td>
						<table border="0" cellpadding="1" cellspacing="0" width="95%" align=center>
						<col width=130></col><col width=130></col><col width=130></col><col width=130></col><col width=130></col><col width=130></col>
						<tr valign=top>
							<td align=center><img src=install_img/A_type.gif border=0 align=absmiddle></td>
							<td align=center><img src=install_img/A2_type.gif border=0 align=absmiddle></td>
							<td align=center><img src=install_img/B_type.gif border=0 align=absmiddle></td>
							<td align=center><img src=install_img/C_type.gif border=0 align=absmiddle></td>
							<td align=center><img src=install_img/D_type.gif border=0 align=absmiddle></td>
						</tr>
						<tr>
<?if($type=="A_type") $select_A="checked"; elseif($type=="A2_type") $select_A2="checked"; elseif($type=="B_type") $select_B="checked"; elseif($type=="C_type") $select_C="checked"; elseif($type=="D_type") $select_D="checked"; elseif($type=="Movie_type") $select_M="checked"; elseif($type=="Sell_type") $select_S="checked";?>
							<td align=center class=han2>A_type<input type="radio" name="type" value="A_type" <?=$select_A?>></td>
							<td align=center class=han2>A2_type<input type="radio" name="type" value="A2_type" <?=$select_A2?>></td>
							<td align=center class=han2>B_type<input type="radio" name="type" value="B_type" <?=$select_B?>></td>
							<td align=center class=han2>C_type<input type="radio" name="type" value="C_type" <?=$select_C?>></td>
							<td align=center class=han2>D_type<input type="radio" name="type" value="D_type" <?=$select_D?>></td>
						</tr>
						</table><BR>
						<table border="0" cellpadding="1" cellspacing="0" width="95%" align=center>
						<col width=130></col><col width=130></col><col width=130></col><col width=130></col><col width=130></col><col width=130></col>
						<tr valign=top>
							<td align=center><img src=install_img/Movie_type.gif border=0 align=absmiddle></td>
							<td align=center><img src=install_img/Sell_type.gif border=0 align=absmiddle></td>
						</tr>
<?if($type=="A_type") $select_A="checked"; elseif($type=="A2_type") $select_A2="checked"; elseif($type=="B_type") $select_B="checked"; elseif($type=="C_type") $select_C="checked"; elseif($type=="D_type") $select_D="checked"; elseif($type=="Movie_type") $select_M="checked";elseif($type=="Sell_type") $select_S="checked";?>
							<td align=center class=han2>Movie_type<input type="radio" name="type" value="Movie_type" <?=$select_M?>></td>
							<td align=center class=han2>Sell_type<input type="radio" name="type" value="Sell_type" <?=$select_S?>></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border="0" cellpadding="5" cellspacing="0" width="98%" align=center>
				<col width=50%></col><col width=5></col><col width=></col>
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" align=center>
						<col width=100></col><col width=></col>
						<tr valign=top>
							<td align=left class=com colspan=2>▒ <B>특별사항1</B> <font class=han4>(<B>A-type,A2-type 제외</B>)</font></td>
						</tr>
						<tr><td height=7 colspan=2></td></tr>
						<tr>
							<td class=han2>· 가로 출력개수 :</td><td><input type="text" class=textarea2 name=num size=3 value=<?if($num=="") { echo "3";  } else { echo "$num"; }?>> 개  (리스트메인에서 보여질 작은이미지)</td>
						</tr>
						<tr><td height=7 colspan=2></td></tr>
							<td class=han2>· 가로 크기 :</td><td><input type="text" class=textarea2 name=min_width_size size=5 value=<?if($min_width_size=="") { echo "100";  } else { echo "$min_width_size"; }?>> 픽셀  (리스트메인에서 보여질 작은이미지)</td>
						</tr>
						<tr><td height=7 colspan=2></td></tr>
						<tr><td height=1 colspan=2 bgcolor=333333></td></tr>
						<tr><td height=7 colspan=2></td></tr>
						<tr><td align=left colspan=2 class=com>▒ <B>기타사항</B></td></tr>
						<tr><td height=7 colspan=2></td></tr>
						<tr>
							<td colspan=2><font class=han4> 생성된 썸네일 이미지를 삭제합니다.</font>&nbsp;&nbsp;<a href=del_thumb.php?id=<?=$id?>&zb_path=<?=$zb_path?> target=_blank>"<B><U>삭제하기</U></B>"&nbsp;&nbsp;</a><BR><font class=han3>(※주의 : 클릭하시면 바로 삭제됩니다.)</font></td>
						</tr>
						</table>
					</td>
					<td rowspan=2>
						<table border="0" cellpadding="0" cellspacing="0" width="1" height=100 align=center><tr><td bgcolor=444444></td></tr></table>
					</td>
					<td valign=top>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" align=center>
						<col width=150></col><col width=></col>
						<tr valign=top><td align=left class=com colspan=2>▒ <B>특별사항2</B> <font class=han4>(<B>A-type,A2-type 일경우</B>)</font></td>
						</tr>
						<tr><td height=1 bgcolor=333333 colspan=2></td></tr>
						<tr><td height=7 colspan=2></td></tr>
						<tr><td class=han2>· 조회그래프(쵀대조회수값)&nbsp;: <input type="text" class=textarea2 name=max_hit size=4 value=<?if($max_hit=="") { echo "50";  } else { echo "$max_hit"; }?>> 개</td>
						</tr>
						<tr><td class=han2>리스트메인에서 우측에 조회그래프의 최대조회값을 이야기합니다.</td>
						</tr>
						</table><BR><BR>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" align=center>
						<tr valign=middle>
							<td colspan=3 align=right>
								<input type=submit class=submit value="[확 인]" name=ok>&nbsp;&nbsp;&nbsp;
								<input type=reset class=button value="[이전값]" name=cancel>&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="98%" align=center>
				<tr><td height=1 bgcolor=555555 colspan=3></td></tr></table>
			</td>
		</tr>
		<tr valign=top>
			<td>
				<table border=0 width=100% cellspacing=0 cellpadding=10px>
				<tr height=10 align=right><td class=com2>Copyright 2003-2004 by <a href=http://www.f2plus.com>www.f2plus.com</a>&nbsp;&nbsp;Re-Made by&nbsp;<a href=http://www.skydeco.com>www.skydeco.com</a></td></tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</form>
</table>
<?
}else echo "설정을 변경하실 권한이 없네요";
?>