<?
// �˻�� �ش��ϴ� ���ڸ� ����;; ������ �ٲپ���;;
if($keyword) {
	if($sn=="on") $reply_data[name]=str_replace($keyword,"<font color=red>$keyword</font>",$reply_data[name]);
	if($ss=="on") $reply_data[subject]=str_replace($keyword,"<font color=red>$keyword</font>",$reply_data[subject]);
	if($sc=="on") $reply_data[memo]=str_replace($keyword,"<font color=red>$keyword</font>",$reply_data[memo]);
	if($ss=="on"&&$setup[cut_length]>0) $setup[cut_length]=$setup[cut_length]+16;
}

// ' " \ ���� Ư�����ڶ����� del_html �� ���ش�
$name=$reply_data[name]=del_html($reply_data[name]);  // �̸�
$email=$reply_data[email]=del_html($reply_data[email]);  // ����
$subject=$reply_data[subject]=del_html($reply_data[subject]); // ����
$subject=cut_str($subject,$setup[cut_length]); // ���� �ڸ��� �κ�
if($member[level]<=$setup[grant_view]) $subject="<a href=view.php?$href$sort&no=$reply_data[no]>".$subject."</a>"; // ���� ��ũ �Ŵ� �κ�;
$homepage=$reply_data[homepage]=del_html($reply_data[homepage]);
if($homepage) $homepage="<a href=$homepage target=_blank>$homepage</a>";
$memo=$reply_data[memo]=nl2br($reply_data[memo]); // ����
$memo=autolink($memo); // �ڵ���ũ �Ŵ� �κ�;;
$hit=$reply_data[hit];  // ��ȸ��
$vote=$reply_data[vote];  // ��ǥ��
if($setup[use_showip]||$is_admin)$ip="IP Address : ".$reply_data[ip]."&nbsp;";  // ������
$comment_num="[".$reply_data[total_comment]."]"; // ������ ��� ��
$sitelink1=$reply_data[sitelink1]=del_html($reply_data[sitelink1]);
$sitelink2=$reply_data[sitelink2]=del_html($reply_data[sitelink2]);
if($sitelink1)$sitelink1="<a href=$sitelink1 target=_blank>$sitelink1</a>";
if($sitelink2)$sitelink2="<a href=$sitelink2 target=_blank>$sitelink2</a>";
$file_name1=$reply_data[s_file_name1];
$file_name2=$reply_data[s_file_name2];
$file_download1=$reply_data[download1];
$file_download2=$reply_data[download2];

if($file_name1) {
	$file_size1=@GetFileSize(filesize($reply_data[file_name1]));
	$a_file_link1="<a href=download.php?$href$sort&no=$reply_data[no]&filenum=1>";
} else $a_file_link="<Zeroboard";

if($file_name2) {
	$file_size2=@GetFileSize(filesize($reply_data[file_name2]));
	$a_file_link2="<a href=download.php?$href$sort&no=$reply_data[no]&filenum=2>";
} else $a_file_link="Zeroboard";

if($comment_num==0) $comment_num="";

$upload_image1=$upload_image2="";

if(preg_match("/\.jpg/i",$file_name1)||preg_match("/\.gif/i",$file_name1)||preg_match("/\.png/i",$file_name1)) $upload_image1="<img src=$reply_data[file_name1] border=0><br>";
if(preg_match("/\.jpg/i",$file_name2)||preg_match("/\.gif/i",$file_name2)||preg_match("/\.png/i",$file_name2)) $upload_image2="<img src=$reply_data[file_name2] border=0><br>";

// ī�װ��� �̸��� ����
if($reply_data[category]&&$setup[use_category]) $category_name=$category_data[$reply_data[category]];
else $category_name="&nbsp;";

// �۾� �ð��� ����� �ú��� �� ��ȯ��
$reg_date="<span title='".date("Y�� m�� d�� H�� i�� s��", $reply_data[reg_date])."'>".date("Y/m/d", $reply_data[reg_date])."</span>";

$temp_name = get_private_icon($reply_data[ismember], "2");
if($temp_name) $name="<img src='$temp_name' border=0 align=absmiddle>";

// �����ּҰ� ������ �̸��� ���� ��ũ��Ŵ
if(!isblank($email)||$reply_data[ismember]) {
	if(!$setup[use_formmail]) $name="<a href=mailto:$email>$name</a>";
	else $name="<a href=javascript:void(window.open('view_info.php?to=$email&id=$id&member_no=$reply_data[ismember]','mailform','width=400,height=500,statusbar=no,scrollbars=yes,toolbar=no'))>$name</a>";
}

// Depth�� ���� ���Ӱ��� ����
$insert="";
for($z=0;$z<$reply_data[depth];$z++) $insert .="&nbsp; ";

$icon=get_icon($reply_data);

// �̸��տ� �ٴ� ������ ����;;
$face_image=get_face($reply_data);

// �ٷ� ���� �� ���� ��� ��ȣ�� ���������� �ٲ�
if($no==$reply_data[no]) $number="<img src=$dir/arrow.gif border=0 align=absmiddle>"; elseif($number!="&nbsp;") $number=$roop_number;

// ��� ��ư
if(($is_admin||$member[level]<=$setup[grant_reply])&&$reply_data[headnum]>-2000000000&&$reply_data[headnum]!=-1) $a_reply="<a href=write.php?$href$sort&no=$reply_data[no]&mode=reply>"; else $a_reply="<Zeroboard";
// ������ư
if(($is_admin||$member[level]<=$setup[grant_delete]||$reply_data[ismember]==$member[no]||!$reply_data[ismember])&&!$reply_data[child]) $a_delete="<a href=delete.php?$href$sort&no=$reply_data[no]>"; else $a_delete="<Zeroboard";
// ������ư
if(($is_admin||$member[level]<=$setup[grant_delete]||$reply_data[ismember]==$member[no]||!$reply_data[ismember])) $a_modify="<a href=write.php?$href$sort&no=$reply_data[no]&mode=modify>"; else $a_modify="<Zeroboard";
?>