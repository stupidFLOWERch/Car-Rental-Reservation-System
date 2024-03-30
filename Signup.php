<html> 
    <link rel="stylesheet" type="text/css" href="Signup.css">
    <link rel = "icon" href = "Car_icon.png" type = "image/x-icon">
    <head><title>Sign Up</title></head> 
    <body> 
    
    

    <div class="content"> 
    
        <Form action="Signupprocess.php" method="POST">
        
            <br><br><br>
            <h1>New User Sign Up</h1>
            <br><br>
             <!-- Username input field -->
            <div class="row">
                    <label>Username:</label>
                        <input class = "username" name="Username" required placeholder="Example: MTYL0322"/>  
            </div>
           
             <!-- Name input field -->
            <div class="row">
                    <label>Name:</label>
                        <input class = "name" name="Name" required placeholder="Example: Gary Chai"/>  
            </div>
          
             <!-- Password input field -->
            <div class="row">
                    <label>Password:</label>
                        <input class = "password" name="Password" maxlength=12 require placeholder= "Example: abc12345">     
            </div>
          

            <div class="rowbutton">
                <input type="button" class="button" onclick="window.location.href='Index.php'"value="Cancel"> 

                <input type="submit" class="button" name="signup" value="Sign Up"> 

                <input type="reset" class="button" onclick="document.getElementById('Signup.php').reset()"value="Reset">
            </div>
            
        <form>
    </div>

</body>
<html>