<?
unset($thumb_img);
unset($thumb_img1);
unset($thumb_img2);
unset($img_info);
unset($ran);

srand((double)microtime()*1000000);
$ran=mt_rand(0,1);

$error_check=0;
$file1_check=0;

$view_large1="fXL_".$data[reg_date].".jpg";
$view_large2="sXL_".$data[reg_date].".jpg";

//iview_large ����� �̹��� ���� ����
if($_view_included==true){
	$imagePattern="#<img src\=\'icon\/member_image_box\/([^/]+?)\/(.+?)\.(jpg|jpeg|gif|png|bmp)\'#i";
	preg_match_all($imagePattern,$data[memo],$out3,PREG_SET_ORDER);
	//�Ѱ��ִ� out ���� ����
	$out3[0][1]=urldecode($out3[0][2]);
	$out3[1][1]=urldecode($out3[1][2]);
	$out3[0][2]=$out3[0][3];
	$out3[1][2]=$out3[1][3];
}else{
	$imagePattern="#\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,#i";
	preg_match_all($imagePattern,$data[memo],$out3,PREG_SET_ORDER);
}
$iview_large1="fXL_".$out3[0][1].".jpg";
$iview_large2="sXL_".$out3[1][1].".jpg";


if($Thumbnail_use=="on"){
	//����� ���丮 �� �� ȸ���� ���丮 ����
	if(!is_dir($zb_path."data/$id/thumbnail/".$data[ismember]."/")) {
		if(!@mkdir($zb_path."data/$id/thumbnail/".$data[ismember]."/",0777)) $error_check+=1;
		if(!@chmod($zb_path."data/$id/thumbnail/".$data[ismember]."/",0707)) $error_check+=2;
	}
	if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$data[ismember]."/ ���丮�� ������ 707�� �����ϼ���<br><br>";
	elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ ���丮 ���� ".$data[ismember]."�� ȸ�� ���丮 ������ �����߽��ϴ�.<br> �ش��ο� ���丮�� �������� �ֽð� ������ 707�� �����ϼ���<br><br>";

	if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name1])){
		$file1_check=1;
		$src_img1=$data[file_name1];
		if(!file_exists($Thumbnail_path.$Thumbnail_small1) || !file_exists($Thumbnail_path.$view_large1)){
			$size=array($min_width_size,$max_width_size);
			thumbnail($size,$src_img1,$Thumbnail_path,$Thumbnail_small1,$view_large1,3/4);
		}
		$thumb_img1=$Thumbnail_url.$view_large1;
		$thumb_img12=$Thumbnail_url.$Thumbnail_small1;

	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out[0][1].".".$out[0][2])) {
		$src_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(file_exists($src_img1) && (!file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small1) || !file_exists($Thumbnail_path.$data[ismember]."/".$iview_large1))){
			$size=array($min_width_size,$max_width_size);
			thumbnail($size,$src_img1,$Thumbnail_path.$data[ismember]."/",$iThumbnail_small1,$iview_large1,3/4);
			$thumb_img1=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iview_large1));
			$thumb_img12=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small1));
		}elseif(!file_exists($src_img1)){
			$src_img1=$dir."/images/no_image.gif";
			$thumb_img1="";
			$thumb_img12="";
		}else{
			$thumb_img1=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iview_large1));
			$thumb_img12=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small1));
		}

	}elseif(preg_match("#\.(gif|bmp)$#i",$data[file_name1])){
		$file1_check=1;
		$src_img1=str_replace("%2F", "/", urlencode($data[file_name1]));
		$thumb_img1=$src_img1;
		$thumb_img12=$src_img1;
	}elseif(preg_match("#\.(gif|bmp)$#i",$out[0][1].".".$out[0][2])) {
		$src_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(!file_exists($src_img1)){
			$src_img1=$dir."/images/no_image.gif";
			$thumb_img1="";
			$thumb_img12="";
		}else{
			$thumb_img1=str_replace("%2F", "/", urlencode($src_img1));
			$thumb_img12=str_replace("%2F", "/", urlencode($src_img1));
		}
	}

	if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name2])){
		$src_img2=$data[file_name2];
		if(!file_exists($Thumbnail_path.$Thumbnail_small2) || !file_exists($Thumbnail_path.$view_large2)){
			$size=array($min_width_size,$max_width_size);
			thumbnail($size,$src_img2,$Thumbnail_path,$Thumbnail_small2,$view_large2,3/4);
		}
		$thumb_img2=$Thumbnail_url.$view_large2;
		$thumb_img22=$Thumbnail_url.$Thumbnail_small2;

	}elseif($file1_check==1&&preg_match("#\.(jpg|jpeg|png)$#i",$out[0][1].".".$out[0][2])) {

		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(file_exists($src_img2) && (!file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small1) || !file_exists($Thumbnail_path.$data[ismember]."/".$iview_large1))){
			$size=array($min_width_size,$max_width_size);
			thumbnail($size,$src_img2,$Thumbnail_path.$data[ismember]."/",$iThumbnail_small1,$iview_large1,3/4);
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iview_large1));
			$thumb_img22=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small1));
		}elseif(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
			$thumb_img22="";
		}else{
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iview_large1));
			$thumb_img22=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small1));
		}

	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out[1][1].".".$out[1][2])) {

		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(file_exists($src_img2) && (!file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small2) || !file_exists($Thumbnail_path.$data[ismember]."/".$iview_large2))){
			$size=array($min_width_size,$max_width_size);
			thumbnail($size,$src_img2,$Thumbnail_path.$data[ismember]."/",$iThumbnail_small2,$iview_large2,3/4);
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iview_large2));
			$thumb_img22=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small2));
		}elseif(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
			$thumb_img22="";
		}else{
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iview_large2));
			$thumb_img22=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small2));
		}

	}elseif(preg_match("#\.(gif|bmp)$#i",$data[file_name2])){
		$src_img2=str_replace("%2F", "/", urlencode($data[file_name2]));
		$thumb_img2=$src_img2;
		$thumb_img22=$src_img2;
	}elseif($file1_check==1&&preg_match("#\.(gif|bmp)$#i",$out[0][1].".".$out[0][2])) {
		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
			$thumb_img22="";
		}else{
			$thumb_img2=str_replace("%2F", "/", urlencode($src_img2));
			$thumb_img22=str_replace("%2F", "/", urlencode($src_img2));
		}
	}elseif(preg_match("#\.(gif|bmp)$#i",$out[1][1].".".$out[1][2])) {
		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
			$thumb_img22="";
		}else{
			$thumb_img2=str_replace("%2F", "/", urlencode($src_img2));
			$thumb_img22=str_replace("%2F", "/", urlencode($src_img2));
		}
	}

	$ran_img1=array($thumb_img12,$thumb_img22);
	$ran_img2=array($src_img1,$src_img2,$dir."/images/no_image.gif");
	$ran_img3=array($thumb_img1,$thumb_img2);

	if($thumb_img1&&$thumb_img2){
		$img_tag=$ran_img3[$ran];
		$thumb_img=$ran_img1[$ran];
		$source_img=$ran_img2[$ran];
	}
	elseif($thumb_img1&&!$thumb_img2){
		$img_tag=$ran_img3[0];
		$thumb_img=$ran_img1[0];
		$source_img=$ran_img2[0];
	}
	elseif(!$thumb_img1&&$thumb_img2){
		$img_tag=$ran_img3[1];
		$thumb_img=$ran_img1[1];
		$source_img=$ran_img2[1];
	}
	else{
		$img_tag=$ran_img2[2];
		$thumb_img=$ran_img2[2];
		$source_img=$ran_img2[2];
	}

    $img_info=getimagesize(urldecode($source_img));
	$img_info[0]=$img_info[0]+10;
	$img_info[1]=$img_info[1]+55;

	$view_img="<span style=\"cursor:pointer\" onClick='transimg(\"image\",\"$img_tag\")'>";
	$full_img="<a onclick=window.open('$dir/img_view.php?img=$source_img&width=$img_info[0]&height=$img_info[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no') onfocus=this.blur(); class=shadow style=cursor:pointer>";

}else{
	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name1])){
		$file1_check=1;
		$thumb_img1=$data[file_name1];
	}elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out[0][1].".".$out[0][2])){
		$thumb_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(!file_exists($thumb_img1)) $thumb_img1="";
	}

	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name2]))
		$thumb_img2=$data[file_name2];
	elseif($file1_check==1&&preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out[0][1].".".$out[0][2])){
		$thumb_img2="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(!file_exists($thumb_img2)) $thumb_img2="";
	}elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out[1][1].".".$out[1][2])){
		$thumb_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(!file_exists($thumb_img2)) $thumb_img2="";
	}

	$thumb_img1=str_replace("%2F", "/", urlencode($thumb_img1));
	$thumb_img2=str_replace("%2F", "/", urlencode($thumb_img2));

	$ran_img2=array($thumb_img1,$thumb_img2,$dir."/images/no_image.gif");

	if($thumb_img1&&$thumb_img2){                              //���ε� �̹��� ������ �Ѵ� ������
		$img_tag=$ran_img2[$ran];
		$thumb_img=$ran_img2[$ran];            //����Ʈ ���ο��� ������ 75 X 56 �������� �����
	}                                                       //����Ʈ ���ο����� ù��° ������ ����ϸ� ������
	elseif($thumb_img1&&!$thumb_img2){                     //���ε� �̹��� 1�����ϸ� ������
		$img_tag=$ran_img2[0];               //�ϳ��� ������ �ϳ��� ������
		$thumb_img=$ran_img2[0];
	}
	elseif(!$thumb_img1&&$thumb_img2){   //���ε� �̹��� 2�� ���ϸ� ������
		$img_tag=$ran_img2[1];
		$thumb_img=$ran_img2[1];
	}
	else{                                // ���ε� �̹��� ������ ������
		$img_tag=$ran_img2[2];
		$thumb_img=$ran_img2[2];     //������� �̸� ������ �̹��� ���� ���.�����ϼŵ� �˴ϴ�.
	}

	$img_info=getimagesize(urldecode($thumb_img));
	$img_info[0]=$img_info[0]+10;
	$img_info[1]=$img_info[1]+55;

	$view_img="<span style=\"cursor:pointer\" onClick='transimg(\"image\",\"$img_tag\")'>";
	$full_img="<a onclick=window.open('$dir/img_view.php?img=$thumb_img&width=$img_info[0]&height=$img_info[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no') class=shadow style='cursor:pointer'>";
}
?>