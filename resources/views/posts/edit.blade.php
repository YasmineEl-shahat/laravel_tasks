@extends('layouts.app')

@section('title') Create @endsection

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('posts.update', $post['id'])}}" method="POST">
        @csrf
        @method('put')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" value="{{$post['title']}}" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea name="description" class="form-control"  rows="3">{{$post['description']}}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Post Creator</label>
            <select name="user->id" class="form-control" value="{{$post['user']['name']}}">
                @foreach($users as $user)
                    <option value="{{$user->id}}"  @if($post->user_id == $user->id) selected="selected" @endif>{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection