<?php

namespace Manialib\Maniascript;

class Autoloader
{
    const NAMESPACE_INCLUDE_SEPARATOR = '/';
    const NAMESPACE_SCRIPT_SEPARATOR  = '_';

    /**
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;
    protected $includePaths                    = array();
    protected $autoloadedLibrariesFilenames    = array();
    protected $autoloadedLibrariesManiascripts = array();

    protected function exists($library)
    {
        if (!array_key_exists($library, $this->autoloadedLibrariesFilenames)) {
            $filename = implode(DIRECTORY_SEPARATOR, explode(self::NAMESPACE_INCLUDE_SEPARATOR, $library));

            foreach ($this->includePaths as $includePath) {
                if (file_exists($includePath.DIRECTORY_SEPARATOR.$filename)) {
                    $this->autoloadedLibrariesFilenames[$library] = $includePath.DIRECTORY_SEPARATOR.$filename;
                }
            }
        }
        return $this->autoloadedLibrariesFilenames[$library];
    }

    protected function getManiascript($library)
    {
        if (!array_key_exists($library, $this->autoloadedLibrariesManiascripts)) {
            $filename = $this->exists($library);
            if(!$filename)
            {
                throw new \RuntimeException(sprintf('Maniascript library "%s" not found.', $library));
            }
            $this->logger->info('Autoloaded Maniascript library: '.$library);
            $this->autoloadedLibrariesManiascripts[$library] = file_get_contents($filename);
        }
        return $this->autoloadedLibrariesManiascripts[$library];
    }

    function __construct(array $includePaths = array(), \Psr\Log\LoggerInterface $logger = null)
    {
        $this->includePaths    = $includePaths;
        $this->includePaths[] = __DIR__.'/Resources/maniascript';
        $this->logger = $logger ?: new \Psr\Log\NullLogger();
    }

    function addIncludePath($path)
    {
        $this->includePaths[] = $path;
    }

    function autoload($library)
    {
        return $this->getManiascript($library);
    }
}
