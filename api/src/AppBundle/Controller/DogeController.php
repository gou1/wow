<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Doge;
use AppBundle\Handler\DogeHandler;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;

class DogeController extends FOSRestController
{

    /**
     * @return DogeHandler
     */
    protected function getHandler()
    {
        return $this->get('app.handler.doge');
    }

    /**
     * @ApiDoc(resource=true, description="Lists the doges")
     * @Get("/doges")
     */
    public function getDogesAction()
    {
        return $this->getHandler()->getDoges();
    }

    /**
     * @ApiDoc(description="Gets a doge")
     * @Get("/doges/{id}")
     * @ParamConverter(class="AppBundle:Doge")
     */
    public function getDogeAction(Doge $doge)
    {
        return $doge;
    }

    /**
     * @ApiDoc(description="Form to post a new Doge")
     * @Get("/doges/new")
     * @View(templateVar = "form")
     * @return FormTypeInterface
     */
    public function newDogeAction()
    {
        return $this->getHandler()->createForm(null, ['action' => $this->generateUrl('post_doge')]);
    }



    /**
     * @ApiDoc(description="Creates a new Doge")
     * @Post("/doges")
     */
    public function postDogeAction(Request $request)
    {
        $doge = $this->getHandler()->post($request);
        return $this->routeRedirectView(
            'get_doge',
            ['id' => $doge->getId(), '_format' => $request->getFormat('_format')],
            Codes::HTTP_CREATED);
    }
} 