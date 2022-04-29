<?php

namespace BlackJack;

class Hand
{
    const BLACK_JACK = 21;
    const BUST = 22;

    const DEALER_MAX = 17;

    public array $handCard = [];
    public function __construct()
    {
    }

    public function add(Card $card)
    {
        array_push($this->handCard, $card);
    }

    public function showHand(): array
    {
        return $this->handCard;
    }

    public function getLatestCard(): Card
    {
        return end($this->handCard);
    }

    public function calculateHandScore(): int
    {
        $totalScore = [];
        foreach ($this->handCard as $card) {
            $totalScore[] += $card->getScore();

        }
        if (in_array(Rank::RANK_ACE, $totalScore)) {
            $aceCount = array_count_values($totalScore)[1];
            for ($i = 0; $i < $aceCount; $i++) { 
                if (self::BLACK_JACK - array_sum($totalScore) >= 10) {
                    $totalScore[] += 10;
                }
            }
        }
        return array_sum($totalScore);
    }

    public function isBlackJack(): bool 
    {
        return $this->calculateHandScore() === self::BLACK_JACK;
    }

    public function isBust(): bool
    {
        return $this->calculateHandScore() >= self::BUST;
    }

    public function isOverMax(): bool
    {
        return $this->calculateHandScore() >= self::DEALER_MAX;
    }
}