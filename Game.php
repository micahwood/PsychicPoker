<?php

class Game {

	private static $allHands = array('highest-card', 'one-pair', 'two-pairs', 'three-of-a-kind', 
		'straight', 'flush', 'full-house', 'four-of-a-kind', 'straight-flush');

	/**
	 * Find the best possible hand from all possible combinations
	 * @param  Card[] $hand
	 * @param  Card[] $topOfDeck
	 * @return string
	 */
	public static function bestHand($hand, $topOfDeck) {
		//merge the $hand and $topOfDeck arrays to find the best possible hand
		// of all 10 cards
		$bestTotal = self::getHandValue(array_merge($hand, $topOfDeck));
		$highestHand = 0;


		return self::$allHands[$highestHand];
	}
	public static function getHandValue($hand) {
		
		
		// create an array of the values and suits of all cards. 
		// Values used for finding straights, full house, pairs and high card
		// Suits for finding flushes
		$cardValues = array();
		$cardSuits = array();
		foreach ($hand as $card) {
			array_push($cardValues, $card->getValue());
			array_push($cardSuits, $card->getSuit());
		}

		if (self::flush($cardSuits) && self::straight($cardValues)) {
			return 8; //straight-flush;
		}
		else if (self::kind(4, $cardValues)) {
			return 7; //four-of-a-kind
		}
		else if (self::kind(3, $cardValues) && self::kind(2, $cardValues)) {
			return 6; //full-house
		} 
		else if (self::flush($cardSuits)) {
			return 5; //flush
		}
		else if (self::straight($cardValues)) {
			return 4; //straight
		}
		else if (self::kind(3, $cardValues)) {
			return 3; //three-of-a-kind
		}
		else if (self::twoPair($cardValues)) {
			return 2; //two-pair
		}
		else if (self::kind(2, $cardValues)) {
			return 1; //one-pair
		}
		else {
			return 0; //highest-card
		}
	}
	/**
	 * Returns true if a given hand contains $num of a kind
	 * @param  int $num
	 * @param  Card[] $hand
	 * @return bool
	 */
	public static function kind($num, $values) {
		$counts = array_count_values($values);
		return in_array($num, $counts);
	}

	public static function twoPair($values) {
		return false;
	}
	public static function straight($values) {
		// copy original array to not mutate it and sort the copy
		$sorted = $values;
		rsort($sorted);
		// if there is a straight the difference between 
		// the first and last cards will be -1
		$last = array_slice($sorted, -1);
		return $sorted[0] - $last[0] === 4;
	}

	public static function flush($suits) {
		$counts = array_count_values($suits);
		foreach ($counts as $count) {
			if ($count === 5) {
				return true;
			}
		}
		return false;
	}
}