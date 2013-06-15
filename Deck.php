<?php

require_once('Card.php');

class Deck {
	/**
	 * An array of 52 Cards
	 * @var Card
	 */
	private $cards;

	/**
	 * Constructor
	 * Fills the deck with 52 cards
	 */
	public function __construct() {
		// A string of all of the possible values and suits
		$values = 'A23456789TJQK';
		$suits = 'CDHS';
		$this->cards = array();

		for($i = 0; $i < 52; $i++) {
			// Use the value and suit strings to create one of each possible card
			$v = substr($values, $i % 13, 1);
			$s = substr($suits, $i % 4, 1);
			array_push($this->cards, new Card($v, $s));
		}
		
	}

	public function shuffle() {
		shuffle($this->cards);
	}

	public function deal() {
		return array_splice($this->cards, 0, 5);
	}

	public function printString() {
		for ($i=0; $i < $this->getCount(); $i++) { 
			if ($i % 10 === 0) {
				echo "\n";
			}
			echo $this->cards[$i]->printString() . ' ';
		}
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

	public function psychicPeek() {
		return array_slice($this->cards, 0, 5);
	}
}