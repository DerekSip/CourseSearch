<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <header>Search Results</header></p>
        <?php
        // Retreiving the entered number from the Number txt box
        $Number = $_POST['number']; 
        ini_set('display_errors','0');
        $connection = new mysqli('cis.luzerne.edu','cis265final','FinalExam','cis265final');
        
        // Checking to see if there was an error when connecting to the 
        if($connection->connect_error)
        {
            echo "connection failed";
        }
        else
        {
           // This displays to the user the number that they entered to make sure that it is correct.
           echo "This is the number Entered: $Number <br>";
           
           // Below is the query used to retrieve the course number entered by the user.
           $sql = "select * from catalog_courses where course_number=$Number;";
           $query = $connection->query($sql);
           if($query == false)
                {
                    echo "Unable to Query the table";
                }
                else
                {  
                    echo "<table>";
                    
                    // Loop through each course record returned from user search and display fields.
                    $coursenumber = $query->fetch_assoc();
                    while ($coursenumber != 0)
                    {
                        echo "<tr><td>" . $coursenumber['course_number'] . "</td>";
                        echo "<td>" . $coursenumber['course_name'] . "</td>";
                        echo "<td>" . $coursenumber['credit_hrs'] . "</td>";
                        echo "<td>" . $coursenumber['course_description'] . "</td></tr>";
                        $coursenumber = $query->fetch_assoc();       
                    }
                    echo "<table>";
                }
                //free's query
            $query->free();
            
        }//closes and ends the connection
        $connection->close();
        ?>
    </body>
</html>
