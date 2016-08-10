<?php

namespace Eybos\Http\Controllers\Backend;

use Illuminate\Http\Request;

use Eybos\Post;
use Eybos\Http\Requests;

class PostsController extends Controller
{

    protected $posts;

    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // \DB::enableQueryLog();

        // $posts = $this->posts->with('author')->orderBy('published_at', 'desc')->paginate(10);

        // view('backend.posts.index', compact('posts'))->render();

        // dd( \DB::getQueryLog() );

        $posts = $this->posts->orderBy('published_at', 'desc')->paginate(10);

        return view('backend.posts.index', compact('posts'));
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('backend.posts.form', compact('post'));
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StorePostRequest $request)
    {
        $this->posts->create( ['author_id' => auth()->user()->id] + $request->only('title', 'slug', 'published_at', 'body', 'excerpt') );

        return redirect( route('backend.posts.index') )->with('success', 'Post has been created.');
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->posts->findOrFail( $id );

        return view('backend.posts.form', compact('post'));
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePostRequest $request, $id)
    {
        $post = $this->posts->findOrFail( $id );

        $post->fill( $request->only('title', 'slug', 'published_at', 'body', 'excerpt') )->save();

        return redirect( route('backend.posts.edit', $post->id) )->with('success', 'Post has been updated');
    }

    public function confirm($id)
    {
        $post = $this->posts->findOrFail($id);

        return view('backend.posts.confirm', compact('post'));
    }

    /**
     * @author Pranab Kalita <pranab.k@cisinlabs.com>
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->posts->findOrFail( $id );

        $post->delete();

        return redirect( route('backend.posts.index') )->with('success', 'Post has been deleted.');
    }
}
