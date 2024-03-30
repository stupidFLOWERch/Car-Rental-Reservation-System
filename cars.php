<?php include('session.php'); ?>
<html> 
<head>
    <title>Cars</title>
    <link rel="stylesheet" type="text/css" href="cars.css">
    <link rel = "icon" href = "Car_icon.png" type = "image/x-icon">
</head>
<body>
    
    <div class="navbar">
        <!-- Link to the Mainmenu.php page with the logo image -->
        <a href="Mainmenu.php" class="active">
            <img src="logo.jpg" alt="Logo" height="100">
        </a>
        <!-- Links to other pages -->
        <a href="cars.php">Make a reservation</a>
        <a href="updatedelete.php">Update reservation</a>
        <a href="cancel.php">Cancel Reservation</a>
        <a href="receipt.php">Print Receipt</a>
        <a href="customerid.php">Update customer profile</a>
        <a href="#" onclick="if(confirm('Are you sure you want to log out?')){window.location.href='Index.php';}">Logout</a>  
        <!-- Display user's name using session data -->     
        <h1>Welcome <?php echo $_SESSION['StaffName']; ?>!</h1>
    </div>
    <!-- Form to filter cars by type -->
    <form method="POST" action="">
        <!-- Label for the type selection -->
        <label class="inst" for="type">Filter by type:</label>
         <!-- Drop-down menu to select car type -->
        <select class="car-select" id="type" name="type">
            <option value="">All</option>
            <option value="Luxurious Car">Luxurious Car</option>
            <option value="Sports Car">Sports Car</option>
            <option value="Classics Car">Classics Car</option>
        </select>
        <!-- Submit button to filter the cars -->
        <input type="submit" class="button" value="Filter">
    </form> 
    
    <?php 
        // Include the Config.php file to connect to the database
        require('Config.php');

        // Get the selected car type from the drop-down menu
        if(isset($_POST['type'])){
            $Type = $_POST['type'];
        }else{
            $Type = '';
        }

        // Construct the SQL query based on the selected type
        if(!empty($Type)){
            $query = "SELECT * FROM cars WHERE Type = '$Type'";
        }else{
            $query = "SELECT * FROM cars";
        }
        // Execute the SQL query and store the result
        $result = mysqli_query($con, $query);
        
        // Display the cars in a flexible grid
        if (mysqli_num_rows($result) > 0) {
            echo "<div style='display:flex;flex-wrap:wrap;justify-content: center;;'>";
            while($row = mysqli_fetch_array($result)) {
                echo "<div class='car-box'>";
                echo "<img class='car-image' src='".$row['Image']."'>";
                echo "<div class='name-box'>";
                echo "<p class='car-name'><strong>".$row['Brand']." ".$row['Name']."</strong></p>";
                echo "</div>";
                echo "<p>Colour: ".$row['Colour']."</p>";
                echo "<p>Type: ".$row['Type']."</p>";
                echo "<p>Daily Rental Fee: ".$row['Dailyrentalfee']."</p>";
                echo "<form action='reservation.php' method='get'>";
                echo "<input type='hidden' name='CarID' value='".$row['CarID']."'>";
                echo "<input type='submit' class='button' value='Reserve'>";
                echo "</form>";
                // echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No results found.";
        }
        mysqli_close($con);

    ?>
    <button type="button" class="button buttonback" onclick="location.href='Mainmenu.php'">Back</button>
   
</body>
</html>
