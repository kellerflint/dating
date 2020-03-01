<?php

/*
CREATE TABLE members
(
    member_id int NOT NULL AUTO_INCREMENT,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    age int NOT NULL,
    gender VARCHAR(255) NOT NULL,
    phone VARCHAR(10) NOT NULL,
    email VARCHAR(255) NOT NULL,
    state VARCHAR(2) NOT NULL,
    seeking VARCHAR(255) NOT NULL,
    bio VARCHAR(5000) NOT NULL,
    premium TINYINT NOT NULL,
    image VARCHAR(255) NULL,

    PRIMARY KEY (member_id)
);

CREATE TABLE interests
(
    interest_id int NOT NULL AUTO_INCREMENT,
    interest VARCHAR(255),
    type VARCHAR(255),

    PRIMARY KEY (interest_id)
);

CREATE TABLE members_interests
(
    member_id int,
    interest_id int,

    PRIMARY KEY (member_id, interest_id),
    FOREIGN KEY (member_id) REFERENCES members (member_id) ON UPDATE CASCADE,
    FOREIGN KEY (interest_id) REFERENCES interests (interest_id) ON UPDATE CASCADE
);

INSERT INTO interests VALUES
(DEFAULT, "tv", "indoor"),
(DEFAULT, "movies", "indoor"),
(DEFAULT, "cooking", "indoor"),
(DEFAULT, "board games", "indoor"),
(DEFAULT, "puzzle", "indoor"),
(DEFAULT, "reading", "indoor"),
(DEFAULT, "playing cards", "indoor"),
(DEFAULT, "video games", "indoor");

INSERT INTO interests VALUES
(DEFAULT, "hiking", "outdoor"),
(DEFAULT, "biking", "outdoor"),
(DEFAULT, "swimming", "outdoor"),
(DEFAULT, "collecting", "outdoor"),
(DEFAULT, "walking", "outdoor"),
(DEFAULT, "climbing", "outdoor");
 */

require_once "config.php";

class Database
{
    // connection/PDO object
    private $_db;

    function __construct()
    {
        $this->connect();
    }

    function connect() {
        try {
            $this->_db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo "<h1>connected</h1>";
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
    }

    function insertMember() {

    }

    function getMembers() {

    }

    function getMember($member_id) {

    }

    function getInterests($member_id) {

    }

    function getIndoorInterests() {
        $sql = "SELECT * FROM interests WHERE type = 'indoor'";
        $statement = $this->_db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getOutdoorInterests() {
        $sql = "SELECT * FROM interests WHERE type = 'outdoor'";
        $statement = $this->_db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}