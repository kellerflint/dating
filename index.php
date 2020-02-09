<?php
/**
 * Controller for Your Dating Website. Routes root traffic to home.html view.
 *
 * @auther  Keller Flint
 * @date    1/26/2020
 */
// This is out controller!

// Turn on error reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Require the autoload file
require_once ("vendor/autoload.php");

// Require validation functions
require_once ("models/validation_functions.php");

// create an instance of the base class

$f3 = Base::instance();

session_start();

//define default route
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render("views/home.html");
});

$f3->route('GET|POST /personal', function ($f3) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $f3->set("first", $_POST["first"]);
        $f3->set("last", $_POST["last"]);
        $f3->set("age", $_POST["age"]);
        $f3->set("gender", $_POST["gender"]);
        $f3->set("phone", $_POST["phone"]);

        $isValid = true;
        if (!validName($_POST["first"])) {
            $f3->set("errors['first']", "Enter a valid first name.");
            $isValid = false;
        }
        if (!validName($_POST["last"])) {
            $f3->set("errors['last']", "Enter a valid last name.");
            $isValid = false;
        }
        if (!validAge($_POST["age"])) {
            $f3->set("errors['age']", "Enter a valid age (between 18-118)");
            $isValid = false;
        }
        if (!validPhone($_POST["phone"])) {
            $f3->set("errors['phone']", "Enter a valid phone number (i.e. 1234567890)");
            $isValid = false;
        }

        if ($isValid) {
            $f3->reroute("/profile");
        }
    }

    $view = new Template();
    echo $view->render("views/personal_form.html");
});

$f3->route('GET|POST /profile', function () {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $f3->set("email", $_POST["email"]);
        $f3->set("state", $_POST["state"]);
        $f3->set("seeking", $_POST["seeking"]);
        $f3->set("bio", $_POST["bio"]);

        $isValid = true;
        if (!validName($_POST["first"])) {
            $f3->set("errors['first']", "Enter a valid first name.");
            $isValid = false;
        }
        if (!validName($_POST["last"])) {
            $f3->set("errors['last']", "Enter a valid last name.");
            $isValid = false;
        }
        if (!validAge($_POST["age"])) {
            $f3->set("errors['age']", "Enter a valid age (between 18-118)");
            $isValid = false;
        }
        if (!validPhone($_POST["phone"])) {
            $f3->set("errors['phone']", "Enter a valid phone number (i.e. 1234567890)");
            $isValid = false;
        }

        if ($isValid) {
            $f3->reroute("/profile");
        }
    }

    $view = new Template();
    echo $view->render("views/profile_form.html");
});

$f3->route('GET|POST /interests', function () {
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["state"] = $_POST["state"];
    $_SESSION["seeking"] = $_POST["seeking"];
    $_SESSION["bio"] = $_POST["bio"];
    $view = new Template();
    echo $view->render("views/interests_form.html");
});

$f3->route('GET /summary', function () {
    $result = "";
    foreach ($_POST["indoor"] as $value) {
        $result .= "$value ";
    }
    foreach ($_POST["outdoor"] as $value) {
        $result .= "$value ";
    }
    $_SESSION["interests"] = $result;
    $view = new Template();
    echo $view->render("views/summary_form.html");
});

// run fat free
$f3->run();