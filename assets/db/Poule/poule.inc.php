<?php

/**
 * Class Country
 *
 * @subpackage Database
 * @author     Michel Zuidema <michelgzuidema@gmail.com>
 */
class Poule extends Database {
	/**
       * 
       * Creëert de nieuwe poule in de database
       *
       * @param integer $administrator_id  ID van de administrator die de poule aanmaakt
       * @param string $pouleName  Naam van de poule
       * @return boolean
       */
	protected function createPouleProcess($administrator_id, $pouleName) 
	{
		$sql = "INSERT INTO poule (poule_id, poule_administrator_id, poule_name) VALUES (NULL, $administrator_id, '$pouleName')";

		if($this->getConnection()->query($sql)) {
			return true;
		} else {
			return false;
		}
	}

	/**
       * 
       * Voegt een gebruiker toe aan een poule
       *
       * @param integer $user_id  ID van de user om toe te voegen
       * @param integer $poule_id  ID van de poule om aan toe te voegen
       * @return boolean
       */
	protected function addUserToPouleProcess($user_id, $poul_id) 
	{
		$sql = "INSERT INTO user_poule (user_id, poule_id) VALUES ($user_id, $poul_id)";

		if($this->getConnection()->query($sql)) {
			return true;
		} else {
			return false;
		}
	}

	/**
       * 
       * Zoekt de laatst toegevoegde ID
       *
       * @return integer
       */
	protected function getLastPouleId() 
	{
		return $this->getConnection()->insert_id;
	}

	/**
       * 
       * Zoekt alle poules voor een gebruiker
       *
       * @param integer $user_id  ID van de gebruiker waarop gezocht moet worden
       * @return array
       */
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
            return "empty";
        }
	}

	/**
       * 
       * Zoekt de naam van een poule
       *
       * @param integer $poule_id  ID van de poule waarop gezocht moet worden
       * @return array
       */
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

	/**
       * 
       * Zoekt de administrator van een poule
       *
       * @param integer $poule_id  ID van de poule waarop gezocht moet worden
       * @return array
       */
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

	/**
       * 
       * Zoekt alle leden van een poule
       *
       * @param integer $poule_id  ID van de poule waarop gezocht moet worden
       * @return array
       */
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

	/**
       * 
       * Zoekt het geselecteerde land van een gebruiker
       *
       * @param integer $user_id  ID van de user waarop gezocht moet worden
       * @param integer $poule_id  ID van de poule waarop gezocht moet worden
       * @param integer $number  Welk land geselecteerd moet worden ( 1 - 4)
       * @return array
       */
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

	/**
       * 
       * Zoekt de correcte landen van een poule
       *
       * @param integer $poule_id  ID van de poule waarop gezocht moet worden
       * @return array
       */
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

	/**
       * 
       * Update de punten van een gebruiker
       *
       * @param integer $user_id  ID van de user waar de punten van aangepast moeten worden
       * @param integer $poule_id  ID van de poule waarop gezocht moet worden
       * @return boolean
       */
	protected function updatePointsForUserByPoule($user_id, $poule_id, $points) 
	{
		$sql = "UPDATE user_poule SET points = $points WHERE user_id = $user_id AND poule_id = $poule_id";

		if($this->getConnection()->query($sql)) {
			return true;
		} else {
			return false;
		}
	}

	/**
       * 
       * Berekend de punten per poule
       *
       * @param integer $poule_id ID van de poule die berekend moet worden
       */
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

	/**
       * 
       * Bekijkt of het eerste correcte land is ingevuld van een poule
       *
       * @param integer $user_id  ID van de user waarop gezocht moet worden
       * @return array
       */
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