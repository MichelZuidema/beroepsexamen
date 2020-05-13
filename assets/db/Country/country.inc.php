<?php

/**
 * Class Country
 *
 * @subpackage Database
 * @author     Michel Zuidema <michelgzuidema@gmail.com>
 */
class Country extends Database {
    /**
      * Zoekt alle landen in de landen tabel
      * 
      * @return array van landen
      */
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

    /**
       * 
       * Zoekt het juiste land op basis van nummer en poule id
       *
       * @param integer $number  Nummer van het land dat je wilt zoeken ( 1 - 4)
       * @param integer $poule_id  Poule ID
       * @return array van correcte land
       */
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

    /**
       * 
       * Zet het correcte land in de database
       *
       * @param integer $number  Nummer van het land dat je wilt zoeken ( 1 - 4)
       * @param integer $country  Country ID
       * @param integer $poule_id  Poule ID
       * @return boolean
       */
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