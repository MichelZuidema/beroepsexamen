<?php

class Country extends Database {
	protected function getCountryList() 
	{
		$sql = "SELECT * FROM country";

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

    protected function getCorrectCountryList($number, $poule_id) 
    {
        $sql = "SELECT correct_country_id_$number FROM poule WHERE poule_id = $poule_id";

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

    protected function setSelectedCorrectCountry($number, $country_id, $poule_id) 
    {
        $sql = "UPDATE poule SET correct_country_id_$number = $country_id WHERE poule_id = $poule_id";

        if($this->getConnection()->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}

?>