<?php

/**
 * Class PremiumMember contains data for premium site members.
 *
 * @author Keller Flint
 */
class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;

    /**
     * PremiumMember constructor.
     * @param $_fname string first name
     * @param $_lname string last name
     * @param $_age int age
     * @param $_gender string gender
     * @param $_phone string phone number
     */
    function __construct($_fname, $_lname, $_age, $_gender, $_phone)
    {
        parent::__construct($_fname, $_lname, $_age, $_gender, $_phone);
    }

    /**
     * @return array indoor interests
     */
    public function getInDoorInterests()
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param array indoor interests
     */
    public function setInDoorInterests($inDoorInterests)
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @return array outdoor interests
     */
    public function getOutDoorInterests()
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param array outdoor interests
     */
    public function setOutDoorInterests($outDoorInterests)
    {
        $this->_outDoorInterests = $outDoorInterests;
    }
}