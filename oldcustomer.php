<?php include('session.php'); ?>
<html> 
<head>
    <title>Reservation</title>
    <link rel="stylesheet" type="text/css" href="oldcustomer.css"> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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
        <a href="#" onclick="if(confirm('Are you sure you want to log out?')){window.location.href='Index.php';}">Logout</a>
        <h1>Welcome <?php echo $_SESSION['StaffName']; ?>!</h1>
    </div>
    <?php 
        require('Config.php');

        // Get the selected car ID from the URL
        $CarID = $_GET['CarID'];

        // Retrieve the car information from the database
        $query_car = "SELECT * FROM cars WHERE CarID = '$CarID'";
        $result_car = mysqli_query($con, $query_car);
        $row_car = mysqli_fetch_array($result_car);

        // Retrieve a staff ID from the database (this is just an example, you may have a different way of assigning staff to reservations)
        $query_staff = "SELECT StaffID FROM staff WHERE Username = '{$_SESSION['Username']}' ORDER BY RAND() LIMIT 1";
        $result_staff = mysqli_query($con, $query_staff);
        $row_staff = mysqli_fetch_array($result_staff);

        // Retrieve a customer ID from the database (this is just an example, you may have a different way of assigning customers to reservations)
        // $query_customer = "SELECT CustomerID FROM customer ORDER BY RAND() LIMIT 1";
        // $result_customer = mysqli_query($con, $query_customer);
        // $row_customer = mysqli_fetch_array($result_customer);

        // Get all existing reservations for the selected car
        $query_reservations = "SELECT rentalstartdate, rentalenddate FROM reservation WHERE CarID = '$CarID'";
        $result_reservations = mysqli_query($con, $query_reservations);
        $reservations = array();
        while ($row_reservations = mysqli_fetch_array($result_reservations)) {
            $start = new DateTime($row_reservations['rentalstartdate']);
            $end = new DateTime($row_reservations['rentalenddate']);
            $end->modify('+1 day'); // add one more day to the rental end date
            $reservations[] = array(
                'start' => $start->format('m/d/Y'),
                'end' => $end->format('m/d/Y')
            );
        }


        mysqli_close($con);
    ?>

    <h1>Reservation Form</h1>
    <div style="display:flex;flex-wrap:wrap;justify-content: center;">
    <div class="car-box">
        <img class="car-image" src="<?php echo $row_car['Image']; ?>">
        <p><strong><?php echo $row_car['Brand']." ".$row_car['Name']; ?></strong></p>
        <p>Colour: <?php echo $row_car['Colour']; ?></p>
        <p>Type: <?php echo $row_car['Type']; ?></p>
        <p>Daily Rental Fee: <?php echo $row_car['Dailyrentalfee']; ?></p>
    </div>
    </div>
   
    <?php
        require('Config.php');

        // Check if a search query has been submitted
        if (isset($_GET['search'])) {
        $search_query = $_GET['search'];
        $query = "SELECT * FROM customer WHERE CustomerID LIKE '%$search_query%' OR First_Name LIKE '%$search_query%' OR Last_Name LIKE '%$search_query%'";
        } else {
        $query = "SELECT * FROM customer";
        }

        $result = mysqli_query($con, $query);
        $num_rows = mysqli_num_rows($result);

        // Display data in a table
        if ($num_rows > 0) {
        echo "<form method='get' action='oldcustomer.php'>";
        echo "<label for='search'>Search by Customer ID/First Name/Last Name:</label>";
        echo "<input class='info' class='select' type='text' id='search' name='search'>";
        echo "<input type='hidden' name='CarID' value='$CarID'>";
        echo "<button class='exisbutton' type='submit'>Search</button>";
        echo "</form>";

        echo  "<div class=table-container>";
        echo "<table>";
        echo "<tr><th>Customer ID</th><th>First Name</th><th>Last Name</th><th>Telephone No</th><th>Address</th><th>Email</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo " <div class='row'>";
            echo "<tr><td>" . $row["CustomerID"]. "</td><td>" . $row["First_Name"]. "</td><td>" . $row["Last_Name"]. "</td><td>" . $row["Telephone_No"]. "</td><td>" . $row["Address"]. "</td><td>" . $row["Email"]. "</td><td><a href='reservation2.php?CustomerID=".$row["CustomerID"]."&CarID=".$CarID."'>Reserve</a></td></tr>";
            echo "</div>";
        }        
        echo "</table>";
        } else {
        echo "<label>0 results</label>";
        }
        echo "</div>";

        // Close connection
        mysqli_close($con);
        ?>

    

    <button type="button" class="search bottombutton" onclick="location.href='reservation.php?CarID=<?php echo $CarID ?>'">Back</button>

</body>
</html>
