<?php

declare(strict_types=1);

namespace Axleus\Message\View\Helper;

use Psr\Container\ContainerInterface;

final class SystemMessengerFactory
{
    public function __invoke(ContainerInterface $container): SystemMessenger
    {
        return new SystemMessenger();
    }
}
