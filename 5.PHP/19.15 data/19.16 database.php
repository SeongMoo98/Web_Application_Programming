<!DOCTYPE html>

<!-- Fig. 19.16: database.php -->
<!-- Querying a database and displaying the results. -->
<html>

<head>
    <meta charset="utf-8">
    <title>Search Results</title>
    <style type="text/css">
    body {
        font-family: sans-serif;
        background-color: lightyellow;
    }
    table {
        background-color: lightblue;
        border-collapse: collapse;
        border: 1px solid gray;
    }
    td {
        padding: 5px;
    }
    tr:nth-child(odd) {
        background-color: white;
    }
    </style>
</head>

<body>
    <?php          
        $select = $_POST["select"];
        
        $query = "SELECT ".$select." FROM books";
       
        
        // MySQL 연결                   
        if( !( $database = mysqli_connect("localhost:3307","root","tjdan34")))
            die("Could not connect to database </body></html>");

        
        // Open "products" database
        if( !mysqli_select_db($database, "products"))
            die("Could not open products database</body></html>");

        //Query "products" database
        if( !( $result = mysqli_query($database, $query) ) ){
            print("<p>Could not execute query!</p>");
            die(mysqli_error($database)."</body></html>");
        }
        mysqli_close($database);
    ?>

    <table>
        <caption>Results of "SELECT <?php print("$select"); ?> FROM books"</caption>

        <?php
            // Fetch each record in result set
            while( $row = mysqli_fetch_row($result)){
                print("<tr>");

                foreach( $row as $value){
                    print("<td>$value</td>");
                }

                print("</tr>");
            }
        ?>
    </table>

    <p>Your search yielded <?php print(mysqli_num_rows($result)) ?> results.</p>
    <p>Please email comments to <a href="mailto:deitel@deitel.com">Deitel and Associates, Inc.</a></p>
    

</body>

</html>