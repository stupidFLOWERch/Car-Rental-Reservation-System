<?php
   include('session.php');
   require('Config.php');
?>

<html>
    <head><title>customerid</title></head>
    <link rel = "icon" href = "Car_icon.png" type = "image/x-icon">
    <link rel="stylesheet" type="text/css" href="customerid2.css"> 
    <body>
        <div class="navbar">
            <a href="Mainmenu.php" class="active">
                <img src="logo.jpg" alt="Logo" height="100">
            </a>
            <a href="cars.php">Make a reservation</a>
            <a href="updatedelete.php">Update reservation</a>
            <a href="cancel.php">Cancel Reservation</a>
            <a href="receipt.php">Print Receipt</a>
            <a href="customerid.php">Update customer profile</a>
            <a href="#" onclick="if(confirm('Are you sure you want to log out?')){window.location.href='Index.php';}">Logout</a>
            <h1>Welcome <?php echo $_SESSION['StaffName']; ?>!</h1>
        </div>
         <!-- Customer ID input form -->
        <label>Enter CustomerID to update profile</label>
        <form action="updatecustomer.php" method="GET">
            
                <label>CustomerID:</label>
                <input class="info" name="CustomerID" required placeholder="Example: chai8431216"/>  
            <!-- Buttons for form submission, cancellation, and resetting -->
            <div class="rowbutton">
                <input type="button" class="button" onclick="window.location.href='Mainmenu.php'"value="Cancel"> 
                <input type="submit" class="button" name="submit" value="Submit"> 
                <input type="reset" class="button" onclick="document.getElementById('customerid.php').reset()" value="Reset">
            </div>
        </form>   

        <?php
        // Check if the form has been submitted
       
        // Close database connection
        mysqli_close($con);
        ?>
    </body>
</html>
