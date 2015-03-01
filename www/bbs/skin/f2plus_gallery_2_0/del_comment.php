<?
@extract($HTTP_GET_VARS); 
@extract($HTTP_POST_VARS);
/***************************************************************************
* 공통 파일 include
**************************************************************************/
include $_zb_path."_head.php";

if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 글을 삭제하여 주시기 바랍니다.");

//  초기 헤더를 뿌려주는 부분;;;;
function head1($body="",$scriptfile="") {

	global $group, $setup, $dir,$member, $PHP_SELF, $id, $_head_executived, $HTTP_COOKIE_VARS, $width, $_zb_path, $_zb_url;

	if($_head_executived) return;
	$_head_executived = true;

	$f = @fopen($_zb_path."license.txt","r");
	$license = @fread($f,filesize($_zb_path."license.txt"));
	@fclose($f);

	print "<!--\n".$license."\n-->\n";

	if(!eregi("member_",$PHP_SELF)) $stylefile=$_zb_url."/skin/$setup[skinname]/style.css"; else $stylefile=$_zb_url."/style.css";

	if($setup[use_formmail]) {
		$f = fopen($_zb_path."script/script_zbLayer.php","r");
		$zbLayerScript = fread($f, filesize($_zb_path."script/script_zbLayer.php"));
		fclose($f);
	}
	
	// html 시작부분 출력
	if($setup[skinname]) {
?>
<html> 
<head>
<title>Delete</title>
<meta http-equiv=Content-Type content=text/html; charset=EUC-KR>
<meta name="viewport" content="width=device-width">
<link rel=StyleSheet HREF=<?=$stylefile?> type=text/css title=style>
<?if($setup[use_formmail]) echo $zbLayerScript;?>
<?if($scriptfile) include $_zb_path."script/".$scriptfile;?>

</head>
<body topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0' <?=$body?><?

if($setup[bg_color]) echo " bgcolor=".$setup[bg_color]." ";
if($setup[bg_image]) echo " background=".$setup[bg_image]." ";

?>>
<?
if($group[header_url]) { @include $group[header_url]; }
if($setup[header_url]) { @include $setup[header_url]; }
if($group[header]) echo stripslashes($group[header]);
if($setup[header]) echo stripslashes($setup[header]);
?>

<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> height=1 style="table-layout:fixed;"><col width=100%></col><tr><td><img src=images/t.gif border=0 width=98% height=1 name=zb_get_table_width><br><img src=images/t.gif border=0 name=zb_target_resize width=1 height=1></td></tr></table>
<?
	} else {
?>
<html>
<head>
<meta http-equiv=Content-Type content=text/html; charset=EUC-KR>
<meta name="viewport" content="width=device-width">
<link rel=StyleSheet HREF=style.css type=text/css title=style>
<?=$script?>

</head>
<body topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0' <?=$body?>>
<?
if($group[header_url]) { @include $group[header_url]; }
if($group[header]) echo stripslashes($group[header]);
	}

}

// 푸터 부분 출력
function foot1() {

	global $width, $group, $setup, $_startTime , $_queryTime , $_foot_executived, $_skinTime, $_sessionStart, $_sessionEnd, $_nowConnectStart, $_nowConnectEnd, $_dbTime, $_listCheckTime, $_zbResizeCheck, $_zb_path, $_zb_url;
	if($_foot_executived) return;
	$_foot_executived = true;

	$maker_file=@file($_zb_path."skin/$setup[skinname]/maker.txt");
	if($maker_file[0]) $maker="/ skin by $maker_file[0]";
	else $maker = "";

	if($setup[skinname]) {
?>

<table border=0 cellpadding=0 cellspacing=0 height=20 width=<?=$width?>>
<tr>
	<td align=right style=font-family:tahoma,굴림;font-size:8pt;line-height:150%;letter-spacing:0px>
		<font style=font-size:7pt>Copyright 1999-<?=date("Y")?></font> <a href=http://www.zeroboard.com target=_blank onfocus=blur()><font style=font-family:tahoma,굴림;font-size:8pt;>Zeroboard</a> <?=$maker?>
	</td>   
</tr>
</table>

<?
		if($_zbResizeCheck) {
?>
<!-- 이미지 리사이즈를 위해서 처리하는 부분 -->
<script>
	function zb_img_check(){
		var zb_main_table_width = document.zb_get_table_width.width*(100-4)/100;
		var zb_target_resize_num = document.zb_target_resize.length;
		for(i=0;i<zb_target_resize_num;i++){ 
			if(document.zb_target_resize[i].width > zb_main_table_width) {
				document.zb_target_resize[i].height = document.zb_target_resize[i].height * zb_main_table_width / document.zb_target_resize[i].width;
				document.zb_target_resize[i].width = zb_main_table_width;
			}
		}
	}
	window.onload = zb_img_check;
</script>

<?
		}

if($setup[footer]) echo stripslashes($setup[footer]);
if($group[footer]) echo stripslashes($group[footer]);
if($setup[footer_url]) { @include $setup[footer_url]; }
if($group[footer_url]) { @include $group[footer_url]; }
?>

</body>
</html>
<?
		
	} else {

if($group[footer]) echo stripslashes($group[footer]);
if($group[footer_url]) { @include $group[footer_url]; }

?>
</body>
</html>
<?
	}

	$_phpExcutedTime = (getmicrotime()-$_startTime)-($_sessionEnd-$_sessionStart)-($_nowConnectEnd-$_nowConnectStart)-$_dbTime-$_skinTime;
	// 실행시간 출력
	echo "\n\n<!--"; 
	if($_sessionStart&&$_sessionEnd)  		echo "\n Session Excuted  : ".sprintf("%0.4f",$_sessionEnd-$_sessionStart);
	if($_nowConnectStart&&$_nowConnectEnd) 	echo "\n Connect Checked  : ".sprintf("%0.4f",$_nowConnectEnd-$_nowConnectStart);
	if($_dbTime)  							echo "\n Query Excuted  : ".sprintf("%0.3f",$_dbTime);
	if($_phpExcutedTime)  					echo "\n PHP Excuted  : ".sprintf("%0.3f",$_phpExcutedTime);
	if($_listCheckTime) 					echo "\n Check Lists : ".sprintf("%0.3f",$_listCheckTime);
	if($_skinTime) 							echo "\n Skins Excuted  : ".sprintf("%0.3f",$_skinTime);
	if($_startTime) 						echo "\n Total Excuted Time : ".sprintf("%0.3f",getmicrotime()-$_startTime);
	echo "\n-->\n";
}

/***************************************************************************
* 코멘트 삭제 페이지 처리
**************************************************************************/

// 원본글을 가져옴
$s_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where no='$c_no'"));

if($s_data[ismember]||$is_admin||$member[level]<=$setup[grant_delete]) {
	if(!$is_admin&&$s_data[ismember]!=$member[no]) Error("삭제할 권한이 없습니다");
	$title="글을 삭제하시겠습니까?";
} else {
	$title="글을 삭제합니다.<br>비밀번호를 입력하여 주십시요";
	$input_password="<input type=password name=password size=20 class=input>";
}


$a_list="<a href=zboard.php?$href$sort>";

$a_view="<a href=view.php?$href$sort&no=$no>";

head1();

$target=$_zb_url."/".$dir."/del_comment_ok.php";
include $_zb_path.$dir."/ask_password.php";

foot1();

include $_zb_path."_foot.php";
?>