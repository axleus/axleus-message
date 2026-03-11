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

namespace Axleus\Message;

use Webware\CommandBus\CommandBusInterface;
use Webware\CommandBus\ConfigProvider as BusProvider;

final readonly class ConfigProvider
{
    

    public function __invoke(): array
    {
        return [
            'dependencies'                  => $this->getDependencies(),
            'templates'                     => $this->getTemplates(),
            'view_helpers'                  => $this->getViewHelpers(),
            SystemMessengerInterface::class => $this->getMessageTemplates(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases'   => [
                SystemMessengerInterface::class => SystemMessenger::class,
            ],
            'factories' => [
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
            SystemMessengerInterface::MESSAGE_TEMPLATES => [
                // YourCommand::class => [
                //     NotificationCapableInterface::MESSAGE_SUCCESS => 'Your success message',
                //     NotificationCapableInterface::MESSAGE_FAILURE => 'Your failure message',
                // ],
            ],
        ];
    }
}
