<?php

require_once('Deck.php');
require_once('Game.php');

$decks = array();
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
function print_hand($hand) {
	foreach ($hand as $card) {
		echo $card . ' ';
	}
}