<?php
/**
 *	Sorteerd array op de key 'points'
 * 
 * @param  array $array Array dat je wilt sorteren
 * @return array
 */
function sortArrayOnPoints($array) {
	$points = array_column($array, "points");
	array_multisort($points, SORT_DESC, $array);
	return $array;
}

/**
 * Genereerd een random string
 * 
 * @param  integer $length Lengte van random string
 * @return string
 */
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>