<?php
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
    global $outdoor;
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
    global $indoor;
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