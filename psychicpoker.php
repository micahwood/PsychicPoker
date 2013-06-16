<?php

require_once('Deck.php');

$deck = new Deck;

$deck->shuffle();

echo $deck;

$hand = $deck->deal();
echo "\n\rHAND:";
foreach ($hand as $card) {
	echo $card . ' ';
}
echo "\n\rAfter deal";
echo $deck;

/*echo "\n\n\n";
echo "INPUT\n";
echo $deck->psychicPeek();
echo "\n";
echo "Hand: $hand Deck: " . $deck->psychicPeek . " Best hand: ";*/