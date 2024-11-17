<?php

declare(strict_types=1);

namespace Axleus\Message;

use Laminas\EventManager;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies'      => $this->getDependencies(),
            'message_listeners' => $this->getMessageListeners(),
            'templates'         => $this->getTemplates(),
            'view_helpers'      => $this->getViewHelpers(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases'    => [
                EventManager\EventManagerInterface::class       => EventManager\EventManager::class,
                'EventManager'                                  => EventManager\EventManager::class,
                EventManager\SharedEventManagerInterface::class => EventManager\SharedEventManager::class,
                'SharedEventManager'                            => EventManager\SharedEventManager::class,
                SystemMessengerInterface::class                 => SystemMessenger::class,
            ],
            'delegators' => [
                EventManager\EventManager::class => [
                    Container\MessageListenerAttachmentDelegator::class,
                ],
            ],
            'invokables' => [
            ],
            'factories'  => [
                EventManager\EventManager::class         => Container\EventManagerFactory::class,
                EventManager\SharedEventManager::class   => static fn() => new EventManager\SharedEventManager(),
                MessageListener::class                   => MessageListenerFactory::class,
                Middleware\MessageMiddleware::class      => Middleware\MessageMiddlewareFactory::class,
            ],
        ];
    }

    public function getMessageListeners(): array
    {
        return [];
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
