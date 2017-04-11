<?
include $dir."/swe/ed_seting_head.php";

if($mode=="reply") $title="답글 쓰기";
elseif($mode=="modify") $title="글 수정하기";
else $title="새로 글 쓰기";

$m_memo = explode("|||",htmlspecialchars(str_replace("&amp;","&",str_replace("&lt;","<",$memo))));
$memo = $m_memo[0];
$_name2 = $m_memo[1];
$_name3 = $m_memo[2];
$_name4 = $m_memo[3];
$_name5 = $m_memo[4];
$_name6 = $m_memo[5];
$_name7 = $m_memo[6];
$_name8 = $m_memo[7];
$_name9 = $m_memo[8];
$_name10 = $m_memo[9];

$a_preview = str_replace(">","><font class=com2>",$a_preview)."";
$a_imagebox = str_replace(">","><font class=com2>",$a_imagebox)."";
$a_codebox = str_replace(">","><font class=com2>",$a_codebox)."";
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function zb_formresize(obj) {
	obj.rows += 4;
}

function check_submit_y()
{
	var rName=document.getElementById('name');
	var rPass=document.getElementById('password');
	var rSub=document.getElementById('subject');
	var rStr=document.getElementById('memo');
	var rCheck=document.getElementById('check');
	if(rCheck.value==1)
	{
		alert('글쓰기 버튼을 여러번 누르시면 안됩니다.');
		return false;
	}

	if(edit_tag_yn == "Y")
	{
		rStr.value = memoi2memo(memoiW.document.body.innerHTML);
	}

	if(use_category_yn == "Y")
	{
		var myindex=document.getElementById('write').category[1].selectedIndex;
		if (myindex<1)
		{
			alert('카테고리를 선택하여 주세요.');
			document.getElementById('write').category[1].focus();
			return false;
		}
	}

	if(member_yn == "Y")
	{
		if(!rName.value)
		{
			alert('이름을 입력하여 주세요.');
			rName.focus();
			return false;
		}
		if(!rPass.value)
		{
			alert('암호를 입력하여 주세요.\n\n암호를 입력하셔야 수정/삭제를 할 수 있습니다.');
			rPass.focus();
			return false;
		}
	}

	if(!rSub.value)
	{
		alert('제목을 입력하여 주세요.');
		rSub.focus();
		return false;
	}

	if(edit_tag_yn == "Y") {
		if(!memoiW.document.body.innerHTML||memoiW.document.body.innerHTML=="<P>&nbsp;</P>"||memoiW.document.body.innerHTML=="<br>")
		{
			alert('상품설명을 입력하여 주세요.');
			memoiW.focus();
			return false;
		}
	} else {
		if(!memoE.value||memoE.value=="<P>&nbsp;</P>"||memoE.value=="<br>")
		{
			alert('상품설명을 입력하여 주세요.');
			rStr.focus();
			return false;
		}
	}

	var rName2=document.getElementById('_name2');
	var rName3=document.getElementById('_name3');
	var rName4=document.getElementById('_name4');
	var rName5=document.getElementById('_name5');
	var rName6=document.getElementById('_name6');
	var rName8=document.getElementById('_name8');

	if(rName2.value==""){
		alert("제조사를 입력하세요!");
		rName2.focus();
		return false;
	}
	else if(rName3.value==""){
		alert("원산지를 입력하세요!");
		rName3.focus();
		return false;
	}
	else if(rName4.value==""){
		alert("상품수량을 입력하세요!");
		rName4.focus();
		return false;
	}
	else if(rName5.value==""){
		alert("상품옵션을 입력하세요!");
		rName5.focus();
		return false;
	}
	else if(rName6.value=="0"){
		alert("평점을 입력하세요!");
		rName6.focus();
		return false;
	}
	else if(rName8.value==""){
		alert("판매가격을 입력하세요!");
		rName8.focus();
		return false;
	}

	if(subeva_yn == "Y")
	{
		if(edit_tag_yn == "Y")
		{
			if(rSub.value && memoiW.document.body.innerHTML) { sub_val_ins(); }
		} else {
			if(rSub.value && memoE.value) { sub_val_ins(); }
		}
	}

	sw_mcpy();

	rCheck.value=1;
	show_waiting();
	hideImageBox();

	return true;
}
//-->
</SCRIPT><br>
<?$_url=$dir."/write_ok.php";?>
<table border=0 cellspacing=0 cellpadding=2 width=<?=$width?> align=center style=border-width:1pt;border-style:solid;border-color:#cccccc style=table-layout:fixed>
<tr align=left valign="middle" height=25>
  <td class=list_eng>&nbsp;&nbsp;<img src=<?=$dir?>/images/front_img.gif>&nbsp;&nbsp;새글쓰기 </td>
</tr>
</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0 style=table-layout:fixed>
<form method=post id=write name=write action=<?=$_url?> onsubmit="return check_submit_y();" enctype=multipart/form-data><input type=hidden name=page value=<?=$page?>><input type=hidden name=id value=<?=$id?>><input type=hidden name=no value=<?=$no?>><input type=hidden name=select_arrange value=<?=$select_arrange?>><input type=hidden name=desc value=<?=$desc?>><input type=hidden name=page_num value=<?=$page_num?>><input type=hidden name=keyword value="<?=$keyword?>"><input type=hidden name=category value="<?=$category?>"><input type=hidden name=sn value="<?=$sn?>"><input type=hidden name=ss value="<?=$ss?>"><input type=hidden name=sc value="<?=$sc?>"><input type=hidden name=sm value="<?=$sm?>"><input type=hidden name=mode value="<?=$mode?>"><input type=hidden name=wantispam value="<?=$wnum1num2?>"><input type=hidden name=_zb_path value="<?=$config_dir?>"><input type=hidden name=_zb_url value="<?=$_zb_url?>">
<col width=80 align=right style=padding-right:10px;height:28px class=com2></col><col class=list1 style=padding-left:10px;height:28px width=></col>
<?=$hide_start?>

<tr>
  <td align=right><font class=com2><b>이름</b></font></td>
  <td align=left><input type=text id=name name=name value="<?=$name?>" <?=size(20)?> maxlength=20 class=input onkeyup="ajaxLoad2()"></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2><b>암호</b></font></td>
  <td align=left><input type=password id=password name=password <?=size(20)?> maxlength=20 class=input onkeyup="ajaxLoad2()"> 비번을 재입력하면 임시저장이 복원됨</td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>홈페이지</font></td>
  <td align=left><input type=text id=homepage name=homepage value="<?=$homepage?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>이메일</font></td>
  <td align=left><input type=text id=email name=email value="<?=$email?>" <?=size(40)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<?=$hide_end?>

<tr>
  <td align=right><font class=com2>평점</font></td>
  <td align=left>
    <SELECT id=_name6 NAME=_name6 value=<?=$_name6?>>
<? $checked=array("","","","","",""); $checked[$_name6]="selected" ?>
    <option value=0 <?=$checked[0]?>>포인트</option>
    <option value=1 <?=$checked[1]?>>★</option>
    <option value=2 <?=$checked[2]?>>★★</option>
    <option value=3 <?=$checked[3]?>>★★★</option>
    <option value=4 <?=$checked[4]?>>★★★★</option>
    <option value=5 <?=$checked[5]?>>★★★★★</option>
    </SELECT>
    <SELECT NAME=_name7 value=<?=$_name7?>>
<? $checked=array("",""); $checked[$_name7]="selected"?>
    <option value=0 <?=$checked[0]?>>절반</option>
    <option value=1 <?=$checked[1]?>>☆</option>
    </select>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>제조사</font></td>
  <td align=left><input type=text id=_name2 name=_name2 value="<?=$_name2?>" <?=size(20)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>원산지</font></td>
  <td align=left><input type=text id=_name3 name=_name3 value="<?=$_name3?>" <?=size(20)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>상품수량</font></td>
  <td align=left><input type=text id=_name4 name=_name4 value="<?=$_name4?>" <?=size(10)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td align=right><font class=com2>판매가격</font></td>
  <td align=left><input type=text id=_name8 name=_name8 value="<?=$_name8?>" <?=size(10)?> maxlength=200 class=input>원</td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>상품옵션</font></td>
  <td align=left><input type=text id=_name5 name=_name5 value="<?=$_name5?>" <?=size(50)?> maxlength=200 style=width:99% class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>동영상 URL</font></td>
  <td align=left>·저속 : <input type=text name=_name9 value="<?=$_name9?>" <?=size(70)?> maxlength=200 class=input><BR>·고속 : <input type=text name=_name10 value="<?=$_name10?>" <?=size(70)?> maxlength=200 class=input></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>옵션</font></td>
  <td align=left class=com2>
    <?=$hide_category_start?><?=$category_kind?><?=$hide_category_end?>

    <?=$hide_notice_start?> <input type=checkbox id=notice name=notice <?=$notice?> value=1>공지사항<?=$hide_notice_end?> <input type=checkbox id=reply_mail name=reply_mail <?=$reply_mail?> value=1>답변메일받기<?=$hide_secret_start?> <input type=checkbox id=is_secret name=is_secret <?=$secret?> value=1>비밀글<?=$hide_secret_end?>

    <?=$hide_html_start?>
    <? include $dir."/swe/ed_seting_option.php"; ?>
    <?=$hide_html_end?> <font id="state"></font>

  </td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2><b>제목</b></font></td>
  <td align=left><? include $dir."/swe/ed_seting_substyle.php"; ?></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right onclick='javascript:edit_window_size("height_in");' style=cursor:pointer>
  <font class=com2><b>상품설명</b></font> <font class=com2>▼</font></td>
  <td align=left style=padding-top:8px;padding-bottom:8px;>
  <? include $dir."/swe/ed_seting_edit.php"; ?>
  </td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>제조사 홈페이지</font></td>
  <td align=left><input type=text id=sitelink1 name=sitelink1 value="<?=$sitelink1?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<tr>
  <td align=right><font class=com2>관련 홈페이지</font></td>
  <td align=left><input type=text id=sitelink2 name=sitelink2 value="<?=$sitelink2?>" <?=size(62)?> maxlength=200 class=input style=width:99%></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<?=$hide_pds_start?>

<tr>
  <td align=right><font class=com2>파일 #1</font></td>
  <td align=left class=com2><? echo(filebox_add("1",$file_name1)) ?></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<tr>
  <td align=right><font class=com2>파일 #2</font></td>
  <td align=left class=com2><? echo( filebox_add("2",$file_name2)) ?></td>
</tr>
<tr>
  <td background=<?=$dir?>/images/dot.gif height=1 colspan=2></td>
</tr>
<?=$hide_pds_end?>

</table>
<table border=0 width=<?=$width?> cellsapcing=1 cellpadding=0>
<tr>
	<td width=130 height=40 align=left>
		<?=$a_preview?><img src=<?=$dir?>/images/bt_prev.gif border=0></a>
		<?=$a_imagebox?><img src=<?=$dir?>/images/bt_imgbox.gif border=0></a>
	</td>
	<td width=60 valign=middle><?=$a_codebox?>코드삽입</a></td>
	<td align=right>
		<img src=<?=$dir?>/images/bt_imsi_ok.gif border=0 accesskey="a" onclick=autoSave_n() style="cursor:pointer">&nbsp;
		<input type=image src=<?=$dir?>/images/bt_write_ok.gif border=0 accesskey="s" onfocus=blur()>&nbsp;<a href=# onclick=history.back() onfocus=blur()><img src=<?=$dir?>/images/bt_cancel.gif border=0></a>
	</td>
</tr>
</form>
</table>
<br>
