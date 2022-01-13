<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\TextContent;
use Illuminate\Support\Facades\Validator;

class TextContentController extends Controller
{
    public function create($id_group = false)
    {   /*
        $url = url()->previous();
        $path = parse_url($url)["path"];
        
        if (substr($path, 1, 5) == "group") {
            return view('content.text_create', ['id_group' => intval(substr($path, 7))]);
        } else {
            return view('content.text_create', ['id_group' => -1]);
        }
        */

        return view('content.text_create', ['id_group' => $id_group]);
    }

    public function edit($id)
    {
        return view('content.text_edit', ['content' => Content::find($id)]);
    }

    public function destroy($id)
    {
        $textcontent = TextContent::find($id);
        $content = Content::find($id);
        $content->id_creator = 1;
        $textcontent->post_text = "[Removed]";

        $content->save();
        $textcontent->save();
        
        //$content->delete();
        //return redirect()->route('home');
        return redirect()->route('content.show', ['id' => $id]);
    }

    protected function validator(Request $request)
    {
        return $request->validate([
            'post_text' => 'required|string|max:64000'
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

        abort_if(is_null($textcontent = TextContent::find($id)), 404);
        $textcontent->post_text = $request->post_text;

        $textcontent->save();

        return redirect()->route('content.show', ['id' => $id]);
    }

    public function store(Request $request)
    {
        //content::truncate();

        //this gives us the currently logged in user
        $user = $request->user();

        //$valid_request = $this->validator($request);

        $content = new Content;
        $content->id_creator = $user->id;
        $textcontent = new TextContent;
        $textcontent->post_text = $request->post_text;

        if($request->id_group != null){
            $content->id_group = $request->id_group;
        }

        $content->save();

        $textcontent->id_content = $content->id;

        $textcontent->save();
    
        return redirect()->route('content.show', ['id' => $content->id]);
    }
}
