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

    public function edit(Content $content, $id)
    {
        $content = $content->withId($id)->first();
        return view('content.text_edit', ['content' => $content]);
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
            'post_text' => 'required|string|max:64000'
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
        $content = Content::find($id);
        $textcontent = TextContent::find($id);
        $textcontent = $request->post_text;

        $textcontent->save();

        return view('contents.single', ['content' => $content]);
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
        $textcontent = $request->post_text;

        $content->save();
        $textcontent->save();
    
        return view('contents.single', ['content' => $content]);
    }
}
