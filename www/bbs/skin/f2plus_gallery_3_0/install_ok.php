<?
@extract($_GET); 
@extract($_POST); 

include $zbpath."lib.php";

function file_del($path) {

	$handle= dir($path);
	while(false !== ($info = $handle->read())) {
		if($info != "." && $info != "..") {
			if(preg_match("#([^.]+?)\.(jpg)#i",$info))
				@z_unlink($path.$info);
			else
				@zRmDir($path.$info);
		}
	}
	$handle->close();
}

$path=$zbpath."data/".$board_id."/thumbnail/";
if($type!=$prev_type && is_dir($path)) @file_del($path);

$cols=5;
if($no_use==1) $hide_no="on"; else $hide_no="off";
if($name_use==1){ $hide_name="on";  $cols--; } else $hide_name="off"; 
			  
if($date_use==1){ $hide_date="on";  $cols--; }else $hide_date="off"; 
			  
if($vote_use==1){ $hide_vote="on"; $cols--; } else $hide_vote="off"; 
			  
if($hit_use==1){ $hide_hit="on"; $cols--; } else $hide_hit="off"; 
			  

// gd 체크 입니다.
if($gd_use>0){
	if($thumb==1){ 
		$Thumbnail_use="on";
	}
	else{
		$Thumbnail_use="off";
	}
	if($viewthumb==1) $Thumbnail_view="on";
	else $Thumbnail_view="off";
}else{
	$Thumbnail_use="off";
	$Thumbnail_view="off";
}

if($exif==1) $Exif_use="on";
else $Exif_use="off";
if($emouse==1) $emoticon_use="on";
else $emoticon_use="off";

if($type=="Movie_type" || $type=="Sell_type"){
	if(!$connect) $connect=dbconn();
	$table="zetyx_board_comment_".$board_id."_movie";

	$movie_type_schema = "create table $table(
no int(11) not null auto_increment primary key,
parent int(11) not null,
reg_date int(13),
vote int(11) default 0,
point1 int(3),
point2 int(1),
memo text,
who text,
KEY parent (parent)
)";

	mysql_query("$movie_type_schema",$connect);
}

if(substr($emoticon_url,strlen($emoticon_url)-1,1)=="/") $emoticon_url=substr($emoticon_url,0,strlen($emoticon_url)-1);
if(substr($zburl,strlen($zburl)-1,1)=="/") $zburl=substr($zburl,0,strlen($zburl)-1);

$str='<?
$gd_use="'."$gd_use".'";
$zb_url="'."$zburl".'";
$zb_path="'."$zbpath".'";
$emoticon_url=$dir."'."$emoticon_url".'";

$Thumbnail_use="'."$Thumbnail_use".'";
$Exif_use="'."$Exif_use".'";
$icon_use="'."$icon_use".'";
$emoticon_use="'."$emoticon_use".'";

$Thumbnail_view="'."$Thumbnail_view".'";
$max_width_size="'."$maxwidth".'";
$Thumbnail_icon_use="'."$Thumbnail_icon_use".'";

$Thumbnail_url=$zb_url."/data/".$id."/thumbnail/";
$Thumbnail_path=$zb_path."data/".$id."/thumbnail/";

$type="'."$type".'";

$table="'."$table".'";

$img_show="'."$img_show".'";

$num="'."$num".'";

$max_hit="'."$max_hit".'";

$min_width_size="'."$min_width_size".'";

$cols="'."$cols".'";

$hide_no="'."$hide_no".'";

$category_use="'."$category_use".'";

$hide_name="'."$hide_name".'";

$hide_date="'."$hide_date".'";

$hide_vote="'."$hide_vote".'";

$hide_hit="'."$hide_hit".'";

'."?>";

$setup_file=$board_id."_config.php";
$file=@fopen($setup_file,"w");
?>

<html lang="ko">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>f2plus gallery ver3.0 install page</title>
<meta name="generator" content="Namo WebEditor v5.0">
<style>
BODY,TD {font-size:9pt;font-family:굴림;color:ffffff;line-height:160%}

.thm7pt {font-family:tahoma;font-size:7pt}

A:link    {color:white;text-decoration:none;}
A:visited {color:white;text-decoration:none;}
A:active  {color:white;text-decoration:none;}
A:hover   {color:cccccc;text-decoration:underline}
</style>
</head>

<body bgcolor="black" text="black" link="blue" vlink="purple" alink="red" leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr valign=top>
	<td>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="80">
		<tr valign=center><td></td>
		</tr>
		</table>
		<table border="0" cellpadding="10" cellspacing="0" width="80%" align=center>
		<tr valign=center><td><a href=<?=urlencode("매뉴얼.txt")?> target=_blank><U>※ " 설정하시기 전에 이곳을 클릭해 꼭 메뉴얼을 참조하세요."</U></a></td>
		</tr>
		</table>

		<form name=write method=post action=install_ok.php>
		<table border="0" cellpadding="5" cellspacing="0" width="80%" align=center style=talbe-layout:fixed>
		<tr height=30><td></td></tr>
		<tr valign=middle  height=20>
			<td>
<?
if(!$file){ 
	echo "config.php 파일 쓰기에 실패하였습니다.<br> 스킨폴더의 퍼미션을 <font color=FF2400><B>707</B></font>로 조정하고 다시 인스톨하세요<br>";
}else{
	fwrite($file,$str);

	if(!is_dir($zbpath."data/$board_id/")) { 
		if(!@mkdir($zbpath."data/$board_id/",0777)) echo "제로보드의 절대경로를 바르게 입력하세요<br>";
		if(!@chmod($zbpath."data/$board_id/",0707)) echo "퍼미션 조정에 실패했습니다.<br>$zb_path/data/$board_id 의 퍼미션을 707 로 조정하세요<br><br>";
	}
	$error_check1=0;
	$error_check2=0;

	if($gd_use>=1){
		if(!is_dir($zbpath."data/$board_id/thumbnail/")) { 
			if(!@mkdir($zbpath."data/$board_id/thumbnail/",0777)) $error_check1+=1;
			if(!@chmod($zbpath."data/$board_id/thumbnail/",0707)) $error_check1+=2;
		}
		if(!is_dir($zbpath."icon/thumbnail/")) { 
			if(!@mkdir($zbpath."icon/thumbnail/",0777)) $error_check2+=1;
			if(!@chmod($zbpath."icon/thumbnail/",0707)) $error_check2+=2;
		}
	}

	if($error_check1==2) echo "<br> ".$zb_path."data/$board_id/thumbnail/ 디렉토리의 권한을 707로 설정하세요<br><br> ";
	elseif($error_check1==3) echo "<br> ".$zb_path."data/$board_id/ 디렉토리 내에 thumbnail 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

	if($error_check2==2) echo "<br> ".$zb_path."icon/thumbnail/ 디렉토리의 권한을 707로 설정하세요<br><br>";
	elseif($error_check2==3) echo "<br> ".$zb_path."icon 디렉토리 내에 thumbnail 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

	if($exif==1){
		if(file_exists("exiflist")){
			if(!@chmod("exiflist",0505)){
				echo "<br>exiflist 파일의 퍼미션 자동 조정에 실패 했습니다.<br>exiflist 파일의 퍼미션을 <font color=FF2400><B>505</B></font> 로 수정하세요<br>반드시 퍼미션을 조정하셔야 합니다. 이 파일의 경우는 수동으로 설정 퍼미션을 설정하셔야 합니다.<br>수동으로 exiflist 파일의 퍼미션을 <font color=FF2400><B>505</B></font>로 바꾸셨다면 이 메세지는 무시하셔도 됩니다.<BR>";
			}else echo "퍼미션 조정에 성공하였습니다.";

		}else echo "exiflist 파일이 존재하지 않습니다. 파일이 업로드 되었는지 확인하세요";
	}

	if(($error_check1+$error_check2)>0) echo "<br><br><font color=red>설치가 제대로 이루어 지지 않았습니다.<br> 수동으로 디렉토리를 생성시켜 주시고 권한을 설정해주시거나<br> 아래의 설정하기를 누르셔서 정확한 경로를 입력하시고 다시 설치하여 주십시오</font><br>";
	else echo "<br><font color=yellow>모든 설치가 성공적으로 끝이 났습니다.<br>아래의 게시판으로 가기를 클릭하시면 해당 게시판으로 이동합니다.</font><br>";


	echo "<br><br><br><br><a href=$zburl/zboard.php?id=$board_id><font color=4EFF00><B>게시판으로 이동</B></font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:history.back(-1)'>설정으로가기</a>";
}
?>

			</td>
		</tr>
		</table>
		</form>
	</td>
</tr>
</table>
<table border=0 width=100% cellspacing=0 cellpadding=10px>
<tr height=10 align=right><td class=thm7pt>Copyright 2003 by <a href=http://www.f2plus.com>www.f2plus.com</a></td></tr>
</table>
