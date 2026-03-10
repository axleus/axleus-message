<?php

declare(strict_types=1);

namespace Axleus\Message;

use Webware\CommandBus\ConfigProvider as BusProvider;

final readonly class ConfigProvider
{
    public const MESSAGE_TEMPLATES = 'message_templates';

    public function __invoke() : array
    {
        return [
            'dependencies'                  => $this->getDependencies(),
            'templates'                     => $this->getTemplates(),
            'view_helpers'                  => $this->getViewHelpers(),
            BusProvider::class              => $this->getCommandBusConfig(),
            SystemMessengerInterface::class => $this->getMessageTemplates(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases'    => [
                SystemMessengerInterface::class => SystemMessenger::class,
            ],
            'factories'  => [
                CommandBus\PostHandleMiddleware::class => CommandBus\PostHandleMiddlewareFactory::class,
                Middleware\MessageMiddleware::class    => Middleware\MessageMiddlewareFactory::class,
            ],
        ];
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
    public function getMessageTemplates(): array
    {
        return [
            self::MESSAGE_TEMPLATES => [
                // YourCommand::class => [
                //     NotificationCapableInterface::MESSAGE_SUCCESS => 'Your success message',
                //     NotificationCapableInterface::MESSAGE_FAILURE => 'Your failure message',
                // ],
            ],
        ];
    }

    public function getCommandBusConfig(): array
    {
        return [
            BusProvider::MIDDLEWARE_PIPELINE_KEY => [
                [
                    'middleware' => CommandBus\PostHandleMiddleware::class,
                    'priority'   => -1,
                ],
            ],
        ];
    }
}
