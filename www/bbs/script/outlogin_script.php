
<script>
function zb_login_check_submit() {
	if(!document.zb_login.user_id.value) {
		alert("ID�� �Է��Ͽ� �ֽʽÿ�");
		document.zb_login.user_id.focus();
		return false;
	}
	if(!document.zb_login.password.value) {
		alert("Password�� �Է��Ͽ� �ֽʽÿ�");
		document.zb_login.password.focus();
		return false;
	}  
	return true;
} 

function check_autologin() { 
	if (document.zb_login.auto_login.checked==true) {
		var check;  
		check = confirm("�ڵ� �α��� ����� ����Ͻðڽ��ϱ�?\n\n�ڵ� �α��� ���� ���� ���Ӻ��ʹ� �α����� �Ͻ��ʿ䰡 �����ϴ�.\n\n��, ���ӹ�, �б��� ������ҿ��� �̿�� ���������� ����ɼ� ������ �������ּ���");
		if(check==false) {document.zb_login.auto_login.checked=false;}
	}                               
}  
</script>
