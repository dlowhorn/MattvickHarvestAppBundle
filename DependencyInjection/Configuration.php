<?php

namespace Mattvick\HarvestAppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for the bundle
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mattvick_harvest_app');

        $rootNode
            ->children()
                ->scalarNode('file')->defaultValue('%kernel.root_dir%/../vendor/HaPi-1.1.1/HarvestAPI.php')->end()
                ->scalarNode('_user')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('_password')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('_account')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('_ssl')->defaultValue(true)->end()
                ->scalarNode('_mode')->defaultValue('FAIL')->end()
                ->scalarNode('_headers')->defaultNull()->end()
                ->scalarNode('alias')->defaultNull()->end()
            ->end()
        ;

        return $treeBuilder;
    }

}

