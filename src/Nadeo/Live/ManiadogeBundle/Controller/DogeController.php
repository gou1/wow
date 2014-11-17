<?php

namespace Nadeo\Live\ManiadogeBundle\Controller;

use Doctrine\Common\Persistence\ObjectRepository;
use Nadeo\Live\ManiadogeBundle\Entity\Doge;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DogeController extends Controller
{

    /**
     * @return ObjectRepository
     */
    protected function getDogeRepo()
    {
        return $this->getDoctrine()->getManager()->getRepository(Doge::class);
    }

    function indexAction()
    {
        $doges = $this->getDogeRepo()->findAll();
        return $this->render('ManiadogeBundle:Doge:index.xml.php', ['doges' => $doges],
                new Response('', 200, ['Content-Type' => 'application/xml']));
    }

    /**
     * @ParamConverter("doge", class="ManiadogeBundle:Doge")
     */
    function dogeAction(Doge $doge)
    {
        return $this->render('ManiadogeBundle:Doge:doge.xml.php', ['doge' => $doge],
                new Response('', 200, ['Content-Type' => 'application/xml']));
    }

    function createAction(Request $request)
    {
        $doge = new Doge();

        $form = $this->createFormBuilder($doge)
            ->add('name', 'text')
            ->add('imageUrl', 'text')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($doge);
            $em->flush();

            return $this->redirect($this->generateUrl('maniadoge_index', [], true));
        }

        return $this->render('ManiadogeBundle:Doge:create.html.php', ['form' => $form->createView()]);
    }
}
