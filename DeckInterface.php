<?php

namespace BlackJack;
require_once('Card.php');


interface DeckInterface
{
    public function shuffleDeck();
    public function draw();
}