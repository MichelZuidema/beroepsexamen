<?php

/**
 * Class countryAction
 *
 * @subpackage Country
 * @author     Michel Zuidema <michelgzuidema@gmail.com>
 */
class countryAction extends Country {
	/**
        * Pakt de lijst met alle landen
        * 
        * @return array van landen
        */
	public function countryList() 
	{
		$data = $this->getCountryList();

		return $data;
	}

	/**
       * 
       * Pakt het correcte land op basis van nummer en Poule ID
       *
       * @param integer $number  Nummer van het land dat je wilt zoeken ( 1 - 4)
       * @param integer $poule_id  Poule ID
       * @return array van correcte land
       */
	public function getCorrectCountry($number, $poule_id)
	{
		$data = $this->getCorrectCountryList($number, $poule_id);

		return $data;
	}

	/**
       * 
       * Stuurt het juiste land door naar de Country class om daar op te slaan
       *
       * @param integer $number  Nummer van het land dat je wilt zoeken ( 1 - 4)
       * @param integer $country  Country ID
       * @param integer $poule_id  Poule ID
       * @return boolean
       */
	public function setCorrectCountry($number, $country_id, $poule_id)
    {
        if($this->setSelectedCorrectCountry($number, $country_id, $poule_id)) {
            return true;
        } else {
            return false;
        }
    }
}

?>