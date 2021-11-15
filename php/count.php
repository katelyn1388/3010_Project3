<?php

$isvalid = false;
$first_name_error = $last_name_error = $password_error = $repeat_pass_error = $email_error  = $username_error =
$address1_error = $address2_error = $city_error = $marital_status_error = $gender_error = $zip_error = $phone_error = $website_error = "";

$first_name = $last_name = $username = $address1 = $address2 = $password = $repeat_p = $phone_number = $city
    = $zipcode = $email = $comment = $website = $gender = "";


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $isvalid = true;
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
    input_check($address2_error, $address2, 1, 100);
    $city = clean_input($_POST["City"]);
    input_check($city_error, $city, 1, 50);
    $zipcode = clean_input($_POST["zipcode"]);
    input_check($zip_error, $zipcode, 5, 10);
    $phone_number = clean_input($_POST["number"]);
    input_check($phone_error, $phone_number, 1, 12);

    $email = $_POST["email"];
    email_check($email_error, $email);

    $gender = $_POST["gender"];
    check_radio($gender_error, $gender);
    $marital_status = $_POST["maritalStatus"];
    check_radio($marital_status_error, $marital_status);
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


function check_radio($input_error, $input){
    if (isset($_POST["gender"])) {
        if (empty($_POST["gender"])) {
            $gender_error = "Gender is required";
            $isValid = false;
        }
    } else {
        $gender_error = "Gender is required";
        $isValid = false;
    }
}

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
