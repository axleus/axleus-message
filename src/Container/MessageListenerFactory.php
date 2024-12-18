<?php

declare(strict_types=1);

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
