<?php

declare(strict_types=1);

namespace Axleus\Message\View\Helper;

use Axleus\Message\MessageIcon;
use Axleus\Message\MessageLevel;
use Axleus\Message\SystemMessage;

use Axleus\Message\SystemMessenger as Messenger;

use function sprintf;

class SystemMessenger
{
    public final const MESSAGE_KEY = SystemMessage::SYSTEM_MESSAGE_KEY;

    private const MESSAGE_TOAST = <<<'EOT'
        <div class="toast" role="alert" data-bs-autohide="false" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-%s-subtle">
                <i class="text-%s bi bi-%s"></i>
                <strong class="ms-auto me-auto">%s</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                %s
            </div>
        </div>
    EOT;

    private ?string $systemMessage;
    private Messenger $messenger;

    public function __invoke(
        string $messageLevel = MessageLevel::Info->value,
        $default = null
    ) {
        $levels = MessageLevel::cases();
        $messages = '';
        foreach ($levels as $key) {
            $systemMessages = $this->messenger->getMessages();
            if (! isset($systemMessages[$key->value])) {
                continue;
            }
            $messages .= sprintf(
                static::MESSAGE_TOAST,
                $key->value,
                $key->value,
                MessageIcon::tryFromLevel($key->value)->value,
                $key->name,
                $systemMessages[$key->value]
            );
        }
        return $messages;
    }

    public function setMessenger(Messenger $messenger): void
    {
        $this->messenger = $messenger;
    }

    public function getMessenger(): ?Messenger
    {
        return $this->messenger;
    }
}
