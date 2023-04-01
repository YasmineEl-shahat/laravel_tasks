@extends('layouts.app')

@section('title') Index @endsection

@section('content')
<div class="text-center">
    <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
</div>  
<table class='table  mt-4'>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>description</th>
        <th>posted_by</th> 
        <th>created_at</th>
        <th></th>
    </tr>
    @foreach($posts as $post) 
        <tr>
            <td>{{$post['id']}}</td>
            <td>{{$post['title']}}</td>
            <td>{{$post['description']}}</td>
            <td>{{$post['posted_by']}}</td>
            <td>{{$post['created_at']}}</td>
            <td> 
                <a href="{{route('posts.show',$post['id'])}}" class='btn btn-info'> view</a>
                <a href="{{route('posts.edit',$post['id'])}}" class='btn btn-info'> Edit</a>
                <a href="{{route('posts.delete',$post['id'])}}" class='btn btn-danger'> Delete</a>
            </td>
        </tr>
    @endforeach
</table>
@endsection