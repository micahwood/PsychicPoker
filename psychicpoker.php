<?php

require_once('Card.php');

$value = 'A23456789TJQK';
$suit = 'CDHS';

$deck = array();
for ($i = 0; $i < 52; $i++) {
	$v = substr($value, $i % 13, 1);
	$s = substr($suit, $i % 4, 1);
	$c = new Card($v, $s);
	array_push($deck, $c);
}
foreach ($deck as $card) {
	echo $card->get_card() . " ";
}