<?php

namespace BlackJack;

require_once('Deck.php');
require_once('Hand.php');
require_once('Card.php');


class Player
{
    public Hand $hand;
    public function __construct(public string $name)
    {
        $this->name = $name;
        $this->hand = new Hand();
    }
    
    public function addHand(Card $card)
    {
        $this->hand->add($card);
    }

    public function getAddedCard()
    {
        return $this->hand->getLatestCard();
    }

    public function displayDrewCard()
    {
        $card = $this->getAddedCard();
        echo $this->name . 'は' . $card->convertToString() . 'を引きました。' . PHP_EOL;
    }

    public function getScore(): int
    {
        return $this->hand->calculateHandScore();
    }

    public function displayScore()
    {
        $string = '';
        if (count($this->hand->showHand()) !== 1) {
            $string = $this->name . 'の現在の得点は' . $this->hand->calculateHandScore() . 'です。' . PHP_EOL;
        }
        echo $string;
    }

    public function wantsToDraw(): bool
    {
        $answer = strtolower(trim(fgets(STDIN)));
        return $answer === 'y';
    }

    public function autoDraw(): bool
    {
        $this->displayScore();
        return $this->hand->calculateHandScore() < 17;
    }

    public function isBust(): bool
    {
        return $this->hand->isBust();
    }
}