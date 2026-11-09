@extends('admin.layouts.app')
@section('title', 'Edit Kategori Blog')
@section('subtitle', 'Edit kategori ke panel Admin')

@section('content')
    <form action="{{ route('admin.category_blog.update', $category) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label-custom">Nama Kategori</label>
            <input type="text"
            class="form-control" name="name" required
            value={{ old('name', $category->name) }}>
            @error('name')
                <div class="invalid-feedback d-block">{{  $message  }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label-custom">Slug (Opsional)</label>
            <input type="text"
            class="form-control" name="slug" required
            value={{ old('slug', $category->slug) }}>
            @error('slug')
                <div class="invalid-feedback d-block">{{  $message  }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn-custom btn-custom-primary">
                Simpan
            </button>
        </div>
    </form>
@endsection
