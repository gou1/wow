# Symfony REST API checklist

> Not using Symfony Rest Edition since it's not up to date :(

# Install standard edition

```
composer create-project symfony/framework-standard-edition maniadoge-api
```

# Git create repo

...

# Update composer.json

Clean-up meta data...
Update autoload of src to PSR-4:
 
```
  "autoload": {
          "psr-4": { "": "src/" },
          "psr-0": { "SymfonyStandard": "app/" }
      },
```

Add requirements: 
 
```
"doctrine/doctrine-fixtures-bundle": "2.2.*",
"friendsofsymfony/rest-bundle": "1.4.*",
"nelmio/api-doc-bundle": "2.7.*",
"fzaninotto/faker": "1.4.*",
"jms/serializer-bundle": "0.13.*"
```

Remove branch-alias...
Do the harlem shake:

```composer update```

# Configure app

Add bundles to AppKernel:

```
public function registerBundles()
{
    $bundles = array(
        new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
        new Symfony\Bundle\SecurityBundle\SecurityBundle(),
        new Symfony\Bundle\TwigBundle\TwigBundle(),
        new Symfony\Bundle\MonologBundle\MonologBundle(),
        new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
        new Symfony\Bundle\AsseticBundle\AsseticBundle(),
        new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
        new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        new FOS\RestBundle\FOSRestBundle(),
        new JMS\SerializerBundle\JMSSerializerBundle(),
        new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
        new AppBundle\AppBundle(),
    );

    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
        $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
        $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
        $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
    }

    return $bundles;
}
```

Run checks:

```
php app/check.php
```

Run config suggestions:

```
GET [...]/web/config.php
```

app/config/rest.yml:

```
fos_rest:
    param_fetcher_listener: false
    body_listener: false
    format_listener:
        rules:
            - { path: ^/, priorities: [ json, xml ], fallback_format: json, prefer_extension: true }
    view:
        view_response_listener: true
        templating_formats:
            html: false

nelmio_api_doc: ~
```

app/config/routing.yml:

```
NelmioApiDocBundle:
    resource: "@NelmioApiDocBundle/Resources/config/routing.yml"
    prefix:   /

AppBundle:
    resource: @AppBundle/Resources/config/routing.yml
    type: rest
```

app/config/services.yml:

```
services:
    app.listener.convert_to_html_response:
        class: AppBundle\EventListener\ConvertToHtmlResponse
        tags:
        - { name: kernel.event_listener, event: kernel.response }
```

# AppBundle

...
