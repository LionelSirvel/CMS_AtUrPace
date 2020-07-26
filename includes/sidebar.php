<div class="col-md-4">


    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
            </div>
        </form>
    </div>

    <!-- Login -->
    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">

            <div class="input-group">
                <input name="username" id="username" type="text" class="form-control" placeholder="Username">
                <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-user"></span>
                        </button>
                    </span>
            </div>
            <br>
            <div class="input-group">
                <input name="password" id="password" type="password" class="form-control" placeholder="Password">
                <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-lock"></span>
                        </button>
                    </span>
            </div>
            <span onclick="myFunction()" toggle="#password-field" class="fa fa-lg fa-eye field-icon toggle-password"></span>
            <br>
            <div class="input-group">
                <button class="btn btn-primary" name="login" type="submit">Login</button>
            </div>
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
            var myInput = document.getElementById("password");
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

    <script type="text/javascript">
        function myFunction() {
            var x =document.getElementById("password");
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


    <!-- Blog Categories Well -->
    <div class="well">

        <?php
        $query="select * from categories";
        $select_categories_sidebar = mysqli_query($connection,$query);
        ?>

        <h4>Blog Categories</h4>
        <div class="row">

            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    while($row=mysqli_fetch_assoc($select_categories_sidebar))
                    {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='category.php?category=$cat_id'>$cat_title</a></li>";
                    }
                    ?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php
    include "widget.php";
    ?>

</div>