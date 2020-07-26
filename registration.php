<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php
if (isset($_POST['submit']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($username))
    {
        $username = mysqli_real_escape_string($connection,$username);
        $email = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);

        //$password = password_hash($password,PASSWORD_BCRYPT,array('cost'=>12));

        $password = md5($password);

//        $query = "SELECT randSalt from users";
//        $result = mysqli_query($connection,$query);
//
//        if(!$result)
//        {
//            die('Query Failed'. mysqli_error($connection));
//        }
//
//        $row = mysqli_fetch_assoc($result);
//
//        $salt = $row['randSalt'];
//
//        $password = crypt($password,$salt);

        $query = "INSERT INTO users (username, user_email, user_password, user_role) VALUES ('$username','$email','$password','subscriber')";
        $register_user_query = mysqli_query($connection,$query);
        if(!$register_user_query)
        {
            die("QUERY FAILED".mysqli_error($connection));
            mysqli_errno($connection);
        }
        $message = "Your Registration has been submitted!";

    }
    else{
        $message = "Fields cannot be empty!";
    }

}
else
{
    $message = "";
}

?>

<!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Sign up</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <span onclick="myFunction1()" toggle="#password-field" class="fa fa-lg fa-eye field-icon1 toggle-password"></span>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                    <div id="message0">
                        <b>Username must contain the following:</b>
                        <p id="length1" class="invalid">Minimum <b>6-20 characters</b></p>
                        <p id="letter1" class="invalid">Contain <b>letters and numbers</b></p>
                    </div>

                    <div id="message">
                        <b>Password must contain the following:</b>
                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid">An <b>uppercase</b> letter</p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="length" class="invalid">Minimum <b>8-20 characters</b></p>
                    </div>

                    <script type="text/javascript">
                        function myFunction1() {
                            var x =document.getElementById("key");
                            if(x.type === "password")
                            {
                                x.type = "text";
                            }
                            else
                            {
                                x.type = "password";
                            }
                        }
                    </script>

                    <!--Username Validation-->
                    <script>
                        var myInput1 = document.getElementById("username")
                        var length1 = document.getElementById("length1");
                        var letter1 = document.getElementById("letter1");

                        // When the user clicks on the username field, show the message box
                        myInput1.onfocus = function()
                        {
                            document.getElementById("message0").style.display = "block";
                        }

                        // When the user clicks outside of the password field, hide the message box
                        myInput1.onblur = function() {
                            document.getElementById("message0").style.display = "none";
                        }

                        // When the user starts to type something inside the password field
                        myInput1.onkeyup = function() {
                            // Validate length
                            if(myInput1.value.length >= 6) {
                                length1.classList.remove("invalid");
                                length1.classList.add("valid");
                            } else {
                                length1.classList.remove("valid");
                                length1.classList.add("invalid");
                            }

                            var Letters = /[a-z]/g;
                            var numbers1 = /[0-9]/g;
                            if(myInput1.value.match(Letters) || myInput1.value.match(numbers1) ) {
                                letter1.classList.remove("invalid");
                                letter1.classList.add("valid");
                            } else {
                                letter1.classList.remove("valid");
                                letter1.classList.add("invalid");
                            }
                        }
                    </script>

                    <!--Password Validation-->
                    <script>
                        var myInput = document.getElementById("key");
                        var letter = document.getElementById("letter");
                        var capital = document.getElementById("capital");
                        var number = document.getElementById("number");
                        var length = document.getElementById("length");

                        // When the user clicks on the password field, show the message box
                        myInput.onfocus = function() {
                            document.getElementById("message").style.display = "block";
                        }

                        // When the user clicks outside of the password field, hide the message box
                        myInput.onblur = function() {
                            document.getElementById("message").style.display = "none";
                        }

                        // When the user starts to type something inside the password field
                        myInput.onkeyup = function() {
                            // Validate lowercase letters
                            var lowerCaseLetters = /[a-z]/g;
                            if(myInput.value.match(lowerCaseLetters)) {
                                letter.classList.remove("invalid");
                                letter.classList.add("valid");
                            } else {
                                letter.classList.remove("valid");
                                letter.classList.add("invalid");
                            }

                            // Validate capital letters
                            var upperCaseLetters = /[A-Z]/g;
                            if(myInput.value.match(upperCaseLetters)) {
                                capital.classList.remove("invalid");
                                capital.classList.add("valid");
                            } else {
                                capital.classList.remove("valid");
                                capital.classList.add("invalid");
                            }

                            // Validate numbers
                            var numbers = /[0-9]/g;
                            if(myInput.value.match(numbers)) {
                                number.classList.remove("invalid");
                                number.classList.add("valid");
                            } else {
                                number.classList.remove("valid");
                                number.classList.add("invalid");
                            }

                            // Validate length
                            if(myInput.value.length >= 8) {
                                length.classList.remove("invalid");
                                length.classList.add("valid");
                            } else {
                                length.classList.remove("valid");
                                length.classList.add("invalid");
                            }
                        }
                    </script>


                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

        <hr>



<?php include "includes/footer.php";?>
