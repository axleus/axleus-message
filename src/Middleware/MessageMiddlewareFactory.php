<?php

declare(strict_types=1);

namespace Axleus\Message\Middleware;

use Axleus\Message\MessageListener;
use Axleus\Message\View\Helper\SystemMessenger;
use Psr\Container\ContainerInterface;
use Laminas\View\HelperPluginManager;

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
