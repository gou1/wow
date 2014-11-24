<?php

namespace Nadeo\Live\ManiadogeBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nadeo\Live\ManiadogeBundle\Entity\Doge;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ApiController extends FOSRestController
{

    /**
     * @ApiDoc(resource=true, description="Wow such api")
     * @Get("/doges")
     * @View(template="ManiadogeBundle:Api:data.html.twig", templateVar="data")
     */
    public function getDogesAction()
    {
        return $this->getDoctrine()->getManager()->getRepository(Doge::class)->findAll();
    }

    /**
     * @ApiDoc(description="very wow")
     * @Get("/doges/{name}")
     * @View(template="ManiadogeBundle:Api:data.html.twig", templateVar="data")
     * @ParamConverter("doge", class="ManiadogeBundle:Doge")
     */
    public function getDogeAction(Doge $doge)
    {
        return $doge;
    }
}
