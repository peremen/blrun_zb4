<?
// ���̺귯�� �Լ� ���� ��ũ���
include "lib.php";

if(getenv("REQUEST_METHOD") == 'GET' ) Error("���������� ���� ���ñ� �ٶ��ϴ�","");

// DB ����
if(!$connect) $connect=dbConn();

// ��� ���� ���ؿ���;;; ����� ������
$member=member_info();
if(!$member[no]) Error("ȸ�������� �������� �ʽ��ϴ�");
$group=group_info($member[group_no]);

$name = str_replace("��","",$name);

if(!get_magic_quotes_gpc()) {
	$password = addslashes($password);
	$password1 = addslashes($password1);
	$email = addslashes($email);
}

if(isblank($name)) Error("�̸��� �Է��ϼž� �մϴ�");
if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$name)) Error("�̸��� ����, �ѱ�, ���ڵ����� �Է��Ͽ� �ֽʽÿ�");

// �н����带 �Է� Ȯ�� �� ��ȣȭ
if($password){
	//stripslashes($password);
	if($password) {
		$temp=mysql_fetch_array(mysql_query("select password('$password')"));
		$password=$temp[0];   
	}
}
if($password1){
	//stripslashes($password1);
	if($password1) {
		$temp=mysql_fetch_array(mysql_query("select password('$password1')"));
		$password1=$temp[0];   
	}
}
if($password!=$password1) Error("��й�ȣ�� ��й�ȣ Ȯ���� ��ġ���� �ʽ��ϴ�","");

$birth=mktime(0,0,0,$birth_2,$birth_3,$birth_1);

$check=mysql_fetch_array(mysql_query("select count(*) from $member_table where email='$email' and no <> ".$member[no],$connect));
if($check[0]>0) Error("�̹� ��ϵǾ� �ִ� E-Mail�Դϴ�");

$name = addslashes(del_html($name));

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$job)) Error("������ ����, �ѱ�, ���ڵ����� �Է��Ͽ� �ֽʽÿ�");
$job = addslashes(del_html($job));

preg_match('/[0-9a-zA-Z.\@\_]+/',$email,$result); // Ư�����ڰ� ������ ����
if($result[0]!=$email) Error("E-mail ���ڸ� Ȯ���ϼ���(�����ڿ� ����, ., @, _���� ���!)","");	
$email = addslashes(del_html($email));
if($_zbDefaultSetup[check_email]=="true"&&!mail_mx_check($email)) Error("�Է��Ͻ� $email �� �������� �ʴ� �����ּ��Դϴ�.<br>�ٽ� �ѹ� Ȯ���Ͽ� �ֽñ� �ٶ��ϴ�.");
// email IP ǥ�� �ҷ��� ó��
unset($c_match);
if(preg_match("#\|\|\|([0-9.]{1,})$#",$member[email],$c_match)) {
	$tokenID = $c_match[1];
}
$email.="|||".$tokenID;

if(!preg_match("/http:\/\//i",$homepage)&&$homepage) $homepage="http://$homepage";
if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\'\"]/i",$homepage)) Error("Ȩ������ �ּҸ� ����, �ѱ�, ����, -, ., / ������ �Է��Ͽ� �ֽʽÿ�");
$homepage = addslashes(del_html($homepage));

$birth = addslashes(del_html($birth));

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\'\"]/i",$hobby)) Error("��̸� ����, �ѱ�, ����, / ������ �Է��Ͽ� �ֽʽÿ�");
$hobby = addslashes(del_html($hobby));

preg_match('/[0-9a-zA-Z.\@\_]+/',$icq,$result); //Ư�����ڰ� ������ ����
if($result[0]!=$icq) Error("icq ���̵� Ȯ���ϼ���(�����ڿ� ����, ., @, _���� ���!)","");
$icq = addslashes(del_html($icq));

//AIM(aol) ���̵� ����ǥ��
preg_match('/[0-9a-zA-Z.\@\_]+/',$aol,$result); //Ư�����ڰ� ������ ����
if($result[0]!=$aol) Error("AIM(aol) ���̵� Ȯ���ϼ���(�����ڿ� ����, ., @, _���� ���!)","");
$aol = addslashes(del_html($aol));

preg_match('/[0-9a-zA-Z.\@\_]+/',$msn,$result); //Ư�����ڰ� ������ ����
if($result[0]!=$msn) Error("msn ���̵� Ȯ���ϼ���(�����ڿ� ����, ., @, _���� ���!)","");
$msn = addslashes(del_html($msn));

if(preg_match("/[\!\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\/\'\"]/i",$home_address)) Error("�ּҸ� ����, �ѱ�, ����, @, . ������ �Է��Ͽ� �ֽʽÿ�");
$home_address = addslashes(del_html($home_address));

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$home_tel)) Error("����ȭ�� ����, �ѱ�, ���ڵ����� �Է��Ͽ� �ֽʽÿ�");
$home_tel = addslashes(del_html($home_tel));

if(preg_match("/[\!\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>,\?\/\'\"]/i",$office_address)) Error("�繫�� �ּҸ� ����, �ѱ�, ����, @, . ������ �Է��Ͽ� �ֽʽÿ�");
$office_address = addslashes(del_html($office_address));

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$office_tel)) Error("�繫�� ��ȭ��ȣ�� ����, �ѱ�, ���ڵ����� �Է��Ͽ� �ֽʽÿ�");
$office_tel = addslashes(del_html($office_tel));

if(preg_match("/[\!@\\\#\$%\^&\(\)\+\|=\{\}\[\]\;<>\.,\?\/\'\"]/i",$handphone)) Error("�ڵ��� ��ȣ�� ����, �ѱ�, ���ڵ����� �Է��Ͽ� �ֽʽÿ�");
$handphone = addslashes(del_html($handphone));

if(preg_match("/[@\\\#\$&\(\)\+\|=\{\}\'\"]/i",$comment)) Error("�ڱ�Ұ��� ����, �ѱ�, ����, !, %, ^, -, _, ; ?, /, <>, . ������ �Է��Ͽ� �ֽʽÿ�. ��ȣ�� �׹��� Ư������, ����ǥ ���� ������ �ʽ��ϴ�!");
$comment = addslashes(del_html($comment));

$que="update $member_table set name='$name'";
if($password&&$password1&&$password==$password1) $que.=" ,password='$password' ";
if($birth_1&&$birth_2&&birth_3&&$group[use_birth]) $que.=",birth='$birth'";
if($email) $que.=",email='$email'";
$que.=",homepage='$homepage'";
if($group[use_job]) $que.=",job='$job'";
if($group[use_hobby]) $que.=",hobby='$hobby'";
if($group[use_icq]) $que.=",icq='$icq'";
if($group[use_aol]) $que.=",aol='$aol'";
if($group[use_msn]) $que.=",msn='$msn'";
if($group[use_home_address]) $que.=",home_address='$home_address'";
if($group[use_home_tel]) $que.=",home_tel='$home_tel'";
if($group[use_office_address]) $que.=",office_address='$office_address'";
if($group[use_office_tel]) $que.=",office_tel='$office_tel'";
if($group[use_handphone]) $que.=",handphone='$handphone'";
if($group[use_mailing]) $que.=",mailing='$mailing'";
$que.=",openinfo='$openinfo'";
if($group[use_comment]) $que.=",comment='$comment'";
$que.=",openinfo='$openinfo',open_email='$open_email',open_homepage='$open_homepage',open_icq='$open_icq',open_msn='$open_msn',open_comment='$open_comment',open_job='$open_job',open_hobby='$open_hobby',open_home_address='$open_home_address',open_home_tel='$open_home_tel',open_office_address='$open_office_address',open_office_tel='$open_office_tel',open_handphone='$open_handphone',open_birth='$open_birth',open_picture='$open_picture',open_aol='$open_aol' ";
$que.=" where no='$member[no]'";

@mysql_query($que) or Error("ȸ������ �����ÿ� ������ �߻��Ͽ����ϴ� ".mysql_error());

if($del_picture) {
	@z_unlink($member[picture]);
	@mysql_query("update $member_table set picture='' where no='$member[no]'") or Error("���� �ڷ� ���ε�� ������ �߻��Ͽ����ϴ�");
}

if($HTTP_POST_FILES[picture]) {
	$picture = $HTTP_POST_FILES[picture][tmp_name];
	$picture_name = $HTTP_POST_FILES[picture][name];
	$picture_type = $HTTP_POST_FILES[picture][type];
	$picture_size = $HTTP_POST_FILES[picture][size];
}

if($picture_name) {
	// Ư�����ڰ� ������ ����
	preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$picture_name,$result);
	if($result[0]!=$picture_name) Error("���ϸ��� �ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!");

	if(!is_uploaded_file($picture)) Error("�������� ������� ���ε� ���ּ���");
	if(!preg_match("#\.(jpg|jpeg|png|gif|bmp)$#i",$picture_name)) Error("������ jpg(jpeg)/png/gif/bmp ������ �÷��ּ���!");
	$size=GetImageSize($picture);
	if($size[0]>480||$size[1]>480) Error("������ ũ��� 480*480���Ͽ��� �մϴ�!");
	$kind=array("","jpg","jpeg","png","gif","bmp");
	$n=$size[2];
	$path="icon/member_".time().".".$kind[$n];
	if(!move_uploaded_file($picture,$path)) Error("���� ���ε尡 ����� ���� �ʾҽ��ϴ�");
	@mysql_query("update $member_table set picture='$path' where no='$member[no]'") or Error("���� �ڷ� ���ε�� ������ �߻��Ͽ����ϴ�");
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script>
alert("ȸ������ ���� ������ ����� ó���Ǿ����ϴ�.");
//opener.reload();
window.close();
</script>
