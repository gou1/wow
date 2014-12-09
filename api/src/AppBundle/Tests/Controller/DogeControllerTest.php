<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DogeControllerTest extends WebTestCase
{
    public function testGetDoges()
    {
        $client = static::createClient();
        $client->request('GET', '/doges');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testGetNewDoge()
    {
        $client = static::createClient();
        $client->request('GET', '/doges/new');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

}
