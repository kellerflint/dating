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
require_once("vendor/autoload.php");

// create an instance of the base class
$f3 = Base::instance();

// Declare option arrays
$f3->set("states", array("Washington", "Oregon", "California"));
$indoor = array("tv", "movies", "cooking", "board games", "puzzle", "reading", "playing cards", "video games");
$f3->set("indoors", $indoor);
$outdoor = array("hiking", "biking", "swimming", "collecting", "walking", "climbing");
$f3->set("outdoors", $outdoor);

session_start();

$controller = new Controller($f3);

//define default route
$f3->route('GET /', function () {
    global $controller;
    $controller->home();
});

$f3->route('GET|POST /personal', function ($f3) {
    global $controller;
    $controller->personal();
});

$f3->route('GET|POST /profile', function ($f3) {
    global $controller;
    $controller->profile();
});

$f3->route('GET|POST /interests', function ($f3) {
    global $controller;
    $controller->interests();
});

$f3->route('GET /summary', function () {
    global $controller;
    $controller->summary();
});

// run fat free
$f3->run();