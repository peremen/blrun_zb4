<?
unset($thumb_img);
unset($thumb_img1);
unset($thumb_img2);
unset($thumb_img12);
unset($thumb_img22);
unset($img_info);
unset($ran);

srand((double)microtime()*1000000);
$ran=mt_rand(0,1);

$error_check=0;
$file1_check=0;

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
		if(!file_exists($Thumbnail_path.$Thumbnail_small1) || !file_exists($Thumbnail_path.$Thumbnail_large1)){
			$size=array(52,200);
			thumbnail($size,$src_img1,$Thumbnail_path,$Thumbnail_small1,$Thumbnail_large1,3/4);
		}
		$thumb_img1=$Thumbnail_url.$Thumbnail_large1;
		$thumb_img12=$Thumbnail_url.$Thumbnail_small1;

	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out[0][1].".".$out[0][2])) {

		$src_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(file_exists($src_img1) && (!file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small1) || !file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_large1))){
			$size=array(52,200);
			thumbnail($size,$src_img1,$Thumbnail_path.$data[ismember]."/",$iThumbnail_small1,$iThumbnail_large1,3/4);
			$thumb_img1=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_large1));
			$thumb_img12=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small1));
		}elseif(!file_exists($src_img1)){
			$src_img1=$dir."/images/no_image.gif";
			$thumb_img1="";
			$thumb_img12="";
		}else{
			$thumb_img1=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_large1));
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
		if(!file_exists($Thumbnail_path.$Thumbnail_small2) || !file_exists($Thumbnail_path.$Thumbnail_large2)){
			$size=array(52,200);
			thumbnail($size,$src_img2,$Thumbnail_path,$Thumbnail_small2,$Thumbnail_large2,3/4);
		}
		$thumb_img2=$Thumbnail_url.$Thumbnail_large2;
		$thumb_img22=$Thumbnail_url.$Thumbnail_small2;

	}elseif($file1_check==1&&preg_match("#\.(jpg|jpeg|png)$#i",$out[0][1].".".$out[0][2])) {

		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(file_exists($src_img2) && (!file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small1) || !file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_large1))){
			$size=array(52,200);
			thumbnail($size,$src_img2,$Thumbnail_path.$data[ismember]."/",$iThumbnail_small1,$iThumbnail_large1,3/4);
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_large1));
			$thumb_img22=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small1));
		}elseif(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
			$thumb_img22="";
		}else{
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_large1));
			$thumb_img22=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small1));
		}

	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out[1][1].".".$out[1][2])) {

		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(file_exists($src_img2) && (!file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small2) || !file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_large2))){
			$size=array(52,200);
			thumbnail($size,$src_img2,$Thumbnail_path.$data[ismember]."/",$iThumbnail_small2,$iThumbnail_large2,3/4);
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_large2));
			$thumb_img22=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small2));
		}elseif(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
			$thumb_img22="";
		}else{
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_large2));
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

	if($thumb_img1&&$thumb_img2){                              //���ε� �̹��� ������ �Ѵ� ������ 
		$img_tag=image_tag($thumb_img1,$thumb_img2);     //���ε� �̹����� �Ѵ� ������ ���콺 ������ �Ѵ� ������
		$thumb_img=$ran_img1[$ran];           
		$source_img=$ran_img2[$ran];
	}                                                       //����Ʈ ���ο����� ù��° ������ ����ϸ� ������
	elseif($thumb_img1&&!$thumb_img2){                     //���ε� �̹��� 1�����ϸ� ������
		$img_tag=image_tag($thumb_img1,"");                //�ϳ��� ������ �ϳ��� ������
		$thumb_img=$ran_img1[0];
		$source_img=$ran_img2[0];
	}
	elseif(!$thumb_img1&&$thumb_img2){   //���ε� �̹��� 2�� ���ϸ� ������
		$img_tag=image_tag($thumb_img2,"");
		$thumb_img=$ran_img1[1];
		$source_img=$ran_img2[1];
	}
	else{                                // ���ε� �̹��� ������ ������
		$img_tag=image_tag("$dir/images/no_image.gif","");
		$thumb_img=$ran_img2[2];     //������� �̸� ������ �̹��� ���� ���.�����ϼŵ� �˴ϴ�.
		$source_img=$ran_img2[2];
	}

	$img_info=getimagesize(urldecode($source_img));

	if($img_show=="on"){
		$view_img="<a onclick=window.open('$dir/img_view.php?img=$source_img&width=$img_info[0]&height=$img_info[1]','view_info','width=640,height=480,toolbar=no,scrollbars=no') onfocus='this.blur();' onMouseMove=\"msgposit(-35,50,event)\";  onMouseOver=\"msgset('$img_tag')\"; onMouseOut=\"msghide();\" 'class=shadow' style='cursor:pointer'>";
	}else {
		  $view_img="<a href=$zb_url/$view_target?$href$sort&no=$data[no] onMouseMove=\"msgposit(-35,50,event)\";  onMouseOver=\"msgset('$img_tag')\"; onMouseOut=\"msghide();\" 'class=shadow' style='cursor:pointer'>";
	}
			 // �ڹ� ��ũ��Ʈ�� �̿��� ���콺 ������ ���극�̾� â���� �̹��� ���
}else{

	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name1])) {
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

	$ran_img1=array($thumb_img1,$thumb_img2,$dir."/images/no_image.gif");

	if($thumb_img1&&$thumb_img2){                              //���ε� �̹��� ������ �Ѵ� ������ 
		$img_tag=image_tag($thumb_img1,$thumb_img2);     //���ε� �̹����� �Ѵ� ������ ���콺 ������ �Ѵ� ������
		$thumb_img=$ran_img1[$ran];
	}                                                       //����Ʈ ���ο����� ù��° ������ ����ϸ� ������
	elseif($thumb_img1&&!$thumb_img2){                     //���ε� �̹��� 1�����ϸ� ������
		$img_tag=image_tag($thumb_img1,"");                //�ϳ��� ������ �ϳ��� ������
		$thumb_img=$ran_img1[0];
	}
	elseif(!$thumb_img1&&$thumb_img2){   //���ε� �̹��� 2�� ���ϸ� ������
		$img_tag=image_tag($thumb_img2,"");
		$thumb_img=$ran_img1[1];
	}
	else{                                // ���ε� �̹��� ������ ������
		$img_tag=image_tag($ran_img1[2],"");
		$thumb_img=$ran_img1[2];     //������� �̸� ������ �̹��� ���� ���.�����ϼŵ� �˴ϴ�.;
	}

	$img_info=getimagesize(urldecode($thumb_img));

	if($img_show=="on"){
		$view_img="<a onclick=window.open('$dir/img_view.php?img=$thumb_img&width=$img_info[0]&height=$img_info[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no') onfocus='this.blur();' onMouseMove=\"msgposit(-35,50,event)\";  onMouseOver=\"msgset('$img_tag')\"; onMouseOut=\"msghide();\" 'class=shadow' style='cursor:pointer'>";
	}else {
		$view_img="<a href=$zb_url/$view_target?$href$sort&no=$data[no] onMouseMove=\"msgposit(-35,50,event)\";  onMouseOver=\"msgset('$img_tag')\"; onMouseOut=\"msghide();\" 'class=shadow' style='cursor:pointer'>";
	}
			 // �ڹ� ��ũ��Ʈ�� �̿��� ���콺 ������ ���극�̾� â���� �̹��� ���
}
   
?>