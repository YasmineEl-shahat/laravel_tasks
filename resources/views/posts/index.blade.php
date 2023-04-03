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
        <th>slug</th>
        <th>description</th>
        <th>posted_by</th> 
        <th>created_at</th>
        <th></th>
    </tr>
    @foreach($posts as $post) 
        <tr>
            <td>{{$post['id']}}</td>
            <td>{{substr($post['title'], 0, 20)}}</td>
            <td>{{substr($post['slug'], 0, 20)}}</td>
            <td>{{substr($post['description'], 0, 50)}}</td>
            <td>@if($post['user']) {{$post['user']['name']}} @endif</td>
            <td>{{$post['created_at']->isoFormat('YYYY-MM-DD')}}</td>
            <td> 
                <a href="{{route('posts.show',$post['id'])}}" class='btn btn-info'> view</a>
                <a href="{{route('posts.edit',$post['id'])}}" class='btn btn-info'> Edit</a>
                <button  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                data-id="{{ $post->id }}">Delete</button>
            
              </td>
        </tr>
    
    @endforeach
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body">
      Are you sure you want to delete post <span id="post-id"></span>
      </div>
      <div class="modal-footer">
      <form action="" method="POST" class="d-inline" id='delete-form'>
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Delete</button>
        </form>

      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let id;
    $(document).ready(function() {
        $('button[data-bs-target="#exampleModal"]').on('click', function() {
            id = $(this).get(0).dataset['id'];
            $('#post-id').text(id);
            $('#delete-form').attr('action', '/posts/destroy/'+id);
        });
    });
</script>
{{ $posts->links() }}

@endsection