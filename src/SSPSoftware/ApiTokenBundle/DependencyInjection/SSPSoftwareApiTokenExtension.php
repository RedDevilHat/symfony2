<?php

namespace SSPSoftware\ApiTokenBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class SSPSoftwareApiTokenExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->defineExtractor($config, $container);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');


    }

    private function defineExtractor(array $config, ContainerBuilder $container)
    {
        $container->setParameter('ssp_software_api_token.api_key.parameter_name', $config['parameter_name']);
        $container->setAlias('ssp_software_api_token.api_key.extractor', 'ssp_software_api_token.api_key.extractor.'.$config['delivery']);
    }
}
