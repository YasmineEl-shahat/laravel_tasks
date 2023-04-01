<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    private $allPosts = [
        [
            'id' => 3,
            'title' => 'Javascript',
            'description' => 'hello javascript',
            'posted_by' => 'Yasmine',
            'created_at' => '2023-04-01 10:00:00',
        ],
        [
            'id' => 1,
            'title' => 'Laravel',
            'description' => 'hello laravel',
            'posted_by' => 'Habiba',
            'created_at' => '2023-04-01 10:00:00',
        ],

        [
            'id' => 2,
            'title' => 'PHP',
            'description' => 'hello php',
            'posted_by' => 'Nabila',
            'created_at' => '2023-04-01 10:00:00',
        ],

        [
            'id' => 3,
            'title' => 'Javascript',
            'description' => 'hello javascript',
            'posted_by' => 'Mariam',
            'created_at' => '2023-04-01 10:00:00',
        ],

    ];
    public function index()
    {
        return view('posts.index', ['posts'=> $this -> allPosts]);
    }
    public function show($id)
    {
        return view('posts.show', ['post'=> $this -> allPosts[0]]);
    }
    public function create()
    {
        return view('posts.create');
    }
    public function edit($id)
    {
        return view('posts.edit', ['post'=> $this -> allPosts[0]]);
    }
    public function update($id)
    {
        return view('posts.index', ['posts'=> $this -> allPosts]);
    }
    public function store()
    {
        return view('posts.index', ['posts'=> $this -> allPosts]);
    }
    public function delete()
    {
        return view('posts.index', ['posts'=> $this -> allPosts]);
    }
}
