<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\MediaContent;
use App\Models\Video;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

class MediaContentController extends Controller
{
    public function create($id_group = false)
    { 
        return view('content.media_create', ['id_group' => $id_group]);
    }

    public function destroy($id)
    {
        $mediacontent = MediaContent::findOrFail($id);
        $content = $mediacontent->content;
        $content->id_creator = 1;
        $mediacontent->alt_text = "[Removed]";
        $mediacontent->media = "";
        $mediacontent->description = "[Removed]";
        $content->save();
        $mediacontent->save();
        //return redirect()->route('home');
        return redirect()->route('content.show', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $mediacontent = MediaContent::findOrFail($id);

        $this->authorize('update', $mediacontent->content);

        Validator::make($request->all(), [
            'alt_text' => 'string|max:255',
            'description' => 'required|string|max:1024',
            'media' => 'required|file|mimetypes:image/jpeg,image/png,image/gif,video/webm,video/mp4',
        ])->validate();

        $mediacontent->description = $request->description;
        $mediacontent->media = $request->file('media')->store('media', ['disk' => 'my_files']);
        $mediacontent->alt_text = $request->alt_text;

        $mediacontent->save();

        return redirect()->route('content.show', ['id' => $id]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'alt_text' => 'string|max:255',
            'description' => 'required|string|max:1024',
            'media' => 'required|file|mimetypes:image/jpeg,image/png,image/gif,video/webm,video/mp4',
        ])->validate();
        $user = $request->user();
        $mediacontent = new MediaContent;
        $content = new Content;
        $content->id_creator = $user->id;

        $mediacontent->description = $request->description;
        $mediacontent->media = $request->file('media')->store('media', ['disk' => 'my_files']);

        $mediacontent->alt_text = $request->alt_text;
        $mediacontent->fullscreen = false;

        if($request->id_group != null){
            $content->id_group = $request->id_group;
        }

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
