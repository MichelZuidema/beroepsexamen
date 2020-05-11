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
			return true;
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
}

?>