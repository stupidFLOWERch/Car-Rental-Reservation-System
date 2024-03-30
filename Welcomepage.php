<!DOCTYPE html>
<html>
<head>
	<title>Car Reservation System</title>
	<link rel="stylesheet" type="text/css" href="welcomepage.css">
	<link rel = "icon" href = "Car_icon.png" type = "image/x-icon">
</head>
<body class="welcome">
	<header>
    <img src="systemlogo.jpg" height="150px" width="300px">
		<nav>
			<ul>
				<li><a href="Index.php">Login</a></li>
				<li><a href="Signup.php">Sign Up</a></li>
			</ul>
		</nav>
	</header>

	<div class="home">
		<div class="welcome">
			<h1>Welcome to Car Reservation System</h1>
			<p>Sign up or Login to make a reservation!</p>
		</div>
	</div>
	<!-- This is a script for the automatic background image change -->
    <script>
    var images = ['welcome1.jpg', 'welcome2.jpg', 'welcome3.jpg', 'welcome4.jpg'];
    var currentIndex = 0;
    var container = document.getElementsByClassName('home')[0];

    setInterval(function() {
      currentIndex = (currentIndex + 1) % images.length;
      container.style.backgroundImage = 'url(' + images[currentIndex] + ')';
    }, 5000);
  </script>

</body>
</html>