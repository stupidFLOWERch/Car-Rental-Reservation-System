<?php
require('Config.php');

$Firstname=$_POST['firstname'];
$Lastname=$_POST['lastname'];
$Telephone_No=$_POST['telophonenum'];
$Address=$_POST['Address']; 
$Email=$_POST['Email'];

$Name = $Firstname . " " . $Lastname;

$lastnameascii_code = ord(substr($Lastname, 0, 3));
$CustomerID = $Lastname . $lastnameascii_code;

$sqlInsert2=mysqli_query($con,"INSERT INTO `customer`(`CustomerID`,`Name`,`Telephone_No`,`Address`,`Email`)
        VALUES('$CustomerID','$Name','$Telephone_No','$Address','$Email')");

// Get reservation data from form submission
$CarID = $_POST['CarID'];
$StaffID = $_POST['StaffID'];
// $CustomerID = $_POST['CustomerID'];
$Totalfee = $_POST['Totalfee'];
$daterange = $_POST['daterange'];

$daterange_arr = explode(" - ", $daterange);
$rentalstartdate = date("Y-m-d", strtotime($daterange_arr[0]));
$rentalenddate = date("Y-m-d", strtotime($daterange_arr[1]));

// Insert data into database
$sqlInsert1=mysqli_query($con,"INSERT INTO `reservation`(`CarID`,`StaffID`,`CustomerID`,`Totalfee`,`rentalstartdate`,`rentalenddate`)
        VALUES('$CarID','$StaffID','$CustomerID','$Totalfee','$rentalstartdate','$rentalenddate')");

if($sqlInsert1)
{
    print "<script>alert('Created reservation successfully!'); 
    window.location='Mainmenu.php'</script>";
 }
else
{

    print"<script> alert('The reservation is not valid. Please make a new reservation or check your input.');
            window.location='test.php'</script>";

}

// unset($_SESSION['CustomerID']);
// unset($_SESSION['CustomerName']);

mysqli_close($con);
?>