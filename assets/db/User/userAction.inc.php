<?php

/**
 * Class userAction
 *
 * @subpackage User
 * @author     Michel Zuidema <michelgzuidema@gmail.com>
 */
class userAction extends User {
    /**
       * 
       * Bekijkt of een gebruiker ingelogd is
       *
       * @return boolean
       */
	public function isUserAuthenticated() {
		if(isset($_SESSION['user_id'])) {
			return true;
		} else {
			return false;
		}
	}

    /**
       * 
       * Inloggen van een gebruiker
       *
       * @param string $email  Email van de gebruiker
       * @param string $password  Wachtwoord van de gebruiker
       * @return boolean
       */
	public function authenticateUser($email, $password)
    {
        $userData = $this->authUserDetails($email);

        if (password_verify($password, $userData[0]['user_password'])) {
            $_SESSION['user_id'] = $userData[0]['user_id'];
            $_SESSION['user_name'] = $userData[0]['user_name'];
            $_SESSION['user_email'] = $userData[0]['user_email'];

            return true;
        } else {
            return false;
        }
    }

    /**
       * 
       * Creëert een administrator van een poule
       *
       * @param string $username  Naam van de gebruiker
       * @param string $user_email  E-Mail van de gebruiker
       * @param string $user_password  Wachtwoord van de gebruiker
       * @return boolean
       */
    public function createPouleAdministrator($username, $user_email, $user_password) 
    {
        if($this->createPouleAdministratorProcess($username, $user_email, $user_password)) {
            return true;
        } else {
            return true;
        }
    }

    /**
       * 
       * Creëert een gebruiker
       *
       * @param string $user_email  E-Mail van de gebruiker
       * @param string $user_password  Wachtwoord van de gebruiker
       * @return boolean
       */
    public function createUser($user_email, $user_password) 
    {
        if($this->createPouleAdministratorProcess(NULL, $user_email, $user_password)) {
            return true;
        } else {
            return true;
        }
    }

    /**
       * 
       * Zoekt de laatste ingevoerde ID van een gebruiker
       *
       * @return integer
       */
    public function lastUserId() 
    {
        return $this->getLastUserId();
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
    public function setSelectedCountry($number, $country_id, $user_id, $poule_id)
    {
        if($this->setSelectedCountryProcess($number, $country_id, $user_id, $poule_id)) {
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
    public function deleteUserFromPoule($user_id, $poule_id) {
        if($this->deleteUserFromPouleProcess($user_id, $poule_id)) {
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
       * @return boolean
       */
    public function pointsOfUser($user_id, $poule_id) {
        $data = $this->getPointsOfUsers($user_id, $poule_id);

        return $data;
    }

    /**
       * 
       * Zoekt de ID van een gebruiker op basis van een email
       *
       * @param string $email  E-Mail waarop gezocht moet worden
       * @return array
       */
    public function idOfUserByEmail($email) 
    {
        $data = $this->getIdOfUserByEmail($email);

        return $data;
    }

    /**
       * 
       * Bekijkt of een gebruiker bestaat met een email
       *
       * @param string $email  E-Mail waarop gezocht moet worden
       * @return boolean
       */
    public function doesUserExistWithEmail($email) 
    {
        if($this->doesUserExistWithEmailProcess($email)['count'] > 0) {
            return true;
        } else {
            return false;
        }
    }
}

?>