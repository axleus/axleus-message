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

use Psr\Http\Server\MiddlewareInterface;
use RuntimeException;

use function sprintf;

class MissingSessionException extends RuntimeException implements ExceptionInterface
{
    public static function forMiddleware(MiddlewareInterface $middleware): MissingSessionException
    {
        return new self(sprintf(
            'Unable to create SystemMessenger in %s; missing session attribute',
            $middleware::class
        ));
    }
}
