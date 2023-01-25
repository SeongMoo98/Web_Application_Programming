<!DOCTYPE html>

<!-- Fig. 19.8: compare.php -->
<!-- Using the string-comparison operators. -->
<html>

<head>
    <meta charset="utf-8">
    <title>String Comparison</title>
    <style type="text/css">
    p {
        margin: 0;
    }
    </style>
</head>

<body>
    <?php
        $fruits = array("apple", "orange", "banana");

        for($i = 0; $i < count($fruits); $i++){
            // call function strcmp to compare the array element
            // to string "banana"
            if(strcmp($fruits[$i], "banana") < 0)
                print("<p>".$fruits[$i]." is less than banana");
            elseif ( strcmp( $fruits[ $i ], "banana" ) > 0 ) 
                print( "<p>".$fruits[ $i ]." is greater than banana " );
            else 
                print( "<p>".$fruits[ $i ]." is equal to banana " );

            // use relational operators to compare each element
            //to string "apple"
            if ( $fruits[ $i ] < "apple" )     
                print( " and less than apple!</p>" );
            elseif ( $fruits[ $i ] > "apple" ) 
                print( " and greater than apple!</p>" );
            elseif ( $fruits[ $i ] == "apple" )
                print( " and equal to apple!</p>" );
        }

        
    ?>
</body>


</html>