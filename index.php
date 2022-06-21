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
    function_alert('starting form validation');


    if (isset($_POST['submit'])){
        echo "formSubmitted will be set to TRUE if the form has been submitted";
        $formSubmitted = true;
        whatIsHappening();

        $email = $_POST["email"];
        whatIsHappening();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            function_alert($emailErr);
            $stack = array($emailErr);
            whatIsHappening();
        }
//    $street = test_input($_POST["street"]);
        $street = $_POST["street"];
        whatIsHappening();
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$street)) {
            whatIsHappening();
            $nameErr = "Only letters and white space allowed";
            function_alert($nameErr);
            $stack = array($nameErr);
        }
        whatIsHappening();
        $streetnumber = $_POST["streetnumber"];
        if (!preg_match("/^[\d']*$/",$streetnumber)) {
            $nameErr = "Only numbers allowed";
            function_alert($nameErr);
            $stack = array($nameErr);
        }
    }


    // Validation (step 2)
    $invalidFields = validate($stack);
    if (!empty($invalidFields)) {
        // TODO: handle errors
        function_alert('TODO: handle errors');
    } else {
        // TODO: handle successful submission
        function_alert('form submitted successfully');
    }
}

// TODO: replace this if by an actual check

if ($formSubmitted=true) {
    handleForm();
}

require 'form-view.php';