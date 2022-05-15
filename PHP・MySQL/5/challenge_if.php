<?php
	$number=mt_rand(1,6);
	if($number%2==0){
		$parity='even';
	}
	else{
		$parity='odd';
	}
	echo$number.', '.$parity;
?>