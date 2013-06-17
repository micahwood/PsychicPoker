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
	 * Alternatively if you pass a string it will construct a deck from that
	 */
	public function __construct() {
		$this->cards = array();
		//overloading constructor to allow passing a string for a given deck
		if (func_num_args() == 1) {
			$givenDeck = func_get_arg(0);
			if (gettype($givenDeck) !== 'string') {
				return null;
			}
			$givenDeck = explode(' ', $givenDeck);
			foreach ($givenDeck as $card) {
				$v = substr($card, 0, 1);
				$s = substr($card, 1, 1);
				array_push($this->cards, new Card($v, $s));
			}
			return; //Don't add 52 more cards to the deck please...
		}
		// A string of all of the possible values and suits
		$values = 'A23456789TJQK';
		$suits = 'CDHS';

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