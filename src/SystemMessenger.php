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

use Mezzio\Session\SessionInterface;

/**
 * original code by Mezzio\Flash
 */
class SystemMessenger implements SystemMessengerInterface
{
    /** @var array<string,mixed> */
    private array $currentMessages = [];

    public function __construct(private SessionInterface $session, private string $sessionKey)
    {
        $this->prepareMessages($session, $sessionKey);
    }

    /**
     * Set a Message value with the given key.
     *
     * Message values are accessible on the next "hop", where a hop is the
     * next time the session is accessed; you may pass an additional $hops
     * integer to allow access for more than one hop.
     *
     * @param mixed $message
     * @throws Exception\InvalidHopsValueException
     */
    public function send(
        string $message,
        MessageLevel $key = MessageLevel::Info,
        ?int $hops = 1,
    ): void {
        if ($hops < 1) {
            throw Exception\InvalidHopsValueException::valueTooLow($key->value, $hops);
        }

        $messages              = $this->getStoredMessages();
        $messages[$key->value] = [
            'message' => $message,
            'hops'    => $hops,
            'key'     => $key->value,
        ];
        $this->session->set($this->sessionKey, $messages);
    }

    /**
     * Set a Message value with the given key, but allow access during this request.
     *
     * Message values are generally accessible only on subsequent requests;
     * using this method, you may make the value available during the current
     * request as well.
     *
     * If you want the value to be visible only in the current request, you may
     * pass zero as the third argument.
     *
     * @param mixed $message
     */
    public function sendNow(
        string $message,
        MessageLevel $key = MessageLevel::Info,
        ?int $hops = 1,
    ): void {
        $this->currentMessages[$key->value] = $message;
        if ($hops > 0) {
            $this->send($message, $key, $hops);
        }
    }

    public function danger(string $message, ?int $hops = 0, bool $now = true): void
    {
        $now ? $this->sendNow($message, MessageLevel::Danger, $hops)
            : $this->send($message, MessageLevel::Danger, $hops);
    }

    public function info(string $message, ?int $hops = 0, bool $now = true): void
    {
        $now ? $this->sendNow($message, MessageLevel::Info, $hops)
            : $this->send($message, MessageLevel::Info, $hops);
    }

    public function success(string $message, ?int $hops = 0, bool $now = true): void
    {
        $now ? $this->sendNow($message, MessageLevel::Success, $hops)
            : $this->send($message, MessageLevel::Success, $hops);
    }

    public function warning(string $message, ?int $hops = 0, bool $now = true): void
    {
        $now ? $this->sendNow($message, MessageLevel::Warning, $hops)
            : $this->send($message, MessageLevel::Warning, $hops);
    }

    /**
     * Retrieve a message value.
     *
     * Will return a value only if a message value was set in a previous request,
     * or if `sendNow()` was called in this request with the same `$key`.
     *
     * WILL NOT return a value if set in the current request via `send()`.
     *
     * @param mixed $default Default value to return if no message value exists.
     * @return mixed
     */
    public function getMessage(MessageLevel $key, $default = null)
    {
        return $this->currentMessages[$key->value] ?? $default;
    }

    /**
     * Retrieve all message values.
     *
     * Will return all values was set in a previous request, or if `sendNow()`
     * was called in this request.
     *
     * WILL NOT return values set in the current request via `send()`.
     */
    public function getMessages(): array
    {
        return $this->currentMessages;
    }

    public function hasMessages(): bool
    {
        return ! empty($this->currentMessages) || ! empty($this->getStoredMessages());
    }

    /**
     * Clear all message values.
     *
     * Affects the next and subsequent requests.
     */
    public function clearMessages(): void
    {
        $this->session->unset($this->sessionKey);
    }

    /**
     * Prolongs any current messages for one more hop.
     */
    public function addHop(): void
    {
        $messages = $this->getStoredMessages();

        /** @var mixed $message */
        foreach ($this->currentMessages as $key => $message) {
            if (isset($messages[$key])) {
                continue;
            }

            $this->send($key, $message);
        }
    }

    public function prepareMessages(SessionInterface $session, string $sessionKey): void
    {
        if (! $session->has($sessionKey)) {
            return;
        }

        $sessionMessages = $this->getStoredMessages($sessionKey);

        /** @var array<string,mixed> $currentMessages */
        $currentMessages = [];
        foreach ($sessionMessages as $key => $data) {
            // $data['key'] = $key;
            $currentMessages[$key] = $data;

            if ($data['hops'] === 1) {
                unset($sessionMessages[$key]);

                continue;
            }

            $data['hops'] -= 1;
            $sessionMessages[$key] = $data;
        }

        empty($sessionMessages)
            ? $session->unset($sessionKey)
            : $session->set($sessionKey, $sessionMessages);

        $this->currentMessages = $currentMessages;
    }

    /**
     * @return StoredMessages
     */
    private function getStoredMessages(?string $sessionKey = null): array
    {
        /** @var StoredMessages|null $messages */
        $messages = $this->session->get($sessionKey ?? $this->sessionKey, []);

        return $messages ?? [];
    }
}
