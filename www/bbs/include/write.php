<?
	if(!defined("_zb_lib_included")) return;
	if(preg_match("/:\/\//i",$dir)||preg_match("/\.\./i",$dir)) $dir ="./";

	// ��Ű���� �̿�;;
	$name=$zetyx[name];
	$email=$zetyx[email];
	$homepage=$zetyx[homepage];

	// ȸ���϶��� �⺻ �Է»��� �Ⱥ��̰�;;
	if($member[no]) { $hide_start="<!--"; $hide_end="-->"; }

	// ��б� ���;;
	if(!$setup[use_secret]) { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

	// ������� ����ϴ��� ���ϴ��� ǥ��;;
	if(!$is_admin||$mode=="reply") { $hide_notice_start="<!--";$hide_notice_end="-->"; }

	include $dir."/write.php";
?>
