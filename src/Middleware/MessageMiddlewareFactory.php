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

namespace Axleus\Message\Middleware;

use Axleus\Message\MessageListener;
use Axleus\Message\View\Helper\SystemMessenger;
use Laminas\View\HelperPluginManager;
use Psr\Container\ContainerInterface;

final class MessageMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): MessageMiddleware
    {
        $helperManager = $container->get(HelperPluginManager::class);

        return new MessageMiddleware(
            $container->get(MessageListener::class),
            $helperManager->get(SystemMessenger::class)
        );
    }
}
