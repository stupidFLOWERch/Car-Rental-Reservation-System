<?php
require('Config.php');

$Firstname=$_POST['firstname'];
$Lastname=$_POST['lastname'];
$Telephone_No=$_POST['telophonenum'];
$Address=$_POST['Address']; 
$Email=$_POST['Email'];
$CustomerID=$_POST['CustomerID'];

$record = mysqli_query($con, "SELECT * FROM customer WHERE CustomerID='$CustomerID'");

// Get reservation data from form submission
$CarID = $_POST['CarID'];
$StaffID = $_POST['StaffID'];
$Totalfee = $_POST['Totalfee'];
$daterange = $_POST['daterange'];

$daterange_arr = explode(" - ", $daterange);
$rentalstartdate = date("Y-m-d", strtotime($daterange_arr[0]));
$rentalenddate = date("Y-m-d", strtotime($daterange_arr[1]));

// Check if rental period is available
$sqlCheck = mysqli_query($con, "SELECT * FROM reservation WHERE CarID='$CarID' AND ((rentalstartdate <= '$rentalstartdate' AND rentalenddate >= '$rentalstartdate') OR (rentalstartdate <= '$rentalenddate' AND rentalenddate >= '$rentalenddate') OR (rentalstartdate >= '$rentalstartdate' AND rentalenddate <= '$rentalenddate'))");

if (mysqli_num_rows($sqlCheck) > 0) {
  // Rental period is not available, display error message and exit
  echo "<script> alert('The selected rental period is not available. Please choose different dates.');
  window.location='reservation2.php?CarID=$CarID&CustomerID=$CustomerID';</script>";
  exit();
}

// Insert data into database
$sqlInsert1="INSERT INTO `reservation`(`CarID`,`StaffID`,`CustomerID`,`Totalfee`,`rentalstartdate`,`rentalenddate`)
        VALUES('$CarID','$StaffID','$CustomerID','$Totalfee','$rentalstartdate','$rentalenddate')";

$result = mysqli_query($con,$sqlInsert1);
$last_ReservationID = mysqli_insert_id($con);


if($sqlInsert1)
{	
    session_start();
    $_SESSION['last_ReservationID']=$last_ReservationID;
    print "<script>alert('Created reservation successfully!'); 
    window.location='reservationid.php'</script>";
    exit;
 }
else
{

    print"<script> alert('The reservation is not valid. Please make a new reservation or check your input.');
    window.location='reservation2.php?CarID=$CarID&CustomerID=$CustomerID';</script>";

}

mysqli_close($con);
?>
