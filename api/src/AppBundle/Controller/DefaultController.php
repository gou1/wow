<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class DefaultController extends FOSRestController
{
    /**
     * @ApiDoc(resource=true, description="Foobar")
     * @Get("/foobar")
     * @View()
     */
    public function getFoobarAction()
    {
        return ['foo' => 'bar', 'bar' => 'foo'];
    }
}
