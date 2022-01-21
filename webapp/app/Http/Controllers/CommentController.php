<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function destroy($id){
        $comment = Comment::findOrFail($id);
        $content = $comment->media_content;
        $comment->id_author = 1;
        $comment->comment_text = "[Removed]";
        $comment->save();

        return redirect()->route('content.show', ['id' => $content->id_content]);
    }
}
