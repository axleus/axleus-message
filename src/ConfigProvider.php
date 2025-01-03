<?php

declare(strict_types=1);

namespace Axleus\Message;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'listeners'    => $this->getListeners(),
            'templates'    => $this->getTemplates(),
            'view_helpers' => $this->getViewHelpers(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases'    => [
                SystemMessengerInterface::class => SystemMessenger::class,
            ],
            'factories'  => [
                MessageListener::class              => Container\MessageListenerFactory::class,
                Middleware\MessageMiddleware::class => Middleware\MessageMiddlewareFactory::class,
            ],
        ];
    }

    public function getListeners(): array
    {
        return [MessageListener::class];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'message' => [__DIR__ . '/../templates/'],
            ],
        ];
    }

    public function getViewHelpers(): array
    {
        return [
            'aliases'   => [
                'messenger'       => View\Helper\SystemMessenger::class,
                'systemMessage'   => View\Helper\SystemMessenger::class,
                'systemMessenger' => View\Helper\SystemMessenger::class,
            ],
            'factories' => [
                View\Helper\SystemMessenger::class => View\Helper\SystemMessengerFactory::class,
            ],
        ];
    }
}
