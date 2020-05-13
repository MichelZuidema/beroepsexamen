<?php

/**
 * Class pouleAction
 *
 * @subpackage Country
 * @author     Michel Zuidema <michelgzuidema@gmail.com>
 */
class pouleAction extends Poule {
	/**
       * 
       * Stuurt de aanroep om een poule aan te maken
       *
       * @param integer $administrator_id  ID van de administrator
       * @param string $pouleNaam  Naam van de poule
       * @return boolean
       */
	public function createPoule($administrator_id, $pouleName) 
	{
		if($this->createPouleProcess($administrator_id, $pouleName)) {
			return true;
		} else {
			return false;
		}
	}

	/**
       * 
       * Voegt de nieuwe gebruiker toe een poule
       *
       * @param integer $user_id  ID van de gebruiker
       * @param integer $poule_id  ID van de poule
       * @return various
       */
	public function addUserToPoule($user_id, $poul_id) 
	{
		if($this->addUserToPouleProcess($user_id, $poul_id)) {
			return $poul_id;
		} else {
			return false;
		}
	}

	/**
       * 
       * Pakt de laatste poule id
       *
       * @return integer
       */
	public function lastPouleId() {
		return $this->getLastPouleId();
	}

	/**
       * 
       * Laat alle poules van de gebruiker zien
       *
       * @param integer $user_id  ID van de gebruiker
       * @return array
       */
	public function showAllPoulesForUser($user_id)
	{
		$data = $this->getAllPoulesForUser($user_id);

		return $data;
	}

	/**
       * 
       * Laat de poule naam zien
       * 
       * @param integer $poule_id  ID van de poule
       * @return string
       */
	public function showPouleName($poule_id) {
		$data = $this->getPouleName($poule_id)['poule_name'];

		return $data;
	}

	/**
       * 
       * bekijkt of de gebruiker de administrator is
       *
       * @param integer $user_id  ID van de gebruiker
       * @param integer $poule_id  ID van de poule
       * @return boolean
       */
	public function isPouleAdmin($poule_id, $user_id) 
	{
		$data = $this->getPouleAdmin($poule_id);

		if($data[0]['poule_administrator_id'] == $user_id) {
			return true;
		} else {
			return false;
		}
	}

	/**
       * 
       * Laat alle gebruikers van een poule zien
       *
       * @param integer $poule_id  ID van de poule
       * @return array
       */
	public function showAllUsersForPoule($poule_id) 
	{
		$data = $this->getAllUsersFromPoule($poule_id);

		return $data;
	}

	/**
       * 
       * Laat het geselecteerde land zien
       *
       * @param integer $user_id  ID van de gebruiker
       * @param integer $poule_id  ID van de poule
       * @param integer $number  Nummer van het land dat je wilt zoeken ( 1 - 4)
       * @return array
       */
	public function getSelectedCountry($user_id, $poule_id, $number) 
	{
		$data = $this->getSelectedCountryProcess($user_id, $poule_id, $number);

		return $data;
	}

	/**
       * 
       * Laat de punten van een gebruiker zien
       *
       * @param integer $user_id  ID van de gebruiker
       * @param integer $poule_id  ID van de poule
       * @return array
       */
	public function pointsOfUser($user_id, $poule_id) 
	{
		$data = $this->getPointsOfUsers($user_id, $poule_id);

		return $data;
	}

	/**
       * 
       * Update alle punten van een poule
       *
       * @param integer $poule_id  ID van de poule
       * @return array
       */
	public function updatePointsForPoule($poule_id) 
	{
		$data = $this->updatePointsForPouleProcess($poule_id);

		return $data;
	}

	/**
       * 
       * Laat zien of de correcte landen zijn ingevuld
       *
       * @param integer $poule_id  ID van de poule
       * @return boolean
       */
	public function areCorrectCountriesFilled($poule_id) 
	{
		if($data = $this->countFirstCorrectCountry($poule_id)['count'] > 0) {
			return true;
		} else {
			return false;
		}
	}
}

?>