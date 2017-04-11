<?php
//robot list
$robot_list = array(
	"1noonbot",
	"achttp component",
	"allblog.net rsssync",
	"ask jeeves/teoma",
	"baiduspider",			//Baiduspider+(+http://www.baidu.com/search/spider.htm)
	"becomebot",				//2006-03-21 added.
	"blogkorea",
	"bloglines",				//Bloglines/3.0-rho (http://www.bloglines.com)
	"dead link checker",
//	"digext",				//TODO 이건 좀 검토해봐야할거 같은데...확실히 어떤넘인지 알수가 없네. 크롤러라는 설은 여기저기 돌지만...
	"dloader",
	"dsrobot",
	"empas.robot",
	"eolin",					//Eolin   Mozilla/4.0 (compatible; Eolin)
	"faxobot",
	"feedchecker",
	"feedfetcher-google",	//Feedfetcher-Google; (+http://www.google.com/feedfetcher.html)
	"gamespyhttp",
	"gigabot",
	"girafabot",
	"googlebot",
	"grub-client",
	"hatena antenna",
	"hmse_robot",
	"ichiro",		//ichiro/1.0 (ichiro@nttr.co.jp)
					//ichiro/2.0 (http://help.goo.ne.jp/door/crawler.html)
					//ichiro/2.0 (ichiro@nttr.co.jp)
	"ip*works!",
	"ia_archiver",
	"Java/1.",
	"jambot",
	"keegeebot",
	"livechecksites",
	"minirank",
	"mirror checking",
	"mj12bot",
	"msnbot",
	"naverbot",
	"nextopiabOT",
	"nutchcvs",	//NutchCVS/0.7.1 (Nutch; http://lucene.apache.org/nutch/bot.html; nutch-agent@lucene.apache.org)
	"php version tracker ",
	"plantynet_webrobot",
	"proodlebot",
	"psbot",
	"python-urllib",
	"safaribookmarkchecker",
	"slurp",
	"surveybot",
	"shim-crawler",
	"scooter",
	"scspider",
	"tutorgigbot",
	"vermut",
	"vespa crawler",
	"wapsearch",
	"w3c_validator",
	"wget",
	"wisebot",	//WISEbot/1.0 (WISEbot@wisenut.co.kr; http://wisebot.wisenut.co.kr)
					//WISEbot/1.0 (WISEbot@koreawisenut.com; http://wisebot.koreawisenut.com)
	"yottashopping_bot",
	"yahoo-mmcrawler",
	"yahoo! de slurp",
	"yahoo! slurp",
	"zealbot",
	"zyborg",
	);




$bot_detailed_info = array(
	'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)'
		=>	array(	'name'		=> 'Yahoo! Slurp',
							'bot_url'		=> 'http://help.yahoo.com/help/us/ysearch/slurp',
							'version'	=> ''
							),
	'msnbot/1.0 (+http://search.msn.com/msnbot.htm)'
		=>	array(	'name'		=> 'MSN Bot',
							'bot_url'		=> 'http://search.msn.com/msnbot.htm',
							'version'	=> '1.0'
							),
	'msnbot/1.0 (+http://search.msn.com/msnbot.htm)'
		=>	array(	'name'		=> 'MSN Bot',
							'bot_url'		=> 'http://search.msn.com/msnbot.htm',
							'version'	=> '1.0'
							),
	'msnbot/0.9 (+http://search.msn.com/msnbot.htm)'
		=>	array(	'name'		=> 'MSN Bot',
							'bot_url'		=> 'http://search.msn.com/msnbot.htm',
							'version'	=> '0.9'
							),
	'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)'
		=>	array(	'name'		=> 'Googlebot',
							'bot_url'		=> 'http://www.google.com/bot.html',
							'version'	=> '2.1'
							),
	'Gigabot/2.0/gigablast.com/spider.html'
		=>	array(	'name'		=> 'Gigabot',
							'bot_url'		=> 'http://gigablast.com/spider.html',
							'version'	=> '2.0'
							),
	'Mozilla/5.0 (compatible; BecomeBot/3.0; MSIE 6.0 compatible; +http://www.become.com/site_owners.html)'
		=>	array(	'name'		=> 'BecomeBot',
							'bot_url'		=> 'http://www.become.com/site_owners.html',
							'version'	=> '3.0'
							),
	'EMPAS.ROBOT (compatible; MSIE 5.01; Windows NT 5.0)'
		=>	array(	'name'		=> 'EMPAS.ROBOT',
							'bot_url'		=> '',
							'version'	=> ''
							),
	'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0; 1Noonbot 1.0 mailto:sc_1noonbot@1nooncorp.com)'
		=>	array(	'name'		=> '1Noonbot',
							'bot_url'		=> '',
							'version'	=> '1.0'
							),
	'NutchCVS/0.8-dev (Nutch running at UW; http://www.nutch.org/docs/en/bot.html; sycrawl@cs.washington.edu)'
		=>	array(	'name'		=> 'NutchCVS',
							'bot_url'		=> 'http://www.nutch.org/docs/en/bot.html',
							'version'	=> '0.8-dev'
							),
	'WISEbot/1.0 (WISEbot@wisenut.co.kr; http://wisebot.wisenut.co.kr)'
		=>	array(	'name'		=> 'WISEbot(1st)',
							'bot_url'		=> 'http://wisebot.wisenut.co.kr',
							'version'	=> '1.0'
							),
	'WISEbot/1.0 (WISEbot@koreawisenut.com; http://wisebot.koreawisenut.com)'
		=>	array(	'name'		=> 'WISEbot(2nd)',
							'bot_url'		=> 'http://wisebot.koreawisenut.com',
							'version'	=> '1.0'
							),
	'Feedfetcher-Google; (+http://www.google.com/feedfetcher.html)'
		=>	array(	'name'		=> 'Feedfetcher-Google',
							'bot_url'		=> 'http://www.google.com/feedfetcher.html',
							'version'	=> ''
							),
	'NaverBot-1.0 (NHN Corp. / +82-31-784-1989 / nhnbot@naver.com)'
		=>	array(	'name'		=> 'NaverBot',
							'bot_url'		=> '',
							'version'	=> '1.0'
							),
	'dloader(NaverRobot)/1.0'
		=>	array(	'name'		=> 'NaverRobot dloader',
							'bot_url'		=> '',
							'version'	=> '1.0'
							),
	'Allblog.net RssSync4 (I Love Bluecat)'
		=>	array(	'name'		=> 'Allblog.net RssSync4',
							'bot_url'		=> '',
							'version'	=> ''
							),
	'MJ12bot/v1.0.7 (http://majestic12.co.uk/bot.php?+)'
		=>	array(	'name'		=> 'MJ12bot',
							'bot_url'		=> 'http://majestic12.co.uk/bot.php',
							'version'	=> '1.0.7'
							),
	'ichiro/2.0 (http://help.goo.ne.jp/door/crawler.html)'
		=>	array(	'name'		=> 'ichiro',
							'bot_url'		=> 'http://help.goo.ne.jp/door/crawler.html',
							'version'	=> '2.0'
							),
	'SurveyBot/2.3 (Whois Source)'
		=>	array(	'name'		=> 'SurveyBot',
							'bot_url'		=> '',
							'version'	=> '2.3'
							),

//Mozilla/4.0 (compatible; MSIE 5.5; Windows 98; DigExt)

				);


$adding_list = array(
"",		//Eolin   Mozilla/4.0 (compatible; Eolin)
);
?>
