<?
/***************************************************************************
 * �Խ��� ��� ���� ����
 **************************************************************************/
	if($member[is_admin]>2) Error("�Խ��ǰ��� ������ �����ϴ�");
// �Խ��� ����
	if($exec2=="modify_ok") {
		// �Էµ� ���̺� ���� ������, �ѱ��� �������� �˻�
		if(isBlank($name)) Error("�Խ��� �̸��� �Է��ϼž� �մϴ�","");
		if(!isAlNum($name)) Error("�Խ��� �̸��� ������ ���ڷθ� �ϼž� �մϴ�","");
		$name=addslashes($name);
		$bg_color=addslashes($bg_color);
		$ba_image=addslashes($bg_image);
		$header_url=addslashes($header_url);
		$footer_url=addslashes($footer_url);
		$header=addslashes($header);
		$footer=addslashes($footer);
		$pds_ext1=str_replace(" ","",$pds_ext1);
		$pds_ext2=str_replace(" ","",$pds_ext2);
		$title=addslashes($title);
		$filter=addslashes($filter);
		$avoid_tag=addslashes($avoid_tag);
		$avoid_ip=addslashes($avoid_ip);
		@mysql_query("update $admin_table set
				only_board='$only_board',skinname='$skinname',header='$header',footer='$footer',header_url='$header_url',footer_url='$footer_url',
				bg_image='$bg_image',bg_color='$bg_color',table_width='$table_width',memo_num='$memo_num', page_num='$page_num', cut_length='$cut_length', use_category='$use_category', use_html='$use_html',max_upload_size='$max_upload_size',
				use_filter='$use_filter',use_status='$use_status',use_pds='$use_pds',use_homelink='$use_homelink',
				title='$title',pds_ext1='$pds_ext1',pds_ext2='$pds_ext2',
				use_filelink='$use_filelink',use_cart='$use_cart',use_autolink='$use_autolink',use_showip='$use_showip',
				use_comment='$use_comment',use_formmail='$use_formmail',use_showreply='$use_showreply', use_secret='$use_secret', filter='$filter', avoid_tag='$avoid_tag', avoid_ip='$avoid_ip', use_alllist='$use_alllist' where no='$no'") or Error("�Խ����� ��ɼ��� ����� ������ �߻��Ͽ����ϴ�");

		if($applyall_filter) mysql_query("update $admin_table set filter='$filter'");
		if($applyall_tag) mysql_query("update $admin_table set avoid_tag='$avoid_tag'");
		if($applyall_ip) mysql_query("update $admin_table set avoid_ip='$avoid_ip'");

		movepage("$PHP_SELF?group_no=$group_no&exec=view_board&no=$no&exec2=modify&page=$page&page_num=$s_page_num");
	}

// �Խ��� �߰� 
	elseif($exec2=="add_ok") {
		// �Էµ� ���̺� ���� ������, �ѱ��� �������� �˻�
		if(isBlank($name)) Error("�Խ��� �̸��� �Է��ϼž� �մϴ�","");
		if(!isAlNum($name)) Error("�Խ��� �̸��� ������ ���ڷθ� �ϼž� �մϴ�","");

		// ���� �̸��� �Խ����� �̹� �����Ǿ������� �˻�
		$result=@mysql_query("select count(*) from $admin_table where name='$name'",$connect) or Error(mysql_error());
		$temp=mysql_fetch_array($result);
		if($temp[0]>0) Error("�̹� ��ϵǾ� �ִ� �Խ����Դϴ�.<br>�ٸ� �̸����� �����Ͻʽÿ�","");

		$name=addslashes($name);
		$bg_color=addslashes($bg_color);
		$ba_image=addslashes($bg_image);
		$header_url=addslashes($header_url);
		$footer_url=addslashes($footer_url);
		$header=addslashes($header);
		$footer=addslashes($footer);
		$title=addslashes($title);
		$pds_ext1=str_replace(" ","",$pds_ext1);
		$pds_ext2=str_replace(" ","",$pds_ext2);
		$filter=addslashes($filter);
		$avoid_tag=addslashes($avoid_tag);
		$avoid_ip=addslashes($avoid_ip);

		// ������ ���̺� ����
		@mysql_query("insert into $admin_table 
					(group_no,name,skinname,header,footer,header_url,footer_url,bg_image,bg_color,table_width,
					memo_num,page_num,cut_length,use_category,use_html,use_filter,use_status,use_pds,use_homelink,
					use_filelink,use_cart,use_autolink,use_showip,use_comment,use_formmail,use_showreply,use_secret,filter,avoid_tag, avoid_ip, use_alllist, max_upload_size,title,pds_ext1,pds_ext2,only_board)
				values
					('$group_no','$name','$skinname','$header','$footer','$header_url','$footer_url','$bg_image','$bg_color','$table_width',
					'$memo_num','$page_num','$cut_length','$use_category','$use_html','$use_filter','$use_status','$use_pds','$use_homelink',
					'$use_filelink','$use_cart','$use_autolink','$use_showip','$use_comment','$use_formmail','$use_showreply','$use_secret','$filter','$avoid_tag','$avoid_ip','$use_alllist','$max_upload_size','$title','$pds_ext1','$pds_ext2','$only_board')")                  
				or Error("������ ���̺� ���� ����<br><br>".mysql_error());

		$table_name=$name;

		include "schema.sql";

		// �Խ��� ��ü ���̺� ����
		@mysql_query($board_table_main_schema) or Error("�Խ����� ���� ���̺� ���� ������ �߻��Ͽ����ϴ�");

		// Division ���̺� ����
		@mysql_query($division_table_schema) or Error("Division ���̺� ������ ������ �߻��߽��ϴ�");
		@mysql_query("insert into $t_division"."_$table_name (division,num) values ('1','0')") or Error("Division ���̺� �� �߰��� ������ �߻��߽��ϴ�");

		// �ڸ�Ʈ ���̺� ����
		@mysql_query($board_comment_schema) or Error("�Խ����� �ڸ�Ʈ ���̺� ���� ������ �߻��Ͽ����ϴ�");

		// ī�װ� ���̺� ���� 
		@mysql_query($board_category_table) or Error("�Խ����� ī�װ� ���̺� ���� ������ �߻��Ͽ����ϴ�");
 
		// �⺻ ī�װ� �ʵ� �Է�
		@mysql_query("insert into $t_category"."_$table_name (num, name) values ('0','�Ϲ�')") or Error("�⺻ ī�װ� �Է½� ������ �߻��Ͽ����ϴ�");
		@mysql_query("insert into $t_category"."_$table_name (num, name) values ('0','����')") or Error("�⺻ ī�װ� �Է½� ������ �߻��Ͽ����ϴ�");
		@mysql_query("insert into $t_category"."_$table_name (num, name) values ('0','�亯')") or Error("�⺻ ī�װ� �Է½� ������ �߻��Ͽ����ϴ�");
 
		mysql_query("update $group_table set board_num=board_num+1 where no='$group_no'");    

		movepage("$PHP_SELF?exec=view_board&group_no=$group_no&page=$page&page_num=$page_num");
	}

	// �Խ��� ���� 
	elseif($exec2=="del") {
		if($member[is_admin]>1) Error("�Խ��ǻ��� ������ �����ϴ�");
		$data=mysql_fetch_array(mysql_query("select name from $admin_table where no='$no'"));

		$table_name=$data[name];

		$tmpData = mysql_query("select file_name1, file_name2 from $t_board"."_$table_name") or die("÷������ ���� ó���� ������ �߻��߽��ϴ�");
		while($data=mysql_fetch_array($tmpData)) {
			if($data[file_name1]) @z_unlink("./".$data[file_name1]);
			if($data[file_name2]) @z_unlink("./".$data[file_name2]);
		}

		if(is_dir("./data/".$table_name)) zRmDir("./data/".$table_name);

		mysql_query("delete from $admin_table where no='$no'") or Error("�Խ��� ������ ������ ���̺��� ������ �߻��Ͽ����ϴ�");
		mysql_query("drop table $t_board"."_$table_name") or Error("�Խ����� ���� ���̺� ���� ������ �߻��Ͽ����ϴ�");
		mysql_query("drop table $t_division"."_$table_name") or Error("�Խ����� Division ���̺� ���� ������ �߻��߽��ϴ�");
		mysql_query("drop table $t_comment"."_$table_name") or Error("�Խ����� �ڸ�Ʈ ���̺� ���� ������ �߻��Ͽ����ϴ�");
		mysql_query("drop table $t_category"."_$table_name") or Error("�Խ����� ī�װ� ���̺� ���� ������ �߻��Ͽ����ϴ�");

		mysql_query("update $group_table set board_num=board_num-1 where no='$group_no'");    

		movepage("$PHP_SELF?exec=view_board&group_no=$group_no&page=$page&page_num=$page_num");
	}

	// ī�װ� �κ�
	if($exec2=="category_add") {
		if(!$name) error("������ ī�װ� �̸��� �Է��Ͽ� �ֽʽÿ�");
		$table_data=mysql_fetch_array(mysql_query("select name from $admin_table where no='$no'"));
		$check=mysql_fetch_array(mysql_query("select count(*) from $t_category"."_$table_data[name] where name='$name'"));
		if($check[0]>0) Error("������ �̸��� ī�װ��� �ֽ��ϴ�");
		@mysql_query("insert into $t_category"."_$table_data[name] (name) values ('$name')") or error("ī�װ� �߰��� ������ �߻��߽��ϴ�");
		movepage("$PHP_SELF?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	} elseif($exec2=="del_category") {
		$table_data=mysql_fetch_array(mysql_query("select name from $admin_table where no='$no'"));
		mysql_query("delete from $t_category"."_$table_data[name] where no='$category_no'",$connect) or Error("ī�װ� ������ ������ �߻��߽��ϴ�");
		movepage("$PHP_SELF?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	} elseif($exec2=="category_modify_ok") {
		if(!$name) error("������ ī�װ� �̸��� �Է��Ͽ� �ֽʽÿ�");
		$table_data=mysql_fetch_array(mysql_query("select name from $admin_table where no='$no'"));
		mysql_query("update $t_category"."_$table_data[name] set name='$name' where no='$category_no'",$connect);

		movepage("$PHP_SELF?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	}

	// ī�װ� ���� �̵� 
	elseif($exec2=="category_move") {
		$table_data=mysql_fetch_array(mysql_query("select name from $admin_table where no='$no'"));
		for($i=0;$i<count($c);$i++) {
			mysql_query("update $t_board"."_$table_data[name] set category='$movename' where category='$c[$i]'",$connect);
		}

		$result = mysql_query("select * from $t_category"."_$table_data[name]") or die(mysql_error());
		while($data=mysql_fetch_array($result)) {
			$num = mysql_fetch_array(mysql_query("select count(*) from $t_board"."_$table_data[name] where category='$data[no]'"));
			mysql_query("update $t_category"."_$table_data[name] set num='$num[0]' where no = '$data[no]'") or die(mysql_error());
		}

		movepage("$PHP_SELF?exec=view_board&exec2=category&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	}

	// ���� ���� 
	elseif($exec2=="modify_grant_ok") {
		if($member[is_admin]>1) Error("���Ѻ��� ������ �����ϴ�");
		@mysql_query("update $admin_table set grant_html='$grant_html', grant_list='$grant_list',
				grant_view='$grant_view', grant_comment='$grant_comment', grant_write='$grant_write',
				grant_reply='$grant_reply', grant_delete='$grant_delete', grant_notice='$grant_notice',
				grant_view_secret='$grant_view_secret', use_showip = '$grant_imagebox' where no='$no'") or Error("���� ���� ����� ������ �߻��Ͽ����ϴ�".mysql_error());
		movepage("$PHP_SELF?exec=view_board&exec=view_board&exec2=grant&no=$no&page=$page&page_num=$page_num&group_no=$group_no");
	}
?>
