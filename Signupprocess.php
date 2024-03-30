<?php
    require('Config.php');
    if (isset($_POST['signup'])){

        $Username=$_POST['Username'];
        $Name=$_POST['Name'];
        $Password=$_POST['Password'];

        $sqlInsert=mysqli_query($con,"INSERT INTO `staff`(`Username`,`Name`,`Password`)
        VALUES('$Username','$Name','$Password')");
        
        if ($sqlInsert)
        {
            print "<script>alert('Created account successfully!'); 
            window.location='Index.php'</script>";
        }
        else
        {
            print "<script>alert('The creation of your account has failed, please check your information!');
            window.location='Signup.php'</script>";
        }
    }
?>