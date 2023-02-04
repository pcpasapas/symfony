<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\UX\Vue\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\UX\Vue\Twig\VueComponentExtension;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Thibault RICHARD <thibault.richard62@gmail.com>
 *
 * @internal
 */
class VueExtension extends Extension
{
    /**
     * Summary of load
     *
     * @param array<mixed> $configs
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container
            ->setDefinition('twig.extension.vue', new Definition(VueComponentExtension::class))
            ->setArgument(0, new Reference('webpack_encore.twig_stimulus_extension'))
            ->addTag('twig.extension')
            ->setPublic(false)
        ;
    }
}
