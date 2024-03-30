<?php include('session.php'); ?>
<html> 
<head>
    <title>Reservation</title>
    <link rel="stylesheet" type="text/css" href="stylesheet3.css"> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
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

    <div class="car-box">
        <img class="car-image" src="<?php echo $row_car['Image']; ?>">
        <p><strong><?php echo $row_car['Brand']." ".$row_car['Name']; ?></strong></p>
        <p>Colour: <?php echo $row_car['Colour']; ?></p>
        <p>Type: <?php echo $row_car['Type']; ?></p>
        <p>Daily Rental Fee: <?php echo $row_car['Dailyrentalfee']; ?></p>
    </div>

    <form method="POST" action="reservationprocess.php">
        <input type="hidden" name="CarID" value="<?php echo $CarID; ?>">

        <div class="row">
        <h2>Existing Customer?</h2>
        <button type="button"><a href="oldcustomer.php?CarID=<?php echo $CarID; ?>">Existing Customer</a></button>
        </div><br>

        <h2>New Customer Information</h2>
        <br>
        <div class="row">
        <label>First Name:</label>
        <input class = "name" name="firstname" placeholder="Example: Gary" required/>  
        </div><br>

        <div class="row">
        <label>Last Name:</label>
        <input class = "name" name="lastname" placeholder="Example: Chai" required/>  
        </div><br>

        <div class="row">
        <label>Telephone Number:</label>
        <input class = "telophonenum" name="telophonenum" maxlength=12 placeholder= "Example: 0124421421" required/>     
        </div><br>

        <div class="row">
        <label>Address:</label>
        <input class = "Address" name="Address" maxlength=100 placeholder= "Example: -" required/>     
        </div><br>

        <div class="row">
        <label>Email:</label>
        <input class = "Email" name="Email" maxlength=50 placeholder= "Example: -" required/>     
        </div><br>

        <h2>New Car Reservation Information</h2><br>
        <div class="row">
        <label for="reservationdate">Reservation Date:</label>
        <input type="text" name="daterange" required/>
        </div><br>

        <script>
            $(function() {
            // Retrieve existing reservations from PHP and convert them to the required format for DateRangePicker
            var existingReservations = <?php echo json_encode($reservations); ?>;
            var disabledDates = [];
            for (var i = 0; i < existingReservations.length; i++) {
                var start = moment(existingReservations[i].start);
                var end = moment(existingReservations[i].end);
                var duration = moment.duration(end.diff(start)).asDays();
                for (var j = 0; j < duration; j++) {
                    var date = start.clone().add(j, 'days');
                    disabledDates.push(date.format('MM/DD/YYYY'));
                }
            }

            // Initialize DateRangePicker
            $('input[name="daterange"]').daterangepicker({
                startDate: moment(),
                minDate: moment(),
                opens: 'left',
                isInvalidDate: function(date) {
                    return (disabledDates.indexOf(date.format('MM/DD/YYYY')) !== -1 || date.isBefore(moment().startOf('day')));
                }
            },function(start, end, label) {
                var rentalstartdate = start.format('YYYY-MM-DD');
                var rentalenddate = end.format('YYYY-MM-DD');
                console.log("A new date selection was made: " + rentalstartdate + ' to ' + rentalenddate);
            });
        });
        </script>


        <div class="row">
        <label for="staff">Staff ID:</label>
        <input type="text" id="staff" name="StaffID" value="<?php echo $row_staff['StaffID']; ?>" readonly>
        </div><br>

        <div class="row">
        <p>Daily Rental Fee: <?php echo $row_car['Dailyrentalfee']; ?></p>
        </div><br>

        <div class="row">
        <label for="numdays">Number of Days:</label>
        <input type="text" id="numdays" name="numdays" value="0" readonly>
        </div><br>

        <div class="row">
        <label for="totalfee">Total Fee:</label>
        <input type="text" id="totalfee" name="Totalfee" value="0.00" readonly>
        </div><br>
        <script>
           $(function() {
            // Get the date range input field
            var daterange = document.getElementsByName('daterange')[0];

            // Get the value of the input field
            var value = daterange.value;

            // Split the value into start and end dates
            var dates = value.split(' - ');

            // Convert the dates to Moment objects
            var start = moment(dates[0], 'MM/DD/YYYY');
            var end = moment(dates[1], 'MM/DD/YYYY');

            // Calculate the number of days
            var duration = end.diff(start, 'days') + 1;

            // Output the number of days
            console.log(duration);
                            
            // Get the daily rental fee from the PHP variable
            var dailyRentalFee = <?php echo $row_car['Dailyrentalfee']; ?>;
                            
            // Calculate the total fee based on the duration and daily rental fee
            var totalFee = dailyRentalFee * duration;
                            
            // Set the values of the number of days and the total fee inputs
            $('input[name="numdays"]').val(duration);
            $('input[name="Totalfee"]').val(totalFee.toFixed(2));

            // Listen for changes to the date range input field
            $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
                // Get the value of the input field
                var value = daterange.value;

                // Split the value into start and end dates
                var dates = value.split(' - ');

                // Convert the dates to Moment objects
                var start = moment(dates[0], 'MM/DD/YYYY');
                var end = moment(dates[1], 'MM/DD/YYYY');

                // Calculate the number of days
                var duration = end.diff(start, 'days') + 1;

                // Output the number of days
                console.log(duration);
                            
                // Get the daily rental fee from the PHP variable
                var dailyRentalFee = <?php echo $row_car['Dailyrentalfee']; ?>;
                            
                // Calculate the total fee based on the duration and daily rental fee
                var totalFee = dailyRentalFee * duration;
                            
                // Set the values of the number of days and the total fee inputs
                $('input[name="numdays"]').val(duration);
                $('input[name="Totalfee"]').val(totalFee.toFixed(2));
            });
        });
        </script>
        <input type="submit" value="Submit">
        <input type="button" class="button" onclick="window.location.href='Mainmenu.php'"value="Cancel"> 
    </form>
</body>
</html>
