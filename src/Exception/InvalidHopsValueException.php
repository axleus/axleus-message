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

use InvalidArgumentException;

use function sprintf;

class InvalidHopsValueException extends InvalidArgumentException implements ExceptionInterface
{
    public static function valueTooLow(string $key, int $hops): self
    {
        return new self(sprintf(
            'Hops value specified for message "%s" was too low; must be greater than 0, received %d',
            $key,
            $hops
        ));
    }
}
