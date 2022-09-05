<?php

require __DIR__ . '/Season.php';
require __DIR__ . '/Episode.php';

$season = new Season('Temporada 6');
$season->setEpisode('1 - Intro', 'Descrição Teste');

print $season->getEpisode()->getTitle() . ' ' . $season->getEpisode()->getDescription();
