<? $use_thumb=2; ?>

<!-----------------이미지 미리보기-------------------->
<div id="message" style="border-width:0px; border-style:none; width:0px; height:0px; position:absolute; left:0px; top:0px; z-index:1;" class=shadow></div>
<script language="javascript">
<!--
function imgposit(x,y,myEvent){
	var element = document.getElementById("message");
	var scrollLeft = (document.documentElement && document.documentElement.scrollLeft) || document.body.scrollLeft;
	var scrollTop = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;

	element.style.left = ((myEvent.clientX - x) + scrollLeft) + "px"; //오버될때 보여질 이미지의 x 좌표
	element.style.top = ((myEvent.clientY - y) + scrollTop) + "px"; //오버될때 보여질 이미지의 y 좌표
}

function imgset(str){
	var text
	text ='<table align="center" border="0" cellpadding="0" cellspacing="0" class=shadow>'
	text += '<tr><td align=center>'+str+'</td></tr></table>'
	message.innerHTML=text
}

function imghide(){
	message.innerHTML=''
}
-->
</script>
<?
if(!$connect) $connect=dbconn();

function latest_thumb_del($path,$file,$reg_date){
	//echo "이 함수가 실행되었습니다.";
	for($i=0;$i<sizeof($file);$i++){
		for($j=0;$j<sizeof($reg_date);$j++){
			$count=0;
			if(preg_match("/".$reg_date[$j]."/i",$file[$i])) {
				$count++;
				break;
			}
		}
		if($count==0) @z_unlink($path.$file[$i]);
	}
 }

function thumbnail_make1($size,$source_file,$save_path,$small,$large,$ratio){

	$img_info=@getimagesize($source_file);

	if($img_info[2]==1) $srcimg=@ImageCreateFromGIF($source_file);
	 elseif($img_info[2]==2) $srcimg=@ImageCreateFromJPEG($source_file);
	   else                     $srcimg=@ImageCreateFromPNG($source_file);

	for($i=0; $i<=sizeof($size)-1;$i++){
		if($size[$i]!=0){

			if($i==sizeof($size)-1) {
				// $ratio가 0으로 나누어지는 것 방지
				if($img_info[0]!="")
					$ratio=$img_info[1]/$img_info[0];
			}

			$max_width=$size[$i];
			$max_height=intval($size[$i]*$ratio);

			if($img_info[0]<=$max_width || $img_info[1]<=$max_height){
				$new_width=$img_info[0];
				$new_height=$img_info[1];
			}else{
				if($img_info[0]*$ratio >= $img_info[1]){
             		$alpha=(double)$max_height/$img_info[1];
					$new_width=intval($img_info[0]*$alpha);
					$new_height=$max_height;
				}
				else{
				  $alpha=(double)$max_width/$img_info[0];
				  $new_width=$max_width;
				  $new_height=intval($alpha*$img_info[1]);
				}
			}

			$srcx=(int)($max_width-$new_width)/2;
			$srcy=(int)($max_height-$new_height)/2;

			if($img_info[2]==1){
				$dstimg=@ImageCreate($max_width,$max_height);
				@ImageColorAllocate($dstimg,255,255,255);
				@ImageCopyResized($dstimg, $srcimg,$srcx,$srcy,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
			}else{
				$dstimg=@ImageCreateTrueColor($max_width,$max_height);
				@ImageColorAllocate($dstimg,255,255,255);
				@ImageCopyResampled($dstimg, $srcimg,$srcx,$srcy,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
			}

			if($i==0){
				@ImageJPEG($dstimg,$save_path.$small,85);
			}
			else{
				@ImageJPEG($dstimg,$save_path.$large,85);
			}
			@ImageDestroy($dstimg);

		}
	}
	@ImageDestroy($srcimg);

	return $img_info;
}

function thumbnail_make2($size,$source_file,$save_path,$small,$large,$ratio){

	$img_info=@getimagesize($source_file);

	if($img_info[2]==1) $srcimg=@ImageCreateFromGIF($source_file);
	 elseif($img_info[2]==2) $srcimg=@ImageCreateFromJPEG($source_file);
	   else                     $srcimg=@ImageCreateFromPNG($source_file);

	for($i=0; $i<=sizeof($size)-1;$i++){
		if($size[$i]!=0){

			if($i==sizeof($size)-1) {
				// $ratio가 0으로 나누어지는 것 방지
				if($img_info[0]!="")
					$ratio=$img_info[1]/$img_info[0];
			}

			$max_width=$size[$i];
			$max_height=intval($size[$i]*$ratio);

			if($img_info[0]<=$max_width || $img_info[1]<=$max_height){
				$new_width=$img_info[0];
				$new_height=$img_info[1];
			}else{
				if($img_info[0]*$ratio >= $img_info[1]){
             		$alpha=(double)$max_height/$img_info[1];
					$new_width=intval($img_info[0]*$alpha);
					$new_height=$max_height;
				}
				else{
				  $alpha=(double)$max_width/$img_info[0];
				  $new_width=$max_width;
				  $new_height=intval($alpha*$img_info[1]);
				}
			}

			$srcx=(int)($max_width-$new_width)/2;
			$srcy=(int)($max_height-$new_height)/2;

			$dstimg=@ImageCreate($max_width,$max_height);
			@ImageColorAllocate($dstimg,255,255,255);
			@ImageCopyResized($dstimg, $srcimg,$srcx,$srcy,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));

			if($i==0){
				@ImageJPEG($dstimg,$save_path.$small,85);
			}
			else{
				@ImageJPEG($dstimg,$save_path.$large,85);
			}
			@ImageDestroy($dstimg);

		}
	}
	@ImageDestroy($srcimg);

	return $img_info;
}

function latest_gal($skinname,$id,$title,$num=5, $textlen=30, $textlen2=80, $datetype="m/d"){
	global $_zb_path, $_zb_url, $connect, $use_thumb;
	if(!$skinname||!$id) return;

	$str = zReadFile($_zb_path."latest_skin/".$skinname."/main.html");
	if(!$str) {
		echo "지정하신 $skinname 이라는 최근목록 스킨이 존재하지 않습니다<br>";
		return;
    }

	if($use_thumb>0){
		if(!is_dir($_zb_path."data/latest_thumb/")){
			if(!@mkdir($_zb_path."data/latest_thumb/",0777,true)) echo $_zb_path."data 폴더의 퍼미션이 707인지 확인하세요<BR>";
			if(!@chmod($_zb_path."data/latest_thumb/",0707)) echo $_zb_path."data/latest_thumb/ 폴더의 권한을 707로 수정하세요<BR>";
		}
		if(!is_dir($_zb_path."data/latest_thumb/$id/")){
			if(!@mkdir($_zb_path."data/latest_thumb/$id/",0777)) echo $_zb_path."data/latest_thumb/ 폴더의 권한이 707인지 확인하시고 폴더가 없다면 수동으로 생성시켜 주시고 권한을 707로 수정하세요<BR>";
			if(!@chmod($_zb_path."data/latest_thumb/$id/",0707)) echo $_zb_path."data/latest_thumb/$id/ 폴더의 권한을 707로 수정하세요";
		}
	}

	$setup = mysql_fetch_array(mysql_query("select use_alllist from zetyx_admin_table where name='$id'"));
	if($setup[use_alllist]) $target = "zboard.php?id=".$id;
	else $target = "view.php?id=".$id;

	$result = mysql_query("select * from zetyx_board"."_$id order by no desc limit $num", $connect) or die(mysql_error());

	$tmpStr = explode("[loop]",$str);
	$header = $tmpStr[0];
	$tmpStr2 = explode("[/loop]",$tmpStr[1]);
	$loop = $tmpStr2[0];
	$footer = $tmpStr2[1];

	$main_data = "";
	while($data=mysql_fetch_array($result)) {
		$name = del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",$data[name])));
		$subject = del_html(str_replace("&rlo;","&amp;rlo;",str_replace("&rlm;","&amp;rlm;",cut_str(strip_tags($data[subject]),$textlen))))."</font></b>";
		$date = date($datetype, $data[reg_date]);
		if($data[total_comment]) $comment = "[".$data[total_comment]."]"; else $comment="";
		$memo = del_html(cut_str(strip_tags($data[memo]),$textlen2));

		$img1="data/latest_thumb/$id/$data[reg_date]"."_small.jpg";
		$img2="data/latest_thumb/$id/$data[reg_date]"."_large.jpg";
		$filename1=$_zb_url.$img1;
		$filename2=$_zb_url.$img2;

		// [img] 태그 파일 찾기
		$imagePattern="#\[img\:(.+?)\.(jpg|jpeg|gif|png|bmp)\,#i";
		preg_match_all($imagePattern,$data[memo],$out,PREG_SET_ORDER);
		$src_img="icon/member_image_box/".$data[ismember]."/".$out[0][1].".".$out[0][2];

		// 외부 html <img> 태그 src url 추출
		$imagePattern="#<img[^>]*src=[\']?[\"]?([^>\'\"]+)[\']?[\"]?[^>]*>#i";
		preg_match_all($imagePattern,$data[memo],$img,PREG_SET_ORDER);
		for($i=0;$i<1;$i++)
			if(($mypos=strrpos($img[$i][1],"http://"))||($mypos=strrpos($img[$i][1],"https://")))
				$img[$i][1]=substr($img[$i][1],$mypos);

		if($use_thumb>0){
			if(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name1])){
				$reg_date[]=$data[reg_date];
				if(!file_exists($_zb_path.$img1)||!file_exists($_zb_path.$img2)){
					$size=array(52,200);
					if($use_thumb==2) thumbnail_make1($size,$_zb_path.$data[file_name1],$_zb_path,$img1,$img2,3/4);
					else thumbnail_make2($size,$_zb_path.$data[file_name1],$_zb_path,$img1,$img2,3/4);
				}
			}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$data[file_name2])){
				$reg_date[]=$data[reg_date];
				if(!file_exists($_zb_path.$img1)||!file_exists($_zb_path.$img2)){
					$size=array(52,200);
					if($use_thumb==2) thumbnail_make1($size,$_zb_path.$data[file_name2],$_zb_path,$img1,$img2,3/4);
					else thumbnail_make2($size,$_zb_path.$data[file_name2],$_zb_path,$img1,$img2,3/4);
				}
			}elseif(preg_match("#\.(jpg|jpeg|png)$#i",$out[0][1].".".$out[0][2])) {
				$reg_date[]=$data[reg_date];
				if(file_exists($_zb_path.$src_img) && (!file_exists($_zb_path.$img1)||!file_exists($_zb_path.$img2))){
					$size=array(52,200);
					if($use_thumb==2) thumbnail_make1($size,$_zb_path.$src_img,$_zb_path,$img1,$img2,3/4);
					else thumbnail_make2($size,$_zb_path.$src_img,$_zb_path,$img1,$img2,3/4);
				}elseif(!file_exists($_zb_path.$src_img)){
					$filename1=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
					$filename2=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
				}
			}elseif(($src_img1=$img[0][1]) && !preg_match("#\.(gif|bmp)$#i",$src_img1)){
				$reg_date[]=$data[reg_date];
				if(!file_exists($_zb_path.$img1)||!file_exists($_zb_path.$img2)){
					$size=array(52,200);
					if($use_thumb==2) $zx=thumbnail_make1($size,$src_img1,$_zb_path,$img1,$img2,3/4);
					else $zx=thumbnail_make2($size,$src_img1,$_zb_path,$img1,$img2,3/4);
					@mysql_query("update zetyx_board"."_$id set x=concat('$zx[0]','|||','$zx[1]') where no='$data[no]'") or error(mysql_error());
				}
				$re=mysql_fetch_array(mysql_query("select x from zetyx_board"."_$id where no='$data[no]'"));
				$xy1=explode("|||",$re[x]);
				if(!$xy1[0]){
					$filename1=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
					$filename2=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
				}

			}elseif(preg_match("#\.(gif|bmp)$#i",$data[file_name1])){
				$filename1=$_zb_url.str_replace("%2F", "/", urlencode($data[file_name1]));
				$filename2=$_zb_url.str_replace("%2F", "/", urlencode($data[file_name1]));
			}elseif(preg_match("#\.(gif|bmp)$#i",$data[file_name2])){
				$filename1=$_zb_url.str_replace("%2F", "/", urlencode($data[file_name2]));
				$filename2=$_zb_url.str_replace("%2F", "/", urlencode($data[file_name2]));
			}elseif(preg_match("#\.(gif|bmp)$#i",$out[0][1].".".$out[0][2])) {
				if(!file_exists($_zb_path.$src_img)){
					$filename1=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
					$filename2=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
				}else{
					$filename1=$_zb_url.str_replace("%2F", "/", urlencode($src_img));
					$filename2=$_zb_url.str_replace("%2F", "/", urlencode($src_img));
				}
			}elseif(($src_img1=$img[0][1]) && preg_match("#\.(gif|bmp)$#i",$src_img1)){
				$filename1=$src_img1;
				$filename2=$src_img1;
			}else{
				$filename1=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
				$filename2=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
			}

		}else{
			if(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name1])){
					$filename1=$_zb_url.str_replace("%2F", "/", urlencode($data[file_name1]));
					$filename2=$_zb_url.str_replace("%2F", "/", urlencode($data[file_name1]));
			}elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$data[file_name2])){
					$filename1=$_zb_url.str_replace("%2F", "/", urlencode($data[file_name2]));
					$filename2=$_zb_url.str_replace("%2F", "/", urlencode($data[file_name2]));
			}elseif(preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$out[0][1].".".$out[0][2])) {
				if(!file_exists($_zb_path.$src_img)){
					$filename1=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
					$filename2=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
				}else{
					$filename1=$_zb_url.str_replace("%2F", "/", urlencode($src_img));
					$filename2=$_zb_url.str_replace("%2F", "/", urlencode($src_img));
				}
			}elseif(($src_img1=$img[0][1]) && preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$src_img1)){
				$filename1=$src_img1;
				$filename2=$src_img1;
			}else{
				$filename1=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
				$filename2=$_zb_url."latest_skin/".$skinname."/images/no_image.gif";
			}
		}

		$img_tag1="<img src=$filename2 width=200 border=0 style=border-width:1pt;border-style:solid;border-color:#000000;filter:progid:DXImageTransform.Microsoft.Shadow(color=#C0C0C0,Direction=135,Strength=4)>";
		$view_img="<a href=$_zb_url$target&no=$data[no] onfocus='this.blur();' onMouseMove=\"imgposit(-50,30,event)\"; onMouseOver=\"imgset('$img_tag1')\"; onMouseOut=\"imghide();\" 'width=400,height=510,toolbar=no,scrollbars=yes'>";
		$imgList=$view_img."<img src=$filename1 border=0 width=52 height=39 vspacing=10 hspacing=10 style=border-style:solid;border-width:1px;border-color:000000;);></a>";

		$main = $loop;
		$main = str_replace("[name]",$name,$main);
		$main = str_replace("[date]",$date,$main);
		$main = str_replace("[memo]",$memo,$main);
		if((time()-$data[reg_date])/3600<48) $main = str_replace("[subject]","<a href='".$_zb_url.$target."&no=$data[no]'>".$subject."</a>&nbsp;<img src=".$_zb_url."latest_skin/$skinname/images/new_head.gif align=absmiddle>",$main);
		else $main = str_replace("[subject]","<a href='".$_zb_url.$target."&no=$data[no]'>".$subject."</a>",$main);
		$main = str_replace("[comment]",$comment,$main);
		$main = str_replace("[img]",$imgList,$main);
		$imgList="";
		$main_data .= "\n".$main;
	}

	$list = $header.$main_data.$footer;
	$list = str_replace("[more]","<a href='".$_zb_url."zboard.php?id=".$id."'>",$list);
	$list = str_replace("[title]",$title,$list);
	$list = str_replace("[dir]",$_zb_url."latest_skin/".$skinname."/images/",$list);
	echo $list;

	if($use_thumb>0){
		$path=$_zb_path."data/latest_thumb/$id/";
		$directory=get_dirinfo($path);

		// 모바일 메인페이지 최근 갤러리 갯수도 고려한 배수 설정
		if($num==7)
			$multi=2;
		elseif($num==4)
			$multi=4;
		else
			$multi=14;

		if(sizeof($directory) >= sizeof($reg_date)*$multi) latest_thumb_del($path,$directory,$reg_date);
	}

}
?>