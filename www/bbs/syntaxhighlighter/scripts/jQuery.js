/* jQuery 부분  */
jQuery(document).ready(function(){  // 문서가 모두 읽힌 후에 다음을 실행
    jQuery("blockquote").each( function() {  //blokquote를 사용한 태그
        var class_attr = jQuery(this).attr('class');
        if (class_attr && class_attr.substr(0,5)=='brush')
        // 그중 클래스명이 brush로 시작하는 것을 찾아 적용
        {
            var temp = jQuery(this).html(); //  내용 복사
            temp = temp.replace(/\n/gi, "");
            temp = temp.replace(/<br \/>/gi, "\n");
            /* 다음 세 줄은 환경 설정 > 기타 설정 > 글쓰기 환경 > 엔터키 설정 > 
           <p>문단 바꿈 (Shift+Enter시 줄 바꿈) 을 선택했을 때 필요한 코드이다. */
            temp = temp.replace(/<BR>/gi, "\n");
            temp = temp.replace(/<P>/gi, "");
            temp = temp.replace(/<\/P>/gi, "\n");
            //temp = '<pre class="'+ jQuery(this).attr('class') + '">'+temp+'</pre>'
            temp = '<script type="syntaxhighlighter" class="'+ jQuery(this).attr('class') + '"><![CDATA['+temp+']]><\/script>'
            jQuery(this).after(temp);
            // 뒤에 새로 작성된 pre 또는 script 태그로 붙인다.
            jQuery(this).remove(); //  기존의 인용태그 삭제
        }
    });
  
    jQuery("pre").each( function() {  //pre를 사용한 태그
        var class_attr = jQuery(this).attr('class');
        if (class_attr && class_attr.substr(0,5)=='brush')
        // 그중 클래스명이 brush로 시작하는 것을 찾아 적용
        {
            var temp = jQuery(this).html(); //  내용 복사
            temp = temp.replace(/</g, "&lt;");
            jQuery(this).html = temp;
        }
    });
      
/*  SyntaxHighlighter autoloader  */
//<![CDATA[
SyntaxHighlighter.autoloader(
  'applescript            syntaxhighlighter/scripts/shBrushAppleScript.js',
  'actionscript3 as3      syntaxhighlighter/scripts/shBrushAS3.js',
  'bash shell             syntaxhighlighter/scripts/shBrushBash.js',
  'coldfusion cf          syntaxhighlighter/scripts/shBrushColdFusion.js',
  'cpp c                  syntaxhighlighter/scripts/shBrushCpp.js',
  'c# c-sharp csharp      syntaxhighlighter/scripts/shBrushCSharp.js',
  'css                    syntaxhighlighter/scripts/shBrushCss.js',
  'delphi pas pascal      syntaxhighlighter/scripts/shBrushDelphi.js',
  'diff patch             syntaxhighlighter/scripts/shBrushDiff.js',
  'erl erlang             syntaxhighlighter/scripts/shBrushErlang.js',
  'groovy                 syntaxhighlighter/scripts/shBrushGroovy.js',
  'java                   syntaxhighlighter/scripts/shBrushJava.js',
  'jfx javafx             syntaxhighlighter/scripts/shBrushJavaFX.js',
  'js jscript javascript  syntaxhighlighter/scripts/shBrushJScript.js',
  'perl pl                syntaxhighlighter/scripts/shBrushPerl.js',
  'php                    syntaxhighlighter/scripts/shBrushPhp.js',
  'text plain             syntaxhighlighter/scripts/shBrushPlain.js',
  'ps powershell          syntaxhighlighter/scripts/shBrushPowerShell.js',
  'py python              syntaxhighlighter/scripts/shBrushPython.js',
  'ruby rails ror rb      syntaxhighlighter/scripts/shBrushRuby.js',
  'sass scss              syntaxhighlighter/scripts/shBrushSass.js',
  'scala                  syntaxhighlighter/scripts/shBrushScala.js',
  'sql                    syntaxhighlighter/scripts/shBrushSql.js',
  'vb vbnet               syntaxhighlighter/scripts/shBrushVb.js',
  'xml xhtml xslt html    syntaxhighlighter/scripts/shBrushXml.js'
  );      
//]]> 
    /*  SyntaxHighlighter 사용부분  */
    SyntaxHighlighter.defaults['toolbar'] = false; // 툴바 안 보기
    SyntaxHighlighter.all();
});