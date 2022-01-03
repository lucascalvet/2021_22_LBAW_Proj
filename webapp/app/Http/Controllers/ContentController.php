<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    public function create()
    {
        return view('content.create');
    }

    public function edit(Content $content, $id)
    {
        $content = $content->withId($id)->first();
        return view('contents.edit', ['content' => $content]);
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:64000',
            'media' => 'file|mimetypes:image/jpeg,image/png,image/gif,video/webm,video/mp4',
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
        $content->title = $request->title;
        $content->description = $request->description;

        if ($request->hasFile('media')){
            $content->media = $request->file('media')->store('media', ['disk' => 'my_files']);
        }

        if($content->media == null){
            $content->media = "none";
        }

        $content->save();

        return view('contents.single', ['content' => $content]);
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

        if ($request->hasFile('media')){
            $content->media = $request->file('media')->store('media', ['disk' => 'my_files']);
        }
        else{
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

        return view('contents.single', ['content' => $content]);
    }
}
