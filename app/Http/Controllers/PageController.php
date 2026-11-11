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

    public function blog(Request $request){

        $categories = CategoryBlog::withCount('blogs')->get();
        $totalBlogsCount = Blog::count();
        $blogs = Blog::with('category')->orderBy('id', 'desc')->get();
        // $blogs = Blog::with('category')->latest()->get();

        // whereHas
        if($request->filled('category')){
            $blogs->whereHas('category', function ($q) use ($request){
                $q->where('slug', $request->category);
            });
        }

        if($request->filled('search')){
            $searchterm = $request->search;
            $blogs->where(function($q) use ($searchterm){
                $q->where('name', 'like', "%{$searchterm}%")
                ->orWhere('brief_description', 'like', "%{$searchterm}%");
            });
        }

        $featuredPost = null;
        if(!$request->filled('category') && !$request->filled('search')){
            $featuredPost = (clone $blogs)->first();
        }

        if($featuredPost){
            $blogs->where('id', '!=', $featuredPost->id);
        }

        $blogs = $blogs->paginate(9)->withQueryString();
        // return $blogs;
        return view('blog.index', compact('blogs', 'categories', 'totalBlogsCount', 'featuredPost'));
    }

    public function showBlog(string $slug){
        $blog = Blog::where('slug', $slug)->with('category')->first();
        return view('blog.show', compact('blog'));
    }
}
