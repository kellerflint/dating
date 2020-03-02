<?php

/**
 * Class Validator contains validation function definitions.
 *
 * @author Keller Flint
 */
class Validator
{

    /**
     * Returns true if name is alphabetic
     * @param $str string Name
     * @return bool
     */
    function validName($str) {
        return !empty(trim($str)) && ctype_alpha($str);
    }

    /**
     * Returns true if age is numeric and between 18 and 118
     * @param $str string age
     * @return bool
     */
    function validAge($str) {
        if (!empty(trim($str)) && ctype_digit($str)) {
            return $str >= 18 && $str <= 118;
        }
        return false;
    }

    /**
     * Returns true if phone is valid
     * @param $str string phone
     * @return bool
     */
    function validPhone($str) {
        if (!empty(trim($str)) && ctype_digit($str)) {
            return strlen($str) == 10;
        }
        return false;
    }

    /**
     * Returns true if email is valid
     * @param $str string email
     * @return bool
     */
    function validEmail($str) {
        return filter_var($str, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Returns true if selected outdoor interests are valid
     * @param $input array selected outdoor interests
     * @return bool
     */
    function validOutdoor($input) {
        global $db;
        $outdoorResult = $db->getOutdoorInterests();
        $outdoor = array();
        foreach($outdoorResult as $value) {
            array_push($outdoor, $value["interest_id"]);
        }
        if (!isset($input)) {
            return true;
        }
        foreach ($input as $value) {
            if (!in_array($value, $outdoor)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Returns true if selected indoor interests are valid
     * @param $input array selected indoor interests
     * @return bool
     */
    function validIndoor($input) {
        global $db;
        $indoorResult = $db->getIndoorInterests();
        $indoor = array();
        foreach($indoorResult as $value) {
            array_push($indoor, $value["interest_id"]);
        }
        if (!isset($input)) {
            return true;
        }
        foreach ($input as $value) {
            if (!in_array($value, $indoor)) {
                return false;
            }
        }

        return true;
    }
}