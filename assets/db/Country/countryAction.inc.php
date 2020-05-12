<?php

class countryAction extends Country {
	public function countryList() 
	{
		$data = $this->getCountryList();

		return $data;
	}

	public function getCorrectCountry($number, $poule_id)
	{
		$data = $this->getCorrectCountryList($number, $poule_id);

		return $data;
	}

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