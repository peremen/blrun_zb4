<?php
/* 
// +----------------------------------------------------------------------+
// +----------------------------------------------------------------------+
// | Authors: Aokio <st.elmo@gmail.com>                                 |
// +----------------------------------------------------------------------+
//
//

/**
 * Utility class that analyze os information from useragent strings.
 *
 * @package  Aokio_Analyzer_OS
 * @category Networking
 * @author   Aokio <st.elmo@gmail.com>   
 * @access   public
 * @version  $Revision: 0.1 $
 */

//ini_set("include_path",dirname(realpath(__FILE__)).DIRECTORY_SEPARATOR.'lib');
//require_once 'Mobile.php';
class Aokio_Analyzer_OS{
	var $os_category;			// 큰분류, 종류
	var $os_full_name;			//풀네임  아마 오에스 이름+ 버젼이 되겠지머...
	var $os_name;				//os 이름
	var $os_version;			//버젼
	//TODO --> 각각 구별해서 표시?
	var $os_sp_info;
	var $os_net_frame_info;

	var $os_net_frame_version_info = false;

	var $processor_info;
	var $tablet_info;
	var $tablet_version_info;

	var $useragent;

	//constructor
	function Aokio_Analyzer_OS($useragent = null){
		if($useragent === null){
			if (isset($_SERVER['HTTP_USER_AGENT'])) {
				$this->useragent = $_SERVER['HTTP_USER_AGENT'];
			}elseif (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_USER_AGENT'])) {
				$this->useragent = $GLOBALS['HTTP_SERVER_VARS']['HTTP_USER_AGENT'];
			}
		}else{
			$this->useragent = $useragent;
		}
		$this->useragent =  strtolower($this->useragent);
		$this->_setOSInfo();
	}

	function _setOSInfo(){
			$this->_setOSCategory();
	}


	function _setOSCategory(){
		$os_category = "";
		$agent = $this->useragent;
		// windows
		// mac
		// unix
		// os/2
		// 기타 계속 추가.

		if(ereg('win',$agent) || ereg('window',$agent)){
			$os_category = "Microsoft Windows";
			$this->_setOSWindowsVersion();
			$this->_setOSWindowsExtendedInfo();

		}elseif(ereg('os/2',$agent) || ereg('ibm-webexplorer',$agent)){
			$os_category = "OS/2";
		}elseif(ereg('mac',$agent)){
			$os_category = "Mac";
			$this->_setOSMacVersion();
		}elseif(	ereg('sunos',$agent) || 
//					ereg('linux',$agent) || 
					ereg('openbsd',$agent) || 
					ereg('freebsd',$agent) || 
					ereg('aix',$agent) ||
					ereg('hp-ux',$agent) ||
					ereg('netbsd',$agent) ||
					ereg('irix',$agent) ){
			$os_category = "Unix";
			$this->_setOSUnixInfo();

		}elseif(ereg('linux',$agent)){
			$os_category = "Linux";
			$this->_setOSLinuxInfo();
		}else{
			$os_category = "Unknown OS";
		}
		$this->os_category = $os_category;
		$this->os_name = $os_category;

		$this->os_full_name = $os_category." ".$this->os_version;
		unset($os_category);
		unset($agent);
	}

	function _setOSWindowsVersion(){
		$agent = $this->useragent;
		
		if(ereg( 'windows 3.1',$agent) || ereg( 'win16',$agent) || ereg('windows 16-bit',$agent)){
			//(including Windows NT 3.x)
			$os_version = "3.1";
		}elseif(ereg('win3.11',$agent)){
			$os_version = "3.11";
		}elseif(ereg( 'win32',$agent) ||ereg( 'win95',$agent) || ereg( 'windows 95',$agent)){
			$os_version = "95";
		}elseif(ereg( 'win98',$agent) || ereg('windows 98',$agent)){
			$os_version = "98";
		}elseif(ereg('win 9x 4.90',$agent)){
			$os_version = "ME";
		}elseif(ereg( 'winnt3.51',$agent) ){
			$os_version = "NT 3.51";
		}elseif(ereg( 'windows nt 4.0',$agent) ||ereg( 'winnt4.0',$agent) ){
			$os_version = "NT 4.0";
		}elseif(ereg('windows nt 5.0',$agent)){
			//Windows NT 5.01: Windows 2000, Service Pack 1 (SP1)
			$os_version = "2000";
		}elseif(ereg('windows nt 5.1',$agent) || ereg('windows xp',$agent)){
			if(ereg('media center pc 2.8',$agent)){
				$os_version = "XP Media Center Edition 2004";
			}elseif(ereg('media center pc 3.0',$agent)){
				$os_version = "XP Media Center Edition 2005";
			}elseif(ereg('media center pc 3.1',$agent)){
				$os_version = "XP Media Center Edition 2005 with update rollup 1";
			}elseif(ereg('media center pc 4.0',$agent)){
				$os_version = "XP Media Center Edition 2005 with update rollup 2";
			}else{
				$os_version = "XP";
			}
		}elseif(ereg('windows nt 5.2',$agent)){
			// TODO mozilla 계열에서는 Windows XP Professional x64 Edition도 같은 값이라는데? 어케 판단할려?
			$os_version = "Server 2003";
		}elseif(ereg('windows nt 6.0',$agent)){
			$os_version = "Vista";
		}elseif(ereg('windows ce 4.21',$agent)){
			$os_version = "Mobile 2003";
		}elseif(ereg('windows ce',$agent)){
			//Windows CE and Windows Mobile
			$os_version = "CE";
		}elseif(ereg('winnt',$agent)){
			$os_version = "NT 3.X";		// This only applies to earlier versions of Netscape. 
		}elseif(ereg('windows nt 6.1',$agent)){
			$os_version = "7";
		}elseif(ereg('windows nt 6.2',$agent)){
			$os_version = "8";
		}elseif(ereg('windows nt 6.3',$agent)){
			$os_version = "8.1";
		}else{
			$os_version = "Ver.?";

		}
		$this->os_version = $os_version;
	}


	function _setOSWindowsExtendedInfo(){
		$agent = $this->useragent;
		$os_sp_info = "";
		if(ereg('sv1',$agent) && ( ereg('XP' ,$this->os_version) || $this->os_version =="Server 2003")){
			$os_sp_info = "ServicePack2 ";
		}
		$this->os_sp_info =$os_sp_info;
	
		$os_net_frame_info ="";
		$this->os_net_frame_version_info = array();
		if(ereg('net clr',$agent)){
			$os_net_frame_info = " with .NET Framework common language runtime installed";
			if(ereg('1.0.3705',$agent)){
				array_push($this->os_net_frame_version_info,"1.0");
			}
			if(ereg('1.1.4322',$agent)){
				array_push($this->os_net_frame_version_info,"1.1");
			}
			if(ereg('2.0.40607',$agent) || ereg('2.0.50215',$agent) || ereg('2.0.50727',$agent)){
				array_push($this->os_net_frame_version_info,"2.0");
			}
		}
		$this->os_net_frame_info =$os_net_frame_info;
		
		if(ereg('tablet pc',$agent)){
			$this->tablet_info = "Tablet services are installed";
			//TODO version info
		}

		if(ereg('win64; ia64',$agent)){
			$this->processor_info = "System has a 64-bit processor (Intel)";
		}

		if(ereg('win64; x64',$agent)){
			$this->processor_info = "System has a 64-bit processor (AMD)";
		}

		if(ereg('wow64',$agent)){
			$this->processor_info = "A 32-bit version of Internet Explorer is running on a 64-bit processor.";
		}
		
	}



	function _setOSMacVersion(){
		$agent = $this->useragent;
		$os_version = "";
		if(ereg('powerpc',$agent) && !ereg('os x',$agent) ){
				$os_version = "PowerPC";
			}elseif(ereg('os x',$agent)){
				$os_version = "OS X";
			}
		$this->os_version = $os_version;
	}


	function _setOSUnixInfo(){
		$agent = $this->useragent;

		if(ereg('sunos',$agent)){
			$os_name = "SunOS";

		}elseif(ereg('openbsd',$agent)){
			$os_name = "OpenBSD";

		}elseif(ereg('freebsd',$agent)){
			$os_name = "FreeBSD";

		}elseif(ereg( 'aix',$agent) ){
			$os_name = "AIX";

		}elseif(ereg( 'hp-ux',$agent)){
			$os_name = "HP-UX";

		}elseif(ereg('netbsd',$agent)){
			$os_name = "NetBSD";

		}elseif(ereg('irix',$agent)){
			$os_name = "IRIX";

		}
//		$this->os_version = $os_version;
	}


	function _setOSLinuxInfo(){
		$agent = $this->useragent;

		if(ereg('vine',$agent)){
			$os_name = "VineLinux";

		}elseif(ereg('debian',$agent)){
			$os_name = "Debian";

		}elseif(ereg('fedora',$agent)){
			$os_name = "Fedora";

		}elseif(ereg( 'red hat',$agent) ){
			$os_name = "Red Hat";

		}elseif(ereg( 'centos',$agent)){
			$os_name = "CentOS";

		}elseif(ereg('ubuntu ',$agent)){
			$os_name = "Ubuntu ";

		}elseif(ereg('android',$agent)){
			//Android Mobile
			$os_name = "Android";
		}
	}

	function isWindows(){
		if($this->os_category ==="Microsoft Windows"){
			return true;
		}
		return false;
	}


	function isMac(){
		if($this->os_category ==="Mac"){
			return true;
		}
		return false;
	}

}
?>