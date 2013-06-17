<?php

require_once('Game.php');
require_once('Card.php');
class GameTest extends PHPUnit_Framework_TestCase {

	public function testHighCard() {
		$hand = self::makeHand('3D 5S 2H QD TD');
		$topOfDeck = self::makeHand('6S KH 9H AD 7H');
		$this->assertEquals('highest-card', Game::bestHand($hand, $topOfDeck), 
			'bestHand did not return the correct high card');
	}
	public function testKind() {
		$values = array(11, 11, 3, 4, 6);
		$this->assertTrue(Game::kind(2, $values), 'kind did not find one pair');
	}
	public function testThreeOfAKind() {
		$hand = self::makeHand('KS AH 2H 3C 4H');
		$topOfDeck = self::makeHand('KC 2C TC 2D AS');
		$this->assertEquals('three-of-a-kind', Game::bestHand($hand, $topOfDeck), 
			'bestHand did not find three of a kind');
	}
	public function testStraight() {
		$hand = array(9, 5, 6, 8, 7);
		$this->assertTrue(Game::straight($hand), 'Failed to find a straight');
	}
	public function testFlush() {
		$hand = self::makeHand('2H AD 5H AC 7H');
		$topOfDeck = self::makeHand('AH 6H 9H 4H 3C');
		$this->assertEquals('flush', Game::bestHand($hand, $topOfDeck), 
			'bestHand did not find a flush');
	}
	public function testFullHouse() {
		$hand = self::makeHand('2H 2S 3H 3S 3C');
		$topOfDeck = self::makeHand('2D 9C 3D 6C TH');
		$this->assertEquals('full-house', Game::bestHand($hand, $topOfDeck), 
			'bestHand did not notice a full house');
	}

	// helper function for creating test hands more easily
	private function makeHand($strHand) {
		$ret = array();
		$arrHand = explode(' ', $strHand);
		foreach ($arrHand as $valueSuitString) {
			$v = substr($valueSuitString, 0, 1);
			$s = substr($valueSuitString, 1, 1);
			array_push($ret, new Card($v, $s));
		}
		return $ret;
	}
}