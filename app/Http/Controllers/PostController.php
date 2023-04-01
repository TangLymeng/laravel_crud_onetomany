<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $category = Category::findOrFail($request->category_id);

        $post = new Post();
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);

        $post->title = $request->title;
        $post->slug = Str::slug($request->slug);
        $post->description = $request->description;
        $post->image = $file_name;

        $category->posts()->save($post);

//        $category->posts()->create([
//            'title' => $request->title,
//            'slug' => Str::slug($request->slug),
//            'description' => $request->description,
//            'image' => $file_name,
//        ]);
        return redirect('admin/posts')->with('success', 'Post created successfully.');
    }
    public function edit($post)
    {
        $categories = Category::all();
        $post = Post::findOrFail($post);
        return view('admin.post.edit', compact('categories','post' ));
    }
    public function update(Request $request, $post_id)
    {
        $post = Post::findOrFail($post_id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $file_name = $request->hidden_post_image;
        if ($request->image != '') {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $file_name);
        }

        $post->title = $request->title;
        $post->slug = Str::slug($request->slug);
        $post->description = $request->description;
        $post->image = $file_name;
        $post->category_id = $request->category_id; // update the category_id of the post

        $post->save(); // save the changes to the post

        return redirect('admin/posts')->with('success', 'Post updated successfully.');
    }
    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);
        $post->delete();
        return redirect('admin/posts')->with('success', 'Blog deleted successfully.');
    }
}
