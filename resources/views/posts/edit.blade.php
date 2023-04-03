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
    <form action="{{route('posts.update', $post['id'])}}" method="POST"  enctype='multipart/form-data'>
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
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}"  @if($post->user_id == $user->id) selected="selected" @endif>{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label  class="form-label">image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
@endsection