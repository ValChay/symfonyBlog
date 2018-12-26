<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Panther\Client;

class ArticleControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
return $client;
    }

    public function testCreate () {

        $client = static::createClient();
        $client->request('GET', '/article/creation');

        $client->submitForm('Enregistrer', [
            'article[title]' => 'Mon super titre',
            'article[body]' => 'kkukuykioiy',
            'article[published]' => true,
            'article[author]' => 1,
        ]);

        $this->assertSame(302, $client->getResponse()->getStatusCode());
        $client->followRedirect();
        $this->assertSame('/article', $client->getRequest()->getPathInfo());
    }
}
