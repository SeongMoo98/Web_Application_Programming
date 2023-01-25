<!DOCTYPE html>

<!-- Fig. 19.3: data.php -->
<!-- Data type conversion. -->
<html>
<html>
   <head>
      <meta charset = "utf-8">
      <title>Data type conversion</title>
      <style type = "text/css">
         p      { margin: 0; }
         .head  { margin-top: 10px; font-weight: bold; }
         .space { margin-top: 10px; }
      </style>
    </head>
<body>
    <?php
        // 변수 선언
        $testString = "3.5 seconds 132";
        $testDouble = 79.2;
        $testInteger = 12;
    ?>

    <p class="head">Original values</p>

    <?php
        print("<p>$testString is a(n) ".gettype( $testString )."</p>");  
        print("<p>$testDouble is a(n) ".gettype( $testDouble )."</p>");  
        print("<p>$testInteger is a(n) ".gettype( $testInteger )."</p>");  
    ?>

    <p class = "head">Converting to other data types:</p>

    <?php
        // call function settype to convert variable
        // testString to different data types
        print("<p>$testString ");
        // string을 double로 바꿀 수 없어서 숫자를 제외한 나머지는 버려버린다
        // 맨 뒤 숫자도 버림
        settype($testString, "double");
        print( " as a double is $testString</p>" );

        print("<p>$testString ");
        settype($testString, "integer");
        print( " as a integer is $testString</p>" );

        settype($testString, "string");
        print( "<p class ='space'>Converting back to a string results in 
            $testString</p>" );

         // use type casting to cast variables to a different type 
         $data = "98.6 degrees";
         print("<p class = 'space>Before casting : $data is a ".gettype($data)."</p>");
         print( "<p class = 'space'>Using type casting instead:</p>
            <p>as a double: " . (double) $data . "</p>" .
            "<p>as an integer: " . (integer) $data . "</p>" );
         print( "<p class = 'space'>After casting: $data is a " . 
            gettype( $data ) . "</p>" );  ;
    ?>
</body>
</html>