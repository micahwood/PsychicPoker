<?php

require_once('Deck.php');

$deck = new Deck;

$deck->shuffle();

$deck->printString();

$hand = $deck->deal();
echo "\nHAND:";
foreach ($hand as $card) {
	echo $card->printString() . ' ';
}
echo "\nAfter deal";
$deck->printString();