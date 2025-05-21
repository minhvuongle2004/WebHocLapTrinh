<?php
namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    // Hiển thị danh sách tất cả tin nhắn
    public function index()
    {
        $messages = Message::with(['sender', 'receiver'])->get();
        return view('admin.themes.messages.tableMessage', compact('messages'));
    }

    // Hiển thị chi tiết một tin nhắn
    public function show($id)
    {
        $message = Message::with(['sender', 'receiver'])->findOrFail($id);
        return view('admin.themes.messages.messageDetail', compact('message'));
    }

    // Hiển thị form gửi tin nhắn
    public function create()
    {
        $users = User::all();
        return view('admin.themes.messages.createMessage', compact('users'));
    }

    // Gửi tin nhắn mới
    public function store(Request $request)
    {
        $request->validate([
            'id_sender' => 'required|exists:tbl_users,id',
            'id_receiver' => 'required|exists:tbl_users,id|different:id_sender',
            'content' => 'required|string',
            'status' => 'required|in:removed,exist',
        ]);

        Message::create($request->all());
        return redirect()->route('admin.messages.index')->with('success', 'Tin nhắn đã được gửi thành công');
    }

    // Hiển thị form chỉnh sửa tin nhắn
    public function edit($id)
    {
        $message = Message::findOrFail($id);
        $users = User::all();
        return view('admin.themes.messages.editMessage', compact('message', 'users'));
    }

    // Cập nhật tin nhắn
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_sender' => 'required|exists:tbl_users,id',
            'id_receiver' => 'required|exists:tbl_users,id|different:id_sender',
            'content' => 'required|string',
            'status' => 'required|in:removed,exist',
        ]);

        $message = Message::findOrFail($id);
        $message->update($request->all());
        return redirect()->route('admin.messages.index')->with('success', 'Tin nhắn đã được cập nhật thành công');
    }

    // Xóa một tin nhắn
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Tin nhắn đã được xóa thành công');
    }
}
