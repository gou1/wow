<?php

namespace Nadeo\Live\ManiadogeBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use Manialib\Maniascript\Autoloader;
use Manialib\Maniascript\Compiler;
use Symfony\Component\HttpFoundation\Request;

class AppController extends FOSRestController
{

    /**
     * @Get("/manialink");
     */
    public function getManialinkAction(Request $request)
    {
        $autoloader  = $this->get('manialib.maniascript.autoloader');
        $autoloader->addIncludePath(__DIR__.'/../Resources/maniascript');
        $compiler    = new Compiler($autoloader);
        $maniascript = $compiler->compile('Doge/Application.Script.txt');

        return $this->handleView(
                $this->view($maniascript, 200)
                    ->setTemplate("ManiadogeBundle:App:manialink.".($request->query->all() ? 'html' : 'xml').".php")
                    ->setTemplateVar('maniascript')
        );
    }
}
