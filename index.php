<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Course Searches</title>
    </head>
    <body><!--Html for the creation of the page so that the user can search in the school courses database-->
        <header>Search for courses</header>
        <form method="post" action="searchNumber.php">
           Enter Course Number: <p><input type="text" name="number" size="20"></p>
           Submit: <input type="submit" name="submit"></p>
          </form>
        <?php
        ini_set('display_errors', '0');
        //establishing connection to the data base
        $connection = new mysqli('cis.luzerne.edu','cis265final','FinalExam','cis265final');
        
        if ($connection->connect_error)
        {
            echo "We could not connect to the database";
        }
        else
        {
                // Retrieve all records from the catalog_courses table
                $sql = "Select * from catalog_courses";
                $query = $connection->query($sql);
                if($query == false)
                {
                    echo "could not Query the table";
                }
                else
                {
                    //checking to see if there are or aren't any rows in the database
                    //echo "there are $query->num_rows in the database";
                    if($query->num_rows == 0)
                    {
                        echo "There are no rows to display in the table";
                    }
                    else
                    {
                        echo "<table>";
                        $course = $query->fetch_assoc();
                        // Loop through each course record and display fields.
                        while ($course != 0)
                        {
                            echo "<tr><td>" . $course['program'] . "</td>";
                            echo "<td>" . $course['course_number'] . "</td>";
                            echo "<td>" . $course['course_name'] . "</td>";
                            echo "<td>" . $course['credit_hrs'] . "</td>";
                            echo "<td>" . $course['course_description'] . "</td></tr>";
                            $course = $query->fetch_assoc();       
                        }
                        echo "<table>";
                    }
                    //Ending frees the tables
                $query->free();
                }
                //Ending established connection
            $connection->close();
        }
        ?>
        
    </body>
</html>
