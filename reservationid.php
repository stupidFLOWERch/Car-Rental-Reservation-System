<?php
require('Config.php');
session_start();
// Retrieve the last reservation ID from the session
$last_ReservationID = $_SESSION['last_ReservationID'];

// Retrieve customer ID from database
$sqlCustomerID = mysqli_query($con, "SELECT customer.CustomerID FROM customer JOIN reservation ON customer.CustomerID = reservation.CustomerID WHERE reservation.ReservationID = '$last_ReservationID'");
$customerIDRow = mysqli_fetch_array($sqlCustomerID);
$last_CustomerID = $customerIDRow['CustomerID'];

?>
<html>
<head>
<link rel = "icon" href = "Car_icon.png" type = "image/x-icon">
<link rel="stylesheet" type="text/css" href="customerid.css"> 
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

  <h1>Customer ID: <?php echo $last_CustomerID; ?></h1>
  <h1>Your Reservation ID is: <?php echo $last_ReservationID; ?></h1>
  <button type="button" class="button" onclick="location.href='Print1.php?ReservationID=<?php echo $last_ReservationID; ?>'">Print Receipt</button>

  <?php
  // If the 'redirect' button is clicked, redirect to the main menu page
  if (isset($_POST['redirect'])) {
      header("Location: Mainmenu.php");
      exit();
    }


  mysqli_close($con);
  ?>

  <form method="post">
    <button class="button" type="submit" name="redirect">Return</button>
  </form>
</body>
</html>