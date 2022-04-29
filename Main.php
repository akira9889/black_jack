<?php

namespace BlackJack;

require_once('Game.php');

$game = new Game(['プレイヤー１', 'プレイヤー２']);
$game->start();