<?
// ���̺귯�� �Լ� ���� ��ũ���
include "lib.php";
$group_no=(int)$group_no;

// $HTTP_HOST ���� ��Ʈ��ȣ ���� ������ ����
if($mypos=strrpos($HTTP_HOST,":")) // ������ : ��ġ ã�� ����
	$HTTP_HOST=substr($HTTP_HOST,0,$mypos);
if(!preg_match("#".$HTTP_HOST."#i",$HTTP_REFERER)||$_SESSION['WRT_SS_VRS']==""||$_SESSION['WRT_SS_VRS']!=$wantispam||$_SESSION['WRT_SPM_PWD']==""||$_SESSION['WRT_SPM_PWD']!=$_POST['code']) Error("���������� �ۼ��Ͽ� �ֽñ� �ٶ��ϴ�.");
if(!preg_match("/member_join.php/i",$HTTP_REFERER)) Error("���������� �ۼ��Ͽ� �ֽñ� �ٶ��ϴ�","");
if(getenv("REQUEST_METHOD") == 'GET' ) Error("���������� ���� ���ñ� �ٶ��ϴ�","");

// DB ����
if(!$connect) $connect=dbConn();

// ��� ���� ���ؿ���;;; ����� ������
$member=member_info();
if($mode=="admin"&&($member[is_admin]==1||($member[is_admin]==2&&$member[group_no]==$group_no))) $mode = "admin";
else $mode = "";

if($member[no]&&!$mode) Error("�̹� ������ �Ǿ� �ֽ��ϴ�.","window.close");

// ���� �Խ��� ���� �о� ����
if($id) {
	$setup=get_table_attrib($id);

	// �������� ���� �Խ����϶� ���� ǥ��
	if(!$setup[name]) Error("�������� ���� �Խ����Դϴ�.<br><br>�Խ����� ������ ����Ͻʽÿ�");

	// ���� �Խ����� �׷��� ���� �о� ����
	$group_data=group_info($setup[group_no]);
	if(!$group_data[use_join]&&!$mode) Error("���� ������ �׷��� �߰� ȸ���� �������� �ʽ��ϴ�");

} else {
	preg_match('/[0-9a-zA-Z\_]+/',$group_no,$result); //Ư�����ڰ� ������ ����
	if(!$group_no || $result[0]!=$group_no) Error("ȸ���׷��� �����ּž� �մϴ�");
	$group_data=mysql_fetch_array(mysql_query("select * from $group_table where no='$group_no'"));
	preg_match('/[0-9a-zA-Z\_]+/',$group_data[no],$result); //Ư�����ڰ� ������ ����
	if(!$group_data[no] || $result[0]!=$group_data[no]) Error("������ �׷��� �������� �ʽ��ϴ�");
	preg_match('/[0-9a-zA-Z\_]+/',$group_data[use_join],$result); //Ư�����ڰ� ������ ����
	if((!$group_data[use_join]&&!$mode) || $result[0]!=$group_data[use_join]) Error("���� ������ �׷��� �߰� ȸ���� �������� �ʽ��ϴ�");
}

// ���ڿ������� �˻�
$user_id = str_replace("��","",$user_id);
$name = str_replace("��","",$name);

if(!get_magic_quotes_gpc()) {
	$user_id = addslashes($user_id);
	$password = addslashes($password);
	$password1 = addslashes($password1);
	$email = addslashes($email);
}

$user_id=trim($user_id);
preg_match('/[0-9a-zA-Z\_]+/',$user_id,$result); //Ư�����ڰ� ������ ����
if(isBlank($user_id) || $result[0]!=$user_id) Error("ID�� �Է��ϼž� �մϴ�(�����ڿ� ����, _���� ���!)","");

$check=mysql_fetch_array(mysql_query("select count(*) from $member_table where user_id='$user_id'",$connect));
if($check[0]>0) Error("�̹� ��ϵǾ� �ִ� ID�Դϴ�","");

unset($check);
$check=mysql_fetch_array(mysql_query("select count(*) from $member_table where email='$email'",$connect));
if($check[0]>0) Error("�̹� ��ϵǾ� �ִ� E-Mail�Դϴ�","");

if(isBlank($password)||isBlank($password1)) Error("��й�ȣ�� �Է��ϼž� �մϴ�!","");
if($password!=$password1) Error("��й�ȣ�� ��й�ȣ Ȯ���� ��ġ���� �ʽ��ϴ�","");
// �н����带 ��ȣȭ
if($password) {
	$temp=mysql_fetch_array(mysql_query("select password('$password')"));
	$password=$temp[0];   
}

if(isBlank($name)) Error("�̸��� �Է��ϼž� �մϴ�","");
if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$name)) Error("�̸��� ����, �ѱ�, ���ڵ����� �Է��Ͽ� �ֽʽÿ�");

if($group_data[use_jumin]&&!$mode) {

	// �ֹε�� ��ȣ ��ƾ
	if(isBlank($jumin1)||isBlank($jumin2)||strlen($jumin1)!=6||strlen($jumin2)!=7) Error("�ֹε�Ϲ�ȣ�� �ùٸ��� �Է��Ͽ� �ֽʽÿ�","");

	if(!check_jumin($jumin1.$jumin2)) Error("�߸��� �ֹε�Ϲ�ȣ�Դϴ�","");

	$check=mysql_fetch_array(mysql_query("select count(*) from $member_table where jumin=password('".$jumin1.$jumin2."')",$connect));
	if($check[0]>0) Error("�̹� ��ϵǾ� �ִ� �ֹε�Ϲ�ȣ�Դϴ�","");
	$jumin=$jumin1.$jumin2;
}

$name=addslashes($name);

preg_match('/[0-9a-zA-Z.\@\_]+/',$email,$result); //Ư�����ڰ� ������ ����
if($result[0]!=$email) Error("E-mail ���ڸ� Ȯ���ϼ���(�����ڿ� ����, ., @, _���� ���!)","");
$email=addslashes($email);
if($_zbDefaultSetup[check_email]=="true"&&!mail_mx_check($email)) Error("�Է��Ͻ� $email �� �������� �ʴ� �����ּ��Դϴ�.<br>�ٽ� �ѹ� Ȯ���Ͽ� �ֽñ� �ٶ��ϴ�.");

if(preg_match("/[\!\\\#\$%\^&\+\|=\{\}\[\]\;<>\?\/\'\"]/i",$home_address)) Error("�ּҸ� ����, �ѱ�, ����, @, ( ), . , ������ �Է��Ͽ� �ֽʽÿ�");
$home_address=addslashes($home_address);

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$home_tel)) Error("����ȭ�� ����, �ѱ�, ���ڵ����� �Է��Ͽ� �ֽʽÿ�");
$home_tel=addslashes($home_tel);

if(preg_match("/[\!\\\#\$%\^&\+\|=\{\}\[\]\;<>\?\/\'\"]/i",$office_address)) Error("�繫�� �ּҸ� ����, �ѱ�, ����, @, ( ), . , ������ �Է��Ͽ� �ֽʽÿ�");
$office_address=addslashes($office_address);

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$office_tel)) Error("�繫�� ��ȭ��ȣ�� ����, �ѱ�, ���ڵ����� �Է��Ͽ� �ֽʽÿ�");
$office_tel=addslashes($office_tel);

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$handphone)) Error("�ڵ��� ��ȣ�� ����, �ѱ�, ���ڵ����� �Է��Ͽ� �ֽʽÿ�");
$handphone=addslashes($handphone);

if(preg_match("/[@\\\#\$&\(\)\+\|=\{\}\'\"]/i",$comment)) Error("�ڱ�Ұ��� ����, �ѱ�, ����, !, %, ^, -, _, ; ?, /, <>, . ������ �Է��Ͽ� �ֽʽÿ�. ��ȣ�� �׹��� Ư������, ����ǥ ���� ������ �ʽ��ϴ�!");
$comment=addslashes($comment);

$birth=mktime(0,0,0,$birth_2,$birth_3,$birth_1);
if(!preg_match("/http:\/\//i",$homepage)&&$homepage) $homepage="http://$homepage";
$reg_date=time();

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$job)) Error("������ ����, �ѱ�, ���ڵ����� �Է��Ͽ� �ֽʽÿ�");
$job = addslashes($job);

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\'\"]/i",$homepage)) Error("Ȩ������ �ּҸ� ����, �ѱ�, ����, -, ., / ������ �Է��Ͽ� �ֽʽÿ�");
$homepage = addslashes($homepage);

$birth = addslashes($birth);

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\'\"]/i",$hobby)) Error("��̸� ����, �ѱ�, ����, / ������ �Է��Ͽ� �ֽʽÿ�");
$hobby = addslashes($hobby);

preg_match('/[0-9a-zA-Z.\@\_]+/',$icq,$result); //Ư�����ڰ� ������ ����
if($result[0]!=$icq) Error("icq ���̵� Ȯ���ϼ���(�����ڿ� ����, ., @, _���� ���!)","");
$icq = addslashes($icq);

//AIM(aol) ���̵� ����ǥ��
preg_match('/[0-9a-zA-Z.\@\_]+/',$aol,$result); //Ư�����ڰ� ������ ����
if($result[0]!=$aol) Error("AIM(aol) ���̵� Ȯ���ϼ���(�����ڿ� ����, ., @, _���� ���!)","");
$aol = addslashes($aol);

preg_match('/[0-9a-zA-Z.\@\_]+/',$msn,$result); //Ư�����ڰ� ������ ����
if($result[0]!=$msn) Error("msn ���̵� Ȯ���ϼ���(�����ڿ� ����, ., @, _���� ���!)","");
$msn = addslashes($msn);

if($_FILES[picture]) {
	$picture = $_FILES[picture][tmp_name];
	$picture_name = $_FILES[picture][name];
	$picture_type = $_FILES[picture][type];
	$picture_size = $_FILES[picture][size];
}

if($picture_name) {
	//Ư�����ڰ� ������ ����
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$picture_name,$result);
	if($result[0]!=$picture_name) Error("���ϸ��� �ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!");

	if(!is_uploaded_file($picture)) Error("�������� ������� ���ε� ���ּ���");
	if(!preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$picture_name)) Error("������ jpg(jpeg)/png/gif/bmp ������ �÷��ּ���!");
	$size=GetImageSize($picture);
	if($size[0]>480||$size[1]>480) Error("������ ũ��� 480*480���Ͽ��� �մϴ�!");
	$kind=array("","jpg","jpeg","png","gif","bmp");
	$n=$size[2];
	$path="icon/member_".time().".".$kind[$n];
	if(!@move_uploaded_file($picture,$path)) Error("���� ���ε尡 ����� ���� �ʾҽ��ϴ�");
	$picture_name=$path;
}

mysql_query("insert into $member_table (level,group_no,user_id,password,name,email,homepage,icq,aol,msn,jumin,comment,job,hobby,home_address,home_tel,office_address,office_tel,handphone,mailing,birth,reg_date,openinfo,open_email,open_homepage,open_icq,open_msn,open_comment,open_job,open_hobby,open_home_address,open_home_tel,open_office_address,open_office_tel,open_handphone,open_birth,open_picture,picture,open_aol) values ('$group_data[join_level]','$group_data[no]','$user_id','$password','$name','$email','$homepage','$icq','$aol','$msn',password('$jumin'),'$comment','$job','$hobby','$home_address','$home_tel','$office_address','$office_tel','$handphone','$mailing','$birth','$reg_date','$openinfo','$open_email','$open_homepage','$open_icq','$open_msn','$open_comment','$open_job','$open_hobby','$open_home_address','$open_home_tel','$open_office_address','$open_office_tel','$open_handphone','$open_birth','$open_picture','$picture_name','$open_aol')") or error("ȸ�� ����Ÿ �Է½� ������ �߻��߽��ϴ�<br>".mysql_error());
mysql_query("update $group_table set member_num=member_num+1 where no='$group_data[no]'");

if(!$mode) {
	$member_data=mysql_fetch_array(mysql_query("select * from $member_table where user_id='$user_id' and password=password('$password')"));

	// 5.3 �̻�� ���� ó��
	$_SESSION['zb_logged_no'] = $member_data[no];
	$_SESSION['zb_logged_time'] = time();
	$_SESSION['zb_logged_ip'] = $REMOTE_ADDR;
	$_SESSION['zb_last_connect_check'] = '0';
}

// ������ ���� ���Ǻ��� ����
unset($_SESSION['WRT_SS_VRS']);
unset($_SESSION['WRT_SPM_PWD']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script>
alert("ȸ�������� ���������� ó�� �Ǿ����ϴ�\n\nȸ���� �ǽŰ��� �������� ���ϵ帳�ϴ�.");
//opener.reload();
window.close();
</script>
