<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 12:51
 */

namespace Tests\ApiBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Tests\ApiBundle\ApiTestCase;

class UsersControllerTest extends ApiTestCase
{
    private static $expectedUsersAll = '[{"name":"Name"},{"name":"Name2"}]';
    private static $expectedUsersLimit1 = '[{"name":"Name"}]';
    private static $expectedUsersLimit1Offset1 = '[{"name":"Name2"}]';
    private static $expectedUsersEmpty = '[]';

    public function testGetUsersAction()
    {
        $this->assertApiGetResponse('/api/v1/users.json', Response::HTTP_OK, static::$expectedUsersAll);
        $this->assertApiGetResponse('/api/v1/users.json?limit=1', Response::HTTP_OK, static::$expectedUsersLimit1);
        $this->assertApiGetResponse('/api/v1/users.json?limit=1&offset=1', Response::HTTP_OK, static::$expectedUsersLimit1Offset1);
        $this->assertApiGetResponse('/api/v1/users.json?limit=1&offset=2', Response::HTTP_OK, static::$expectedUsersEmpty);
    }

    protected function getFixtureFullClassNames() : array
    {
        return [];
    }
}