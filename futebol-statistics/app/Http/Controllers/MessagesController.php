<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function contactMessages()
    {

        $messages = Contact::all();

        return view('admin.contactMessages', compact('messages'));
    }

    public function markAsRead($messageId)
    {
        $message = Contact::find($messageId);
        if ($message) {
            $message->is_read = true;
            $message->save();
            return response()->json(['message' => 'Message marked as read'], 200);
        } else {
            return response()->json(['error' => 'Message not found'], 404);
        }
    }
}
