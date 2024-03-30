<?php
    include('session.php');
?>
<html>
<head>
    <title>Reservation Receipt</title>
    <link rel="stylesheet" type="text/css" href="Print.css">
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
</body>
<center>
<?php
// include('session.php');
require('Config.php');
// require_once 'phpqrcode/qrlib.php';


// Check if ReservationID is set in the URL
if (isset($_GET['ReservationID'])) {
    $ReservationID = $_GET['ReservationID'];
    $query = "SELECT * FROM reservation WHERE ReservationID = $ReservationID";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    // Check if reservation exists
    if (mysqli_num_rows($result) > 0) {

        $CarID=$row["CarID"];
        // Retrieve car information for reservation
        $query_car = "SELECT * FROM cars WHERE CarID = '$CarID'";
        $result_car = mysqli_query($con, $query_car);
        $row_car = mysqli_fetch_array($result_car);

        // Display car information
        echo "<div class=container>";
        echo "<h1>Official Receipt</h1>";
        echo '<div class="car-box">';
        echo '<img class="car-image" src="' . $row_car['Image'] . '">';
        echo '<p><strong>' . $row_car['Brand'] . ' ' . $row_car['Name'] . '</strong></p>';
        echo '<p><strong>Colour:</strong> ' . $row_car['Colour'] . '</p>';
        echo '<p><strong>Type: </strong>' . $row_car['Type'] . '</p>';
        echo '<p><strong>Daily Rental Fee:</strong> ' . $row_car['Dailyrentalfee'] . '</p>';
        echo '</div>';

        // Display reservation information
        echo "<p><strong>Reservation ID:</strong> " . $row["ReservationID"] . "</p>";
        echo "<p><strong>Car ID:</strong> " . $row["CarID"] . "</p>";
        echo "<p><strong>Staff ID:</strong> " . $row["StaffID"] . "</p>";
        echo "<p><strong>Customer ID:</strong> " . $row["CustomerID"] . "</p>";
        echo "<p><strong>Total Fee:</strong> $" . $row["Totalfee"] . "</p>";
        echo "<p><strong>Rental Start Date:</strong> " . $row["rentalstartdate"] . "</p>";
        echo "<p><strong>Rental End Date:</strong> " . $row["rentalenddate"] . "</p>";
        echo '</div>';
    } else {
        // Display error message if reservation not found
        echo "Reservation not found";
    }

    // Close database connection
    mysqli_close($con);
    } else {
        // Display error message if ReservationID not set in URL
        echo "Invalid reservation ID";
    }
?>
<br><br>
<input type="submit" class="button bottombutton" name="print" onclick=window.print() value="Print"/>
<input type="submit" class="button bottombutton" onclick="location.href='Mainmenu.php'" value="Back"/>
<center>
</html>