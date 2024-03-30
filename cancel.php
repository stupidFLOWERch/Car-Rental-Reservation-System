<?php
    // Include session.php to verify if user is logged in
    include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cancel Reservation</title>
    <!-- Link to custom CSS file -->
    <link rel="stylesheet" type="text/css" href="oldcustomer.css"> 
    <!-- Link to website icon -->
    <link rel = "icon" href = "Car_icon.png" type = "image/x-icon">
</head>
<body>
    <!-- Navigation bar -->
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
<?php
        require('Config.php');

        // Check if a search query has been submitted
        if (isset($_GET['search'])) {
        $search_query = $_GET['search'];
        $query = "SELECT * FROM reservation WHERE ReservationID LIKE '%$search_query%'";
        } else {
        $query = "SELECT * FROM reservation";
        }
        
        // Execute query and store results
        $result = mysqli_query($con, $query);
        $num_rows = mysqli_num_rows($result);

        // Display data in a table
        if ($num_rows > 0) {
        echo "<form method='get' action='cancel.php'>";
        echo "<label for='search'>Search by Reservation ID: </label>";
        echo "<input type='text' class='select' id='search' name='search'>";
        echo "<button class='exisbutton' type='submit'>Search</button>";
        echo "</form>";
        echo "<br><br>";
        // Display reservation data in a table
        echo  "<div class=table-container>";
        echo "<table>";
        echo "<tr><th>Reservation ID</th><th>Car ID</th><th>Staff ID</th><th>Customer ID</th><th>Total Fee</th><th>Rental Start Date</th><th>Rental End Date</th><th>Action</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["ReservationID"]. "</td><td>" . $row["CarID"]. "</td><td>" . $row["StaffID"]. "</td><td>" . $row["CustomerID"]. "</td><td>" . $row["Totalfee"]. "</td><td>" . $row["rentalstartdate"]. "</td><td>" . $row["rentalenddate"]. "</td><td> <a href='#' onClick=\"var resID=prompt('Please enter the Reservation ID:'); if (resID != null && resID != '' && resID != '".$row["ReservationID"]."' ) { alert('Incorrect Reservation ID. Please try again.'); } else if (resID != null && resID != '' && confirm('Are you sure you want to delete this record?')) { window.location.href='deleteprocess.php?ReservationID=".$row["ReservationID"]."&Username=".$_SESSION['Username']."&resID='+resID; }\">Delete</a></td></tr>";
        }       
        echo "</table>";
        } else {
        echo "<label>0 results</label>";
        }
        echo  "</div>";

        // Close connection
        mysqli_close($con);
        ?>
<?php
require('Config.php');

$result = mysqli_query($con, "SELECT * FROM reservation");
$num_rows = mysqli_num_rows($result);


//Close connection
mysqli_close($con);
?>

<button type="button" class="button bottombutton" onclick="location.href='Mainmenu.php'">Back</button>

</body>
</html>
