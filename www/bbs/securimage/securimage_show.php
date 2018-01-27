<?php

/**
 * 프로젝트:    Securimage: 양식 CAPTCHA 이미지를 만들고 관리하기위한 PHP 클래스
 * 파일:        securimage_show.php
 *
 * 이 라이브러리는 무료 소프트웨어입니다. 당신은 그것을 재배포 할 수 있습니다.
 * GNU 약소 일반 범용의 조건에 따라 수정하십시오.
 * 자유 소프트웨어 재단이 발행 한 라이센스. 어느 한 쪽
 * 라이센스 버전 2.1 또는 이후 버전.
 *
 * 이 라이브러리는 유용 할 것이라는 희망으로 배포되었습니다.
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
 * @저자 drew010 <drew@drew-phillips.com>
 * @version 2.0.1 BETA (December 6th, 2009)
 * @Securimage 패키지
 *
 */

include 'securimage.php';

$img = new securimage();

// 일부 설정을 변경한다

//$img->image_width = 275;
//$img->image_height = 90;
//$img->perturbation = 0.9; // 1.0 = 고 왜곡, 높은 수 = 더 많은 왜곡
//$img->image_bg_color = new Securimage_Color("#0099CC");
//$img->text_color = new Securimage_Color("#EAEAEA");
//$img->text_transparency_percentage = 65; // 100 = 완전 투명
//$img->num_lines = 8;
//$img->line_color = new Securimage_Color("#0000CC");
//$img->signature_color = new Securimage_Color(rand(0, 64), rand(64, 128), rand(128, 255));
//$img->image_type = SI_IMAGE_PNG;


$img->show(); // 대체 용법: $img->show('/path/to/background_image.jpg');
