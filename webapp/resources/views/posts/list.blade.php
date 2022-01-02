@extends('layouts.app')
@section('content')
    <div class="row">
        <h1>Post List</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td><a href="{{ $post->url }}" target="_blank">{{ $post->title }}</a></td>
                    <td>{{ $post->description }}</td>
                    <td><a href="{{ $post->edit_url }}">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{-- {!! $posts->links()  !!} --}}
    </div>
@stop