<?
set_time_limit (0);
$_zb_path="../";
include "../lib.php";
if(!$connect) $connect=dbConn();
$member=member_info();
if(!$member[no]||$member[is_admin]>1||$member[level]>1) Error("최고 관리자만이 사용할수 있습니다");
head(" bgcolor=white");
?>

<div align=center>
<br>
<table border=0 cellspacing=0 cellpadding=0 width=98%>
<tr>
  <td><img src=../images/arrangefiles.gif border=0></td>
  <td width=100% background=../images/trace_back.gif><img src=../images/trace_back.gif border=0></td>
  <td><img src=../images/trace_right.gif border=0></td>
</tr>
<tr>
  <td colspan=3 style=padding:15px;line-height:160%>
  	이 페이지는 쓰레기 파일들을 정리하는 곳입니다.<br>
	data 디렉토리내의 모든 파일을 정리하는 관계로 파일수에 따라서 매우 많은 시간이 걸릴수 있습니다.<br>
  </td>
</tr>
</table>
</div>
<?flush()?>

<pre>

	DB Checking
<?
// DB 내의 파일 목록을 구함
$result = mysql_query("select name from $admin_table order by name desc") or die(mysql_error());
unset($dblist);

while($bbs=mysql_fetch_array($result)) {
	$id = $bbs[name];

	echo ".";
	flush();
	$nfiles1 = mysql_query("select file_name1 from $t_board"."_$id where file_name1 !=''") or die(mysql_error());
	$nfiles2 = mysql_query("select file_name2 from $t_board"."_$id where file_name2 !=''") or die(mysql_error());
	$nfiles3 = mysql_query("select file_name1 from $t_comment"."_$id where file_name1 !=''") or die(mysql_error());
	$nfiles4 = mysql_query("select file_name2 from $t_comment"."_$id where file_name2 !=''") or die(mysql_error());

	while($data=mysql_fetch_array($nfiles1)) {
		$filename = $data['file_name1'];
		if(file_exists("../".$filename)) $dblist[] = $filename;
	}

	while($data=mysql_fetch_array($nfiles2)) {
		$filename = $data['file_name2'];
		if(file_exists("../".$filename)) $dblist[] = $filename;
	}

	while($data=mysql_fetch_array($nfiles3)) {
		$filename = $data['file_name1'];
		if(file_exists("../".$filename)) $dblist[] = $filename;
	}

	while($data=mysql_fetch_array($nfiles4)) {
		$filename = $data['file_name2'];
		if(file_exists("../".$filename)) $dblist[] = $filename;
	}

}

$totaldblist = count($dblist);
?>
	
	File list checking
<?
// 전체 파일 목록을 구함
unset($list);
$i = 0;
function getFileList($path) {
	global $list;
	global $i;
	$directory = dir($path);
	while($entry = $directory->read()) {
		if ($entry != "." && $entry != "..") {
			if (Is_Dir($path."/".$entry)&&!preg_match("/__zbSessionTMP/i",$path."/".$entry)&&!preg_match("/latest_thumb/i",$path."/".$entry)&&!preg_match("/thumbnail/i",$path."/".$entry)) {
				getFileList($path."/".$entry);
			} else {
				if( !preg_match("/now_connect.php/i",$path."/".$entry) && !preg_match("/now_member_connect.php/i",$path."/".$entry) && !preg_match("/__zbSessionTMP/i",$path."/".$entry) && !preg_match("/latest_thumb/i",$path."/".$entry) && !preg_match("/thumbnail/i",$path."/".$entry) ) {
					$list[] = str_replace("../","",$path."/".$entry);
					echo ".";
					$i++;
					if($i>100) {
						$i=0;
						echo "\n		";
					}
				}
				flush();
			}
		}
	}
	$directory->close();
}
getFileList("../data");
$totallist = count($list);

// 서로 다른 내용을 정리
unset($difflist);
$difflist = @array_diff($list, $dblist);
$totaldifflist = count($difflist);
?>



	<b>DB에 등록된 파일의 갯수 :</b> <?=number_format($totaldblist)?>


	<b>전체 검색된 파일의 갯수 :</b> <?=number_format($totallist)?>


	<b>쓰레기 파일 갯수 :</b> <?=number_format($totaldifflist)?>


	쓰레기 파일 삭제중
<?
$total = 0;
$i=0;
while(list($key,$filename)=@each($difflist)) {
	//echo "	".$filename."\n";
	$tmp = explode("/",$filename);
	$last = count($tmp)-1;
	$name = $tmp[$last];
	$path = str_replace($name, "", $filename);
	//echo "		".$path."		".$name."\n";
	z_unlink("../".$filename);
	@rmdir("../".$path);
	echo ".";
	$i++;
	if($i>100) {
		$i=0;
		echo "\n		";
	}
	flush();
}
?>


	<font color=red><b>모든 정리가 끝났습니다.

	확실한 처리를 위해서 다시 한번 실행해보시기 바랍니다.</b></font>


</pre>
<br><br><br>
<?
foot();
?>
