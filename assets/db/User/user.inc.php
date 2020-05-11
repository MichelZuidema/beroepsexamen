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

    protected function setSelectedCountryProcess($number, $country_id, $user_id) {
        $sql = "UPDATE user SET user_sel_country_$number = $country_id WHERE user_id = $user_id";

        if($this->getConnection()->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}

?>