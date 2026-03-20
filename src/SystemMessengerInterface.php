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

interface SystemMessengerInterface
{
    public const MESSAGE_TEMPLATES = 'message_templates';
    public const SESSION_KEY = self::class . '::SYSTEM_MESSENGER_NEXT';

    public function send(
        string $message,
        MessageLevel $key = MessageLevel::Info,
        ?int $hops = 1,
        string|int|null $id = null,
    ): void;

    public function sendNow(
        string $message,
        MessageLevel $key = MessageLevel::Info,
        ?int $hops = 1,
        string|int|null $id = null,
    ): void;

    public function getMessage(MessageLevel $key, array $default = []): array;

    public function getMessages(): array;

    public function hasMessages(): bool;

    public function clearMessages(): void;

    public function addHop(): void;

    public function danger(string $message, ?int $hops = 1, bool $now = true, string|int|null $id = null): void;

    public function info(string $message, ?int $hops = 1, bool $now = true, string|int|null $id = null): void;

    public function success(string $message, ?int $hops = 1, bool $now = true, string|int|null $id = null): void;

    public function warning(string $message, ?int $hops = 1, bool $now = true, string|int|null $id = null): void;
}
