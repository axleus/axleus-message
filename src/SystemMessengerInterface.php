<?php

declare(strict_types=1);

namespace Axleus\Message;

interface SystemMessengerInterface
{
    public const SESSION_KEY = self::class . '::SYSTEM_MESSENGER_NEXT';

    public function send(
        string $message,
        MessageLevel|string|null $key = MessageLevel::Info->value,
        ?int $hops = 1
    ): void;

    public function sendNow(
        string $message,
        MessageLevel|string|null $key = MessageLevel::Info->value,
        ?int $hops = 1
    ): void;

    public function getMessage(string $key, $default = null);
    public function getMessages(): array;
    public function clearMessages(): void;
    public function addHop(): void;
    public function danger(string $message, ?int $hops = 1, bool $now = true): void;
    public function info(string $message, ?int $hops = 1, bool $now = true): void;
    public function success(string $message, ?int $hops = 1, bool $now = true): void;
    public function warning(string $message, ?int $hops = 1, bool $now = true): void;
}
