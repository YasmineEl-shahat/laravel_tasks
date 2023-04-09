<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\storePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::with('user')->paginate(10); // select * from posts // returns collection object

        return PostResource::collection($allPosts);
    }
    public function show($id)
    {

        $post = Post::find($id);
        return new PostResource($post);
        //     return  ['id'=>$post->id, 'title'=> $post->title,
        //     'description'=>$post->description,
        //     'user_id'=>$post->user_id,
        //     'image'=>$post->image
        // ];
    }
    public function store(storePostRequest $request)
    {
        $title = $request -> title;
        $description = $request -> description;
        $userId = $request -> user_id;
        $image = $request->file('image');

        // if($request->header('Accept') == 'aplication/json') {

        // }
        $post = Post::create([
           'title' => $title,
           'description' => $description,
           'user_id' => $userId,
           'image'=> $image
        ]);

        return new PostResource($post);
    }
}
