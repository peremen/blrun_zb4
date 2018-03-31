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
$img->image_width = 280;
$img->image_height = 100;
$img->perturbation = 0.9;
$img->code_length = rand(5,6);
$img->image_bg_color = new Securimage_Color("#ffffff");
$img->use_transparent_text = true;
$img->text_transparency_percentage = 75; // 100 = ���� ����
$img->num_lines = 15;
$img->image_signature = '';
$img->text_color = new Securimage_Color("#000000");
$img->line_color = new Securimage_Color("#cccccc");

$img->show(''); // ��ü ���: $img->show('/path/to/background_image.jpg');

