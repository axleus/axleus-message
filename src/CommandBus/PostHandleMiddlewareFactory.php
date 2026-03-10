<?php

declare(strict_types=1);

/**
 * This file is part of the Axleus Axleus Message package.
 *
 * Copyright (c) 2026 Joey Smith <jsmith@webinertia.net>
 * and contributors.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Axleus\Message\CommandBus;

use Axleus\Message\ConfigProvider;
use Axleus\Message\SystemMessengerInterface;
use Psr\Container\ContainerInterface;

final readonly class PostHandleMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): PostHandleMiddleware
    {
        $config = $container->get('config')[SystemMessengerInterface::class][ConfigProvider::MESSAGE_TEMPLATES] ?? [];

        return new PostHandleMiddleware(
            $container->get(SystemMessengerInterface::class),
            $config
        );
    }
}
