<?
function thumbnail($size,$source_file,$save_file){

	$img_info=@getimagesize($source_file);

	if($img_info[2]==1) $srcimg=@ImageCreateFromGIF($source_file);
	elseif($img_info[2]==2) $srcimg=@ImageCreateFromJPEG($source_file);
	else                     $srcimg=@ImageCreateFromPNG($source_file);

	if($img_info[0]>=$size){
		$max_width=$size;
		$max_height=ceil($img_info[1]*$size/$img_info[0]);
	}elseif($img_info[0]==""){
		$max_width=$size;
		$max_height=ceil($size*3/4);
	}else{
		$max_width=$img_info[0];
		$max_height=$img_info[1];
	}

	if($img_info[2]==1){
		$dstimg=@ImageCreate($max_width,$max_height);
		@ImageColorAllocate($dstimg,255,255,255);
		@ImageCopyResized($dstimg, $srcimg,0,0,0,0,$max_width,$max_height,ImageSX($srcimg),ImageSY($srcimg));
	}else{
		$dstimg=@ImageCreateTrueColor($max_width,$max_height);
		@ImageColorAllocate($dstimg,255,255,255);
		@ImageCopyResampled($dstimg, $srcimg,0,0,0,0,$max_width,$max_height,ImageSX($srcimg),ImageSY($srcimg));
	}

	@ImageJPEG($dstimg,$save_file,85);

	@ImageDestroy($dstimg);
	@ImageDestroy($srcimg);

	return $img_info;
}
?>