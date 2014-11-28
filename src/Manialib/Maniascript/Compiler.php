<?php

namespace Manialib\Maniascript;

class Compiler
{
    /**
     * @var Autoloader
     */
    protected $autoloader;
    protected $compilerFilters   = array();
    protected $compiledLibraries = array();

    protected function addHeaderFilter($library, $maniascript)
    {
        return "\n//Autoloaded: $library\n\n$maniascript\n";
    }

    protected function virtualIncludeFilter($library, $maniascript)
    {
        $def = '#Include "Manialib/Logger.Script.txt" as Logger';
        $lib = 'Manialib/Logger.Script.txt';
        $pre = 'Logger::';
        $rep = 'Manialib_Logger_';

        if($lib != $library)
        {
        }
        if($lib != $library)
        {
            $maniascript = str_replace($def, $this->compile($lib), $maniascript);
        }
        $maniascript = str_replace($pre, $rep, $maniascript);
        return $maniascript;
    }

    function __construct(Autoloader $autloader, array $compilerFilters = array())
    {
        $this->autoloader      = $autloader;
        $this->compilerFilters = [
            [$this, 'addHeaderFilter'],
            [$this, 'virtualIncludeFilter'],
        ];
    }

    function addCompilerFilter($filter)
    {
        $this->compilerFilters[] = $filter;
    }

    function compile($library)
    {
        if (!array_key_exists($library, $this->compiledLibraries)) {
            $maniascript = $this->autoloader->autoload($library);
            foreach ($this->compilerFilters as $callback) {
                $maniascript = call_user_func($callback, $library, $maniascript);
            }
            $this->compiledLibraries[$library] = $maniascript;
        }
        return $this->compiledLibraries[$library];
    }
}
