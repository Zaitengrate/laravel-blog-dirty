<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Mews\Purifier\Purifier;
use Session;
//use Images;﻿

class PostController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //creating and storing all blog posts
        $posts = Post::latest('created_at')->paginate(5);

        //returning views
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validation
        $this->validate($request, array(
              'title' => 'required|max:255',
              'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
              'category_id' => 'required|integer',
              'body' => 'required'
          ));
      // storage
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = clean($request->body);
        $post->category_id = $request->category_id;

        //saving image
        if ($request->hasFile('featured_img')) {
            $image = $request->file('featured_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images' . $filename);
            Images::make($image)->resize(800, 400)->save($location);

            $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags, false);

        Session::flash('success', 'The blog post was saved');
      //redirection
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //finding post in the databasa
        $post = Post::find($id);
        $categories = Category::all();

        $tags = Tag::all();

        //returning the view
        return view('posts.edit')->withPost($post)->withCategories($categories)->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation of the data
        $post = Post::find($id);
        if ($request->input('slug') == $post->slug) {
            $this->validate($request, array(
                  'title' => 'required|max:255',
                  'category_id' => 'required|integer',
                  'body' => 'required'
              ));
        } else {
            $this->validate($request, array(
                  'title' => 'required|max:255',
                  'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                  'category_id' => 'required|integer',
                  'body' => 'required'
              ));
        }

        //saving the data
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = clean($request->input('body'));
        $post->category_id = $request->input('category_id');


        $post->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags, true);
        } else {
            $post->tags()->sync(array(), true);
        }

        //setting flash data
        Session::flash('success', 'This post was succesfully saved.');

        //rediractiong flash data to posts
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->tags()->detach();

        $post->delete();

        Session::flash('success', 'The post was deleted');

        return redirect()->route('posts.index');
    }
}
