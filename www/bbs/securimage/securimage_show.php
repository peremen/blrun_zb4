<?php

/**
 * ������Ʈ:    Securimage: ��� CAPTCHA �̹����� ����� �����ϱ����� PHP Ŭ����
 * ����:        securimage_show.php
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
 * @���� drew010 <drew@drew-phillips.com>
 * @version 2.0.1 BETA (December 6th, 2009)
 * @Securimage ��Ű��
 *
 */

include 'securimage.php';

$img = new securimage();

// �Ϻ� ������ �����Ѵ�

//$img->image_width = 275;
//$img->image_height = 90;
//$img->perturbation = 0.9; // 1.0 = �� �ְ�, ���� �� = �� ���� �ְ�
//$img->image_bg_color = new Securimage_Color("#0099CC");
//$img->text_color = new Securimage_Color("#EAEAEA");
//$img->text_transparency_percentage = 65; // 100 = ���� ����
//$img->num_lines = 8;
//$img->line_color = new Securimage_Color("#0000CC");
//$img->signature_color = new Securimage_Color(rand(0, 64), rand(64, 128), rand(128, 255));
//$img->image_type = SI_IMAGE_PNG;


$img->show(); // ��ü ���: $img->show('/path/to/background_image.jpg');
