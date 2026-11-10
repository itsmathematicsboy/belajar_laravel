<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\CategoryBlog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Manajemen Produk || PPKD Sticker";
        $blogs = Blog::with('category')->get();
        // $category = Category::with('products')->get();
        return view('admin.blog.index', compact('title', 'blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Blog || PPKD Sticker";
        $categories = CategoryBlog::all();
        return view('admin.blog.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string',
            'blog_category_id' => 'nullable|exists:category_blogs,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2640',
            'slug' => 'nullable|string|unique:category_blogs,slug',
            'content' => 'nullable|string',
            'author'=>'nullable|string',
            'cover_path' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
            ]);

            if($request->hasFile('cover_path')){
                $validated['cover_path'] = $request->file('cover_path')->store('blogs', 'public');
            }

            $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);

            Blog::create($validated);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $title = "Ubah Blog || PPKD Sticker";
        $category = CategoryBlog::all();
        return view('admin.blog.edit', compact('title', 'blog', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'blog_category_id' => 'nullable|exists:categories_blogs,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2640',
            'slug' => 'nullable|string|unique:category_blogs,slug',
            'content' => 'nullable|string',
            'author' => 'nullable|string',
            'cover_path' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($request->hasFile('cover_path')) {
            if($blog->cover_path){
                Storage::disk('public')->delete($blog->cover_path);
            }
        }

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        $blog->update($validated);

        return redirect()->route('admin.blog.index')
        ->with('success', 'Blog berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $blog = Blog::find($id);

        if ($blog->cover_path) {
            Storage::disk('public')->delete($blog->cover_path);
        }

        $blog->delete();
        return redirect()->route('admin.blog.index')
        ->with('success', 'Blog berhasil dihapus');
    }
}
