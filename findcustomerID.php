<?php
    require('Config.php');
    include('session.php');
    $CustomerID = $_GET['CustomerID'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Reservation</title>
    <link rel="stylesheet" type="text/css" href="reservation.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel = "icon" href = "Car_icon.png" type = "image/x-icon">
</head>
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
        <!-- Logout button -->
        <a href="#" onclick="if(confirm('Are you sure you want to log out?')){window.location.href='Index.php';}">Logout</a>
         <!-- Display staff name -->
        <h1>Welcome <?php echo $_SESSION['StaffName']; ?>!</h1>
    </div>
<!-- Create form for updating customer profile -->
<label> Make an update on the customer profile</label>

<?php



//Retrieve a customer ID from the database (this is just an example, you may have a different way of assigning customers to reservations)
$query_customer = "SELECT * FROM customer WHERE CustomerID = '$CustomerID'";
$result_customer = mysqli_query($con, $query_customer);
$row_customer = mysqli_fetch_array($result_customer);

//Close connection
mysqli_close($con);
?>


<form action = "updatecustomerprocess.php" method = "POST">
<h2>Customer Information</h2>
        <input name="CustomerID" type="hidden" value="<?php echo $row_customer["CustomerID"] ?>" readonly/>  
        <br>
        <div class="row">
        <label>First Name:</label>
        <input class = "info" name="First_Name" value="<?php echo $row_customer["First_Name"] ?>" readonly/>  
        </div><br>

        <div class="row">
        <label>Last Name:</label>
        <input class = "info" name="Last_Name" value="<?php echo $row_customer["Last_Name"] ?>" readonly/>  
        </div><br>

        <div class="row">
        <label>Telephone Number:</label>
        <input class = "info" name="Telephone_No" maxlength=12 placeholder= "Example: 0124421421" value="<?php echo $row_customer["Telephone_No"] ?>" />     
        </div><br>

        <div class="row">
        <label>Address:</label>
        <input class = "info" name="Address" maxlength=100 placeholder= "Example: -" value="<?php echo $row_customer["Address"] ?>" />     
        </div><br>

        <div class="row">
        <label>Email:</label>
        <input class = "info" name="Email" maxlength=50 placeholder= "Example: -" value="<?php echo $row_customer["Email"] ?>" />     
        </div><br>

        
        <input type="submit" class="button buttonbottom"value="Submit">
        <input type="button" class="button buttonbottom" onclick="window.location.href='Mainmenu.php'"value="Cancel"> 
</form>

</body>
</html>
