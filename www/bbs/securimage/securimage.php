<?php

/**
 * 프로젝트:    Securimage: 양식 CAPTCHA 이미지를 만들고 관리하기위한 PHP 클래스
 * 파일:        securimage.php
 *
 * 이 라이브러리는 무료 소프트웨어입니다. 당신은 그것을 재배포할 수 있습니다.
 * GNU 약소 일반 범용의 조건에 따라 수정하십시오.
 * 자유 소프트웨어 재단이 발행 한 라이센스. 어느 한 쪽
 * 라이센스 버전 2.1 또는 이후 버전.
 *
 * 이 라이브러리는 유용할 것이라는 희망으로 배포되었습니다.
 * 하지만 어떠한 보증도하지 않습니다. 묵시적 보증없이
 * 상품성 또는 특정 목적에의 적합성. GNU보기
 * 더 자세한 내용은 Lesser General Public License를 참조하십시오.
 *
 * GNU 약소 일반 범용의 사본을 받아야합니다.
 * 이 라이브러리와 함께 라이센스; 그렇지 않다면 자유 소프트웨어에 글을 씁니다.
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * 라이브러리에 대한 수정 사항은 소스 코드에 명확하게 표시되어야합니다.
 * 변경 사항이 원래 소프트웨어의 일부가 아니라는 사실을 사용자에게 알립니다.
 *
 * 이 스크립트가 유용하다고 판단되면 잠시 시간을내어 평가하십시오.
 * http://www.hotscripts.com/rate/49400.html 감사합니다.
 *
 * @link http://www.phpcaptcha.org Securimage PHP CAPTCHA
 * @link http://www.phpcaptcha.org/latest.zip 최신 버전 다운로드
 * @link http://www.phpcaptcha.org/Securimage_Docs/ 온라인 문서
 * @저작권 2009 Drew Phillips
 * @저자 Drew 필립스 <drew@drew-phillips.com>
 * @version 2.0.1 베타 (2009 년 12 월 6 일)
 * @Securimage 패키지
 *
*/

/**
 변경 로그

 2.0.2
 라이브러리로 쉽게 통합할 수 있도록 경로 지정을 수정했습니다 (Nathan Phillip Brink ohnobinki@ohnopublishing.net).

 2.0.1
 - 쿠키가 비활성화 된 브라우저에 대한 지원 추가 (php5, sqlite 필요)는 사용자를 md5 해시 IP 주소 및 md5 해시 코드로 매핑하여 보안을 강화합니다.
 - ttf 지원이 사용 가능하지 않거나 글꼴 파일을 찾을 수 없는 경우 gd 글꼴에 폴백을 추가합니다 (Mike Challis http://www.642weather.com/weather/scripts.php).
 - 이미지 타입 상수의 이전 정의 확인 (Mike Challis)
 - 오디오 출력에 대한 MIME 타입 설정 수정
 - 여러 색상 및 배경 이미지를 가진 색상 할당 문제가 수정되고 할당을 하나의 기능으로 통합
 - 주어진 시간이 지나면 코드가 만료되도록하는 기능
 - HTML 색상 코드가 Securimage_Color에 전달되도록 허용합니다 (Mike Challis가 제안).

 2.0.0
 - 문자에 수학적 왜곡 추가 (HKCaptcha의 코드 사용)
 - 개선 된 세션 지원
 - 쉬운 색상 정의를위한 Securimage_Color 클래스 추가
 - 바이너리 비교 공격을 막기 위해 오디오 출력에 왜곡 추가 (Sven "SavageTiger"Hagemann [insecurity.nl]이 제안)
 - mp3 오디오를 스트리밍하는 플래시 버튼 (더글라스 월시 www.douglaswalsh.net)
 - 오디오 출력은 기본적으로 mp3 형식입니다.
 - yann le coroller에 의해 AlteHaasGrotesk로 글꼴 변경
 - 일부 코드 정리

 1.0.4 (출시되지 않음)
 - 플래시에서 스트림으로 mp3 형식의 가청 코드를 출력하는 기능

 1.0.3.1
 - 어떤 경우 단어 목록에서 읽는 중 오류가 발생하여 단어가 한 글자 짧아짐

 1.0.3
 - 이전 버전에서 제거하여 정의되지 않은 속성 오류가 발생할 수 있는 코드에서 shadow_text를 제거했습니다.

 1.0.2
 - Audible CAPTCHA 코드 wav 파일
 - 임의의 문자열 대신 단어 목록에서 코드 생성

 1.0
 - a0-z0-9가 아닌 선택한 문자 세트를 사용할 수 있는 기능이 추가되었습니다.
 - 각 문자에 다른 색상을 사용하는 다중 색상 텍스트 옵션을 추가했습니다.
 - 코드 저장을 위해 파일을 사용하는 대신 자동 세션 처리로 전환
 - ttf 지원을 사용할 수 없는 경우 GD 글꼴 지원이 추가되었습니다. 내부 GD 글꼴을 사용하거나 새로운 글꼴을 로드할 수 있습니다.
 - 선 두께 설정 기능 추가
 - 문자 위에 원호 선 그리기 옵션 추가
 - 출력을 위해 이미지 타입을 선택할 수있는 기능 추가

*/

/**
 * JPEG 형식의 이미지 출력
*/
if (!defined('SI_IMAGE_JPEG'))
	define('SI_IMAGE_JPEG', 1);
/**
 * PNG 형식의 이미지 출력
*/
if (!defined('SI_IMAGE_PNG'))
	define('SI_IMAGE_PNG',  2);
/**
 * 이미지를 GIF 형식으로 출력합니다 (권장하지 않음).
 * GD >= 2.0.28 이어야합니다!
*/
if (!defined('SI_IMAGE_GIF'))
	define('SI_IMAGE_GIF',  3);

/**
 * Securimage CAPTCHA 클래스.
 *
 * @Securimage 패키지
 * @subpackage 클래스들
 *
*/
class Securimage {

    /**
     * securimage.php가 포함된 경로입니다.
     *
     * @var string    securimage 설치 경로.
	*/
	var $basepath;

    /**
     * 원하는 CAPTCHA 이미지의 너비입니다.
     *
     * @var int
	*/
	var $image_width;

    /**
     * 원하는 CAPTCHA 이미지의 높이입니다.
     *
     * @var int
	*/
	var $image_height;

    /**
     * 출력용의 이미지 형식.
     * 유효한 옵션: SI_IMAGE_PNG, SI_IMAGE_JPG, SI_IMAGE_GIF
     *
     * @var int
	*/
	var $image_type;

    /**
     * 생성할 code의 길이.
     *
     * @var int
	*/
	var $code_length;

    /**
     * 이미지의 개별 문자에 대한 문자 집합입니다.
     * 문자는 대문자로 변환됩니다.
     * 글꼴이 문자를 지원해야하거나 문제가있는 대체 문자가 있을 수 있습니다.
     *
     * @var string
	*/
	var $charset;

    /**
     * 이 단어 목록을 사용하여 code를 만듭니다.
     *
     * @var string  CAPCHA 코드를 만드는 데 사용할 단어 목록의 경로
	*/
	var $wordlist_file;

    /**
     * 단어 목록 사용 안함
     *
     * @var bool 단어 목록 파일을 사용하려면 true로, 임의 코드를 사용하려면 false 로 설정.
	*/
	var $use_wordlist = false;

    /**
     * 참고 : 많은 왜곡 기능을 사용할 수 없으므로 GD 글꼴을 사용하지 않는 것이 좋습니다.
     * 사용할 GD 글꼴.
     * 내부 gd 글꼴은 번호로 로드할 수 있습니다.
     * 또는 파일 경로를 지정하고 글꼴을 파일에서로드 할 수 있습니다.
     *
     * @var mixed
	*/
	var $gd_font_file;

    /**
     * 글꼴의 대략적인 크기(픽셀)입니다.
     * 글꼴 크기는 GD 글꼴 자체에 의해 결정되므로 글꼴 크기를 제어하지 않습니다.
     * 이것은,이 클래스가 사용하는 위치 결정의 계산을 돕기 위해서 사용됩니다.
     *
     * @var int
	*/
	var $gd_font_size;

    /**
     * TTF 대신 gd 글꼴 사용
     *
     * @var bool gd 폰트의 경우 true, TTF의 경우 false
	*/
	var $use_gd_font;

	// 참고: $text_color를 제외하고 $use_gd_font를 true로 설정하면 아래의 글꼴 옵션이 적용되지 않습니다.

    /**
     * 로드할 TTF 글꼴 파일의 경로입니다.
     *
     * @var string
	*/
	var $ttf_file;

    /**
     * 얼마만큼의 이미지 왜곡을 할 것인지, 높은 수치 = 더 많은 왜곡.
     * 왜곡은 TTF 글꼴을 사용할 때만 사용할 수 있습니다.
     *
     * @var float
	*/
	var $perturbation;

    /**
     * 각도는 0부터 시작하여 왼쪽에서 오른쪽으로 읽는 텍스트의 최소 각도입니다.
     * 높은 값은 반 시계 방향 회전을 나타냅니다.
     * 예를 들어, 90의 값은 맨 아래에서 맨 위로 읽는 텍스트가 됩니다.
     * 최대 각도 거리와 함께 이 값은 섭동으로 매우 높을 필요는 없습니다.
     *
     * @var int
	*/
	var $text_angle_minimum;

    /**
     * 각도는 0부터 시작하여 왼쪽에서 오른쪽으로 읽는 텍스트의 최대 각도입니다.
     * 높은 값은 반 시계 방향 회전을 나타냅니다.
     * 예를 들어, 90의 값은 맨 아래에서 맨 위로 읽는 텍스트가 됩니다.
     *
     * @var int
	*/
	var $text_angle_maximum;

    /**
     * 문자 그리기가 시작될 이미지의 X 위치.
     * 이 값은 이미지의 왼쪽부터 픽셀 단위입니다.
     *
     * @var int
     * @2.0 사용 안함
	*/
	var $text_x_start;

    /**
     * Securimage_Color로 이미지의 배경색.
     *
     * @var Securimage_Color
	*/
	var $image_bg_color;

    /**
     * gif, jpg 및 png 파일이 백그라운드 이미지로 사용되도록 이 디렉토리를 스캔합니다.
     * 무작위 이미지 파일이 매번 선택됩니다.
     * null에서 디렉토리의 전체 경로로 변경한다.
     * 즉 var $background_directory = $_SERVER['DOCUMENT_ROOT'].'/securimage/backgrounds'; 입니다.
     * show 함수에 배경 이미지를 전달하지 않도록 한다. 그렇지 않으면 이 지시문이 무시됩니다.
     *
     * @var string
	*/
	var $background_directory = null; //'./backgrounds';

    /**
     * 문자를 Securimage_Color로 그리는 데 사용할 텍스트 색상입니다.
     * $use_multi_text가 true로 설정되면이 값은 무시됩니다.
     * 배경색이나 이미지와 잘 대조되는지 확인한다.
     *
     * @Securimage::$use_multi_text 를 봅니다
     * @var Securimage_Color
	*/
	var $text_color;

    /**
     * 각 문자에 여러 색상을 사용하려면 true로 설정하십시오.
     *
     * @Securimage::$multi_text_color 를 봅니다
     * @var boolean
	*/
	var $use_multi_text;

    /**
     * 각 문자에 대해 임의로 선택되는 Securimage_Colors의 배열입니다.
     *
     * @var array
	*/
	var $multi_text_color;

    /**
     * 문자를 투명하게 보이게 하려면 true로 설정하십시오.
     *
     * @Securimage::$text_transparency_percentage 를 봅니다
     * @var boolean
	*/
	var $use_transparent_text;

    /**
     * 투명도 백분율 (0 ~ 100)입니다.
     * 값 0은 완전히 불투명, 100은 완전히 투명 (보이지 않음)
     *
     * @Securimage::$use_transparent_text 를 봅니다
     * @var int
	*/
	var $text_transparency_percentage;


	// 라인 옵션
    /**
    * 이미지에 수직선과 수평선을 그립니다.
    *
    * @Securimage::$line_color 를 봅니다
    * @Securimage::$draw_lines_over_text 를 봅니다
    * @var boolean
	*/
	var $num_lines;

    /**
     * 텍스트 위에 그린 선의 색상
     *
     * @var string
	*/
	var $line_color;

    /**
     * 텍스트 위에 선을 그립니다.
     * 이미지에 텍스트를 넣기 전에 fales 라인이 그려지는 경우.
     *
     * @var boolean
	*/
	var $draw_lines_over_text;

    /**
     * 보안 문자 이미지의 하단 모서리에 쓸 텍스트
     *
     * @2.0 부터
     * @var string 서명 텍스트
	*/
	var $image_signature;

    /**
     * 서명 텍스트를 쓰는 데 사용할 색상
     *
     * @2.0 부터
     * @var Securimage_Color
	*/
	var $signature_color;

    /**
     * 오디오 파일을 만드는 데 사용할 WAV 파일의 전체 경로이며 뒤쪽에 /를 포함합니다.
     * 이름 파일 [A-Z0-9].wav
     *
     * @1.0.1 부터
     * @var string
	*/
	var $audio_path;

    /**
     * 생성 할 오디오 파일 유형 (mp3 또는 wav)
     *
     * @var string
	*/
	var $audio_format;

    /**
     * 기본값이 아닌 경우 사용할 세션 이름입니다. 빈칸 없음
     *
     * @http://php.net/session_name 를 봅니다
     * @2.0 부터
     * @var string
	*/
	var $session_name = '';

    /**
     * 코드가 유효하게 유지되는 시간(초).
     * 이 숫자보다 오래된 코드는 올바르게 입력해도 유효하지 않은 것으로 간주됩니다.
     * 숫자가 아닌 값 또는 1보다 작은 값은 이 기능을 사용하지 않습니다.
     *
     * @var int
	*/
	var $expiry_time;

    /**
     * 사용자 코드를 저장하는 데 사용할 파일의 경로입니다.
     * [이 파일은 절대적으로 웹브라우저에서 접근할 수 없어야 합니다!!]
     * 이 파일을 웹 루트 아래의 디렉토리 또는 제한된 디렉토리에 두십시오 (예: deny from all 속성을 가진 아파치 .htaccess 파일).
     * 이러한 요구 사항을 충족시키지 못하면 양식이 완전히 보호되지 않을 수 있습니다.
     * 데이터베이스 파일 이름을 모호하게 만들수도 있지만 권장하지는 않습니다.
     *
     * @var string
	*/
	var $sqlite_database;

    /**
     * 코드를 세션의 백업으로 저장하기 위해 SQLite 데이터베이스를 사용합니다.
     * 참고: 세션은 계속 사용됩니다.
	*/
	var $use_sqlite_db;


	//[최종 사용자 설정]
	//무엇을 할지 모르겠다면 아래를 편집 할 필요가 없습니다.

    /**
     * gd 이미지 리소스.
     *
     * @private 으로 접근
     * @var resource
	*/
	var $im;

    /**
     * 렌더링을 위한 임시 이미지
     *
     * @private 으로 접근
     * @var resource
	*/
	var $tmpimg;

    /**
     * 안티 앨리어스 @hkcaptcha의 내부 배율 인수
     *
     * @private 으로 접근
     * @2.0 부터
     * @var int
	*/
	var $iscale; // 안티 앨리어스 @hkcaptcha의 내부 배율 인수

    /**
     * 배경 이미지 리소스
     *
     * @2.0 부터
     * @var resource
	*/
	var $bgimg;

    /**
     * 스크립트에 의해 생성된 코드
     *
     * @private 으로 접근
     * @var string
	*/
	var $code;

    /**
     * 사용자가 입력한 코드
     *
     * @private 으로 접근
     * @var string
	*/
	var $code_entered;

    /**
     * 올바른 코드 입력 여부
     *
     * @private 으로 접근
     * @var boolean
	*/
	var $correct_code;

    /**
     * SQLite 데이터베이스 핸들
     *
     * @private 으로 접근
     * @var resource
	*/
	var $sqlite_handle;

    /**
     * 이미지 선 색상을 위한 색상 리소스
     *
     * @private 으로 접근
     * @var int
	*/
	var $gdlinecolor;

    /**
     * 멀티 컬러 코드 용 색상 배열
     *
     * @private 으로 접근
     * @var array
	*/
	var $gdmulticolor;

    /**
     * 이미지 글꼴 색상을 위한 색상 리소스
     *
     * @private 으로 접근
     * @var int
	*/
	var $gdtextcolor;

    /**
     * 이미지 서명 컬러의 색상 리소스
     *
     * @private 으로 접근
     * @var int
	*/
	var $gdsignaturecolor;

    /**
     * 이미지 배경색을 위한 색상 리소스
     *
     * @private 으로 접근
     * @var int
	*/
	var $gdbgcolor;


    /**
     * 클래스 생성자.
     * 클래스는 세션을 사용하기 때문에 이전 세션이 없으면 세션 시작을 시도합니다.
     * 클래스를 호출하기 전에 세션을 시작하지 않으면 모든 출력이 브라우저로 보내지기
     * 전에 생성자를 호출해야합니다.
     * <code>
     *   $securimage = new Securimage();
     * </code>
     *
	*/
	function Securimage()
	{
		// 세션 초기화 또는 기존 연결
		if ( session_id() == '' ) {
			// 유효성 검사를 위해 필요한 세션이 아직 시작되지 않았습니다.
			if (trim($this->session_name) != '') {
				session_name($this->session_name); // 세션 이름이 있으면 설정합니다.
			}
			session_start();
		}

		// 계산된 값
		$this->basepath = dirname(__FILE__);

		// 기본값 설정
		$this->image_width   = 230;
		$this->image_height  = 80;
		$this->image_type    = SI_IMAGE_PNG;

		$this->code_length   = 6;
		$this->charset       = 'ABCDEFGHKLMNPRSTUVWYZabcdefghklmnprstuvwyz23456789';
		$this->wordlist_file = $this->basepath . '/words/words.txt';
		$this->use_wordlist  = false;

		$this->gd_font_file  = 'gdfonts/automatic.gdf';
		$this->use_gd_font   = false;
		$this->gd_font_size  = 24;
		$this->text_x_start  = 15;

		$this->ttf_file      = $this->basepath . '/AHGBold.ttf';

		$this->perturbation       = 0.75;
		$this->iscale             = 5;
		$this->text_angle_minimum = 0;
		$this->text_angle_maximum = 0;

		$this->image_bg_color   = new Securimage_Color(0xff, 0xff, 0xff);
		$this->text_color       = new Securimage_Color(0x3d, 0x3d, 0x3d);
		$this->multi_text_color = array(new Securimage_Color(0x0, 0x20, 0xCC),
		new Securimage_Color(0x0, 0x30, 0xEE),
		new Securimage_color(0x0, 0x40, 0xCC),
		new Securimage_Color(0x0, 0x50, 0xEE),
		new Securimage_Color(0x0, 0x60, 0xCC));
		$this->use_multi_text   = false;

		$this->use_transparent_text         = false;
		$this->text_transparency_percentage = 30;

		$this->num_lines            = 10;
		$this->line_color           = new Securimage_Color(0x3d, 0x3d, 0x3d);
		$this->draw_lines_over_text = true;

		$this->image_signature = '';
		$this->signature_color = new Securimage_Color(0x20, 0x50, 0xCC);
		$this->signature_font  = $this->basepath . '/AHGBold.ttf';

		$this->audio_path   = $this->basepath . '/audio/';
		$this->audio_format = 'mp3';
		$this->session_name = '';
		$this->expiry_time  = 900;

		$this->sqlite_database = 'database/securimage.sqlite';
		$this->use_sqlite_db   = false;

		$this->sqlite_handle = false;
	}

    /**
     * 코드를 생성하고 이미지를 브라우저에 출력합니다.
     *
     * <code>
     *   include 'securimage.php';
     *   $securimage = new Securimage();
     *   $securimage->show('bg.jpg');
     * </code>
     *
     * @파라미터 $background_image는 문자열, CAPTCHA의 배경으로 사용할 이미지의 경로
	*/
	function show($background_image = "")
	{
		if($background_image != "" && is_readable($background_image)) {
			$this->bgimg = $background_image;
		}

		$this->doImage();
	}

    /**
     * 사용자가 입력한 코드의 유효성을 검사합니다.
     *
     * <code>
     *   $code = $_POST['code'];
     *   if ($securimage->check($code) == false) {
     *     die("Sorry, the code entered did not match.");
     *   } else {
     *     $valid = true;
     *   }
     * </code>
     * @파라미터 $code는 문자열, 사용자가 입력 한 코드
     * @boolean 반환, 코드가 정확하면 true, 그렇지 않으면 false
	*/
	function check($code)
	{
		$this->code_entered = $code;
		$this->validate();
		return $this->correct_code;
	}

    /**
     * 브라우저에 HTTP 헤더가있는 오디오 파일 출력
     *
     * <code>
     *   $sound = new Securimage();
     *   $sound->audio_format = 'mp3';
     *   $sound->outputAudioFile();
     * </code>
     *
     * @2.0 부터
	*/
	function outputAudioFile()
	{
		if (strtolower($this->audio_format) == 'wav') {
			header('Content-type: audio/x-wav');
			$ext = 'wav';
		}
		else {
			header('Content-type: audio/mpeg'); // mp3로 기본 설정
			$ext = 'mp3';
		}

		header("Content-Disposition: attachment; filename=\"securimage_audio.{$ext}\"");
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Expires: Sun, 1 Jan 2000 12:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');

		$audio = $this->getAudibleCode($ext);

		header('Content-Length: ' . strlen($audio));

		echo $audio;
		exit;
	}

    /**
     * 이미지 생성 및 출력
     *
     * @private 으로 접근
     *
	*/
	function doImage()
	{
		if ($this->use_gd_font == true) {
			$this->iscale = 1;
		}
		if($this->use_transparent_text == true || $this->bgimg != "") {
			$this->im     = imagecreatetruecolor($this->image_width, $this->image_height);
			$this->tmpimg = imagecreatetruecolor($this->image_width * $this->iscale, $this->image_height * $this->iscale);

		}
		else {
			//투명성 없음
			$this->im     = imagecreate($this->image_width, $this->image_height);
			$this->tmpimg = imagecreate($this->image_width * $this->iscale, $this->image_height * $this->iscale);
		}

		$this->allocateColors();
		imagepalettecopy($this->tmpimg, $this->im);

		$this->setBackground();

		$this->createCode();

		if (!$this->draw_lines_over_text && $this->num_lines > 0) $this->drawLines();

		$this->drawWord();
		if ($this->use_gd_font == false && is_readable($this->ttf_file)) $this->distortedCopy();

		if ($this->draw_lines_over_text && $this->num_lines > 0) $this->drawLines();

		if (trim($this->image_signature) != '')    $this->addSignature();

		$this->output();

	}

    /**
     * CAPTCHA 이미지에 사용될 모든 색상 할당
     *
     * @2.0.1 부터
     * @private 으로 접근
	*/
	function allocateColors()
	{
		// 이미지 생성을 위해 먼저 배경 색상 할당
		$this->gdbgcolor = imagecolorallocate($this->im, $this->image_bg_color->r, $this->image_bg_color->g, $this->image_bg_color->b);

		$alpha = intval($this->text_transparency_percentage / 100 * 127);

		if ($this->use_transparent_text == true) {
			$this->gdtextcolor = imagecolorallocatealpha($this->im, $this->text_color->r, $this->text_color->g, $this->text_color->b, $alpha);
			$this->gdlinecolor = imagecolorallocatealpha($this->im, $this->line_color->r, $this->line_color->g, $this->line_color->b, $alpha);
		}
		else {
			$this->gdtextcolor = imagecolorallocate($this->im, $this->text_color->r, $this->text_color->g, $this->text_color->b);
			$this->gdlinecolor = imagecolorallocate($this->im, $this->line_color->r, $this->line_color->g, $this->line_color->b);
		}

		$this->gdsignaturecolor = imagecolorallocate($this->im, $this->signature_color->r, $this->signature_color->g, $this->signature_color->b);

		if ($this->use_multi_text == true) {
			$this->gdmulticolor = array();

			foreach($this->multi_text_color as $color) {
				if ($this->use_transparent_text == true) {
					$this->gdmulticolor[] = imagecolorallocatealpha($this->im, $color->r, $color->g, $color->b, $alpha);
				}
				else {
					$this->gdmulticolor[] = imagecolorallocate($this->im, $color->r, $color->g, $color->b);
				}
			}
		}
	}

    /**
     * CAPCHA 이미지의 배경 설정
     *
     * @private 으로 접근
     *
	*/
	function setBackground()
	{
		imagefilledrectangle($this->im, 0, 0, $this->image_width * $this->iscale, $this->image_height * $this->iscale, $this->gdbgcolor);
		imagefilledrectangle($this->tmpimg, 0, 0, $this->image_width * $this->iscale, $this->image_height * $this->iscale, $this->gdbgcolor);

		if ($this->bgimg == '') {
			if ($this->background_directory != null && is_dir($this->background_directory) && is_readable($this->background_directory)) {
				$img = $this->getBackgroundFromDirectory();
				if ($img != false) {
					$this->bgimg = $img;
				}
			}
		}

		$dat = @getimagesize($this->bgimg);
		if($dat == false) {
			return;
		}

		switch($dat[2]) {
			case 1:  $newim = @imagecreatefromgif($this->bgimg);
			break;
			case 2:  $newim = @imagecreatefromjpeg($this->bgimg);
			break;
			case 3:  $newim = @imagecreatefrompng($this->bgimg);
			break;
			case 15: $newim = @imagecreatefromwbmp($this->bgimg);
			break;
			case 16: $newim = @imagecreatefromxbm($this->bgimg);
			break;
			default: return;
		}

		if(!$newim) return;

		imagecopyresized($this->im, $newim, 0, 0, 0, 0, $this->image_width, $this->image_height, imagesx($newim), imagesy($newim));
	}

    /**
     * $background_directory 에서 임의의 gif, jpg 또는 png의 전체 경로를 반환합니다.
     *
     * @private 으로 접근
     * @Securimage::$background_directory 를 봅니다
     * @아무것도 찾지 못하면 false를 반환하고, 발견되면 string $path를 복합적으로 반환
	*/
	function getBackgroundFromDirectory()
	{
		$images = array();

		if ($dh = opendir($this->background_directory)) {
			while (($file = readdir($dh)) !== false) {
				if (preg_match('/(jpg|gif|png)$/i', $file)) $images[] = $file;
			}

			closedir($dh);

			if (sizeof($images) > 0) {
				return rtrim($this->background_directory, '/') . '/' . $images[rand(0, sizeof($images)-1)];
			}
		}

		return false;
	}

    /**
     * 이미지 위에 임의의 curvy 선을 그립니다.
     * HKCaptcha의 수정된 코드
     *
     * @2.0 부터
     * @private 으로 접근
     *
	*/
	function drawLines()
	{
		for ($line = 0; $line < $this->num_lines; ++$line) {
			$x = $this->image_width * (1 + $line) / ($this->num_lines + 1);
			$x += (0.5 - $this->frand()) * $this->image_width / $this->num_lines;
			$y = rand($this->image_height * 0.1, $this->image_height * 0.9);

			$theta = ($this->frand()-0.5) * M_PI * 0.7;
			$w = $this->image_width;
			$len = rand($w * 0.4, $w * 0.7);
			$lwid = rand(0, 2);

			$k = $this->frand() * 0.6 + 0.2;
			$k = $k * $k * 0.5;
			$phi = $this->frand() * 6.28;
			$step = 0.5;
			$dx = $step * cos($theta);
			$dy = $step * sin($theta);
			$n = $len / $step;
			$amp = 1.5 * $this->frand() / ($k + 5.0 / $len);
			$x0 = $x - 0.5 * $len * cos($theta);
			$y0 = $y - 0.5 * $len * sin($theta);

			$ldx = round(-$dy * $lwid);
			$ldy = round($dx * $lwid);

			for ($i = 0; $i < $n; ++$i) {
				$x = $x0 + $i * $dx + $amp * $dy * sin($k * $i * $step + $phi);
				$y = $y0 + $i * $dy - $amp * $dx * sin($k * $i * $step + $phi);
				imagefilledrectangle($this->im, $x, $y, $x + $lwid, $y + $lwid, $this->gdlinecolor);
			}
		}
	}

    /**
     * 이미지 위에 CAPCHA 코드를 그립니다.
     *
     * @private 으로 접근
     *
	*/
	function drawWord()
	{
		$width2 = $this->image_width * $this->iscale;
		$height2 = $this->image_height * $this->iscale;

		if ($this->use_gd_font == true || !is_readable($this->ttf_file)) {
			if (!is_int($this->gd_font_file)) {
				//파일 이름입니다.
				$font = @imageloadfont($this->gd_font_file);
				if ($font == false) {
					trigger_error("Failed to load GD Font file {$this->gd_font_file} ", E_USER_WARNING);
					return;
				}
			}
			else {
				//gd 글꼴 식별자
				$font = $this->gd_font_file;
			}

			imagestring($this->im, $font, $this->text_x_start, ($this->image_height / 2) - ($this->gd_font_size / 2), $this->code, $this->gdtextcolor);
		}
		else {
			//ttf 글꼴
			$font_size = $height2 * .35;
			$bb = imagettfbbox($font_size, 0, $this->ttf_file, $this->code);
			$tx = $bb[4] - $bb[0];
			$ty = $bb[5] - $bb[1];
			$x  = floor($width2 / 2 - $tx / 2 - $bb[0]);
			$y  = round($height2 / 2 - $ty / 2 - $bb[1]);

			$strlen = strlen($this->code);
			if (!is_array($this->multi_text_color)) $this->use_multi_text = false;


			if ($this->use_multi_text == false && $this->text_angle_minimum == 0 && $this->text_angle_maximum == 0) {
				// 각이나 여러 색상의 문자가 없음
				imagettftext($this->tmpimg, $font_size, 0, $x, $y, $this->gdtextcolor, $this->ttf_file, $this->code);
			}
			else {
				for($i = 0; $i < $strlen; ++$i) {
					$angle = rand($this->text_angle_minimum, $this->text_angle_maximum);
					$y = rand($y - 5, $y + 5);
					if ($this->use_multi_text == true) {
						$font_color = $this->gdmulticolor[rand(0, sizeof($this->gdmulticolor) - 1)];
					}
					else {
						$font_color = $this->gdtextcolor;
					}

					$ch = $this->code{$i};

					imagettftext($this->tmpimg, $font_size, $angle, $x, $y, $font_color, $this->ttf_file, $ch);

					// 너무 크거나 너무 작은 공백을 만들지 않고 문자 폭을 추정하여 $x를 증가시킵니다.
					// 이 값은 텍스트를 정렬하는데 가장 좋지만 글꼴마다 다를 수 있습니다.
					// 최적의 문자 너비를 위해서는 여러 텍스트 색상이나 문자 각도를 사용하지 말고 전체 문자열은 imagettftext에 의해 작성됩니다.
					if (strpos('abcdeghknopqsuvxyz', $ch) !== false) {
						$min_x = $font_size - ($this->iscale * 6);
						$max_x = $font_size - ($this->iscale * 6);
					}
					else if (strpos('ilI1', $ch) !== false) {
						$min_x = $font_size / 5;
						$max_x = $font_size / 3;
					}
					else if (strpos('fjrt', $ch) !== false) {
						$min_x = $font_size - ($this->iscale * 12);
						$max_x = $font_size - ($this->iscale * 12);
					}
					else if ($ch == 'wm') {
						$min_x = $font_size;
						$max_x = $font_size + ($this->iscale * 3);
					}
					else {
						// numbers, capitals or unicode
						$min_x = $font_size + ($this->iscale * 2);
						$max_x = $font_size + ($this->iscale * 5);
					}

					$x += rand($min_x, $max_x);
				}
				//for 루프
			}
			// 각진 또는 멀티 컬러
		}
		//else ttf 글꼴
		//$this->im = $this->tmpimg;
		//$this->output();
	}
	//함수

    /**
     * 텍스트를 임시 이미지에서 최종 이미지로 변형합니다.
     * securimage에 맞게 수정됨
     *
     * @private 으로 접근
     * @2.0 부터
     * @저자 Han-Kwang Nienhuys 의해 수정됨
     * @저작권 Han-Kwang Neinhuys
     *
	*/
	function distortedCopy()
	{
		$numpoles = 3; // 왜곡 계수

		// 막대기의 배열을 일명 어트랙터 포인트로 만든다.
		for ($i = 0; $i < $numpoles; ++$i) {
			$px[$i]  = rand($this->image_width * 0.3, $this->image_width * 0.7);
			$py[$i]  = rand($this->image_height * 0.3, $this->image_height * 0.7);
			$rad[$i] = rand($this->image_width * 0.4, $this->image_width * 0.7);
			$tmp     = -$this->frand() * 0.15 - 0.15;
			$amp[$i] = $this->perturbation * $tmp;
		}

		$bgCol   = imagecolorat($this->tmpimg, 0, 0);
		$width2  = $this->iscale * $this->image_width;
		$height2 = $this->iscale * $this->image_height;

		imagepalettecopy($this->im, $this->tmpimg); // 텍스트 색상이 나타나도록 팔레트를 최종 이미지로 복사한다.

		// $img 픽셀 이상의 루프, 왜곡 필드가있는 $tmpimg의 픽셀 가져 오기
		for ($ix = 0; $ix < $this->image_width; ++$ix) {
			for ($iy = 0; $iy < $this->image_height; ++$iy) {
				$x = $ix;
				$y = $iy;

				for ($i = 0; $i < $numpoles; ++$i) {
					$dx = $ix - $px[$i];
					$dy = $iy - $py[$i];
					if ($dx == 0 && $dy == 0) continue;

					$r = sqrt($dx * $dx + $dy * $dy);
					if ($r > $rad[$i]) continue;

					$rscale = $amp[$i] * sin(3.14 * $r / $rad[$i]);
					$x += $dx * $rscale;
					$y += $dy * $rscale;
				}

				$c = $bgCol;
				$x *= $this->iscale;
				$y *= $this->iscale;

				if ($x >= 0 && $x < $width2 && $y >= 0 && $y < $height2) {
					$c = imagecolorat($this->tmpimg, $x, $y);
				}

				if ($c != $bgCol) {
					// 배경 이미지를 보존하기 위해 문자의 픽셀만 복사한다.
					imagesetpixel($this->im, $ix, $iy, $c);
				}
			}
		}
	}

    /**
     * 코드를 생성하고 세션에 저장한다.
     *
     * @private 으로 접근
     * @1.0.1 부터
     *
	*/
	function createCode()
	{
		$this->code = false;

		if ($this->use_wordlist && is_readable($this->wordlist_file)) {
			$this->code = $this->readCodeFromFile();
		}

		if ($this->code == false) {
			$this->code = $this->generateCode($this->code_length);
		}

		$this->saveData();
	}

    /**
     * 하나의 코드를 생성한다
     *
     * @private 으로 접근
     * @파라미터 int $len  코드 길이
     * @문자열 반환
	*/
	function generateCode($len)
	{
		$code = '';

		for($i = 1, $cslen = strlen($this->charset); $i <= $len; ++$i) {
			$code .= $this->charset{rand(0, $cslen - 1)};
		}
		return $code;
	}

    /**
     * 단어 목록 파일을 읽어 코드를 얻습니다.
     *
     * @private 으로 접근
     * @1.0.2 부터
     * @실패시 거짓, 성공시 단어를 복합적으로 반환
	*/
	function readCodeFromFile()
	{
		$fp = @fopen($this->wordlist_file, 'rb');
		if (!$fp) return false;

		$fsize = filesize($this->wordlist_file);
		if ($fsize < 32) return false; // 너무 작아서 효과적이지는 않다.

		if ($fsize < 128) {
			$max = $fsize; // 여전히 작지만 찾기의 범위를 변경합니다.
		}
		else {
			$max = 128;
		}

		fseek($fp, rand(0, $fsize - $max), SEEK_SET);
		$data = fread($fp, 128); // 파일에서 무작위로 128 바이트를 읽는다.
		fclose($fp);
		$data = preg_replace("/\r?\n/", "\n", $data);

		$start = strpos($data, "\n", rand(0, 100)) + 1; // random start position
		$end   = strpos($data, "\n", $start);           // 단어의 끝 찾기

		return strtolower(substr($data, $start, $end - $start)); // 128 바이트의 부분 문자열 반환
	}

    /**
     * 이미지를 브라우저로 출력
     *
     * @private 으로 접근
     *
	*/
	function output()
	{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

		switch($this->image_type)
		{
			case SI_IMAGE_JPEG:
			header("Content-Type: image/jpeg");
			imagejpeg($this->im, null, 90);
			break;

			case SI_IMAGE_GIF:
			header("Content-Type: image/gif");
			imagegif($this->im);
			break;

			default:
			header("Content-Type: image/png");
			imagepng($this->im);
			break;
		}

		imagedestroy($this->im);
		exit;
	}

    /**
     * 음성 코드의 WAV 또는 MP3 파일 데이터를 가져옵니다.
     * 이것은 audio/x-wav 또는 audio/mpeg 으로 브라우저에 출력하는 데 적합합니다.
     *
     * @1.0.1 부터
     * @WAV 또는 MP3 데이터 문자열을 반환
     *
	*/
	function getAudibleCode($format = 'wav')
	{
		$letters = array();
		$code    = $this->getCode();

		if ($code == '') {
			$this->createCode();
			$code = $this->getCode();
		}

		for($i = 0; $i < strlen($code); ++$i) {
			$letters[] = $code{$i};
		}

		if ($format == 'mp3') {
			return $this->generateMP3($letters);
		}
		else {
			return $this->generateWAV($letters);
		}
	}

    /**
     * 오디오 디렉토리 경로를 설정한다.
     *
     * @1.0.4 부터
     * @bool 반환, 디렉토리가 존재해, 읽을 수있는 경우는 true, 그렇지 않은 경우는 false 반환
	*/
	function setAudioPath($audio_directory)
	{
		if (is_dir($audio_directory) && is_readable($audio_directory)) {
			$this->audio_path = $audio_directory;
			return true;
		}
		else {
			return false;
		}
	}

    /**
     * 세션에 코드 저장
     *
     * @private 으로 접근
     *
	*/
	function saveData()
	{
		$_SESSION['securimage_code_value'] = strtolower($this->code);
		$_SESSION['securimage_code_ctime'] = time();

		$this->saveCodeToDatabase();
	}

    /**
     * 사용자 코드에 대해 유효성 검사를 합니다.
     *
     * @private 으로 접근
     *
	*/
	function validate()
	{
		// 코드가 없는 경우 세션에서 코드를 검색합니다. 지원되는 경우 sqlite 데이터베이스를 확인한다.
		$code = '';

		if (isset($_SESSION['securimage_code_value']) && trim($_SESSION['securimage_code_value']) != '') {
			if ($this->isCodeExpired($_SESSION['securimage_code_ctime']) == false) {
				$code = $_SESSION['securimage_code_value'];
			}
		}
		else if ($this->use_sqlite_db == true && function_exists('sqlite_open')) {
			// 세션에 코드 없음 - 사용자가 쿠키를 사용 중지했다는 것을 의미할 수 있음
			$this->openDatabase();
			$code = $this->getCodeFromDatabase();
		}
		else {
			/* 세션 코드가 유효하지 않거나 존재하지 않으며 sqlite db 또는 sqlite에서 코드를 찾을 수 없습니다. */
		}

		$code               = trim(strtolower($code));
		$code_entered       = trim(strtolower($this->code_entered));
		$this->correct_code = false;

		if ($code != '') {
			if ($code == $code_entered) {
				$this->correct_code = true;
				$_SESSION['securimage_code_value'] = '';
				$_SESSION['securimage_code_ctime'] = '';
				$this->clearCodeFromDatabase();
			}
		}
	}

    /**
     * captcha 코드를 얻는다
     *
     * @1.0.1 부터
     * @문자열 반환
	*/
	function getCode()
	{
		if (isset($_SESSION['securimage_code_value']) && !empty($_SESSION['securimage_code_value'])) {
			return strtolower($_SESSION['securimage_code_value']);
		}
		else {
			if ($this->sqlite_handle == false) $this->openDatabase();

			return $this->getCodeFromDatabase(); // 데이터베이스에서 가져오기를 시도하고 sqlite를 사용할 수 없거나 비활성화 된 경우 빈 문자열을 반환합니다.
		}
	}

    /**
     * 사용자가 입력한 코드가 올바른지 확인한다.
     *
     * @private 으로 접근
     * @boolean 반환
	*/
	function checkCode()
	{
		return $this->correct_code;
	}

    /**
     * 개별 파일을 연결하여 wav 파일 생성
     *
     * @1.0.1 부터
     * @private 으로 접근
     * @$letters 파라미터는 배열, 파일을 만들 문자들의 배열.
     * @return string  WAV file data
	*/
	function generateWAV($letters)
	{
		$data_len    = 0;
		$files       = array();
		$out_data    = '';

		foreach ($letters as $letter) {
			$filename = $this->audio_path . strtoupper($letter) . '.wav';

			$fp = fopen($filename, 'rb');

			$file = array();

			$data = fread($fp, filesize($filename)); // 에서 파일을 읽다

			$header = substr($data, 0, 36);
			$body   = substr($data, 44);


			$data = unpack('NChunkID/VChunkSize/NFormat/NSubChunk1ID/VSubChunk1Size/vAudioFormat/vNumChannels/VSampleRate/VByteRate/vBlockAlign/vBitsPerSample', $header);

			$file['sub_chunk1_id']   = $data['SubChunk1ID'];
			$file['bits_per_sample'] = $data['BitsPerSample'];
			$file['channels']        = $data['NumChannels'];
			$file['format']          = $data['AudioFormat'];
			$file['sample_rate']     = $data['SampleRate'];
			$file['size']            = $data['ChunkSize'] + 8;
			$file['data']            = $body;

			if ( ($p = strpos($file['data'], 'LIST')) !== false) {
				// LIST 데이터가 파일의 끝 부분에 없다면, 이것은 아마 당신의 사운드 파일을 깨뜨릴 것입니다
				$info         = substr($file['data'], $p + 4, 8);
				$data         = unpack('Vlength/Vjunk', $info);
				$file['data'] = substr($file['data'], 0, $p);
				$file['size'] = $file['size'] - (strlen($file['data']) - $p);
			}

			$files[] = $file;
			$data    = null;
			$header  = null;
			$body    = null;

			$data_len += strlen($file['data']);

			fclose($fp);
		}

		$out_data = '';
		for($i = 0; $i < sizeof($files); ++$i) {
			if ($i == 0) {
				// 출력 헤더
				$out_data .= pack('C4VC8', ord('R'), ord('I'), ord('F'), ord('F'), $data_len + 36, ord('W'), ord('A'), ord('V'), ord('E'), ord('f'), ord('m'), ord('t'), ord(' '));

				$out_data .= pack('VvvVVvv',
				16,
				$files[$i]['format'],
				$files[$i]['channels'],
				$files[$i]['sample_rate'],
				$files[$i]['sample_rate'] * (($files[$i]['bits_per_sample'] * $files[$i]['channels']) / 8),
				($files[$i]['bits_per_sample'] * $files[$i]['channels']) / 8,
				$files[$i]['bits_per_sample'] );

				$out_data .= pack('C4', ord('d'), ord('a'), ord('t'), ord('a'));

				$out_data .= pack('V', $data_len);
			}

			$out_data .= $files[$i]['data'];
		}

		$this->scrambleAudioData($out_data, 'wav');
		return $out_data;
	}

    /**
     * 무작위로 오디오 데이터를 수정하여 사운드를 스크램블하고 이진 인식을 방지합니다.
     * 헤더 데이터를 그대로 남겨 두어 오디오 파일을 "손상" 시키지 않도록 주의합니다.
     *
     * @2.0 부터
     * @private 으로 접근
     * @파라미터 $data는 mp3 형식의 사운드 데이터
	*/
	function scrambleAudioData(&$data, $format)
	{
		if ($format == 'wav') {
			$start = strpos($data, 'data') + 4; // "데이터" 표시 위치를 찾습니다.
			if ($start === false) $start = 44;  // 44 바이트 헤더를 가정하지 않을 경우
		}
		else {
			// mp3
			$start = 4; // 4 바이트 (32 비트) 프레임 헤더
		}

		$start  += rand(1, 64); // 랜덤한 시작 오프셋
		$datalen = strlen($data) - $start - 256; // 마지막 256 바이트를 변경하지 않고 남겨 둡니다.

		for ($i = $start; $i < $datalen; $i += 64) {
			$ch = ord($data{$i});
			if ($ch < 9 || $ch > 119) continue;

			$data{$i} = chr($ch + rand(-8, 8));
		}
	}

    /**
     * 개별 파일을 연결하여 mp3 파일 생성
     * @1.0.4 부터
     * @private 으로 접근
     * @파라미터 $letters는 배열, 파일을 만들 문자 배열
     * @MP3 파일 데이타 문자열 반환
	*/
	function generateMP3($letters)
	{
		$data_len    = 0;
		$files       = array();
		$out_data    = '';

		foreach ($letters as $letter) {
			$filename = $this->audio_path . strtoupper($letter) . '.mp3';

			$fp   = fopen($filename, 'rb');
			$data = fread($fp, filesize($filename)); // 에서 파일을 읽는다

			$this->scrambleAudioData($data, 'mp3');
			$out_data .= $data;

			fclose($fp);
		}


		return $out_data;
	}

    /**
     * 1보다 작은 난수 생성
     * @2.0 부터
     * @private 으로 접근
     * @실수 반환
	*/
	function frand()
	{
		return 0.0001*rand(0,9999);
	}

    /**
     * 이미지에 서명 텍스트 인쇄
     *
     * @2.0 부터
     * @private 으로 접근
     *
	*/
	function addSignature()
	{
		if ($this->use_gd_font) {
			imagestring($this->im, 5, $this->image_width - (strlen($this->image_signature) * 10), $this->image_height - 20, $this->image_signature, $this->gdsignaturecolor);
		}
		else {

			$bbox = imagettfbbox(10, 0, $this->signature_font, $this->image_signature);
			$textlen = $bbox[2] - $bbox[0];
			$x = $this->image_width - $textlen - 5;
			$y = $this->image_height - 3;

			imagettftext($this->im, 10, 0, $x, $y, $this->gdsignaturecolor, $this->signature_font, $this->image_signature);
		}
	}

    /**
     * 원격 사용자의 해쉬된 IP 주소 얻기
     *
     * @private 으로 접근
     * @2.0.1 부터
     * @문자열 반환
	*/
	function getIPHash()
	{
		return strtolower(md5($_SERVER['REMOTE_ADDR']));
	}

    /**
     * SQLite 데이터베이스 열기
     *
     * @private 으로 접근
     * @2.0.1 부터
     * @bool 반환, 데이타베이스가 정상적으로 오픈됐을 경우는 true
	*/
	function openDatabase()
	{
		$this->sqlite_handle = false;

		if ($this->use_sqlite_db && function_exists('sqlite_open')) {
			$this->sqlite_handle = sqlite_open($this->sqlite_database, 0666, $error);

			if ($this->sqlite_handle !== false) {
				$res = sqlite_query($this->sqlite_handle, "PRAGMA table_info(codes)");
				if (sqlite_num_rows($res) == 0) {
					sqlite_query($this->sqlite_handle, "CREATE TABLE codes (iphash VARCHAR(32) PRIMARY KEY, code VARCHAR(32) NOT NULL, created INTEGER)");
				}
			}

			return $this->sqlite_handle != false;
		}

		return $this->sqlite_handle;
	}

    /**
     * CAPCHA 코드를 sqlite 데이터베이스에 저장
     *
     * @private 으로 접근
     * @2.0.1 부터
     * @bool 반환, 코드가 save된 경우는 true, 그렇지 않은 경우는 false
	*/
	function saveCodeToDatabase()
	{
		$success = false;

		$this->openDatabase();

		if ($this->use_sqlite_db && $this->sqlite_handle !== false) {
			$ip = $this->getIPHash();
			$time = time();
			$code = $_SESSION['securimage_code_value']; // 보안 해시 코드 - 쿠키가 비활성화된 경우 세션은 이 시점에서 계속 존재합니다.
			$success = sqlite_query($this->sqlite_handle, "INSERT OR REPLACE INTO codes(iphash, code, created) VALUES('$ip', '$code', $time)");
		}

		return $success !== false;
	}

    /**
     * IP 주소 해시를 기반으로 sqlite 데이터베이스에서 저장된 captcha 코드 가져 오기
     *
     * @private 으로 접근
     * @2.0.1 부터
     * @captcha 코드 문자열 반환
	*/
	function getCodeFromDatabase()
	{
		$code = '';

		if ($this->use_sqlite_db && $this->sqlite_handle !== false) {
			$ip = $this->getIPHash();

			$res = sqlite_query($this->sqlite_handle, "SELECT * FROM codes WHERE iphash = '$ip'");
			if ($res && sqlite_num_rows($res) > 0) {
				$res = sqlite_fetch_array($res);

				if ($this->isCodeExpired($res['created']) == false) {
					$code = $res['code'];
				}
			}
		}

		return $code;
	}

    /**
     * IP 주소 해시로 데이터베이스에서 code 삭제
     *
     * @private 으로 접근
     * @2.0.1 부터
	*/
	function clearCodeFromDatabase()
	{
		if ($this->sqlite_handle !== false) {
			$ip = $this->getIPHash();

			sqlite_query($this->sqlite_handle, "DELETE FROM codes WHERE iphash = '$ip'");
		}
	}

    /**
     * 데이터베이스에서 하루 전의 코드 제거
     *
     * @private 으로 접근
     * @2.0.1 부터
	*/
	function purgeOldCodesFromDatabase()
	{
		if ($this->use_sqlite_db && $this->sqlite_handle !== false) {
			$now   = time();
			$limit = (!is_numeric($this->expiry_time) || $this->expiry_time < 1) ? 86400 : $this->expiry_time;

			sqlite_query($this->sqlite_handle, "DELETE FROM codes WHERE $now - created > $limit");
		}
	}

    /**
     * 생성 시간에 따라 코드가 만료되었는지 확인한다.
     *
     * @private 으로 접근
     * @2.0.1 부터
     * @파라미터 $creation_time 는 코드 생성 시간의 유닉스 타임 스탬프
     * @bool 반환, 코드가 만료된 경우 true, 그렇지 않은 경우 false
	*/
	function isCodeExpired($creation_time)
	{
		$expired = true;

		if (!is_numeric($this->expiry_time) || $this->expiry_time < 1) {
			$expired = false;
		}
		else if (time() - $creation_time < $this->expiry_time) {
			$expired = false;
		}

		return $expired;
	}

}
/* Securimage 클래스 */


/**
 * Securimage CAPTCHA의 색상 객체
 *
 * @2.0 부터
 * @package Securimage
 * @subpackage 클래스들
 *
*/
class Securimage_Color {
    /**
     * 빨간색 구성 요소 : 0-255
     *
     * @var int
	*/
	var $r;
    /**
     * 초록색 구성 요소 : 0-255
     *
     * @var int
	*/
	var $g;
    /**
     * 파란색 구성 요소 : 0-255
     *
     * @var int
	*/
	var $b;

    /**
     * 새 Securimage_Color 개체를 만듭니다.
     * HTML 16진수 코드를 사용하여 빨강, 녹색 및 파랑 구성 요소를 지정합니다.
     * 예 : HTML #4A203C의 코드는 다음과 같습니다.
     * $color = new Securimage_Color(0x4A, 0x20, 0x3C);
     *
     * @파라미터 $red는 빨간색 구성 요소 0-255
     * @파라미터 $green는 초록색 구성 요소 0-255
     * @파라미터 $blue는 파란색 구성 요소 0-255
	*/
	function Securimage_Color($red, $green = null, $blue = null)
	{
		if ($green == null && $blue == null && preg_match('/^#[a-f0-9]{3,6}$/i', $red)) {
			$col = substr($red, 1);
			if (strlen($col) == 3) {
				$red   = str_repeat(substr($col, 0, 1), 2);
				$green = str_repeat(substr($col, 1, 1), 2);
				$blue  = str_repeat(substr($col, 2, 1), 2);
			}
			else {
				$red   = substr($col, 0, 2);
				$green = substr($col, 2, 2);
				$blue  = substr($col, 4, 2);
			}

			$red   = hexdec($red);
			$green = hexdec($green);
			$blue  = hexdec($blue);
		}
		else {
			if ($red < 0) $red       = 0;
			if ($red > 255) $red     = 255;
			if ($green < 0) $green   = 0;
			if ($green > 255) $green = 255;
			if ($blue < 0) $blue     = 0;
			if ($blue > 255) $blue   = 255;
		}

		$this->r = $red;
		$this->g = $green;
		$this->b = $blue;
	}
}
