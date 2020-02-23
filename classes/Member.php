<?php

/**
 * Class Member contains data for site members.
 *
 * @author Keller Flint
 */
class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor.
     * @param $_fname string first name
     * @param $_lname string last name
     * @param $_age int age
     * @param $_gender string gender
     * @param $_phone string phone number
     */
    public function __construct($_fname, $_lname, $_age, $_gender, $_phone)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_phone = $_phone;
    }

    /**
     * @return string first name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param string first name
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return string last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param string last name
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return int age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param int age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return string gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param string gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return string phone
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param string phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return string email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return string state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param string state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return string seeking
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param string $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return string bio
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param string bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}