<?php

require_once('Deck.php');
class DeckTest extends PHPUnit_Framework_TestCase {
	protected $deck;

	public function setUp() {
		$this->deck = new Deck;
	}

	public function testDeckIs52Cards() {
		$this->assertEquals(52, $this->deck->getCount(), 
			'The initial deck is less than 52 cards');
	}

	public function testDeckHasNoDuplicates() {
		$this->assertTrue(
			$this->deck->getCount() === count(array_unique($this->deck->getCards())), 
			'Deck contains duplicate cards');
	}

	public function testDeckOnlyContainsCards() {
		$this->assertContainsOnly('card', $this->deck->getCards(), false, 
			'The deck does not just contain cards');
	}

	// Test that deal() returns an array of 5 cards
	public function testDealReturns5Cards() {
		$hand = $this->deck->deal();
		$this->assertEquals(5, count($hand), 'Deal does not return 5 cards');
	}
	// Test that the deck array was shrunk by 5 after the deal
	public function testDealRemoved5CardsFromDeck() {
		$this->deck->deal();
		$this->assertEquals(47, $this->deck->getCount(), 
			'Deal did not remove 5 cards from the deck');
	}

	public function testPsychicPeekDoesNotModifyLength() {
		$this->deck->psychicPeek();
		$this->assertEquals(52, $this->deck->getCount(), 
			'psychicPeek shortened the length of the deck');
	}
}