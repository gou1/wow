<?php

namespace Nadeo\Live\ManiadogeBundle\Controller;

use Nadeo\Live\ManiadogeBundle\Entity\Doge;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{

    /**
     * @return Response
     */
    protected function restResponse($data, $_format)
    {
        $serializerFormat = $_format == 'html' ? 'yml' : $_format;
        $templateFormat   = $_format == 'html' ? 'html' : 'mixed';
        $serializedData   = $this->get('jms_serializer')->serialize($data, $serializerFormat);

        return $this->render('ManiadogeBundle:Api:response.'.$templateFormat.'.php', ['data' => $serializedData]);
    }

    public function getDogesAction($_format)
    {
        $doges = $this->getDoctrine()->getManager()->getRepository(Doge::class)->findAll();
        return $this->restResponse($doges, $_format);
    }

    /**
     * @ParamConverter("doge", class="ManiadogeBundle:Doge")
     */
    public function getDogeAction(Doge $doge, $_format)
    {
        return $this->restResponse($doge, $_format);
    }
}
