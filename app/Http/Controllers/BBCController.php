<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;

class BBCController extends Controller
{
    protected $viewController;

    public function __construct()
    {
        $this->viewController = new ViewController(); 
    }

    public function index()
    {
        $posts = Post::withCount(['likes', 'dislikes'])->paginate(6);
        $categories = Category::all();
        $new_posts = Post::orderBy('created_at', 'desc')->take(8)->withCount(['likes', 'dislikes'])->get();

        foreach ($posts as $post) {
            $post->likes_count = $post->likes_count;
            $post->dislikes_count = $post->dislikes_count;
            $post->views_count = $post->views;
        }

        return view('bbc.index', [
            'posts' => $posts,
            'categories' => $categories,
            'new_posts' => $new_posts,
        ]);
    }
    
    public function byCategory($id)
    {
        $categories = Category::all();
        $posts = Post::where('category_id', $id)->withCount(['likes', 'dislikes'])->paginate(6);
        $new_posts = Post::where('category_id', $id)->orderBy('created_at', 'desc')->take(8)->withCount(['likes', 'dislikes'])->get();

        foreach ($posts as $post) {
            $post->likes_count = $post->likes_count; 
            $post->dislikes_count = $post->dislikes_count;
            $post->views_count = $post->views; 
        }

        return view('bbc.index', [
            'posts' => $posts,
            'categories' => $categories,
            'new_posts' => $new_posts,
        ]);
    }
    
    public function single($id)
    {
        $categories = Category::all();
        $post = Post::withCount(['likes', 'dislikes'])->findOrFail($id);
        $new_posts = Post::orderBy('created_at', 'desc')->take(8)->withCount(['likes', 'dislikes'])->get();
    
        $comments = Comment::where('post_id', $id)->with('user')->get();
    
        $this->viewController->incrementViewCount($id);
    
        return view('bbc.single', [
            'post' => $post,
            'categories' => $categories,
            'new_posts' => $new_posts,
            'likes_count' => $post->likes_count,
            'dislikes_count' => $post->dislikes_count,
            'views_count' => $post->views,
            'comments' => $comments,
        ]);
    }
    
}
