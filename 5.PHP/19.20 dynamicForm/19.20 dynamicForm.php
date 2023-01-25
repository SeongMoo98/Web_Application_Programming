<!DOCTYPE html>

<!-- Fig. 19.21: dynamicForm.php --> 
<!-- Dynamic form. -->
<html>
   <head>
      <meta charset = "utf-8">
      <title>Registration Form</title>
      <style type = "text/css">
         p       { margin: 0px; }
         .error  { color: red }
         p.head  { font-weight: bold; margin-top: 10px; }
         label   { width: 5em; float: left; }
      </style>
   </head>
   <body>
        <?php
            $fname = isset($_POST["fname"]) ? $_POST["fname"] : "";
            $lname = isset($_POST[ "lname" ]) ? $_POST[ "lname" ] : "";
            $email = isset($_POST[ "email" ]) ? $_POST[ "email" ] : "";
            $phone = isset($_POST[ "phone" ]) ? $_POST[ "phone" ] : "";
            $book = isset($_POST[ "book" ]) ? $_POST[ "book" ] : "";
            $os = isset($_POST[ "os" ]) ? $_POST[ "os" ] : "";

            $is_error = false;
            $form_errors = array(
                "fname_error" => false,
                "lname_error" => false,
                "email_error" => false,
                "phone_error" => false
            );

            $book_list = array(
                "Internet and WWW How to Program",
                "C++ How to Program", "Java How to Program",
                "Visual Basic How to Program" 
            );

            $system_list = array( "Windows", "Mac OS X", "Linux", "Other");
            // array of name values for the text input fields
            $input_list = array( 
                "fname" => "FirstName",
                "lname" => "LastName",
                "email" => "Email",
                "phone" => "Phone" 
            );

            // Ensure that all fields have been filled in correctly
            if( isset( $_POST["submit"])){
                if( $fname == ""){
                    $form_errors["fname_error"] = true;
                    $is_error = true;
                }
                if( $lname == ""){
                    $form_errors["lname_error"] = true;
                    $is_error = true;
                }
                if( $email == ""){
                    $form_errors["email_error"] = true;
                    $is_error = true;
                }
                if( !preg_match("/^\([0-9]{3}\) [0-9]{3}-[0-9]{4}$/", $phone)){
                    $form_errors["phone_error"] = true;
                    $is_error = true;
                }

                if( !$is_error){
                    //Connect Database
                    $link = mysqli_connect("localhost","root","tjdan34");

                    //Build INSERT Query
                    $query = "INSERT INTO contacts".
                        "( LastName, FirstName, Email, Phone, Book, OS )".
                        "VALUES ( '$lname', '$fname', '$email', ".
                        "'".mysqli_real_escape_string($link, $phone).
                        "', '$book', '$os')";

                    if( !$database = $link){
                        die("<p>Could not connect to database</p>");
                    }

                    if(!mysqli_select_db($database, "mailingList")){
                        die("<p>Could not open MailingList database</p>");
                    }

                    if(!($result = mysqli_query($database, $query))){
                        print("<p>Could not execute query!</p>");
                        die(mysqli_close($database));
                    }

                    mysqli_close($database);

                    print( "<p>Hi $fname. 
                        Thank you for completing the survey.
                        You have been added to the $book mailing list.</p>
                        <p class = 'head'>The following information has been saved in our database:</p>
                        <p>Name: $fname $lname</p>
                        <p>Email: $email</p>
                        <p>Phone: $phone</p>
                        <p>OS: $os</p>
                        <p><a href = '19.21 formDatabase.php'>Click here to view entire database.</a></p>
                        <p class = 'head'>This is only a sample form.
                            You have not been added to a mailing list.</p>
                        </body></html>" );
                    die(); // finish the page
                }
            }

            print( "<h1>Sample Registration Form</h1>
                <p>Please fill in all fields and click Register.</p>" );
            
            if( $is_error )
                print("<p class = 'error'>Fields with * need to be filled in properly.</p> ");
        

            print( "<!-- post form data to dynamicForm.php -->");
            print("<form method = 'post' action = '19.20 dynamicForm.php'>
                <h2>User Information</h2>");
            print("<!-- Create four text boxes for user input -->");


            foreach( $input_list as $input_name => $input_alt){
                print("<div><label>$input_alt:</label>
                    <input type='text' name = '$input_name' value = '".$$input_name."'>");
                if($form_errors[($input_name)."_error"] == true)
                    print("<span class = 'error'>*</span>");
                print("</div>");
            }

            if( $form_errors["phone_error"])
                print("<p class = 'error'>Must be in the form (555) 555-5555");

            print( "<h2>Publications</h2>
                <p>Which book would you like information about?</p>");
            print("<!-- create drop-down list containing book names -->");
            print("<select name = 'book'>");
            
            foreach( $book_list as $curr_book){
                print("<option ".
                    ($curr_book == $book ? "selected>" : ">").
                    $curr_book."</option>");
            }

            print( "</select>
                <h2>Operating System</h2>
                <p>Which operating system do you use?</p>");

            print("<!-- create five radio buttons -->");

            $counter = 0;

            foreach( $system_list as $curr_system){
                print("<input type = 'radio' name = 'os' 
                    value = '$curr_system' ");
                
                if( (!$os && $counter == 0 ) || ($curr_system == $os) ){
                    print("checked");
                }
                print(">$curr_system");
                $counter++;
            }
            
            print("<!-- create a submit button -->");
            print( "<p class = 'head'><input type = 'submit' name = 'submit'
                value = 'Register'></p></form></body></html>" );
        ?>
   </body>


</html>


