<?
//set_time_limit(0); 
$del_que1 = $del_que2 = null;

/***************************************************************************
* ���� ���� include
**************************************************************************/
include "_head.php";

if(!preg_match("/".$HTTP_HOST."/i",$HTTP_REFERER)||$ZBRD_SS_VRS!=$antispam) Error("���������� ���� �����Ͽ� �ֽñ� �ٶ��ϴ�.");

if($flag != ok) {
	/***************************************************************************
	* �ڸ�Ʈ ���� ����
	**************************************************************************/

	// �н����� addslashes
	if(!get_magic_quotes_gpc()) {
		$password = addslashes($password);
	}

	$pass =$password;
	// �н����带 ��ȣȭ
	if($password) {
		$temp=mysql_fetch_array(mysql_query("select password('$password')"));
		$password=$temp[0];
	}

	// �������� ������
	$s_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where no='$c_no'"));

	// ȸ���϶��� Ȯ��;;
	if(!$is_admin&&$member[level]>$setup[grant_delete]) {
		if(!$s_data[ismember]) {
			if($s_data[password]!=$password) Error("��й�ȣ�� �ùٸ��� �ʽ��ϴ�");
		} else {
			if($s_data[ismember]!=$member[no]) Error("��й�ȣ�� �Է��Ͽ� �ֽʽÿ�");
		}
	}

	if($s_data[use_html2]<2) {
		$s_data[memo]=str_replace("&nbsp;&nbsp;&nbsp;&nbsp;","\t",$s_data[memo]);
		$s_data[memo]=str_replace("&nbsp;&nbsp;","  ",$s_data[memo]);
	}

	// ���ý����̶���Ʈ ��� ó�� ����
	$codePattern = "#(<pre class\=\"brush\: [a-z]+[^>]*?>|<\/pre>)#si";
	$memo = $s_data[memo];
	$temp = preg_split($codePattern,$memo,-1,PREG_SPLIT_DELIM_CAPTURE);

	for($i=0;$i<count($temp);$i++) {
		$cnt=0;
		for($j=0;$j<count($code);$j++) {
			$pattern1 = "#<pre class\=\"brush\: ".$code[$j]."[^>]*? first-line\: ([0-9]+)\" title=\"([^\"]*?)\">#i";
			$pattern2 = "#<\/pre>#i";
			if(preg_match($pattern1,$temp[$i])) {
				$cnt++;
				$temp[$i]=preg_replace($pattern1,"[".$code[$j]."_code:\\1{\\2}]",$temp[$i]);
				$i+=1;
				if(preg_match($pattern2,$temp[$i+1])) {
					$temp[$i+1]="[/".$code[$j]."_code]";
					$i+=1;
				}
			}
		}
		if($cnt==0) {
			$temp[$i]=str_replace("&amp;","&amp;amp;",$temp[$i]);
			$temp[$i]=str_replace("&lt;","&amp;lt;",$temp[$i]);
			$temp[$i]=str_replace("&gt;","&amp;gt;",$temp[$i]);
		}
	}

	$memo="";

	for($i=0;$i<count($temp);$i++) {
		$memo = $memo.$temp[$i];
	}
	// ���ý����̶���Ʈ ��� ó�� ��

	// ���� �ڸ�Ʈ ǥ�� �ҷ��� ó��
	if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",$memo,$c_match)) {
		$c_org = $c_match[1];
		$c_depth = $c_match[2];
		$memo = str_replace($c_match[0],"",$memo);
	} else {
		$c_org = 0;
		$c_depth = 0;
	}
	unset($o_data);
	if($c_org) {
		$result2=@mysql_query("select * from $t_comment"."_$id where no='$c_org'") or error(mysql_error());
		$o_data=mysql_fetch_array($result2);
		if(!$o_data[no]) Error("���� ������ �������� �ʽ��ϴ�");
	}

	$memo=str_replace("&nbsp;","&amp;nbsp;",trim(stripslashes($memo)));

	if($s_data[file_name1])$s_file_name1="<br>&nbsp;".$s_data[s_file_name1]."�� ��ϵǾ� �ֽ��ϴ�.<br> <input type=checkbox name=del_file1 value=1> ����";
	if($s_data[file_name2])$s_file_name2="<br>&nbsp;".$s_data[s_file_name2]."�� ��ϵǾ� �ֽ��ϴ�.<br> <input type=checkbox name=del_file2 value=1> ����";

	// �ڷ�� ����� ����ϴ��� ���ϴ��� ǥ��;;
	if(!$setup[use_pds]) { $hide_pds_start="<!--";$hide_pds_end="-->";}

	if($s_data[use_html2]) $use_html2=" checked ";
	// ��б� üũ�ڽ� ó��
	if(!$o_data[is_secret]&&$s_data[is_secret])
		$secret=" checked ";
	elseif($o_data[is_secret])
		$secret=" checked disabled";
	// HTML��� üũ��ư 
	if($setup[use_html]==0) {
		if(!$is_admin&&$member[level]>$setup[grant_html]) { 
			$hide_html_start="<!--";
			$hide_html_end="-->"; 
		}
	}

	// HTML ��� üũ�� Ȯ���Ŵ
	if(!$s_data[use_html2]) $value_use_html2 = 1;
	else $value_use_html2=$s_data[use_html2];
	$use_html2 .= " value='$value_use_html2' onclick='check_use_html2(this)'><ZeroBoard";

	// ��б� ���;;
	if(!$setup[use_secret]||$o_data[ismember]=="0") { $hide_secret_start="<!--"; $hide_secret_end="-->"; }

	// �̹��� â�� ��ư
	if($member[no]&&$setup[grant_imagebox]>=$member[level]) $a_imagebox="<a onfocus=blur() href='javascript:showImageBox(\"$id\")'>"; else $a_imagebox="<Zeroboard ";
	if($s_data[ismember]!=$member[no]) $a_imagebox = "<Zeroboard";

	// �̸����� ��ư
	$a_preview="<a onfocus=blur() href='#' onclick='javascript:return view_preview();'>";

	// �ڵ���� ��ư
	if($setup[use_html]>0) $a_codebox="<a onfocus=blur() href='javascript:showCodeBox()'>"; else $a_codebox="<Zeroboard ";

	$a_list="<a href=zboard.php?$href$sort>";
	$a_view="<a href=view.php?$href$sort&no=$no>";

	head(" onload=unlock() onunload=hideImageBox() ","script_comment_modify.php");
?>
<table border=0 cellspacing=1 cellpadding=1 class=line1 width=<?=$width?>>
<tr>
	<td bgcolor=white>
		<table border=0 cellspacing=1 cellpadding=8 width=100% height=120 bgcolor=white>
		<form method=post action="comment_modify_ok.php?flag=ok" onsubmit="return check_submit()" id=write name=write enctype=multipart/form-data>
		<input type=hidden name=page value=<?=$page?>>
		<input type=hidden name=id value=<?=$id?>>
		<input type=hidden name=no value=<?=$no?>>
		<input type=hidden name=select_arrange value=<?=$select_arrange?>>
		<input type=hidden name=desc value=<?=$desc?>>
		<input type=hidden name=page_num value=<?=$page_num?>>
		<input type=hidden name=keyword value="<?=$keyword?>">
		<input type=hidden name=category value="<?=$category?>">
		<input type=hidden name=sn value="<?=$sn?>">
		<input type=hidden name=ss value="<?=$ss?>">
		<input type=hidden name=sc value="<?=$sc?>">
		<input type=hidden name=sm value="<?=$sm?>">
		<input type=hidden name=mode value="<?=$mode?>">
		<input type=hidden name=c_no value=<?=$c_no?>>
		<input type=hidden name=c_org value=<?=$c_org?>>
		<input type=hidden name=c_depth value=<?=$c_depth?>>
		<input type=hidden name=antispam value=<?=$antispam?>>
		<col width=70 align=right style=padding-right:10px></col><col width=></col>
<?if(!$member['no']){?>
		<tr>
			<td class=list0><font class=list_eng><b>Name</b></font></td>
			<td class=list1><input type=text id=name name=name <?=size(8)?> maxlength=20 class=input value="<?=trim(stripslashes($s_data[name]))?>"></td>
		</tr>
		<tr>
			<td class=list0><font class=list_eng><b>Password</b></font></td>
			<td class=list1><input type=password id=password name=password <?=size(8)?> maxlength=20 class=input value="<?=stripslashes($pass)?>"></td>
		</tr>
		<?}?>
<?=$hide_html_start?>
		<tr>
			<td class=list0><font class=list_eng><b>Option</b></font></td>
			<td class=list_eng>
				<?=$hide_html_start?> <input type=checkbox name=use_html2<?=$use_html2?>> HTML���<?=$hide_html_end?><?=$hide_secret_start?> <input type=checkbox name=is_secret id=is_secret <?=$secret?> value=1> ��б�<?=$hide_secret_end?>

			</td>
		</tr>
<?=$hide_html_end?>
		<tr>	
			<td class=list0 onclick="document.getElementById('memo').rows=document.getElementById('memo').rows+4" style=cursor:pointer><font class=list_eng><b>Comment</b><br>��</font></td>
			<td width=100% height=100% class=list1>
				<table border=0 cellspacing=2 cellpadding=0 width=100% height=100 style=table-layout:fixed>
				<col width=></col><col width=70></col>
				<tr>
					<td width=100%><textarea id=memo name=memo cols=20 rows=8 class=textarea style=width:100% onkeydown='return doTab(event);'><?=$memo?></textarea></td>
					<td width=70><input type=submit rows=5 class=submit value='�����ϱ�' accesskey="s" style=height:100%></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan=2 class=list1>
				<table border=0 cellspacing=2 cellpadding=0 width=100% height=20>
				<col width=5%></col><col width=45%></col><col width=5%></col><col width=45%></col>
				<tr valign=top>
<?=$hide_pds_start?>
				  <td width=52 align=right><font class=list_eng>Upload #1</font></td>
				  <td class=list_eng><input type=file name=file1 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name1?></td>
				  <td width=52 align=right><font class=list_eng>Upload #2</font></td>
				  <td class=list_eng><input type=file name=file2 <?=size(50)?> maxlength=255 class=input style=width:99%> <?=$s_file_name2?></td>
<?=$hide_pds_end?>
				</tr>
				</table>
			</td>
		</tr>
		</form>
		</table>
	</td>
</tr>
</table>
<div align="left"><?=$a_preview?>�̸�����</a> <?=$a_imagebox?>�׸�â��</a> <?=$a_codebox?>�ڵ����</a></div>
<?
	foot();
	include "_foot.php";
} else {

	if(!$member[no]) {
		if(isblank($name)) Error("�̸��� �Է��ϼž� �մϴ�");
		if(isblank($password)) Error("��й�ȣ�� �Է��ϼž� �մϴ�");
	}

	$memo = str_replace("��","",$memo);
	$name = stripslashes($name);
	$name = str_replace("��","",$name);

	if(isblank($memo)) Error("������ �Է��ϼž� �մϴ�");

	// ���ö��� ���� ���� ���� ���ڿ� �˻�
	if(preg_match("#\|\|\|([0-9]{1,})\|([0-9]{1,10})$#",trim($memo))) Error("����� ���ڿ��� ����� �� �����ϴ�");

	// ���͸�;; �����ڰ� �ƴҶ�;;
	if(!$is_admin&&$setup[use_filter]) {
		$filter=explode(",",$setup[filter]);
		$f_memo=eregi_replace("([\_\-\./~@?=%&! ]+)","",strip_tags($memo));
		for($i=0;$i<count($filter);$i++) 
		if(!isblank($filter[$i])) {
			if(eregi($filter[$i],$f_memo)) Error("<b>$filter[$i]</b> ��(��) ����ϱ⿡ ������ �ܾ �ƴմϴ�");
		}
	}

	// �н����� addslashes
	if(!get_magic_quotes_gpc()) {
		$password = addslashes($password);
	}

	// �н����带 ��ȣȭ
	if($password) {
		$temp=mysql_fetch_array(mysql_query("select password('$password')"));
		$password=$temp[0];   
	}

	// &lt,&gt�� ���ý����̶���Ʈ���� ����ϱ� ���� �ӽ� ġȯ
	$memo=str_replace("&lt;","my_lt_ek",$memo);
	$memo=str_replace("&gt;","my_gt_ek",$memo);

	// �������̰ų� HTML��뷹���� ������ �±��� ���������� üũ
	if(!$is_admin&&$setup[grant_html]<$member[level]) {

		// ������ HTML ����;;
		if(!$use_html2||$setup[use_html]==0) $memo=del_html($memo);

		// HTML�� �κ�����϶�;;
		if($use_html2&&$setup[use_html]==1) {
			$memo=str_replace("<","&lt;",$memo);
			$tag=explode(",",$setup[avoid_tag]);
			for($i=0;$i<count($tag);$i++) {
				if(!isblank($tag[$i])) { 
					$memo=eregi_replace("&lt;".$tag[$i]." ","<".$tag[$i]." ",$memo); 
					$memo=eregi_replace("&lt;".$tag[$i].">","<".$tag[$i].">",$memo); 
					$memo=eregi_replace("&lt;/".$tag[$i],"</".$tag[$i],$memo); 
				}
			}
			// XSS ��ŷ �̺�Ʈ �ڵ鷯 ����
			$xss_pattern1 = "!(<[^>]*?)on(load|click|error|abort|activate|afterprint|afterupdate|beforeactivate|beforecopy|beforecut|beforedeactivate|beforeeditfocus|beforepaste|beforeprint|beforeunload|beforeupdate|blur|bounce|cellchange|change|contextmenu|controlselect|copy|cut|dataavailable|datasetchanged|datasetcomplete|dblclick|deactivate|drag|dragend|dragenter|dragleave|dragover|dragstart|drop|errorupdate|filterchange|finish|focus|focusin|focusout|help|keydown|keypress|keyup|layoutcomplete|losecapture|mousedown|mouseenter|mouseleave|mousemove|mouseout|mouseover|mouseup|mousewheel|move|moveend|movestart|paste|propertychange|readystatechange|reset|resize|resizeend|resizestart|rowenter|rowexit|rowsdelete|rowsinserted|scroll|select|selectionchange|selectstart|start|stop|submit|unload)([^>]*?)(>)!i";
			$xss_pattern2 = "!on(load|click|error|abort|activate|afterprint|afterupdate|beforeactivate|beforecopy|beforecut|beforedeactivate|beforeeditfocus|beforepaste|beforeprint|beforeunload|beforeupdate|blur|bounce|cellchange|change|contextmenu|controlselect|copy|cut|dataavailable|datasetchanged|datasetcomplete|dblclick|deactivate|drag|dragend|dragenter|dragleave|dragover|dragstart|drop|errorupdate|filterchange|finish|focus|focusin|focusout|help|keydown|keypress|keyup|layoutcomplete|losecapture|mousedown|mouseenter|mouseleave|mousemove|mouseout|mouseover|mouseup|mousewheel|move|moveend|movestart|paste|propertychange|readystatechange|reset|resize|resizeend|resizestart|rowenter|rowexit|rowsdelete|rowsinserted|scroll|select|selectionchange|selectstart|start|stop|submit|unload)=!i";
			if(preg_match($xss_pattern1,$memo))
				$memo=preg_replace($xss_pattern1,"\\1\\4",$memo);
			if(preg_match($xss_pattern2,$memo))
				$memo=preg_replace($xss_pattern2,"",$memo);
		}
	} else {
		if(!$use_html2) {
			$memo=del_html($memo);
		}
	}

	// ���ý����̶���Ʈ ó�� ����
	$codePattern = "#(\[[a-z]+\_code\:[0-9]+\{[^}]*?\}\]|\[\/[a-z]+\_code\])#si";
	$temp = preg_split($codePattern,$memo,-1,PREG_SPLIT_DELIM_CAPTURE);

	for($i=0;$i<count($temp);$i++) {
		for($j=0;$j<count($code);$j++) {
			$pattern1 = "#\[".$code[$j]."\_code\:([0-9]+)\{([^}]*?)\}\]#i";
			$pattern2 = "#\[\/".$code[$j]."\_code\]#i";
			if(preg_match($pattern1,$temp[$i])) {
				if($code[$j]=="php")
					$temp[$i]=preg_replace($pattern1,"<pre class=\"brush: $code[$j]; html_script: true; first-line: \\1\" title=\"\\2\">",$temp[$i]);
				else
					$temp[$i]=preg_replace($pattern1,"<pre class=\"brush: $code[$j]; first-line: \\1\" title=\"\\2\">",$temp[$i]);

				$temp[$i+1]=str_replace("&amp;","&amp;amp;",$temp[$i+1]);
				$temp[$i+1]=str_replace("&#039;","&amp;#039;",$temp[$i+1]);
				$temp[$i+1]=str_replace("&quot;","&amp;quot;",$temp[$i+1]);
				$temp[$i+1]=str_replace("&nbsp;","&amp;nbsp;",$temp[$i+1]);
				$temp[$i+1]=str_replace("my_lt_ek","&amp;lt;",$temp[$i+1]); // &lt ���!
				$temp[$i+1]=str_replace("my_gt_ek","&amp;gt;",$temp[$i+1]); // &gt ���!
				$temp[$i+1]=str_replace("<","&lt;",$temp[$i+1]);
				//$temp[$i+1]=str_replace("\'","&#039;",$temp[$i+1]);
				//$temp[$i+1]=str_replace("\"","&quot;",$temp[$i+1]);
				$i+=1;
			}
			elseif(preg_match($pattern2,$temp[$i])) {
				$temp[$i]="</pre>";
			}
		}
	}

	$memo="";

	for($i=0;$i<count($temp);$i++) {
		$memo = $memo.$temp[$i];
	}
	// ���ý����̶���Ʈ ó�� ��

	// �ӽ� ġȯ�� ���ڸ� ������
	$memo=str_replace("my_lt_ek","&lt;",$memo);
	$memo=str_replace("my_gt_ek","&gt;",$memo);

	// �������� ������
	unset($s_data);
	$s_data=mysql_fetch_array(mysql_query("select * from $t_comment"."_$id where no='$c_no'"));

	// �������� �̿��� ��
	if(!$s_data[no]) Error("�ش� ������ �������� �ʽ��ϴ�!");

	// ȸ������� �Ǿ� ������ �̸����� ������;;
	if($member[no]) {
		if($member[no]!=$s_data[ismember]) {
			$name=$s_data[name];
		} else {
			$name=$member[name];
		}
	}

	// ���� ������ addslashes ��Ŵ;;
	$name=trim(addslashes(del_html($name)));
	$memo=trim(addslashes($memo));
	if($use_html2<2) {
		$memo=str_replace("  ","&nbsp;&nbsp;",$memo);
		$memo=str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$memo);
	}

	$reg_date=time(); // ������ �ð�����

	if($c_depth) {
		$memo.="|||".$c_org."|".$c_depth;
	}

	/***************************************************************************
	 * ���ε尡 ������
	 **************************************************************************/
	if($HTTP_POST_FILES[file1]) {
		$file1 = $HTTP_POST_FILES[file1][tmp_name];
		$file1_name = $HTTP_POST_FILES[file1][name];
		$file1_size = $HTTP_POST_FILES[file1][size];
	}
	if($HTTP_POST_FILES[file2]) {
		$file2 = $HTTP_POST_FILES[file2][tmp_name];
		$file2_name = $HTTP_POST_FILES[file2][name];
		$file2_size = $HTTP_POST_FILES[file2][size];
	}

	// ���ϻ���
	if($del_file1==1) {
		@z_unlink("./".$s_data[file_name1]);
		$del_que1=",file_name1='',s_file_name1=''";
		// �� ���� ���� ����
		if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name1],$out))
			if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
	} 
	if($del_file2==1) {
		@z_unlink("./".$s_data[file_name2]);
		$del_que2=",file_name2='',s_file_name2=''";
		// �� ���� ���� ����
		if(preg_match("#^data\/([^/]+?)\/([0-9]*?)\/(.+?)\.(.+?)#i",$s_data[file_name2],$out))
			if(is_dir("./data/".$out[1]."/".$out[2])) @rmdir("./data/".$out[1]."/".$out[2]);
	}
	
	if($file1_size>0&&$setup[use_pds]&&$file1) {
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$file1_name,$result); //Ư�����ڰ� ������ ����
		if($result[0]!=$file1_name) Error("�ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!"); //Ư�� ���ڰ� ������

		if(!is_uploaded_file($file1)) Error("�������� ������� ���ε� ���ּ���");
		if($file1_name==$file2_name) Error("���� ������ ����Ҽ� �����ϴ�");
		$file1_size=filesize($file1);

		if($setup[max_upload_size]<$file1_size&&!$is_admin) error("ù��° ���� ���ε�� �ְ� ".GetFileSize($setup[max_upload_size])." ���� �����մϴ�");

		// ���ε� ����
		if($file1_size>0) {
			$s_file_name1=$file1_name;
			if(substr($s_file_name1,0,1)=='.'||preg_match("#\.(inc|phtm|htm|shtm|ztx|php|dot|asp|cgi|pl)$#i",$s_file_name1)) Error("Html, PHP ���������� ���ε��Ҽ� �����ϴ�");

			// Ȯ���� �˻�
			if($setup[pds_ext1]) {
				$temp=explode(".",$s_file_name1);
				$s_point=count($temp)-1;
				$upload_check=$temp[$s_point];
				if(!preg_match("/".$upload_check."/i",$setup[pds_ext1])||!$upload_check) Error("ù��° ���ε�� $setup[pds_ext1] Ȯ���ڸ� �����մϴ�");
			}

			$file1=eregi_replace("\\\\","\\",$file1);
			$s_file_name1=str_replace(" ","_",$s_file_name1);
			$s_file_name1=str_replace("-","_",$s_file_name1);

			// ���丮�� �˻���
			if(!is_dir("data/".$id)) { 
				@mkdir("data/".$id,0777,true);
				@chmod("data/".$id,0707);
			}

			// �ߺ������� ������;; 
			if(file_exists("data/$id/".$s_file_name1)) {
				@mkdir("data/$id/".$reg_date,0777);
				if(!move_uploaded_file($file1,"data/$id/".$reg_date."/".$s_file_name1)) Error("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
				$file_name1="data/$id/".$reg_date."/".$s_file_name1;
				@chmod($file_name1,0706);
				@chmod("data/$id/".$reg_date,0707);
			} else {
				if(!move_uploaded_file($file1,"data/$id/".$s_file_name1)) Error("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
				$file_name1="data/$id/".$s_file_name1;   
				@chmod($file_name1,0706);
			}
		}
	}

	if($file2_size>0&&$setup[use_pds]&&$file2) {
		preg_match('/[0-9a-zA-Z.\(\)\[\] \+\-\_\xA1-\xFE\xA1-\xFE]+/',$file2_name,$result); //Ư�����ڰ� ������ ����
		if($result[0]!=$file2_name) Error("�ѱ�,������,����,��ȣ,����,+,-,_ ���� ����� �� �ֽ��ϴ�!"); //Ư�� ���ڰ� ������
		
		if(!is_uploaded_file($file2)) Error("�������� ������� ���ε� ���ּ���");
		$file2_size=filesize($file2);
		if($setup[max_upload_size]<$file2_size&&!$is_admin) error("���� ���ε�� �ְ� ".GetFileSize($setup[max_upload_size])." ���� �����մϴ�");
		if($file2_size>0) {
			$s_file_name2=$file2_name;
			if(substr($s_file_name2,0,1)=='.'||preg_match("#\.(inc|phtm|htm|shtm|ztx|php|dot|asp|cgi|pl)$#i",$s_file_name2)) Error("Html, PHP ���������� ���ε��Ҽ� �����ϴ�");

			// Ȯ���� �˻�
			if($setup[pds_ext2]) {
				$temp=explode(".",$s_file_name2);
				$s_point=count($temp)-1;
				$upload_check=$temp[$s_point];
				if(!preg_match("/".$upload_check."/i",$setup[pds_ext2])||!$upload_check) Error("���ε�� $setup[pds_ext2] Ȯ���ڸ� �����մϴ�");
			}

			$file2=eregi_replace("\\\\","\\",$file2);
			$s_file_name2=str_replace(" ","_",$s_file_name2);
			$s_file_name2=str_replace("-","_",$s_file_name2);

			// ���丮�� �˻���
			if(!is_dir("data/".$id)) {
				@mkdir("data/".$id,0777,true);
				@chmod("data/".$id,0707);
			}

			// �ߺ������� ������;; 
			if(file_exists("data/$id/".$s_file_name2)) {
				@mkdir("data/$id/".$reg_date,0777);
				if(!move_uploaded_file($file2,"data/$id/".$reg_date."/".$s_file_name2)) Error("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
				$file_name2="data/$id/".$reg_date."/".$s_file_name2;
				@chmod($file_name2,0706);
				@chmod("data/$id/".$reg_date,0707);
			} else {
				if(!move_uploaded_file($file2,"data/$id/".$s_file_name2)) Error("���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
				$file_name2="data/$id/".$s_file_name2;              
				@chmod($file_name2,0706);
			}
		}
	}
	
	/***************************************************************************
	 * �������϶�-���� ���� ����
	 **************************************************************************/
	if($s_data[ismember]) {
		if(!$is_admin&&$member[level]>$setup[grant_delete]&&$s_data[ismember]!=$member[no]) Error("�������� ������� �����ϼ���");
	}

	// ���ϵ��
	if($file_name1) {$del_que1=",file_name1='$file_name1',s_file_name1='$s_file_name1'";}
	if($file_name2) {$del_que2=",file_name2='$file_name2',s_file_name2='$s_file_name2'";}

	// ������ ���� ���Ѷ� �н����带 ������Ʈ ��Ű�� �ʴ´�
	if(!$is_admin&&$member[level]>$setup[grant_delete])
		$ps_str="password='$password',";
	else
		$ps_str="";

	$query = "update $t_comment"."_$id set ".$ps_str."name='$name',memo='$memo',use_html2='$use_html2',is_secret='$is_secret' $del_que1 $del_que2 where no = '$c_no'";
	$result = mysql_query($query,$connect);

	if($result) {
		// ������ ���� ���Ǻ��� ����
		session_unregister("ZBRD_SS_VRS");
		session_unregister("num1num2");
		// ������ �̵�
		if($setup[use_alllist]) movepage("zboard.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no");
		else movepage("view.php?id=$id&page=$page&page_num=$page_num&select_arrange=$select_arrange&desc=$des&sn=$sn&ss=$ss&sc=$sc&sm=$sm&keyword=$keyword&no=$no");
		exit;
	}
	else {
		echo "<script>alert('�ڸ�Ʈ ��������');</script>";
		session_unregister("ZBRD_SS_VRS");
		session_unregister("num1num2");
		exit;
	}
}

@mysql_close($connect);
?>