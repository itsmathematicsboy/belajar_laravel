<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Manajemen Produk || PPKD Sticker";
        $products = Product::with('category')->get();
        $category = Category::with('products')->get();
        return view('admin.product.index', compact('title','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Produk || PPKD Sticker";
        $categories = Category::all();
        return view('admin.product.create', compact('title','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'category_id'=> 'required|exists:categories_id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2640',
            'name' => 'required|string|max:60',
            // 'stock'=>'required|integer',

            // validasi product image
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:png,jpg,jpeg,webp|max:2048',
            'alt' => 'nullable|array',
            'alt.*' => 'nullable|array|max:255',
            'price' => 'required|integer',
            'slug' => 'nullable|string|unique:products,slug',
            'price_art_cartoon'=> 'nullable|numeric',
            'price_art_paper'=> 'nullable|numeric',
            'price_art_hvs'=> 'nullable|numeric',
            'price_art_dof'=> 'nullable|numeric',
            'price_art_glossy'=> 'nullable|numeric',
            'cutting_price'=>'nullable|numeric',
            'brief_description'=>'nullable|string',
            'description'=>'nullable|string',
        ]);

        DB::transaction(function() use($request, $validated){
            $product = Product::create([
                'category_id' =>$request->$validated['category_id'],
                'name'=>$request->$validated['name'],
            ]);

            if ($request->hasFile('images')){
                $imageData = [];

                foreach($request->file('images') as $key => $file){
                    $path = $file->store('product', 'public');

                    $imageData[] = [
                        'path'=>$path,
                        'alt'=> $request->input('alt.{$key}') ?? $product->name,
                        'sort_order'=>$key + 1,
                    ];
                }
                $product->images()->createMany($imageData);
            }
        });

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        $imagePath = null;
        if($request->image){
            $imagePath = $request->file('image')->store('product', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'image' => $request->$imagePath,
            'name' => $request->name,
            // 'stock' => $request->stock,
            'price' => $request->price,
            'price_art_cartoon' => $request->price_art_cartoon,
            'price_art_paper' => $request->price_art_paper,
            'price_hvs'=>$request->price_hvs,
            'price_dof'=>$request->price_glossy,
            'cutting_price'=>$request->cutting_price,
            'brief_description'=>$request->brief_description,
            'description'=>$request->description
        ]);
        return redirect()->route('admin.product.index')
        ->with('success', 'Produk berhasil ditambahkan');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if($request->hasFile('img')){
            Storage::disk('public')->delete($product->img);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);

        if($product->img){
            Storage::disk('public')->delete($product->img);
        }

        $product->delete();
    }
}
