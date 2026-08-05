<?php

namespace App\Services;

use App\Models\AdminNotification;

class NotificationService
{
    public function send(string $type, string $title, ?string $body = null, ?array $data = null): AdminNotification
    {
        return AdminNotification::create([
            'type' => $type,
            'title' => $title,
            'body' => $body,
            'data' => $data,
        ]);
    }
}
