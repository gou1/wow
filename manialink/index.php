<?php

require_once __DIR__.'/vendor/autoload.php';

$autoloader = new \Manialib\Maniascript\Autoloader();
$autoloader->addIncludePath(__DIR__.'/maniascript');

$compiler = new \Manialib\Maniascript\Compiler($autoloader);
$maniascript = $compiler->compile('App.Script.txt');

$renderer = new Manialib\XML\Rendering\Renderer();

$root = (new \Manialib\XML\Node())
    ->setNodeName('maniaapp')
    ->setAttribute('version', '1')
    ->setAttribute('background', '1')
    ->appendChild(new \Manialib\Manialink\Elements\Timeout())
    ->appendChild((new \Manialib\Manialink\Elements\Script())->setNodeValue($maniascript));

header('Content-Type: application/xml');
echo $renderer->getXML($root);