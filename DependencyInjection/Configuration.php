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
                ->scalarNode('user')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('password')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('account')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('ssl')->defaultValue(true)->end()
                ->scalarNode('mode')->defaultValue('FAIL')->end()
                ->scalarNode('alias')->defaultNull()->end()
            ->end()
        ;

        return $treeBuilder;
    }

}

