<?
function exif_info($filename){
	global $dir;

	$field="exp-time,f-number,date-taken,exp-bias,meter-mode,flash,model,make,focal-len,iso-speed,shutter,aperture";
	$exif_on =exec("$dir/exiflist -q -o lh -f $field $filename",$exif_data);

	if($exif_on){
		$key=explode(",",$exif_data[0]);
		$value=explode(",",$exif_data[1]);
	 
		for($i=0;$i<=sizeof($value)-1;$i++){
			$exif[$key[$i]]=$value[$i];
			//echo $key[$i]." : ".$exif[$key[$i]]."<br>"; //이미지를 사용하지 않을때는 이와 같은 형식으로 출력 가능합니다.
		}
		//이미지를 사용하지 않고 그냥 출력하실 때에는 
		if($exif["date-taken"]){ 
			$date=substr($exif["date-taken"],0,4)."년".substr($exif["date-taken"],5,2)."월".substr($exif["date-taken"],8,2)."일";
			$str=$str."\n찍은 날짜 : $date";  	
		}
		if($exif["date-taken"]){
			$time=substr($exif["date-taken"],11,2)."시".substr($exif["date-taken"],14,2)."분".substr($exif["date-taken"],17,2)."초";
			$str=$str."\n찍은 시간 : $time"; 
		}
		if($exif["flash"]) $str=$str."\n플래시 사용 : ".$exif["flash"];  //플래시 

		if($exif["exp-bias"]) $str=$str."\n노출 보정 : ".$exif["exp-bias"]." EV";   //노출보정
		if($exif["shutter"])  $str=$str."\n셔터 스피드 : ".$exif["shutter"];   //셔터 스피드

		if($exif["model"]) $str=$str."\n카메라  : ".$exif["model"];  //디카 모델 

		if($exif["f-number"]) $str=$str."\nF-Number : ".$exif["f-number"];  //F 넘버

		if($exif["meter-mode"]) $str=$str."\n측량 모드 : ".$exif["meter-mode"];    //측량모드
		if($exif["focal-len"]) $str=$str."\n초점 거리 : ".$exif["focal-len"]." mm";	//초점 거리
		if($exif["exp-time"]) $str=$str."\n노출 시간 : ".$exif["exp-time"]." 초";   //노출시간
		if($exif[iso-speed]) $str=$str."\nISO 감도 : ".$exif["iso-speed"];    //ISO 감도
		if($exif["aperture"])  $str=$str."\n조리개 : ".$exif["aperture"];   //조리개

	}
	return $str;
}
?>
