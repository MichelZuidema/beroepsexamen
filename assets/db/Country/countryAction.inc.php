<?php

class countryAction extends Country {
	public function countryList() 
	{
		$data = $this->getCountryList();

		return $data;
	}
}

?>