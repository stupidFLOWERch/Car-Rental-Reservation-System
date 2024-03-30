<?php
require('Config.php');

// Retrieve form data
$CustomerID = $_POST['CustomerID'];
$Telephone_No = $_POST['Telephone_No'];
$Address = $_POST['Address'];
$Email = $_POST['Email'];

// Update data in database
$sqlUpdate = mysqli_query($con, "UPDATE `customer` SET `Telephone_No`='$Telephone_No', `Address`='$Address', `Email`='$Email' WHERE `CustomerID`='$CustomerID'");

if($sqlUpdate) {
    print "<script>alert('Updated customer profile successfully!'); 
    window.location='Mainmenu.php'</script>";
} else {
    print"<script> alert('The update is not valid. Please make a new update or check your input.');
    window.location='updatecustomer.php?CustomerID=".$CustomerID."'</script>";
}

mysqli_close($con);
?>
