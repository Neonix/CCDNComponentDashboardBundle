<?php

/*
 * This file is part of the CCDNComponent DashboardBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNComponent\DashboardBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 *
 * @category CCDNComponent
 * @package  DashboardBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNComponentDashboardBundle
 *
 */
class IntegratorCompilerPass implements CompilerPassInterface
{
    /**
     *
     * @access public
      * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('ccdn_component_dashboard.integrator_chain')) {
            return;
        }

        $definition = $container->getDefinition('ccdn_component_dashboard.integrator_chain');

        $taggedServices = $container->findTaggedServiceIds('ccdn_component_dashboard.integrator');

        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall('addIntegrator', array(new Reference($id)));
        }
    }
}
