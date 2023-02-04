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

namespace Symfony\UX\Turbo\Broadcaster;

/**
 * Broadcasts an update of an entity.
 *
 * @author Kévin Dunglas <kevin@dunglas.fr>
 */
interface Broadcaster
{
    /**
     * @param array{id?: (string|array<string>), transports?: (string|array<string>), topics?: (string|array<string>), template?: string, rendered_action?: string} $options
     */
    public function broadcast(object $entity, string $action, array $options): void;
}
