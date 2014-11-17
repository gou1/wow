<?php

namespace Nadeo\Live\ManiadogeBundle\Controller;

use Doctrine\Common\Persistence\ObjectRepository;
use Nadeo\Live\ManiadogeBundle\Entity\Doge;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DogeController extends Controller
{

    /**
     * @return ObjectRepository
     */
    protected function getDogeRepo()
    {
        return $this->container->get('doctrine.orm.entity_manager')->getRepository(Doge::class);
    }

    function indexAction()
    {
        $doges = $this->getDogeRepo()->findAll();
        return $this->render('ManiadogeBundle:Doge:index.xml.php', ['doges' => $doges], new Response('', 200, ['Content-Type' => 'application/xml']));
    }

    function dogeAction($id)
    {
        $doge = $this->getDogeRepo()->find($id);
        if (!$doge) {
            throw new NotFoundHttpException('Wow no doge');
        }
        return $this->render('ManiadogeBundle:Doge:doge.xml.php', ['doge' => $doge],
                new Response('', 200, ['Content-Type' => 'application/xml']));
    }

    function createAction($name, $imageUrl)
    {
        $doge = new Doge();
        $doge->setName($name);
        $doge->setImageUrl($imageUrl);

        $em = $this->container->get('doctrine.orm.entity_manager');

        $em->persist($doge);
        $em->flush();

        return $this->redirect($this->generateUrl('maniadoge_index'));
    }
}
