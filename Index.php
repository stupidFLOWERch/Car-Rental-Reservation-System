<html> 
    <head>
        <title>Staff Login</title>
        <link rel="stylesheet" type="text/css" href="stylesheet2.css">
        <link rel = "icon" href = "Car_icon.png" type = "image/x-icon">
    </head>
    <body class="index">
        <!-- partial:index.partial.html -->
        <div class="box-form">
            <div class="left">
                <div class="overlay">
                    <h1>Welcome</h1>
                    <p>Please enter your employee username and password in order to sign in. Thank You !</p>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <p>Dont have an account? Sign up Here !</p><br>
                    <input type="button" class="button" onclick="window.location.href='Signup.php'"value="Sign up"> 
                </div>
            </div>
            
            <Form action="Checkvalidity.php" method="POST">
            <div class="right">
                <h5>Login</h5>
                <p>Still haven't sign up? <a href="Signup.php">Create Your Account</a>   by clicking on this link</p>
                <div class="inputs">
                    <input type="text" name="Username" placeholder="Username">
                    <br>
                    <input type="password" name="Password" placeholder="Password">
                </div>
                    
                    <br><br>
                    
                <div class="remember-me--forget-password">
                        <!-- Angular -->
                    <label>
                        <input type="checkbox" name="item" checked/>
                        <span class="text-checkbox">Remember me</span>
                    </label>
                    <label class="forgotpassword" onclick="forgotpassword()">Forgot Password?</label>

                    <script>
                            //Pop-up Setelah Pengguna Klik "Klik Sini"
                            function forgotpassword(){
                            alert("Please contact our admin to change your password. Thank You !");
                            }
                    </script>

                </div>
                    
                    <br>
                    <input type="submit" class="button" value="Login"> 
            </div>
            </form>
            
        </div>
        <!-- partial -->
  
    </body>
    </div>
<html>  