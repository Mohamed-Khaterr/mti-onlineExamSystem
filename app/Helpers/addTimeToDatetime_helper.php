<?php

function addTimeToDatetime($date, $duration){
	$hours = date('H', strtotime($duration));
	$minutes = date('i', strtotime($duration));
	$second = date('s', strtotime($duration));
	
	$newDate = date('Y-m-d H:i:s', strtotime($date . " +" . $hours . " hours". " + " . $minutes . " minutes" .  " + " . $second . " second"));
	
	
	return $newDate;
}


?>