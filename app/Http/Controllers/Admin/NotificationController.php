<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function index(): JsonResponse
    {
        $notifications = AdminNotification::latest()
            ->limit(20)
            ->get()
            ->map(fn (AdminNotification $n) => [
                'id' => $n->id,
                'type' => $n->type,
                'title' => $n->title,
                'body' => $n->body,
                'time' => $n->created_at->diffForHumans(),
                'read' => $n->isRead(),
            ]);

        return response()->json([
            'success' => true,
            'data' => $notifications,
            'unread_count' => AdminNotification::unread()->count(),
        ]);
    }

    public function markRead(AdminNotification $notification): JsonResponse
    {
        if (!$notification->isRead()) {
            $notification->update(['read_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'data' => $notification->fresh(),
            'unread_count' => AdminNotification::unread()->count(),
        ]);
    }

    public function markAllRead(): JsonResponse
    {
        AdminNotification::unread()->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'unread_count' => 0,
        ]);
    }
}
