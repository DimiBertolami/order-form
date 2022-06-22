<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);
//xdebug_info();
// We are going to use session variables so we need to enable sessions
session_start();
// Use this function when you need to need an overview of these variables
function whatIsHappening(): void
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'imGonnaMakeIt', 'price' => 2.5],
    ['name' => 'imNotGonnaMakeIt', 'price' => 3],
    ['name' => 'defNotGonnaMakeIt', 'price' => 3.5]
];
        print_r($products);
$formSubmitted = false;
$totalValue = 0;

function validate($stack)
{
    // TODO: This function will send a list of invalid fields back
//    $stack = [];
    /*
        E-mail	    Required.   Must contain a valid email address (with @ and .)
        street	    required.   it must contain characters only
        streetnr	required.   only numbers within a reasonable range
        city	    Required.   not blank
        zipcode     required.   must be numbers only
*/
    if(!isset($stack)){
        $stack= [];
    }
    if (isset($_POST['submit'])){
        echo "formSubmitted will be set to TRUE if the form has been submitted";
//    function_alert('starting form validation');
        $formSubmitted = true;

        $email = $_POST["email"];
//        whatIsHappening();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $stack = array($emailErr);
            echo "<script>document.getElementById('email').setAttribute('class', 'disabled');</script>";
        } else {
            echo '<div class="alert alert-success" role="alert">';
            echo 'You managed to enter a valid email adress! good for you!';
            echo '</div>';
        }
        $street = $_POST["street"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$street)) {
            $nameErr = "Only letters and white space allowed for streetname";
            echo "<script>document.getElementById('street').setAttribute('class', 'disabled');</script>";
            echo '<div class="alert alert-danger" role="alert">';
            echo $nameErr;
            echo '</div>';
            $stack = array($nameErr);
        } else {
            echo '<div class="alert alert-success" role="alert">';
            echo 'it appears you also entered a valid street name!';
            echo '</div>';
        }

        $streetnumber = $_POST["streetnumber"];
        if (!preg_match("/^[\d']*$/",$streetnumber)) {
            $nameErr = "Only numbers allowed for houseNUMBER field";
            echo "<script>document.getElementById('streetnumber').setAttribute('class', 'disabled');</script>";
            echo '<div class="alert alert-danger" role="alert">';
            echo $nameErr;
            echo '</div>';
            $stack = array($nameErr);
        } else {
            echo '<div class="alert alert-success" role="alert">';
            echo 'house number is valid!';
            echo '</div>';
        }
    }

    return $stack;
}
function function_alert($message): void
{

    // Display the alert box
    echo "<script>alert('$message');</script>";
}
function handleForm(): void
{
    // TODO: form related tasks (step 1)
    if(!isset($stack)){
        $stack= [];
    }
    // Validation (step 2)
    $invalidFields = validate($stack);
    if (!empty($invalidFields)) {
        // TODO: handle errors
        function_alert('TODO: handle errors');
        whatIsHappening();
        print_r($invalidFields);
    } else {
        // TODO: handle successful submission
        function_alert('form submitted successfully');

        $formSubmitted = false;
        whatIsHappening();
    }
}

// TODO: replace this if by an actual check

if ($formSubmitted=true) {
    handleForm();
}

require 'form-view.php';