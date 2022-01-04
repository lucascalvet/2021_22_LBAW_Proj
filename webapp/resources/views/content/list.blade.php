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
            @foreach($contents as $content)
                <tr>
                    <td><a href="{{ $content->url }}" target="_blank">Title</a></td>
                    @if ($content->contentable instanceof App\Models\TextContent)
                    <td>{{ $content->contentable->post_text }}</td>
                    @else
                    <td>{{ $content->contentable->description }}</td>
                    @endif
                    <td><a href="{{ $content->edit_url }}">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{-- {!! $posts->links()  !!} --}}
    </div>
@stop