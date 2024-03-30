<?php
    include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="oldcustomer.css">
	<title>Print Receipt</title>
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

$result = mysqli_query($con, $query);
$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    echo "<form method='get' action='receipt.php'>";
    echo "<label for='search'>Search by Reservation ID:</label>";
    echo "<input class='select' type='text' id='search' name='search'>";
    echo "<button class='exisbutton' type='submit'>Search</button>";
    echo "</form>";
    echo "<br><br>";

    echo  "<div class=table-container>";
    echo "<table>";
    echo "<tr><th>Reservation ID</th><th>Car ID</th><th>Staff ID</th><th>Customer ID</th><th>Total Fee</th><th>Rental Start Date</th><th>Rental End Date</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ReservationID"]. "</td><td>" . $row["CarID"]. "</td><td>" . $row["StaffID"]. "</td><td>" . $row["CustomerID"]. "</td><td>" . $row["Totalfee"]. "</td><td>" . $row["rentalstartdate"]. "</td><td>" . $row["rentalenddate"]. "</td><td><a href='print.php?ReservationID=".$row["ReservationID"]."'>Print</a></td></tr>";
    }
    echo "</table>";
    } else {
    echo "<label>0 results</label>";
    }
    echo  "</div>";

//Close connection
mysqli_close($con);
?>

<button class="button bottombutton" type="button " onclick="location.href='Mainmenu.php'">Back</button>

</body>
</html>
