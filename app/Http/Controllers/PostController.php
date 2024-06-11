<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    function read_blog(string $username, string $id) {
        $post = Post::where('id', $id)->first();
        return view('blog', [
            'post' => $post,
            'username' => $username
        ]);
    }

    function show_menu() {
        return view('crud_blog');
    }

    public function menu_edit_blog(string $id) {
        $post = Post::findOrFail($id);

        return view("edit_blog", [
            'post' => $post
        ]);
    }

    function create_blog(Request $request) {
        $user = $request->session()->get('user');

        $validated = Validator::make($request->all(), [
            'title' => 'required|string|unique:posts|min:10|max:60',
            'content' => 'required|string|min:20|max:5000'
        ]);

        if ($validated->fails()) {
            return redirect('menu')->withErrors($validated)->withInput();
        }

        $data = $validated->validated();

        $newPost = new Post;
        $newPost->email = $user->email;
        $newPost->title = $data['title'];
        $newPost->content = $data['content'];
        $newPost->save();

        return redirect('yourposts')->with('status', 'Post Successfully Created');
    }

    function read_user_blog(string $username) {
        $emailExt = "@gmail.com";
        $email = $username . $emailExt;
        $posts = Post::where('email', $email)->get();
        
        return view('dashboard', [
            'posts' => $posts,
            'username' => $username
        ]);
    }    

    function author_menu(Request $request) {
        $user = $request->session()->get('user');
        $posts = Post::where('email', $user->email)->get();
    
        return view("menu_crud", [
            'posts' => $posts,
            'username' => $user->name
        ]);
    }
    

    public function update_blog(Request $request, string $id) {
        $post = Post::findOrFail($id);
    
        if ($request->isMethod('put')) {
            $validated = Validator::make($request->all(), [
                'title' => 'required|string|min:10|max:60',
                'content' => 'required|string|min:20|max:5000'
            ]);
    
            if ($validated->fails()) {
                return redirect()->back()->withErrors($validated)->withInput();
            }
    
            $data = $validated->validated();
            $post->title = $data['title'];
            $post->content = $data['content'];
            $post->save();
    
            return redirect('yourposts')->with('status', 'Post Successfully Updated');
        }
    }
    
    function delete_blog(string $id) {
        Post::findOrFail($id)->delete();
        return redirect('yourposts')->with('status', 'Post Successfully Deleted');
    }
}






