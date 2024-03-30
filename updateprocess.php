<?php
require('Config.php');

$ReservationID = $_GET['ReservationID'];

$CarID = $_GET['CarID'];
$StaffID = $_GET['StaffID'];
$Totalfee = $_GET['Totalfee'];
$daterange = $_GET['daterange'];

$daterange_arr = explode(" - ", $daterange);
$rentalstartdate = date("Y-m-d", strtotime($daterange_arr[0]));
$rentalenddate = date("Y-m-d", strtotime($daterange_arr[1]));

// Update data in database
$sqlUpdate=mysqli_query($con,"UPDATE `reservation` SET `CarID`='$CarID',`StaffID`='$StaffID',`Totalfee`='$Totalfee',`rentalstartdate`='$rentalstartdate',`rentalenddate`='$rentalenddate' WHERE `ReservationID`='$ReservationID'");

if($sqlUpdate)
{
     // If the update was successful, display a success message and redirect the user to the reservation management page
    print "<script>alert('Updated reservation successfully!'); 
    window.location='updatedelete.php'</script>";
}
else
{
    // If the update was not successful, display an error message and redirect the user to the reservation update page
    print"<script> alert('The update is not valid. Please make a new update or check your input.');
    window.location='update.php'</script>";
}

mysqli_close($con);
?>