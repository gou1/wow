<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Doge;
use AppBundle\Handler\DogeHandler;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @QueryParam(name="limit", nullable=true, requirements="\d+", )
     * @QueryParam(name="offset", nullable=true, requirements="\d+", default="1")
     */
    public function getDogesAction(ParamFetcherInterface $paramFetcher)
    {
        $limit =  $paramFetcher->get('limit');
        $offset = $paramFetcher->get('offset', false);
        return $this->getHandler()->all($limit, $offset);
    }

    /**
     * @ApiDoc(description="Gets a doge")
     * @Route("/doges/{id}")
     * @ParamConverter(class="AppBundle:Doge")
     */
    public function getDogeAction(Doge $doge)
    {
        return $doge;
    }

    /**
     * @ApiDoc(description="Creates a new Doge")
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