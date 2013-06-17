<?php

class Game {

	/**
	 * An array of all the return values for a given hand
	 * @var string
	 */
	private static $allHands = array('highest-card', 'one-pair', 'two-pairs', 'three-of-a-kind', 
		'straight', 'flush', 'full-house', 'four-of-a-kind', 'straight-flush');

	/**
	 * Used to cache the results of all possible sets of a single hand
	 * Value is set in getAllCombinations function
	 * @var int[][]
	 */
	private static $allCombinations;
	/**
	 * Find the best possible hand from all possible combinations
	 * @param  Card[] $hand
	 * @param  Card[] $topOfDeck
	 * @return string
	 */
	public static function bestHand($hand, $topOfDeck) {
		//merge the $hand and $topOfDeck arrays to find the best possible hand
		// of all 10 cards
		$handAndDeck = array_merge($hand, $topOfDeck);
		// use best total to break out of loop early if the highest possible 
		// hand matches
		$bestTotal = self::getHandValue($handAndDeck);
		$highestHand = 0;
		self::getAllCombinations(count($hand));
		//check the value of each hand combination
		foreach (self::$allCombinations as $combo) {
			$testHand = array();
			//add cards from deck if needed
			if (count($combo) < 5) {
				$combo = self::drawCard($combo);
			}
			//build the current combination
			foreach ($combo as $card) {
			 	array_push($testHand, $handAndDeck[$card]);
			}
			$testTotal = self::getHandValue($testHand);
			if ($testTotal > $highestHand) {
				$highestHand = $testTotal;
			}
			if ($highestHand >= $bestTotal) {
				break; //We confirmed it is possible to make the best possible hand
			}
		} // next possible hand

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
		$pairs = 0;
		$counts = array_count_values($values);
		foreach ($counts as $count) {
			if ($count == 2) {
				$pairs++;
			}
		}
		return $pairs === 2;
	}
	public static function straight($values) {
		// copy original array to not mutate it and sort the copy
		$sorted = $values;
		rsort($sorted);
		//check that there are 5 unique values
		$size = count(array_count_values($sorted));
		// if there is a straight the difference between 
		// the first and last cards will be 4
		$last = array_slice($sorted, -1);
		$diff = $sorted[0] - $last[0];
		// an ace-low straight would give a difference of 12
		if ($diff === 12 && $sorted[0] === 14) {
			//treat ace as a 1
			$sorted[0] = 1;
			//check again
			return self::straight($sorted);
		}
		return $diff === 4 && $size === 5;
	}
	/**
	 * Count all of the suits in the hand
	 * @param  [type] $suits [description]
	 * @return [type]        [description]
	 */
	public static function flush($suits) {
		$counts = array_count_values($suits);
		foreach ($counts as $count) {
			if ($count === 5) {
				return true;
			}
		}
		return false;
	}
	/**
	 * Calculate all the possible sets of a single hand of 5 cards
	 * save it to the class variable $allCombinations to cache the result
	 * if $allCombinations is already set it instantly returns
	 */
	private static function getAllCombinations($size) {
		if (is_array(self::$allCombinations)) {
			return; //$allCombinations was already calculated
		}
		// allCombinations is an array of all of the possible combinations
		// of 5 cards - $allCombinations[hand][cards]
		self::$allCombinations = array(array());
		$base = array();
		//create an array of size $size - this will be used to build the set of
		//all possible indexes for that size of an array
		for ($i=0; $i < $size; $i++) { 
			array_push($base, $i);
		}
		for ($i=0; $i < count($base); $i++) { 
			//length will change on each iteration
			$len = count(self::$allCombinations);
			for ($j=0; $j < $len; $j++) { 
				//combine the current element in base with all possible subsets
				//and save it to the allCombinations array
				array_push(self::$allCombinations, 
					array_merge(self::$allCombinations[$j], array($base[$i])));
			}

		}
	}

	private static function drawCard($hand) {
    	$deck = array(5,6,7,8,9);
    	$size = 5 - count($hand);
    	if ($size > 5) return null;
    	$draw = array_splice($deck, 0, $size);
    	$res = array_merge($hand, $draw);
        return $res;
	}
}