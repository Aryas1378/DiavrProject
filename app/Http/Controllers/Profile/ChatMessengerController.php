<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\ChatMessengerRequest;
use App\Http\Resources\ChannelResource;
use App\Models\Ad;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller;

class ChatMessengerController extends Controller
{

    public function index()
    {
        $channels = Channel::query()
            ->where('user_id', auth()->id())->orWhereHas('ad', function (Builder $ad) {
                $ad->where('user_id', auth()->id());
            })->with('ad')->get();

        return $this->success(ChannelResource::collection($channels));
    }

    public function sendMessage(ChatMessengerRequest $request, Ad $ad)
    {
        $channel = $ad->channels()->firstOrCreate([
            'ad_id' => $ad->id,
            'user_id' => auth()->id(),
        ]);

        $channel->messages()->create(['message' => $request->get('message'), 'user_id' => auth()->id()]);
        return $this->success("Done");
    }

    public function showMessages(Channel $channel)
    {
        /** @var Channel $channel */
        $messages = $channel->load('messages');
        return $this->success(new ChannelResource($messages));
    }

}
