<?php

class Poule extends Database {
	protected function createPouleProcess($administrator_id, $pouleName) {
		$sql = "INSERT INTO poule (poule_id, poule_administrator_id, poule_name) VALUES (NULL, $administrator_id, '$pouleName')";

		if($this->getConnection()->query($sql)) {
			return true;
		} else {
			return false;
		}
	}

	protected function addUserToPouleProcess($user_id, $poul_id) {
		$sql = "INSERT INTO user_poule (user_id, poule_id) VALUES ($user_id, $poul_id)";

		if($this->getConnection()->query($sql)) {
			return true;
		} else {
			return false;
		}
	}

	protected function getLastPouleId() {
		return $this->getConnection()->insert_id;
	}
}

?>