<?
unset($thumb_img);
unset($thumb_img1);
unset($thumb_img2);
unset($img_info);

if($Thumbnail_use=="on"){
	//썸네일 디렉토리 내 각 회원별 디렉토리 생성
	if(!is_dir($zb_path."data/$id/thumbnail/".$data[ismember]."/")) {
		if(!@mkdir($zb_path."data/$id/thumbnail/".$data[ismember]."/",0777,true)) $error_check+=1;
		if(!@chmod($zb_path."data/$id/thumbnail/".$data[ismember]."/",0707)) $error_check+=2;
	}
	if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$data[ismember]."/ 디렉토리의 권한을 707로 설정하세요<br><br>";
	elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ 디렉토리 내에 ".$data[ismember]."번 회원 디렉토리 생성에 실패했습니다.<br> 해당경로에 디렉토리를 생성시켜 주시고 권한을 707로 설정하세요<br><br>";

	if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name1])){
		$src_img1=$data[file_name1];
		if(!file_exists($Thumbnail_path.$Thumbnail_small1)){
			thumbnail($min_width_size,$src_img1,$Thumbnail_path,$Thumbnail_small1,3/2);
		}
		$xy1=@getimagesize($src_img1);
		$thumb_img1=$Thumbnail_url.$Thumbnail_small1;

	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out[0][1].".".$out[0][2])) {

		$src_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(file_exists($src_img1) && !file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small1)){
			thumbnail($min_width_size,$src_img1,$Thumbnail_path.$data[ismember]."/",$iThumbnail_small1,3/2);
			$thumb_img1=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small1));
		}elseif(!file_exists($src_img1)){
			$src_img1=$dir."/images/no_image.gif";
			$thumb_img1="";
		}else{
			$thumb_img1=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small1));
		}
		$xy1=@getimagesize($src_img1);

	}elseif(($src_img1=$img[0][1]) && !preg_match("#\.(gif|bmp)$#i",$src_img1)){
		if(!file_exists($Thumbnail_path.$data[ismember]."/".$Thumbnail_small1)){
			$zx=thumbnail($min_width_size,$src_img1,$Thumbnail_path.$data[ismember]."/",$Thumbnail_small1,3/2);
			@mysql_query("update $t_board"."_$id set x=concat('$zx[0]','|||','$zx[1]') where no='$data[no]'") or error(mysql_error());
		}
		$re=mysql_fetch_array(mysql_query("select x from $t_board"."_$id where no='$data[no]'"));
		$xy1=explode("|||",$re[x]);
		if($xy1[0]){
			$thumb_img1=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($Thumbnail_small1));
		}else{
			$src_img1=$dir."/images/no_image.gif";
			$thumb_img1="";
		}

	}elseif(preg_match("#\.(gif|bmp)$#i",$data[file_name1])){
		$src_img1=$data[file_name1];
		$thumb_img1=$src_img1;
		$xy1=@getimagesize($src_img1);
	}elseif(preg_match("#\.(gif|bmp)$#i",$out[0][1].".".$out[0][2])) {
		$src_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(!file_exists($src_img1)){
			$src_img1=$dir."/images/no_image.gif";
			$thumb_img1="";
		}else{
			$thumb_img1=str_replace("%2F", "/", urlencode($src_img1));
		}
		$xy1=@getimagesize($src_img1);
	}elseif(($src_img1=$img[0][1]) && preg_match("#\.(gif|bmp)$#i",$src_img1)){
		$thumb_img1=$src_img1;
		$xy1=@getimagesize($src_img1);
	}

	if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name2])){
		$src_img2=$data[file_name2];
		if(!file_exists($Thumbnail_path.$Thumbnail_small2)){
			thumbnail($min_width_size,$src_img2,$Thumbnail_path,$Thumbnail_small2,3/2);
		}
		$xy2=@getimagesize($src_img2);
		$thumb_img2=$Thumbnail_url.$Thumbnail_small2;
	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out[1][1].".".$out[1][2])) {

		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(file_exists($src_img2) && !file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small2)){
			thumbnail($min_width_size,$src_img2,$Thumbnail_path.$data[ismember]."/",$iThumbnail_small2,3/2);
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small2));
		}elseif(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
		}else{
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($iThumbnail_small2));
		}
		$xy2=@getimagesize($src_img2);

	}elseif(($src_img2=$img[1][1]) && !preg_match("#\.(gif|bmp)$#i",$src_img2)){
		if(!file_exists($Thumbnail_path.$data[ismember]."/".$Thumbnail_small2)){
			$zy=thumbnail($min_width_size,$src_img2,$Thumbnail_path.$data[ismember]."/",$Thumbnail_small2,3/2);
			@mysql_query("update $t_board"."_$id set y=concat('$zy[0]','|||','$zy[1]') where no='$data[no]'") or error(mysql_error());
		}
		$re=mysql_fetch_array(mysql_query("select y from $t_board"."_$id where no='$data[no]'"));
		$xy2=explode("|||",$re[y]);
		if($xy2[0]){
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($Thumbnail_small2));
		}else{
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
		}

	}elseif(preg_match("#\.(gif|bmp)$#i",$data[file_name2])){
		$src_img2=$data[file_name2];
		$thumb_img2=$src_img2;
		$xy2=@getimagesize($src_img2);
	}elseif(preg_match("#\.(gif|bmp)$#i",$out[1][1].".".$out[1][2])) {
		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
		}else{
			$thumb_img2=str_replace("%2F", "/", urlencode($src_img2));
		}
		$xy2=@getimagesize($src_img2);
	}elseif(($src_img2=$img[1][1]) && preg_match("#\.(gif|bmp)$#i",$src_img2)){
		$thumb_img2=$src_img2;
		$xy2=@getimagesize($src_img2);
	}

	if($thumb_img1){
		$img_tag=$src_img1;
		$xy=$xy1;
		$thumb_img=$thumb_img1;            //리스트 메인에서 보여질 75 X 56 사이즈의 썸네일
	}                                                       //리스트 메인에서는 첫번째 파일의 썸네일만 보여짐
	elseif($thumb_img2){   //업로드 이미지 2번 파일만 있을때
		$img_tag=$src_img2;
		$xy=$xy2;
		$thumb_img=$thumb_img2;
	}
	else{                                // 업로드 이미지 파일이 없을때
		$img_tag=$dir."/images/no_image.gif";
		$thumb_img=$dir."/images/no_image.gif";     //없을경우 미리 지정된 이미지 파일 사용.변경하셔두 됩니다.
		$xy[0]=300; $xy[1]=200;
	}

	if($img_show=="on"){
		$view_img="<a onclick=window.open('$dir/img_view.php?img=$img_tag&width=".($xy[0]+10)."&height=".($xy[1]+55)."','view_info','width=0,height=0,toolbar=no,scrollbars=no') class=shadow style='cursor:pointer'>";
	}else{
		$view_img="<a href=$zb_url/$view_target?$href$sort&no=$data[no] class=shadow style='cursor:pointer'>";
	}
			 // 자바 스크립트를 이용해 마우스 오버시 서브레이어 창으로 이미지 출력
}else{
	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name1])){
		$thumb_img1=$data[file_name1];
		$thumb_img1=str_replace("%2F", "/", urlencode($thumb_img1));
	}elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out[0][1].".".$out[0][2])){
		$thumb_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(!file_exists($thumb_img1)) $thumb_img1="";
		else $thumb_img1=str_replace("%2F", "/", urlencode($thumb_img1));
	}elseif($src_img1=$img[0][1])
		$thumb_img1=$src_img1;

	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name2])){
		$thumb_img2=$data[file_name2];
		$thumb_img2=str_replace("%2F", "/", urlencode($thumb_img2));
	}elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out[1][1].".".$out[1][2])){
		$thumb_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(!file_exists($thumb_img2)) $thumb_img2="";
		else $thumb_img2=str_replace("%2F", "/", urlencode($thumb_img2));
	}elseif($src_img2=$img[1][1])
		$thumb_img2=$src_img2;

	if($thumb_img1){                              //업로드 이미지 파일이 둘다 있을때
		$xy=@getImageSize(urldecode($thumb_img1));
		$thumb_img=$thumb_img1;            //리스트 메인에서 보여질 75 X 56 사이즈의 썸네일
	}                                                       //리스트 메인에서는 첫번째 파일의 썸네일만 보여짐
	elseif($thumb_img2){   //업로드 이미지 2번 파일만 있을때
		$xy=@getImageSize(urldecode($thumb_img2));
		$thumb_img=$thumb_img2;
	}
	else{                                // 업로드 이미지 파일이 없을때
		$thumb_img=$dir."/images/no_image.gif";     //없을경우 미리 지정된 이미지 파일 사용.변경하셔두 됩니다.
		$xy=@getImageSize($thumb_img);
	}

	if($img_show=="on"){
		$view_img="<a onclick=window.open('$dir/img_view.php?img=$thumb_img&width=".($xy[0]+10)."&height=".($xy[1]+55)."','view_info','width=0,height=0,toolbar=no,scrollbars=no') class=shadow style='cursor:pointer'>";
	}else{
		$view_img="<a href=$zb_url/$view_target?$href$sort&no=$data[no] class=shadow style='cursor:pointer'>";
	}
			 // 자바 스크립트를 이용해 마우스 오버시 서브레이어 창으로 이미지 출력
}
?>
