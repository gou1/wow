<?php

use Manialib\Manialink\Elements\Manialink;
use Manialib\Manialink\Elements\Script;
use Manialib\Maniascript\Autoloader;
use Manialib\Maniascript\AutoloaderInterface;
use Manialib\Maniascript\Compiler;
use Manialib\Maniascript\CompilerInterface;
use Manialib\XML\Rendering\Renderer;
use Manialib\XML\Rendering\RendererInterface;

class App
{
    /**
     * @var AutoloaderInterface
     */
    public $autoloader;
    /**
     * @var CompilerInterface
     */
    public $compiler;
    /**
     * @var RendererInterface
     */
    public $renderer;
    /**
     * @var Manialink
     */
    public $maniaapp;

    function __construct($apiUrl)
    {
        $this->autoloader = new Autoloader();
        $this->autoloader->addIncludePath(__DIR__ . '/../maniascript');
        $this->compiler = new Compiler($this->autoloader);
        $this->renderer = new Renderer();

        $maniascript = $this->compiler->compile('App.Script.txt');

        $this->maniaapp = (new Manialink())
            ->setNodeName('maniaapp')
            ->appendChild((new Script())->setNodeValue(
                '#RequireContext CMlApp' . "\n" .
                '#Include "MathLib" as MathLib' . "\n" .
                '#Const ApiUrl "' . $apiUrl . '"' . "\n" .
                $maniascript));
    }

    function __toString()
    {

        header('Content-Type: application/xml');
        return $this->renderer->getXML($this->maniaapp);
    }
}



