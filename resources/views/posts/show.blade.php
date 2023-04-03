@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    @if($post->image)  <img width="400px" src="{{ asset('uploads/posts/' . $post->image) }}" alt="post image"> @endif

    <div class="card mt-4">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            @if($post['user'])
                <h5 class="card-title">Posted by: {{$post['user']['name']}}</h5>
            @endif
            <p class="card-text">Created at: {{$post['created_at']->isoFormat('dddd Do of MMMM YYYY h:mm:ss A')}}</p>
        </div>
    </div>

    <br />
    <h3>Add a comment</h3>
    <form method="POST" action="{{route('comments.store')}}">
        @csrf
        <input type="hidden" name="commentable_type" value="App\Models\Post">
        <input type="hidden" name="commentable_id" value="{{ $post->id }}">
        <textarea class="form-control" name="description"></textarea>
        <br />
        <button class="btn btn-success" type="submit">Submit Comment</button>
    </form>

    <br/>
    <br/>
    <br/>

    @if($post->comments->isNotEmpty())
    <h3>Comments:</h3>
    @endif
    <br/>
    
    @foreach ($post->comments as $comment)
        <div>
            {{ $comment->description }}
        </div>
        <br/>
    @endforeach

@endsection
