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
     * @Get("/doges/{id}")
     * @View(template="ManiadogeBundle:Api:data.html.twig", templateVar="data")
     */
    public function getDogeAction(Doge $doge)
    {
        return $doge;
    }

    /**
     * @Get("/doges/new")
     * @View(template="ManiadogeBundle:Api:form.html.twig", templateVar="form")
     */
    public function newDogeAction()
    {
        return $this->createForm(new DogeType(), null, ['action' => $this->generateUrl('v1_api_post_doge')])
                ;
    }

    /**
     * @Post("/doges")
     * @View(template="ManiadogeBundle:Api:data.html.twig", templateVar="data")
     */
    public function postDogeAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $form = $this->createForm(new DogeType())->handleRequest($request);
        if($form->isValid())
        {
            $doge = $form->getData();
            $this->getDoctrine()->getManager()->persist($doge);
            $this->getDoctrine()->getManager()->flush();

            return $this->routeRedirectView('v1_api_get_doge', ['id'=>$doge->getId()] );
        }
        throw new \InvalidArgumentException($form->getErrors());
    }

}
