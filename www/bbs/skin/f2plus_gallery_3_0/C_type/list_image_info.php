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

if($Thumbnail_use=="on"){
	//����� ���丮 �� �� ȸ���� ���丮 ����
	if(!is_dir($zb_path."data/$id/thumbnail/".$data[ismember]."/")){
		if(!@mkdir($zb_path."data/$id/thumbnail/".$data[ismember]."/",0777,true)) $error_check+=1;
		if(!@chmod($zb_path."data/$id/thumbnail/".$data[ismember]."/",0707)) $error_check+=2;
	}
	if($error_check==2) echo "<br> ".$zb_path."data/$id/thumbnail/".$data[ismember]."/ ���丮�� ������ 707�� �����ϼ���<br><br>";
	elseif($error_check==3) echo "<br> ".$zb_path."data/$id/thumbnail/ ���丮 ���� ".$data[ismember]."�� ȸ�� ���丮 ������ �����߽��ϴ�.<br> �ش��ο� ���丮�� �������� �ֽð� ������ 707�� �����ϼ���<br><br>";

	if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name1])){
		$file1_check=1;
		$src_img1=$data[file_name1];
		if(!file_exists($Thumbnail_path.$Thumbnail_small1) || !file_exists($Thumbnail_path.$Thumbnail_large1)){
			$size=array($min_width_size,300);
			thumbnail($size,$src_img1,$Thumbnail_path,$Thumbnail_small1,$Thumbnail_large1,3/4);
		}
		$xy1=@getimagesize($src_img1);
		$thumb_img1=$Thumbnail_url.$Thumbnail_large1;
		$thumb_img12=$Thumbnail_url.$Thumbnail_small1;

	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out[0][1].".".$out[0][2])){
		$src_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(file_exists($src_img1) && (!file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small1) || !file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_large1))){
			$size=array($min_width_size,300);
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
		$xy1=@getimagesize($src_img1);

	}elseif(($src_img1=$img[0][1]) && !preg_match("#\.(gif|bmp)$#i",$src_img1)){
		if(!file_exists($Thumbnail_path.$data[ismember]."/".$Thumbnail_small1) || !file_exists($Thumbnail_path.$data[ismember]."/".$Thumbnail_large1)){
			$size=array($min_width_size,300);
			$zx=thumbnail($size,$src_img1,$Thumbnail_path.$data[ismember]."/",$Thumbnail_small1,$Thumbnail_large1,3/4);
			@mysql_query("update $t_board"."_$id set x=concat('$zx[0]','|||','$zx[1]') where no='$data[no]'") or error(mysql_error());
		}
		$re=mysql_fetch_array(mysql_query("select x from $t_board"."_$id where no='$data[no]'"));
		$xy1=explode("|||",$re[x]);
		if($xy1[0]){
			$thumb_img1=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($Thumbnail_large1));
			$thumb_img12=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($Thumbnail_small1));
		}else{
			$src_img1=$dir."/images/no_image.gif";
			$thumb_img1="";
			$thumb_img12="";
		}

	}elseif(preg_match("#\.(gif|bmp)$#i",$data[file_name1])){
		$file1_check=1;
		$src_img1=$data[file_name1];
		$thumb_img1=str_replace("%2F", "/", urlencode($src_img1));
		$thumb_img12=str_replace("%2F", "/", urlencode($src_img1));
		$xy1=@getimagesize($src_img1);
	}elseif(preg_match("#\.(gif|bmp)$#i",$out[0][1].".".$out[0][2])){
		$src_img1="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(!file_exists($src_img1)){
			$src_img1=$dir."/images/no_image.gif";
			$thumb_img1="";
			$thumb_img12="";
		}else{
			$thumb_img1=str_replace("%2F", "/", urlencode($src_img1));
			$thumb_img12=str_replace("%2F", "/", urlencode($src_img1));
		}
		$xy1=@getimagesize($src_img1);
	}elseif(($src_img1=$img[0][1]) && preg_match("#\.(gif|bmp)$#i",$src_img1)){
		$thumb_img1=$src_img1;
		$thumb_img12=$src_img1;
		$xy1=@getimagesize($src_img1);
	}


	if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name2])){

		$src_img2=$data[file_name2];
		if(!file_exists($Thumbnail_path.$Thumbnail_small2) || !file_exists($Thumbnail_path.$Thumbnail_large2)){
			$size=array($min_width_size,300);
			thumbnail($size,$src_img2,$Thumbnail_path,$Thumbnail_small2,$Thumbnail_large2,3/4);
		}
		$xy2=@getimagesize($src_img2);
		$thumb_img2=$Thumbnail_url.$Thumbnail_large2;
		$thumb_img22=$Thumbnail_url.$Thumbnail_small2;

	}elseif($file1_check==1 && preg_match("#\.(jpg|jpeg|png)$#i",$out[0][1].".".$out[0][2])){

		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(file_exists($src_img2) && (!file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small1) || !file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_large1))){
			$size=array($min_width_size,300);
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
		$xy2=@getimagesize($src_img2);

	}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out[1][1].".".$out[1][2])){

		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(file_exists($src_img2) && (!file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_small2) || !file_exists($Thumbnail_path.$data[ismember]."/".$iThumbnail_large2))){
			$size=array($min_width_size,300);
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
		$xy2=@getimagesize($src_img2);

	}elseif($file1_check==1 && ($src_img2=$img[0][1]) && !preg_match("#\.(gif|bmp)$#i",$src_img2)){
		if(!file_exists($Thumbnail_path.$data[ismember]."/".$Thumbnail_small2) || !file_exists($Thumbnail_path.$data[ismember]."/".$Thumbnail_large2)){
			$size=array($min_width_size,300);
			$zx=thumbnail($size,$src_img2,$Thumbnail_path.$data[ismember]."/",$Thumbnail_small2,$Thumbnail_large2,3/4);
			@mysql_query("update $t_board"."_$id set x=concat('$zx[0]','|||','$zx[1]') where no='$data[no]'") or error(mysql_error());
		}
		$re=mysql_fetch_array(mysql_query("select x from $t_board"."_$id where no='$data[no]'"));
		$xy2=explode("|||",$re[x]);
		if($xy2[0]){
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($Thumbnail_large2));
			$thumb_img22=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($Thumbnail_small2));
		}else{
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
			$thumb_img22="";
		}

	}elseif(($src_img2=$img[1][1]) && !preg_match("#\.(gif|bmp)$#i",$src_img2)){
		if(!file_exists($Thumbnail_path.$data[ismember]."/".$Thumbnail_small2) || !file_exists($Thumbnail_path.$data[ismember]."/".$Thumbnail_large2)){
			$size=array($min_width_size,300);
			$zy=thumbnail($size,$src_img2,$Thumbnail_path.$data[ismember]."/",$Thumbnail_small2,$Thumbnail_large2,3/4);
			@mysql_query("update $t_board"."_$id set y=concat('$zy[0]','|||','$zy[1]') where no='$data[no]'") or error(mysql_error());
		}
		$re=mysql_fetch_array(mysql_query("select y from $t_board"."_$id where no='$data[no]'"));
		$xy2=explode("|||",$re[y]);
		if($xy2[0]){
			$thumb_img2=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($Thumbnail_large2));
			$thumb_img22=$Thumbnail_url.$data[ismember]."/".str_replace("%2F", "/", urlencode($Thumbnail_small2));
		}else{
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
			$thumb_img22="";
		}
	}elseif(preg_match("#\.(gif|bmp)$#i",$data[file_name2])){
		$src_img2=$data[file_name2];
		$thumb_img2=str_replace("%2F", "/", urlencode($src_img2));
		$thumb_img22=str_replace("%2F", "/", urlencode($src_img2));
		$xy2=@getimagesize($src_img2);
	}elseif($file1_check==1 && preg_match("#\.(gif|bmp)$#i",$out[0][1].".".$out[0][2])){
		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
			$thumb_img22="";
		}else{
			$thumb_img2=str_replace("%2F", "/", urlencode($src_img2));
			$thumb_img22=str_replace("%2F", "/", urlencode($src_img2));
		}
		$xy2=@getimagesize($src_img2);
	}elseif(preg_match("#\.(gif|bmp)$#i",$out[1][1].".".$out[1][2])){
		$src_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(!file_exists($src_img2)){
			$src_img2=$dir."/images/no_image.gif";
			$thumb_img2="";
			$thumb_img22="";
		}else{
			$thumb_img2=str_replace("%2F", "/", urlencode($src_img2));
			$thumb_img22=str_replace("%2F", "/", urlencode($src_img2));
		}
		$xy2=@getimagesize($src_img2);
	}elseif($file1_check==1 && ($src_img2=$img[0][1]) && preg_match("#\.(gif|bmp)$#i",$src_img2)){
		$thumb_img2=$src_img2;
		$thumb_img22=$src_img2;
		$xy2=@getimagesize($src_img2);
	}elseif(($src_img2=$img[1][1]) && preg_match("#\.(gif|bmp)$#i",$src_img2)){
		$thumb_img2=$src_img2;
		$thumb_img22=$src_img2;
		$xy2=@getimagesize($src_img2);
	}

	$ran_img1=array($thumb_img12,$thumb_img22);
	$ran_img2=array(str_replace("%2F", "/", urlencode($src_img1)),str_replace("%2F", "/", urlencode($src_img2)),$dir."/images/no_image.gif");
	$ran_img3=array($thumb_img1,$thumb_img2);
	$ran_xy=array($xy1,$xy2);

	if($thumb_img1&&$thumb_img2){
		$img_tag=$ran_img3[$ran];
		$thumb_img=$ran_img1[$ran];
		$source_img=$ran_img2[$ran];
		$xy=$ran_xy[$ran];
	}elseif($thumb_img1&&!$thumb_img2){
		$img_tag=$ran_img3[0];
		$thumb_img=$ran_img1[0];
		$source_img=$ran_img2[0];
		$xy=$ran_xy[0];
	}elseif(!$thumb_img1&&$thumb_img2){
		$img_tag=$ran_img3[1];
		$thumb_img=$ran_img1[1];
		$source_img=$ran_img2[1];
		$xy=$ran_xy[1];
	}else{
		$img_tag=$ran_img2[2];
		$thumb_img=$ran_img2[2];
		$source_img=$ran_img2[2];
		$xy[0]=300; $xy[1]=200;
	}

	$full_img="<a onclick=window.open('$dir/img_view.php?img=$source_img&width=".($xy[0]+10)."&height=".($xy[1]+55)."','view_info','width=0,height=0,toolbar=no,scrollbars=no') onfocus=this.blur(); class=shadow style=cursor:pointer>";
	if($img_show=="on"){
		$view_img="<a onclick=window.open('$dir/img_view.php?img=$source_img&width=".($xy[0]+10)."&height=".($xy[1]+55)."','view_info','width=0,height=0,toolbar=no,scrollbars=no') onmouseover='transimg(\"image\",\"$img_tag\")' style='cursor:pointer'>";
	}else{
		$view_img="<a href=$zb_url/$view_target?$href$sort&no=$data[no] onmouseover='transimg(\"image\",\"$img_tag\")' style='cursor:pointer'>";
	}
		 // �ڹ� ��ũ��Ʈ�� �̿��� ���콺 ������ ���극�̾� â���� �̹��� ���
}else{

	if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name1])){
		$file1_check=1;
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
	}
	elseif($file1_check==1 && preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out[0][1].".".$out[0][2])){
		$thumb_img2="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];
		if(!file_exists($thumb_img2)) $thumb_img2="";
		else $thumb_img2=str_replace("%2F", "/", urlencode($thumb_img2));
	}elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out[1][1].".".$out[1][2])){
		$thumb_img2="icon/member_image_box/".$data[ismember]."/".$out[1][1].".".$out[1][2];
		if(!file_exists($thumb_img2)) $thumb_img2="";
		else $thumb_img2=str_replace("%2F", "/", urlencode($thumb_img2));
	}elseif($file1_check==1 && $src_img2=$img[0][1])
		$thumb_img2=$src_img2;
	elseif($src_img2=$img[1][1])
		$thumb_img2=$src_img2;

	$ran_img2=array($thumb_img1,$thumb_img2,$dir."/images/no_image.gif");

	if($thumb_img1&&$thumb_img2){                              //���ε� �̹��� ������ �Ѵ� ������
		$img_tag=$ran_img2[$ran];
		$thumb_img=$ran_img2[$ran];
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

	$xy=@getimagesize(urldecode($thumb_img));

	$full_img="<a onclick=window.open('$dir/img_view.php?img=$thumb_img&width=".($xy[0]+10)."&height=".($xy[1]+55)."','view_info','width=0,height=0,toolbar=no,scrollbars=no') class=shadow style='cursor:pointer'>";
	if($img_show=="on"){
		$view_img="<a onclick=window.open('$dir/img_view.php?img=$thumb_img&width=".($xy[0]+10)."&height=".($xy[1]+55)."','view_info','width=0,height=0,toolbar=no,scrollbars=no') onmouseover='transimg(\"image\",\"$img_tag\")' class=shadow style='cursor:pointer'>";
	}else{
		$view_img="<a href=$zb_url/$view_target?$href$sort&no=$data[no] onmouseover='transimg(\"image\",\"$img_tag\")' style='cursor:pointer'>";
	}
}
?>