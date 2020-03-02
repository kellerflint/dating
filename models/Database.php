<?php

/*
CREATE TABLE members
(
    member_id int NOT NULL AUTO_INCREMENT,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    age int NOT NULL,
    gender VARCHAR(255) NOT NULL,
    phone VARCHAR(10) NULL,
    email VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    seeking VARCHAR(255) NULL,
    bio VARCHAR(5000) NULL,
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
        if (get_class($_SESSION["member"]) == "PremiumMember") {
            $sql = "INSERT INTO members VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 'path/image.png')";
        } else {
            $sql = "INSERT INTO members VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, NULL)";
        }
        $statement = $this->_db->prepare($sql);
        
        $statement->execute([
            $_SESSION["member"]->getFname(),
            $_SESSION["member"]->getLname(),
            $_SESSION["member"]->getAge(),
            $_SESSION["member"]->getGender(),
            $_SESSION["member"]->getPhone(),
            $_SESSION["member"]->getEmail(),
            $_SESSION["member"]->getState(),
            $_SESSION["member"]->getSeeking(),
            $_SESSION["member"]->getBio()
        ]);

        $id = $this->_db->lastInsertId();

        if (get_class($_SESSION["member"]) == "PremiumMember") {
            foreach($_SESSION["member"]->getInDoorInterests() as $value) {
                $sql = "INSERT INTO members_interests VALUES (?, ?)";
                $statement = $this->_db->prepare($sql);
                $statement->execute([$id, $value]);
            }
            foreach($_SESSION["member"]->getOutDoorInterests() as $value) {
                $sql = "INSERT INTO members_interests VALUES (?, ?)";
                $statement = $this->_db->prepare($sql);
                $statement->execute([$id, $value]);
            }
        }
        return $id;
    }

    function getMembers() {
        $sql = "SELECT * FROM members";
        $statement = $this->_db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getInterests($member_id) {
        $sql = "SELECT member_id, interests.interest_id, interest FROM interests INNER JOIN members_interests ON interests.interest_id = members_interests.interest_id WHERE member_id = ?";
        $statement = $this->_db->prepare($sql);
        $statement->execute([$member_id]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
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