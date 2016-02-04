<?php
/**
 * Created by PhpStorm.
 * User: KustovVA
 * Date: 03.02.2016
 * Time: 14:12
 */

namespace SSPSoftware\ApiTokenBundle\DependencyInjection\Security\Factory;


use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ApiKeyFactory
 * @package SSPSoftware\ApiTokenBundle\DependencyInjection\Security\Factory
 */
class ApiKeyFactory implements SecurityFactoryInterface
{

    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'ssp_software_api_token.api_key.provider.api_key.'.$id;
        $container->setDefinition($providerId, new DefinitionDecorator('ssp_software_api_token.api_key.provider.api_key'))
            ->replaceArgument(0, new Reference($userProvider));
        $listenerId = 'ssp_software_api_token.api_key.listener.api_key.'.$id;
        $listener = $container->setDefinition($listenerId, new DefinitionDecorator('ssp_software_api_token.api_key.listener.api_key'));

        return array($providerId, $listenerId, $defaultEntryPoint);
    }

    /**
     * Defines the position at which the provider is called.
     * Possible values: pre_auth, form, http, and remember_me.
     *
     * @return string
     */
    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'api_key';
    }

    public function addConfiguration(NodeDefinition $builder)
    {
    }
}