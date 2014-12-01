<?php

namespace Nadeo\Live\ManiadogeBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use Manialib\Maniascript\Autoloader;
use Manialib\Maniascript\Compiler;
use Symfony\Component\HttpFoundation\Request;

class ManialinkController extends FOSRestController
{

    /**
     * @Get("");
     */
    public function getIndexAction(Request $request)
    {
        $autoloader  = $this->get('manialib.maniascript.autoloader')->addIncludePath(__DIR__.'/../Resources/maniascript');
        $maniascript = $this->get('manialib.maniascript.compiler')->compile('Doge/Application.Script.txt');

        return $this->handleView(
                $this->view($maniascript, 200)
                    ->setTemplate("ManiadogeBundle:Manialink:index.".($request->query->all() ? 'html' : 'xml').".php")
                    ->setTemplateVar('maniascript')
        );
    }
}
