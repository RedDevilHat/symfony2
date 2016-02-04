<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 12:15
 */

namespace ApiBundle\Controller;


use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class UsersController
 * @package ApiBundle\Controller
 */
class UsersController extends FOSRestController
{

    /**
     * Get users
     *
     * @ApiDoc(
     *     resource=true,
     *     section="Users"
     * )
     *
     * @QueryParam(name="limit", nullable=false, default="20")
     * @QueryParam(name="offset", nullable=false, default="0")
     *
     * @View(statusCode=FOS\RestBundle\Util\Codes::HTTP_OK)
     * @param ParamFetcherInterface $paramFetcher
     * @return array
     */
    public function getUsersAction(ParamFetcherInterface $paramFetcher) : array
    {
        $limit = $paramFetcher->get('limit');
        $offset = $paramFetcher->get('offset');

        return array_slice(
            $this->get('app.repository.user')->findBy([], null, $limit, $offset),
            $offset,
            $limit
        );
    }

}