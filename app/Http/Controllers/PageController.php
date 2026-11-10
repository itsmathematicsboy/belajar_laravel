<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use app\Models\Setting;
use App\Models\CategoryBlog;

class PageController extends Controller
{
    public function faq(){
        return view('faq.index');
    }

    public function contact(){

        $setting = Setting::get();
        return view('contact.index', compact('setting'));
    }

    public function blog(){

        $categories = CategoryBlog::withCount('blogs')->get();
        $totalBlogsCount = Blog::count();
        $blogs = Blog::with('category')->orderBy('id', 'desc')->get();
        // $blogs = Blog::with('category')->latest()->get();
        return view('blog.index', compact('blogs', 'categories', 'totalBlogsCount'));
    }

    public function showBlog(string $slug){
        $blog = Blog::where('slug', $slug)->with('category')->first();
        return view('blog.show', compact('blog'));
    }
}
