<?
unset($prev_thumb);
unset($next_thumb);
unset($alt1);
unset($alt2);        //각종 변수들 초기화

if($Exif_use=="on"){
	if($upload_image1) $alt1=exif_info($data[file_name1]);
	if($upload_image2) $alt2=exif_info($data[file_name2]);
}

if($Thumbnail_use=="on" && $Thumbnail_view=="on"){       //썸네일 사용시
	if($upload_image1){
		if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name1])){
			if(!file_exists($Thumbnail_path.$view_large1)){
				thumbnail2($max_width_size,$data[file_name1],$Thumbnail_path.$view_large1);
			}
			$thumb_view1=$Thumbnail_url.$view_large1;
			$view_img1="<img src=$thumb_view1 border=0 name=zb_target_resize alt='$alt1'>";
		}else {
			$view_img1=str_replace("<br>","",$upload_image1);
			$view_img1=str_replace("cursor:pointer","",$view_img1);
			$view_img1=preg_replace("#onclick=\"javascript\:[^>]+?(>)#i","alt='$alt1'\\1",$view_img1);
		}
		$img_info1=@getimagesize($data[file_name1]);
		$img_info1[0]=$img_info1[0]+10;
		$img_info1[1]=$img_info1[1]+55;
		$print_img1="<a onclick=window.open('$dir/img_view.php?img=$data[file_name1]&width=$img_info1[0]&height=$img_info1[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no','status=no') style='cursor:pointer'>";
	}
	if($upload_image2){
		if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name2])){
			if(!file_exists($Thumbnail_path.$view_large2)){
				thumbnail2($max_width_size,$data[file_name2],$Thumbnail_path.$view_large2);
			}
			$thumb_view2=$Thumbnail_url.$view_large2;
			$view_img2="<img src=$thumb_view2 border=0 name=zb_target_resize alt='$alt2'>";
		}else {
			$view_img2=str_replace("<br>","",$upload_image2);
			$view_img2=str_replace("cursor:pointer","",$view_img2);
			$view_img2=preg_replace("#onclick=\"javascript\:[^>]+?(>)#i","alt='$alt2'\\1",$view_img2);
		}
		$img_info2=@getimagesize($data[file_name2]);
		$img_info2[0]=$img_info2[0]+10;
		$img_info2[1]=$img_info2[1]+55;
		$print_img2="<a onclick=window.open('$dir/img_view.php?img=$data[file_name2]&width=$img_info2[0]&height=$img_info2[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no','status=no') style='cursor:pointer'>";
	}

	//이전 및 다음 데이터의 썸네일 정보를 읽어옴
	if(preg_match("#\.(jpg|jpeg|png)$#i",$prev_data[file_name1])){

		if(!file_exists($Thumbnail_path.$Prev_thumb_small1)||!file_exists($Thumbnail_path.$Prev_thumb_large1)){
			$size=array($min_width_size,200);
			thumbnail($size,$prev_data[file_name1],$Thumbnail_path,$Prev_thumb_small1,$Prev_thumb_large1,3/4);
		}
		$prev_thumb=$Thumbnail_url.$Prev_thumb_large1;
	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out1[0][1].".".$out1[0][2])){
		//썸네일 디렉토리 내 각 회원별 디렉토리 생성
		$error_check=0;
		if(!is_dir($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/")) {
			if(!@mkdir($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/",0777,true)) $error_check+=1;
			if(!@chmod($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/",0707)) $error_check+=2;
		}
		if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$prev_data[ismember]."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
		elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$prev_data[ismember]."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

		$src_img1="icon/member_image_box/".$prev_data[ismember]."/".$out1[0][1].".".$out1[0][2];
		if(file_exists($src_img1) && (!file_exists($Thumbnail_path.$prev_data[ismember]."/".$iPrev_thumb_small1)||!file_exists($Thumbnail_path.$prev_data[ismember]."/".$iPrev_thumb_large1))){
			$size=array($min_width_size,200);
			thumbnail($size,$src_img1,$Thumbnail_path.$prev_data[ismember]."/",$iPrev_thumb_small1,$iPrev_thumb_large1,3/4);
			$prev_thumb=$Thumbnail_url.$prev_data[ismember]."/".str_replace("%2F", "/", urlencode($iPrev_thumb_large1));
		}elseif(!file_exists($src_img1)){
			$prev_thumb=$dir."/images/no_image.gif";
		}else{
			$prev_thumb=$Thumbnail_url.$prev_data[ismember]."/".str_replace("%2F", "/", urlencode($iPrev_thumb_large1));
		}

	}elseif(($src_img1=stripslashes($img1[0][1])) && !preg_match("#\.(gif|bmp)$#i",$src_img1)){
		//썸네일 디렉토리 내 각 회원별 디렉토리 생성
		$error_check=0;
		if(!is_dir($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/")) {
			if(!@mkdir($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/",0777,true)) $error_check+=1;
			if(!@chmod($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/",0707)) $error_check+=2;
		}
		if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$prev_data[ismember]."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
		elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$prev_data[ismember]."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

		if(!file_exists($Thumbnail_path.$prev_data[ismember]."/".$Prev_thumb_small1)||!file_exists($Thumbnail_path.$prev_data[ismember]."/".$Prev_thumb_large1)){
			$size=array($min_width_size,200);
			thumbnail($size,$src_img1,$Thumbnail_path.$prev_data[ismember]."/",$Prev_thumb_small1,$Prev_thumb_large1,3/4);
		}
		$prev_thumb=$Thumbnail_url.$prev_data[ismember]."/".$Prev_thumb_large1;

	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$prev_data[file_name2])){

		if(!file_exists($Thumbnail_path.$Prev_thumb_large2)||!file_exists($Thumbnail_path.$Prev_thumb_small2)){
		    $size=array($min_width_size,200);
			thumbnail($size,$prev_data[file_name2],$Thumbnail_path,$Prev_thumb_small2,$Prev_thumb_large2,3/4);
		}
		$prev_thumb=$Thumbnail_url.$Prev_thumb_large2;

	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out1[1][1].".".$out1[1][2])){
		//썸네일 디렉토리 내 각 회원별 디렉토리 생성
		$error_check=0;
		if(!is_dir($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/")) {
			if(!@mkdir($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/",0777,true)) $error_check+=1;
			if(!@chmod($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/",0707)) $error_check+=2;
		}
		if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$prev_data[ismember]."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
		elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$prev_data[ismember]."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

		$src_img1="icon/member_image_box/".$prev_data[ismember]."/".$out1[1][1].".".$out1[1][2];
		if(file_exists($src_img1) && (!file_exists($Thumbnail_path.$prev_data[ismember]."/".$iPrev_thumb_large2)||!file_exists($Thumbnail_path.$prev_data[ismember]."/".$iPrev_thumb_small2))){
			$size=array($min_width_size,200);
			thumbnail($size,$src_img1,$Thumbnail_path.$prev_data[ismember]."/",$iPrev_thumb_small2,$iPrev_thumb_large2,3/4);
			$prev_thumb=$Thumbnail_url.$prev_data[ismember]."/".str_replace("%2F", "/", urlencode($iPrev_thumb_large2));
		}elseif(!file_exists($src_img1)){
			$prev_thumb=$dir."/images/no_image.gif";
		}else{
			$prev_thumb=$Thumbnail_url.$prev_data[ismember]."/".str_replace("%2F", "/", urlencode($iPrev_thumb_large2));
		}

	}elseif(($src_img1=stripslashes($img1[1][1])) && !preg_match("#\.(gif|bmp)$#i",$src_img1)){
		//썸네일 디렉토리 내 각 회원별 디렉토리 생성
		$error_check=0;
		if(!is_dir($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/")) {
			if(!@mkdir($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/",0777,true)) $error_check+=1;
			if(!@chmod($zb_path."data/$id/thumbnail/".$prev_data[ismember]."/",0707)) $error_check+=2;
		}
		if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$prev_data[ismember]."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
		elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$prev_data[ismember]."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

		if(!file_exists($Thumbnail_path.$prev_data[ismember]."/".$Prev_thumb_small1)||!file_exists($Thumbnail_path.$prev_data[ismember]."/".$Prev_thumb_large1)){
			$size=array($min_width_size,200);
			thumbnail($size,$src_img1,$Thumbnail_path.$prev_data[ismember]."/",$Prev_thumb_small1,$Prev_thumb_large1,3/4);
		}
		$prev_thumb=$Thumbnail_url.$prev_data[ismember]."/".$Prev_thumb_large1;

	}elseif(preg_match("#\.(gif|bmp)$#i",$prev_data[file_name1]))
		$prev_thumb=str_replace("%2F", "/", urlencode($prev_data[file_name1]));
	elseif(preg_match("#\.(gif|bmp)$#i",$out1[0][1].".".$out1[0][2])){
		$src_img1="icon/member_image_box/".$prev_data[ismember]."/".$out1[0][1].".".$out1[0][2];
		$prev_thumb=str_replace("%2F", "/", urlencode($src_img1));
		if(!file_exists($src_img1)) $prev_thumb=$dir."/images/no_image.gif";
	}elseif(($src_img1=stripslashes($img1[0][1])) && preg_match("#\.(gif|bmp)$#i",$src_img1))
		$prev_thumb=$src_img1;
	elseif(preg_match("#\.(gif|bmp)$#i",$prev_data[file_name2]))
		$prev_thumb=str_replace("%2F", "/", urlencode($prev_data[file_name2]));
	elseif(preg_match("#\.(gif|bmp)$#i",$out1[1][1].".".$out1[1][2])){
		$src_img1="icon/member_image_box/".$prev_data[ismember]."/".$out1[1][1].".".$out1[1][2];
		$prev_thumb=str_replace("%2F", "/", urlencode($src_img1));
		if(!file_exists($src_img1)) $prev_thumb=$dir."/images/no_image.gif";
	}elseif(($src_img1=stripslashes($img1[1][1])) && preg_match("#\.(gif|bmp)$#i",$src_img1))
		$prev_thumb=$src_img1;
	elseif($prev_data[no]) $prev_thumb=$dir."/images/no_image.gif";

	if(preg_match("#\.(jpg|jpeg|png)$#i",$next_data[file_name1])){

		if(!file_exists($Thumbnail_path.$Next_thumb_large1)||!file_exists($Thumbnail_path.$Next_thumb_small1)){
		    $size=array($min_width_size,200);
			thumbnail($size,$next_data[file_name1],$Thumbnail_path,$Next_thumb_small1,$Next_thumb_large1,3/4);
		}
		$next_thumb=$Thumbnail_url.$Next_thumb_large1;
	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out2[0][1].".".$out2[0][2])){
		//썸네일 디렉토리 내 각 회원별 디렉토리 생성
		$error_check=0;
		if(!is_dir($zb_path."data/$id/thumbnail/".$next_data[ismember]."/")) {
			if(!@mkdir($zb_path."data/$id/thumbnail/".$next_data[ismember]."/",0777,true)) $error_check+=1;
			if(!@chmod($zb_path."data/$id/thumbnail/".$next_data[ismember]."/",0707)) $error_check+=2;
		}
		if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$next_data[ismember]."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
		elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$next_data[ismember]."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

		$src_img2="icon/member_image_box/".$next_data[ismember]."/".$out2[0][1].".".$out2[0][2];
		if(!file_exists($Thumbnail_path.$next_data[ismember]."/".$iNext_thumb_small1)||!file_exists($Thumbnail_path.$next_data[ismember]."/".$iNext_thumb_large1)){
			$size=array($min_width_size,200);
			thumbnail($size,$src_img2,$Thumbnail_path.$next_data[ismember]."/",$iNext_thumb_small1,$iNext_thumb_large1,3/4);
			$next_thumb=$Thumbnail_url.$next_data[ismember]."/".str_replace("%2F", "/", urlencode($iNext_thumb_large1));
		}elseif(!file_exists($src_img2)){
			$next_thumb=$dir."/images/no_image.gif";
		}else{
			$next_thumb=$Thumbnail_url.$next_data[ismember]."/".str_replace("%2F", "/", urlencode($iNext_thumb_large1));
		}

	}elseif(($src_img2=stripslashes($img2[0][1])) && !preg_match("#\.(gif|bmp)$#i",$src_img2)){
		//썸네일 디렉토리 내 각 회원별 디렉토리 생성
		$error_check=0;
		if(!is_dir($zb_path."data/$id/thumbnail/".$next_data[ismember]."/")) {
			if(!@mkdir($zb_path."data/$id/thumbnail/".$next_data[ismember]."/",0777,true)) $error_check+=1;
			if(!@chmod($zb_path."data/$id/thumbnail/".$next_data[ismember]."/",0707)) $error_check+=2;
		}
		if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$next_data[ismember]."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
		elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$next_data[ismember]."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

		if(!file_exists($Thumbnail_path.$next_data[ismember]."/".$Next_thumb_small1)||!file_exists($Thumbnail_path.$next_data[ismember]."/".$Next_thumb_large1)){
			$size=array($min_width_size,200);
			thumbnail($size,$src_img2,$Thumbnail_path.$next_data[ismember]."/",$Next_thumb_small1,$Next_thumb_large1,3/4);
		}
		$next_thumb=$Thumbnail_url.$next_data[ismember]."/".$Next_thumb_large1;

	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$next_data[file_name2])){

		if(!file_exists($Thumbnail_path.$Next_thumb_large2)||!file_exists($Thumbnail_path.$Next_thumb_small2)){
		    $size=array($min_width_size,200);
			thumbnail($size,$next_data[file_name2],$Thumbnail_path,$Next_thumb_small2,$Next_thumb_large2,3/4);
		}
		$next_thumb=$Thumbnail_url.$Next_thumb_large2;
	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out2[1][1].".".$out2[1][2])){
		//썸네일 디렉토리 내 각 회원별 디렉토리 생성
		$error_check=0;
		if(!is_dir($zb_path."data/$id/thumbnail/".$next_data[ismember]."/")) {
			if(!@mkdir($zb_path."data/$id/thumbnail/".$next_data[ismember]."/",0777,true)) $error_check+=1;
			if(!@chmod($zb_path."data/$id/thumbnail/".$next_data[ismember]."/",0707)) $error_check+=2;
		}
		if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$next_data[ismember]."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
		elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$next_data[ismember]."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

		$src_img2="icon/member_image_box/".$next_data[ismember]."/".$out2[1][1].".".$out2[1][2];
		if(!file_exists($Thumbnail_path.$next_data[ismember]."/".$iNext_thumb_small2)||!file_exists($Thumbnail_path.$next_data[ismember]."/".$iNext_thumb_large2)){
			$size=array($min_width_size,200);
			thumbnail($size,$src_img2,$Thumbnail_path.$next_data[ismember]."/",$iNext_thumb_small2,$iNext_thumb_large2,3/4);
			$next_thumb=$Thumbnail_url.$next_data[ismember]."/".str_replace("%2F", "/", urlencode($iNext_thumb_large2));
		}elseif(!file_exists($src_img2)){
			$next_thumb=$dir."/images/no_image.gif";
		}else{
			$next_thumb=$Thumbnail_url.$next_data[ismember]."/".str_replace("%2F", "/", urlencode($iNext_thumb_large2));
		}

	}elseif(($src_img2=stripslashes($img2[1][1])) && !preg_match("#\.(gif|bmp)$#i",$src_img2)){
		//썸네일 디렉토리 내 각 회원별 디렉토리 생성
		$error_check=0;
		if(!is_dir($zb_path."data/$id/thumbnail/".$next_data[ismember]."/")) {
			if(!@mkdir($zb_path."data/$id/thumbnail/".$next_data[ismember]."/",0777,true)) $error_check+=1;
			if(!@chmod($zb_path."data/$id/thumbnail/".$next_data[ismember]."/",0707)) $error_check+=2;
		}
		if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$next_data[ismember]."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
		elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$next_data[ismember]."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

		if(!file_exists($Thumbnail_path.$next_data[ismember]."/".$Next_thumb_small1)||!file_exists($Thumbnail_path.$next_data[ismember]."/".$Next_thumb_large1)){
			$size=array($min_width_size,200);
			thumbnail($size,$src_img2,$Thumbnail_path.$next_data[ismember]."/",$Next_thumb_small1,$Next_thumb_large1,3/4);
		}
		$next_thumb=$Thumbnail_url.$next_data[ismember]."/".$Next_thumb_large1;

	}elseif(preg_match("#\.(gif|bmp)$#i",$next_data[file_name1]))
		$next_thumb=str_replace("%2F", "/", urlencode($next_data[file_name1]));
	elseif(preg_match("#\.(gif|bmp)$#i",$out2[0][1].".".$out2[0][2])){
		$src_img2="icon/member_image_box/".$next_data[ismember]."/".$out2[0][1].".".$out2[0][2];
		$next_thumb=str_replace("%2F", "/", urlencode($src_img2));
		if(!file_exists($src_img2)) $next_thumb=$dir."/images/no_image.gif";
	}elseif(($src_img2=stripslashes($img2[0][1])) && preg_match("#\.(gif|bmp)$#i",$src_img2))
		$next_thumb=$src_img2;
	elseif(preg_match("#\.(gif|bmp)$#i",$next_data[file_name2]))
		$next_thumb=str_replace("%2F", "/", urlencode($next_data[file_name2]));
	elseif(preg_match("#\.(gif|bmp)$#i",$out2[1][1].".".$out2[1][2])){
		$src_img2="icon/member_image_box/".$next_data[ismember]."/".$out2[1][1].".".$out2[1][2];
		$next_thumb=str_replace("%2F", "/", urlencode($src_img2));
		if(!file_exists($src_img2)) $next_thumb=$dir."/images/no_image.gif";
	}elseif(($src_img2=stripslashes($img2[1][1])) && preg_match("#\.(gif|bmp)$#i",$src_img2))
		$next_thumb=$src_img2;
	elseif($next_data[no]) $next_thumb=$dir."/images/no_image.gif";

}else{
	if($upload_image1){
		$source_img=str_replace("%2F", "/", urlencode($data[file_name1]));
		if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name1])){
			$view_img1="<img src=$source_img name=zb_target_resize border=0 alt='$alt1'>";
		}else {
			$view_img1=str_replace("<br>","",$upload_image1);
			$view_img1=str_replace("cursor:pointer","",$view_img1);
			$view_img1=preg_replace("#onclick=\"javascript\:[^>]+?(>)#i","alt='$alt1'\\1",$view_img1);
		}
		$img_info1=@getimagesize($data[file_name1]);
		$img_info1[0]=$img_info1[0]+10;
		$img_info1[1]=$img_info1[1]+55;
		$print_img1="<a onmouseover=window.open('$dir/img_view.php?img=$data[file_name1]&width=$img_info1[0]&height=$img_info1[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no','status=no') style='cursor:pointer'>";
	}
	if($upload_image2){
		$source_img=str_replace("%2F", "/", urlencode($data[file_name2]));
		if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name2])){
			$view_img2="<img src=$source_img name=zb_target_resize border=0 alt='$alt2'>";
		}else {
			$view_img2=str_replace("<br>","",$upload_image2);
			$view_img2=str_replace("cursor:pointer","",$view_img2);
			$view_img2=preg_replace("#onclick=\"javascript\:[^>]+?(>)#i","alt='$alt2'\\1",$view_img2);
		}
		$img_info2=@getimagesize($data[file_name2]);
		$img_info2[0]=$img_info2[0]+10;
		$img_info2[1]=$img_info2[1]+55;
		$print_img2="<a onmouseover=window.open('$dir/img_view.php?img=$data[file_name2]&width=$img_info2[0]&height=$img_info2[1]','view_info','width=0,height=0,toolbar=no,scrollbars=no','status=no') style='cursor:pointer'>";
	}

	//썸네일 사용하지 않을때 이전파일및 다음파일 정보를 저장
	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$prev_data[file_name1])){
		$prev_thumb=$prev_data[file_name1];
		$prev_thumb=str_replace("%2F", "/", urlencode($prev_thumb));
	}
  	elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out1[0][1].".".$out1[0][2])){
		$prev_thumb="icon/member_image_box/".$prev_data[ismember]."/".$out1[0][1].".".$out1[0][2];
		if(!file_exists($prev_thumb)) $prev_thumb=$dir."/images/no_image.gif";
		else $prev_thumb=str_replace("%2F", "/", urlencode($prev_thumb));
	}elseif($src_img1=stripslashes($img1[0][1]))
		$prev_thumb=$src_img1;
	elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$prev_data[file_name2])){
		$prev_thumb=$prev_data[file_name2];
		$prev_thumb=str_replace("%2F", "/", urlencode($prev_thumb));
	}
	elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out1[1][1].".".$out1[1][2])){
		$prev_thumb="icon/member_image_box/".$prev_data[ismember]."/".$out1[1][1].".".$out1[1][2];
		if(!file_exists($prev_thumb)) $prev_thumb=$dir."/images/no_image.gif";
		else $prev_thumb=str_replace("%2F", "/", urlencode($prev_thumb));
	}elseif($src_img1=stripslashes($img1[1][1]))
		$prev_thumb=$src_img1;
	elseif($prev_data[no])
		$prev_thumb=$dir."/images/no_image.gif";

	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$next_data[file_name1])){
		$next_thumb=$next_data[file_name1];
		$next_thumb=str_replace("%2F", "/", urlencode($next_thumb));
	}
	elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out2[0][1].".".$out2[0][2])){
		$next_thumb="icon/member_image_box/".$next_data[ismember]."/".$out2[0][1].".".$out2[0][2];
		if(!file_exists($next_thumb)) $next_thumb=$dir."/images/no_image.gif";
		else $next_thumb=str_replace("%2F", "/", urlencode($next_thumb));
	}elseif($src_img2=stripslashes($img2[0][1]))
		$next_thumb=$src_img2;
	elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$next_data[file_name2])){
		$next_thumb= $next_data[file_name2];
		$next_thumb=str_replace("%2F", "/", urlencode($next_thumb));
	}
	elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out2[1][1].".".$out2[1][2])){
		$next_thumb="icon/member_image_box/".$next_data[ismember]."/".$out2[1][1].".".$out2[1][2];
		if(!file_exists($next_thumb)) $next_thumb=$dir."/images/no_image.gif";
		else $next_thumb=str_replace("%2F", "/", urlencode($next_thumb));
	}elseif($src_img2=stripslashes($img2[1][1]))
		$next_thumb=$src_img2;
	elseif($next_data[no])
		$next_thumb=$dir."/images/no_image.gif";
}
?>