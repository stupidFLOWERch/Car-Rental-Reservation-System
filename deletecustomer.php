<?php
require('Config.php');

$CustomerID = $_GET['CustomerID'];
$CarID = $_GET['CarID'];

$sqldelete=mysqli_query($con,"DELETE FROM `customer` where CustomerID='$CustomerID'");

if($sqldelete)
{
    print "<script>alert('Deleted customer record successfully!'); 
    window.location='oldcustomer.php?CarID=$CarID'</script>";
}
else
{

    print"<script> alert('The record is not deleted properly because this customer has a reservation.');
            window.location='oldcustomer.php?CarID=$CarID'</script>";

}

mysqli_close($con);
?>
