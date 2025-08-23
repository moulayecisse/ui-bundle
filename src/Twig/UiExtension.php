<?php

namespace Cisse\Bundle\Ui\Twig;

use Cisse\Bundle\Ui\DependencyInjection\Configuration;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class UiExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);


        (new YamlFileLoader(
            $container,
            new FileLocator(dirname(__DIR__) . '/../config')
        ))
            ->load('services.yaml');
    }

    public function prepend(ContainerBuilder $container): void
    {
        $bundles = $container->getParameter('kernel.bundles');
        
        if (isset($bundles['TwigBundle'])) {
            $bundlePath = dirname(__DIR__, 2);
            $container->prependExtensionConfig('twig', [
                'paths' => [
                    $bundlePath.'/templates/components' => 'ui',
                ],
            ]);
        }
    }

    public function getAlias(): string
    {
        return 'ui';
    }
}
