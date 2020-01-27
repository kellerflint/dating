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

// create an instance of the base class

$f3 = Base::instance();

session_start();

//define default route
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render("views/home.html");
});

$f3->route('GET /personal', function () {
    $view = new Template();
    echo $view->render("views/personal_form.html");
});

$f3->route('POST /profile', function () {
    $_SESSION["first"] = $_POST["first"];
    $_SESSION["last"] = $_POST["last"];
    $_SESSION["age"] = $_POST["age"];
    $_SESSION["gender"] = $_POST["gender"];
    $_SESSION["phone"] = $_POST["phone"];
    $view = new Template();
    echo $view->render("views/profile_form.html");
});

$f3->route('POST /interests', function () {
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["state"] = $_POST["state"];
    $_SESSION["seeking"] = $_POST["seeking"];
    $_SESSION["bio"] = $_POST["bio"];
    $view = new Template();
    echo $view->render("views/interests_form.html");
});

$f3->route('POST /summary', function () {
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