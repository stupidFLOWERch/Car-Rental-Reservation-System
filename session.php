<?php
include('Config.php');

// Start the session
session_start();

// Check if the staff member is logged in
if (!isset($_SESSION['Username'])) {
    // Redirect to the login page or show an error message
    header('Location: Index.php');
    exit;
}

// Retrieve the staff member's ID from the session variable
$Username = $_SESSION['Username'];

// Use the staff ID to retrieve information about the logged-in staff member from the database
$query = "SELECT * FROM staff WHERE Username = '$Username'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

?>  
