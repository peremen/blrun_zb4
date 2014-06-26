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
	//썸네일 디렉토리 내 각 회원별 디렉토리 생성
	if(!is_dir($zb_path."data/$id/thumbnail/".$data[ismember]."/")) { 
		if(!@mkdir($zb_path."data/$id/thumbnail/".$data[ismember]."/",0777)) $error_check+=1;
		if(!@chmod($zb_path."data/$id/thumbnail/".$data[ismember]."/",0707)) $error_check+=2;
	}
	if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$data[ismember]."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
	elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$data[ismember]."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

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

	if($thumb_img1&&$thumb_img2){                              //업로드 이미지 파일이 둘다 있을때 
		$img_tag=image_tag($thumb_img1,$thumb_img2);     //업로드 이미지가 둘다 있을때 마우스 오버시 둘다 보여짐
		$thumb_img=$ran_img1[$ran];           
		$source_img=$ran_img2[$ran];
	}                                                       //리스트 메인에서는 첫번째 파일의 썸네일만 보여짐
	elseif($thumb_img1&&!$thumb_img2){                     //업로드 이미지 1번파일만 있을때
		$img_tag=image_tag($thumb_img1,"");                //하나만 있을땐 하나만 보여짐
		$thumb_img=$ran_img1[0];
		$source_img=$ran_img2[0];
	}
	elseif(!$thumb_img1&&$thumb_img2){   //업로드 이미지 2번 파일만 있을때
		$img_tag=image_tag($thumb_img2,"");
		$thumb_img=$ran_img1[1];
		$source_img=$ran_img2[1];
	}
	else{                                // 업로드 이미지 파일이 없을때
		$img_tag=image_tag("$dir/images/no_image.gif","");
		$thumb_img=$ran_img2[2];     //없을경우 미리 지정된 이미지 파일 사용.변경하셔두 됩니다.
		$source_img=$ran_img2[2];
	}

	$img_info=getimagesize(urldecode($source_img));

	if($img_show=="on"){
		$view_img="<a onclick=window.open('$dir/img_view.php?img=$source_img&width=$img_info[0]&height=$img_info[1]','view_info','width=640,height=480,toolbar=no,scrollbars=no') onfocus='this.blur();' onMouseMove=\"msgposit(-35,50,event)\";  onMouseOver=\"msgset('$img_tag')\"; onMouseOut=\"msghide();\" 'class=shadow' style='cursor:pointer'>";
	}else {
		  $view_img="<a href=$zb_url/$view_target?$href$sort&no=$data[no] onMouseMove=\"msgposit(-35,50,event)\";  onMouseOver=\"msgset('$img_tag')\"; onMouseOut=\"msghide();\" 'class=shadow' style='cursor:pointer'>";
	}
			 // 자바 스크립트를 이용해 마우스 오버시 서브레이어 창으로 이미지 출력
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

	if($thumb_img1&&$thumb_img2){                              //업로드 이미지 파일이 둘다 있을때 
		$img_tag=image_tag($thumb_img1,$thumb_img2);     //업로드 이미지가 둘다 있을때 마우스 오버시 둘다 보여짐
		$thumb_img=$ran_img1[$ran];
	}                                                       //리스트 메인에서는 첫번째 파일의 썸네일만 보여짐
	elseif($thumb_img1&&!$thumb_img2){                     //업로드 이미지 1번파일만 있을때
		$img_tag=image_tag($thumb_img1,"");                //하나만 있을땐 하나만 보여짐
		$thumb_img=$ran_img1[0];
	}
	elseif(!$thumb_img1&&$thumb_img2){   //업로드 이미지 2번 파일만 있을때
		$img_tag=image_tag($thumb_img2,"");
		$thumb_img=$ran_img1[1];
	}
	else{                                // 업로드 이미지 파일이 없을때
		$img_tag=image_tag($ran_img1[2],"");
		$thumb_img=$ran_img1[2];     //없을경우 미리 지정된 이미지 파일 사용.변경하셔두 됩니다.;
	}

	$img_info=getimagesize(urldecode($thumb_img));

	if($img_show=="on"){
		$view_img="<a onclick=window.open('$dir/img_view.php?img=$thumb_img&width=$img_info[0]&height=$img_info[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no') onfocus='this.blur();' onMouseMove=\"msgposit(-35,50,event)\";  onMouseOver=\"msgset('$img_tag')\"; onMouseOut=\"msghide();\" 'class=shadow' style='cursor:pointer'>";
	}else {
		$view_img="<a href=$zb_url/$view_target?$href$sort&no=$data[no] onMouseMove=\"msgposit(-35,50,event)\";  onMouseOver=\"msgset('$img_tag')\"; onMouseOut=\"msghide();\" 'class=shadow' style='cursor:pointer'>";
	}
			 // 자바 스크립트를 이용해 마우스 오버시 서브레이어 창으로 이미지 출력
}
   
?>