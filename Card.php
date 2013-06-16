<?php

class Card {
	/**
	 * The face value of the card
	 * order of precedence is A=Ace, 2-9, T=10, J=Jack, Q=Queen, K=King
	 * @var char
	 */
	private $value;
	/**
	 * The suit of the card - C=Clubs, D=Diamonds, H=Hearts, S=Spades
	 * @var char
	 */
	private $suit;

	/**
	 * Constructor
	 *
	 * @param char $value 	The face value of the card
	 * @param char $suit 	The suit of the card
	 */
	public function __construct($value, $suit) {
		$this->value = $value;
		$this->suit = $suit;
	}

	/**
	 * Returns the two character code for the card
	 * @return string
	 */ 
	public function __toString() {
		return $this->value . $this->suit;
	}


	/**
	 * Getters
	 */

	/**
	 * Return the numerical value of the card
	 * @return int
	 */
	public function getValue() {
		switch ($this->value) {

			case 'T':
				return 10;
			case 'J':	
				return 11;
			case 'Q':
				return 12;
			case 'K':
				return 13;
			case 'A':
				return 14;
			default:
				return $this->value;
		}
	}
	/**
	 * Return the character for the card's suit
	 * @return char
	 */
	public function getSuit() {
		return $this->suit;
	}
}