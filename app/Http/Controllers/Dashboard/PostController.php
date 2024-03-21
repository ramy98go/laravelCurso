<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(2);
        echo view ('dashboard.post.index',["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Category::get();
        $categories = Category::pluck('id','title');
        $post = new Post();
        echo view('dashboard.post.create', compact('categories','post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // dd(request("title"));
            // dd($request->all());

            // $validated = $request->validate(StoreRequest::myRules());

            // dd($validated);

            // $validated = Validator::make($request->all(),StoreRequest::myRules());

            // dd($validated);

            // $data = array_merge($request->all(),['image' => '']);
            // dd($data);
            // $data = $request->validate();
            // $data['slug']= Str::slug($data['title']);
            // dd($data);
            Post::create($request->validated());
            return to_route("post.index")->with('status',"Registro creado.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("dashboard.post.show", compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id', 'title');

        echo view('dashboard.post.edit', compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        // dd($request->validated());
        $data = $request->validated();
        if(isset($data["image"])){
            
            // dd($request->image);
            
            // dd($request->validated()["image"]->extension());
            $data["image"] = $filename = time().".".$data["image"]->extension();
            // dd($filename);

            $request->image->move(public_path("image"),$filename);
        }

        $post->update($data);
        // $request->session()->flash('status',"Registro actualizado.");
        return to_route("post.index")->with('status',"Registro actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // echo "Destroy";
        $post->delete();
        return to_route("post.index")->with('status',"Registro eliminado.");
    }
}
