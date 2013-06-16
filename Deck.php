<?php

require_once('Card.php');

class Deck {

	/**
	 * Class constants
	 */
	const DECK_SIZE = 52;
	const HAND_SIZE = 5;
	/**
	 * An array of DECK_SIZE Cards
	 * @var Card
	 */
	private $cards;

	/**
	 * Constructor
	 * Fills the $cards array with DECK_SIZE cards
	 */
	public function __construct() {
		// A string of all of the possible values and suits
		$values = 'A23456789TJQK';
		$suits = 'CDHS';
		$this->cards = array();

		for($i = 0; $i < self::DECK_SIZE; $i++) {
			// Use the value and suit strings to create one of each possible card
			$v = substr($values, $i % 13, 1);
			$s = substr($suits, $i % 4, 1);
			array_push($this->cards, new Card($v, $s));
		}
		
	}

	public function shuffle() {
		shuffle($this->cards);
	}

	/**
	 * Returns an array of the top HAND_SIZE cards, removing them from the deck
	 * @return Card[]
	 */
	public function deal() {
		return array_splice($this->cards, 0, self::HAND_SIZE);
	}

	/**
	 * Returns an array of the top HAND_SIZE cards in the deck without removing them
	 * @return Card[]
	 */
	public function psychicPeek() {
		return array_slice($this->cards, 0, self::HAND_SIZE);
	}

	public function __toString() {
		$ret = "";
		for ($i=0; $i < $this->getCount(); $i++) { 
			if ($i % 10 === 0 && $i !== 0) {
				$ret .=" \n\r";
			}
			$ret .= $this->cards[$i] . " ";
		}
		return $ret;
	}

	/**
	 * Getters
	 */

	public function getCount() {
		return count($this->cards);
	}

	public function getCards() {
		return $this->cards;
	}

}