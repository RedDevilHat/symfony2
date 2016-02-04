<?php

namespace SSPSoftware\ApiTokenBundle;

use SSPSoftware\ApiTokenBundle\DependencyInjection\Security\Factory\ApiKeyFactory;
use Symfony\Bundle\SecurityBundle\DependencyInjection\SecurityExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class SSPSoftwareApiTokenBundle
 * @package SSPSoftware\ApiTokenBundle
 */
class SSPSoftwareApiTokenBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        /** @var SecurityExtension $extension */
        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new ApiKeyFactory());
    }

}
