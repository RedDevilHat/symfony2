<?php

namespace SSPSoftware\ApiTokenBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ssp_software_api_token');

        $rootNode
            ->children()
            ->scalarNode('delivery')
            ->defaultValue('header')
            ->validate()
            ->ifNotInArray(['header', 'query_string', 'post_param'])
            ->thenInvalid('Unknown authentication delivery type "%s". Use one of these: header, query_string, post_param')
            ->end()
            ->end()
            ->scalarNode('parameter_name')
            ->defaultValue('X-Auth-Token')
            ->end()
            ->end();

        return $treeBuilder;
    }
}
