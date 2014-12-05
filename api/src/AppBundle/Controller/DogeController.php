<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Doge;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\GeneratorBundle\Tests\Generator\DoctrineEntityGeneratorTest;

class DogeController extends FOSRestController
{
    /**
     * @ApiDoc(resource=true, description="Lists the doges")
     * @Get("/doges")
     * @View()
     */
    public function getDogesAction()
    {
        return $this->getDoctrine()->getManager()->getRepository(Doge::class)->findAll();
    }

    /**
     * @ApiDoc(description="Gets a doge")
     * @Get("/doges/{id}")
     * @View()
     * @ParamConverter(class="AppBundle:Doge")
     */
    public function getDogeAction(Doge $doge)
    {
        return $doge;
    }
} 