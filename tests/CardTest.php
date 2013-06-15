<?php

require_once('Card.php');
class CardTest extends PHPUnit_Framework_TestCase {
	protected $card;
	
	public function setUp() {
		$this->card = new Card('K','C');
	}

	public function testCardHasValue() {
		$this->assertClassHasAttribute('value', 'card', 
			'Card class does not contain value');
	}

	public function testCardHasSuit() {
		$this->assertClassHasAttribute('suit', 'card', 
			'Card class does not contain suit');
	}
	// Test the return format of get_card
	public function testCardDisplaysValueAndSuit() {
		$this->assertSame('KC', $this->card->printString(),  
			'printString does not display the correct card code');
	}
}