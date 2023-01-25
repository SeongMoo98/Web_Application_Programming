<!DOCTYPE html>

<!-- Fig. 19.9: expression.php -->
<!-- Regular expressions. -->
<html>
   <head>
      <meta charset = "utf-8">
      <title>Regular expressions</title>
      <style type = "text/css">
         p { margin: 0; }
      </style>
   </head>
   <body>
        <?php
            $search = "Now is the time";
            print("<p>Test string is : '$search'</p>");

            // Call preg_match to search for pattern 'Now' in variable search
            if(preg_match("/Now/", $search))
                print("<p>'Now' waw found.</p>");
            
            // Search for pattern 'Now' in the beginning of the string
            if(preg_match("/^Now/", $search))
                print("<p>'Now' found at beginning of the line.</p>");

            // Search for pattern 'Now' at the end of the string
            if( ! preg_match("/'Now$'/", $search))
                print("<p>'Now' was not found at the end of the line.</p>");

            // Search for any word ending in 'ow'
            // \b : 공백이나 탭 단위 ==> 단어 기준
            // $match : 찾은 문자열은 받는 매개변수
            // $match[0] : 찾은 문자열 전체
            if( preg_match("/\b([a-zA-Z]*ow)\b/i", $search, $match)){
                print("<p>Word found ending in ow : ".$match[1]."</p>");
            }

            // Search for any words beginning with 't'
            print("<p>Words beginning with 't' found : ");

            while(preg_match("/\b(t[[:alpha:]]+)\b/i", $search, $match)){
                print($match[1].", ");

                // Remove the first occurrence of a word beginning
                // with 't' to find other instances in the string
                $search = preg_replace("/".$match[1]."/", "", $search);
            }
            print("</p>");
        ?>
   </body>

</html>