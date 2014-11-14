<?php

namespace Nadeo\Live\ManiadogeBundle\Controllers;

use Doctrine\ORM\EntityManager;
use Manialib\XML\Rendering\RendererInterface;
use Nadeo\Live\ManiadogeBundle\Entity\Doge;
use Nadeo\Live\ManiadogeBundle\Manialinks\Home;

class DogeController
{
    /**
     *
     * @var EntityManager
     */
    protected $em;

    /**
     *
     * @var RendererInterface
     */
    protected $renderer;

    use \Manialib\ManialibBundle\Traits\RenderNodeTrait;

    function __construct(EntityManager $em, RendererInterface $renderer)
    {
        $this->em       = $em;
        $this->renderer = $renderer;
    }

    function index()
    {
        $doges = $this->em->getRepository(Doge::class)->findAll();
        return $this->renderNode(new Home($doges));
    }

    function create($name, $imageUrl)
    {
        $doge = new Doge();
        $doge->setName($name);
        $doge->setImageUrl($imageUrl);

        $this->em->persist($doge);
        $this->em->flush();
    }
}
