<?php

require_once('Deck.php');
require_once('Game.php');

if ($argc > 1 && $argv[1] == 'file') {
	return load_file();
}

$deck = new Deck();
$deck->shuffle();
for ($i=0; $i < 5; $i++) { 
	$hand = $deck->deal();
	$bestHand = Game::bestHand($hand, $deck->psychicPeek());
	echo "Game $i:\n";
	echo "Hand: " . print_hand($hand) . "Deck: " . $deck . " Best hand: $bestHand\n";
}

function load_file() {
	$decks = array();
	//load the decks from input.txt and save them to the $decks array
	$fo = fopen('input.txt', 'r');
	if ($fo) {
		$i = 0;
		while ($buffer = fgets($fo)) {
			$decks[$i] = $buffer;
			$i++;
		}
		fclose($fo);
	}
	// create a Deck from each string in $decks array
	foreach ($decks as $deck) {
		$pokerGame = new Deck($deck);
		$hand = $pokerGame->deal();
		$bestHand = Game::bestHand($hand, $pokerGame->getCards());
		echo "Hand: ". print_hand($hand) . "Deck: $pokerGame Best hand: $bestHand\n";
	}
}
function print_hand($hand) {
	$ret = '';
	foreach ($hand as $card) {
		$ret .= $card . ' ';
	}
	return $ret;
}
