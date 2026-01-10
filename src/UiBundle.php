<?php

namespace Cisse\Bundle\Ui;

use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class UiBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->booleanNode('pattern_library')
                    ->defaultFalse()
                    ->info('Enable the pattern library routes (recommended only in dev)')
                ->end()
            ->end();
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // Load services configuration
        $container->import($this->getPath() . '/config/services.yaml');

        // Store config for routing
        $builder->setParameter('ui_bundle.pattern_library_enabled', $config['pattern_library']);

        // Load profiler services only when WebProfilerBundle is enabled (dev mode)
        $bundles = $builder->getParameter('kernel.bundles');
        if (isset($bundles['WebProfilerBundle'])) {
            $container->import($this->getPath() . '/config/services_profiler.yaml');
        }
    }

    public function loadRoutes(RoutingConfigurator $routes): void
    {
        // This method is called by Symfony to load routes
        // Pattern library routes are always available, consumers can disable via firewall/security
        $routes->import($this->getPath() . '/config/routes/ui_bundle.yaml');
    }

    public function prependExtension(ContainerConfigurator $configurator, ContainerBuilder $container): void
    {
        // Add lowercase "ui" Twig namespace alias to allow <twig:ui:button>
        // in addition to <twig:Ui:button>
        $container->prependExtensionConfig('twig', [
            'paths' => [
                $this->getPath() . '/templates' => 'ui',
            ],
        ]);

        if (!$this->isAssetMapperAvailable($container)) {
            return;
        }

        $container->prependExtensionConfig('framework', [
            'asset_mapper' => [
                'paths' => [
                    __DIR__ . '/../assets/dist' => '@cisse/ui-bundle',
                ],
            ],
        ]);
    }

    private function isAssetMapperAvailable(ContainerBuilder $container): bool
    {
        if (!interface_exists(AssetMapperInterface::class)) {
            return false;
        }

        // check that FrameworkBundle 6.3 or higher is installed
        $bundlesMetadata = $container->getParameter('kernel.bundles_metadata');
        if (!isset($bundlesMetadata['FrameworkBundle'])) {
            return false;
        }

        return is_file($bundlesMetadata['FrameworkBundle']['path'] . '/Resources/config/asset_mapper.php');
    }
}
