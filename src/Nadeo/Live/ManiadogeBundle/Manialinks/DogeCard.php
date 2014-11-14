<?php

namespace Nadeo\Live\ManiadogeBundle\Manialinks;

use Manialib\Manialink\Cards\LabelBox;
use Nadeo\Live\ManiadogeBundle\Entity\Doge;

class DogeCard extends LabelBox
{

    static function fromEntity(Doge $doge)
    {
        $ui = new self;
        $ui->getBg()->setImage($doge->getImageUrl());
        $ui->getLabel()->setText($doge->getName());
        return $ui;
    }

    function __construct()
    {
        parent::__construct();
        $this->setSizen(50, 50);
    }
}
