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

namespace Axleus\Message\Container;

use Axleus\Mailer\MailerInterface;
use Axleus\Message\MessageListener;
use Mezzio\Helper\UrlHelper;
use Psr\Container\ContainerInterface;

final class MessageListenerFactory
{
    public function __invoke(ContainerInterface $container): MessageListener
    {
        return new MessageListener(
            $container->get(MailerInterface::class),
            $container->get(UrlHelper::class),
            $container->get('config')
        );
    }
}
