<?php

namespace BlackJack;

class Suit
{
    const CLUBS = 'C';
    const HEARTS = 'H';
    const DIAMONDS = 'D';
    const SPADES = 'S';
    const SUIT = [self::CLUBS, self::HEARTS, self::DIAMONDS, self::SPADES];

    public function __construct(private string $suit)
    {
        $this->suit = $suit;
    }

    public function getSuit()
    {
        return $this->suit;
    }

    public function convertToString(): string
    {
        $string = '';

        switch ($this->suit) {
            case self::CLUBS:
                $string = 'クラブ';
                break;
            case self::HEARTS:
                $string = 'ハート';
                break;
            case self::DIAMONDS:
                $string = 'ダイアモンド';
                break;
            case self::SPADES:
                $string = 'スペード';
                break;
        }

        return $string;
    }
}