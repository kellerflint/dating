<?php
/**
 * Controller for Your Dating Website. Routes root traffic to home.html view.
 *
 * @auther  Keller Flint
 * @date    1/16/2020
 */
// This is out controller!

// Turn on error reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

// Require the autoload file
require_once ("vendor/autoload.php");

// create an instance of the base class

$f3 = Base::instance();

//define default route
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render("views/home.html");
});

$f3->route('GET /personal', function () {
    $view = new Template();
    echo $view->render("views/personal_form.html");
});

// run fat free
$f3->run();