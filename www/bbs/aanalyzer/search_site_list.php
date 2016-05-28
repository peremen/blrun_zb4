<?php
$search_site_list = array(
	'google'		=> array(	'site_regex'	=>'google.',
								'query_param'	=>'q=',
								'first_convert_encoding_code' => 'UTF-8'),
	'daum'			=> array(	'site_regex'	=>'search.daum.net',
								'query_param'	=>'q=',
								'first_convert_encoding_code' => 'EUC-KR'
								),
								//pq=? ...이건 머야?
	'nate'			=> array(	'site_regex'	=>'search.nate.com',
								'query_param'	=>'query=',
								'first_convert_encoding_code' => 'EUC-KR'
								),

	'yahoo'			=> array(	'site_regex'	=>'search.yahoo.com',
								'query_param'	=>'p=',
								'first_convert_encoding_code' => 'UTF-8'
								),
	'msn'			=> array(	'site_regex'	=>'search.msn',
								'query_param'	=>'q=',
								'first_convert_encoding_code' => 'UTF-8'
								),	// jp 하고 kr 이 조금...불안...
	'naver'			=> array(	'site_regex'	=>'search.naver.com',
								'query_param'	=>'query=',
								'first_convert_encoding_code' => 'EUC-KR'
								),	 //로컬에서 확인
	'empas'			=> array(	'site_regex'	=>'search.empas.com',
								'query_param'	=>'q=',
								'first_convert_encoding_code' => 'EUC-KR'
								),	// 로컬에서 확인
	'1noon'			=> array(	'site_regex'	=>'1noon.com',
								'query_param'	=>'q=',
								'first_convert_encoding_code' => 'EUC-KR'
								),
	'lycos.com'		=> array(	'site_regex'	=>'search.lycos.com',
								'query_param'	=>'query=',
								'first_convert_encoding_code' => 'UTF-8'
								), //로컬에서 확인
	'lycos.co.kr'	=> array(	'site_regex'	=>'lycos.co.kr',
								'query_param'	=>'q=',
								'first_convert_encoding_code' => 'UTF-8'
								), // 미확인.
	'altavista'		=> array(	'site_regex'	=>'altavista.com',
								'query_param'	=>'q=',
								'first_convert_encoding_code' => 'UTF-8'
								), // kr ,com 같음

	
	'search.yahoo.co.jp'			=> array(	'site_regex'	=>'search.yahoo.co.jp',
								'query_param'	=>'p=',
								'first_convert_encoding_code' => 'EUC-JP'
								),// 로컬에서 확인
	'biglobe'		=> array(	'site_regex'	=>'search.biglobe.ne.jp',
								'query_param'	=>'q=',		// 2006-04-24 조사 자료랑 다르네..-,.-
								'first_convert_encoding_code' => 'SHIFT-JIS'
								),// 로컬에서 확인
	'goo.ne.jp'		=> array(	'site_regex'	=>'search.goo.ne.jp',
								'query_param'	=>'MT=',
								'first_convert_encoding_code' => 'EUC-JP'
								),// 로컬에서 확인
	'hatena'		=> array(	'site_regex'	=>'search.hatena.ne.jp',
								'query_param'	=>'word=',
								'first_convert_encoding_code' => 'UTF-8'
								),// 로컬에서 확인
	'iscle.com'		=> array(	'site_regex'	=>'iscle.com',
								'query_param'	=>'word=',
								'first_convert_encoding_code' => 'UTF-8'
								),// 미확인.

	'infoseek'		=> array(	'site_regex'	=>'infoseek.co.jp',
								'query_param'	=>'qt=',
								'first_convert_encoding_code' => 'EUC-JP'
								),// 로컬에서 확인
	'livedoor'		=> array(	'site_regex'	=>'search.livedoor.com',
								'query_param'	=>'q=',
								'first_convert_encoding_code' => 'EUC-JP'
								),// 로컬에서 확인
	'fresheye'		=> array(	'site_regex'	=>'search.fresheye.com',
								'query_param'	=>'qt=',
								'first_convert_encoding_code' => 'UTF-8'
								),// 미확인.
	'technorati.jp'	=> array(	'site_regex'	=>'technorati.jp',
								'query_param'	=>'query=',
								'first_convert_encoding_code' => 'UTF-8'
								),// 미확인.
	'technorati.com'=> array(	'site_regex'	=>'technorati.com',
										'query_param'	=>'query=',
								'first_convert_encoding_code' => 'UTF-8'
								),
										//search/ 디렉토리 뒤에 쿼리
/*
Yahoo! 258  66.83% 
2 Google (JP) 72  18.65% 
3 Google (US) 22  5.69% 
4 MSNサーチ 12  3.1% 
5 goo 9  2.33% 
6 Yahoo! 英語 2  0.51% 
7 @nifty 2  0.51% 
8 excite 2  0.51% 
9 DION 



%INI_change_ref = (
	'http://dion.excite.co.jp/search.gw'=>'EXCITE',
	'http://odn.excite.co.jp/search.gw'=>'EXCITE',
	'http://www.excite.co.jp/search.gw'=>'EXCITE',
	'http://home.excite.co.jp/search.gw'=>'EXCITE',
	'http://apple.excite.co.jp/search.gw'=>'EXCITE',
	'http://search.fresheye.com/'=>'FRESHEYE',
	'http://ask.jp/web.asp'=>'ASK.JP',
	'http://search.msn.co.jp/results.aspx'=>'MSN',
	'http://www.alltheweb.com/search'=>'AllTheWeb',

	'http://search.goo.ne.jp/web.jsp'=>'goo',
	'http://search.nifty.com/cgi-bin/search.cgi'=>'NIFTY',
	'http://aolsearch.jp.aol.com/search'=>'AOL',
	'http://search.jp.aol.com/search'=>'AOL',
	'http://ocnsearch.goo.ne.jp/ocn.jsp'=>'OCN',



*/

	);
?>
