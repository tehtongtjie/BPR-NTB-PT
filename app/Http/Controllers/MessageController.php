<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'category' => ['required', Rule::in(array_keys(Message::categories()))],
        ]);

        Message::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'message' => $request->message,
            'category' => $request->category,
            'status'  => 'baru',
        ]);

        return back()->with('success', 'Pesan berhasil dikirim');
    }

    // ======================
    // ADMIN PANEL
    // ======================
    public function adminIndex(Request $request)
    {
        $categories = Message::categories();
        $messages = Message::query();

        if ($request->filled('category')) {
            $messages->where('category', $request->category);
        }

        if ($request->filled('is_story')) {
            $isStory = $request->is_story === '1';
            $messages->where('is_story', $isStory);
        }

        $messages = $messages->latest()->paginate(10)->withQueryString();

        return view('admin.messages.index', compact('messages', 'categories'));
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
    
        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan dihapus');
    }

    public function bulkStory(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:messages,id',
            'is_story' => ['required', Rule::in(['0', '1'])],
        ]);

        $isStory = (bool) $request->is_story;

        Message::whereIn('id', $request->ids)->update(['is_story' => $isStory]);

        return redirect()->route('admin.messages.index')->with('success', 'Status Story berhasil diperbarui');
    }
}
