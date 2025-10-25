<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'post_id' => 'required|exists:posts,id',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Kommentariya muvaffaqiyatli qo‘shildi!');
    }
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);

        // Faqatgina kommentariyaning muallifi yoki admin o'chira oladi
        if (auth()->id() !== $comment->user_id && !auth()->user()->isAdmin()) {
            return back()->with('error', 'Sizda bu kommentariyani o\'chirish huquqi yo\'q.');
        }

        $comment->delete();

        return back()->with('success', 'Kommentariya muvaffaqiyatli o\'chirildi!');
    }
     public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]); 
        $comment = Comment::findOrFail($id);
        // Faqatgina kommentariyaning muallifi tahrirlashi mumkin
        if (auth()->id() !== $comment->user_id) {
            return back()->with('error', 'Sizda bu kommentariyani tahrirlash huquqi yo\'q.');
        }   
        $comment->comment = $request->comment;
        $comment->save();
        return back()->with('success', 'Kommentariya muvaffaqiyatli yangilandi!');

}
}

