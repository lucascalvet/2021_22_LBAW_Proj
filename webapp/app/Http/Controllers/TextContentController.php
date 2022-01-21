<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\TextContent;
use Illuminate\Support\Facades\Validator;

class TextContentController extends Controller
{
    public function create($id_group = false)
    {   
        return view('content.text_create', ['id_group' => $id_group]);
    }

    public function destroy($id)
    {
        $textcontent = TextContent::findOrFail($id);
        $content = $textcontent->content;
        $content->id_creator = 1;
        $textcontent->post_text = "[Removed]";

        $content->save();
        $textcontent->save();

        return redirect()->route('content.show', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $textcontent = TextContent::findOrFail($id);
        $this->authorize('update', $textcontent->content);

        Validator::make($request->all(), [
            'post_text' => 'required|string|max:1024'
        ])->validate();

        $textcontent->post_text = $request->post_text;

        $textcontent->save();

        return redirect()->route('content.show', ['id' => $id]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'post_text' => 'required|string|max:1024'
        ])->validate();
        $user = $request->user();

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

        if (isset($request->parent_id)) {
            $textcontent->parent()->attach($request->parent_id);
            return redirect()->route('content.show', ['id' => $request->parent_id]);
        }

        return redirect()->route('content.show', ['id' => $content->id]);
    }
}
