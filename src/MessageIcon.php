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

enum MessageIcon: string
{
    case Success = 'check-circle';
    case Danger  = 'exclamation-octagon';
    case Warning = 'exclamation-triangle';
    case Info    = 'info-circle';

    public static function tryFromLevel(MessageLevel|string $messageLevel): self
    {
        if (is_string($messageLevel)) {
            $messageLevel = MessageLevel::tryFrom($messageLevel);
        }

        return match ($messageLevel) {
            MessageLevel::Success => self::Success,
            MessageLevel::Danger  => self::Danger,
            MessageLevel::Warning => self::Warning,
            MessageLevel::Info    => self::Info,
        };
    }
}
