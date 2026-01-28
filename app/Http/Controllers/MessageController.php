<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // ======================
    // FRONTEND (LANDING PAGE)
    // ======================
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        Message::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'message' => $request->message,
            'status'  => 'baru',
        ]);

        return back()->with('success', 'Pesan berhasil dikirim');
    }

    // ======================
    // ADMIN PANEL
    // ======================
    public function adminIndex()
    {
        $messages = Message::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        if ($message->status === 'baru') {
            $message->update(['status' => 'dibaca']);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        Message::findOrFail($id)->delete();
        return back()->with('success', 'Pesan dihapus');
    }
}
