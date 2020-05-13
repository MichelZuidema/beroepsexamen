<?php

/**
 * Class User
 *
 * @subpackage Database
 * @author     Michel Zuidema <michelgzuidema@gmail.com>
 */
class User extends Database {
    /**
       * 
       * Zoekt de gegevens van een gebruiker op basis van zijn email
       *
       * @param string $email  Email van de gebruiker waarop je wilt zoeken
       * @return array
       */
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

    /**
       * 
       * Creëert een poule administrator
       *
       * @param string $username  Naam van de gebruiker
       * @param string $user_email  E-Mail van de gebruiker
       * @param string $user_password  Wachtwoord van de gebruiker
       * @return boolean
       */
    protected function createPouleAdministratorProcess($username, $user_email, $user_password) 
    {
        $sql = "INSERT INTO user (user_name, user_email, user_password) VALUES ('$username', '$user_email', '$user_password')";

        if($this->getConnection()->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    /**
       * 
       * Zoekt de laatste ID van een user
       *
       * @return integer
       */
    protected function getLastUserId()
    {
        return $this->getConnection()->insert_id;
    }

    /**
       * 
       * Zet het geselecteerde land van een gebruiker in de database
       *
       * @param integer $number  Nummer van het land dat je wilt opslaan ( 1 - 4)
       * @param integer $country_id ID van het land
       * @param integer $user_id  ID van de gebruiker
       * @param integer $poule_id ID van de poule
       * @return boolean
       */
    protected function setSelectedCountryProcess($number, $country_id, $user_id, $poule_id) {
        $sql = "UPDATE user_poule SET user_sel_country_$number = $country_id WHERE user_id = $user_id AND poule_id = $poule_id";

        if($this->getConnection()->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    /**
       * 
       * Verwijderd een gebruiker van een poule
       *
       * @param integer $user_id  ID van de gebruiker
       * @param integer $poule_id ID van de poule
       * @return boolean
       */
    protected function deleteUserFromPouleProcess($user_id, $poule_id) {
        $sql = "DELETE FROM user_poule WHERE user_id = $user_id AND poule_id = $poule_id";

        if($this->getConnection()->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    /**
       * 
       * Zoekt de punten van een gebruiker
       * 
       * @param integer $user_id  ID van de gebruiker
       * @param integer $poule_id ID van de poule
       * @return array
       */
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

    /**
       * 
       * Zoekt de ID van een gebruiker op basis van zijn / haar email
       *
       * @param string $email  E-Mail van de gebruiker
       * @return array
       */
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

    /**
       * 
       * Bekijkt of een gebruiker bestaat op basis van een email
       *
       * @param string $email  E-Mail van de gebruiker
       * @return integer
       */
    public function doesUserExistWithEmailProcess($email)
    {
        $sql = "SELECT COUNT(user_id) AS count FROM user WHERE user_email = '$email'";

        $result = $this->connect()->query($sql);
        $row = $result->fetch_assoc();

        return $row;
    }
}

?>