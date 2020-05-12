<?php
function sortArrayOnPoints($array) {
	$points = array_column($array, "points");
	array_multisort($points, SORT_DESC, $array);
	return $array;
}
?>