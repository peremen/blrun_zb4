<?
if(!defined("_zb_lib_included")) return;
if(preg_match("/:\/\//i",$dir)||preg_match("/\.\./i",$dir)) $dir ="./";

// 쿠키값을 이용;;
$name=$zetyx[name];
$email=$zetyx[email];
$homepage=$zetyx[homepage];

// 회원일때는 기본 입력사항 안보이게;;
if($member[no]) { $hide_start="<!--"; $hide_end="-->"; }

// HTML 사용 체크를 확장시킴
if($mode!="reply") {
	if(!$data[use_html]) $value_use_html = 1;
	else $value_use_html=$data[use_html];
} else {
	$value_use_html=1;
}
$use_html .= " value='$value_use_html' onclick='check_use_html(this)'><ZeroBoard";

// 비밀글 사용;;
if(!$setup[use_secret]) { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

// 공지기능 사용하는지 않하는지 표시;;
if(!$is_admin||$mode=="reply") { $hide_notice_start="<!--";$hide_notice_end="-->"; }

include $dir."/write.php";
?>
