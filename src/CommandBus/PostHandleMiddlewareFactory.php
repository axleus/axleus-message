<?php

declare(strict_types=1);

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
