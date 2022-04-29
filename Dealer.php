<?php

namespace BlackJack;

class Dealer extends Player
{
    public string $name;
    public function __construct()
    {
        $this->name = 'ディーラー';
        $this->hand = new Hand();
    }

    public function displayDrewCard()
    {
        $card = $this->getAddedCard();
        if (count($this->hand->showHand()) === 2) {
            echo 'ディーラーの２枚めのカードはわかりません。' . PHP_EOL;
        } else {
            echo $this->name . 'は' . $card->convertToString() . 'を引きました。' . PHP_EOL;
        }
    }

    public function showSecondCard()
    {
        $card = $this->hand->showHand();
        $secondCard = $card[1];
        echo $this->name . 'の２枚目のカードは' . $secondCard->convertToString() . 'でした。' . PHP_EOL;
    }

    public function isOverMax(): bool
    {
        return $this->hand->isOverMax();
    }
}