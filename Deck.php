<?php

namespace BlackJack;

require_once('DeckInterface.php');

class Deck implements DeckInterface
{
    private array $deck = [];

    public function __construct()
    {
        foreach (Suit::SUIT as $suit) {
            foreach(Rank::RANK as $rank) {
                $this->deck[] = new Card(new Suit($suit), new Rank($rank));
            }
        }
    }

    public function shuffleDeck()
    {
        shuffle($this->deck);
    }

    public function draw()
    {   
        $current = current($this->deck);
        next($this->deck);
        return $current;
    }
}