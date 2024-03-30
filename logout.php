<?php
    // Start the session
    session_start();
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Show an alert message and redirect to Index.php
    echo"<script>alert('Logged out successfully.');
    window.location.replace('Welcomepage.php');</script>";
?>