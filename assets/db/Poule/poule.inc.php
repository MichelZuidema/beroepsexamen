<?php

class Poule extends Database {
	protected function createPouleProcess($administrator_id, $pouleName) 
	{
		$sql = "INSERT INTO poule (poule_id, poule_administrator_id, poule_name) VALUES (NULL, $administrator_id, '$pouleName')";

		if($this->getConnection()->query($sql)) {
			return true;
		} else {
			return false;
		}
	}

	protected function addUserToPouleProcess($user_id, $poul_id) 
	{
		$sql = "INSERT INTO user_poule (user_id, poule_id) VALUES ($user_id, $poul_id)";

		if($this->getConnection()->query($sql)) {
			return true;
		} else {
			return false;
		}
	}

	protected function getLastPouleId() 
	{
		return $this->getConnection()->insert_id;
	}

	protected function getAllPoulesForUser($user_id) 
	{
		$sql = "SELECT * FROM poule LEFT JOIN user_poule ON user_poule.poule_id = poule.poule_id WHERE user_poule.user_id = $user_id";

		$result = $this->getConnection()->query($sql);
        $rows = $result->num_rows;

        if ($rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            return $data;
        } else {
            return null;
        }
	}

	protected function getPouleName($poule_id)
	{
		$sql = "SELECT poule_name FROM poule WHERE poule_id = $poule_id";

		$result = $this->getConnection()->query($sql);
        $rows = $result->num_rows;

        if ($rows > 0) {
            $data = $result->fetch_assoc();

            return $data;
        } else {
            return "No results found!";
        }
	}
}

?>