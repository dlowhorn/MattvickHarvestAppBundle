<?php

namespace Mattvick\HarvestAppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class MattvickHarvestAppExtension extends Extension
{
    protected $resources = array(
        'harvest_app' => 'harvest_app.xml',
    );

    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $this->loadDefaults($container);
        
        if (isset($config['alias'])) {
            $container->setAlias($config['alias'], 'mattvick_harvest_app');
        }        

        foreach (array('file', '_user', '_password', '_account', '_ssl', '_mode', '_headers', ) as $attribute) {
            if (isset($config[$attribute])) {
                $container->setParameter('mattvick_harvest_app.'.$attribute, $config[$attribute]);
            }
        }
    }
    
    protected function loadDefaults($container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config', __DIR__.'/Resources/config')));

        foreach ($this->resources as $resource) {
            $loader->load($resource);
        }
    }
}
