<?php
require('Config.php');

// Get ReservationID from the GET request
$ReservationID = $_GET['ReservationID'];

// Delete reservation from the database
$sqldelete=mysqli_query($con,"DELETE FROM `reservation` where ReservationID='$ReservationID'");

if($sqldelete)
{
    // If reservation is successfully deleted, display success message and redirect to cancel.php page
    print "<script>alert('Deleted reservation successfully!'); 
    window.location='cancel.php'</script>";
}
else
{
    // If reservation is not deleted properly, display error message and redirect to cancel.php page
    print"<script> alert('The record is not deleted properly.');
            window.location='cancel.php'</script>";
}

// Close database connection
mysqli_close($con);
?>
