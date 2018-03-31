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
			//echo $key[$i]." : ".$exif[$key[$i]]."<br>"; //�̹����� ������� �������� �̿� ���� �������� ��� �����մϴ�.
		}            //�����迭�� ���·� ��������ϴ�. �̴� ���߿� �����Ҷ� �˾ƺ��� ���� �ϱ� ���ؼ� �Դϴ�.
		//�̹����� ������� �ʰ� �׳� ����Ͻ� ������ 

		if($exif["date-taken"]){ 
			$date=substr($exif["date-taken"],0,4)."��".substr($exif["date-taken"],5,2)."��".substr($exif["date-taken"],8,2)."��";
			$str=$str."\n���� ��¥ : $date";  	
		}
		if($exif["date-taken"]){
			$time=substr($exif["date-taken"],11,2)."��".substr($exif["date-taken"],14,2)."��".substr($exif["date-taken"],17,2)."��";
			$str=$str."\n���� �ð� : $time"; 
		}
		if($exif["flash"]) $str=$str."\n�÷��� ��� : ".$exif["flash"];//�÷��� 

		if($exif["exp-bias"]) $str=$str."\n���� ���� : ".$exif["exp-bias"]." EV";   //���⺸��
		if($exif["shutter"])  $str=$str."\n���� ���ǵ� : ".$exif["shutter"];   //���� ���ǵ�

		if($exif["model"]) $str=$str."\nī�޶�  : ".$exif["model"];//��ī �� 

		if($exif["f-number"]) $str=$str."\nF-Number : ".$exif["f-number"]; //F �ѹ�

		if($exif["meter-mode"]) $str=$str."\n���� ��� : ".$exif["meter-mode"];    //�������
		if($exif["focal-len"]) $str=$str."\n���� �Ÿ� : ".$exif["focal-len"]." mm";	//���� �Ÿ�
		if($exif["exp-time"]) $str=$str."\n���� �ð� : ".$exif["exp-time"]." ��";   //����ð�
		if($exif[iso-speed]) $str=$str."\nISO ���� : ".$exif["iso-speed"];    //ISO ����
		if($exif["aperture"])  $str=$str."\n������ : ".$exif["aperture"];   //������

	}
	return $str;
}
?>