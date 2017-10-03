<?php

function valRange($val, $range, $default = 0) {
	foreach ($range as $key => $value) {
		if($key >= $val)
			return $value;
	}
	return $default;
}

function valRangeInv($val, $range, $default = 0) {
	foreach ($range as $key => $value) {
		if($key < $val)
			return $value;
	}
	return $default;
}

?>