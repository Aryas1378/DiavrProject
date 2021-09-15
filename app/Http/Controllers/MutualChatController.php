<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatMessengerRequest;
use App\Http\Resources\AdResource;
use App\Http\Resources\ChatMutualResource;
use App\Models\Ad;
use App\Models\MutualChat;

class MutualChatController extends Controller
{
    public function sendMessage(ChatMessengerRequest $request, Ad $ad)
    {
        $chat_starter = null;
        if ($ad->mutualChats()->count()) {
            $receiver_id = MutualChat::query()
                ->where('sender_id', '=', auth()->id())
                ->where('receiver_id', '=', $ad->user_id)
                ->value('sender_id');
            if (is_null($receiver_id)) {
                $receiver_id = $ad->mutualChats()->where('sender_id', '=', auth()->id())->first()->sender_id;
            }
        } else {
            $receiver_id = $ad->user_id;
            $chat_starter = auth()->id();
        }

        $mutual_chat = MutualChat::query()->create(
            [
                'message' => $request->get('message'),
                'sender_id' => auth()->user()->id,
                'ad_id' => $ad->id,
                'receiver_id' => $receiver_id,
                'chat_starter' => $chat_starter,
            ]);
        return $this->success(new ChatMutualResource($mutual_chat));
    }

    public function showMutualChats(Ad $ad)
    {
        $mutual_chats = $ad->load('mutualChats');
        return $this->success(new AdResource($mutual_chats));
    }

    public function index()
    {

        $mutual_chats = Ad::query()->with('mutualChats')->get();
        return $this->success(AdResource::collection($mutual_chats));

    }


}
