<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 12:49
 */

namespace Tests\ApiBundle;


use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

abstract class ApiTestCase extends WebTestCase
{
    /**
     * @var Client
     */
    protected static $client;

    protected function assertApiGetResponse($apiUri, $expectedStatusCode, $expectedJsonString)
    {
        static::$client->request('GET', $apiUri);
        $this->assertStatusCode($expectedStatusCode, static::$client);

        $responseBody = static::$client->getResponse()->getContent();
        static::assertJson($responseBody);
        static::assertJsonStringEqualsJsonString($expectedJsonString, $responseBody);
    }

    protected function setUp()
    {
        parent::setUp();
        $this->loadFixtures($this->getFixtureFullClassNames());
        if (!static::$client) {
            static::$client = static::makeClient($authentication = true);
        }

    }

    abstract protected function getFixtureFullClassNames() : array;


}