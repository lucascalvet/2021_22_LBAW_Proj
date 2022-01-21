<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\TextContent;
use App\Models\MediaContent;
use App\Models\Comment;
use App\Models\Like;


use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    public function create()
    {
        return view('content.create');
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);

        $this->authorize('update', $content);

        if ($content->contentable instanceof TextContent) {
            return view('content.text_edit', ['text_content' => $content->contentable]);
        } else if ($content->contentable instanceof MediaContent) {
            return view('content.media_edit', ['media_content' => $content->contentable]);
        }

        return redirect()->route('home');
    }

    public function update(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        $this->authorize('update', $content);

        if ($content->contentable instanceof TextContent) {
            return (new TextContentController)->update($request, $id);
        } else if ($content->contentable instanceof MediaContent) {
            return (new MediaContentController)->update($request, $id);
        }
    }

    public function remove($id)
    {
        $content = Content::findOrFail($id);

        $content->group()->dissociate();

        $content->save();

        return view('content.single', ['content' => $content]);
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $this->authorize('delete', $content);

        if ($content->contentable instanceof \App\Models\TextContent) {
            return (new TextContentController)->destroy($id);
        } else if ($content->contentable instanceof \App\Models\MediaContent) {
            return (new MediaContentController)->destroy($id);
        }

        return redirect()->route('home');
    }

    public function show($id)
    {
        $content = Content::findOrFail($id);
        $this->authorize('view', $content);

        return view('content.single', ['content' => $content]);
    }

    public function comment(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $this->authorize('comment', $content);

        $request->validate([
            'comment_text' => 'required|string|max:255',
        ]);

        if ($content->contentable instanceof MediaContent) {
            $comment = new Comment;
            $comment->comment_text = $request->input('comment_text');
            $comment->id_author = $request->user()->id;
            $comment->id_media_content = $content->id;
            $comment->save();
        } else if ($content->contentable instanceof TextContent) {
        }
        return redirect()->route('content.show', ['id' => $content->id, '#comments']);
    }

    public function like(Request $request, $id)
    {
        abort_if(is_null($content = Content::find($id)), 404);

        //this gives us the currently logged in user
        $user = $request->user();

        if (Like::where('id_content', $content->id)->where('id_user', $user->id)->count() == 0) {
            $like = new Like;
            $like->id_user = $user->id;
            $like->id_content = $content->id;

            $like->save();

            $nLikes = $content->numberOfLikes();

            $res = json_encode(array(
                'id' => $content->id,
                'liked' => true,
                'nLikes' => $nLikes,
            ));
        } else {
            $like = Like::where('id_content', $content->id)->where('id_user', $user->id)->first();

            $like->delete();

            $nLikes = $content->numberOfLikes();

            $res = json_encode(array(
                'id' => $content->id,
                'liked' => false,
                'nLikes' => $nLikes,
            ));
        }

        return $res;
    }
}
