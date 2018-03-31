<?php

/**
 * ������Ʈ:    Securimage: Form CAPTCHA �̹����� ����� �����ϱ����� PHP Ŭ����
 * ����:        securimage_show_example.php
 *
 * �� ���̺귯���� ���� ����Ʈ�����Դϴ�. ����� �װ��� ����� �� �� �ֽ��ϴ�.
 * GNU ��� �Ϲ� ������ ���ǿ� ���� �����Ͻʽÿ�.
 * ���� ����Ʈ���� ����� ���� �� ���̼���. ��� �� ��
 * ���̼��� ���� 2.1 �Ǵ� ���� ����.
 *
 * �� ���̺귯���� ���� �� ���̶�� ������� �����Ǿ����ϴ�.
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
 * @���� Drew Phillips <drew@drew-phillips.com>
 * @version 2.0.1 BETA (December 6th, 2009)
 * @Securimage ��Ű��
 *
 */

include 'securimage.php';

$img = new securimage();

//�Ϻ� ���� ����
$img->image_width = 250;
$img->image_height = 80;
$img->perturbation = 0.85;
$img->image_bg_color = new Securimage_Color("#f6f6f6");
$img->multi_text_color = array(new Securimage_Color("#3399ff"),
                               new Securimage_Color("#3300cc"),
                               new Securimage_Color("#3333cc"),
                               new Securimage_Color("#6666ff"),
                               new Securimage_Color("#99cccc")
                               );
$img->use_multi_text = true;
$img->text_angle_minimum = -5;
$img->text_angle_maximum = 5;
$img->use_transparent_text = true;
$img->text_transparency_percentage = 30; // 100 = ���� ����
$img->num_lines = 7;
$img->line_color = new Securimage_Color("#eaeaea");
$img->image_signature = 'phpcaptcha.org';
$img->signature_color = new Securimage_Color(rand(0, 64), rand(64, 128), rand(128, 255));
$img->use_wordlist = true;

$img->show('backgrounds/bg3.jpg'); // ��ü ���: $img->show('/path/to/background_image.jpg');

