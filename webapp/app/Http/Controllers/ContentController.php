<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\TextContent;
use App\Models\MediaContent;
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
        abort_if(is_null($content = Content::find($id)), 404);

        $this->authorize('update', $content);

        if ($content->contentable instanceof \App\Models\TextContent) {
            return view('content.text_edit', ['text_content' => $content->contentable]);
        } else if ($content->contentable instanceof \App\Models\MediaContent) {
            return view('content.media_edit', ['media_content' => $content->contentable]);
        }

        return redirect()->route('home');
    }

    public function destroy($id)
    {

        abort_if(is_null($content = Content::find($id)), 404);

        $this->authorize('delete', $content);

        /*
        if ($content->contentable instanceof \App\Models\TextContent) {
            $content->contentable->delete();
        } else if ($content->contentable instanceof \App\Models\MediaContent) {
            $content->contentable->media_contentable->delete();
            $content->contentable->delete();
        }

        $content->delete();
        */

        if ($content->contentable instanceof \App\Models\TextContent) {

            return (new TextContentController)->destroy($id);
        } else if ($content->contentable instanceof \App\Models\MediaContent) {
            return (new MediaContentController)->destroy($id);
        }

        return redirect()->route('home');


    }

    protected function validator(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:64000',
            'media' => 'file|mimetypes:image/jpeg,image/png,image/gif,video/webm,video/mp4',
        ]);
    }

    public function index(Request $request)
    {
        $contents = $request->user()->contents()->paginate(10);
        return view('content.list', ['contents' => $contents]);
    }

    public function show($id)
    {
        abort_if(is_null($content = Content::find($id)), 404);
        $this->authorize('view', $content);

        return view('content.single', ['content' => $content]);
    }

    public function showt(Content $content, $title)
    {
        return view('content.single', ['content' => $content]);
    }

    public function update(Request $request, $id)
    {
        $content = Content::find($id);
        $content->title = $request->title;
        $content->description = $request->description;

        if ($request->hasFile('media')) {
            $content->media = $request->file('media')->store('media', ['disk' => 'my_files']);
        }

        if ($content->media == null) {
            $content->media = "none";
        }

        $content->save();

        return view('content.single', ['content' => $content]);
    }

    public function store(Request $request)
    {
        //content::truncate();

        //this gives us the currently logged in user
        $user = $request->user();

        //$valid_request = $this->validator($request);

        $content = new Content;
        $content->user_id = $user->id;
        $content->title = $request->title;
        $content->description = $request->description;

        if ($request->hasFile('media')) {
            $content->media = $request->file('media')->store('media', ['disk' => 'my_files']);
        } else {
            $content->media = "none";
        }

        $content->save();

        //this fetches all the content data from the form
        //we can content all the data from content and not get an error
        // because laravel handles this in content model through fillable array
        //Laravel will only save the data from the key that is in the fillables array
        //$formData = $request->all();

        // we need a seo bot readable url, this will create a slug based on title
        //$formData['slug'] = str_slug($request->get('id'));

        //this creates contents based on the relation from user to content
        //meaning the id of user is automatically populated and saved in the user_id column of contents table
        //$user->contents()->create($formData);

        return view('content.single', ['content' => $content]);
    }

    /**
     * Likes
     */
    public function like(Request $request, $id){
        abort_if(is_null($content = Content::find($id)), 404);

        //this gives us the currently logged in user
        $user = $request->user();

        if(Like::where('id_content', $content->id)->where('id_user', $user->id)->count() == 0){
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
        }
        else{
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
