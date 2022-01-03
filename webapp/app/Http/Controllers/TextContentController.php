<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\TextContent;
use Illuminate\Support\Facades\Validator;

class TextContentController extends Controller
{
    public function create()
    {
        return view('content.text_create');
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
        return view('content.single', ['content' => $content]);
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
        $content = Content::find($id);
        $textcontent = TextContent::find($id);
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

        $content->save();

        $textcontent->id_content = $content->id;

        $textcontent->save();
    
        return redirect()->route('content.show', ['id' => $content->id]);
    }
}
