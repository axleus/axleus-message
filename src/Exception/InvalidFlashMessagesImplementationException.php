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

namespace Axleus\Message\Exception;

use Axleus\Message\Middleware\MessageMiddleware;
use Axleus\Message\SystemMessengerInterface;
use InvalidArgumentException;

use function sprintf;

class InvalidSystemMessengerImplementationException extends InvalidArgumentException implements ExceptionInterface
{
    public static function forClass(string $class): self
    {
        return new self(sprintf(
            'Cannot use "%s" within %s; does not implement %s',
            $class,
            MessageMiddleware::class,
            SystemMessengerInterface::class
        ));
    }
}
