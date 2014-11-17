<?php

namespace Nadeo\Live\ManiadogeBundle\Manialinks;

use Manialib\Manialink\Elements\Frame;
use Manialib\Manialink\Elements\Manialink;
use Manialib\Manialink\Elements\Timeout;
use Manialib\Manialink\Layouts\Flow;

class Home extends Manialink
{

    function __construct(array $doges)
    {
        parent::__construct();

        $this->appendChild(new Timeout());

        $frame = (new Frame())
            ->setSizen(320, 180)
            ->setLayout((new Flow())->setMargin(5, 5))
            ->setPosn(-155, 80)
            ->appendTo($this);

        foreach ($doges as $doge) {
            DogeCard::fromEntity($doge)->appendTo($frame);
        }
    }
}
