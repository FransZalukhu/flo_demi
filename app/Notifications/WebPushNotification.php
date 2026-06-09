<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class WebPushNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private string $title,
        private string $body,
        private ?string $url = null
    ) {}

    public function via($notifiable): array
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification): WebPushMessage
    {
        return (new WebPushMessage)
            ->title($this->title)
            ->body($this->body)
            ->icon('/assets/logo.png')
            ->badge('/assets/logo.png')
            ->tag('flo-demi-alert')
            ->data(['url' => $this->url ?? '/']);
    }
}
