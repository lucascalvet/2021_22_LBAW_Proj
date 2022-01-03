<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function edit(Post $post, $id)
    {
        $post = $post->withId($id)->first();
        return view('posts.edit', ['post' => $post]);
    }

    public function destroy(Post $post, $id)
    {
        $post = $post->withId($id)->first();
        $post->delete();
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
        $posts = $request->user()->posts()->paginate(10);
        return view('posts.list', ['posts' => $posts]);
    }

    public function show(Post $post, $id)
    {
        $post = $post->withId($id)->first();
        return view('posts.single', ['post' => $post]);
    }

    public function showt(Post $post, $title)
    {
        $post = $post->withTitle($title)->first();

        return view('posts.single', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;


        if ($request->hasFile('media')){
            $post->media = $request->file('media')->store('media', ['disk' => 'my_files']);
        }

        if($post->media == null){
            $post->media = "none";
        }

        $post->save();

        return view('posts.single', ['post' => $post]);
    }

    public function store(Request $request)
    {
        //Post::truncate();

        //this gives us the currently logged in user
        $user = $request->user();

        //$valid_request = $this->validator($request);

        $post = new Post;
        $post->user_id = $user->id;
        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('media')){
            $post->media = $request->file('media')->store('media', ['disk' => 'my_files']);
        }
        else{
            $post->media = "none";
        }

        $post->save();
        
        //this fetches all the post data from the form
        //we can post all the data from post and not get an error
        // because laravel handles this in Post model through fillable array
        //Laravel will only save the data from the key that is in the fillables array
        //$formData = $request->all();

        // we need a seo bot readable url, this will create a slug based on title
        //$formData['slug'] = str_slug($request->get('id'));

        //this creates posts based on the relation from user to post
        //meaning the id of user is automatically populated and saved in the user_id column of posts table
        //$user->posts()->create($formData);

        return view('posts.single', ['post' => $post]);
    }
}
