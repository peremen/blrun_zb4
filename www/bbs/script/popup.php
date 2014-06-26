<script language="javascript">
function insert_tag(sTag,str,eTag)
{
	var objSelection = opener.document.selection;
	var objTextArea = opener.document.getElementById('memo');
	objTextArea.focus();
	
	if(typeof objSelection != 'undefined') //IE
	{
		var sRange = objSelection.createRange();
		//var selectedText = sRange.text;
		sRange.text = sTag + str + eTag;
	}
	else if(typeof objTextArea.selectionStart != 'undefined') //FF
	{
		var sStart = objTextArea.selectionStart;
		var sEnd = objTextArea.selectionEnd;
		objTextArea.value = objTextArea.value.substr(0, sStart) + sTag + str + eTag + objTextArea.value.substr(sEnd);
	}
	else
	{
		objTextArea.value += sTag + str + eTag;
	}
}
</script>
