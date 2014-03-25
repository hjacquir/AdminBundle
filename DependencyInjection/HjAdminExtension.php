<?php

/* Created by Hatim Jacquir
 * User: Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\AdminBundle\DependencyInjection;

use \Symfony\Component\Config\FileLocator;
use \Symfony\Component\DependencyInjection\ContainerBuilder;
use \Symfony\Component\DependencyInjection\Extension\Extension;
use \Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class to load your different services
 */
class HjAdminExtensions extends Extension
{
    /**
     * @param array            $config
     * @param ContainerBuilder $container
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__ . '/../Resources/config')));
        $loader->load('services.xml');
    }

}
