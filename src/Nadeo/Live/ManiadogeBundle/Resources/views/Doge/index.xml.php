<?php

use Manialib\Manialink\Elements\Frame;
use Manialib\Manialink\Elements\Manialink;
use Manialib\Manialink\Elements\Timeout;
use Manialib\Manialink\Layouts\Flow;
use Manialib\XML\Rendering\Renderer;
use Nadeo\Live\ManiadogeBundle\Manialinks\DogeCard;

$manialink = (new Manialink())
    ->appendChild(new Timeout());

$frame = (new Frame())
    ->setSizen(320, 180)
    ->setLayout((new Flow())->setMargin(5, 5))
    ->setPosn(-155, 80)
    ->appendTo($manialink);

foreach ($doges as $doge) {
    DogeCard::fromEntity($doge)
        ->appendTo($frame)
        ->getBg()->setManialink($view['router']->generate('maniadoge_doge', ['id' => $doge->getId()], true));
}

echo (new Renderer())->getXML($manialink);
?>