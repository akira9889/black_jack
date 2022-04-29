<?php

namespace BlackJack;

require_once('Player.php');
require_once('Dealer.php');

class Game
{
    private $players = [];
    private $dealer;
    public function __construct(array $players, private DeckInterface $deck = new Deck())
    {
        foreach ($players as $player) {
            $this->players[] = new Player($player);
        }

        $this->dealer = new Dealer();
        $this->deck = $deck;
    }


    public function start()
    {
        $this->shuffle($this->deck);

        foreach ($this->players as $player) {
            $this->drawCard($player, 2);
        }

        $this->drawCard($this->dealer, 2);

        foreach ($this->players as $key => $player) {
            if ($key === 0) {
                while (!$player->isBust() && $this->askDraw($player)) {
                    $this->drawCard($player);
                }
            } else {
                while (!$player->isBust() && $player->autoDraw()) {
                    $this->drawCard($player);
                }
            }

            if ($player->isBust()) {
                echo $player->name . 'はバーストしました。' . PHP_EOL;
            }
        }

        $this->dealer->showSecondCard();

        foreach ($this->players as $player) {
            $bool[] = !$player->isBust();
            while (!$this->dealer->isOverMax() && in_array(true, $bool)) {
                $this->drawCard($this->dealer);
            }
        }

        $this->judgeWinner();
    }

    private function shuffle(Deck $deck)
    {
        $deck->shuffleDeck();
    }

    private function drawCard(Player $player, int $num = 1)
    {
        $i = 0;
        while ($i < $num) {
            $card = $this->deck->draw();
            $player->addHand($card);
            $player->displayDrewCard();
            $i++;
        }
    }

    private function askDraw(Player $player)
    {
        $player->displayScore();
        if ($player->hand->isBlackJack()) {
            return;
        }
        echo 'カードを引きますか？（Y/N）' . PHP_EOL;
        return $player->wantsToDraw();
    }

    private function judgeWinner()
    {
        $dealerScore = $this->dealer->hand->calculateHandScore();
        foreach ($this->players as $player) {
            $playerScore = $player->hand->calculateHandScore();
            echo $player->name . 'の得点は' . $playerScore . 'です。' . PHP_EOL;
            echo $this->dealer->name . 'の得点は' . $dealerScore . 'です。' . PHP_EOL;;

            if ($player->isBust() && !$this->dealer->isBust()) {
                echo $this->dealer->name . 'の勝ちです！' . PHP_EOL;
            }
            
            if (!$player->isBust() && $this->dealer->isBust()) {
                echo $player->name . 'の勝ちです！' . PHP_EOL;
            }

            if (!$player->isBust() && !$this->dealer->isBust()) {
                if (Hand::BLACK_JACK - $playerScore < Hand::BLACK_JACK - $dealerScore) {
                    echo $player->name . 'の勝ちです！' . PHP_EOL;
                } elseif (Hand::BLACK_JACK - $playerScore > Hand::BLACK_JACK - $dealerScore) {
                echo $this->dealer->name . 'の勝ちです！' . PHP_EOL;
                } else {
                    echo '引き分けです。' . PHP_EOL;
                }
            }

            if ($player->isBust() && $this->dealer->isBust()) {
                echo '引き分けです。' . PHP_EOL;
            }
        }
        echo 'ブラックジャックを終了します。';
    }
}