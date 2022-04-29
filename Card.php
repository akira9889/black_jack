<?php

namespace BlackJack;

require_once('Suit.php');
require_once('Rank.php');

class Card
{
    public function __construct(private $suit, private $rank)
    {
        $this->suit = $suit;
        $this->rank = $rank;
    }

    public function getSuit(): string
    {
        return $this->suit->getSuit();
    }

    public function getRank(): int
    {
        return $this->rank->getRank();
    }

    public function getScore()
    {
        return $this->rank->getScore();
    }

    public function convertToString(): string
    {
        return $this->suit->convertToString() . 'の' . $this->rank->convertToString();
    }
}