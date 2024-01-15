<?php

namespace App\Http\Controllers\Api\Chat;

use App\Events\PrivateChatEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\loadMessgeResource;
use App\Http\Resources\ChatMessgeResource;
use App\Models\ChatMessage;
use App\Models\Provider\OfferChatMessage;
use App\Models\User;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivateChatController extends Controller
{
    public function index(Request $request)
    {
        $messages = ChatMessage::query()
            ->when($request->message_id, function ($q) use ($request) {
                $q->where('id', '!=', request()->message_id)
                    ->messagecurrentuser($request->to_user_id)
                    ->latest();
            })
            ->messagecurrentuser($request->to_user_id)
            ->with(['fromUser', 'toUser'])
            ->orderby('created_at', 'desc')
            ->get();
        return JsonResponse::json('ok', ['data' => loadMessgeResource::collection($messages)]);
    }

    public function store(Request $request)
    {

        $message =  ChatMessage::create([
            'message' => $request->message,
            'to_user_id' => $request->to_user_id,
            'from_user_id' => auth()->id()
        ]);
        $images = $request->file('images');

        if ($request->file('images')) {
            foreach ($images as $image) {
                $message
                    ->addMedia($image)
                    ->toMediaCollection('images');
            }
        }



        // $data = [
        //     'receiver_id' => (int)$request->to_user_id,
        //     'sender_id' => auth()->id(),
        //     'created_at' => $message->created_at,
        //     'message' => $request->message,
        //     'id' => $message->id,
        //     'user_name' => auth()->user()->name,
        //     'user_image' => auth()->user()->image_path
        // ];

        // PrivateChatEvent::dispatch($data);

        return JsonResponse::json('ok', ['data' => loadMessgeResource::make($message)]);
    }

    public function destroy($id)
    {
        $message = ChatMessage::findorfail($id);
        $message->delete();

        return sendJsonResponse([], 'message is deleted sucessfully');
    }

    public function lastMessage(Request $request)
    {
        $user = auth()->user();
        $latestMessages = ChatMessage::whereIn('id', function ($query) {
            $query->select(\DB::raw('MAX(id)'))
                ->from('chat_messages as m2')
                ->where(function ($subQuery) {
                    $user_id = auth()->id();
                    $subQuery->where('m2.from_user_id', $user_id)
                        ->orWhere('m2.to_user_id', $user_id);
                })
                ->groupBy(\DB::raw('CASE WHEN m2.from_user_id = ' . auth()->id() . ' THEN m2.to_user_id ELSE m2.from_user_id END'));
        })
            ->where(function ($query) {
                $user_id = auth()->id();
                $query->where('from_user_id', $user_id)
                    ->orWhere('to_user_id', $user_id);
            })
            ->when($request->search, function ($q) use ($request) {
                $searchTerm = '%' . $request->search . '%';
                return $q->whereHas('fromUser', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm);
                })
                    ->orWhereHas('toUser', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', $searchTerm);
                    });
            })

            ->with(['fromUser', 'toUser'])
            ->latest('created_at')
            ->get();
        return sendJsonResponse(ChatMessgeResource::collection($latestMessages), 'latest-messages');
    }
}
