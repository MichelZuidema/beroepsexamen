<?php

class User extends Database {
	protected function authUserDetails($email)
    {
        $sql = "SELECT user_id, user_name, user_email, user_password FROM `user` WHERE user_email = '$email'";
        $result = $this->connect()->query($sql);
        $rows = $result->num_rows;

        if ($rows > 0) {
            $row = $result->fetch_assoc();
            $data[] = $row;

            return $data;
        } else {
            echo "No results found!";
        }
    }

    protected function createPouleAdministratorProcess($username, $user_email, $user_password) 
    {
        $sql = "INSERT INTO user (user_name, user_email, user_password) VALUES ('$username', '$user_email', '$user_password')";

        if($this->getConnection()->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    protected function getLastUserId()
    {
        return $this->getConnection()->insert_id;
    }

    protected function setSelectedCountryProcess($number, $country_id, $user_id, $poule_id) {
        $sql = "UPDATE user_poule SET user_sel_country_$number = $country_id WHERE user_id = $user_id AND poule_id = $poule_id";

        if($this->getConnection()->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    protected function deleteUserFromPouleProcess($user_id, $poule_id) {
        $sql = "DELETE FROM user_poule WHERE user_id = $user_id AND poule_id = $poule_id";

        if($this->getConnection()->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    protected function getPointsOfUsers($user_id, $poule_id) 
    {
        $sql = "SELECT `points` FROM user_poule WHERE user_id = $user_id AND poule_id = $poule_id";

        $result = $this->connect()->query($sql);
        $rows = $result->num_rows;

        if ($rows > 0) {
            $row = $result->fetch_assoc();
            $data[] = $row;

            return $data;
        } else {
            return  "No results found!";
        }
    }

    protected function getIdOfUserByEmail($email) {
        $sql = "SELECT user_id FROM user WHERE user_email = '$email'";

        $result = $this->connect()->query($sql);
        $rows = $result->num_rows;

        if ($rows > 0) {
            $row = $result->fetch_assoc();
            $data[] = $row;

            return $data;
        } else {
            return  "No results found!";
        }
    }

    public function doesUserExistWithEmailProcess($email)
    {
        $sql = "SELECT COUNT(user_id) AS count FROM user WHERE user_email = '$email'";

        $result = $this->connect()->query($sql);
        $row = $result->fetch_assoc();

        return $row;
    }
}

?>