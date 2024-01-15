<?php


namespace App\Http\Controllers\Api\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;
use App\Http\Resources\NotificationResource;
use App\Models\UserSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Notification;
use ArinaSystems\JsonResponse\Facades\JsonResponse;


class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($request->has('read')) {
            $read = $request->query('read');
            $notificationsQuery = ($read === 'true')
                ? $user->readNotifications()
                : $user->unreadNotifications();
        } else {
            $notificationsQuery = $user->notifications();
        }

        $notifications = $notificationsQuery->paginate(10);

        return JsonResponse::json('ok', ['data' => NotificationResource::collection($notifications)]);
    }

    public function read(Request $request)
    {
        $user = Auth::user();


        $notification = $user->notifications()->find($request->notification_id);
        if ($notification) {
            $notification->markAsRead();
        }
        return sendJsonResponse([], 'as read for notifcation');
    }
}
