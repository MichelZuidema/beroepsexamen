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

	protected function getPouleAdmin($poule_id) 
	{
		$sql = "SELECT poule_administrator_id FROM poule WHERE poule_id = $poule_id";

		$result = $this->connect()->query($sql);
        $rows = $result->num_rows;

        if ($rows > 0) {
            $row = $result->fetch_assoc();
            $data[] = $row;

            return $data;
        } else {
            return "No results found!";
        }
	}

	protected function getAllUsersFromPoule($poule_id) 
	{
		$sql = "SELECT * FROM user LEFT JOIN user_poule ON user_poule.user_id = user.user_id WHERE user_poule.poule_id = $poule_id";
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

	protected function getSelectedCountryProcess($user_id, $poule_id, $number) 
	{
		$sql = "SELECT user_sel_country_$number FROM user_poule WHERE user_id = $user_id AND poule_id = $poule_id";

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

	protected function getCorrectCountriesForPoule($poule_id) 
	{
		$sql = "SELECT correct_country_id_1, correct_country_id_2, correct_country_id_3, correct_country_id_4 FROM poule WHERE poule_id = $poule_id";

		$result = $this->connect()->query($sql);
        $rows = $result->num_rows;

        if ($rows > 0) {
            $row = $result->fetch_assoc();
            $data[] = $row;

            return $data;
        } else {
            return null;
        }
	}

	protected function updatePointsForUserByPoule($user_id, $poule_id, $points) 
	{
		$sql = "UPDATE user_poule SET points = $points WHERE user_id = $user_id AND poule_id = $poule_id";

		if($this->getConnection()->query($sql)) {
			return true;
		} else {
			return false;
		}
	}

	protected function updatePointsForPouleProcess($poule_id)
	{
		$correctCountries = $this->getCorrectCountriesForPoule($poule_id);
		$pouleMembers = $this->getAllUsersFromPoule($poule_id);

		foreach($pouleMembers as $member) {
			$totalPoints = 0;

			if($member['user_sel_country_1'] != 0 || $member['user_sel_country_1'] != null) {
				if($member['user_sel_country_1'] == $correctCountries[0]['correct_country_id_1']) {
					$totalPoints += 10;
				}
			}

			if($member['user_sel_country_2'] != 0 || $member['user_sel_country_2'] != null) {
				if($member['user_sel_country_2'] == $correctCountries[0]['correct_country_id_2']) {
					$totalPoints += 6;
				}
			}

			if($member['user_sel_country_3'] != 0 || $member['user_sel_country_3'] != null) {
				if($member['user_sel_country_3'] == $correctCountries[0]['correct_country_id_3']) {
					$totalPoints += 4;
				}
			}

			if($member['user_sel_country_4'] != 0 || $member['user_sel_country_4'] != null) {
				if($member['user_sel_country_4'] == $correctCountries[0]['correct_country_id_4']) {
					$totalPoints += 2;
				}
			}

			for($i = 1; $i < 5; $i++) {
				if($member["user_sel_country_$i"] != 0 || $member["user_sel_country_2"] != null) {
					if(in_array($member["user_sel_country_$i"], $correctCountries[0])) {
						$totalPoints += 1;
					}
				}
			}

			$this->updatePointsForUserByPoule($member['user_id'], $poule_id, $totalPoints);
		}
	}

	protected function countFirstCorrectCountry($poule_id) 
	{
		$sql = "SELECT COUNT(poule.correct_country_id_1) AS count FROM poule WHERE poule.poule_id = $poule_id";

		$result = $this->connect()->query($sql);
        $rows = $result->num_rows;

        $row = $result->fetch_assoc();

        return $row;
	}
}

?>