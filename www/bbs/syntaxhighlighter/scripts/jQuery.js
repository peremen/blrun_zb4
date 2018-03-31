/* jQuery �κ�  */
jQuery(document).ready(function(){  // ������ ��� ���� �Ŀ� ������ ����
    jQuery("blockquote").each( function() {  //blokquote�� ����� �±�
        var class_attr = jQuery(this).attr('class');
        if (class_attr && class_attr.substr(0,5)=='brush')
        // ���� Ŭ�������� brush�� �����ϴ� ���� ã�� ����
        {
            var temp = jQuery(this).html(); //  ���� ����
            temp = temp.replace(/\n/gi, "");
            temp = temp.replace(/<br \/>/gi, "\n");
            /* ���� �� ���� ȯ�� ���� > ��Ÿ ���� > �۾��� ȯ�� > ����Ű ���� > 
           <p>���� �ٲ� (Shift+Enter�� �� �ٲ�) �� �������� �� �ʿ��� �ڵ��̴�. */
            temp = temp.replace(/<BR>/gi, "\n");
            temp = temp.replace(/<P>/gi, "");
            temp = temp.replace(/<\/P>/gi, "\n");
            //temp = '<pre class="'+ jQuery(this).attr('class') + '">'+temp+'</pre>'
            temp = '<script type="syntaxhighlighter" class="'+ jQuery(this).attr('class') + '"><![CDATA['+temp+']]><\/script>'
            jQuery(this).after(temp);
            // �ڿ� ���� �ۼ��� pre �Ǵ� script �±׷� ���δ�.
            jQuery(this).remove(); //  ������ �ο��±� ����
        }
    });
  
    jQuery("pre").each( function() {  //pre�� ����� �±�
        var class_attr = jQuery(this).attr('class');
        if (class_attr && class_attr.substr(0,5)=='brush')
        // ���� Ŭ�������� brush�� �����ϴ� ���� ã�� ����
        {
            var temp = jQuery(this).html(); //  ���� ����
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
    /*  SyntaxHighlighter ���κ�  */
    SyntaxHighlighter.defaults['toolbar'] = false; // ���� �� ����
    SyntaxHighlighter.all();
});