
<script>
function check_submit()
{
 if(!document.write.subject.value) 
 {alert('������ �Է��Ͽ� �ּ���');
  document.write.subject.focus();
  return false;
 }
 if(!document.write.memo.value)
 {
  alert('�������Է��Ͽ��ּ���');
  document.write.memo.focus();
  return false;
 }
 return true;
}
</script>
