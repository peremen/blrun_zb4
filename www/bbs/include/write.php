<?
if(!defined("_zb_lib_included")) return;
if(preg_match("/:\/\//i",$dir)||preg_match("/\.\./i",$dir)) $dir ="./";

// ��Ű���� �̿�;;
$name=$zetyx[name];
$email=$zetyx[email];
$homepage=$zetyx[homepage];

// ȸ���϶��� �⺻ �Է»��� �Ⱥ��̰�;;
if($member[no]) { $hide_start="<!--"; $hide_end="-->"; }

// HTML ��� üũ�� Ȯ���Ŵ
if($mode!="reply") {
	if(!$data[use_html]) $value_use_html = 1;
	else $value_use_html=$data[use_html];
} else {
	$value_use_html=1;
}
$use_html .= " value='$value_use_html' onclick='check_use_html(this)'><ZeroBoard";

// ��б� ���;;
if(!$setup[use_secret]) { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

// ������� ����ϴ��� ���ϴ��� ǥ��;;
if(!$is_admin||$mode=="reply") { $hide_notice_start="<!--";$hide_notice_end="-->"; }

include $dir."/write.php";
?>