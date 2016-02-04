<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 17:14
 */

namespace ApiBundle\Controller;



use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class AuthController extends FOSRestController
{
    /**
     * @Route("/token", methods={"POST"})
     *
     * @ApiDoc(
     *     resource=true,
     *     section="Auth"
     * )
     *
     * @RequestParam(name="username", nullable=false)
     * @RequestParam(name="password", nullable=false)
     *
     * @View(statusCode=401)
     */
    public function getTokenAction(ParamFetcherInterface $fetcher)
    {
        try {
            return $this->get('api.service.authentication.authenticator')->authenticate(
                $fetcher->get('username'),
                $fetcher->get('password')
            );
        } catch (UsernameNotFoundException $e) {
            return $this->handleException($e);
        } catch (AuthenticationException $e) {
            return $this->handleException($e);
        }
    }

    private function handleException(\Exception $e)
    {
        return new JsonResponse([
            'errors' => [$e->getMessage()],
            'message' => $e->getMessage(),
            'code' => Response::HTTP_UNAUTHORIZED
        ], Response::HTTP_UNAUTHORIZED);
    }
}