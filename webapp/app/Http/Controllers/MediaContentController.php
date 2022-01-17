<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\MediaContent;
use App\Models\Video;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;

class MediaContentController extends Controller
{
    public function create()
    {
        return view('content.media_create');
    }

    public function edit($id)
    {
        return view('content.media_edit', ['content' => Content::find($id)]);
    }

    public function destroy($id)
    {
        $mediacontent = MediaContent::find($id);
        $content = Content::find($id);
        $content->id_creator = 1;
        $mediacontent->alt_text = "[Removed]";
        $mediacontent->media = "";
        $mediacontent->description = "[Removed]";
        $content->save();
        $mediacontent->save();
        //return redirect()->route('home');
        return redirect()->route('content.show', ['id' => $id]);
    }

    protected function validator(Request $request)
    {
        return $request->validate([
            'alt_text' => 'string|max:255',
            'description' => 'required|string|max:64000',
            'media' => 'required|file|mimetypes:image/jpeg,image/png,image/gif,video/webm,video/mp4',
        ]);
    }

    public function index(Request $request)
    {
        $contents = $request->user()->contents()->paginate(10);
        return view('content.list', ['contents' => $contents]);
    }

    public function show($id)
    {
        return view('content.single', ['content' => Content::find($id)]);
    }

    public function update(Request $request, $id)
    {
        abort_if(is_null($content = Content::find($id)), 404);

        $this->authorize('update', $content);

        abort_if(is_null($mediacontent = MediaContent::find($id)), 404);

        $mediacontent->description = $request->description;
        $mediacontent->media = $request->file('media')->store('media', ['disk' => 'my_files']);
        $mediacontent->alt_text = $request->alt_text;

        $mediacontent->save();

        return redirect()->route('content.show', ['id' => $id]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $mediacontent = new MediaContent;
        $content = new Content;
        $content->id_creator = $user->id;

        $mediacontent->description = $request->description;
        $mediacontent->media = $request->file('media')->store('media', ['disk' => 'my_files']);

        $mediacontent->alt_text = $request->alt_text;
        $mediacontent->fullscreen = false;

        $content->save();

        $mediacontent->id_content = $content->id;

        $mediacontent->save();

        if (strstr(mime_content_type($mediacontent->media), "video/")) {
            $video = new Video;
            $video->views = 0;
            $video->title = "Title";
            $video->id_media_content = $mediacontent->id_content;
            $video->save();
        } else if (strstr(mime_content_type($mediacontent->media), "image/")) {
            $image = new Image;
            $image->width = 1;
            $image->height = 1;
            $image->id_media_content = $mediacontent->id_content;
            $image->save();
        }

        return redirect()->route('content.show', ['id' => $content->id]);
    }
}
