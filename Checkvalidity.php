<?php 
    require('Config.php');
    // Check if the form was submitted
    if(isset($_POST)){
        // Get the username and password from the form data
        $Username = $_POST['Username'];
        $Password = $_POST['Password'];

       // Query the database to see if there is a matching user record
        $record=mysqli_query($con,"SELECT * From staff where
        Username='$Username' and Password='$Password'");
        // Check how many rows were returned
        $result= mysqli_num_rows($record);
        // If at least one row was returned, the user is valid
        if($result>0)
        {
            // Get the name of the staff member
            $row = mysqli_fetch_assoc($record);
            $staffName = $row['Name'];
            // Start a session and store some user data in it
            session_start();
            $_SESSION['Username'] = $Username;
            $_SESSION['StaffName'] = $staffName;
            $_SESSION['Password'] = $Password;
            
            print "<script>alert('Welcome to the car reservation system, " . $_SESSION['Username'] . "!');
            window.location= 'Mainmenu.php'</script>";
         }
         // If no rows were returned, the user is not valid
        else
        {

            print"<script> alert('The user is not valid. The username or the password is wrong. Please create a new account or check your input.');
                    window.location='Index.php'</script>";

    }
    }
?>



