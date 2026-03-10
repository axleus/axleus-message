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

interface NotificationCapableInterface
{
    public const MESSAGE_SUCCESS = 'success';

    public const MESSAGE_FAILURE = 'failure';

    public function getNotify(): bool;

    public function getNotifyNow(): bool;
}
