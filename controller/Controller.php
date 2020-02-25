<?php

/**
 * Class Controller contains function definitions for each route.
 *
 * @author Keller Flint
 */
class Controller
{
    private $_f3;
    private $_val;

    /**
     * Controller constructor.
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
        $this->_val = new Validator();
    }

    /**
     * Displays home route.
     */
    function home()
    {
        $view = new Template();
        echo $view->render("views/home.html");
    }

    /**
     * Logic for personal route.
     */
    function personal()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->_f3->set("first", $_POST["first"]);
            $this->_f3->set("last", $_POST["last"]);
            $this->_f3->set("age", $_POST["age"]);
            $this->_f3->set("gender", $_POST["gender"]);
            $this->_f3->set("phone", $_POST["phone"]);

            $isValid = true;
            if (!$this->_val->validName($_POST["first"])) {
                $this->_f3->set("errors['first']", "Enter a valid first name.");
                $isValid = false;
            }
            if (!$this->_val->validName($_POST["last"])) {
                $this->_f3->set("errors['last']", "Enter a valid last name.");
                $isValid = false;
            }
            if (!$this->_val->validAge($_POST["age"])) {
                $this->_f3->set("errors['age']", "Enter a valid age (between 18-118)");
                $isValid = false;
            }
            if (!$this->_val->validPhone($_POST["phone"])) {
                $this->_f3->set("errors['phone']", "Enter a valid phone number (i.e. 1234567890)");
                $isValid = false;
            }

            if ($isValid) {
                if (isset($_POST["premium"])) {
                    $_SESSION["member"] = new PremiumMember($_POST["first"], $_POST["last"], $_POST["age"], $_POST["gender"], $_POST["phone"]);
                } else {
                    $_SESSION["member"] = new Member($_POST["first"], $_POST["last"], $_POST["age"], $_POST["gender"], $_POST["phone"]);
                }
                $this->_f3->reroute("/profile");
            }
        }

        $view = new Template();
        echo $view->render("views/personal_form.html");
    }

    /**
     * Logic for profile route.
     */
    function profile()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->_f3->set("email", $_POST["email"]);
            $this->_f3->set("state", $_POST["state"]);
            $this->_f3->set("seeking", $_POST["seeking"]);
            $this->_f3->set("bio", $_POST["bio"]);

            $isValid = true;
            if (!$this->_val->validEmail($_POST["email"])) {
                $this->_f3->set("errors['email']", "Enter a valid email.");
                $isValid = false;
            }

            if ($isValid) {

                $_SESSION["member"]->setEmail($_POST["email"]);
                $_SESSION["member"]->setState($_POST["state"]);
                $_SESSION["member"]->setSeeking($_POST["seeking"]);
                $_SESSION["member"]->setBio($_POST["bio"]);

                $this->_f3->reroute("/interests");
            }
        }

        $view = new Template();
        echo $view->render("views/profile_form.html");
    }

    /**
     * Logic for interests route.
     */
    function interests()
    {

        if (get_class($_SESSION["member"]) == "Member") {
            $this->_f3->reroute("/summary");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->_f3->set("indoor", $_POST["indoor"]);
            $this->_f3->set("outdoor", $_POST["outdoor"]);

            $isValid = true;
            if (!$this->_val->validIndoor($_POST["indoor"]) || !$this->_val->validOutdoor($_POST["outdoor"])) {
                $this->_f3->set("errors['interests']", "Don't spoof my forms!");
                $isValid = false;
            }

            if ($isValid) {
                $resultIn = array();
                $resultOut = array();
                if (isset($_POST["indoor"])) {
                    foreach ($_POST["indoor"] as $value) {
                        array_push($resultIn, $value);
                    }
                }
                if (isset($_POST["outdoor"])) {
                    foreach ($_POST["outdoor"] as $value) {
                        array_push($resultOut, $value);
                    }
                }

                $_SESSION["member"]->setInDoorInterests($resultIn);
                $_SESSION["member"]->setOutDoorInterests($resultOut);

                $this->_f3->reroute("/summary");
            }
        }

        $view = new Template();
        echo $view->render("views/interests_form.html");
    }

    /**
     * Displays summary page.
     */
    function summary()
    {
        $view = new Template();
        echo $view->render("views/summary_form.html");
    }


}