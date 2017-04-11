<?
@extract($_GET);
@extract($_POST);

function rmdirAll($dir) {
	$dirs = dir($dir);
	while(false !== ($entry = $dirs->read())) {
		if(($entry != '.') && ($entry != '..')) {
			if(is_dir($dir.'/'.$entry)) {
				rmdirAll($dir.'/'.$entry);
			} else {
				@unlink($dir.'/'.$entry);
			}
		}
	}
	$dirs->close();
	@rmdir($dir);
}

function delete_file($filename) {
	if(@file_exists($filename)) {
		@chmod($filename,0777);
		if(preg_match("#\/([^.]+?)\.(jpg)$#i",$filename))
			$handle = @unlink($filename);
		else
			@rmdirAll($filename);
	}
	return $handle;
}

function file_del($path) {

	$handle= dir($path);
	while(false !== ($info = $handle->read())) {
		if($info != "." && $info != "..") {
			@delete_file($path.$info);
		}
	}
	$handle->close();
}

$path=$zb_path."data/".$id."/thumbnail/";
@file_del($path);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<TITLE>썸네일 삭제</TITLE>
</HEAD>
<BODY onLoad='window.close();'>
</BODY>
</HTML>
