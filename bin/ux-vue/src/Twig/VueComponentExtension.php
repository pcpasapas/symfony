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

namespace Symfony\UX\Vue\Twig;

use Symfony\WebpackEncoreBundle\Twig\StimulusTwigExtension;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @author Titouan Galopin <galopintitouan@gmail.com>
 * @author Thibault RICHARD <thibault.richard62@gmail.com>
 *
 * @final
 */
class VueComponentExtension extends AbstractExtension
{
    /**
     * Summary of stimulusExtension
     */
    private mixed $stimulusExtension;

    public function __construct(StimulusTwigExtension $stimulusExtension)
    {
        $this->stimulusExtension = $stimulusExtension;
    }

    /**
     * Summary of getFunctions
     *
     * @return array<string>
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('vue_component', [$this, 'renderVueComponent'], ['needs_environment' => true, 'is_safe' => ['html_attr']]),
        ];
    }

    /**
     * Summary of renderVueComponent
     *
     * @param array<mixed> $props
     */
    public function renderVueComponent(Environment $env, string $componentName, array $props = []): string
    {
        $params = ['component' => $componentName];
        if ($props) {
            $params['props'] = $props;
        }

        return $this->stimulusExtension->renderStimulusController($env, '@symfony/ux-vue/vue', $params);
    }
}
