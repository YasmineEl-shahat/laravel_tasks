<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\storePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $allPosts = Post::all(); // select * from posts // returns collection object
        $allPosts = Post::paginate(7);

        return view('posts.index', ['posts'=> $allPosts ]);
    }
    public function show($id)
    {
        // $post = Post::find($id); //model object // select * from posts where id = $id
        // $post = Post::where('id', $id); //elequent builder -> because you didn't execute
        // $post = Post::where('id', $id)->first(); //model object
        // $post = Post::where('id', $id)->get(); //collection
        $post = Post::with('comments')->find($id);
        return view('posts.show', ['post'=> $post]);
    }
    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users'=> $users]);
    }
     public function store(storePostRequest $request)
     {
         // $data = request()->all();
         //  $request->validate(
        //      [
        //    'title' => ['required', 'min:3'],
        //    'description' => ['required', 'min:5']],
        //      [
        //         'title.required' => 'my custom message'
        //         ]
         //  );

         $title = $request -> title;
         $description = $request -> description;
         $userId = $request -> user_id;
         $image = $request->file('image');
         //  $data = $request->all();
         Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
            'image'=> $image
         ]);

         return to_route('posts.index');
     }
    public function edit($id)
    {
        $users = User::all();
        $post = Post::find($id);
        return view('posts.edit', ['users'=> $users,'post'=> $post]);
    }

    public function update(Request $request, int $id)
    {
        $post = Post::find($id);

        // Validate the incoming request data
        $request->validate([
             'title' => 'required|min:3|unique:posts,title,' . $post->id,
             'description' => 'required|min:5',
             'user_id' => [
                'required',
                'exists:users,id',
            ],
            'image' => 'file|mimes:jpg,png|image|max:2048',
         ]);
        $title = $request -> title;
        $description = $request -> description;
        $userId = $request -> user_id;
        $image = $request->file('image');
        $imageName = $post->setUpdatedImageAttribute($image);
        Post::where('id', $id)->update(
            ['title' => $title,
            'description' => $description,
            'user_id' => $userId,
            'image'=>   $imageName
            ]
        );
        return to_route('posts.index');
    }

    public function destroy(int $id)
    {
        $post = Post::find($id);
        $post->deleteImage(); // delete the image
        $post->delete();
        return to_route('posts.index');
    }
}

// 1- schema structure change .. (create table, edit table, delete table)   ... database migration
// 2- crud operations .. (insert row, edit row, delete row)
