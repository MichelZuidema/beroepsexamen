<?php

class userAction extends User {
	public function isUserAuthenticated() {
		if(isset($_SESSION['user_id'])) {
			return true;
		} else {
			return false;
		}
	}

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

    public function createPouleAdministrator($username, $user_email, $user_password) 
    {
        if($this->createPouleAdministratorProcess($username, $user_email, $user_password)) {
            return true;
        } else {
            return true;
        }
    }

    public function createUser($user_email, $user_password) 
    {
        if($this->createPouleAdministratorProcess(NULL, $user_email, $user_password)) {
            return true;
        } else {
            return true;
        }
    }

    public function lastUserId() 
    {
        return $this->getLastUserId();
    }

    public function setSelectedCountry($number, $country_id, $user_id, $poule_id)
    {
        if($this->setSelectedCountryProcess($number, $country_id, $user_id, $poule_id)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUserFromPoule($user_id, $poule_id) {
        if($this->deleteUserFromPouleProcess($user_id, $poule_id)) {
            return true;
        } else {
            return false;
        }
    }

    public function pointsOfUser($user_id, $poule_id) {
        $data = $this->getPointsOfUsers($user_id, $poule_id);

        return $data;
    }

    public function idOfUserByEmail($email) 
    {
        $data = $this->getIdOfUserByEmail($email);

        return $data;
    }

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