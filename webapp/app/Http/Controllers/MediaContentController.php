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

    public function edit(Content $content, $id)
    {
        $content = $content->withId($id)->first();
        return view('content.media_edit', ['content' => $content]);
    }

    public function destroy(Content $content, $id)
    {
        $content = $content->withId($id)->first();
        $content->delete();
        return redirect()->route('pages.home');
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
        return view('contents.list', ['contents' => $contents]);
    }

    public function show(Content $content, $id)
    {
        $content = $content->withId($id)->first();
        return view('contents.single', ['content' => $content]);
    }

    public function showt(Content $content, $title)
    {
        $content = $content->withTitle($title)->first();

        return view('contents.single', ['content' => $content]);
    }

    public function update(Request $request, $id)
    {
        $mediacontent = MediaContent::find($id);
        $content = Content::find($id);

        $mediacontent->description = $request->description;
        $mediacontent->media = $request->file('media')->store('media', ['disk' => 'my_files']);
        $mediacontent->alt_text = $request->alt_text;

        $mediacontent->save();

        return view('contents.single', ['content' => $content]);
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

        $content->save();
        $mediacontent->save();

        if(strstr(mime_content_type($mediacontent->media), "video/")){
            $video = new Video;
            $video->views = 0;
            $video->title = "Title";
            $video->save();
        }
        else if(strstr(mime_content_type($mediacontent->media), "image/")){
            $image = new Image;
            $image->width = 1;
            $image->heigth = 1;
            $image->save();
        }
    
        return view('contents.single', ['content' => $content]);
    }
}
