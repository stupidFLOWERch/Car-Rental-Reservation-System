<?php
    include('session.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Main Menu</title>
    <link rel="stylesheet" type="text/css" href="Mainmenu.css"> 
</head>
<body>
    <div class="navbar">
        <a href="Mainmenu.php" class="active">
            <img src="logo.jpg" alt="Logo" height="100">
        </a>
        <a href="cars.php">Make a reservation</a>
        <a href="updatedelete.php">Update reservation</a>
        <a href="cancel.php">Cancel Reservation</a>
        <a href="receipt.php">Print Receipt</a>
        <a href="customerid.php">Update customer profile</a>
        <a href="#" onclick="if(confirm('Are you sure you want to log out?')){window.location.href='Index.php';}">Logout</a>
        <h1>Welcome <?php echo $_SESSION['StaffName']; ?>!</h1>
    </div>

    

    <div class="home">
		<div class="welcome">
			<h1>Make a reservation now!</h1>
		</div>
	</div>

    <script>
      // create an array of image file names for the background images
    var images = ['Mainmenu2.jpg', 'Mainmenu3.jpg', 'Mainmenu4.jpg', 'Mainmenu1.jpg'];
    // set the initial index of the current image to 0
    var currentIndex = 0;
    // get the container element with the class 'home'
    var container = document.getElementsByClassName('home')[0];
    // set an interval function to change the background image every 5 seconds
    setInterval(function() {
      currentIndex = (currentIndex + 1) % images.length;
      container.style.backgroundImage = 'url(' + images[currentIndex] + ')';
    }, 5000);
  </script>
</body>
</html>
