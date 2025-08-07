<?php

namespace Cisse\Bundle\Ui\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class UiExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(\dirname(__DIR__).'/Resources/config'));
        $loader->load('services.xml');
    }

    public function prepend(ContainerBuilder $container): void
    {
        $bundles = $container->getParameter('kernel.bundles');
        
        if (isset($bundles['TwigBundle'])) {
            $bundlePath = dirname(__DIR__, 2);
            $container->prependExtensionConfig('twig', [
                'paths' => [
                    $bundlePath.'/Resources/views/components' => 'ui',
                ],
            ]);
        }
    }

    public function getAlias(): string
    {
        return 'ui';
    }
}
