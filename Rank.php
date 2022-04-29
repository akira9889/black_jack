<?php

namespace BlackJack;

class Rank
{

    const RANK_ACE = 1;
    const RANK_KING = 13;
    const RANK_QUEEN = 12;
    const RANK_JACK = 11;

    const RANK = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];


    public function __construct(private int $rank)
    {
        $this->rank = $rank;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function convertToString(): string
    {
        $string = '';

        switch ($this->rank) {
            case self::RANK_ACE:
                $string = 'A';
                break;
            case self::RANK_JACK:
                $string = 'J';
                break;
            case self::RANK_QUEEN:
                $string = 'Q';
                break;
            case self::RANK_KING:
                $string = 'K';
                break;
            default:
                $string = $this->getRank();
        }

        return $string;
    }

    public function getScore()
    {
        return $this->rank < self::RANK_JACK ? $this->getRank() : 10;
    }
}