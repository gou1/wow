<?php

use Manialib\Manialink\Elements\Manialink;
use Manialib\Manialink\Elements\Timeout;
use Manialib\XML\Rendering\Renderer;
use Nadeo\Live\ManiadogeBundle\Manialinks\DogeCard;

$manialink = (new Manialink())
    ->appendChild(new Timeout());

DogeCard::fromEntity($doge)
    ->setBothAlign('center', 'center')
    ->setSizen(100, 100)
    ->appendTo($manialink)
    ->getBg()->setManialink($view['router']->generate('maniadoge_index', [], true));

echo (new Renderer())->getXML($manialink);
