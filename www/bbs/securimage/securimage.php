<?php

/**
 * ������Ʈ:    Securimage: ��� CAPTCHA �̹����� ����� �����ϱ����� PHP Ŭ����
 * ����:        securimage.php
 *
 * �� ���̺귯���� ���� ����Ʈ�����Դϴ�. ����� �װ��� ������� �� �ֽ��ϴ�.
 * GNU ��� �Ϲ� ������ ���ǿ� ���� �����Ͻʽÿ�.
 * ���� ����Ʈ���� ����� ���� �� ���̼���. ��� �� ��
 * ���̼��� ���� 2.1 �Ǵ� ���� ����.
 *
 * �� ���̺귯���� ������ ���̶�� ������� �����Ǿ����ϴ�.
 * ������ ��� ���������� �ʽ��ϴ�. ������ ��������
 * ��ǰ�� �Ǵ� Ư�� �������� ���ռ�. GNU����
 * �� �ڼ��� ������ Lesser General Public License�� �����Ͻʽÿ�.
 *
 * GNU ��� �Ϲ� ������ �纻�� �޾ƾ��մϴ�.
 * �� ���̺귯���� �Բ� ���̼���; �׷��� �ʴٸ� ���� ����Ʈ��� ���� ���ϴ�.
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * ���̺귯���� ���� ���� ������ �ҽ� �ڵ忡 ��Ȯ�ϰ� ǥ�õǾ���մϴ�.
 * ���� ������ ���� ����Ʈ������ �Ϻΰ� �ƴ϶�� ����� ����ڿ��� �˸��ϴ�.
 *
 * �� ��ũ��Ʈ�� �����ϴٰ� �ǴܵǸ� ��� �ð������� ���Ͻʽÿ�.
 * http://www.hotscripts.com/rate/49400.html �����մϴ�.
 *
 * @link http://www.phpcaptcha.org Securimage PHP CAPTCHA
 * @link http://www.phpcaptcha.org/latest.zip �ֽ� ���� �ٿ�ε�
 * @link http://www.phpcaptcha.org/Securimage_Docs/ �¶��� ����
 * @���۱� 2009 Drew Phillips
 * @���� Drew �ʸ��� <drew@drew-phillips.com>
 * @version 2.0.1 ��Ÿ (2009 �� 12 �� 6 ��)
 * @Securimage ��Ű��
 *
*/

/**
 ���� �α�

 2.0.2
 ���̺귯���� ���� ������ �� �ֵ��� ��� ������ �����߽��ϴ� (Nathan Phillip Brink ohnobinki@ohnopublishing.net).

 2.0.1
 - ��Ű�� ��Ȱ��ȭ �� �������� ���� ���� �߰� (php5, sqlite �ʿ�)�� ����ڸ� md5 �ؽ� IP �ּ� �� md5 �ؽ� �ڵ�� �����Ͽ� ������ ��ȭ�մϴ�.
 - ttf ������ ��� �������� �ʰų� �۲� ������ ã�� �� ���� ��� gd �۲ÿ� ������ �߰��մϴ� (Mike Challis http://www.642weather.com/weather/scripts.php).
 - �̹��� Ÿ�� ����� ���� ���� Ȯ�� (Mike Challis)
 - ����� ��¿� ���� MIME Ÿ�� ���� ����
 - ���� ���� �� ��� �̹����� ���� ���� �Ҵ� ������ �����ǰ� �Ҵ��� �ϳ��� ������� ����
 - �־��� �ð��� ������ �ڵ尡 ����ǵ����ϴ� ���
 - HTML ���� �ڵ尡 Securimage_Color�� ���޵ǵ��� ����մϴ� (Mike Challis�� ����).

 2.0.0
 - ���ڿ� ������ �ְ� �߰� (HKCaptcha�� �ڵ� ���)
 - ���� �� ���� ����
 - ���� ���� ���Ǹ����� Securimage_Color Ŭ���� �߰�
 - ���̳ʸ� �� ������ ���� ���� ����� ��¿� �ְ� �߰� (Sven "SavageTiger"Hagemann [insecurity.nl]�� ����)
 - mp3 ������� ��Ʈ�����ϴ� �÷��� ��ư (���۶� ���� www.douglaswalsh.net)
 - ����� ����� �⺻������ mp3 �����Դϴ�.
 - yann le coroller�� ���� AlteHaasGrotesk�� �۲� ����
 - �Ϻ� �ڵ� ����

 1.0.4 (��õ��� ����)
 - �÷��ÿ��� ��Ʈ������ mp3 ������ ��û �ڵ带 ����ϴ� ���

 1.0.3.1
 - � ��� �ܾ� ��Ͽ��� �д� �� ������ �߻��Ͽ� �ܾ �� ���� ª����

 1.0.3
 - ���� �������� �����Ͽ� ���ǵ��� ���� �Ӽ� ������ �߻��� �� �ִ� �ڵ忡�� shadow_text�� �����߽��ϴ�.

 1.0.2
 - Audible CAPTCHA �ڵ� wav ����
 - ������ ���ڿ� ��� �ܾ� ��Ͽ��� �ڵ� ����

 1.0
 - a0-z0-9�� �ƴ� ������ ���� ��Ʈ�� ����� �� �ִ� ����� �߰��Ǿ����ϴ�.
 - �� ���ڿ� �ٸ� ������ ����ϴ� ���� ���� �ؽ�Ʈ �ɼ��� �߰��߽��ϴ�.
 - �ڵ� ������ ���� ������ ����ϴ� ��� �ڵ� ���� ó���� ��ȯ
 - ttf ������ ����� �� ���� ��� GD �۲� ������ �߰��Ǿ����ϴ�. ���� GD �۲��� ����ϰų� ���ο� �۲��� �ε��� �� �ֽ��ϴ�.
 - �� �β� ���� ��� �߰�
 - ���� ���� ��ȣ �� �׸��� �ɼ� �߰�
 - ����� ���� �̹��� Ÿ���� ������ ���ִ� ��� �߰�

*/

/**
 * JPEG ������ �̹��� ���
*/
if (!defined('SI_IMAGE_JPEG'))
	define('SI_IMAGE_JPEG', 1);
/**
 * PNG ������ �̹��� ���
*/
if (!defined('SI_IMAGE_PNG'))
	define('SI_IMAGE_PNG',  2);
/**
 * �̹����� GIF �������� ����մϴ� (�������� ����).
 * GD >= 2.0.28 �̾���մϴ�!
*/
if (!defined('SI_IMAGE_GIF'))
	define('SI_IMAGE_GIF',  3);

/**
 * Securimage CAPTCHA Ŭ����.
 *
 * @Securimage ��Ű��
 * @subpackage Ŭ������
 *
*/
class Securimage {

    /**
     * securimage.php�� ���Ե� ����Դϴ�.
     *
     * @var string    securimage ��ġ ���.
	*/
	var $basepath;

    /**
     * ���ϴ� CAPTCHA �̹����� �ʺ��Դϴ�.
     *
     * @var int
	*/
	var $image_width;

    /**
     * ���ϴ� CAPTCHA �̹����� �����Դϴ�.
     *
     * @var int
	*/
	var $image_height;

    /**
     * ��¿��� �̹��� ����.
     * ��ȿ�� �ɼ�: SI_IMAGE_PNG, SI_IMAGE_JPG, SI_IMAGE_GIF
     *
     * @var int
	*/
	var $image_type;

    /**
     * ������ code�� ����.
     *
     * @var int
	*/
	var $code_length;

    /**
     * �̹����� ���� ���ڿ� ���� ���� �����Դϴ�.
     * ���ڴ� �빮�ڷ� ��ȯ�˴ϴ�.
     * �۲��� ���ڸ� �����ؾ��ϰų� �������ִ� ��ü ���ڰ� ���� �� �ֽ��ϴ�.
     *
     * @var string
	*/
	var $charset;

    /**
     * �� �ܾ� ����� ����Ͽ� code�� ����ϴ�.
     *
     * @var string  CAPCHA �ڵ带 ����� �� ����� �ܾ� ����� ���
	*/
	var $wordlist_file;

    /**
     * �ܾ� ��� ��� ����
     *
     * @var bool �ܾ� ��� ������ ����Ϸ��� true��, ���� �ڵ带 ����Ϸ��� false �� ����.
	*/
	var $use_wordlist = false;

    /**
     * ���� : ���� �ְ� ����� ����� �� �����Ƿ� GD �۲��� ������� �ʴ� ���� �����ϴ�.
     * ����� GD �۲�.
     * ���� gd �۲��� ��ȣ�� �ε��� �� �ֽ��ϴ�.
     * �Ǵ� ���� ��θ� �����ϰ� �۲��� ���Ͽ����ε� �� �� �ֽ��ϴ�.
     *
     * @var mixed
	*/
	var $gd_font_file;

    /**
     * �۲��� �뷫���� ũ��(�ȼ�)�Դϴ�.
     * �۲� ũ��� GD �۲� ��ü�� ���� �����ǹǷ� �۲� ũ�⸦ �������� �ʽ��ϴ�.
     * �̰���,�� Ŭ������ ����ϴ� ��ġ ������ ����� ���� ���ؼ� ���˴ϴ�.
     *
     * @var int
	*/
	var $gd_font_size;

    /**
     * TTF ��� gd �۲� ���
     *
     * @var bool gd ��Ʈ�� ��� true, TTF�� ��� false
	*/
	var $use_gd_font;

	// ����: $text_color�� �����ϰ� $use_gd_font�� true�� �����ϸ� �Ʒ��� �۲� �ɼ��� ������� �ʽ��ϴ�.

    /**
     * �ε��� TTF �۲� ������ ����Դϴ�.
     *
     * @var string
	*/
	var $ttf_file;

    /**
     * �󸶸�ŭ�� �̹��� �ְ��� �� ������, ���� ��ġ = �� ���� �ְ�.
     * �ְ��� TTF �۲��� ����� ���� ����� �� �ֽ��ϴ�.
     *
     * @var float
	*/
	var $perturbation;

    /**
     * ������ 0���� �����Ͽ� ���ʿ��� ���������� �д� �ؽ�Ʈ�� �ּ� �����Դϴ�.
     * ���� ���� �� �ð� ���� ȸ���� ��Ÿ���ϴ�.
     * ���� ���, 90�� ���� �� �Ʒ����� �� ���� �д� �ؽ�Ʈ�� �˴ϴ�.
     * �ִ� ���� �Ÿ��� �Բ� �� ���� �������� �ſ� ���� �ʿ�� �����ϴ�.
     *
     * @var int
	*/
	var $text_angle_minimum;

    /**
     * ������ 0���� �����Ͽ� ���ʿ��� ���������� �д� �ؽ�Ʈ�� �ִ� �����Դϴ�.
     * ���� ���� �� �ð� ���� ȸ���� ��Ÿ���ϴ�.
     * ���� ���, 90�� ���� �� �Ʒ����� �� ���� �д� �ؽ�Ʈ�� �˴ϴ�.
     *
     * @var int
	*/
	var $text_angle_maximum;

    /**
     * ���� �׸��Ⱑ ���۵� �̹����� X ��ġ.
     * �� ���� �̹����� ���ʺ��� �ȼ� �����Դϴ�.
     *
     * @var int
     * @2.0 ��� ����
	*/
	var $text_x_start;

    /**
     * Securimage_Color�� �̹����� ����.
     *
     * @var Securimage_Color
	*/
	var $image_bg_color;

    /**
     * gif, jpg �� png ������ ��׶��� �̹����� ���ǵ��� �� ���丮�� ��ĵ�մϴ�.
     * ������ �̹��� ������ �Ź� ���õ˴ϴ�.
     * null���� ���丮�� ��ü ��η� �����Ѵ�.
     * �� var $background_directory = $_SERVER['DOCUMENT_ROOT'].'/securimage/backgrounds'; �Դϴ�.
     * show �Լ��� ��� �̹����� �������� �ʵ��� �Ѵ�. �׷��� ������ �� ���ù��� ���õ˴ϴ�.
     *
     * @var string
	*/
	var $background_directory = null; //'./backgrounds';

    /**
     * ���ڸ� Securimage_Color�� �׸��� �� ����� �ؽ�Ʈ �����Դϴ�.
     * $use_multi_text�� true�� �����Ǹ��� ���� ���õ˴ϴ�.
     * �����̳� �̹����� �� �����Ǵ��� Ȯ���Ѵ�.
     *
     * @Securimage::$use_multi_text �� ���ϴ�
     * @var Securimage_Color
	*/
	var $text_color;

    /**
     * �� ���ڿ� ���� ������ ����Ϸ��� true�� �����Ͻʽÿ�.
     *
     * @Securimage::$multi_text_color �� ���ϴ�
     * @var boolean
	*/
	var $use_multi_text;

    /**
     * �� ���ڿ� ���� ���Ƿ� ���õǴ� Securimage_Colors�� �迭�Դϴ�.
     *
     * @var array
	*/
	var $multi_text_color;

    /**
     * ���ڸ� �����ϰ� ���̰� �Ϸ��� true�� �����Ͻʽÿ�.
     *
     * @Securimage::$text_transparency_percentage �� ���ϴ�
     * @var boolean
	*/
	var $use_transparent_text;

    /**
     * ���� ����� (0 ~ 100)�Դϴ�.
     * �� 0�� ������ ������, 100�� ������ ���� (������ ����)
     *
     * @Securimage::$use_transparent_text �� ���ϴ�
     * @var int
	*/
	var $text_transparency_percentage;


	// ���� �ɼ�
    /**
    * �̹����� �������� ������ �׸��ϴ�.
    *
    * @Securimage::$line_color �� ���ϴ�
    * @Securimage::$draw_lines_over_text �� ���ϴ�
    * @var boolean
	*/
	var $num_lines;

    /**
     * �ؽ�Ʈ ���� �׸� ���� ����
     *
     * @var string
	*/
	var $line_color;

    /**
     * �ؽ�Ʈ ���� ���� �׸��ϴ�.
     * �̹����� �ؽ�Ʈ�� �ֱ� ���� fales ������ �׷����� ���.
     *
     * @var boolean
	*/
	var $draw_lines_over_text;

    /**
     * ���� ���� �̹����� �ϴ� �𼭸��� �� �ؽ�Ʈ
     *
     * @2.0 ����
     * @var string ���� �ؽ�Ʈ
	*/
	var $image_signature;

    /**
     * ���� �ؽ�Ʈ�� ���� �� ����� ����
     *
     * @2.0 ����
     * @var Securimage_Color
	*/
	var $signature_color;

    /**
     * ����� ������ ����� �� ����� WAV ������ ��ü ����̸� ���ʿ� /�� �����մϴ�.
     * �̸� ���� [A-Z0-9].wav
     *
     * @1.0.1 ����
     * @var string
	*/
	var $audio_path;

    /**
     * ���� �� ����� ���� ���� (mp3 �Ǵ� wav)
     *
     * @var string
	*/
	var $audio_format;

    /**
     * �⺻���� �ƴ� ��� ����� ���� �̸��Դϴ�. ��ĭ ����
     *
     * @http://php.net/session_name �� ���ϴ�
     * @2.0 ����
     * @var string
	*/
	var $session_name = '';

    /**
     * �ڵ尡 ��ȿ�ϰ� �����Ǵ� �ð�(��).
     * �� ���ں��� ������ �ڵ�� �ùٸ��� �Է��ص� ��ȿ���� ���� ������ ���ֵ˴ϴ�.
     * ���ڰ� �ƴ� �� �Ǵ� 1���� ���� ���� �� ����� ������� �ʽ��ϴ�.
     *
     * @var int
	*/
	var $expiry_time;

    /**
     * ����� �ڵ带 �����ϴ� �� ����� ������ ����Դϴ�.
     * [�� ������ ���������� ������������ ������ �� ����� �մϴ�!!]
     * �� ������ �� ��Ʈ �Ʒ��� ���丮 �Ǵ� ���ѵ� ���丮�� �νʽÿ� (��: deny from all �Ӽ��� ���� ����ġ .htaccess ����).
     * �̷��� �䱸 ������ ������Ű�� ���ϸ� ����� ������ ��ȣ���� ���� �� �ֽ��ϴ�.
     * �����ͺ��̽� ���� �̸��� ��ȣ�ϰ� ������� ������ ���������� �ʽ��ϴ�.
     *
     * @var string
	*/
	var $sqlite_database;

    /**
     * �ڵ带 ������ ������� �����ϱ� ���� SQLite �����ͺ��̽��� ����մϴ�.
     * ����: ������ ��� ���˴ϴ�.
	*/
	var $use_sqlite_db;


	//[���� ����� ����]
	//������ ���� �𸣰ڴٸ� �Ʒ��� ���� �� �ʿ䰡 �����ϴ�.

    /**
     * gd �̹��� ���ҽ�.
     *
     * @private ���� ����
     * @var resource
	*/
	var $im;

    /**
     * �������� ���� �ӽ� �̹���
     *
     * @private ���� ����
     * @var resource
	*/
	var $tmpimg;

    /**
     * ��Ƽ �ٸ�� @hkcaptcha�� ���� ���� �μ�
     *
     * @private ���� ����
     * @2.0 ����
     * @var int
	*/
	var $iscale; // ��Ƽ �ٸ�� @hkcaptcha�� ���� ���� �μ�

    /**
     * ��� �̹��� ���ҽ�
     *
     * @2.0 ����
     * @var resource
	*/
	var $bgimg;

    /**
     * ��ũ��Ʈ�� ���� ������ �ڵ�
     *
     * @private ���� ����
     * @var string
	*/
	var $code;

    /**
     * ����ڰ� �Է��� �ڵ�
     *
     * @private ���� ����
     * @var string
	*/
	var $code_entered;

    /**
     * �ùٸ� �ڵ� �Է� ����
     *
     * @private ���� ����
     * @var boolean
	*/
	var $correct_code;

    /**
     * SQLite �����ͺ��̽� �ڵ�
     *
     * @private ���� ����
     * @var resource
	*/
	var $sqlite_handle;

    /**
     * �̹��� �� ������ ���� ���� ���ҽ�
     *
     * @private ���� ����
     * @var int
	*/
	var $gdlinecolor;

    /**
     * ��Ƽ �÷� �ڵ� �� ���� �迭
     *
     * @private ���� ����
     * @var array
	*/
	var $gdmulticolor;

    /**
     * �̹��� �۲� ������ ���� ���� ���ҽ�
     *
     * @private ���� ����
     * @var int
	*/
	var $gdtextcolor;

    /**
     * �̹��� ���� �÷��� ���� ���ҽ�
     *
     * @private ���� ����
     * @var int
	*/
	var $gdsignaturecolor;

    /**
     * �̹��� ������ ���� ���� ���ҽ�
     *
     * @private ���� ����
     * @var int
	*/
	var $gdbgcolor;


    /**
     * Ŭ���� ������.
     * Ŭ������ ������ ����ϱ� ������ ���� ������ ������ ���� ������ �õ��մϴ�.
     * Ŭ������ ȣ���ϱ� ���� ������ �������� ������ ��� ����� �������� ��������
     * ���� �����ڸ� ȣ���ؾ��մϴ�.
     * <code>
     *   $securimage = new Securimage();
     * </code>
     *
	*/
	function Securimage()
	{
		// ���� �ʱ�ȭ �Ǵ� ���� ����
		if ( session_id() == '' ) {
			// ��ȿ�� �˻縦 ���� �ʿ��� ������ ���� ���۵��� �ʾҽ��ϴ�.
			if (trim($this->session_name) != '') {
				session_name($this->session_name); // ���� �̸��� ������ �����մϴ�.
			}
			session_start();
		}

		// ���� ��
		$this->basepath = dirname(__FILE__);

		// �⺻�� ����
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
     * �ڵ带 �����ϰ� �̹����� �������� ����մϴ�.
     *
     * <code>
     *   include 'securimage.php';
     *   $securimage = new Securimage();
     *   $securimage->show('bg.jpg');
     * </code>
     *
     * @�Ķ���� $background_image�� ���ڿ�, CAPTCHA�� ������� ����� �̹����� ���
	*/
	function show($background_image = "")
	{
		if($background_image != "" && is_readable($background_image)) {
			$this->bgimg = $background_image;
		}

		$this->doImage();
	}

    /**
     * ����ڰ� �Է��� �ڵ��� ��ȿ���� �˻��մϴ�.
     *
     * <code>
     *   $code = $_POST['code'];
     *   if ($securimage->check($code) == false) {
     *     die("Sorry, the code entered did not match.");
     *   } else {
     *     $valid = true;
     *   }
     * </code>
     * @�Ķ���� $code�� ���ڿ�, ����ڰ� �Է� �� �ڵ�
     * @boolean ��ȯ, �ڵ尡 ��Ȯ�ϸ� true, �׷��� ������ false
	*/
	function check($code)
	{
		$this->code_entered = $code;
		$this->validate();
		return $this->correct_code;
	}

    /**
     * �������� HTTP ������ִ� ����� ���� ���
     *
     * <code>
     *   $sound = new Securimage();
     *   $sound->audio_format = 'mp3';
     *   $sound->outputAudioFile();
     * </code>
     *
     * @2.0 ����
	*/
	function outputAudioFile()
	{
		if (strtolower($this->audio_format) == 'wav') {
			header('Content-type: audio/x-wav');
			$ext = 'wav';
		}
		else {
			header('Content-type: audio/mpeg'); // mp3�� �⺻ ����
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
     * �̹��� ���� �� ���
     *
     * @private ���� ����
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
			//���� ����
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
     * CAPTCHA �̹����� ���� ��� ���� �Ҵ�
     *
     * @2.0.1 ����
     * @private ���� ����
	*/
	function allocateColors()
	{
		// �̹��� ������ ���� ���� ��� ���� �Ҵ�
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
     * CAPCHA �̹����� ��� ����
     *
     * @private ���� ����
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
     * $background_directory ���� ������ gif, jpg �Ǵ� png�� ��ü ��θ� ��ȯ�մϴ�.
     *
     * @private ���� ����
     * @Securimage::$background_directory �� ���ϴ�
     * @�ƹ��͵� ã�� ���ϸ� false�� ��ȯ�ϰ�, �߰ߵǸ� string $path�� ���������� ��ȯ
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
     * �̹��� ���� ������ curvy ���� �׸��ϴ�.
     * HKCaptcha�� ������ �ڵ�
     *
     * @2.0 ����
     * @private ���� ����
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
     * �̹��� ���� CAPCHA �ڵ带 �׸��ϴ�.
     *
     * @private ���� ����
     *
	*/
	function drawWord()
	{
		$width2 = $this->image_width * $this->iscale;
		$height2 = $this->image_height * $this->iscale;

		if ($this->use_gd_font == true || !is_readable($this->ttf_file)) {
			if (!is_int($this->gd_font_file)) {
				//���� �̸��Դϴ�.
				$font = @imageloadfont($this->gd_font_file);
				if ($font == false) {
					trigger_error("Failed to load GD Font file {$this->gd_font_file} ", E_USER_WARNING);
					return;
				}
			}
			else {
				//gd �۲� �ĺ���
				$font = $this->gd_font_file;
			}

			imagestring($this->im, $font, $this->text_x_start, ($this->image_height / 2) - ($this->gd_font_size / 2), $this->code, $this->gdtextcolor);
		}
		else {
			//ttf �۲�
			$font_size = $height2 * .35;
			$bb = imagettfbbox($font_size, 0, $this->ttf_file, $this->code);
			$tx = $bb[4] - $bb[0];
			$ty = $bb[5] - $bb[1];
			$x  = floor($width2 / 2 - $tx / 2 - $bb[0]);
			$y  = round($height2 / 2 - $ty / 2 - $bb[1]);

			$strlen = strlen($this->code);
			if (!is_array($this->multi_text_color)) $this->use_multi_text = false;


			if ($this->use_multi_text == false && $this->text_angle_minimum == 0 && $this->text_angle_maximum == 0) {
				// ���̳� ���� ������ ���ڰ� ����
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

					// �ʹ� ũ�ų� �ʹ� ���� ������ ������ �ʰ� ���� ���� �����Ͽ� $x�� ������ŵ�ϴ�.
					// �� ���� �ؽ�Ʈ�� �����ϴµ� ���� ������ �۲ø��� �ٸ� �� �ֽ��ϴ�.
					// ������ ���� �ʺ� ���ؼ��� ���� �ؽ�Ʈ �����̳� ���� ������ ������� ���� ��ü ���ڿ��� imagettftext�� ���� �ۼ��˴ϴ�.
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
				//for ����
			}
			// ���� �Ǵ� ��Ƽ �÷�
		}
		//else ttf �۲�
		//$this->im = $this->tmpimg;
		//$this->output();
	}
	//�Լ�

    /**
     * �ؽ�Ʈ�� �ӽ� �̹������� ���� �̹����� �����մϴ�.
     * securimage�� �°� ������
     *
     * @private ���� ����
     * @2.0 ����
     * @���� Han-Kwang Nienhuys ���� ������
     * @���۱� Han-Kwang Neinhuys
     *
	*/
	function distortedCopy()
	{
		$numpoles = 3; // �ְ� ���

		// ������� �迭�� �ϸ� ��Ʈ���� ����Ʈ�� �����.
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

		imagepalettecopy($this->im, $this->tmpimg); // �ؽ�Ʈ ������ ��Ÿ������ �ȷ�Ʈ�� ���� �̹����� �����Ѵ�.

		// $img �ȼ� �̻��� ����, �ְ� �ʵ尡�ִ� $tmpimg�� �ȼ� ���� ����
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
					// ��� �̹����� �����ϱ� ���� ������ �ȼ��� �����Ѵ�.
					imagesetpixel($this->im, $ix, $iy, $c);
				}
			}
		}
	}

    /**
     * �ڵ带 �����ϰ� ���ǿ� �����Ѵ�.
     *
     * @private ���� ����
     * @1.0.1 ����
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
     * �ϳ��� �ڵ带 �����Ѵ�
     *
     * @private ���� ����
     * @�Ķ���� int $len  �ڵ� ����
     * @���ڿ� ��ȯ
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
     * �ܾ� ��� ������ �о� �ڵ带 ����ϴ�.
     *
     * @private ���� ����
     * @1.0.2 ����
     * @���н� ����, ������ �ܾ ���������� ��ȯ
	*/
	function readCodeFromFile()
	{
		$fp = @fopen($this->wordlist_file, 'rb');
		if (!$fp) return false;

		$fsize = filesize($this->wordlist_file);
		if ($fsize < 32) return false; // �ʹ� �۾Ƽ� ȿ���������� �ʴ�.

		if ($fsize < 128) {
			$max = $fsize; // ������ ������ ã���� ������ �����մϴ�.
		}
		else {
			$max = 128;
		}

		fseek($fp, rand(0, $fsize - $max), SEEK_SET);
		$data = fread($fp, 128); // ���Ͽ��� �������� 128 ����Ʈ�� �д´�.
		fclose($fp);
		$data = preg_replace("/\r?\n/", "\n", $data);

		$start = strpos($data, "\n", rand(0, 100)) + 1; // random start position
		$end   = strpos($data, "\n", $start);           // �ܾ��� �� ã��

		return strtolower(substr($data, $start, $end - $start)); // 128 ����Ʈ�� �κ� ���ڿ� ��ȯ
	}

    /**
     * �̹����� �������� ���
     *
     * @private ���� ����
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
     * ���� �ڵ��� WAV �Ǵ� MP3 ���� �����͸� �����ɴϴ�.
     * �̰��� audio/x-wav �Ǵ� audio/mpeg ���� �������� ����ϴ� �� �����մϴ�.
     *
     * @1.0.1 ����
     * @WAV �Ǵ� MP3 ������ ���ڿ��� ��ȯ
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
     * ����� ���丮 ��θ� �����Ѵ�.
     *
     * @1.0.4 ����
     * @bool ��ȯ, ���丮�� ������, ���� ���ִ� ���� true, �׷��� ���� ���� false ��ȯ
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
     * ���ǿ� �ڵ� ����
     *
     * @private ���� ����
     *
	*/
	function saveData()
	{
		$_SESSION['securimage_code_value'] = strtolower($this->code);
		$_SESSION['securimage_code_ctime'] = time();

		$this->saveCodeToDatabase();
	}

    /**
     * ����� �ڵ忡 ���� ��ȿ�� �˻縦 �մϴ�.
     *
     * @private ���� ����
     *
	*/
	function validate()
	{
		// �ڵ尡 ���� ��� ���ǿ��� �ڵ带 �˻��մϴ�. �����Ǵ� ��� sqlite �����ͺ��̽��� Ȯ���Ѵ�.
		$code = '';

		if (isset($_SESSION['securimage_code_value']) && trim($_SESSION['securimage_code_value']) != '') {
			if ($this->isCodeExpired($_SESSION['securimage_code_ctime']) == false) {
				$code = $_SESSION['securimage_code_value'];
			}
		}
		else if ($this->use_sqlite_db == true && function_exists('sqlite_open')) {
			// ���ǿ� �ڵ� ���� - ����ڰ� ��Ű�� ��� �����ߴٴ� ���� �ǹ��� �� ����
			$this->openDatabase();
			$code = $this->getCodeFromDatabase();
		}
		else {
			/* ���� �ڵ尡 ��ȿ���� �ʰų� �������� ������ sqlite db �Ǵ� sqlite���� �ڵ带 ã�� �� �����ϴ�. */
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
     * captcha �ڵ带 ��´�
     *
     * @1.0.1 ����
     * @���ڿ� ��ȯ
	*/
	function getCode()
	{
		if (isset($_SESSION['securimage_code_value']) && !empty($_SESSION['securimage_code_value'])) {
			return strtolower($_SESSION['securimage_code_value']);
		}
		else {
			if ($this->sqlite_handle == false) $this->openDatabase();

			return $this->getCodeFromDatabase(); // �����ͺ��̽����� �������⸦ �õ��ϰ� sqlite�� ����� �� ���ų� ��Ȱ��ȭ �� ��� �� ���ڿ��� ��ȯ�մϴ�.
		}
	}

    /**
     * ����ڰ� �Է��� �ڵ尡 �ùٸ��� Ȯ���Ѵ�.
     *
     * @private ���� ����
     * @boolean ��ȯ
	*/
	function checkCode()
	{
		return $this->correct_code;
	}

    /**
     * ���� ������ �����Ͽ� wav ���� ����
     *
     * @1.0.1 ����
     * @private ���� ����
     * @$letters �Ķ���ʹ� �迭, ������ ���� ���ڵ��� �迭.
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

			$data = fread($fp, filesize($filename)); // ���� ������ �д�

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
				// LIST �����Ͱ� ������ �� �κп� ���ٸ�, �̰��� �Ƹ� ����� ���� ������ ���߸� ���Դϴ�
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
				// ��� ���
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
     * �������� ����� �����͸� �����Ͽ� ���带 ��ũ�����ϰ� ���� �ν��� �����մϴ�.
     * ��� �����͸� �״�� ���� �ξ� ����� ������ "�ջ�" ��Ű�� �ʵ��� �����մϴ�.
     *
     * @2.0 ����
     * @private ���� ����
     * @�Ķ���� $data�� mp3 ������ ���� ������
	*/
	function scrambleAudioData(&$data, $format)
	{
		if ($format == 'wav') {
			$start = strpos($data, 'data') + 4; // "������" ǥ�� ��ġ�� ã���ϴ�.
			if ($start === false) $start = 44;  // 44 ����Ʈ ����� �������� ���� ���
		}
		else {
			// mp3
			$start = 4; // 4 ����Ʈ (32 ��Ʈ) ������ ���
		}

		$start  += rand(1, 64); // ������ ���� ������
		$datalen = strlen($data) - $start - 256; // ������ 256 ����Ʈ�� �������� �ʰ� ���� �Ӵϴ�.

		for ($i = $start; $i < $datalen; $i += 64) {
			$ch = ord($data{$i});
			if ($ch < 9 || $ch > 119) continue;

			$data{$i} = chr($ch + rand(-8, 8));
		}
	}

    /**
     * ���� ������ �����Ͽ� mp3 ���� ����
     * @1.0.4 ����
     * @private ���� ����
     * @�Ķ���� $letters�� �迭, ������ ���� ���� �迭
     * @MP3 ���� ����Ÿ ���ڿ� ��ȯ
	*/
	function generateMP3($letters)
	{
		$data_len    = 0;
		$files       = array();
		$out_data    = '';

		foreach ($letters as $letter) {
			$filename = $this->audio_path . strtoupper($letter) . '.mp3';

			$fp   = fopen($filename, 'rb');
			$data = fread($fp, filesize($filename)); // ���� ������ �д´�

			$this->scrambleAudioData($data, 'mp3');
			$out_data .= $data;

			fclose($fp);
		}


		return $out_data;
	}

    /**
     * 1���� ���� ���� ����
     * @2.0 ����
     * @private ���� ����
     * @�Ǽ� ��ȯ
	*/
	function frand()
	{
		return 0.0001*rand(0,9999);
	}

    /**
     * �̹����� ���� �ؽ�Ʈ �μ�
     *
     * @2.0 ����
     * @private ���� ����
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
     * ���� ������� �ؽ��� IP �ּ� ���
     *
     * @private ���� ����
     * @2.0.1 ����
     * @���ڿ� ��ȯ
	*/
	function getIPHash()
	{
		return strtolower(md5($_SERVER['REMOTE_ADDR']));
	}

    /**
     * SQLite �����ͺ��̽� ����
     *
     * @private ���� ����
     * @2.0.1 ����
     * @bool ��ȯ, ����Ÿ���̽��� ���������� ���µ��� ���� true
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
     * CAPCHA �ڵ带 sqlite �����ͺ��̽��� ����
     *
     * @private ���� ����
     * @2.0.1 ����
     * @bool ��ȯ, �ڵ尡 save�� ���� true, �׷��� ���� ���� false
	*/
	function saveCodeToDatabase()
	{
		$success = false;

		$this->openDatabase();

		if ($this->use_sqlite_db && $this->sqlite_handle !== false) {
			$ip = $this->getIPHash();
			$time = time();
			$code = $_SESSION['securimage_code_value']; // ���� �ؽ� �ڵ� - ��Ű�� ��Ȱ��ȭ�� ��� ������ �� �������� ��� �����մϴ�.
			$success = sqlite_query($this->sqlite_handle, "INSERT OR REPLACE INTO codes(iphash, code, created) VALUES('$ip', '$code', $time)");
		}

		return $success !== false;
	}

    /**
     * IP �ּ� �ؽø� ������� sqlite �����ͺ��̽����� ����� captcha �ڵ� ���� ����
     *
     * @private ���� ����
     * @2.0.1 ����
     * @captcha �ڵ� ���ڿ� ��ȯ
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
     * IP �ּ� �ؽ÷� �����ͺ��̽����� code ����
     *
     * @private ���� ����
     * @2.0.1 ����
	*/
	function clearCodeFromDatabase()
	{
		if ($this->sqlite_handle !== false) {
			$ip = $this->getIPHash();

			sqlite_query($this->sqlite_handle, "DELETE FROM codes WHERE iphash = '$ip'");
		}
	}

    /**
     * �����ͺ��̽����� �Ϸ� ���� �ڵ� ����
     *
     * @private ���� ����
     * @2.0.1 ����
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
     * ���� �ð��� ���� �ڵ尡 ����Ǿ����� Ȯ���Ѵ�.
     *
     * @private ���� ����
     * @2.0.1 ����
     * @�Ķ���� $creation_time �� �ڵ� ���� �ð��� ���н� Ÿ�� ������
     * @bool ��ȯ, �ڵ尡 ����� ��� true, �׷��� ���� ��� false
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
/* Securimage Ŭ���� */


/**
 * Securimage CAPTCHA�� ���� ��ü
 *
 * @2.0 ����
 * @package Securimage
 * @subpackage Ŭ������
 *
*/
class Securimage_Color {
    /**
     * ������ ���� ��� : 0-255
     *
     * @var int
	*/
	var $r;
    /**
     * �ʷϻ� ���� ��� : 0-255
     *
     * @var int
	*/
	var $g;
    /**
     * �Ķ��� ���� ��� : 0-255
     *
     * @var int
	*/
	var $b;

    /**
     * �� Securimage_Color ��ü�� ����ϴ�.
     * HTML 16���� �ڵ带 ����Ͽ� ����, ��� �� �Ķ� ���� ��Ҹ� �����մϴ�.
     * �� : HTML #4A203C�� �ڵ�� ������ �����ϴ�.
     * $color = new Securimage_Color(0x4A, 0x20, 0x3C);
     *
     * @�Ķ���� $red�� ������ ���� ��� 0-255
     * @�Ķ���� $green�� �ʷϻ� ���� ��� 0-255
     * @�Ķ���� $blue�� �Ķ��� ���� ��� 0-255
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
