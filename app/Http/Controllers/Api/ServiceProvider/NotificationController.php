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
        return JsonResponse::json('ok', ['data' => NotificationResource::collection($user->unreadNotifications()->paginate(10))]);


    }
    public function unread(Request $request)
    {
        $user = auth()->user();
        return JsonResponse::json('ok', ['data' => NotificationResource::collection($user->readNotifications()->paginate(10))]);


    }
    public function read(Request $request)
    {
        $user = Auth::user();


        $notification = $user->notifications()->find($request->notification_id);
        if ($notification) {
            $notification->markAsRead();
        }
        return sendJsonResponse([],'as read for notifcation');

    }


}
