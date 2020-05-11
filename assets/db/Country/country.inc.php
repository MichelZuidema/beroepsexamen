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
}

?>