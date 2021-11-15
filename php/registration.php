<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FireMovies Registration</title>
<!--    <link href="./css/styles.css"/>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>

    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        .required:after {
            content:" *";
            color: red;
        }

        .error { border-color: red; }
        #error { color: red }

        .red {
            color: red;
        }

        body {
            /*background-image: url("https://thumbs.dreamstime.com/b/illustration-vector-graphic-fire-film-perfect-to-use-cinema-logo-214149086.jpg");*/
            background-color: #FFD580;
        }


        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 450px}


        /* Set black background color, white text and some padding */
        footer {
            background-color: #C3B1E1;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;}
        }

        .registrationCol{
            column-count: 2;
        }

        h1 {text-align: center;}
    </style>
</head>
<body onload="registerHandlers();">

    <?php

        $isvalid = false;
        $first_name_error = $last_name_error = $password_error = $repeat_pass_error = $email_error  = $username_error =
        $address1_error = $address2_error = $city_error = $marital_status_error = $gender_error = $zip_error = $phone_error = "";

        $first_name = $last_name = $username = $address1 = $address2 = $password = $repeat_p = $phone_number = $city
        = $zipcode = $email = $comment = $website = $gender = $maritalStatus = "";


        if($_SERVER["REQUEST_METHOD"] == "POST")
        {

            $username = $_POST["userName"];
            input_check($username_error, $username, 6, 50);
            $password = $_POST["password"];
            input_check($password_error, $password, 8, 50);
            $repeat_p = $_POST["repeatPassword"];
            input_check($first_name_error, $first_name, 8, 50);
            $first_name = clean_input($_POST["firstName"]);
            input_check($first_name_error, $first_name, 1, 50);
            $last_name = clean_input($_POST["lastName"]);
            input_check($last_name_error, $last_name, 1, 50);
            $address1 = clean_input($_POST["Address1"]);
            input_check($address1_error, $address1, 1, 100);
            $address2 = clean_input($_POST["Address2"]);
            input_check($address2_error, $address2, 0, 100);
            $city = clean_input($_POST["City"]);
            input_check($city_error, $city, 1, 50);
            $zipcode = clean_input($_POST["zipcode"]);
            input_check($zip_error, $zipcode, 5, 10);
            $phone_number = clean_input($_POST["number"]);
            input_check($phone_error, $phone_number, 1, 12);

            $email = $_POST["email"];
            email_check($email_error, $email);

            if (isset($_POST["gender"])) {
                $gender = clean_input($_POST["gender"]);
                if (empty($_POST["gender"])) {
                    $genderErr = "Gender is required";
                    $isValid = false;
                }
            } else {
                $genderErr = "Gender is required";
                $isValid = false;
            }


            if (isset($_POST["maritalStatus"])) {
                $maritalStatus = clean_input($_POST["maritalStatus"]);
                if (empty($_POST["maritalStatus"])) {
                    $marital_status_errorErr = "Marital status is required";
                    $isValid = false;
                }
            } else {
                $marital_status_error = "Marital status is required";
                $isValid = false;
            }
//            $marital_status = $_POST["maritalStatus"];
//            check_radio($marital_status_error, $marital_status);
        }





        function input_check($input_error, $input, $min, $max){
            $length = strlen($input);
            if(empty($input)){
                $input_error = "Input is required";
                $isvalid = false;
            }
            elseif($length < $min){
                $input_error = "Field length is too short, minimum is $min characters ($max max)";
                $isvalid = false;
            }
            elseif($length > $max){
                $input_error =  "Field name is too long, maximum is $max characters ($min min)";
                $isvalid = false;
            }
            else{
                $input_error = "";
                $isvalid = true;
            }
        }


//        function check_radio($input_error, $input){
//            if (isset($_POST[$input])) {
//                if (empty($_POST[$input])) {
//                    $input_error = "Input is required";
//                    $isvalid = false;
//                }
//            } else {
//                $gender_error = "Gender is required";
//                $isvalid = false;
//            }
//        }

        function email_check($email_error, $email) {
            if(empty($email)){
                $email_error = "Email is required";
                $isvalid = false;
            }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $email_error = "Invalid email address";
                $isvalid = false;
            }
            else
                $isvalid = true;
        }

        function clean_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

    ?>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/index.html"><img src="https://thumbs.dreamstime.com/b/illustration-vector-graphic-fire-film-perfect-to-use-cinema-logo-214149086.jpg" alt="Fire Movies Logo" width="40" height="35"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="/index.html">Home</a></li>
                    <li class="active"><a href="/registration.html">Register</a></li>
                    <li><a href="/animation.html">Animation</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <h1>Registration</h1>

    <div class="registrationCol text-center">
        <form id= "registration"  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" novalidate>
            <label class = "required" for="firstName">First name:</label><br/>
            <input id="firstName" type="text" placeholder= "Percy" name="firstName"
                   value = "<?php echo $first_name; ?>"/>
            <span class = "error"> <?php echo $first_name_error;?></span><br/>


            <label class = "required" for="lastName">Last name:</label><br/>
            <input id="lastName" type="text" placeholder="Jackson" name="lastName"
            value = "<?php echo $last_name; ?>"/>
            <span class = "error"> <?php echo $last_name_error;?></span><br/>

            <div id="classDiv" class="form-group">
                <label class = "required" for="userName">User name:</label><br/>
                <input id="userName" type="text" placeholder="HydraSlayer23" name="userName" minlength="6"
                       value = "<?php echo $username; ?>"  maxlength="50"  /><br/>
                <span class="error"> <?php echo $username_error;?></span>
            </div>

            <div id="passDiv" class="form-group">
                <label class = "required" for="password">Password: </label><br/>
                <input id="password" class="form-group" type="password" name="password" minlength="8"
                       value = "<?php echo $password; ?>" maxlength="50" /><br/>
                <span class="error"> <?php echo $password_error;?></span>
            </div>


            <div id = "verPassDiv" class="form_group">
                <label class = "required" for="repeatPassword">Repeat Password: </label><br/>
                <input id="repeatPassword" class="form-group" type="password" name="repeatPassword" minlength="8"
                       value = "<?php echo $repeat_p; ?>" maxlength="50" /><br/>
                <span class="error"> <?php echo $repeat_pass_error;?></span>
            </div>


            <div>
                <label class = "required" for="Address1">Address Line 1:</label><br/>
                <input id="Address1" type="text" name="Address1"
                       value = "<?php echo $address1; ?>" maxlength="100"/><br/>
                <span class="error"> <?php echo $address1_error;?></span>

                <label for="Address2">Address Line 2:</label><br/>
                <input id="Address2" type="text" placeholder="Optional" name="Address2"
                       value = "<?php echo $address2; ?>" maxlength="100"/><br/>
                <span class="error"> <?php echo $address2_error;?></span>

                <label class = "required" for="City">City:</label><br/>
                <input id="City" type="text" name="City"  maxlength="50" value = "<?php echo $city; ?>"/><br/><br/>
                <span class="error"> <?php echo $city_error;?></span>

                <label class = "required" for="State">State:</label>
                <select id="State" name="State" >
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select><br/><br/><br/><br/>

                <label class = "required" for="zipcode">Zipcode:</label><br/>
                <input id="zipcode" type="text" name="zipcode"
                       value = "<?php echo $zipcode; ?>" maxlength="10" minlength="5"/><br/>
                <span class="error"> <?php echo $zip_error;?></span>

                <label class = "required" for="number">Phone Number:</label><br/>
                <input id = "number" type = "text" name="number" placeholder = "(xxx)xxx-xxx"
                       value = "<?php echo $phone_number; ?>"  maxlength = "12"/><br/>
                <span class="error"> <?php echo $phone_error;?></span>

                <label class = "required" for="email"> Email:</label><br/>
                <input id="email" type="text" name="email" placeholder = "JohnSmith@AOL.com"
                       value = "<?php echo $email; ?>" /><br/>



                <label class = "required">Gender:</label><br/>
                <input type="radio" onclick="add_count()"
                       name="gender" id="maleGender"
                    <?php if ($gender=="male") {echo "checked" ;}?>
                       value="male" /> <label for="maleGender">Male</label><br/>
                <input type="radio" onblur="add_count()"
                       name="gender" id="femaleGender" <?php if ($gender=="female") {echo "checked" ;}?>
                       value="female"/> <label for="femaleGender">Female</label><br/>
                <input type="radio" onblur="add_count()"
                       name="gender" id="otherGender" <?php if ($gender=="other") {echo "checked" ;}?>
                       value="other"/> <label for="otherGender">Other</label><br/><br/>

                <label class = "required">Marital Status</label><br/>
                <input type="radio" onblur="add_count()" <?php if ($maritalStatus=="married") {echo "checked" ;}?>
                       name="maritalStatus" id="married"
                       value="married" /> <label for="married">Married</label><br/>
                <input type="radio" onblur="add_count()"
                       name="maritalStatus" id="single" <?php if ($maritalStatus=="single") {echo "checked" ;}?>
                       value="single"/> <label for="single">Single</label><br/>
                <input type="radio" onblur="add_count()"
                       name="maritalStatus" id="widow" <?php if ($maritalStatus=="widow") {echo "checked" ;}?>
                       value="widow"/> <label for="widow">Widowed</label><br/>
                <input type="radio" onblur="add_count()"
                       name="maritalStatus" id="no" <?php if ($maritalStatus=="no") {echo "checked" ;}?>
                       value="no"/> <label for="no">Prefer not to answer</label><br/><br/>

                <label class = "required" for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" ><br/><br/>

                <input type="reset" value="Reset" />
                <input id= "submit" type="Submit" name="Submit"/>


                <br/><p class = red>* = Required</p>
            </div>
        </form>
    </div>


    <?php
        if($isvalid) {
            ?>
          <form id="hiddenForm" name="hiddenForm"
                 method="POST" action="confirmation.php">
                  <?php
                    foreach($_POST as $key => $value) {
                        ?>
                        <input name="<?php echo $key;?>"
                               value="<?php echo $value;?>"
                               type="hidden"/>
                        <?php
                    }
                  ?>
            </form>
            <script>
                document.createElement("form").submit.call(document.getElementById("hiddenForm"));
            </script>
            <?php
        }
    ?>

</body>
</html>



