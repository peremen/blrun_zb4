<?
function zbDB_getFields($tableName) {
	global $connect;
	$result = mysqli_query($connect,"show fields from $tableName") or die(mysqli_error($connect));
	unset($query);
	while($data=mysqli_fetch_array($result)) {
		$field = $data["Field"];
		$type = " ".$data["Type"];
		if($data["Null"]=="YES") $null = " null"; else $null = " not null";
		if($data["Default"]) $default = " default '".$data["Default"]."'"; else $default="";
		$extra = " ".$data["Extra"];
		if($data["Key"]=="PRI") $key = " primary key"; else $key="";
		$query .= "    ".$field.$type.$null.$default.$extra.$key.",\n";
	}
	return $query;
}

function zbDB_getKeys($tableName) {
	global $connect;
	$result = mysqli_query($connect,"show keys from $tableName") or die(mysqli_error($connect));
	unset($query);
	$i=0;
	$toggle_name = "";
	while($data=mysqli_fetch_array($result)) {
		if($data["Key_name"]!="PRIMARY") {
			$key_name = $data["Key_name"];
			$column_name = $data["Column_name"];
			if($toggle_name!=$key_name) {
				if($toggle_name) $query .="),\n";
				$query .= "    KEY $key_name ($column_name";
				$toggle_name=$key_name;
			} else {
				if($toggle_name) {
					$query .= ",$column_name";
				}
			}
		}
	}
	if($toggle_name&&$toggle_name==$key_name) $query.="),\n";
	return $query;
}

function zbDB_getSchema($tableName) {
	$fields = zbDB_getFields($tableName);
	$key = zbDB_getKeys($tableName);
	$schema = $fields."\n".$key;
	$schema = mb_substr($schema,0,mb_strlen($schema)-2);
	$schema = "\nCREATE TABLE $tableName ( \n".$schema." \n) ENGINE=MyISAM; ";
	echo $schema;
	flush();
}

function zbDB_getDataList($tableName) {
	global $connect;
	$result = mysqli_query($connect,"show fields from $tableName") or die(mysqli_error($connect));
	while($data=mysqli_fetch_array($result)) {
		$field .= $data["Field"].",";
	}
	$field = mb_substr($field,0,mb_strlen($field)-1);
	$field_array = explode(",",$field);
	$field_count = count($field_array);

	$query = "\n";
	$result = mysqli_query($connect,"select $field from $tableName") or die(mysqli_error($connect));
	while($data=mysqli_fetch_array($result)) {
		unset($str);
		for($i=0;$i<$field_count;$i++) {
			$str .= " '".addslashes($data[$field_array[$i]])."',";
		}
		$str = mb_substr($str,0,mb_strlen($str)-1);
		echo "INSERT INTO ".$tableName." VALUES (".$str.");\n";
		flush();
	}
}

function zbDB_down($tableName) {
	echo "\n#\n# '$tableName' structure \n#\n";
	zbDB_getSchema($tableName);
	echo "\n";
	echo "\n#\n# '$tableName' data \n#\n";
	zbDB_getDataList($tableName);
	echo "\n# End of $tableName Dump\n";
	flush();
}

function zbDB_All_down($dbname) {
	global $connect;
	$result = mysqli_query($connect,"show table status from $dbname like 'zetyx%'") or die(mysqli_error($connect));
	$i=0;
	while($dbData=mysqli_fetch_array($result)) {
		$tableName = $dbData[Name];
		echo "\n\n";
		zbDB_down($tableName);
	}
}

function zbDB_Header($filename) {
	global $HTTP_USER_AGENT;
	if(preg_match("/msie/i",$HTTP_USER_AGENT)) $browser="1"; else $browser="0";
	header("Content-Type: application/octet-stream");
	if ($browser) {
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Expires: 0");
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
	} else {
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Expires: 0");
		header("Pragma: public");
	}
}

function all_Backup($host,$user,$password,$dbname,$filename) {
	$db = mysqli_connect($host,$user,$password) or die(mysqli_error($connect));
	$connect = mysqli_select_db($db,$dbname) or die(mysqli_error($connect));

	session_start();
	$_SESSION['HOST']=$host;
	$_SESSION['DB']=$dbname;
	$_SESSION['ID']=$user;
	$_SESSION['PW']=$password;

	$myhost=$_SESSION['HOST'];
	$mydb=$_SESSION['DB'];
	$myid=$_SESSION['ID'];
	$mypw=$_SESSION['PW'];

	$connect=mysqli_connect($myhost,$myid,$mypw) or die("sql erroe");
	mysqli_select_db($connect,$mydb);

	$pResult=mysqli_query($connect,"show variables");

	while($rowArray=mysqli_fetch_row($pResult))
	{
		if($rowArray[0]=="basedir")
			// 카페24 mariaDB에선 bindir 경로변수 없이 mysqldump 실행가능
			$bindir=$rowArray[1]."/bin/";
	}
	passthru("mysqldump --user=$myid --password=$mypw $dbname --default-character-set=utf8mb4 > ../$filename");
}
?>
