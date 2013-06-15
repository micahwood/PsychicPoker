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
	 * Getters
	 */

	/**
	 * Returns the two character code for the card
	 * @return string
	 */ 
	public function get_card() {
		return $this->value . $this->suit;
	}
	public function get_value() {
		return $this->value;
	}
	public function get_suit() {
		return $this->suit;
	}
}