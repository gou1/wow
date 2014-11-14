<?php

namespace Nadeo\Live\ManiadogeBundle\Manialinks;

class Home extends \Manialib\Manialink\Elements\Manialink
{

    function __construct(array $doges)
    {
        parent::__construct();

        $this->appendChild(new \Manialib\Manialink\Elements\Timeout());

        $frame = (new \Manialib\Manialink\Elements\Frame())
            ->setSizen(320, 180)
            ->setLayout((new \Manialib\Manialink\Layouts\Flow())->setMargin(10, 10))
            ->setPosn(-150, 80)
            ->appendTo($this);

        foreach ($doges as $doge) {
            DogeCard::fromEntity($doge)->appendTo($frame);
        }
    }
}
