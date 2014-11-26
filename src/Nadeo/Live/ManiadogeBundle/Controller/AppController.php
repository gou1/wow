<?php

namespace Nadeo\Live\ManiadogeBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nadeo\Live\ManiadogeBundle\Entity\Doge;
use Nadeo\Live\ManiadogeBundle\Form\DogeType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AppController extends FOSRestController
{

    /**
     * @Get("/manialink");
     * @View(template="ManiadogeBundle:App:manialink.xml.php", templateVar="data")
     */
    public function getManialinkAction($_format)
    {
        return 'yo';
    }
}
