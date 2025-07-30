<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatMessageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompleteMail;
use App\Models\Item;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\ChatNotification;
use App\Models\Rating;

class ChatController extends Controller
{
    public function index(Request $request, Chat $chatData)
    {
        $chatter = Auth::user();
        $thisChat = Chat::where('item_id', $request->item_id)
            ->where(function($query) use($chatter) {
                $query->where('buyer_id', $chatter->id)->orWhere('seller_id', $chatter->id);
            })
            ->first();
        if ($thisChat === null)
        {
            $sellerId = Item::where('id', $request->item_id)->first()->user_id;
            $chatData->chatStore($chatter->id, $sellerId, $request->item_id);
            $thisChat = Chat::where('item_id', $request->item_id)
                ->where(function ($query) use ($chatter) {
                    $query->where('buyer_id', $chatter->id)->orWhere('seller_id', $chatter->id);
                })
                ->first();
        }

        $isBuyer = false;
        if ($chatter->id === $thisChat->buyer_id) {
            $partner = User::where('id', $thisChat->seller_id)->first();
            $isBuyer = true;
        } else if ($chatter->id === $thisChat->seller_id) {
            $partner = User::where('id', $thisChat->buyer_id)->first();
            $isBuyer = false;
        }
        $chatMessages = ChatMessage::where('chat_id', $thisChat->id)->get();

        $items = Item::join('chats', 'items.id', '=', 'chats.item_id')
            ->leftJoin('chat_messages', 'chats.id', '=', 'chat_messages.chat_id')
            ->select('items.*')
            ->selectRaw('MAX(chat_messages.created_at) as latest_message_at')
            ->groupBy('items.id')
            ->orderByDesc('latest_message_at')
            ->get();
        $thisItem = $items->where('id', $request->item_id)->first();

        return view('chat', compact(
            'chatter',
            'thisChat',
            'items',
            'thisItem',
            'partner',
            'chatMessages',
            'isBuyer'
        ));
    }

    public function create(ChatMessageRequest $request, ChatMessage $chatMessageData, ChatNotification $chatNotificationData)
    {
        $chatter = Auth::user();
        $thisChat = Chat::where('item_id', $request->item_id)
            ->where(function ($query) use ($chatter) {
                $query->where('buyer_id', $chatter->id)->orWhere('seller_id', $chatter->id);
            })->first();
        if ($chatter->id === $thisChat->buyer_id) {
            $partner = User::where('id', $thisChat->seller_id)->first();
        } else if ($chatter->id === $thisChat->seller_id) {
            $partner = User::where('id', $thisChat->buyer_id)->first();
        }
        $chatMessage = $request->message;
        $latestChatNotification = ChatNotification::where('chat_id', $thisChat->id)->latest()->first();
        $messageCount = 1;
        if ($latestChatNotification->receiver_id === $partner->id)
        {
            $messageCount = $latestChatNotification->message_count + 1;

        } else {
            while (ChatNotification::where('chat_id', $thisChat->id)->where('receiver_id', $chatter->id)->where('is_read', false)->first() !== null) {
                $tmpChatNotification = ChatNotification::where('chat_id', $thisChat->id)->where('receiver_id', $chatter->id)->where('is_read', false)->first();
                $tmpChatNotification->update([
                    'is_read' => true,
                ]);
                $tmpChatNotification->touch();
            }
        }

        if ($request->image !== null)
        {
            $dir = 'images';
            $file_name = $request->file('image')->getClientOriginalname();
            $request->file('image')->storeAs('public/' . $dir, $file_name);
        }

        $chatMessageData->chatMessageStore($thisChat->id, $chatter->id, $chatMessage, $dir, $file_name);
        $chatNotificationData->chatNotificationStore($thisChat->id, $partner->id, $messageCount);

        return back();
    }

    public function update(ChatMessageRequest $request)
    {
        $editedChatMessage = $request->message;

        ChatMessage::where('id', $request->message_id)->first()->update([
            'message' => $editedChatMessage,
            'is_read'
        ]);
        ChatMessage::where('id', $request->message_id)->first()->touch();

        return back();
    }

    public function delete(Request $request)
    {
        $thisChatMessage = ChatMessage::where('id', $request->message_id)->first();
        $thisChatNotification = ChatNotification::where('created_at', $thisChatMessage->created_at)->first();

        if($thisChatNotification->is_read === false && $thisChatNotification->message_count > 1)
        {
            $tmpChatNotification = ChatNotification::where('is_read', false)->first();
            $tmpChatNotification->update([
                'message_count' => $tmpChatNotification->message_count-1,
            ]);
            $tmpChatNotification->touch();
        }

        $thisChatMessage->delete();
        $thisChatNotification->delete();

        return back();
    }

    public function complete(Request $request, Rating $ratingData)
    {
        $chatter = Auth::user();
        $thisChat = Chat::where('item_id', $request->item_id)
            ->where(function ($query) use ($chatter) {
                $query->where('buyer_id', $chatter->id)->orWhere('seller_id', $chatter->id);
            })->first();
        if ($chatter->id === $thisChat->buyer_id) {
            $partner = User::where('id', $thisChat->seller_id)->first();
        } else if ($chatter->id === $thisChat->seller_id) {
            $partner = User::where('id', $thisChat->buyer_id)->first();
        }

        $ratingData->ratingStore($chatter->id, $partner->id, $request->item_id, $request->score);

        $thisChat->update([
            'is_completed' => true,
        ]);
        $thisChat->touch();

        $mailMessage = '取引が完了しました';
        Mail::To($partner->email)->send(new CompleteMail($mailMessage));

        return redirect('/mypage?tab=sell');
    }
}
