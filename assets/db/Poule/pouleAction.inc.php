<?php

class pouleAction extends Poule {
	public function createPoule($administrator_id, $pouleName) 
	{
		if($this->createPouleProcess($administrator_id, $pouleName)) {
			return true;
		} else {
			return false;
		}
	}

	public function addUserToPoule($user_id, $poul_id) 
	{
		if($this->addUserToPouleProcess($user_id, $poul_id)) {
			return $poul_id;
		} else {
			return false;
		}
	}

	public function lastPouleId() {
		return $this->getLastPouleId();
	}

	public function showAllPoulesForUser($user_id)
	{
		$data = $this->getAllPoulesForUser($user_id);

		return $data;
	}

	public function showPouleName($poule_id) {
		$data = $this->getPouleName($poule_id)['poule_name'];

		return $data;
	}

	public function isPouleAdmin($poule_id, $user_id) {
		$data = $this->getPouleAdmin($poule_id);

		if($data[0]['poule_administrator_id'] == $user_id) {
			return true;
		} else {
			return false;
		}
	}

	public function showAllUsersForPoule($poule_id) {
		$data = $this->getAllUsersFromPoule($poule_id);

		return $data;
	}

	public function getSelectedCountry($user_id, $poule_id, $number) {
		$data = $this->getSelectedCountryProcess($user_id, $poule_id, $number);

		return $data;
	}

	public function pointsOfUser($user_id, $poule_id) {
		$data = $this->getPointsOfUsers($user_id, $poule_id);

		return $data;
	}
}

?>