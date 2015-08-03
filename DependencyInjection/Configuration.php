<?php

/**
 * @package    AmazonWebServicesBundle
 * @author     Mark Badolato <mbadolato@Obtao.com>
 * @copyright  Copyright (c) Cybernox Technologies. All rights reserved.
 * @license    http://www.opensource.org/licenses/BSD-2-Clause BSD License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Obtao\AmazonWebServicesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * AmazonWebServicesBundle Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('obtao_amazon_web_services');

        $rootNode
            ->children()
                ->booleanNode('certificate_authority')
                    ->defaultFalse()
                ->end()
                ->scalarNode('credentials')
                    ->defaultValue(null)
                ->end()
                ->scalarNode('default_cache_config')
                    ->defaultValue(null)
                ->end()
                ->scalarNode('key')
                    ->isRequired()
                ->end()
                ->scalarNode('region')
                    ->isRequired()
                ->end()
                ->scalarNode('sdk_path')
                    ->defaultValue(null)
                ->end()
                ->scalarNode('secret')
                    ->isRequired()
                ->end()
                ->scalarNode('token')
                    ->defaultValue(null)
                ->end()
                ->scalarNode('version')
                    ->defaultValue('latest')
                ->end()
            ->end();

        return $treeBuilder;
    }
}